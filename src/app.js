function actualizarDatos(){

    //Pedir datos a php (ajax)

    fetch('data.php')
    .then(respuesta=> respuesta.json()) //Convierte texto a JSON
    .then(datos=>{
        console.log("Datos recibidos:", datos)
    

    //Rellenar datos

    document.getElementById('hostname').innerText = datos.sistema.hostname;
    document.getElementById('uptime').innerText = datos.sistema.uptime;

    document.getElementById('cpu-load').innerText= datos.hardware.cpu_load;
    document.getElementById('ram-usada').innerText= datos.hardware.ram.usada;

    document.getElementById('ram-total').innerText = datos.hardware.ram.total;
    document.getElementById('disk-usage').innerText = datos.hardware.disco.uso_porcentaje;

    //Logica de los colores, si el disco sobrepasa el 80% se activa el color rojo

    const tarjetaDisco = document.getElementById('card-disco');
    if (datos.hardware.disco.uso_porcentaje> 80){
        tarjetaDisco.className = "card alerta";
    } else {
        tarjetaDisco.className = "card-ok";
    }

    //Bucle de servicios

    const listaHTML = document.getElementById ('lista-servicios');
    listaHTML.innerHTML = "";

    //datos.servicios es el array que se envia desde PHP

    datos.servicios.forEach(servicio => {

        //creacion de li por cada servicio
        const item = document.createElement ('li');

        let iconoClase = "";
        let colorClase = "";

        //definicion icono segun estado ROJO/VERDE

       if (servicio.estado === 'Activo'){
        iconoClase= "fa-solid fa-server";
        colorCLase = "color-ok";
       } else {
        iconoClase= "fa-solid fa-triangle-exclamation";
        colorClase= "color-error";
       }
        
       //Inyeccion del html con el icono <i>

       item.innerHTML= ` 
       
       <i class= "${iconoClase} ${colorClase}"> </i>
       <strong> ${servicio.nombre}</strong>
       <span style= "color:#888; font-size: 0.8em">(${servicio.puerto})</span>
       
       `;


       listaHTML.appendChild(item);




    });
})

           .catch(error=> console.error("Error cargando datos:", error));





}

//Auto-Actualizacion

actualizarDatos();
setInterval(actualizarDatos, 3000);