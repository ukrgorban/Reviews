<?php
include_once(ROOT.'/models/Reviews.php');
include_once(ROOT.'/components/Image.php');

class SiteController{
	
	public function actionIndex(){
		
		if(isset($_POST['sort']) && isset($_POST['direction'])){
			// cортировка
			$reviewsList = Reviews::getList($_POST['sort'], $_POST['direction']);
		}else{
			$reviewsList = Reviews::getList();
		}
		
		// отправка отзыва
		if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review'])){
			$name = strip_tags(trim($_POST['name']));
			$email = strip_tags(trim($_POST['email']));
			$text = strip_tags(trim($_POST['text']));
			
			/*echo '<pre>';
			print_r(time());*/
			
			// Флаг ошибок
			$errors = false;
			
			// Валидация полей
			if (!Reviews::checkName($name)) {
				$errors[] = 'Имя не должно быть короче 2-х символов';
			}
			if (!Reviews::checkEmail($email)) {
				$errors[] = 'Неправильный email';
			}
			if (!Reviews::checkText($text)) {
				$errors[] = 'Отзыв не должно быть короче 10-ти символов';
			}
			
			$fileNewName = null;
			// Проверим, загружалось ли через форму файл
			if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
				// узнаем разширение файла
				$file = $_FILES['img']['tmp_name']; 
				$sourceProperties = getimagesize($file);
				$folderPath = "images/";
				$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
				$imageType = $sourceProperties[2];
				$fileNewName = time().".".$ext;
				
				switch ($imageType) {
					case IMAGETYPE_PNG:
		
						if(Image::checkSize($sourceProperties[0], $sourceProperties[1])){
							$imageResourceId = imagecreatefrompng($file); 
							$targetLayer = Image::resize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $file);
							imagepng($targetLayer,$folderPath. $fileNewName);
							break;
						}else{
							move_uploaded_file($file, $folderPath. $fileNewName);
							break;
						}

					case IMAGETYPE_GIF:
					
						if(Image::checkSize($sourceProperties[0], $sourceProperties[1])){
							$imageResourceId = imagecreatefromgif($file); 
							$targetLayer = Image::resize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $file);
							imagegif($targetLayer,$folderPath. $fileNewName);
							break;
						}else{
							move_uploaded_file($file, $folderPath. $fileNewName);
							break;
						}

					case IMAGETYPE_JPEG:
					
						if(Image::checkSize($sourceProperties[0], $sourceProperties[1])){
							$imageResourceId = imagecreatefromjpeg($file); 
							$targetLayer = Image::resize($imageResourceId,$sourceProperties[0],$sourceProperties[1], $file);
							imagejpeg($targetLayer,$folderPath. $fileNewName);
							break;
						}else{
							move_uploaded_file($file, $folderPath. $fileNewName);
							break;
						}

					default:
						$errors[] = 'Файл должен быть JPG, GIF, PNG формата';
						break;
				}
            }
			
			if ($errors === false) {
				if(!$fileNewName){
					$fileNewName = '';
				}
				$isAddItem = Reviews::addItem($name, $email, $text, $fileNewName);
				
				// если добавился отзыв
				if($isAddItem){
					$name = null;
					$email = null;
					$text = null;
				}
			}
		}
		
		require_once(ROOT.'/views/site/index.php');

		return true;
	}

}