<?php
class Loader
{
	protected $_models_path;
	protected $_views_path;

	public function view($name)
	{
		$view = new View($name);
		return $view;
	}
	public function model($name)
	{
		require APP_DIR . 'models/' . $name . '.php';

		$model = new $name;
		return $model;
	}

	public function plugin($name)
	{
		require(APP_DIR .'plugins/'. strtolower($name) .'.php');
	}
	
	public function helper($name)
	{
		require(CORE_DIR .'helpers/'. strtolower($name) .'.php');
		//$helper = new $name;
		//return $helper;
	}
}