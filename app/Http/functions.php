<?php

if (!function_exists('get_date'))
{
	function get_date($str, $format="F j, Y H:m")
	{
		if (strtotime($str))
		{
			return date_format( date_create( $str ), $format );
		}
	}
}

if (!function_exists('make_assoc'))
{
	function make_assoc($array)
	{
		$return = [];

		foreach ($array as $row)
		{
			$return[$row] = $row;
		}

		return $return;
	}
}

if (!function_exists('make_obj_array'))
{
	function make_obj_array($array)
	{
		$return = [];

		foreach ($array as $key => $row)
		{
			$return[$key] = (object)$row;
		}

		return $return;
	}
}


if (!function_exists('make_assoc_from_model'))
{
	function make_assoc_from_model($array, $key, $field)
	{
		$return = [];

		foreach ($array as $row)
		{
			$return[$row->{$key}] = $row->{$field};
		}

		return $return;
	}
}

if (!function_exists('str'))
{
	function str($str)
	{
		return $str != '' ? $str : '--';
	}
}

if (!function_exists('shorten'))
{
	function shorten($str, $length)
	{
		if (strlen($str) > $length-3) {
			return substr($str, 0, $length-3) . '...';
		}

		return $str;
	}
}

if (!function_exists('can'))
{
	function can($arr1, $arr2=false)
	{
		if (\Auth::check())
		{
			if($arr2===false)
			{
				$arr2 = ['admin'];
			}

			if (is_string($arr1))
			{
				$arr1 = [$arr1];
			}

			return \Auth::user()->ability($arr2, $arr1);
		}

		return false;
	}
}


