<?php
    class producto {
        private $codigo;
        private $nombre;
		private $descripcion;
		private $codigoCategoria;
        private $precio;
		private $descuento;
        private $imagen;
		private $activo;
        
	    public function getCodigo() {
		    return $this->codigo;
	    }

	    public function getNombre()
	    {
		    return $this->nombre;
	    }

		public function getDescripcion()
	    {
		    return $this->descripcion;
	    }

		public function getCodigoCategoria()
	    {
		    return $this->codigoCategoria;
	    }

		public function getPrecio()
	    {
		    return $this->precio;
	    }

		public function getDescuento()
	    {
		    return $this->descuento;
	    }

		public function getImagen()
	    {
		    return $this->imagen;
	    }

		public function getActivo()
	    {
		    return $this->activo;
	    }

		public function setCodigo($codigo1)
	    {
			$this->codigo = $codigo1;
	    }

		public function setNombre($nombre1)
	    {
		    $this->nombre = $nombre1;
	    }

		public function setDescripcion($descripcion1)
	    {
		    $this->descripcion = $descripcion1;
	    }

		public function setCodigoCategoria($codigoCategoria1)
	    {
		    $this->codigoCategoria = $codigoCategoria1;
	    }

		public function setPrecio($precio1)
	    {
		    $this->precio = $precio1;
	    }

		public function setDescuento($descuento1)
	    {
		    $this->descuento = $descuento1;
	    }

		public function setImagen ($imagen1)
	    {
		    $this->imagen = $imagen1;
	    }

		public function setActivo ($activo1)
	    {
		    $this->activo = $activo1;
	    }
	}
?>