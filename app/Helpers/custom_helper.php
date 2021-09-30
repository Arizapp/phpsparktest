<?php
if (!function_exists('numbers_only'))
{
	function numbers_only($value)
	{
		return preg_replace('/\D/', '', $value);
	}
}