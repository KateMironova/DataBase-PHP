<?php
class Factory
{
	static function getConverter($format)
	{
		$res = null;
		switch ($format) 
		{
			case 'HTML':
				$res = new HtmlConverter();
				break;
			case 'JSON':
				$res = new JsonConverter();
				break;
			case 'XMLPure':
				$res = new XmlPureConverter();
				break;
			case 'XSLT':
				$res = new XsltConverter();
				break;
			default:
				break;
		}
		return $res;
	}
}
?>