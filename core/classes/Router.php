<?php

class Router
{
	private $_routes = array();
	private $_method = array();
	private $_controller;
	private $_action = 'index';
	private $_argument;
	private $_default_controller;
	private $_uri_seg = array();

	public function set_routing()
	{
		if (isset($this->_routes) && is_array($this->_routes))
		{
			isset($this->_routes['default_controller']) && $this->_default_controller = $this->_routes['default_controller'];
		}
	}

	public function add($route, $method = null)
	{
		$routes = '/' . trim($route, '/') . '/';
		if($method != null)
		{
			$this->_method[] = $method;
		}

		$this->_routes[$route] = $method;
		$this->set_routing();

	}

	public function parse_routes()
	{		
		//Get the URI string
		$uriGetParam = isset($_GET['uri']) ? $_GET['uri'] : '/';

		//Get Http_verb
		$http_verb = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'cli';

		//Loop through the routes looking for wildcards
		foreach ($this->_routes as $key => $val)
		{
			// Check if route format is using http verbs
			if (is_array($val))
			{
				$val = array_change_key_case($val, CASE_LOWER);
				if(isset($val[$http_verb]))
				{
					$val = $val[$http_verb];
				}
				else
				{
					continue;
				}
			}

			//Convert wildcard to regEx
			$key = str_replace(array(':any', ':num', 'default_controller'), array('[^/]+', '[0-9]+', '/'), $key);
			//Check if the regEx match
			if ( preg_match('#^'.$key.'$#', $uriGetParam, $matches) )
			{
				//Are we using callbacks to proces back-references?
				if( ! is_string($val) && is_callable($val))
				{
					//Remove the original string from the matches array.
					array_shift($matches);

					// Execute the callback using the values in matches as its parameters.
					$val = call_user_func_array($val, $matches);
				}
				// Are we using the default routing method for back-reference?
				elseif ( strpos($val, '$') !== FALSE && strpos($key, '(') !== FALSE )
				{
					$val = preg_replace('#^'.$key.'$#', $val, $uriGetParam);
				}	
				$this->_submit_request(explode('#', $val));
				return;
			}
		}

		//If we got this far it means we didnt encounter a 
		//matching route so we'll set the site default route
		$segments = explode("#", $val);
		$this->_submit_request(array_values($segments));
	}

	public function _submit_request($parts = array())
	{
		if ( empty($parts) )
		{
			$this->set_default_controller();
			return;
		}

		$this->set_controller($parts[0]);
		if (isset($parts[1]))
		{
			$this->set_action($parts[1]);
		}
		else
		{
			$parts[1] = 'index';
		}

		array_unshift($parts, NULL);
		unset($parts[0]);
		$this->_uri_seg = $parts;

		$path = APP_DIR . 'controllers/' . $this->_controller . '.php';
		
		if ( file_exists($path) )
		{
			require_once $path;
		}
		else
		{
			//show Error 404
			die("Error 404");
		}

		//Check if the method/action exists
		if ( ! method_exists($this->_controller, $this->_action) )
		{
			//show error 404
			die("Error 404");
		}

		$obj = new $this->_controller;
		die(call_user_func_array(array($obj, $this->_action), array_slice($parts, 2)));
	}

	public function set_default_controller()
	{
		if ( empty($this->_default_controller) )
		{
			echo "Unable to determine what should be displayed. A default route has not been specified in the routing file.";
		}

		if ( sscanf($this->_default_controller, '%[^/]/%s', $controller, $action) !==2 )
		{
			$action = 'index';
		}

		$this->set_controller($controller);
		$this->set_action($action);

		$this->_uri_seg = array(
			1 => $controller,
			2 => $action
		);
	}

	public function set_controller($controller)
	{
		$this->_controller = $controller;
	}

	public function set_action($action)
	{
		$this->_action = $action;
	}
}