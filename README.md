# TPO_2

Este proyecto esta destinado a la realizacion de el Trabajo Practico Obligatorio de WEB 2.

A continuacion se mostrará en cada apartado el uso de la api con sus respectivos endpoints para acceder a las distintas funcionalidades de las diferentes tablas.

## Monstruo 

URL Base: http://localhost:8080/*tucarpetalocal*/TPO_2/api/monster.

Valores de la tabla: id, nombre, debilidad, descripcion, id_Categoria_fk, imagen.

### Obtener Monstruos

* URL: http://localhost:8080/*tucarpetalocal*/TPO_2/api/monster (url base)
* Método: GET
* Posibles funcionalidades (junto al uso combinado de estas): 
    1. ***Ordenamiento*** -> Es necesario generar un parametro GET con el nombre "order" y siendo igual a cualquier valor de la tabla a excepcion de 'id_Categoria_fk' el cual fue reemplazado por 'categoria'. Ademas de esto, la lista es posible ordenarla de forma ascendente o descendente, esto es logrado con el parametro GET "direction", el cual debe ser igual a ASC o DESC (en caso de no aclarar *direction*, tomará un valor por defecto igual a ASC).

            Por ejemplo:

            *URL*?order=nombre  **obtiene el listado ordenado por nombre de forma ascendente**

            *URL*?order=categoria&direction=DESC  **obtiene el listado ordenado por categoria de forma descendente**

    2. ***Filtrado*** -> Es necesario generar un parametro GET en el nombre "categorie" el cual coincida con el nombre de las categorias a las cuales estan asignados los monstruos buscados.

            Por ejemplo:

            *URL*?categorie=Bestias  **obtiene el listado de todos los monstruos con categoria llamada Bestias**
            
    3. ***Paginación*** -> Es necesario generar un parametro GET en el nombre "page" para obtener el valor entero de la página buscada y otro con el nombre "limit" para obtener el valor entero de la cantidad de elementos por página. Tener en cuenta que el valor de la pagina inicial es igual a 0.

            Por ejemplo:
            
        *URL*?page=1&limit=5  **obtiene el listado los monstruos de la página 1 con limite de pagina igual a 5, es decir, los elementos 5,6,7,8,9**

* Posibles respuestas: 
    1. 200 
    2. 400-499 (junto a un mensaje detallando su error)

### Obtener solo un Monstruo


