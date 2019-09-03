<?php 
class DB
{
	private static $connection;

	public static function getConnection() 
	{
		if (!self::$connection) 
		{
			$localhost = 'localhost';
			$dbname = 'phpshop';
			$dbuser = 'root';
			$password = '';
			self::$connection = new PDO("mysql:host=$localhost;dbname=$dbname;", $dbuser, $password);
		}
		return self::$connection;
	}
}