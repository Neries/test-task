
## Тестовое​ ​задание​ ​на​ ​позицию​ ​Junior​ ​PHP​ ​Developer  

Онлайн   каталог   сотрудников   для  
компании​ ​с​ ​более​ ​чем​ ​50,000​ ​сотрудников. 


## Установка


```javascript
git clone https://github.com/Neries/test-task.git .
```
```javascript
composer install
```
Затем переименовать .env.example на  .env
и изменитеь данные БД в файле и сгенерировать ключ командой:

```javascript
php artisan key:gen
```
Cоздать символьную ссылку из public/storage на storage/app/public

```javascript
php artisan storage:link
```

Если вы хотите использовать встроенный в PHP сервер для разработки, вы можете использовать команду: 

```javascript
php artisan serve
```

## Настройка

Количество сгенерированных сотрудников (изначально 50 000) и уровни иерархий можно изметить отредактировав свойтсва $numberOfEmployees и $depth
в /database/seeds/EmployeesTableSeeder.php
