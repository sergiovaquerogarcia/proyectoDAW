<?php
    class cita {
        private $codCita;
		private $codUsuario;
		private $fechaCita;
        private $horaCita;
		private $total;
        
	    public function getCodCita() {
		    return $this->codCita;
	    }

	    public function getCodUsuario()
	    {
		    return $this->codUsuario;
	    }

		public function getFechaCita()
	    {
		    return $this->fechaCita;
	    }

		public function getHoraCita()
	    {
		    return $this->horaCita;
	    }

		public function getTotal()
	    {
		    return $this->total;
	    }

		public function setCodCita($codCita1)
	    {
			$this->codCita = $codCita1;
	    }

		public function setCodUsuario($codUsuario1)
	    {
		    $this->codUsuario = $codUsuario1;
	    }

		public function setFechaCita($fechaCita1)
	    {
		    $this->fechaCita = $fechaCita1;
	    }

		public function setHoraCita ($horaCita1)
	    {
		    $this->horaCita = $horaCita1;
	    }
		public function setTotal ($total1)
	    {
		    $this->total = $total1;
	    }
	}
?>