<?php
	/****************************************************************************
	*	Desarrollado por: Fabi�n Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Su�rez, juancsuarezg@correo.udistrital.edu.co	*
	*					  � 2017												*
	****************************************************************************/
	
	class logout extends controller
	{
		protected function index()
		{
			//Configuraci�n inicial
			$this->title = _MSFW_APP_NAME_." - Cerrando sesi�n...";

			$this->main->session->logout("user closed");
		}
		
		public function render()
		{
			return "";
		}
	}
?>