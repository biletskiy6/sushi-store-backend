<?php

include_once ROOT . '/models/Categories.php';

class CategoriesController
{
	public function actionIndex() 
	{
		$categoryList = Categories::getCategoryList();
		echo json_encode($categoryList, JSON_UNESCAPED_UNICODE);
		return true;
	}
}