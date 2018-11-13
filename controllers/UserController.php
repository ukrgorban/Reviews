<?php
include_once(ROOT.'/models/User.php');

class UserController{
	
	public function actionLogin(){
		$error = false;
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			
			if(!empty($_POST['login']) && !empty($_POST['password']) ){
				
				$user = User::checkData($_POST['login'], $_POST['password']);
				
				if(!$user){
					$error = true;
				}else{
					User::auth($user);
				}
				
			}else{
				
				$error = true;
				
			}
			
		}
		
		require_once(ROOT.'/views/user/login.php');

		return true;
	}
	
	public function actionLogout(){
		User::logOut();
	}
}