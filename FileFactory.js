class Factory {
	static getReader(format) 
	{
		var reader = null;
		switch(format)
		{
			case 'JSON':
				reader = new JsonReader();   
				break;
			case 'XMLPure':
				reader = new XmlPureReader();   
				break;
			case 'XSLT':
				reader = new XmlXsltReader();   
				break;
			case 'HTML':
				reader = new HtmlReader();   
				break;
		}
		return reader;
	}
}

class Reader {
	Read()
	{
	}
}
class JsonReader extends Reader
{	
	Read(jsonText)
	{
		var persons = JSON.parse(jsonText);
		var nTable = document.createElement('table');
	
		persons.forEach(function(item) 
		{
			var newRow = nTable.insertRow(nTable.rows.length);     
			
			var cellId = newRow.insertCell(0);
			var cellFn = newRow.insertCell(1);
			var cellLn = newRow.insertCell(2);
			var cellAge = newRow.insertCell(3);

			cellId.appendChild(document.createTextNode(item.Id));
			cellFn.appendChild(document.createTextNode(item.FirstName));
			cellLn.appendChild(document.createTextNode(item.LastName));
			cellAge.appendChild(document.createTextNode(item.Age));
		});
		return nTable.innerHTML;
	}
}
class XmlXsltReader extends Reader
{
	Read(xmlText)
	{
		var nTable = document.createElement('table');
		var xsltText =
		'<xsl:stylesheet version="1.0" ' + //показывает что этот документ является документом типа “XSLT style sheet” 
		    'xmlns:xsl="http://www.w3.org/1999/XSL/Transform" ' +
		    'xmlns="http://www.w3.org/TR/xhtml1/strict"> ' +
            '<xsl:template match="/"> ' +// используется для построения шаблонов преобразования 
            '<table  border="1"> ' +
				'<thead> ' +
				'<tr>' +
					'<th>Id</th>' +
					'<th>First Name </th>' +
					'<th>Last Name </th>' +
					'<th>Age</th>' +
				'</tr>' +
				'</thead >' +
				'<tbody id="tableBody"> ' +
				'<xsl:for-each select="persons/person"> ' + //используется для перебора всех элементов, которые подходят условию выборки
				  '<tr> ' +
					'<td> <xsl:value-of select="id"/> </td> ' +
					'<td> <xsl:value-of select="firstName"/> </td> ' +
					'<td> <xsl:value-of select="lastName"/> </td> ' +
					'<td> <xsl:value-of select="age"/> </td> ' +
				  '</tr> ' +
					'</xsl:for-each>  ' +
				'</tbody>' +
			'</table> ' +
			'</xsl:template> ' +
        '</xsl:stylesheet> ';
        var xmlDoc = new DOMParser().parseFromString(xmlText, "text/xml");
        var xslDoc = new DOMParser().parseFromString(xsltText, "text/xml");

        if (window.ActiveXObject ) 
		{
            var ex = xmlDoc.transformNode(xslDoc);//таблица стилей XSL применяется к XML документу
            nTable.innerHTML = ex;
        }
        // code for Chrome, Firefox, Opera, etc.
        else if (document.implementation && document.implementation.createDocument) 
		{
            var xsltProcessor = new XSLTProcessor();
            xsltProcessor.importStylesheet(xslDoc);
            var resultDocument = xsltProcessor.transformToFragment(xmlDoc, document);
            nTable.innerHTML = "";
            nTable.appendChild(resultDocument);
        }
		return nTable.innerHTML;
	}
}
class XmlPureReader extends Reader
{
	Read(xmlText)
	{
		var xmlDoc = new DOMParser().parseFromString(xmlText, "text/xml");
	
		var table = document.createElement('tbody');
		var x = xmlDoc.getElementsByTagName("persons")[0];
		for (var i = 0; i <x.childElementCount; i++) {
			var newRow   = table.insertRow(table.rows.length);
			for (var j = 0; j <x.childNodes[i].childElementCount; j++) {
				var cell  = newRow.insertCell(j);
				var text = x.childNodes[i].childNodes[j].innerHTML;
				cell.appendChild(document.createTextNode(text));
			}
		}
		return table.innerHTML;
	}		
}
class HtmlReader extends Reader
{
	Read(text)
	{
		return text;
	}		
}

	