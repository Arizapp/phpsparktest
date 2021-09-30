<?php

namespace App\Entities;

use App\Models\SysCustomers;
use CodeIgniter\I18n\Time;
use Exception;

/**
 * Class SysProductCart
 * @package App\Entities
 *
 * @property int         $id
 * @property int         $sys_customer_id
 * @property string      $date
 * @property double      $subtotal
 * @property double      $delivery_cost
 * @property double      $total
 * @property SysCustomer $customer
 */
class SysProductCart extends AppEntity
{
	public function getCustomer()
	{
		return $this->fetchProperty(
			'customer',
			'sys_customer_id',
			SysCustomers::class,
			SysCustomer::class
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