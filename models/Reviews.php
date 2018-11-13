<?php

class Reviews{
	
	public static function getList($sort = 'date', $direction = 'DESC'){
		$db = Db::getConnection();
		
		$list = array();
		
		$result = $db->query(
			"SELECT 
			id, 
			img, 
			name, 
			text, 
			email, 
			date, 
			published, 
			edited
			FROM reviews
			WHERE published=1
			ORDER BY $sort $direction"
		);
		
		$i = 0;
		while($row = $result->fetch()) {
			$list[$i]['id'] = $row['id'];
			$list[$i]['img'] = $row['img'];
			$list[$i]['name'] = $row['name'];
			$list[$i]['text'] = $row['text'];
			$list[$i]['email'] = $row['email'];
			$list[$i]['date'] = $row['date'];
			$list[$i]['published'] = $row['published'];
			$list[$i]['edited'] = $row['edited'];
			$i++;
		}
		
		return $list;
	}
	
	public static function getAllList($sort = 'date', $direction = 'DESC'){
		$db = Db::getConnection();
		
		$list = array();
		
		$result = $db->query(
			"SELECT 
			id, 
			img, 
			name, 
			text, 
			email, 
			date, 
			published, 
			edited
			FROM reviews
			ORDER BY $sort $direction"
		);
		
		$i = 0;
		while($row = $result->fetch()) {
			$list[$i]['id'] = $row['id'];
			$list[$i]['img'] = $row['img'];
			$list[$i]['name'] = $row['name'];
			$list[$i]['text'] = $row['text'];
			$list[$i]['email'] = $row['email'];
			$list[$i]['date'] = $row['date'];
			$list[$i]['published'] = $row['published'];
			$list[$i]['edited'] = $row['edited'];
			$i++;
		}
		
		return $list;
	}
	
	public static function checkName($name){
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }
	
	public static function checkEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
	
		
	public static function checkText($text){
        if (strlen($text) >= 10) {
            return true;
        }
        return false;
    }
	
	public static function addItem($name, $email, $text, $img){
        $db = Db::getConnection();

        $sql = "INSERT INTO reviews (name, email, text, img) VALUES (:name, :email, :text, :img)";
		
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':img', $img, PDO::PARAM_STR);
		
        return $result->execute();
    }
	
	public static function getElementById($id){
        $db = Db::getConnection();

        $sql = 'SELECT * FROM reviews WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();

        return $result->fetch();
	}
	
	public static function updateElementById($id, $options){
		$db = Db::getConnection();
		
		$sql = "UPDATE reviews SET text = :text, edited = :edited WHERE id = :id";
        $result = $db->prepare($sql);
		
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':text', $options['text'], PDO::PARAM_STR);
        $result->bindParam(':edited', $options['edited'], PDO::PARAM_INT);
		
        return $result->execute();
	}
	
	public static function elementActivate($id, $published = 1){
		$db = Db::getConnection();
		
		$sql = "UPDATE reviews SET published = :published WHERE id = :id";
        $result = $db->prepare($sql);
		
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':published', $published, PDO::PARAM_INT);
		
        return $result->execute();
	}
	
	public static function elementDeactivate($id, $published = 0){
		$db = Db::getConnection();
		
		$sql = "UPDATE reviews SET published = :published WHERE id = :id";
        $result = $db->prepare($sql);
		
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':published', $published, PDO::PARAM_INT);
		
        return $result->execute();
	}
	
}