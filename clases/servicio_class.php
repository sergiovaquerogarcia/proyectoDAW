<?php
    class servicio {
        private $codServicio;
        private $descripcion;
		private $precio;
		private $descuento;
        private $activo;
		private $duracionServicio;
		private $codFamilia;
        
	    public function getCodServicio() {
		    return $this->codServicio;
	    }

	   	public function getDescripcion()
	    {
		    return $this->descripcion;
	    }

		public function getPrecio()
	    {
		    return $this->precio;
	    }

		public function getDescuento()
	    {
		    return $this->descuento;
	    }

		public function getActivo()
	    {
		    return $this->activo;
	    }

		public function getDuracionServicio()
	    {
		    return $this->duracionServicio;
	    }

		public function getCodFamilia()
	    {
		    return $this->codFamilia;
	    }

		public function setCodServicio($codServicio1)
	    {
			$this->codServicio = $codServicio1;
	    }

		public function setDescripcion($descripcion1)
	    {
		    $this->descripcion = $descripcion1;
	    }

		public function setPrecio($precio1)
	    {
		    $this->precio = $precio1;
	    }

		public function setDescuento($descuento1)
	    {
		    $this->descuento = $descuento1;
	    }

		public function setActivo ($activo1)
	    {
		    $this->activo = $activo1;
	    }

		public function setDuracionServicio ($duracionServicio1)
	    {
		    $this->duracionServicio = $duracionServicio1;
	    }

		public function setCodFamilia ($codFamilia1)
	    {
		    $this->codFamilia = $codFamilia1;
	    }
	}
?>