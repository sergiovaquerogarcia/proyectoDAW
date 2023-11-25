<?php
    class linpedido {
        private $numLinea;
        private $numPedido;
		private $codProducto;
		private $unidades;
        private $precio;
        
	    public function getNumLinea() {
		    return $this->numLinea;
	    }
		public function getNumPedido() {
		    return $this->numPedido;
	    }

	    public function getCodProducto()
	    {
		    return $this->codProducto;
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
		public function setNumPedido($numPedido1)
	    {
			$this->numPedido = $numPedido1;
	    }

		public function setCodProducto($codProducto1)
	    {
		    $this->codProducto = $codProducto1;
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