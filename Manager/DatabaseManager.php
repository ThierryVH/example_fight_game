<?php

declare(strict_types=1);

class DatabaseManager
{
	public const DB_NAME = ''; // le nom de ta base de données
	public const USERNAME = ''; // ton username
	public const PASSWORD = ''; // ton password

	public static function DB()
	{
		return new PDO('mysql:host=127.0.0.1:3306;dbname='.self::DB_NAME, self::USERNAME, self::PASSWORD);
	}
}
