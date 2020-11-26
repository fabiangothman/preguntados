<?php
	class session
	{
		private $data = array("logged"=>false,"id_admin"=>NULL,"email_admin"=>NULL,"user_lastactive_admin"=>NULL,"err"=>NULL);
		
		public function __construct()
		{
			session_start();
			if(!isset($_SESSION['id_admin']))
			{
				$this->data["logged"] = false;
			}
			else
			{
				$this->data["logged"] = true;
				$this->data["id_admin"] = $_SESSION['id_admin'];
				$this->data["email_admin"] = $_SESSION['email_admin'];
				$this->data["user_lastactive_admin"] = $_SESSION['user_lastactive_admin'];
				$this->data["err"] = $_SESSION['err'];
			}
  	}
		
		public function login(&$objUser)
		{
			// Assign variables to session
			session_regenerate_id(true);
			$_SESSION['id_admin'] = $objUser->id_usuario;
			$_SESSION['email_admin'] = $objUser->email;
			$_SESSION['user_lastactive_admin'] = time();
			$_SESSION['err'] = "";
			
			$this->data["logged"] = true;
			
			//header("Location: "._MSFW_PATH_);
			//exit();
		}
		
		public function logout($p_motivo)
		{
			unset($_SESSION['id_admin']);
			unset($_SESSION['email_admin']);
			unset($_SESSION['user_lastactive_admin']);
			unset($_SESSION['err']);
			session_unset();
			session_destroy();
			$this->data["logged"] = false;
			$this->data["id_admin"] = NULL;
			$this->data["email_admin"] = NULL;
			$this->data["user_lastactive_admin"] = NULL;
			$this->data["err"] = NULL;
			
			header("Location: "._MSFW_PATH_."modules/login/login/logout/".$p_motivo);
			exit();
		}
		
		public function check_session()
		{
			if(!isset($_SESSION['id_admin']))
			{
				if($this->data["logged"])
					$this->logout("closed");
				return "closed";
			}
			else
			{
				$oldtime = $this->data["user_lastactive_admin"];
				if(!empty($oldtime))
				{
					$currenttime = time();
					// this is equivalent to 30 minutes
					$timeoutlength = 30 * 60;
					if(($oldtime + $timeoutlength) >= $currenttime){ 
						// Set new user last active time
						$_SESSION['user_lastactive_admin'] = $currenttime;
						$this->data["user_lastactive_admin"] = $_SESSION['user_lastactive_admin'];
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