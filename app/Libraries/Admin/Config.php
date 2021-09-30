<?php

namespace App\Libraries\Admin;

use App\Entities\SysConfig;
use App\Entities\SysPageVariable;
use App\Models\SysConfig as SysConfigModel;
use App\Models\SysConfigSocialMedias;
use App\Models\SysConfigVariables;
use Config\Paths;
use Exception;
use ReflectionException;

/**
 * Class Page
 * @package App\Libraries\Admin
 *
 * @property SysConfigModel        $SysConfig
 * @property SysConfigSocialMedias $SysConfigSocialMedias
 * @property SysConfigVariables    $SysConfigVariables
 */
class Config
{

	private $SysConfig;
	private $SysConfigSocialMedias;
	private $SysConfigVariables;

	public function __construct()
	{
		$this->SysConfig = new SysConfigModel();
		$this->SysConfigSocialMedias = new SysConfigSocialMedias();
		$this->SysConfigVariables = new SysConfigVariables();
	}

	/**
	 * @param SysConfig $config
	 * @param array     $post
	 * @param array     $files
	 * @throws ReflectionException
	 * @throws Exception
	 */
	public function edit(SysConfig &$config, array $post, array $files = [])
	{
		$this->edit_save_config($config, $post, $files);
		$this->edit_save_variables($post, $files);
		$this->edit_save_social_medias($post);
	}

	/**
	 * @param array $post
	 * @throws ReflectionException
	 */
	private function edit_save_social_medias(array $post)
	{
		$this->SysConfigSocialMedias->where('id IS NOT', null)->delete();

		if (empty($post['social_medias'])) return;
		foreach ($post['social_medias'] as $socialMedia)
		{
			$this->SysConfigSocialMedias->insert([
				'social_media_id' => $socialMedia['social_media_id'],
				'value'           => $socialMedia['value'],
			]);
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
		$imageUploadDirectory = (new Paths())->imageUploadDirectory;
		/** @var SysPageVariable $SysPageVariable */
		if (isset($post['variable_del']))
		{
			foreach ($post['variable_del'] as $id)
			{
				$SysPageVariable = $this->SysConfigVariables->find($id);
				$this->SysConfigVariables->delete($SysPageVariable->id);
				if ($SysPageVariable->type == SysPageVariable::TYPE_IMAGE)
				{
					$file = realpath($imageUploadDirectory . DIRECTORY_SEPARATOR . $SysPageVariable->value);
					if (file_exists($file)) unlink($file);
				}
			}
		}
		if (isset($post['variables']))
		{
			foreach ($post['variables'] as $key => $variable)
			{
				if (isset($post['variable_del']) && in_array($variable['id'], $post['variable_del'])) continue;

				if ($variable['type'] == SysPageVariable::TYPE_IMAGE && isset($files['variables'][ $key ]))
				{
					$img = $files['variables'][ $key ]['value'];
					if ($img->isValid() && !$img->hasMoved())
					{
						$name = $img->getRandomName();
						$img->move($imageUploadDirectory, $name);

						if ($variable['id'])
						{
							$SysPageVariable = $this->SysConfigVariables->find($variable['id']);
							if (isset($SysPageVariable->id)) $oldFile = realpath($imageUploadDirectory . DIRECTORY_SEPARATOR . $SysPageVariable->value);
						}

						$variable['value'] = $name;

					}
				}

				$this->SysConfigVariables->save($variable);
				if (isset($oldFile) && file_exists($oldFile)) unlink($oldFile);
			}
		}
	}

	/**
	 * @param SysConfig $config
	 * @param array     $post
	 * @param array     $files
	 * @throws ReflectionException
	 */
	private function edit_save_config(SysConfig &$config, array $post, array $files)
	{
		$imageUploadDirectory = (new Paths())->imageUploadDirectory;
		$oldFiles = [];
		foreach ($this->SysConfig->allowerFields() as $key)
		{
			if ($key == 'id') continue;
			if (in_array($key, ['favicon', 'meta_og_image', 'meta_twitter_image']) && isset($files[ $key ]))
			{
				$img = $files[ $key ];
				if ($img->isValid() && !$img->hasMoved())
				{
					$name = $img->getRandomName();
					$img->move($imageUploadDirectory, $name);
					$oldFiles[] = realpath(ROOTPATH . $imageUploadDirectory . DIRECTORY_SEPARATOR . $config->{$key});
					$config->{$key} = $name;
				}
				continue;
			}
			if (isset($post[ $key ])) $config->{$key} = $post[ $key ];
		}

		$this->SysConfig->save($config->toArray());

		foreach ($oldFiles as $oldFile)
		{
			if (file_exists($oldFile)) unlink($oldFile);
		}
	}

}