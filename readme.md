
## Тестовое​ ​задание​ ​на​ ​позицию​ ​Junior​ ​PHP​ ​Developer  

Онлайн   каталог   сотрудников   для  
компании​ ​с​ ​более​ ​чем​ ​50,000​ ​сотрудников. 


## Установка

Скопировать проект в текущий каталог

```javascript
git clone https://github.com/Neries/test-task.git .
```

```javascript
composer install
```
Затем скопировать .env.example с именем .env
и изменитеь данные БД в файле и сгенерировать ключ командой:

```javascript
php artisan key:generate
```
Cоздать символьную ссылку из public/storage на storage/app/public

```javascript
php artisan storage:link
```
Заполнить базу данных
```javascript
php artisan migrate --seed
```
Если вы хотите использовать встроенный в PHP сервер для разработки, вы можете использовать команду: 

```javascript
php artisan serve
```

## Настройка

Количество сгенерированных сотрудников (изначально 50 000) и уровни иерархий можно изменить, отредактировав свойтсва $numberOfEmployees и $depth
в /database/seeds/EmployeesTableSeeder.php
