# TPO_2

Este proyecto esta destinado a la realizacion de el Trabajo Practico Obligatorio de WEB 2.

A continuacion se mostrará en cada apartado el uso de la api con sus respectivos endpoints para acceder a las distintas funcionalidades de las diferentes tablas, algunas de las cuales deben hacer uso de un token Bearer de autenticacion tipo Basic.
 El username y password para obtenerlo son:

        Username:    lucascarmusciano@gmail.com
        Password:    12345

## Monstruo 

URL Base: http://localhost:8080/tucarpetalocal/TPO_2/api/monster

Valores de la tabla: id, nombre, debilidad, descripcion, id_Categoria_fk, imagen.

### Obtener Monstruos

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/monster  ==  (url base)
* Método: GET
* Posibles funcionalidades (junto al uso combinado de estas): 
    1. ***Ordenamiento*** -> Es necesario generar un parametro GET con el nombre "order" y siendo igual a cualquier valor de la tabla a excepcion de 'id_Categoria_fk' el cual fue reemplazado por 'categoria'. Ademas de esto, la lista es posible ordenarla de forma ascendente o descendente, esto es logrado con el parametro GET "direction", el cual debe ser igual a ASC o DESC (en caso de no aclarar *direction*, tomará un valor por defecto igual a ASC).

        Por ejemplo:

        URL?order=nombre  **->  obtiene el listado ordenado por nombre de forma ascendente**

        URL?order=categoria&direction=DESC  **->  obtiene el listado ordenado por categoria de forma descendente**

    2. ***Filtrado*** -> Es necesario generar un parametro GET en el nombre "categorie" el cual coincida con el nombre de las categorias a las cuales estan asignados los monstruos buscados.

        Por ejemplo:

        URL?categorie=Bestias  **->  obtiene el listado de todos los monstruos con categoria llamada Bestias**
            
    3. ***Paginación*** -> Es necesario generar un parametro GET en el nombre "page" para obtener el valor entero de la página buscada y otro con el nombre "limit" para obtener el valor entero de la cantidad de elementos por página. Tener en cuenta que el valor de la pagina inicial es igual a 0.

        Por ejemplo:
            
        URL?page=1&limit=5  **->  obtiene el listado los monstruos de la página 1 con limite de pagina igual a 5, es decir, los elementos 5,6,7,8,9**

* Posibles respuestas: 
    1. 200 
    2. 400-499 (junto a un mensaje detallando su error)
* Ejemplo de uso:

        Si quiero obtener la lista de los monstruos que se encuentran en la pagina 2 (y cada pagina cuenta con 3 elementos), de 
        tipo 'Ogro' y ordenarlos de forma ascendente segun su debilidad:

        http://localhost:8080/tucarpetalocal/TPO_2/api/monster?order=debilidad&direction=ASC&categorie=Ogro&page=2&limit=3
        

### Obtener solo un Monstruo

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/monster/id  ==  (url base)/id
* Metodo: GET
* Posibles respuestas: 
    1. 200 
    2. 400-499 (junto a un mensaje detallando su error)
* Ejemplo de uso:

        Obtengo el monstruo con el id 41:

        http://localhost:8080/tucarpetalocal/TPO_2/api/monster/41

### Borrar Monstruo

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/monster/id  ==  (url base)/id
* Metodo: DELETE
* Posibles respuestas: 
    1. 200 
    2. 400-499 (junto a un mensaje detallando su error)
* Parametros:
    1. Token de autenticacion (header)
* Ejemplo de uso:

        Luego de ingresarme y obtener el token, borro el monstruo con el id 16:

        http://localhost:8080/tucarpetalocal/TPO_2/api/monster/16

### Insertar Monstruo

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/monster  ==  (url base)
* Metodo: POST
* Posibles respuestas: 
    1. 201 CREATED 
    2. 400-499 (junto a un mensaje detallando su error)
* Parametros:
    1. Token de autenticacion (header)
    2. Datos a ingresar (body)
* Ejemplo de uso:

        Luego de ingresarme y obtener el token, agrego los datos para crear un nuevo monstruo en el body, haciendo uso del 
        endpoint:

        [body]
        {
            "nombre": "CualquierMonstruo",
            "debilidad": "Cualquiera",
            "descripcion": "Cualquiera",
            "id_Categoria_fk": "18"
        }

        [request URL]
        http://localhost:8080/tucarpetalocal/TPO_2/api/monster

### Editar Monstruo

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/monster/id  ==  (url base)/id
* Metodo: PUT
* Posibles respuestas: 
    1. 201 CREATED 
    2. 400-499 (junto a un mensaje detallando su error)
