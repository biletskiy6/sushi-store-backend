<?php
include_once ROOT . '/models/Products.php';

class ImageUpload 
{
	private static $response = array();
	private static $upload_dir = 'uploads/';
	private static $server_url = 'http://sushi-store';

	public static function uploadImage()
	{
		if(isset($_FILES['image']))
		{
			$avatar_name = $_FILES["image"]["name"];
			$avatar_tmp_name = $_FILES["image"]["tmp_name"];
			$error = $_FILES["image"]["error"];

			if($error > 0){
				self::$response = array(
					"status" => "error",
					"error" => true,
					"message" => "Error uploading the file!"
				);
			}
			else 
			{
				$random_name = rand(1000,1000000)."-".$avatar_name;
				$upload_name = self::$upload_dir.strtolower($random_name);
				$upload_name = preg_replace('/\s+/', '-', $upload_name);

				if(move_uploaded_file($avatar_tmp_name , $upload_name)) {
					self::$response = array(
						"status" => "success",
						"error" => false,
						"message" => "File uploaded successfully",
						"url" => self::$server_url."/".$upload_name
					);
					$pathToImage = self::$response['url'];
					return $pathToImage;
				}
				else
				{
					self::$response = array(
						"status" => "error",
						"error" => true,
						"message" => "Error uploading the file!"
					);
				}
			}    

		}else{
			self::$response = array(
				"status" => "error",
				"error" => true,
				"message" => "No file was sent!"
			);
		}
	}
	public static function deleteImage($id) 
	{
		$product = Products::getProductById($id);
		$productImagePath = $product['image'];
		$pattern = "/uploads\/(.*)/";
		$pathToDir = ROOT . '/uploads/';
		$filesInUploadsDir = array_diff(scandir($pathToDir), array('.', '..'));
		if(preg_match($pattern, $productImagePath, $matches)) {
			$matchedName = $matches[1];
			foreach ($filesInUploadsDir as $file) {
				if($file === $matchedName) {
					unlink(ROOT . '/uploads/' . $file);
				}
			}
		}
	}
}