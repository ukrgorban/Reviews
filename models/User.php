<?php

class User{
	
	public static function auth($user){
		
		$_SESSION['userId'] = $user['id'];
		$_SESSION['userLogin'] = $user['login'];
		
		header('Location: /admin/');
	}
	
	public static function checkData($login, $password){
		$db = Db::getConnection();
		
		$sql = "SELECT id, login, password FROM user WHERE login = :login AND password = :password";
		
		$result = $db->prepare($sql);
		$result->bindParam(':login', $login, PDO::PARAM_INT);
		$result->bindParam(':password', $password, PDO::PARAM_INT);
		$result->execute();
		
		$user = $result->fetch();
		
		if($user){
			return $user;
		}
		
		return false;
	}
	
	public static function logOut(){
		unset($_SESSION[userId]);
		unset($_SESSION[userLogin]);
		header('Location: /');
	}

	public static function isAdmin(){
		
		if($_SESSION['userLogin'] === 'admin'){
			return true;
		}
		
		return false;
	} 
}