# Импорт Excel файл в MySQL Database с использованием PHP

![Image alt](https://github.com/seryy366/XLSXParser/blob/main/img.png)

## Описание Приложения
##### При установке приложения необходимо подключить дамп бд, расположен в корне.
##### /api/v1/config/db.php   - Данные для подключения бд

##### Прописать свой путь до Api в файле index.php
Строка 86 и 100
```js
await axios.get('https://projecttemplates/api/consultants/get_consultant_in_json')
````
```js
await axios.get('https://projecttemplates/api/consultants/app')
````

#### /api/v1/config/db   - Данные для BD

## Описание Api

/api  - Апи 

/api/config/routes  - Добавление новых маршрутов(методов)
/api/config/helpers - Методы для всего проекта. Типа высчитать дату. ЗАпись в лог и т.д


/api/api/Api        - Точка входа. В этом классе идет разбор роута, формирования данных с клиента
/api/api/classes    - Общие классы для всего проекта. Типа класс BD для работы базой данных
api/api/services    - Сервисы - это методы. 


Создание маршрута 

Пример - 'consultants/get_consultant_in_json' => 'Consultants/getConsultantInJson',
В перовой части мы указываем сам маршрут. Этот маршрут ищется в Api.php, если такой маршрут найден,
То берется конструкция из 2 части. 1 парамет это класс, второй метод. 
В этом Случае запустится класс Consultants и метод getConsultantInJson

Используемые библиотеки лежат в vendor, приложение загрузил без .gitignore 
