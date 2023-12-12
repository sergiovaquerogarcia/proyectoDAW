let date = new Date(),
    currYear = date.getFullYear(),
    currMonth = date.getMonth();

const TagDias = document.querySelector(".dias"),
    fechaActual = document.querySelector(".fecha-actual"),
    prevNextIcon = document.querySelectorAll(".iconos span");

// almacenamos los meses en la matriz
const meses = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
];

const generarCalendario = () => {
    let primerDiaMes = new Date(currYear, currMonth, 0).getDay(), // obtenemos el primer día del mes. El 0 hace que el primer día de la semana sea lunes
        ultimaFechaMes = new Date(currYear, currMonth + 1, 0).getDate(), // obtenemos la última fecha del mes
        ultimoDiaMes = new Date(currYear, currMonth, ultimaFechaMes).getDay(), // obtenemos el último día del mes
        ultimaFechaMesPasado = new Date(currYear, currMonth, 0).getDate(); // obtenemos la última fecha del mes anterior
    let liTag = "";

    for (let i = primerDiaMes; i > 0; i--) {
        // creamos los li del mes anterior. Para mostrar los últimos días
        liTag += `<li class="inactive">${ultimaFechaMesPasado - i + 1}</li>`;
        
    }
    for (let i = 1; i <= ultimaFechaMes; i++) {   

        // creamos el li de todos los días del mes actual
        // añadimos la clase como activa al li si el día, mes y año actuales coinciden. Se incluye en el día actual 
        let esHoy =
            i === date.getDate() &&
                currMonth === new Date().getMonth() &&
                currYear === new Date().getFullYear()
                ? "active"
                : "";
	
        if (new Date(currYear, currMonth, i).getDay() == 0) {
            liTag += `<li class="inactive">${i}</li>`;
        }
        else if (currYear > 2023 || currYear > 2024 || currYear > 2025 || currYear > 2026 || currYear > 2027 || currYear > 2028 )  {
            if (currMonth == 10 && i != 1) {
                liTag += `<li class="${esHoy}"><a href="/beautyandshop/citas/editarServicio.php?codCita=${codCita}&dia=${i}&mes=${currMonth}&anyo=${currYear}">${i}</a></li>`;
            }
            else if (currMonth == 4 && i != 1) {
                liTag += `<li class="${esHoy}"><a href="/beautyandshop/citas/editarServicio.php?codCita=${codCita}&dia=${i}&mes=${currMonth}&anyo=${currYear}">${i}</a></li>`;
            }
            else if (currMonth == 7 && i != 15) {
                liTag += `<li class="${esHoy}"><a href="/beautyandshop/citas/editarServicio.php?codCita=${codCita}&dia=${i}&mes=${currMonth}&anyo=${currYear}">${i}</a></li>`;
            }
            else if (currMonth == 11 && i != 25) {
                liTag += `<li class="${esHoy}"><a href="/beautyandshop/citas/editarServicio.php?codCita=${codCita}&dia=${i}&mes=${currMonth}&anyo=${currYear}">${i}</a></li>`;
            }
            else if (currMonth == 0 && (i != 1 && i != 6)) {
                liTag += `<li class="${esHoy}"><a href="/beautyandshop/citas/editarServicio.php?codCita=${codCita}&dia=${i}&mes=${currMonth}&anyo=${currYear}">${i}</a></li>`;	
            }
            else if( currMonth > 0 && currMonth != 11 && currMonth != 7 && currMonth != 4 && currMonth != 10) {
                liTag += `<li class="${esHoy}"><a href="/beautyandshop/citas/editarServicio.php?codCita=${codCita}&dia=${i}&mes=${currMonth}&anyo=${currYear}">${i}</a></li>`;
            }
            else {
                liTag += `<li class="inactive">${i}</li>`;
            }
            //liTag += `<li class="${esHoy}"><a href="/beautyandshop/citas/editarServicio.php?codCita=${codCita}&dia=${i}&mes=${currMonth}&anyo=${currYear}">${i}</a></li>`;
        }
        else if(currMonth == 10 && currYear === new Date().getFullYear() && i== 1)  {
            liTag += `<li class="inactive">${i}</li>`;
        }
        else if(currMonth == 4 && currYear === new Date().getFullYear() && i== 1)  {
            liTag += `<li class="inactive">${i}</li>`;
        }
        else if(currMonth == 7 && currYear === new Date().getFullYear() && i== 15)  {
            liTag += `<li class="inactive">${i}</li>`;
        }
        else if(currMonth == 11 && currYear === new Date().getFullYear() && i== 25)  {
            liTag += `<li class="inactive">${i}</li>`;
        }
        else if(i >= date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear())  {
            let fechaConsultar = currYear + "-" + (currMonth + 1) + "-" + i;
            liTag += `<li class="${esHoy}"><a href="/beautyandshop/citas/editarServicio.php?codCita=${codCita}&dia=${i}&mes=${currMonth}&anyo=${currYear}">${i}</a></li>`;
        }
        else if (currMonth > new Date().getMonth() && currYear === new Date().getFullYear())  {
            liTag += `<li class="${esHoy}"><a href="/beautyandshop/citas/editarServicio.php?codCita=${codCita}&dia=${i}&mes=${currMonth}&anyo=${currYear}">${i}</a></li>`;
        }
        else { 
             liTag += `<li class="inactive">${i}</li>`;
        }
    }

    for (let i = ultimoDiaMes; i < 7; i++) {
        // creamos el li del próximo mes. Se muestran los primeros días del mes
        liTag += `<li class="inactive">${i - ultimoDiaMes + 1}</li>`;
    }

    fechaActual.innerText = `${meses[currMonth]} ${currYear}`; // pasando el mes y el año actuales como texto de fecha actual. Se muestra en la parte superior del calendario
    TagDias.innerHTML = liTag;
};

generarCalendario();

prevNextIcon.forEach((icon) => {
    // iconos anterior y siguiente
    icon.addEventListener("click", () => {
        // añadimos evento de clic en ambos íconos
        // si el icono en el que se hizo clic es el icono anterior, disminuimos el mes actual en 1; de lo contrario, se incrementa en 1
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if (currMonth < 0 || currMonth > 11) {
            // si el mes actual es menor que 0 o mayor que 11
            // creamos una nueva fecha del año y mes actual, para pasarla como valor de fecha
            date = new Date(currYear, currMonth);
            currYear = date.getFullYear(); // actualizamos el año actual con nueva fecha año
            currMonth = date.getMonth(); // actualizamos el mes actual con el nuevo mes de fecha
        } else {
            date = new Date(); // pasar la fecha actual como valor de fecha
        }
        generarCalendario(); // llamamos a la función renderCalendar
    });
});
