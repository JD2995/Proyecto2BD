<?php
	
	require_once("Conexion/conexion.php");
	$conexion = new conexion();
	$conexion->setParameters("localhost","Kevin","Kev19061994+","kevin");   // aqui van los parametros de la conexion
    $conexion->setConnection();                                             // una vez inicializados los parametros se establece la conexion
    $resultadoTablas = $conexion->getTablas();
    $resultadoTablas->data_seek(0);
    $tablas = [];
    while($tabla = $resultadoTablas->fetch_assoc()){            // aqui lo que hacemos es obtener el nombre de las tablas que estan en la base de datos
        array_push($tablas, $tabla['table_name']);              // y las guardamos en un array para luego ser utilizado en la creacion de los documentos de excel
    }   
    mysqli_free_result($resultadoTablas);
    //mysqli_close($conexion->getID());
    for($elemento=0;$elemento<count($tablas);$elemento++){  // por cada una de las tablas que nos devuelva la consulta
        $nombreTabla = $tablas[$elemento];                      // obtengo una tabla 
        $conexion->setConnection();                             //                     
        $resultado = $conexion->getData($nombreTabla);          // obtengo todos los datos que contenga dicha tabla
        $numFilas = $resultado->num_rows;                       // obtengo el número de filas
        if($numFilas > 0){                                          // si el número de filas es mayor a 0
        	require_once("ExcelHelper/Classes/PHPExcel.php");          // importamos la biblioteca de creación de documentos de excel
        	$documentoExcel = new PHPExcel();                              // instanciamos un nuevo documento
        	$documentoExcel->getProperties()->setCreator("Erin Siezar")                
        									->setLastModifiedBy('Erin Siezar')
        									->setTitle("Tabla ".$nombreTabla)                  // establecemos las propiedades del documento
    								        ->setSubject("None")
    								        ->setDescription("Documento generado con PHPExcel")
    								        ->setKeywords("None")
    								        ->setCategory($nombreTabla);
    		$documentoExcel->getActiveSheet()->setTitle($nombreTabla);                // a la página actual del documento le ponemos el nombre de la tabla
    		$resultado->data_seek(0);                           // guardamos el resultado de la consulta en una variable
    		$filaDocumento = 2;                                // establecemos fila = 2 porque en la fila 0 están los indices A,B,C ...... y en la fila 1 irá el nombre de la columna de la tabla en la base de datos
    		$columna = 0;                                     // columna si la establecemos en 0, con esa no hay problema
    		$info_campo = $resultado->fetch_fields();        // obtenemos los atributos de la tabla que estamos usando
    		foreach($info_campo as $valor){                       // para cada atributo en la tabla
    			$documentoExcel->getActiveSheet()->setCellValueByColumnAndRow($columna, 1, $valor->name);  // lo escribimos en la fila 1 del documento
                $columna++;                                                                                // incrementamos columna para que la siguiente lectura se haga en un lugar diferente         
    		}
    		$columna = 0;                                     // volvemos a establecer columna en 0
            while($fila = $resultado->fetch_assoc()){           // por cada fila que obtengamos como resultado
                foreach($info_campo as $valor){                 // ahora bien para obtener cada valor de la fila se busca por atributo  
                	$documentoExcel->getActiveSheet()
                		->setCellValueByColumnAndRow($columna, $filaDocumento, $fila[$valor->name]); // escribimos en el documento cada uno de los valores que nos devuelva la consulta
                                                                                                     // es importante mencionar que la escritura se hace como si se estuviera leyendo una matriz
                                                                                                     // o sea por filas y columnas   
                 		$columna++;                                                              // incrementamos columnas para que la siguiente escritura se haga en un lugar diferente
                }       
                $filaDocumento++;    // incrementamos la fila, esto implica que ya terminamos de escribir una fila que nos devolvió la consulta de la tabla
                $columna = 0;        // ponemos columna en 0, para que empiece de nuevo solo que esta vez será en una fila distinta
                
            }
            require_once 'ExcelHelper/Classes/PHPExcel/IOFactory.php';   // incluimos esta biblioteca que nos permite escribir el documento que hemos creado
            $objWriter = PHPExcel_IOFactory::createWriter($documentoExcel, 'Excel2007');        // pasamos como parametro el documento y el formato
    		// Si queremos crear un PDF
    		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
    		$objWriter->save($nombreTabla.'.xlsx');                       // al documento que crearemos fisicamente le ponemos un nombre y la extensión de dicho documento
                                                                            // aquí es importante averiguar si se quiere en excel 2000, 2003, 2007, 2010, 2013
        }
        mysqli_free_result($resultado);     // por cada consulta que hagamos una vez que ya no necesitemos la info entonces liberamos el buffer    
    }
    mysqli_close($conexion->getID());   // una vez terminado de hacer todo cerramos la conexión
?>