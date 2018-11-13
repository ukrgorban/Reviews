<?php

class Image{
	
	public static function resize($imageResourceId, $width, $height, $pathName){
		$width =320;
		$height =240;
		
		// получение новых размеров
		list($width_orig, $height_orig) = getimagesize($pathName);

		$ratio_orig = $width_orig/$height_orig;

		if ($width/$height > $ratio_orig) {
		   $width = $height*$ratio_orig;
		} else {
		   $height = $width/$ratio_orig;
		}
		
		$targetLayer=imagecreatetruecolor($width, $height);

		imagealphablending( $targetLayer, false );
		imagesavealpha( $targetLayer, true );
		
		imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$width, $height, $width_orig,$height_orig);

		return $targetLayer;
	}
	
	public static function checkSize($width, $height){
		
		if($width > 320 || $height > 240){
			return true;
		}
		
		return false;
	}
}