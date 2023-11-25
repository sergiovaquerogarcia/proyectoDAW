function validarEntero(valor){
    //intento convertir a entero.
   //si era un entero no le afecta, si no lo era lo intenta convertir
   valor = parseInt(valor)

    //Compruebo si es un valor num�rico
    if (isNaN(valor)) {
          //entonces (no es numero) devuelvo el valor cadena vacia
          return "";
    }else{
          //En caso contrario (Si era un n�mero) devuelvo el valor
          return valor;
    }
}

function validarEmail(valor) {
  //alert ("EMAIL: " + valor);
   if (/^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/.test(valor)){
      //alert("La dirección de email " + valor + " es correcta.");
      return valor;
   } 
   else {
      //alert("La dirección de email es incorrecta.");
   return "";
   }
}

function validarTelefono(valor) {
   
   if( !(/^\d{9}$/.test(valor)) ) {
      return "";
   }
   else {
      return valor;
   }
}

function validarform(){
  //valido el nombre
  if (document.fvalida.nombre.value.length==0){
     alert("Tiene que escribir su nombre")
     document.fvalida.nombre.focus()
     return false;
  }

   //valido el email
  var email = document.fvalida.email.value;
  if (email.length==0){
            alert("Tiene que escribir su EMAIL")
            document.fvalida.email.focus();
            return false;
     }
  else {
      email = validarEmail (email);
      if (email == "") {
          alert("La dirección de EMAIL es incorrecta.");
          document.fvalida.email.focus();
          return false;
      }
   }

  //valido el teléfono
   var telefono = document.fvalida.telefono.value
   telefono = validarTelefono (telefono);
   if (telefono == "") {
      alert("El TELÉFONO son 9 números.");
      document.fvalida.telefono.focus();
      return false;
   }
      
   //valido el Asunto
  if (document.fvalida.asunto.value.length==0){
      alert("Tiene que escribir un ASUNTO")
      document.fvalida.asunto.focus()
      return false;
   }

   //valido el MENSAJE
   if (document.fvalida.mensaje.value.length==0){
      alert("Tiene que escribir un MENSAJE")
      document.fvalida.mensaje.focus()
      return false;
   }
   //el formulario se envia
   alert("Muchas gracias por enviar el formulario");
   document.fvalida.submit();
   return true;
}


