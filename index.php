<?php
define('DS', DIRECTORY_SEPARATOR);

define('ROOT_DIR', realpath(dirname(__FILE__)) . DS);
define('CORE_DIR', ROOT_DIR . 'core' . DS);
define('APP_DIR', ROOT_DIR . 'app' . DS);
define('VIEWS_DIR', APP_DIR . 'views' . DS);
define('ADMIN_DIR',  VIEWS_DIR . 'admin' . DS);
define('UTF8_ENABLED', TRUE);


require_once APP_DIR . 'config/config.php';

require_once 'core/config/init.php';

require_once CORE_DIR . 'helpers/func.php';

global $config;

define('BASE_URL', $config['base_url']);

require_once APP_DIR . 'config/routes.php';
