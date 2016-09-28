<?php
session_start();

spl_autoload_register(function($class)
{
	if ( is_file(CORE_DIR . 'classes/' . $class . '.php') )
	{
		require_once CORE_DIR . 'classes/' . $class.'.php';
	}
	elseif ( is_file(CORE_DIR . 'helpers/' . $class . '.php') )
	{
		require_once CORE_DIR . 'helpers/' . $class.'.php';
	}
	elseif ( is_file(APP_DIR . 'controllers/' . $class . '.php') )
	{
		require_once APP_DIR . 'controllers/' . $class.'.php';
	}
	elseif ( is_file(APP_DIR . 'models/' . $class . '.php') )
	{
		require_once APP_DIR . 'models/' . $class.'.php';
	}
});