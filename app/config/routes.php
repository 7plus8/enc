<?php
	$route = new Router();

	$route->add('default_controller', "main");
	$route->add('blog/article/new', "post#_new");
	$route->add('blog/article/new/create', "post#create");
	$route->add('blog/article/comment/add', "post#add_comment");
	$route->add('blog/article/(:any)', "post#view#$1");
	//$route->add('blog/p/(:num)', "post#page#$1");
	$route->add('blog', "post");
	$route->add('home', "page#home");
	$route->add('register', "user#reg");
	$route->add('login', "user#signin");
	$route->add('login_attempt', "user#login");
	$route->add('admin', "user#is_admin");
	$route->add('user/update', "user#update");
	$route->add('user/change_pass', "user#change_password");
	$route->add('user/logout', "user#logout");
	$route->add('user/avatar', "page#avatar#$1");
	$route->add('user/set_avatar', "user#avatar");
	$route->add('user/(:any)', "page#profile#$1");
	$route->add('user/(:any)/update', "page#update#$1");
	$route->add('register/create', "user#register");
	$route->add('error_controller', "exceptions");
	$route->add('(:any)', "page#view#$1");/*, function(){echo "This me page";}*/

	$route->parse_routes();
//Traffaut DIY keffiyeh, twee messenger bag venno organic master clense marfa gochunjang selve
