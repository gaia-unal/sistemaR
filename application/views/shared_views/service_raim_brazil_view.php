<?php


if($_GET){
    $tabla = array_key_exists('raim_brazil', $_GET) ? $_GET['raim_brazil'] : null;
    $xml = buscar_loget($tabla);
    //echo json_encode($xml);
    echo  $_GET['callback'].'('.json_encode($xml) .')';
}

function buscar_loget($params) {
    $arrayParams = explode(" ", $params);//casting un string en array
    foreach ($arrayParams as $key => $value){
        if (substr($value, -3) == "ion" ){//si la palabra termina en ion
            $arrayParams[$key] = substr($value,0, -3)."ión";//agraga la tilde a la palabra que termina en ion
        }
    }
    $stopwordsConTildes = array("a", "acá", "ahí", "ajena", "ajenas", "ajeno", "ajenos", "al", "algo", "algún", "alguna", "algunas", "alguno", "algunos", "allá", "alli", "allí", "ambos", "ampleamos", "ante", "antes", "aquel", "aquella", "aquellas", "aquello", "aquellos", "aqui", "aquí", "arriba", "asi", "atras", "aun", "aunque", "bajo", "bastante", "bien", "cabe", "cada", "casi", "cierta", "ciertas", "cierto", "ciertos", "como", "cómo", "con", "conmigo", "conseguimos", "conseguir", "consigo", "consigue", "consiguen", "consigues", "contigo", "contra", "cual", "cuales", "cualquier", "cualquiera", "cualquieras", "cuan", "cuán", "cuando", "cuanta", "cuánta", "cuantas", "cuántas", "cuanto", "cuánto", "cuantos", "cuántos", "de", "dejar", "del", "demás", "demas", "demasiada", "demasiadas", "demasiado", "demasiados", "dentro", "desde", "donde", "dos", "el", "él", "ella", "ellas", "ello", "ellos", "empleais", "emplean", "emplear", "empleas", "empleo", "en", "encima", "entonces", "entre", "era", "eramos", "eran", "eras", "eres", "es", "esa", "esas", "ese", "eso", "esos", "esta", "estaba", "estado", "estais", "estamos", "estan", "estar", "estas", "este", "esto", "estos", "estoy", "etc", "fin", "fue", "fueron", "fui", "fuimos", "gueno", "ha", "hace", "haceis", "hacemos", "hacen", "hacer", "haces", "hacia", "hago", "hasta", "incluso", "intenta", "intentais", "intentamos", "intentan", "intentar", "intentas", "intento", "ir", "jamás", "junto", "juntos", "la", "largo", "las", "lo", "los", "mas", "más", "me", "menos", "mi", "mía", "mia", "mias", "mientras", "mio", "mío", "mios", "mis", "misma", "mismas", "mismo", "mismos", "modo", "mucha", "muchas", "muchísima", "muchísimas", "muchísimo", "muchísimos", "mucho", "muchos", "muy", "nada", "ni", "ningun", "ninguna", "ningunas", "ninguno", "ningunos", "no", "nos", "nosotras", "nosotros", "nuestra", "nuestras", "nuestro", "nuestros", "nunca", "os", "otra", "otras", "otro", "otros", "para", "parecer", "pero", "poca", "pocas", "poco", "pocos", "podeis", "podemos", "poder", "podria", "podriais", "podriamos", "podrian", "podrias", "por", "por qué", "porque", "primero", "primero desde", "puede", "pueden", "puedo", "pues", "que", "qué", "querer", "quien", "quién", "quienes", "quienesquiera", "quienquiera", "quiza", "quizas", "sabe", "sabeis", "sabemos", "saben", "saber", "sabes", "se", "segun", "ser", "si", "sí", "siempre", "siendo", "sin", "sín", "sino", "so", "sobre", "sois", "solamente", "solo", "somos", "soy", "sr", "sra", "sres", "sta", "su", "sus", "suya", "suyas", "suyo", "suyos", "tal", "tales", "también", "tambien", "tampoco", "tan", "tanta", "tantas", "tanto", "tantos", "te", "teneis", "tenemos", "tener", "tengo", "ti", "tiempo", "tiene", "tienen", "toda", "todas", "todo", "todos", "tomar", "trabaja", "trabajais", "trabajamos", "trabajan", "trabajar", "trabajas", "trabajo", "tras", "tú", "tu", "tus", "tuya", "tuyo", "tuyos", "ultimo", "un", "una", "unas", "uno", "unos", "usa", "usais", "usamos", "usan", "usar", "usas", "uso", "usted", "ustedes", "va", "vais", "valor", "vamos", "van", "varias", "varios", "vaya", "verdad", "verdadera", "vosotras", "vosotros", "voy", "vuestra", "vuestras", "vuestro", "vuestros", "y", "ya", "yo");
    $stopwordsSinTildes = array("a", "aca", "ahi", "ajena", "ajenas", "ajeno", "ajenos", "al", "algo", "algun", "alguna", "algunas", "alguno", "algunos", "alla", "alli", "alli", "ambos", "ampleamos", "ante", "antes", "aquel", "aquella", "aquellas", "aquello", "aquellos", "aqui", "aqui", "arriba", "asi", "atras", "aun", "aunque", "bajo", "bastante", "bien", "cabe", "cada", "casi", "cierta", "ciertas", "cierto", "ciertos", "como", "como", "con", "conmigo", "conseguimos", "conseguir", "consigo", "consigue", "consiguen", "consigues", "contigo", "contra", "cual", "cuales", "cualquier", "cualquiera", "cualquieras", "cuan", "cuan", "cuando", "cuanta", "cuanta", "cuantas", "cuantas", "cuanto", "cuanto", "cuantos", "cuantos", "de", "dejar", "del", "demas", "demas", "demasiada", "demasiadas", "demasiado", "demasiados", "dentro", "desde", "donde", "dos", "el", "el", "ella", "ellas", "ello", "ellos", "empleais", "emplean", "emplear", "empleas", "empleo", "en", "encima", "entonces", "entre", "era", "eramos", "eran", "eras", "eres", "es", "esa", "esas", "ese", "eso", "esos", "esta", "estaba", "estado", "estais", "estamos", "estan", "estar", "estas", "este", "esto", "estos", "estoy", "etc", "fin", "fue", "fueron", "fui", "fuimos", "gueno", "ha", "hace", "haceis", "hacemos", "hacen", "hacer", "haces", "hacia", "hago", "hasta", "incluso", "intenta", "intentais", "intentamos", "intentan", "intentar", "intentas", "intento", "ir", "jamas", "junto", "juntos", "la", "largo", "las", "lo", "los", "mas", "mas", "me", "menos", "mi", "mia", "mia", "mias", "mientras", "mio", "mio", "mios", "mis", "misma", "mismas", "mismo", "mismos", "modo", "mucha", "muchas", "muchisima", "muchisimas", "muchisimo", "muchisimos", "mucho", "muchos", "muy", "nada", "ni", "ningun", "ninguna", "ningunas", "ninguno", "ningunos", "no", "nos", "nosotras", "nosotros", "nuestra", "nuestras", "nuestro", "nuestros", "nunca", "os", "otra", "otras", "otro", "otros", "para", "parecer", "pero", "poca", "pocas", "poco", "pocos", "podeis", "podemos", "poder", "podria", "podriais", "podriamos", "podrian", "podrias", "por", "por que", "porque", "primero", "primero desde", "puede", "pueden", "puedo", "pues", "que", "que", "querer", "quien", "quien", "quienes", "quienesquiera", "quienquiera", "quiza", "quizas", "sabe", "sabeis", "sabemos", "saben", "saber", "sabes", "se", "segun", "ser", "si", "si", "siempre", "siendo", "sin", "sin", "sino", "so", "sobre", "sois", "solamente", "solo", "somos", "soy", "sr", "sra", "sres", "sta", "su", "sus", "suya", "suyas", "suyo", "suyos", "tal", "tales", "tambien", "tambien", "tampoco", "tan", "tanta", "tantas", "tanto", "tantos", "te", "teneis", "tenemos", "tener", "tengo", "ti", "tiempo", "tiene", "tienen", "toda", "todas", "todo", "todos", "tomar", "trabaja", "trabajais", "trabajamos", "trabajan", "trabajar", "trabajas", "trabajo", "tras", "tu", "tu", "tus", "tuya", "tuyo", "tuyos", "ultimo", "un", "una", "unas", "uno", "unos", "usa", "usais", "usamos", "usan", "usar", "usas", "uso", "usted", "ustedes", "va", "vais", "valor", "vamos", "van", "varias", "varios", "vaya", "verdad", "verdadera", "vosotras", "vosotros", "voy", "vuestra", "vuestras", "vuestro", "vuestros", "y", "ya", "yoz");
    foreach ($arrayParams as $key_p => $word) {//elimina las stopwords sin tilde.
        foreach ($stopwordsSinTildes as $key_s => $stop) {
            if ($word == $stop) {
                unset($arrayParams[$key_p]);
            }
        }
    }
    $palabras = implode(", ", $arrayParams);//casting un array a string separando los elementos con coma
    $params = implode("_", $arrayParams);//casting de un array a string separando los elementos con _
    $andParams = "('" . preg_replace('/_/', ' & ', $params) . "')";//se reemplaza el _ por &
    $orParams = "('" . preg_replace('/_/', ' | ', $params) . "')";//se reemplaza el _ po |
    #var_dump(get_oas_bget($orParams,$andParams));
    return get_oas_bget($orParams,$andParams);
    #$this->load->model("lo_model");
    #return $this->lo_model->get_oas_bget($orParams,$andParams),
 }