* Parametros:
    1. Token de autenticacion (header)
    2. Datos a ingresar (body)
* Ejemplo de uso:

        Luego de ingresarme y obtener el token, agrego el nuevo nombre y debilidad (sus valores no definidos conservaran su 
        valor previo) para modificar al monstruo con el id 22 en el body, haciendo uso del endpoint:

        [body]
        {
            "nombre": "MonstruoModificado",
            "debilidad": "Ninguna"
        }

        [request URL]
        http://localhost:8080/tucarpetalocal/TPO_2/api/monster/22

## Categoria 

URL Base: http://localhost:8080/tucarpetalocal/TPO_2/api/categorie

Valores de la tabla: id, nombre, descripcion.

### Obtener Categorias

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/categories  ==  (url base)
* Método: GET
* Posibles funcionalidades (junto al uso combinado de estas): 
    1. ***Ordenamiento*** -> Es necesario generar un parametro GET con el nombre "order" y siendo igual a cualquier valor de la tabla. Ademas de esto, la lista es posible ordenarla de forma ascendente o descendente, esto es logrado con el parametro GET "direction", el cual debe ser igual a ASC o DESC (en caso de no aclarar *direction*, tomará un valor por defecto igual a ASC).

        Por ejemplo:

        URL?order=descripcion  **->  obtiene el listado ordenado por descripción de forma ascendente**

        URL?order=nombre&direction=DESC  **->  obtiene el listado ordenado por categoria de forma descendente**       
    2. ***Paginación*** -> Es necesario generar un parametro GET en el nombre "page" para obtener el valor entero de la página buscada y otro con el nombre "limit" para obtener el valor entero de la cantidad de elementos por página. Tener en cuenta que el valor de la pagina inicial es igual a 0.

        Por ejemplo:
            
        URL?page=2&limit=2  **->  obtiene el listado los monstruos de la página 2 con limite de pagina igual a 2, es decir, los elementos 4,5**

* Posibles respuestas: 
    1. 200 
    2. 400-499 (junto a un mensaje detallando su error)
* Ejemplo de uso:

        Obtengo las categorias 3,4,5 (pagina 1 con limite 3) ordenadas de forma descendente segun su id:

        http://localhost:8080/tucarpetalocal/TPO_2/api/categorie?order=id&direction=DESC&page=1&limit=3
        

### Obtener solo una Categoria

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/categorie/id  ==  (url base)/id
* Metodo: GET
* Posibles respuestas: 
    1. 200 
    2. 400-499 (junto a un mensaje detallando su error)
* Ejemplo de uso:

        Obtengo la categoria con el id 16:

        http://localhost:8080/tucarpetalocal/TPO_2/api/categorie/16

### Borrar Categoria

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/categorie/id  ==  (url base)/id
* Metodo: DELETE
* Posibles respuestas: 
    1. 200 
    2. 400-499 (junto a un mensaje detallando su error)
* Parametros:
    1. Token de autenticacion (header)
* Ejemplo de uso:

        Luego de ingresarme y obtener el token, borro la categoria con el id 18:

        http://localhost:8080/tucarpetalocal/TPO_2/api/categorie/18

### Insertar Categoria

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/categorie  ==  (url base)
* Metodo: POST
* Posibles respuestas: 
    1. 201 CREATED 
    2. 400-499 (junto a un mensaje detallando su error)
* Parametros:
    1. Token de autenticacion (header)
    2. Datos a ingresar (body)
* Ejemplo de uso:

        Luego de ingresarme y obtener el token, agrego los datos para crear una nueva categoria en el body, haciendo uso del 
        endpoint:

        [body]
        {
            "nombre": "Categoria",
            "descripcion": "..."
        }

        [request URL]
        http://localhost:8080/tucarpetalocal/TPO_2/api/categorie

### Editar Categoria

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/categorie/id  ==  (url base)/id
* Metodo: PUT
* Posibles respuestas: 
    1. 201 CREATED 
    2. 400-499 (junto a un mensaje detallando su error)
* Parametros:
    1. Token de autenticacion (header)
    2. Datos a ingresar (body)
* Ejemplo de uso:

        Luego de ingresarme y obtener el token, agrego la nueva descripción (sus valores no definidos conservaran su 
        valor previo) para modificar la categoria con el id 12 en el body, haciendo uso del endpoint:

        [body]
        {
            "descripcion": "Esta categoria fue modificada"
        }

        [request URL]
        http://localhost:8080/tucarpetalocal/TPO_2/api/categorie/12



## Reporte 

