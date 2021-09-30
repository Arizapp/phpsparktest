<?php

namespace App\Models;

use App\Entities\SysPageImage;

class SysPagesGallery extends AppModel
{
	public    $table         = 'sys_pages_gallery';
	protected $returnType    = SysPageImage::class;
	protected $allowedFields = ['id', 'sys_page_variable_id', 'image', 'title', 'description', 'url', 'url_external', 'order'];
}