<?php
class Post Extends Controller
{
	public static $page;

	public function __construct()
	{
		parent::__construct();
	}
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
		$posts = $this->load->model('post_model');
		$data['user'] = $user->data();
		$data['articles'] = $posts->get_articles();
		$data['title'] = 'Excel Nutritional Cures | Blog';

		$template = $this->load->view('blog/index');
		$template->set($data);
		$template->render();
	}

	public function view($slug = NULL)
	{
		$user = $this->load->model('user_model');
		$data['disabled'] = '';
		if ($user->isloggedIn())
		{
			$data['user'] = $user->data();
			$data['disabled'] = 'disabled="disabled"';
			if ($user->hasPermission('admin'))
			{
				$data['avatar'] = $user->avatar()->path;
				$data['loc'] = '<i class="fa fa-dashboard"></i> Dashboard';
				$data['url'] = base_url().'/home';
				$data['admin_bar'] = ADMIN_DIR . 'admin_header.php';
			}
		}
		$model = $this->load->model('post_model');
		$data['_article'] = $model->get_articles($slug);
		$data['_user'] = $user->find_user($data['_article']->user_id);
		$data['comments'] = $model->get_comments();
		$data['_avatar'] = $user->avatar($data['_article']->user_id)->path;

		if ( empty($data['_article']) )
		{
			show_404();
		}

		$data['title'] = 'Excel Nutritional Cures' . $data['_article']->title;

		$template = $this->load->view('blog/article');
		$template->set($data);
		$template->render();

	}

	public function add_comment()
	{
		if(Input::exists()){
			if(Token::check(Input::get('token'))){
				$validate = new Validate();
				$validation = $validate->check($_POST, array(
					'comment' => array(
						'disp_text' => 'Comment',
						'required' => true,
						//'unique' => 'posts'
						'min'	=>	'4'
						),
					'username' => array(
						'disp_text' => 'Name',
						'required' => true,
						//'min' => 10
						),
					'email' => array(
						'disp_text' => 'Email',
						'required' => true
						)
					));

				if($validation->passed()){
					try{
						$data = array(
							'name' => Input::get('username'),
							'email' => Input::get('email'),
							'comment' => Input::get('comment'),
							'post_id' => Input::get('post_id'),
							'posted' => date('Y-d-m H:i:s')
						);
						$this->load->model('post_model')->add_comment($data);

						Session::flash('comment', 'Success!');
						Redirect::to($_SERVER['HTTP_REFERER']);

					}catch(Exception $e){
						die($e->getMessage());
						//redirect user to another page
					}
				}else{
					foreach($validation->errors() as $error){
						Session::flash('comment', $error.'<br />');
						Redirect::to($_SERVER['HTTP_REFERER']);
					}
				}
			}
		}
	}

	public function _new()
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
		$data['user'] = $user->data();
		$data['title'] = "New article";
		$template = $this->load->view('blog/new_post');
		$template->set($data);
		$template->render();
	}

	public static function page($page = null){
		if (isset($page) && is_numeric($page))
		{
			self::$page = $page;
			return true;
		}
		return false;
	}

	public function create()
	{
		if(Input::exists()){
			if(Token::check(Input::get('token'))){
				$validate = new Validate();
				$validation = $validate->check($_POST, array(
					'post_title' => array(
						'disp_text' => 'Title',
						'required' => true,
						//'unique' => 'posts'
						),
					'post_body' => array(
						'disp_text' => 'Body',
						'required' => true,
						'min' => 10
						)
					));

				if($validation->passed()){
					try{
						$user = $this->load->model('user_model');
						$this->load->helper('url');
						$data = array(
							'title' => Input::get('post_title'),
							'text' => Input::get('post_body'),
							'slug' => url_title(Input::get('post_title'), 'dash', TRUE),
							'user_id' => $user->data()->id,
							'posted' => date('Y-m-d H:i:s')
						);
						$this->load->model('post_model')->set_article($data);

						Session::flash('blog', 'Success!');
						Redirect::to('http://excelcures/blog');

					}catch(Exception $e){
						die($e->getMessage());
						//redirect user to another page
					}
				}else{
					foreach($validation->errors() as $error){
						echo $error, '<br/>';
					}
				}
			}
		}
	}
}
