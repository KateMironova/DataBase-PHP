<?php
class DBFactory 
{
	static function getDataBase($formatDB) 
	{
		$reader = null;
		switch($formatDB)
		{
			case 'MySQL':
				$reader = new MySQLReader();   
				break;
			case 'Mock':
				$reader = new MySQLReader();   
				break;
			default:
				break;
		}
		return $reader;
	}
}

class DBReader 
{
	public function Create($id, $fn, $ln, $age){}
	public function Read(){}
	public function Update($id, $fn, $ln, $age){}
	public function DeleteP($id){}
}
class MySQLReader extends DBReader
{
	private $host = 'localhost'; // адрес сервера 
	private $database = 'personbd'; // имя базы данных
	private $user = 'root'; // имя пользователя
	private $password = ''; // пароль
	
	public function Create($id, $fn, $ln, $age)
	{
		if(isset($id) && isset($fn) && isset($ln) && isset($age))
		{
 
			// подключаемся к серверу
			$link = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("Ошибка " . mysqli_error($link)); 
     
			// экранирования символов для mysql
			$id = htmlentities(mysqli_real_escape_string($link, $id));
			$fn = htmlentities(mysqli_real_escape_string($link, $fn));
			$ln = htmlentities(mysqli_real_escape_string($link, $ln));
			$age = htmlentities(mysqli_real_escape_string($link, $age));
     
			// создание строки запроса
			$query ="INSERT INTO person VALUES('$id','$fn','$ln','$age')";
     
			// выполняем запрос
			mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

			// закрываем подключение
			mysqli_close($link);
		}
	}

	public function Read()
	{
		$link = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("Ошибка " . mysqli_error($link)); 
     
		$query ="SELECT * FROM person";
 
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
		if($result)
		{
			$rows = mysqli_num_rows($result); // количество полученных строк
			 
			for ($i = 0 ; $i < $rows ; ++$i)
			{
				$row = mysqli_fetch_row($result);
				$persons[$i] = new Person($row[0], $row[1], $row[2], $row[3]);
			}
			 
			// очищаем результат
			mysqli_free_result($result);
		}	 
		mysqli_close($link);
		
		return $persons;
	}
	public function Update($id, $fn, $ln, $age)
	{
		// подключаемся к серверу
		$link = mysqli_connect($this->host, $this->user, $this->password, $this->database) 
			or die("Ошибка " . mysqli_error($link)); 
     
		// если запрос POST 
		if(isset($id) && isset($fn) && isset($ln) && isset($age))
		{
 
			$id = htmlentities(mysqli_real_escape_string($link, $id));
			$fn = htmlentities(mysqli_real_escape_string($link, $fn));
			$ln = htmlentities(mysqli_real_escape_string($link, $ln));
			$age = htmlentities(mysqli_real_escape_string($link, $age));
     
			$query ="UPDATE person SET FirstName='$fn', LastName='$ln', Age='$age' WHERE id='$id'";
			mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
		} 
		// закрываем подключение
		mysqli_close($link);
	}
	public function DeleteP($id)
	{
		if(isset($id))
		{ 
			$link = mysqli_connect($this->host, $this->user, $this->password, $this->database) 
				or die("Ошибка " . mysqli_error($link)); 
			$id = mysqli_real_escape_string($link, $id);
     
			$query ="DELETE FROM person WHERE Id = '$id'";
			mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
 
			mysqli_close($link);
		}
	}
}

?>