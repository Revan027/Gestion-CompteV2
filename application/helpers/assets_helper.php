<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_url'))
{
	function css_url($nom)
	{
		return base_url() . 'assets/css/' . $nom . '.css';
	}
}

if ( ! function_exists('js_url'))
{
	function js_url($nom)
	{
		return base_url() . 'assets/js/' . $nom . '.js';
	}
}

if ( ! function_exists('ofx_url'))
{
	function ofx_url($nom)
	{
		return 'C:/Users/TOSHIBA/Downloads/'.$nom;
	}
}
if ( ! function_exists('file_data_url'))
{
	function file_data_url()
	{
		return './assets/file_data/';
	}
}
if ( ! function_exists('xml_url'))
{
	function xml_url($nom)
	{
		return './assets/file_data/' . $nom;
	}
}
if ( ! function_exists('img_url'))
{
	function img_url($nom)
	{
		return base_url() . 'assets/images/' . $nom;
	}
}

if ( ! function_exists('img'))
{
	function img($nom, $alt = '')
	{
		return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
	}
}