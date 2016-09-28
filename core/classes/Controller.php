<?php
class Controller
{
	public $load;

	public function __construct()
	{
		$this->load = load_class('Loader');
	}
	public function redirect($loc)
	{
		global $config;
		
		header('Location: '. $config['base_url'] . $loc);
	}
}