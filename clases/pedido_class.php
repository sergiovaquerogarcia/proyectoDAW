<?php
    class pedido {
        private $numPedido;
		private $fechaPedido;
		private $codUsuario;
        private $estado;
		private $total;
        
	    public function getNumPedido() {
		    return $this->numPedido;
	    }

	    public function getFechaPedido()
	    {
		    return $this->fechaPedido;
	    }

		public function getCodUsuario()
	    {
		    return $this->codUsuario;
	    }

		public function getEstado()
	    {
		    return $this->estado;
	    }

		public function getTotal()
	    {
		    return $this->total;
	    }

		public function setNumPedido($numPedido1)
	    {
			$this->numPedido = $numPedido1;
	    }

		public function setFechaPedido($fechaPedido1)
	    {
		    $this->fechaPedido = $fechaPedido1;
	    }

		public function setCodUsuario($codUsuario1)
	    {
		    $this->codUsuario = $codUsuario1;
	    }

		public function setEstado ($estado1)
	    {
		    $this->estado = $estado1;
	    }
		public function setTotal ($total1)
	    {
		    $this->total = $total1;
	    }
	}
?>