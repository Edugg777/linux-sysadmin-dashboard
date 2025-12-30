<?php

//data.php - API  de datos del Servidor(JSON)

// 1.Constantes/Configuración

header ('Content-type: application/json');

//Recopilación de datos

// Nombre del Servidor

$hostname = shell_exec ("hostname");

//CPU (LOAD AVARAGE)
//Obtener la carga del ultimo minuto

$cpu_load = shell_exec ("cat /proc/loadavg | awk '{print $1}'");

//Memoria RAM 
//Obtener memoria ram usada en MB

$ram_used_cmd = "free -m | grep 'Mem:' | awk '{print $3}'";
$ram_total_cmd = "free -m | grep 'Mem:' | awk '{print $2}'";

$ram_usada = (int)shell_exec($ram_used_cmd);
$ram_total = (int)shell_exec($ram_total_cmd);

$ram_libre = $ram_total - $ram_usada;

//Disco Duro (Espacio usado en la raiz /)

$disk_cmd = "df -h / | tail -1 | awk '{print $5}' | sed 's/%//g'";
$disk_usage = (int)shell_exec($disk_cmd);
$disk_free = 100 - $disk_usage;

//Tiempo de actividad

$uptime = shell_exec ("uptime -p");

//Simulacion del estado mediante una matriz

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

//Empaquetado (Creacion del JSON)

$respuesta = [
    "sistema" => [
        "hostname"=> trim ($hostname),
        "uptime"=> trim ($uptime)
    ],

    "hardware" =>[
        "cpu_load" => (float)$cpu_load,
        "ram"=>[
            "total"=> $ram_total,
            "usada"=> $ram_usada,
            "libre"=> $ram_libre
        ],
        "disco"=>[
            "uso_porcentaje"=> $disk_usage,
            "libre_porcentaje"=> $disk_free
        ]
        ],
        "servicios"=> $servicios
    ];

    //Envio. Conversion del array PHP a texto JSON

    echo json_encode($respuesta);







?>