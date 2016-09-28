<?php
class User extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function reg()
	{
		$template = $this->load->view('register');
		$template->set('title', 'Register | Excel Nutritional Cures');
		$template->render();
	}

	public function avatar()
	{
		$user = $this->load->model('user_model');
		$image = load_class('Image', $_FILES['file']);
		$upload = $image->upload();
		echo "<pre>";
		print_r($image->metadata());
		if ( $upload )
		{
			try{
				$data = array(
					'user_id' => $user->data()->id,
					'name' => $image->get_name(),
					'thumb' => "thumb",
					'path' => $image->get_full_path(),
					'parent' => "0",
					'role' => "avatar",
					'date_time' => date("Y-m-d H:i:s")
					);
				$user->avatar_save($data);

				Session::flash('profile', 'Avatar changed successfully!');
				Redirect::to('http://excelcures/user/' . $user->data()->username);

			}catch(Exception $e){
				die($e->getMessage());
				//redirect user to another page
			}

		}
	}

	public function login()
	{
		if(Input::exists()){
			if(Token::check(Input::get('token'))){

				$validate = new Validate();
				$validation = $validate->check($_POST, array(
					'username' => array(
						'disp_text' => 'Username',
						'required' => true
						),
					'password' => array(
						'disp_text' => 'Password',
						'required' => true
						)
					));

				if($validation->passed()){

					$user = $this->load->model('user_model');

					$remember = (Input::get('remember') === 'on') ? true : false;
					$login = $user->login(Input::get('username'), Input::get('password'), $remember);

					if($login){
						Redirect::to(base_url().'/home');
					}else{
						echo '<p>Sorry, name or password is incorrect.</p>';
					}

				}else{

					foreach($validation->errors() as $error){
						echo $error, '<br/>';
					}

				}
			}
		}
	}

	public function logout()
	{
		$user = $this->load->model('user_model');
		$user->logout();

		Session::flash('logout', 'You are now logged out.');
		Redirect::to(base_url() . '/login');
	}

	public function signin()
	{
		$template = $this->load->view('login');
		$template->set('title', 'Login | Excel Nutritional Cures');
		$template->render();
	}

	public function change_password()
	{
		if(Input::exists()){
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'password' => array(
					'disp_text' => 'Current Password',
					'required' => true,
					'min' => 6
					),
				'password_new' => array(
					'disp_text' => 'New Password',
					'required' => true,
					'min' => 6
					),
				'password_new_again' => array(
					'disp_text' => 'Confirm Password',
					'required' => true,
					'matches' => 'password_new'
					)
				));

			if($validation->passed()){
				$user = $this->load->model('user_model');
				if(Hash::make(Input::get('password'), $user->data()->salt) !== $user->data()->password){
					echo 'Your current password is wrong.';
				}else{
					$salt = Hash::salt(32);

					try{

						$user->update(array(
							'password' => Hash::make(Input::get('password_new'), $salt),
							'salt' => $salt
							));

						Session::flash('success', 'Your password has been changed!');
						Redirect::to($_SERVER['HTTP_REFERER']);

					}catch(Exception $e){
						die($e->getMessage());
					//redirect user to another page
					}
				}

			}else{
				foreach($validation->errors() as $error)
				{
					Session::flash('error', $error);
					Redirect::to($_SERVER['HTTP_REFERER']);
				}
			}
		}
	}

	public function update()
	{
		if(Input::exists()){
			if(Token::check(Input::get('token1'))){
				echo "string";
				$validate = new Validate();
				$validation = $validate->check($_POST, array(
					'name' => array(
						'disp_text' => 'Name',
						'required' => true,
						'min' => 2,
						'max' => 50
						),
					'username' => array(
						'disp_text' => 'Username',
						'required' => true,
						'min' => 4,
						'max' => 50
						),
					'email' => array(
						'disp_text' => 'Email',
						'required' => true,
						'min' => '5'
						),
					'phone' => array(
						'disp_text' => 'Phone number'
						),
					'bio' => array(
						'disp_text' => 'Bio'
						)
					)
				);

				if($validation->passed()){

					try{

						$user = $this->load->model('user_model');
						$user->update(array(
							'username' => Input::get('username'),
							'name' => Input::get('name'),
							'email' => Input::get('email'),
							'phone' => Input::get('phone'),
							'bio' => Input::get('bio')
							)
						);

						Session::flash('alert', 'Your details have been updated.');
						Redirect::to(base_url() . '/user/' . $user->data()->username);

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

	public function register()
	{
		if(Input::exists()){
			if(Token::check(Input::get('token'))){
				$validate = new Validate();
				$validation = $validate->check($_POST, array(
					'name' => array(
						'disp_text' => 'Name',
						'required' => true,
						'min' => 2
						),
					'username' => array(
						'disp_text' => 'Username',
						'required' => true,
						'unique' => 'users'
						),
					'email' => array(
						'disp_text' => 'Email',
						'required' => true,
						'max' => 255,
						'unique' => 'users'
						),
					'password' => array(
						'disp_text' => 'Password',
						'required' => true,
						'min' => 6
						)
					));

				if($validation->passed()){
					try{
						$this->load->model('user_model')->create();

						Session::flash('blog', 'Success!');
						Redirect::to('http://' . base_url() . '/blog');

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
?>
