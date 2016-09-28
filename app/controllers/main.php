<?php

class Main extends Controller
{
	public function index()
	{
		$user = $this->load->model('user_model');
		if ($user->isloggedIn())
		{
			if ($user->hasPermission('admin')) 
			{
				$data['avatar'] = $user->avatar()->path;
				$data['loc'] = '<i class="fa fa-dashboard"></i> Dashboard';
				$data['url'] = base_url().'/home';
				$data['admin_bar'] = ADMIN_DIR . 'admin_header.php';
			}
		}

		/*$date = date("d");
		switch ($date) {
			case 18:
				$location = "Nakuru";
				break;
			
			default:
				$location = "Nairobi";
				break;
		};*/

		//$data['location'] = $location;
		$data['user'] = $user->data();
		$data['articles'] = $this->load->model('post_model')->get_articles_highlights();
		$data['title'] = "Excel Nutritional Cures";

		$template = $this->load->view('main_view');
		$template->set($data);
		$template->render();
	}
}