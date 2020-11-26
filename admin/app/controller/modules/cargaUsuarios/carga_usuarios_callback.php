<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class carga_usuarios_callback extends controller
{
	private $usuario;

	protected function index()
	{
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
		            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

		            //Salta la primera linea, que es de los titulos
		            fgetcsv($csvFile);
		            

					$arrayInfo = array();
		            //parse data from csv file line by line
		            set_time_limit(10);
		            while(($line = fgetcsv($csvFile)) !== FALSE){
		                //check whether member already exists in database with same email
		                
		                array_push($arrayInfo, explode(";", $line[0]));
						//$this->lista_usuarios = $mdlCarga->cargar_usuarios();

		            }
		            //close opened csv file
		            fclose($csvFile);

		            $this->loadModel("modules/cargaUsuarios/cargar_usuarios.cls",false);
					$mdlCarga = new cargar_usuarios($this->main);
					$mdlCarga->cargar_array_csv($arrayInfo);
					
		            $qstring = '/status_csv/succ/';
		        }else{
		            $qstring = '/status_csv/err/';
		        }
		    }else{
		        $qstring = '/status_csv/invalid_file/';
		    }
		    echo "<br /><br />";
		    echo "<a href='"._MSFW_PATH_."modules/cargaUsuarios/carga_usuarios".$qstring."' id='link' target='_self'>Continuar</a>";
		    echo "<br /><br />";

		    exit();
		    //$this->redirect(_MSFW_PATH_."modules/cargaUsuarios/carga_usuarios".$qstring);
		}		
 	}

  	public function render()
	{
    	return "";
  	}
}
?>