function get_oas_bget($orParams, $andParams) {
    #echo $orParams;

    $dbconn3 = pg_connect("host='localhost' port='5432' dbname='froacn' user='postgres' password='%froac$'");

    $andQuery = pg_fetch_all(pg_query(#$this->db->query(
        "SELECT rep_id, lo_id, lo_xml_lom, ts_rank_cd(campo_busqueda_index_col, query) AS rank
        FROM lo, to_tsquery" . $andParams . "query
        WHERE query @@ campo_busqueda_index_col and lo_location is not null and rep_id='17'
        ORDER BY rank DESC;"
    ));//sql incluyenndo las palabras

    $orQuery =  pg_fetch_all(pg_query(#$this->db->query(
        "SELECT rep_id, lo_id, lo_xml_lom, ts_rank_cd(campo_busqueda_index_col, query) AS rank
        FROM lo, to_tsquery" . $orParams . "query
        WHERE query @@ campo_busqueda_index_col and lo_location is not null 
        and rep_id='17' ORDER BY rank DESC;"
    ));//sql cualquiera de las palabras

    $result = array();
    $resultAnd = array();
    $resultOr = array();

    foreach ($orQuery as $or) {//resultados del or
        array_push($resultOr, $or);//agregar elemento a un arreglo de or
    }
        

    foreach ($andQuery as $and) {//resultados del and
    array_push($resultAnd, $and);//agregar elemento a un arreglo de and
    }
    #var_dump($resultAnd);

    
    //echo $orParams;
    #array_push($result, $resultAnd);
    #array_push($result, $resultOr);//unir arreglo and y arreglo or
     

    $arregloOr= array();
    $arregloAnd= array();

    foreach ($resultAnd as $key) {
        array_push($arregloAnd, ['rep_id' => $key['rep_id'], 'lo_id' => $key['lo_id'], 'xml' => $key['lo_xml_lom']]);
        //array_push($arregloAnd, $key['lo_xml_lom']);
    }
    $evitDatRep=true;
    foreach ($resultOr as $key) {
    //si ya lo mostro entonces no se vuelve a mostrar
       foreach ($resultAnd as $mostrados ) {
           if ($mostrados['lo_id']==$key['lo_id']) {
                $evitDatRep=false;
                break;
               
            }
            else{
                $evitDatRep=true;
            }
        }

        if($evitDatRep){
            array_push($arregloOr, ['rep_id' => $key['rep_id'], 'lo_id' => $key['lo_id'], 'xml' => $key['lo_xml_lom']]);
            //array_push($arregloOr, $key['lo_xml_lom']);
        }
    }


    $result = array_merge($result, $arregloAnd);
    $result = array_merge($result, $arregloOr);

    #var_dump($result);
    return $result;
}


?>