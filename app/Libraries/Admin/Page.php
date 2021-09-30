<?php

namespace App\Libraries\Admin;

use App\Entities\SysPage;
use App\Entities\SysPageImage;
use App\Entities\SysPageVariable;
use App\Libraries\RouteManager;
use App\Models\SysPages;
use App\Models\SysPagesGallery;
use App\Models\SysPagesTextList;
use App\Models\SysPagesTextPairs;
use App\Models\SysPagesUris;
use App\Models\SysPagesVariables;
use Config\Paths;
use Exception;
use ReflectionException;

/**
 * Class Page
 * @package App\Libraries\Admin
 *
 * @property SysPages          $SysPages
 * @property SysPagesUris      $SysPagesUris
 * @property SysPagesVariables $SysPagesVariables
 * @property SysPagesGallery   $SysPagesGallery
 * @property SysPagesTextPairs $SysPagesTextPairs
 * @property SysPagesTextList  $SysPagesTextList
 */
class Page
{

	private $SysPages;
	private $SysPagesUris;
	private $SysPagesVariables;
	private $SysPagesGallery;
	private $SysPagesTextPairs;
	private $SysPagesTextList;

	public function __construct()
	{
		$this->SysPages = new SysPages();
		$this->SysPagesUris = new SysPagesUris();
		$this->SysPagesVariables = new SysPagesVariables();
		$this->SysPagesGallery = new SysPagesGallery();
		$this->SysPagesTextPairs = new SysPagesTextPairs();
		$this->SysPagesTextList = new SysPagesTextList();
	}

	/**
	 * @param $id
	 * @throws Exception
	 */
	public function delete($id)
	{
		$page = (new SysPages())->find($id);
		if (empty($page->id)) throw new Exception('Página não encontrada!');
		// Variables
		foreach ($page->variables as $variable)
		{
			switch ($variable->type)
			{
				case SysPageVariable::TYPE_GALLERY:
					(new SysPagesGallery())->where('sys_page_variable_id', $variable->id)->delete();
					break;
				case SysPageVariable::TYPE_TEXT_LIST:
					(new SysPagesTextList())->where('sys_page_variable_id', $variable->id)->delete();
					break;
				case SysPageVariable::TYPE_TEXT_PAIRS:
					(new SysPagesTextPairs())->where('sys_page_variable_id', $variable->id)->delete();
					break;
			}
			(new SysPagesVariables())->where('id', $variable->id)->delete();
		}
		// Uri
		(new SysPagesUris())->where('sys_page_id', $page->id)->delete();
		// Page
		(new SysPages())->where('id', $page->id)->delete();
	}

	/**
	 * @param array $post
	 * @return mixed|string
	 * @throws Exception
	 */
	public function new(array $post)
	{
		$page = new SysPage();

		$this->edit_validate_main_uri($page, $post);

		$page->uri = $post['uri'];
		$page->route = $post['route'];
		$page->route_filter = $post['route_filter'];

		$this->SysPages->insert($page->toArray());

		return $page->uri;
	}

	/**
	 * @param SysPage $page
	 * @param array   $post
	 * @param array   $files
	 * @throws ReflectionException
	 * @throws Exception
	 */
	public function edit(SysPage &$page, array $post, array $files = [])
	{
		$this->edit_save_page($page, $post, $files);
		$this->edit_save_variables($post, $files);
		$this->edit_save_uris($page, $post);

		(new RouteManager())->pagesSync();
	}

	private function reorder_gallery(&$values)
	{
		$order = 1;
		foreach ($values as &$gallery)
		{
			if (in_array($gallery['action'], ['delete', 'none'])) continue;
			$gallery['order'] = $order++;
		}
	}

	private function reorder_tp(&$values)
	{
		$order = 1;
		foreach ($values as &$tp)
		{
			if ($tp['action'] == 'delete') continue;
			$tp['order'] = $order++;
		}
	}

	private function reorder_tl(&$values)
	{
		$order = 1;
		foreach ($values as &$tp)
		{
			if ($tp['action'] == 'delete') continue;
			$tp['order'] = $order++;
		}
	}

