<?php
function escape($string){
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function load_class($class, $params = NULL)
{
	if (isset($class)) {
		return new $class($params);
	}
	else
	{
		echo "Error: Class not set";
	}
}

function show_404()
{
	die('Error 404');
}

function base_url()
{
	global $config;
	return 'http://' . $config['base_url'];
}

function body_tag_class()
{
		if (isset($_GET['uri']))
		{
			$uri = $_GET['uri'];
			$parts = explode('/', $uri);
			$x = count($parts);
			if ( $x === 1 )
			{
				$class = $parts[0];
			}
			elseif( $parts >= 2 )
			{
				$class = $parts[0] . '-' . $parts[1];
			}

			return 'class="' . $class . '"';

		}
}