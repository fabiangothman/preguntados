<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class carga_preguntas_callback extends controller
{
	private $usuario;

	protected function index()
	{
		header('Content-Type: text/html; charset=UTF-8');
		//Se verifica el estado de la sesión
		$this->logged = ($this->main->session->check_session()=="open")?true:false;
		if(!$this->logged){
			echo "Acceso denegado.";
			exit();
		}

		//Estilo para mostrar las insercciones
		echo "<style type='text/css'>.update{background-color:#ccff00;}.insert{background-color:#00ff00;}.error{background-color:#ff7e7e;}</style>";
		$this->addInReadyCode("
			$('#link').focus();
		");
		
		if(isset($_POST['importSubmit'])){
		    //validate whether uploaded file is a csv file
		    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
		        if(is_uploaded_file($_FILES['file']['tmp_name'])){
		            //open uploaded csv file with read only mode
		            $handle = fopen($_FILES['file']['tmp_name'], 'r');

		            //Salta la primera linea, que es de los titulos
		            fgetcsv($handle, 1000, ",");
		            

					$arrayInfo = array();
		            //parse data from csv file line by line
		            set_time_limit(10);
		            while(($line = fgetcsv($handle, 1000, ",")) !== FALSE){
		                //check whether member already exists in database with same email
		                $numArraysLinea = count($line);

		                //Debido a problemas con las comas en la carga CSV se hace esto para unir los arrays que estas generan en uno solo
		                if($numArraysLinea > 1){
		                	$acum = "";
		                	foreach ($line as $num => $arrayLinea) {
		                		if($num == $numArraysLinea){
		                			$acum .= $arrayLinea;
		                		}else{
		                			$acum .= $arrayLinea.",";
		                		}		                		
		                	}
		                	$line = array($acum);
		                }

		                array_push($arrayInfo, explode(",$%&,", utf8_encode($line[0])));

		            }
		            //close opened csv file
		            fclose($handle);
		            
		            $this->loadModel("modules/cargaPreguntas/cargar_preguntas.cls",false);
					$mdlCarga = new cargar_preguntas($this->main);
					$mdlCarga->cargar_array_csv($arrayInfo);
					
		            $qstring = '/status_csv/succ/';
		        }else{
		            $qstring = '/status_csv/err/';
		        }
		    }else{
		        $qstring = '/status_csv/invalid_file/';
		    }
		    echo "<br /><br />";
		    echo "<a href='"._MSFW_PATH_."modules/cargaPreguntas/carga_preguntas".$qstring."' id='link' target='_self'>Continuar</a>";
		    echo "<br /><br />";

		    exit();
		    //$this->redirect(_MSFW_PATH_."modules/cargaPreguntas/carga_preguntas".$qstring);
		}		
 	}

  	public function render()
	{
    	return "";
  	}
}
?>
