<?php

use App\Entities\SysConfig;

if (!function_exists('sys_config'))
{
	function sys_config(): SysConfig
	{
		return SysConfig::getSharedInstance();
	}
}

if (!function_exists('partial_view'))
{
	/**
	 * @param string $name
	 * @param array  $data
	 * @param array  $options Unused - reserved for third-party extensions.
	 *
	 * @return string
	 */
	function partial_view(string $name, array $data = [], array $options = []): string
	{
		return view("App/Partials/{$name}", $data, $options);
	}
}
if (!function_exists('assets_url'))
{
	/**
	 * @param string $uri
	 *
	 * @return string
	 */
	function assets_url(string $uri = ''): string
	{
		return base_url('assets/' . $uri);
	}
}
if (!function_exists('vendor_url'))
{
	/**
	 * @param string $uri
	 *
	 * @return string
	 */
	function vendor_url(string $uri = ''): string
	{
		return base_url('vendor/' . $uri);
	}
}
if (!function_exists('js'))
{
	/**
	 * @param string $uri
	 * @param bool   $echo
	 * @param bool   $min
	 * @return string
	 */
	function js(string $uri = '', bool $echo = true, bool $min = false): string
	{
		$file = str_replace('/', DIRECTORY_SEPARATOR, getcwd() . '/assets/js/' . $uri . ($min ? '.min.js' : '.js'));
		if (!file_exists($file)) return '';

		$url = assets_url('js/' . $uri . ($min ? '.min.js' : '.js'));
		$tag = "<script type='text/javascript' src='{$url}'></script>" . PHP_EOL;
		if ($echo) echo $tag;

		return $tag;
	}
}
if (!function_exists('vendor_js'))
{
	/**
	 * @param string $uri
	 * @param bool   $echo
	 * @param bool   $min
	 * @return string
	 */
	function vendor_js(string $uri = '', bool $echo = true, bool $min = true): string
	{
		$file = str_replace('/', DIRECTORY_SEPARATOR, getcwd() . '/vendor/' . $uri . ($min ? '.min.js' : '.js'));
		if (!file_exists($file)) return '';

		$url = vendor_url($uri . ($min ? '.min.js' : '.js'));
		$tag = "<script type='text/javascript' src='{$url}'></script>" . PHP_EOL;
		if ($echo) echo $tag;

		return $tag;
	}
}

if (!function_exists('css'))
{
	/**
	 * @param string $uri
	 *
	 * @param bool   $echo
	 * @param bool   $min
	 * @return string
	 */
	function css(string $uri = '', bool $echo = true, bool $min = true): string
	{
		$file = str_replace('/', DIRECTORY_SEPARATOR, getcwd() . '/assets/css/' . $uri . ($min ? '.min.css' : '.css'));
		if (!file_exists($file)) return '';

		$url = assets_url('css/' . $uri . ($min ? '.min.css' : '.css'));
		$tag = "<link rel='stylesheet' href='{$url}'>" . PHP_EOL;
		if ($echo) echo $tag;

		return $tag;
	}
}
if (!function_exists('vendor_css'))
{
	/**
	 * @param string $uri
	 *
	 * @param bool   $echo
	 * @param bool   $min
	 * @return string
	 */
	function vendor_css(string $uri = '', bool $echo = true, bool $min = true): string
	{
		$file = str_replace('/', DIRECTORY_SEPARATOR, getcwd() . '/vendor/' . $uri . ($min ? '.min.css' : '.css'));
		if (!file_exists($file)) return '';

		$url = vendor_url($uri . ($min ? '.min.css' : '.css'));
		$tag = "<link rel='stylesheet' href='{$url}'>" . PHP_EOL;
		if ($echo) echo $tag;

		return $tag;
	}
}
if (!function_exists('img'))
{
	/**
	 * @param string $uri
	 * @param string $class
	 * @param string $alt
	 * @param string $style
	 * @param bool   $tag
	 * @param bool   $echo
	 * @return string
	 */
	function img(string $uri = '', string $class = '', string $alt = '', string $style = '', bool $tag = true, bool $echo = true): string
	{
		$file = str_replace('/', DIRECTORY_SEPARATOR, getcwd() . '/assets/img/' . $uri);
		if (!file_exists($file)) return '';

		$url = assets_url('img/' . $uri);
		if ($tag)
		{
			$t = "<img class='{$class}' src='{$url}' alt='{$alt}' style='{$style}' />";
			if ($echo) echo $t;

			return $t;
		}

		if ($echo) echo $url;

		return $url;
	}
}

if (!function_exists('img_url'))
{
	/**
	 * @param string $uri
	 * @return string
	 */
	function img_url(string $uri = ''): string
	{
		$file = str_replace('/', DIRECTORY_SEPARATOR, getcwd() . '/assets/img/' . $uri);
		if (!file_exists($file)) return '';

		$url = assets_url('img/' . $uri);

		return $url;
	}
}

if (!function_exists('img_uploaded_url'))
{
	/**
	 * @param string $uri
	 * @return string|null
	 */
	function img_uploaded_url($uri = '')
	{
		return !empty($uri) ? site_url("assets/img/uploads/{$uri}") : site_url("assets/img/uploads");
	}
}
