<?php
    class familia {
        private $codFamilia;
		private $nombre;
		private $activo;
		      
        public function getCodigoFamilia() {
		    return $this->codFamilia;
	    }

	    public function getNombre()
	    {
		    return $this->nombre;
	    }

		public function getActivo()
	    {
		    return $this->activo;
	    }

		public function setCodigoFamilia($codFamilia1)
	    {
			$this->codFamilia = $codFamilia1;
	    }

		public function setNombre($nombre1)
	    {
		    $this->nombre = $nombre1;
	    }

		public function setActivo ($activo1)
	    {
		    $this->activo = $activo1;
	    }
	}
?>