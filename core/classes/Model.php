<?php
class Model
{
	public $db;
	public static $_db;
	private static $instance;
	public $load;

	public function __construct()
	{
		self::$_db = DB::getInstance();
		$this->db = DB::getInstance();
		$this->load = load_class('Loader');
	}

	public static function getInstance()
	{
		if ( ! isset(self::$instance) )
		{
			self::$instance = new Model;
		}

		return self::$instance;
	}
}