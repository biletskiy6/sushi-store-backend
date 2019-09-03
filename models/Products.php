<?php 
class Products 
{
	public static function getProductList() 
	{

		$db = DB::getConnection();

		$getProducts = $db->prepare("SELECT * from product");
		$getProducts->setFetchMode(PDO::FETCH_ASSOC);
		$getProducts->execute();
		$products = $getProducts->fetchAll();
		return $products;

	}

	public static function createProduct($options) 
	{
		json_encode($options);
		$db = Db::getConnection();
		$sql = 'INSERT INTO product (title, price, description, image, categoryId) VALUES (:title, :price, :description, :image, :categoryId)';
		$result = $db->prepare($sql);
		$result->bindParam(':title', $options['title'], PDO::PARAM_STR);
		$result->bindParam(':description', $options['description'], PDO::PARAM_STR);
		$result->bindParam(':price', $options['price'], PDO::PARAM_INT);
		$result->bindParam(':image', $options['image'], PDO::PARAM_STR);
		$result->bindParam(':categoryId', $options['categoryId'], PDO::PARAM_INT);
		if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
			return $db->lastInsertId();
		}
        // Иначе возвращаем 0
		return 0;
	}

}