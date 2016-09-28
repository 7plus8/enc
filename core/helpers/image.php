<?php
class Image extends Media
{
    protected $_width;
    protected $_height;
    protected $_metadata;
    protected $_dimension = array();
    protected $_mime_types = array('jpeg', 'gif', 'png');
    protected $_mime = array(
        1 => "gif", "jpeg", "png", "swf", "psd",
        "bmp", "tiff", "tiff", "jpc", "jp2", "jpx",
        "jb2", "swc", "iff", "wbmp", "xbm", "ico"
        );

    public function __construct($files)
    {
        parent::__construct($files);
    }

    public function set_dimension($maxWidth, $maxHeight)
    {
        $this->_dimension = array($maxWidth, $maxHeight);
        return $this;
    }

    public function get_height()
    {
        if ($this->_height != null) 
        {
            return $this->_height;
        }

        list(, $height) = getImageSize($this->_files["tmp_name"]); 
        return $height;
    }

    public function get_width()
    {
        if ($this->_width != null) 
        {
            return $this->_width;
        }

        list($width) = getImageSize($this->_files["tmp_name"]); 
        return $width;
    }

    public function set_mime(array $file_types)
    {
        $this->_mime_types = $file_types;
        return $this;
    }

    public function json_metadata()
    {
        return json_encode($this->_metadata);
    }

    public function metadata()
    {
        return json_decode($this->json_metadata());
    }

    public function get_image_mime($tmp_name)
    {
        if (isset($this->_mime[exif_imagetype($tmp_name)])) {
            return $this->_mime[exif_imagetype($tmp_name)];
        }
        return false;
    }

    public function upload()
    {
        if( $this->_error = $this->upload_errors($this->files()['error']))
        {
            echo $this->_error;
            return;
        }

        $this->_name = $this->get_name();
        $this->_path = $this->get_full_path();
        $this->_width = $this->get_width();
        $this->_height = $this->get_height();
        $this->_location = $this->get_location();
        
        $this->_ext = $this->get_image_mime($this->_files['tmp_name']);

        if ( !in_array($this->_ext, $this->_mime_types) )
        {
            $ext = implode(", ", $this->_mime_types);
            $this->_error = "Invalid File! Only ($ext) image types are allowed";
            return ;
        }

        if(!empty($this->_size))
        {
            list($minSize, $maxSize) = $this->_size;
            if ($this->_files['size'] < $minSize || $this->_files['size'] > $maxSize) 
            {
                $min = intval($minSize / 1024) ?: 1; $max = intval($maxSize / 1024);

                $this->_error = "Image size should be atleast more than min: $min and less than max: $max kb";
                return ;
            }
        }

        if ( !empty($this->_dimension) )
        {
            list($maxWidth, $maxHeight) = $this->_dimension;

            if ($this->_height > $maxHeight || $this->_width > $allowedWidth) 
            {
                $this->_error = "Image width/height should be less than ' $maxWidth/$maxHeight ' pixels";
                return;
            }

            if($this->_height < 4 || $this->_width < 4)
            {
                $this->_error = "Invalid! Image width/height is too small or maybe corrupted"; 
                return;
            }
        }
        
        $this->_path = $this->_location . "/" . $this->_name. "." . $this->_ext;

        $this->_metadata = array(
            'name' => $this->_name,
            'mime' => $this->get_image_mime($this->_files['tmp_name']),
            'height' => $this->_height,
            'width' => $this->_width,
            'size' => $this->_size,
            'location' => $this->_location,
            "path" => $this->_path
            );
        if ( $this->_error === "" ){
           $upload = $this->move_file($this->_files['tmp_name'], $this->_path);
           if (false != $upload) 
           {
               return $this;
           }
           $this->_error = "Upload failed, unknown error occured";
           return false;
        }
    }
}
?>