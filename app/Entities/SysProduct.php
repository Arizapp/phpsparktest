<?php

namespace App\Entities;

use App\Models\SysProductCategories;

/**
 * Class SysProduct
 * @package App\Entities
 *
 * @property int                $id
 * @property int                $sys_product_category_id
 * @property string             $picture
 * @property string             $name
 * @property string             $unit_name
 * @property double             $value
 * @property int                $amount
 * @property SysProductCategory $category
 */
class SysProduct extends AppEntity
{
	public function getCategory()
	{
		return $this->fetchProperty(
			'category',
			'sys_product_category_id',
			SysProductCategories::class,
			SysProductCategory::class
		);
	}

	public function getPicture()
	{
		return $this->attributes['picture'] ? site_url("assets/img/uploads/{$this->attributes['picture']}") : '';
	}
}