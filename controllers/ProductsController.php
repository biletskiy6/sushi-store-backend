<?php

include_once ROOT . '/models/Products.php';

class ProductsController
{
	public function actionIndex() 
	{
		$productList = Products::getProductList();
		echo json_encode($productList, JSON_UNESCAPED_UNICODE);
		return true;
	}
	public function actionView($id) 
	{

	}
	public function actionAdd()
	{

		$response = array();
		$upload_dir = 'uploads/';
		$server_url = 'http://sushi-store';

		if(isset($_FILES['image']))
		{
			$avatar_name = $_FILES["image"]["name"];
			$avatar_tmp_name = $_FILES["image"]["tmp_name"];
			$error = $_FILES["image"]["error"];

			if($error > 0){
				$response = array(
					"status" => "error",
					"error" => true,
					"message" => "Error uploading the file!"
				);
			}else 
			{
				$random_name = rand(1000,1000000)."-".$avatar_name;
				$upload_name = $upload_dir.strtolower($random_name);
				$upload_name = preg_replace('/\s+/', '-', $upload_name);

				if(move_uploaded_file($avatar_tmp_name , $upload_name)) {
					$response = array(
						"status" => "success",
						"error" => false,
						"message" => "File uploaded successfully",
						"url" => $server_url."/".$upload_name
					);
					$title = $_POST['title'];
					$description = $_POST['description'];
					$price = $_POST['price'];
					$categoryId = $_POST['categoryId'];
					$pathToImage = $response['url'];

					$options = array(
						'title' => $title,
						'description' => $description,
						'price' => $price,
						'categoryId' => $categoryId,
						'image' => $pathToImage
					);

					echo Products::createProduct($options);
				}
				else
				{
					$response = array(
						"status" => "error",
						"error" => true,
						"message" => "Error uploading the file!"
					);
				}
			}    

		}else{
			$response = array(
				"status" => "error",
				"error" => true,
				"message" => "No file was sent!"
			);
		}
		return true;
	}
}