	/**
	 * @param SysPage $page
	 * @param array   $post
	 * @throws ReflectionException
	 * @throws Exception
	 */
	private function edit_save_uris(SysPage $page, array $post)
	{
		if (!isset($post['uris']))
		{
			$this->SysPagesUris->where('sys_page_id', $page->id)->delete();
		} else
		{
			/* Validate Alternate Uri  */
			$post['uris'] = array_unique($post['uris']);
			if (in_array($page->uri, $post['uris'])) throw new Exception("Nenhum <b>Link alternativo</b> deve ser igual ao <b>Link principal</b>!<br><small>Apenas os Links não foram salvos.</small>");
			$validate_pages_uris = $this->SysPages->whereIn('uri', $post['uris'])->findAll();
			if (count($validate_pages_uris))
			{
				$validate_pages_uris_names = [];
				foreach ($validate_pages_uris as $validatePagesUris)
				{
					$validate_pages_uris_names[] = $validatePagesUris->uri;
				}
				$validate_pages_uris_names = implode("', '", $validate_pages_uris_names);
				throw new Exception("Já existem <b>Links principais</b> iguais a '{$validate_pages_uris_names}'!<br><small>Apenas os Links não foram salvos.</small>");
			}

			$validate_pages_uris = $this->SysPagesUris->where('sys_page_id <>', $page->id)->whereIn('uri', $post['uris'])->findAll();
			if (count($validate_pages_uris))
			{
				$validate_pages_uris_names = [];
				foreach ($validate_pages_uris as $validatePagesUris)
				{
					$validate_pages_uris_names[] = $validatePagesUris->uri;
				}
				$validate_pages_uris_names = implode("', '", $validate_pages_uris_names);
				throw new Exception("Já existem <b>Links alternativos</b> iguais a '{$validate_pages_uris_names}'!<br><small>Apenas os Links não foram salvos.</small>");
			}

			$this->SysPagesUris->where('sys_page_id', $page->id)->delete();
			foreach ($post['uris'] as $value)
			{
				$this->SysPagesUris->insert([
					'sys_page_id' => $page->id,
					'uri'         => $value,
				]);
			}
		}
	}

	/**
	 * @param array $post
	 * @param array $files
	 * @throws ReflectionException
	 * @throws Exception
	 */
	private function edit_save_variables(array $post, array $files)
	{
		if (isset($post['variable_del']))
		{
			$this->del_variables($post['variable_del']);
		}
		if (isset($post['variables']))
		{
			foreach ($post['variables'] as $key => $variable)
			{
				if (isset($post['variable_del']) && in_array($variable['id'], $post['variable_del'])) continue;

				if ($variable['type'] == SysPageVariable::TYPE_IMAGE && isset($files['variables'][ $key ]))
				{
					$this->save_variables_image($variable, $files['variables'][ $key ]);
					continue;
				}

				if ($variable['type'] == SysPageVariable::TYPE_GALLERY)
				{
					$this->reorder_gallery($variable['value']);
					$this->save_variables_gallery($variable, $files['variables'][ $key ]['value']);
					continue;
				}

				if ($variable['type'] == SysPageVariable::TYPE_TEXT_PAIRS)
				{
					$this->reorder_tp($variable['value']);
					$this->save_variables_tp($variable);
					continue;
				}

				if ($variable['type'] == SysPageVariable::TYPE_TEXT_LIST)
				{
					$this->reorder_tl($variable['value']);
					$this->save_variables_tl($variable);
					continue;
				}

				$this->SysPagesVariables->save($variable);
			}
		}
	}

