# Symfony 5 con Docker
**Para crear un ambiente desde cero**

Desde la carpeta raíz del projecto ejecuta en una terminal lo siguiente, teniendo en cuenta que los archivos de la aplicacion están la carpeta ***./symfony*** y el accespoint en ***./symfony/public***
```
sudo docker-compose up --build
```

## Si descargaste algún proyecto desde git
Teniendo en cuenta que los archivos de la aplicacion están la carpeta ***./symfony*** y el accespoint en ***./symfony/public***
```
sudo docker exec -it php bash
```
## Probar el código localmente
```
http://localhost/
```
## Usar la consola de symfony
```
sudo docker exec -it php bash
```
Una vez que estes en la siguiente carpeta:
```
root@2af8f40ac257:/var/www/html# 
```
Y entonces, ejecutar:
```
bin/console
```
