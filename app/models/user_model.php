<?php
class User_model extends Model
{
	private $_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;

	public function __construct($user = null)
	{
		global $config;
		parent::__construct();
		$this->_sessionName = $config['session_name']; //Config::get('session/session_name')
		$this->_cookieName = $config['cookie_name']; //Config::get('remember/cookie_name')

		if(!$user){
			if(Session::exists($this->_sessionName)){
				$user = Session::get($this->_sessionName);

				if($this->find($user)){
					$this->_isLoggedIn = true;
				}else{
					//process logout
				}
			}
		}else{
			$this->find($user);
		}
	}

	public function update($fields = array(), $id = null){

		if(!$id && $this->isLoggedIn()){
			$id = $this->data()->id;
		}
		if(!$this->db->update('users', $id, $fields)){
			throw new Exception ('There was a problem updating your details.');
		}
	}

	public function create()
	{
		$salt = Hash::salt(32);

		$fields = array(
			'name' => Input::get('name'),
			'username' => Input::get('username'),
			'email' => Input::get('email'),
			'password' => Hash::make(Input::get('password'), $salt),
			'salt' => $salt,
			'joined' => date('Y-m-d H:i:s'),
			'group' => 1
			);

		if(!$this->db->insert('users', $fields)){
			throw new Exception ('There was a problem creating an account.');
		}
	}

	public function find($user = null){
		if($user){
			$field = (is_numeric($user)) ? 'id' : 'username';
			$data = $this->db->get_where('users', array($field, '=', $user));

			if($data->count()){
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function find_user($user = null){
		if($user){
			$field = (is_numeric($user)) ? 'id' : 'username';
			$data = $this->db->get_where('users', array($field, '=', $user));

			if($data->count()){
				return $this->_data = $data->first();
			}
		}
		return;
	}

	public function login($username = null, $password = null, $remember = false){

		global $config;

		if(!$username && !$password && $this->exists()){
			Session::put($this->_sessionName, $this->data()->id);
		}else{
			$user = $this->find($username);

			if($user){
				if($this->data()->password === Hash::make($password, $this->data()->salt)){
					Session::put($this->_sessionName, $this->data()->id);

					if($remember){
						$hash = Hash::unique();
						$hashCheck = $this->db->get_where('users_session', array('user_id', '=', $this->data()->id));

						if(!$hashCheck->count()){
							$this->db->insert('users_session', array(
								'user_id' => $this->data()->id,
								'hash' => $hash
								));
						}else{
							$hash = $hashCheck->first()->hash;
						}

						Cookie::put($this->_cookieName, $hash, $config['cookie_expiry']); //Config::get('remember/cookie_expiry')
					}
					return true;
				}
			}
		}

		return false;
	}

	public function hasPermission($key){
		$group = $this->db->get_where('groups', array('id', '=', $this->data()->group));
		
		if($group->count()){
			$permissions = json_decode($group->first()->permissions, true);

			if($permissions[$key] == true){
				return true;
			}
		}
		return false;
	}
	
	public function exists(){
		return (!empty($this->_data)) ? true : false; 
	}

	public function logout(){
		$this->db->delete('users_session', array('user_id', '=', $this->data()->id));

		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}

	public function avatar_save($fields)
	{
		if(!$this->db->insert('images', $fields)){
			throw new Exception ('There was a problem saving the image.');
		}
	}

	public function avatar($id = null)
	{
		(!empty($id) && !is_null($id) && is_numeric($id)) ? $user_id = $id : $user_id = $this->data()->id;
		$data = $this->db->query("SELECT `path` FROM `images` WHERE `user_id` = {$user_id} and role = 'avatar' ORDER BY `id` DESC");

		if (!$data->count())
		{
			return $this->db->query("SELECT `path` FROM `images` WHERE `user_id` = 1 and role = 'avatar' ORDER BY `id` DESC")->first(); 
		}

		return $data->first();
	}

	public function data(){
		return $this->_data;
	}

	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}
}
?>