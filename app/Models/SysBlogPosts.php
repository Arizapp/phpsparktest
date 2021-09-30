<?php

namespace App\Models;

use App\Entities\SysBlogPost;

/**
 * Class SysBlogPosts
 * @package App\Models
 */
class SysBlogPosts extends DataTablesModel
{
	public $table         = 'sys_blog_posts';
	protected $returnType    = SysBlogPost::class;
	protected $allowedFields = [
		'id',
		'sys_blog_category_id',
		'uri',
		'title',
		'description',
		'text',
		'picture',
		'author',
		'meta_keywords',
		'meta_description',
		'meta_og_title',
		'meta_og_description',
		'meta_og_image',
		'meta_twitter_title',
		'meta_twitter_description',
		'meta_twitter_image',
		'meta_twitter_site',
		'meta_twitter_creator',
		'enabled',
		'created_at',
	];

	public function whereCategory($id = null)
	{
		if ($id)
		{
			$this->where('sys_blog_category_id', $id);
		}

		return $this;
	}

	/**
	 * @param int $limit
	 * @param int $offset
	 * @return SysBlogPost[]
	 */
	public function findAll(int $limit = 0, int $offset = 0)
	{
		$this->orderBy('id', 'desc');

		return parent::findAll($limit, $offset);
	}

	public function findByUri($uri): SysBlogPost
	{
		$row = $this->where('uri', $uri)->first();

		return $row ?? new SysBlogPost();
	}

}