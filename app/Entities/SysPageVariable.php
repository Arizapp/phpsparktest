<?php

namespace App\Entities;

use App\Models\SysPagesGallery;
use App\Models\SysPagesTextList;
use App\Models\SysPagesTextPairs;
use CodeIgniter\Entity;

/**
 * Class PageVariable
 * @package App\Entities
 *
 * @property int                $id
 * @property int                $sys_page_id
 * @property string             $type
 * @property string             $key
 * @property string             $value
 * @property int                $order
 * @property SysPageImage[]     $gallery
 * @property SysPageTextPair[]  $text_pairs
 * @property array              $text_pairs_as_variables
 * @property SysPagesTextList[] $text_list
 */
class SysPageVariable extends Entity
{
    const TYPE_IMAGE      = 'I';
    const TYPE_TEXT       = 'T';
    const TYPE_MULTITEXT  = 'M';
    const TYPE_GALLERY    = 'G';
    const TYPE_TEXT_PAIRS = 'TP';
    const TYPE_TEXT_LIST  = 'TL';

    public static function listTypes()
    {
        return [
            self::TYPE_TEXT       => 'Texto',
            self::TYPE_MULTITEXT  => 'Texto em linhas',
            self::TYPE_TEXT_LIST  => 'Texto em lista',
            self::TYPE_TEXT_PAIRS => 'Texto em pares',
            self::TYPE_IMAGE      => 'Imagem',
            self::TYPE_GALLERY    => 'Galeria',
        ];
    }

    public function getGallery()
    {
        return (new SysPagesGallery())
            ->where('sys_page_variable_id', $this->attributes['id'])
            ->orderBy('order')
            ->findAll();
    }

    /**
     * @return SysPageTextPair[]
     */
    public function getTextPairs()
    {
        return (new SysPagesTextPairs())
            ->where('sys_page_variable_id', $this->attributes['id'])
            ->orderBy('order')
            ->findAll();
    }

    /**
     * @return array
     */
    public function getTextPairsAsVariables()
    {
        $result = [];

        foreach ($this->getTextPairs() as $value) {
            $result[$value->title] = $value->text;

        }

        return $result;
    }

    /**
     * @return SysPageTextItem[]
     */
    public function getTextList()
    {
        return (new SysPagesTextList())
            ->where('sys_page_variable_id', $this->attributes['id'])
            ->orderBy('order')
            ->findAll();
    }

    public function __toString()
    {
        switch ($this->type) {
            case self::TYPE_IMAGE:
                return site_url("assets/img/uploads/{$this->value}");
            case self::TYPE_MULTITEXT:
                return nl2br($this->value);
            case self::TYPE_GALLERY:
            case self::TYPE_TEXT_PAIRS:
            case self::TYPE_TEXT_LIST:
                return '';
            default:
                return $this->value;
        }
    }

}