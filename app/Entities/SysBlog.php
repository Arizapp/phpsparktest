<?php

namespace App\Entities;

use App\Models\SysBlogCategories;
use App\Models\SysBlogPosts;
use CodeIgniter\Entity;

/**
 * Class SysBlog
 * @package App\Entities
 *
 * @property int               $id
 * @property string            $title
 * @property string            $uri
 * @property string            $meta_keywords
 * @property string            $meta_description
 * @property string            $meta_og_title
 * @property string            $meta_og_description
 * @property string            $meta_og_image
 * @property string            $meta_twitter_title
 * @property string            $meta_twitter_description
 * @property string            $meta_twitter_image
 * @property string            $meta_twitter_site
 * @property string            $meta_twitter_creator
 * @property SysBlogPosts      $posts
 * @property SysBlogCategory[] $categories
 */
class SysBlog extends Entity
{

	private $_posts;
	private $_categories;

	public function getPosts(): SysBlogPosts
	{
		if (empty($this->_posts))
		{
			$this->_posts = new SysBlogPosts();
		}

		return $this->_posts;
	}

	public function getCategories(): array
	{
		if (empty($this->_categories))
		{
			$this->_categories = (new SysBlogCategories())->orderBy('name')->findAll();
		}

		return $this->_categories ?? [];
	}

}