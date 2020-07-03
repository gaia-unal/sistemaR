<?php
//header('content-type: text/plain');
//echo($xml[0]["lo_xml_lom"]);

$xmelele= $xml[0]["lo_xml_lom"];


function filtrar($string, $abre, $cierra, $repite){
	$cadena = $string;
	do{
		$tam1 = strlen($abre);
		$tam2 = strlen($cierra);
		$pos1 = strpos($cadena, $abre);
		$pos2 = strpos($cadena, $cierra);
		$inicio = $pos1+$tam1;
		$fin = $pos2-$inicio;
		$respuesta = substr($cadena, $inicio, $fin);
		$palabra = $abre.$respuesta.$cierra;
		$tamP = strlen($palabra);
		$posP = strpos($cadena, $palabra);
		$inic = $posP+$tamP; #$fin+$tam2;
		#if ($abre=="<lom:keyword>") {
		#	echo "fin $fin inic $inic cadena $cadena <br><br>";
		#}
		$cadena = substr($cadena, $inic);
		$repite--;
	}while ($repite>-1);
	
	return $respuesta;

}



$metPrin = array("<lom:general>", "</lom:general>", "<lom:lifecycle>", "</lom:lifecycle>",
				 "<lom:metametadata>", "</lom:metametadata>", "<lom:technical>", "</lom:technical>", "<lom:educational>", "</lom:educational>",
				 "<lom:rights>", "</lom:rights>", "<lom:relation>", "</lom:relation>", "<lom:annotation>", "</lom:annotation>", "<lom:classification>",
				 "</lom:classification>");
$cantEtiqPrin = 9;
$xmlSubEt = array();
$j=0;
for ($i=0; $i < $cantEtiqPrin*2 ; $i=$i+2) { 
	$inicio = $metPrin[$i];
	$fin = $metPrin[$i+1];
	$xmlSubEt[$j]= filtrar($xmelele, $inicio, $fin, 0);
	$j++;
}
#echo var_dump($xmlSubEt);

$etiquetasHijas = array(1 => array("<lom:catalog>", "</lom:catalog>", "<lom:entry>", "</lom:entry>", "<lom:title>",
									 "</lom:title>", "<lom:language>", "</lom:language>", "<lom:description>", 
									 "</lom:description>", "<lom:keyword>", "</lom:keyword>", "<lom:coverage>", "</lom:coverage>",
									 "<lom:structure>", "</lom:structure>", "<lom:aggregationlevel>", "</lom:aggregationlevel>"),
						2 => array("<lom:version>", "</lom:version>", "<lom:status>", "</lom:status>", "<lom:role>", "</lom:role>", "<lom:entity>",
									"</lom:entity>", "<lom:date>", "</lom:date>"),
						3 => array("<lom:catalog>", "</lom:catalog>", "<lom:entry>", "</lom:entry>", "<lom:role>", "</lom:role>", "<lom:entity>", 
									"</lom:entity>", "<lom:date>", "</lom:date>", "<lom:metadataschema>", "</lom:metadataschema>", "<lom:language>",
									"</lom:language>"),
						4 => array("<lom:format>", "</lom:format>", "<lom:size>", "</lom:size>", "<lom:location>", "</lom:location>", "<lom:type>", 
									"</lom:type>","<lom:name>", "</lom:name>", "<lom:minimumversion>", "</lom:minimumversion>", "<lom:maximumversion>", 
									"</lom:maximumversion>", "<lom:installationremarks>", "</lom:installationremarks>", "<lom:otherplatformrequirements>",
									"</lom:otherplatformrequirements>", "<lom:duration>", "</lom:duration>"),
						5 => array("<lom:interactivitytype>", "</lom:interactivitytype>", "<lom:learningresourcetype>", "</lom:learningresourcetype>", 
									"<lom:interactivitylevel>", "</lom:interactivitylevel>", "<lom:semanticdensity>", "</lom:semanticdensity>", 
									"<lom:intendedenduserrole>", "</lom:intendedenduserrole>", "<lom:context>", "</lom:context>", "<lom:typicalagerange>",
									"</lom:typicalagerange>", "<lom:difficulty>", "</lom:difficulty>", "<lom:typicallearningtime>", 
									"</lom:typicallearningtime>", "<lom:description>", "</lom:description>", "<lom:language>", "</lom:language>"),
						6 => array("<lom:cost>", "</lom:cost>", "<lom:copyrightandotherrestrictions>", "</lom:copyrightandotherrestrictions>", 
									"<lom:description>", "</lom:description>"),
						7 => array("<lom:kind>", "</lom:kind>", "<lom:catalog>", "</lom:catalog>", "<lom:entry>", "</lom:entry>", "<lom:description>",
									"</lom:description>"),
						8 => array("<lom:entity>", "</lom:entity>", "<lom:date>", "</lom:date>", "<lom:description>", "</lom:description>"),
						9 => array("<lom:purpose>", "</lom:purpose>", "<lom:source>", "</lom:source>", "<lom:id>", "</lom:id>", "<lom:entry>",
									 "</lom:entry>", "<lom:description>", "</lom:description>", "<lom:keyword>", "</lom:keyword>")
					);

