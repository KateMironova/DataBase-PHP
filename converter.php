<?php
class HtmlConverter
{
	public function Read($persons)
	{
		$str = "<table>";
		for ($j = 0 ; $j < count($persons); ++$j)
		{
			$str = $str."<tr>";
			$str = $str."<td>".$persons[$j]->getId()."</td><td>".$persons[$j]->getFirstName()."</td><td>".$persons[$j]->getLastName()."</td><td>".$persons[$j]->getAge()."</td>";
			$str = $str."<tr>";;
		}
		$str = $str."</table>";
		return $str;
	}
}

class JsonConverter
{
	public function Read($persons)
	{
		for ($j = 0 ; $j < count($persons); ++$j)
		{
			$arr[] = "id=".$persons[$j]->getId()."&firstName=".$persons[$j]->getFirstName()."lastName=".$persons[$j]->getLastName()."age=".$persons[$j]->getAge();
		}
		return json_encode($persons); //Переменные кодируются в формате JSON
				 
	}
}

class XmlPureConverter
{
	public function Read($persons)
	{
		$str = "<persons>";
		for ($j = 0 ; $j < count($persons) ; ++$j)
		{
			$str = $str."<person>";
			$str = $str."<id>".$persons[$j]->getId()."</id><firstName>".$persons[$j]->getFirstName()."</firstName><lastName>".$persons[$j]->getLastName()."</lastName><age>".$persons[$j]->getAge()."</age>";
			$str = $str."</person>";
		}
		$str = $str."</persons>";
		return $str;
	}
}

class XsltConverter
{
	public function Read($persons)
	{
		$str = "<persons>";
		for ($j = 0 ; $j < count($persons) ; ++$j)
		{
			$str = $str."<person>";
			$str = $str."<id>".$persons[$j]->getId()."</id><firstName>".$persons[$j]->getFirstName()."</firstName><lastName>".$persons[$j]->getLastName()."</lastName><age>".$persons[$j]->getAge()."</age>";
			$str = $str."</person>";
		}
		$str = $str."</persons>";
		return $str;
	}
}

?>