	private function del_variables($variables)
	{
		$imageUploadDirectory = (new Paths())->imageUploadDirectory;

		foreach ($variables as $id)
		{
			$SysPageVariable = $this->SysPagesVariables->find($id);
			if ($SysPageVariable->id)
			{
				if ($SysPageVariable->type == SysPageVariable::TYPE_IMAGE)
				{
					$file = realpath($imageUploadDirectory . DIRECTORY_SEPARATOR . $SysPageVariable->value);
					if (file_exists($file)) unlink($file);
				}
				if ($SysPageVariable->type == SysPageVariable::TYPE_GALLERY)
				{
					/** @var SysPageImage[] $galleries */
					$galleries = $this->SysPagesGallery->where('sys_page_variable_id', $id)->findAll();
					foreach ($galleries as $gallery)
					{
						$file = realpath($imageUploadDirectory . DIRECTORY_SEPARATOR . $gallery->getImageName());
						$this->SysPagesGallery->delete($gallery->id);
						if (file_exists($file)) unlink($file);
					}
				}
				if ($SysPageVariable->type == SysPageVariable::TYPE_TEXT_PAIRS)
				{
					$this->SysPagesTextPairs->where('sys_page_variable_id', $id)->delete();
				}
				if ($SysPageVariable->type == SysPageVariable::TYPE_TEXT_LIST)
				{
					$this->SysPagesTextList->where('sys_page_variable_id', $id)->delete();
				}
				$this->SysPagesVariables->delete($SysPageVariable->id);
			}
		}
	}

	/**
	 * @param $variable
	 * @throws ReflectionException
	 */
	private function save_variables_tp($variable)
	{
		if (!$variable['id'])
		{
			$variable['id'] = $this->SysPagesVariables->insert([
				'key'         => $variable['key'],
				'type'        => $variable['type'],
				'sys_page_id' => $variable['sys_page_id'],
				'order'       => $variable['order'],
			], true);
		}

		foreach ($variable['value'] as $tp)
		{
			if (empty($tp['title']) || empty($tp['text'])) continue;

			if ($tp['action'] == 'delete')
			{
				if (!empty($tp['id'])) $this->SysPagesTextPairs->delete($tp['id']);
				continue;
			}

			if ($tp['action'] == 'update')
			{
				$this->SysPagesTextPairs->update($tp['id'], $tp);
				continue;
			}

			if ($tp['action'] == 'insert')
			{
				$tp['sys_page_variable_id'] = $variable['id'];
				$this->SysPagesTextPairs->insert($tp);
			}
		}
	}

	/**
	 * @param $variable
	 * @throws ReflectionException
	 */
	private function save_variables_tl($variable)
	{
		if (!$variable['id'])
		{
			$variable['id'] = $this->SysPagesVariables->insert([
				'key'         => $variable['key'],
				'type'        => $variable['type'],
				'sys_page_id' => $variable['sys_page_id'],
				'order'       => $variable['order'],
			], true);
		}

		foreach ($variable['value'] as $tl)
		{
			if (empty($tl['text'])) continue;

			if ($tl['action'] == 'delete')
			{
				if (!empty($tl['id'])) $this->SysPagesTextList->delete($tl['id']);
				continue;
			}

			if ($tl['action'] == 'update')
			{
				$this->SysPagesTextList->update($tl['id'], $tl);
				continue;
			}

			if ($tl['action'] == 'insert')
			{
				$tl['sys_page_variable_id'] = $variable['id'];
				$this->SysPagesTextList->insert($tl);
			}
		}
	}

