<?php
class Page extends Controller
{
	public function __costruct()
	{
		parent::__costruct();
	}

	public function home()
	{
		$post = $this->load->model('post_model');
		$user = $this->load->model('user_model');
		if ($user->isloggedIn())
		{
			if ($user->hasPermission('admin')) 
			{
				$data['avatar'] = $user->avatar()->path;
 				$data['loc'] = '<i class="fa fa-home"></i> ENC';
				$data['url'] = base_url();
				$data['admin_bar'] = ADMIN_DIR . 'admin_header.php';
			}
		}
		$data['avatar'] = $user->avatar()->path;
		$data['post_count'] = $post->articles();
		$data['comment_count'] = $post->get_comments();
		$data['user'] = $user->data();
		$data['title'] = 'Home | Excel Nutritional Cures';
		$data['users_count'] = '';

		$template = $this->load->view('admin/index');
		$template->set($data);
		$template->render();
	}

	public function profile($username = NULL)
	{
		if(empty($username))
		{
			Redirect::to(base_url() . '/home');
		}

		$user = $this->load->model('user_model');
		if (!$user->isloggedIn())
		{
			Redirect::to(base_url() . '/login');
		}

		if ($user->isloggedIn())
		{
				$data['avatar'] = $user->avatar()->path;
				$data['loc'] = '<i class="fa fa-home"></i> ENC';
				$data['url'] = base_url();
				$data['admin_bar'] = ADMIN_DIR . 'admin_header.php';
		}

		//$username = $user->data()->username;
		$data['user'] =  $user->data();
		$data['_user'] = $user->find_user($username);
		$data['_avatar'] = $user->avatar($data['_user']->id)->path;
		$data['title'] = $data['_user']->username . ' | Excel Nutritional Cures';

		$template = $this->load->view('admin/profile');
		$template->set($data);
		$template->render();
	}

	public function update($username = NULL)
	{
		if(is_null($username))
		{
			Redirect::to(base_url() . '/home');
		}

		$user = $this->load->model('user_model');
		if (!$user->isloggedIn())
		{
			Redirect::to(base_url());
		}

		if ($user->isloggedIn())
		{
			$data['avatar'] = $user->avatar()->path;
			$data['url'] = base_url();
			if ($user->hasPermission('admin')) 
			{
				$data['loc'] = '<i class="fa fa-home"></i> ENC';
				$data['url'] = base_url();
				$data['admin_bar'] = ADMIN_DIR . 'admin_header.php';
			}
		}	

		$data['avatar'] = $user->avatar()->path;
		$data['user'] = $user->data();
		$data['title'] = 'Update' . ' | Excel Nutritional Cures';

		$template = $this->load->view('admin/update');
		$template->set($data);
		$template->render();
	}

	public function avatar()
	{
		$user = $this->load->model('user_model');
		if (! $user->isLoggedIn())
		{
			Redirect::to(base_url());
		}

		if ($user->isloggedIn())
		{
			if ($user->hasPermission('admin')) 
			{
				$data['avatar'] = $user->avatar()->path;
				$data['loc'] = '<i class="fa fa-home"></i> ENC';
				$data['url'] = base_url();
				$data['admin_bar'] = ADMIN_DIR . 'admin_header.php';
			}
		}	

		$data['user'] = $user->data();
		$data['title'] = 'Avatar' . ' | Excel Nutritional Cures';

		$template = $this->load->view('admin/avatar');
		$template->set($data);
		$template->render();
	}
}