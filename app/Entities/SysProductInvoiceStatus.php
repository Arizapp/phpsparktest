<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * Class SysProductInvoiceStatus
 * @package App\Entities
 *
 * @property int    $id
 * @property string $name
 */
class SysProductInvoiceStatus extends Entity
{
	const WAITING = 1;
}