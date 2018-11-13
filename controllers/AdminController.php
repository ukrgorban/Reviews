<?php
include_once(ROOT.'/models/Reviews.php');
include_once(ROOT.'/models/User.php');

class AdminController{
	
	public function actionIndex(){
		
		if(!User::isAdmin()){
			header("Location: /login/");
		}
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			if($_POST['reject'] == 1){
				Reviews::elementDeactivate($_POST['id']);
			}else{
				Reviews::elementActivate($_POST['id']);
			}
		}
		
		$allReviewsList = Reviews::getAllList();
		
		require_once(ROOT.'/views/admin/index.php');

		return true;
	}
	public function actionUpdate($id){
		
		if(!User::isAdmin()){
			header("Location: /login/");
		}
		
		$review = Reviews::getElementById($id);
		
		/*echo "<pre>";
		print_r($_POST);*/
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$options = array();
			
			$options['text'] = strip_tags(trim($_POST['text']));
			$options['edited'] = 1;
			
			$result = Reviews::updateElementById($id, $options);
			
			if($result){
				header('Location: /admin/');
			}
		}
		require_once(ROOT.'/views/admin/update.php');

		return true;
	}
	
}