URL Base: http://localhost:8080/tucarpetalocal/TPO_2/api/report

Valores de la tabla: id, narrador, historia, agresividad, id_Monstruo_fk.

### Obtener Reportes

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/report  ==  (url base)
* Método: GET
* Posibles funcionalidades (junto al uso combinado de estas): 
    1. ***Ordenamiento*** -> Es necesario generar un parametro GET con el nombre "order" y siendo igual a cualquier valor de la tabla a excepcion de 'id_Monstruo_fk' el cual fue reemplazado por 'monstruo'. Ademas de esto, la lista es posible ordenarla de forma ascendente o descendente, esto es logrado con el parametro GET "direction", el cual debe ser igual a ASC o DESC (en caso de no aclarar *direction*, tomará un valor por defecto igual a ASC).

        Por ejemplo:

        URL?order=narrador  **->  obtiene el listado ordenado por narrador de forma ascendente**

        URL?order=agresividad&direction=DESC  **->  obtiene el listado ordenado por agresividad de forma descendente**

    2. ***Filtrado*** -> Es necesario generar un parametro GET en el nombre "monster" el cual coincida con el nombre de los monstruos a los cuales estan asignados los reportes buscados.

        Por ejemplo:

        URL?monster=Jabali  **->  obtiene el listado de todos los reportes al monstruo Jabali**
            
    3. ***Paginación*** -> Es necesario generar un parametro GET en el nombre "page" para obtener el valor entero de la página buscada y otro con el nombre "limit" para obtener el valor entero de la cantidad de elementos por página. Tener en cuenta que el valor de la pagina inicial es igual a 0.

        Por ejemplo:
            
        URL?page=0&limit=3  **->  obtiene el listado los monstruos de la página 0 con limite de pagina igual a 3, es decir, los elementos 0,1,2**

* Posibles respuestas: 
    1. 200 
    2. 400-499 (junto a un mensaje detallando su error)
* Ejemplo de uso:

        Obtengo la lista de reportes de Djinn que se encuentran en la pagina 4, siendo que se muetra solo dos reportes por pagina, ordenados de forma descendente segun su narrador:

        http://localhost:8080/tucarpetalocal/TPO_2/api/report?order=narrador&direction=DESC&categorie=Djinn&page=4&limit=2
        

### Obtener solo un Reporte

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/report/id  ==  (url base)/id
* Metodo: GET
* Posibles respuestas: 
    1. 200 
    2. 400-499 (junto a un mensaje detallando su error)
* Ejemplo de uso:

        Obtengo el reporte con el id 2:

        http://localhost:8080/tucarpetalocal/TPO_2/api/monster/2

### Borrar Reporte

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/report/id  ==  (url base)/id
* Metodo: DELETE
* Posibles respuestas: 
    1. 200 
    2. 400-499 (junto a un mensaje detallando su error)
* Parametros:
    1. Token de autenticacion (header)
* Ejemplo de uso:

        Luego de ingresarme y obtener el token, borro el reporte con el id 1:

        http://localhost:8080/tucarpetalocal/TPO_2/api/report/1

### Insertar Reporte

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/report  ==  (url base)
* Metodo: POST
* Posibles respuestas: 
    1. 201 CREATED 
    2. 400-499 (junto a un mensaje detallando su error)
* Parametros:
    1. Token de autenticacion (header)
    2. Datos a ingresar (body)
* Ejemplo de uso:

        Luego de ingresarme y obtener el token, agrego los datos un reporte nuevo en el body, haciendo uso del 
        endpoint:

        [body]
        {
            "narrador": "Anonimo",
            "agresividad": 0,
            "historia": "...",
            "id_Monstruo_fk": 50 
        }

        [request URL]
        http://localhost:8080/tucarpetalocal/TPO_2/api/report

### Editar Reporte

* URL: http://localhost:8080/tucarpetalocal/TPO_2/api/report/id  ==  (url base)/id
* Metodo: PUT
* Posibles respuestas: 
    1. 201 CREATED 
    2. 400-499 (junto a un mensaje detallando su error)
* Parametros:
    1. Token de autenticacion (header)
    2. Datos a ingresar (body)
* Ejemplo de uso:

        Luego de ingresarme y obtener el token, agrego otro nivel de agresividad y narrador (sus valores no definidos 
        conservaran su valor previo) para modificar el reporte con el id 2 en el body, haciendo uso del endpoint:

        [body]
        {
            "narrador": "Ciudadano Comun",
            "agresividad": 5
        }

        [request URL]
        http://localhost:8080/tucarpetalocal/TPO_2/api/report/2
