<?php
    class lincita {
        private $numLinea;
        private $codCita;
		private $codServicio;
		private $unidades;
        private $precio;
        
	    public function getNumLinea() {
		    return $this->numLinea;
	    }
		
		public function getCodCita() {
		    return $this->codCita;
	    }

	    public function getCodServicio()
	    {
		    return $this->codServicio;
	    }

		public function getUnidades()
	    {
		    return $this->unidades;
	    }

		public function getPrecio()
	    {
		    return $this->precio;
	    }

		public function setNumLinea($numLinea1)
	    {
			$this->numLinea = $numLinea1;
	    }
		public function setCodCita($codCita1)
	    {
			$this->codCita = $codCita1;
	    }

		public function setCodServicio($codServicio1)
	    {
		    $this->codServicio = $codServicio1;
	    }

		public function setUnidades($unidades1)
	    {
		    $this->unidades = $unidades1;
	    }

		public function setPrecio ($precio1)
	    {
		    $this->precio = $precio1;
	    }
	}
?>