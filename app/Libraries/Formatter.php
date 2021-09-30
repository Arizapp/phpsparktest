<?php

namespace App\Libraries;

class Formatter
{

	public static function phone(string $number)
	{
		$number = str_split(preg_replace('/\D/', '', $number));

		return count($number) == 11
			? vsprintf('(%s%s) %s%s%s%s%s-%s%s%s%s', $number)
			: vsprintf('(%s%s) %s%s%s%s-%s%s%s%s', $number);
	}

	public static function postalCode(string $number)
	{
		$number = str_split(preg_replace('/\D/', '', $number));

		return vsprintf('%s%s%s%s%s-%s%s%s', $number);
	}

	public static function oab(string $number)
	{
		$number = preg_replace('/[^\w]/', '', $number);
		$code = mb_substr($number, 0, 2);
		$number = mb_substr($number, 2);

		return strtoupper(sprintf('%s %s', $code, $number));
	}

	public static function oab_db(string $number)
	{
		$number = preg_replace('/[^\w]/', '', $number);

		return strtoupper($number);
	}

	public static function phone_db(string $number)
	{
		$number = preg_replace('/[\D]/', '', $number);

		return strtoupper($number);
	}

	public static function postal_code_db(string $number)
	{
		$number = preg_replace('/[\D]/', '', $number);

		return strtoupper($number);
	}

	public static function date(string $date)
	{

	}

}