$titulo = array(1 => array("Catalogo", "Entrada", "Titulo", "Lenguaje", "Descripción",
							"Palabra Clave", " Cobertura", "Estructura", "Nivel de Agregación"),
				2 => array("Versión", "Estatus", "Role", "Entidad", "Fecha"),
				3 => array("Catalogo", "Entrada", "Role", "Entidad", "Fecha", "Esquema de Metadatos", "Lenguaje"),
				4 => array("Formato", "Tamaño", "Localización", "Tipo", "Nombre", "Versión Minima ", "Maxima Versión", "Observaciones de Instalación", "Otras Plataformas Requeridas", "Duración"),
				5 => array("Tipo de Interactividad", "Tipo de Recurso de Aprendizaje", "Nivel de Interactividad", "Densidad Semantica", "Rol de Usuario Final Previsto", "Contexto", "Rango de Edad Típico", "Dificultad", "Tiempo de Aprendizaje Típico", "Descripción", "Lenguaje"),
				6 => array("Costo", "Copyright y Otras Restricciones", "Descripción"),
				7 => array("Clase", "Catalogo", "Entrada", "Descripción"),
				8 => array("Entidad", "Fecha", "Descripción"),
				9 => array("Proposito", "Fuente", "Identificación", "Entrada", "Descripción", "Palabras Clave")
			);


//echo var_dump($xmlSubEt);


for ($categoria=0; $categoria < $cantEtiqPrin; $categoria++) { 
	$posTitulo=0;
	$catSig = $categoria+1;
	$tamCategoria = count($etiquetasHijas[$catSig]);
	for ($etiqueta=0; $etiqueta < $tamCategoria; $etiqueta=$etiqueta+2) {
		$xmlCategoria = $xmlSubEt[$categoria];
		#echo "xmlCategoria $xmlCategoria <br>";
		#echo "catsig $catSig etiqueta $etiqueta <br>";
		$open = $etiquetasHijas[$catSig][$etiqueta];
		$close = $etiquetasHijas[$catSig][$etiqueta+1];
		$numEtiqueta = 0;
		do{
			#echo "posTitulo $posTitulo <br>";
			$palabra = filtrar($xmlCategoria, $open, $close, $numEtiqueta);
			echo "<b>".$titulo[$catSig][$posTitulo].": </b>".$palabra."<br>";
			$numEtiqueta++;
			#echo "numEtiqueta $numEtiqueta <br>";
			$cant = substr_count($xmlCategoria, $open) - $numEtiqueta;
			#echo "cant $cant <br>";
		}while ( $cant > 0);
		$posTitulo++;
	}
}

?>