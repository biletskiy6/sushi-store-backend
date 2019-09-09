<?php

include_once ROOT . '/models/Products.php';
include_once ROOT . '/models/ImageUpload.php';

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
		$product = Products::getProductById($id);
		echo json_encode($product, JSON_UNESCAPED_UNICODE);
		return true;

	}
	public function getDataToUpload()
	{
		$title = $_POST['title'] ?? null;
		$description = $_POST['description'] ?? null;
		$price = $_POST['price'] ?? null;
		$categoryId = $_POST['categoryId'] ?? null;
		$pathToImage = ImageUpload::uploadImage();
		$options = array(
			'title' => $title,
			'description' => $description,
			'price' => $price,
			'categoryId' => $categoryId,
			'image' => $pathToImage
		);
		return $options;
	}

	public function actionEdit($id)
	{
		ImageUpload::deleteImage($id);
		$data = $this->getDataToUpload();
		echo Products::updateProductById($id, $data);
		return true;
	}

	public function actionDelete($id)
	{
		ImageUpload::deleteImage($id);
		Products::deleteProductById($id);
		return true;
	}
	public function actionAdd()
	{
		$title = $_POST['title'] ?? null;
		$description = $_POST['description'] ?? null;
		$price = $_POST['price'] ?? null;
		$categoryId = $_POST['categoryId'] ?? null;

		$pathToImage = ImageUpload::uploadImage();

		$options = array(
			'title' => $title,
			'description' => $description,
			'price' => $price,
			'categoryId' => $categoryId,
			'image' => $pathToImage
		);
		
		echo Products::createProduct($options);

		return true;
	}
}