	/**
	 * @param $variable
	 * @param $files
	 * @throws ReflectionException
	 */
	private function save_variables_gallery($variable, $files)
	{
		$imageUploadDirectory = (new Paths())->imageUploadDirectory;

		if (!$variable['id'])
		{
			$variable['id'] = $this->SysPagesVariables->insert([
				'key'         => $variable['key'],
				'type'        => $variable['type'],
				'sys_page_id' => $variable['sys_page_id'],
				'order'       => $variable['order'],
			], true);
		}

		foreach ($variable['value'] as $index => $gallery)
		{
			/* Do Nothing */
			if ($gallery['action'] == 'none')
			{
				continue;
			}

			/* Update */
			if ($gallery['action'] == 'update')
			{
				$gallery['url_external'] = isset($gallery['url_external']) && $gallery['url_external'] == 'on';
				$this->SysPagesGallery->save($gallery);
				continue;
			} // update

			/* Delete */
			if ($gallery['action'] == 'delete')
			{
				/** @var SysPageImage $SysPageImage */
				$SysPageImage = $this->SysPagesGallery->find($gallery['id']);
				if (isset($SysPageImage->id))
				{
					$oldFile = realpath($imageUploadDirectory . DIRECTORY_SEPARATOR . $SysPageImage->getImageName());
					$this->SysPagesGallery->delete($SysPageImage->id);
				}
				if (isset($oldFile) && file_exists($oldFile)) unlink($oldFile);
				continue;
			} // delete

			/* Insert */
			if ($gallery['action'] == 'insert')
			{
				if (!isset($files[ $index ]))
				{
					continue;
				}

				$img = $files[ $index ]['image'];
				if ($img->isValid() && !$img->hasMoved())
				{

					$name = $img->getRandomName();
					$img->move($imageUploadDirectory, $name);

					if ($gallery['id'])
					{
						/** @var SysPageImage $SysPageImage */
						$SysPageImage = $this->SysPagesGallery->find($gallery['id']);
						if (isset($SysPageImage->id)) $oldFile = realpath($imageUploadDirectory . DIRECTORY_SEPARATOR . $SysPageImage->getImageName());
					}

					$gallery['sys_page_variable_id'] = $variable['id'];
					$gallery['image'] = $name;
					$gallery['url_external'] = isset($gallery['url_external']) && $gallery['url_external'] == 'on';
					$this->SysPagesGallery->save($gallery);
					if (isset($oldFile) && file_exists($oldFile)) unlink($oldFile);
				}
			} // insert
		} // foreach
	}

	/**
	 * @param $variable
	 * @param $file
	 * @throws ReflectionException
	 */
	private function save_variables_image($variable, $file)
	{
		$imageUploadDirectory = (new Paths())->imageUploadDirectory;

		$img = $file['value'];

		if ($img->isValid() && !$img->hasMoved())
		{
			$name = $img->getRandomName();
			$img->move($imageUploadDirectory, $name);

			if ($variable['id'])
			{
				$SysPageVariable = $this->SysPagesVariables->find($variable['id']);
				if (isset($SysPageVariable->id)) $oldFile = realpath($imageUploadDirectory . DIRECTORY_SEPARATOR . $SysPageVariable->value);
			}

			$variable['value'] = $name;
		}

		$this->SysPagesVariables->save($variable);
		if (isset($oldFile) && is_file($oldFile)) unlink($oldFile);
	}

	/**
	 * @param SysPage $page
	 * @param array   $post
	 * @param array   $files
	 * @throws Exception
	 */
	private function edit_save_page(SysPage &$page, array $post, array $files)
	{
		$this->edit_validate_main_uri($page, $post);

		$imageUploadDirectory = (new Paths())->imageUploadDirectory;
		$oldFiles = [];
		foreach ($this->SysPages->allowerFields() as $key)
		{
			if ($key == 'id') continue;
			if (in_array($key, ['meta_og_image', 'meta_twitter_image']) && isset($files[ $key ]))
			{
				$img = $files[ $key ];
				if ($img->isValid() && !$img->hasMoved())
				{
					$name = $img->getRandomName();
					$img->move($imageUploadDirectory, $name);
					$oldFiles[] = realpath($imageUploadDirectory . DIRECTORY_SEPARATOR . $page->{$key});
					$page->{$key} = $name;
				}
				continue;
			}
			if (isset($post[ $key ])) $page->{$key} = $post[ $key ];
		}

		$this->SysPages->save($page->toArray());

		foreach ($oldFiles as $oldFile)
		{
			if (file_exists($oldFile)) unlink($oldFile);
		}

	}

	/**
	 * @param $page
	 * @param $post
	 * @throws Exception
	 */
	private function edit_validate_main_uri(SysPage $page, array $post)
	{
		if ($page->id) $this->SysPages->where('id <>', $page->id);
		$validate_pages_uri_count = $this->SysPages->where('uri', $post['uri'])->countAllResults();
		if ($validate_pages_uri_count > 0) throw new Exception("Já existe uma página com o <b>Link principal</b> '{$post['uri']}'!");

		$validate_pages_uri_count = $this->SysPagesUris->where('uri', $post['uri'])->countAllResults();
		if ($validate_pages_uri_count > 0) throw new Exception("Já existe uma página com o <b>Link alternativo</b> '{$post['uri']}'!");
	}

}
