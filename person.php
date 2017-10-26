<?php
class Person
{
	private $id, $firstName, $lastName, $age;
	
	function __construct($id, $firstName, $lastName, $age)
    {
        $this->id = $id;
		$this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
    }
	function getId()
    {
        return $this->id;
    }
	function getFirstName()
    {
        return $this->firstName;
    }
	function getLastName()
    {
        return $this->lastName;
    }
	function getAge()
    {
        return $this->age;
    }
}
?>