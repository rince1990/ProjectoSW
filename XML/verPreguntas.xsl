<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:template match="/">
        <html>
	        <head>
		        <style>
			body {
				background-color: #B8B8B8;
			}			
			table, th, td {
				border: 3px solid black;
				border-collapse: collapse;
				width: 50%;
				height: 30px;
				text-align: center;
				vertical-align: center;
				padding: 7px;
				background-color:#D9D9D9;
				margin: auto;
			}
		</style>
	        </head>
            <body><center>
                <h3>Preguntas</h3>
                <table border="1">
	                <tr><th>Pregunta</th><th>Respuesta</th><th>Tema</th><th>complejidad</th></tr>
                <xsl:for-each select="//assessmentItem">
                    <tr>
	                    <td><xsl:value-of select="./itemBody/p"/></td>
	                    <td><xsl:value-of select="./correctResponse/value"/></td>
	                    <td><xsl:value-of select="./@subject"/></td>
	                    <td><xsl:value-of select="./@complexity"/></td>

                    </tr>       
                </xsl:for-each>
                </table>
                </center>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
