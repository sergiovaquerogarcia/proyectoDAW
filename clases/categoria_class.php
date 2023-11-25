<?php
    class categoria {
        private $codigo;
		private $nombre;
		private $activo;
		private $codCatPadre;
        
        
	    public function getCodigo() {
		    return $this->codigo;
	    }

	    public function getNombre()
	    {
		    return $this->nombre;
	    }

		public function getCodCatPadre()
	    {
		    return $this->codCatPadre;
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

		public function setCodCatPadre($codCatPadre1)
	    {
		    $this->codCatPadre = $codCatPadre1;
	    }

		public function setActivo ($activo1)
	    {
		    $this->activo = $activo1;
	    }
	}
?>