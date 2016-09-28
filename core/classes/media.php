<?php 
class Media implements \ArrayAccess
{
	public $load;
	protected$_files = array();
	protected $_name;
    protected $_size = array();
    protected $_location;
    protected $_path;
    protected $_ext;
    protected $_error = "";
	
	public function __construct($files)
	{
		$this->load = load_class('Loader');

		$this->_files = $files;
	}

	public function offsetSet($offset, $value){}
    
    public function offsetExists($offset){}
    
    public function offsetUnset($offset){}

    public function offsetGet($offset)
    {
        if ($offset == "error") {
            return $this->_error;
        }

        if (isset($this->_files[$offset]) && file_exists($this->_files[$offset]["tmp_name"])) {
            $this->_files = $this->_files[$offset];
            return true;
        }
        
        return false;
    }

	public function set_name($name = null)
	{
		if ($name)
		{
			$this->_name = $name;
		}
		return $this;
	}

	public function set_location($dir = 'app/views/assets/uploads', $permission = 0666)
	{
		if ( !file_exists($dir) && !is_dir($dir) && !$this->_location )
		{
			$createFolder = @mkdir("" . $dir, (int) $permission, true);
			if ( !$createFolder )
			{
				$this->_error = "Folder " . $dir . " could not be created";
				return;
			}
		}
		$this->_location = $dir;
		return $this;
	}

	public function get_name()
	{
		if ( !$this->_name )
		{
			return uniqid(true) . "_" . date("Ymd") . "_" . date("His");
		}

		return $this->_name;
	}

	public function get_full_path()
	{
		$this->_path = $this->_location . "/" . $this->_name . "." . $this->_ext;
		return $this->_path;
	}

	public function get_size()
	{
		return (int) $this->_files['size'];
	}

	public function files()
	{
		return $this->_files;
	}

	public function get_location()
	{
		if ( !$this->_location )
		{
			$this->set_location();
		}
		return $this->_location;
	}

	public function get_mime()
	{
		return $this->_ext;
	}

	public function get_error()
	{
		return $this->_error != "" ? $this->_error : false;
	}

	protected function upload_errors($e)
    {
        $errors = array(
            UPLOAD_ERR_OK           => "",
            UPLOAD_ERR_INI_SIZE     => "File is larger than the specified amount set by the server",
            UPLOAD_ERR_FORM_SIZE    => "File is larger than the specified amount specified by browser",
            UPLOAD_ERR_PARTIAL      => "File could not be fully uploaded. Please try again later",
            UPLOAD_ERR_NO_FILE      => "File is not found",
            UPLOAD_ERR_NO_TMP_DIR   => "Can't write to disk, due to server configuration ( No tmp dir found )",
            UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk. Please check you file permissions",
            UPLOAD_ERR_EXTENSION    => "A PHP extension has halted this file upload process"
        );
        return $errors[$e];
    }

    public function move_file($tmp_name, $destination)
    {
        return move_uploaded_file($tmp_name, $destination);
    }
}
?>