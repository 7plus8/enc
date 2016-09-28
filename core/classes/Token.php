<?php
class Token{
	public static function generate(){
		global $config;
		return Session::put($config['token_name'], md5(uniqid()));
	}

	public static function check($token){
		global $config;
		$tokenName = $config['token_name'];

		if(Session::exists($tokenName) && $token === Session::get($tokenName)){
			Session::delete($tokenName);
			return true;
		}
		return false;
	}
}