#Linux Server Monitor Dashboard

Dashboard ligero para monitorear recursos del sistema en tiempo real. Este proyecto muestra la integración de BASH a niveld de kernel y una interfaz web moderna.

#Funcionalidades

--Monitoreo en tiempo real de CPU, RAM y Uso de Disco.
--Backend en Bash: Extraccion directa de datos desde `/proc/start` , `/proc/meminfo` y comandos nativos.
--Interfaz web: Visualización limpia usando HTML5, CSS3 y JavaScript para actualizaciones dinámicas.
--Sin dependencias pesadas: NO requiere bases de datos ni frameworks complejos.



#Tecnologías usadas


--Linux/Bash: Lógica de extracción de datos y manipulación de texto.
--PHP : Middleware para comunicar el servidor con el navegador.
--JavaScript(AJAX): Para refrescar los datos sin recargar la página.
--HTML/CSS: Maquetación y estilos del dashboard.

##Requisitos

--Un servidor Linux (Ubuntu/Debian/CentOS).
--Servidor web (Apache/Nginx).
--PHP instalado.

#Instalación y uso

1. Clonar el repositorio en tu carpeta `/var/www/html` (o tu directorio web):

```bash
git clone [https://github.com/TU_USUARIO/linux-sysadmin-dashboard.git] (https://github.com/TU_USUARIO/linux-sysadmin-dashboard.git)