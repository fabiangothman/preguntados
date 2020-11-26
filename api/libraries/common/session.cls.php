<?php
	/******************************************************/
	/*	Desarrollado por: Multimedia Service S.A. © 2017	*/
	/******************************************************/

	class session
	{
		private $data = array("logged"=>false,"id"=>NULL,"email"=>NULL,"user_lastactive"=>NULL,"err"=>NULL);
		
		public function __construct()
		{
			session_start();
			if(!isset($_SESSION['id']))
			{
				$this->data["logged"] = false;
			}
			else
			{
				$this->data["logged"] = true;
				$this->data["id"] = $_SESSION['id'];
				$this->data["email"] = $_SESSION['email'];
				$this->data["user_lastactive"] = $_SESSION['user_lastactive'];
				$this->data["err"] = $_SESSION['err'];
			}
  	}
		
		public function login(&$objUser)
		{
			// Assign variables to session
			session_regenerate_id(true);
			
			$_SESSION['id'] = $objUser->id_usuario;
			$_SESSION['email'] = $objUser->email;
			$_SESSION['user_lastactive'] = time();
			$_SESSION['err'] = "";
			
			$this->data["logged"] = true;
			
			//header("Location: "._MSFW_PATH_);
			//exit();
		}
		
		public function logout($p_motivo)
		{
			unset($_SESSION['id']);
			unset($_SESSION['email']);
			unset($_SESSION['user_lastactive']);
			unset($_SESSION['err']);
			session_unset();
			session_destroy();
			$this->data["logged"] = false;
			$this->data["id"] = NULL;
			$this->data["email"] = NULL;
			$this->data["user_lastactive"] = NULL;
			$this->data["err"] = NULL;
			
			header("Location: "._MSFW_PATH_."modules/login/login/logout/".$p_motivo);
			exit();
		}
		
		public function check_session()
		{
			if(!isset($_SESSION['id']))
			{
				if($this->data["logged"])
					$this->logout("closed");
				return "closed";
			}
			else
			{
				$oldtime = $this->data["user_lastactive"];
				if(!empty($oldtime))
				{
					$currenttime = time();
					// this is equivalent to 30 minutes
					$timeoutlength = _SESSION_TIME_ * 60;
					if(($oldtime + $timeoutlength) >= $currenttime){ 
						// Set new user last active time
						$_SESSION['user_lastactive'] = $currenttime;
						$this->data["user_lastactive"] = $_SESSION['user_lastactive'];
					}
					else
					{
						// If session has been inactive too long logout
						$this->logout("expired");
						return "expired";
					}
				}
			}
			return "open";
		}
		
		public function elimina($name)
		{
			if(isset($this->name))
			{
				unset($_SESSION[$name]);
				$this->data[$name] = NULL;
			}
		}
	
		public function __isset($name)
    {
        $resp = isset($this->data[$name]);
        $resp = ($resp)?$resp:isset($_SESSION[$name]);
        return $resp;
    }
		
		public function __set($name, $value)
    {
			if($this->check_session()=="open")
			{
				$_SESSION[$name] = $value;
				$this->data[$name] = $value;
				return true;
			}
			return false;
    }

    public function __get($name)
    {
			if($this->check_session())
			{
        if (array_key_exists($name, $this->data)) {
					return $this->data[$name];
        }
        elseif(isset($_SESSION[$name]))
        {
          $this->data[$name] = $_SESSION[$name];
          return $_SESSION[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return NULL;
			}
			return NULL;
    }
	}
?>