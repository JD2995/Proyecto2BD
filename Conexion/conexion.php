<?php
	class conexion{
		private $id;
		private $usuario;
		private $contrasena;
		private $nombreBD;
		private $dbhome;

		public function setParameters($pID,$pUser,$pPass,$pBD){
			$this->id = $pID;
			$this->usuario = $pUser;
			$this->contrasena = $pPass;
			$this->nombreBD = $pBD;
			$this->id = NULL;
		}

		public function setConnection(){
			$this->id = mysqli_connect($this->dbhome,$this->usuario,$this->contrasena,$this->nombreBD);
			if($this->id->connect_errno){
				//echo $this->id->connect_errno;
				return false;
			}
			else{
				//echo $this->id->host_info;
				return true;
			}
		}

		public function getData($pTableName){
			$consulta = "select * from ".$pTableName;
			$resultado = $this->id->query($consulta);
			if(!$resultado){
				echo $this->id->error;
				return NULL;
			}
			else{
				return $resultado;	
			}
		}

		public function getTablas(){
			$consulta = "call nombreTablas()";
			$resultado = $this->id->query($consulta);
			if(!$resultado){
				return NULL;
			}
			else{
				return $resultado;
			}
		}

		public function getID(){
			return $this->id;
		}
	}
?>	