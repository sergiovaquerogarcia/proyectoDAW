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
  //valido el email
  var email = document.formLogin.email.value;
  if (email.length==0){
            alert("ERROR!!! TIENE QUE ESCRIBIR SU EMAIL.")
            document.fLogin.email.focus();
            return false;
     }
  else {
      email = validarEmail (email);
      if (email == "") {
          alert("ERROR!! EL EMAIL INTRODUCIDO NO ES CORRECTO.");
          document.formLogin.email.focus();
          return false;
      }
   }

   //valido que la contraseña no esté en blanco.
   if (document.formLogin.clave.value.length==0){
      alert("ERROR!!!! TIENE QUE ESCRIBIR SU CONTRASEÑA.")
      document.fvalida.nombre.focus()
      return false;
   }
   //el formulario se envia
   alert("Muchas gracias por enviar el formulario");
   document.fvalida.submit();
   return true;
}

$(window).scroll(function() {
    
   var position =$(this).scrollTop();
   
    // Si el usuario baja el scroll muestro el div qeu contiene el enlace botón
    if (position > 300) {
     $(".boton-subir").fadeIn('slow');

    } else {
     $(".boton-subir").fadeOut('slow');
    }

});
