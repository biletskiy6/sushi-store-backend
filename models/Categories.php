<?php 
class Categories 
{
	public static function getCategoryList() 
	{

		$db = DB::getConnection();

		$getCategories = $db->prepare("SELECT * from category");
		$getCategories->setFetchMode(PDO::FETCH_ASSOC);
		$getCategories->execute();
		$categories = $getCategories->fetchAll();
		return $categories;
	}
}