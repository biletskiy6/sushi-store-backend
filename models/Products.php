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
		print_r($options);
		$sql = "INSERT INTO product (title, price, description, image, categoryId) VALUES (:title, :price, :description, :image, :categoryId)";
		$result = $db->prepare($sql);
		$result->bindParam(':title', $options['title'], PDO::PARAM_STR);
		$result->bindParam(':price', $options['price'], PDO::PARAM_INT);
		$result->bindParam(':description', $options['description'], PDO::PARAM_STR);
		$result->bindParam(':image', $options['image'], PDO::PARAM_STR);
		$result->bindParam(':categoryId', $options['categoryId'], PDO::PARAM_INT);
		if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
			return $db->lastInsertId();
		}
        // Иначе возвращаем 0
		return 0;
	}
	public static function getProductById($id)
	{
		$db = Db::getConnection();
		$sql = 'SELECT * FROM product WHERE id=:id';
		$result = $db->prepare($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$result->bindParam(':id', $id, PDO::PARAM_STR);
		$result->execute();
		$row = $result->fetch();
		return $row;
	}

	public static function deleteProductById($id)
	{
		$db = Db::getConnection();
		$sql = 'DELETE FROM product WHERE id=:id';
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_STR);
		return $result->execute();
	}

	public static function updateProductById($id, $options)
	{
		echo json_encode($options);
        // Соединение с БД
		$db = Db::getConnection();
        // Текст запроса к БД
		$sql = "UPDATE product
		SET 
		title = :title, 
		description = :description, 
		price = :price, 
		categoryId = :categoryId, 
		image = :image
		WHERE id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		$result->bindParam(':title', $options['title'], PDO::PARAM_STR);
		$result->bindParam(':description', $options['description'], PDO::PARAM_STR);
		$result->bindParam(':price', $options['price'], PDO::PARAM_STR);
		$result->bindParam(':categoryId', $options['categoryId'], PDO::PARAM_STR);
		$result->bindParam(':image', $options['image'], PDO::PARAM_STR);
		
		return $result->execute();
	}

}