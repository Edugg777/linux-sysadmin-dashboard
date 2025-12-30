<?php

//1. Constantes
//Definir una constante llamada "EMPRESA" con el valor de "TechSolutions"
//Recordar: No llevan $ al usarse

define("EMPRESA", "TechSolutions");


//Declaracion de tipo de variables
$hostname= "Servidor-Master-01";
$ip_address= "192.168.1.50";
$cpu_load= 12.5;
$uptime_dias= 45;
$es_seguro= true;
$servicios =[
     [
    "nombre"=> "Apache",
    "estado"=> "Activo",
    "puerto"=> 80
     ],
[
    "nombre"=> "MySQL",
    "estado"=> "Activo",
    "puerto"=> 3306
],
[
    "nombre"=> "SSH",
    "estado"=> "Inactivo",
    "puerto"=> 22
],
];


$ram_total = 16000;
$salida = shell_exec ("free -m | grep 'Mem' | awk '{print $3}'");
$clase_css = "normal";
$mensaje_ram = "";

$ram_real=(int)$salida;

$ram_disponible = $ram_total - $ram_real;

if ($ram_disponible>0){
    $mensaje_ram= "Hay espacio disponible en la RAM";
} else { 
    $mensaje_ram= "No hay espacio disponible en la RAM";
}

if ($ram_real>2000){
    $clase_css= "peligro";
} else {
    $clase_css= "normal";
}



?>

<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset= "UTF-8">
        <title>Estado del Servidor</title>
        <style>
            body {font-family: Arial, sans-serif; background-color: #f4f4f4}
            .tarjeta {background:white ; padding: 20px; border-radius: 8px; width: 300px ; margin:20px}
            h1 {color: #333; font-size: 1.2rem;}
            .normal {border-left: 10px solid green;}
            .peligro {border-left: 10px solid red;}
            .tarjeta-RAM {color: white; background:black ; padding: 20px; border-radius:8px; width:200px; margin:20px}
            .tarjeta-servicios {color: black; background:white; padding: 20px; border-radius: 8px; width:200px; margin:20px;}
            
            
            </style>

</head>
<body>

<div class="tarjeta">
    <h1>Reporte: <?php echo EMPRESA; ?></h1>
    <hr>
    <p><strong>Hostname:</strong> <?php echo $hostname; ?> 
    <p><strong>Carga CPU:</strong> <?php echo $cpu_load; ?>
    <p><strong>Conexion Segura:</strong> <?php echo $es_seguro; ?>
    <p><strong>Estado de la RAM: </strong> <?php echo $mensaje_ram; ?>
</div>
<div class = "tarjeta-RAM <?php echo $clase_css; ?>">
    <h2>Memoria Usada: <?php echo $ram_real; ?> MB</h2> </div>
    <div class = "tarjeta-servicios">
        <h3>Estado de Servicios</h3>
        <ul>
         <?php   foreach ($servicios as $servicio){
   echo "<li>" .$servicio["nombre"]. " corre en el puerto:" . $servicio["puerto"]. "</li>";
} ?>
</div>
</body>
</html>