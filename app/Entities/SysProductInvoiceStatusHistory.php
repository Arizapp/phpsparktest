<?php

namespace App\Entities;

use CodeIgniter\I18n\Time;
use Exception;

/**
 * Class SysProductInvoiceStatusHistory
 * @package App\Entities
 *
 * @property int                     $id
 * @property int                     $sys_product_invoice_id
 * @property int                     $sys_product_invoice_status_id
 * @property string                  $date
 * @property SysProductInvoice       $invoice
 * @property SysProductInvoiceStatus $status
 */
class SysProductInvoiceStatusHistory extends AppEntity
{

	public function getInvoice()
	{
		return $this->fetchProperty(
			'invoice',
			'sys_product_invoice_id',
			\App\Models\SysProductInvoice::class,
			SysProductInvoice::class
		);
	}

	public function getStatus()
	{
		return $this->fetchProperty(
			'status',
			'sys_product_invoice_status_id',
			\App\Models\SysProductInvoiceStatus::class,
			SysProductInvoiceStatus::class
		);
	}

	/**
	 * @param string $dateString
	 * @return $this
	 * @throws Exception
	 */
	public function setDate(string $dateString)
	{
		$this->attributes['date'] = new Time($dateString, 'UTC');

		return $this;
	}

	/**
	 * @param string $format
	 * @return mixed
	 * @throws Exception
	 */
	public function getDate(string $format = 'd/m/Y H:i:s')
	{
		$property = 'date';

		// Convert to CodeIgniter\I18n\Time object
		$this->attributes[ $property ] = $this->mutateDate($this->attributes[ $property ]);

		$timezone = $this->timezone ?? app_timezone();

		$this->attributes[ $property ]->setTimezone($timezone);

		return $this->attributes[ $property ]->format($format);
	}
}