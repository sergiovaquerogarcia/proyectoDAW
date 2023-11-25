<?php
    class usuario {
		private $codUsuario;
        private $dni;
		private $clave;
		private $email;
        private $nombre;
		private $direccion;
		private $cp;
        private $poblacion;
        private $provincia;
        private $telefono;
		private $tipoUsuario;
		private $activo;
      
		public function getCodUsuario() {
		    return $this->codUsuario;
	    }
	    public function getDni() {
		    return $this->dni;
	    }

	    public function getNombre()
	    {
		    return $this->nombre;
	    }

		public function getClave()
	    {
		    return $this->clave;
	    }

		public function getTipoUsuario()
	    {
		    return $this->tipoUsuario;
	    }

		public function getDireccion()
	    {
		    return $this->direccion;
	    }

		public function getCp()
	    {
		    return $this->cp;
	    }

		public function getPoblacion()
	    {
		    return $this->poblacion;
	    }

		public function getProvincia()
	    {
		    return $this->provincia;
	    }

		public function getTelefono()
	    {
		    return $this->telefono;
	    }

		public function getEmail()
	    {
		    return $this->email;
	    }

		public function getActivo()
	    {
		    return $this->activo;
	    }
    
		public function setCodUsuario($codUsuario1)
	    {
			$this->codUsuario = $codUsuario1;
	    }
    	public function setDni($dni1)
	    {
			$this->dni = $dni1;
	    }

		public function setNombre($nombre1)
	    {
		    $this->nombre = $nombre1;
	    }

		public function setClave($clave1)
	    {
		    $this->clave = $clave1;
	    }

		public function setTipoUsuario($tipoUsuario1)
	    {
		    $this->tipoUsuario = $tipoUsuario1;
	    }

		public function setDireccion($direccion1)
	    {
		    $this->direccion = $direccion1;
	    }

		public function setCp($cp1)
	    {
		    $this->cp = $cp1;
	    }

		public function setPoblacion($poblacion1)
	    {
		    $this->poblacion = $poblacion1;
	    }

		public function setProvincia($provincia1)
	    {
		    $this->provincia = $provincia1;
	    }

		public function setTelefono ($telefono1)
	    {
		    $this->telefono = $telefono1;
	    }

		public function setEmail ($email1)
	    {
		    $this->email = $email1;
	    }

		public function setActivo ($activo1)
	    {
		    $this->activo = $activo1;
	    }
	}
?>