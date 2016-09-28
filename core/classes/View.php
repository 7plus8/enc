<?php
class View
{
	private $_pageVars = array();
	private $_template;

	public function __construct($template)
	{
		$this->_template = APP_DIR .'views/'. $template .'.php';
	}

	public function set($var, $val = null)
	{
		if (isset($val) && $val != null)
		{
			$this->_pageVars[$var] = $val;
		}
		else
		{
			$this->set_vars($var);
		}
	}

	public function set_vars($data)
	{
		$this->_pageVars = $data;
	}

	public function render()
	{
		extract($this->_pageVars);

		ob_start();

		if (is_file($this->_template))
			require($this->_template);
		else
			Redirect::to(404);

		echo ob_get_clean();
	}
}