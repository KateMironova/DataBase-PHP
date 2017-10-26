<?php
include 'person.php';
include 'converter.php';
include 'factory.php';
include 'DBFactory.php';

$method = $_GET['method']; 
$formatDB = $_GET['formatDB']; 
$format = '';
$db = DBFactory::getDataBase($formatDB);
switch($method)
{
	case 'create':
		$id = $_GET['id'];
		$fn = $_GET['fn'];
		$ln = $_GET['ln'];
		$age = $_GET['age'];
		$db->Create($id, $fn, $ln, $age);
		break;
	case 'read':
		$format = $_GET['format'];
		$persons = $db->Read();
		$ff = Factory::getConverter($format);
		echo $ff->Read($persons);
		break;
	case 'update':
		$id = $_GET['id'];
		$fn = $_GET['fn'];
		$ln = $_GET['ln'];
		$age = $_GET['age'];
		$db->Update($id, $fn, $ln, $age);
		break;
	case 'delete':
		$id = $_GET['id'];   
		$db->DeleteP($id);
		break;
}
?>