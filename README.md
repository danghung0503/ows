### install composer
``composer install``
### create mysql database
### config database in config/database.php
### execute query in sql/ows.sql
Note:
1. All route can be found in routes/api.php
2. Example
#### create new user to test
##### url: http://localhost:8080/auth/sign-up
##### http method: POST
Payload:
````
{
	"email": "test@gmail.com",
	"password": "12345678",
	"name": "Dang Van Hung",
	"phone": "0123456789",
	"address": "Hoang Van Thu, Hoang Mai, Ha Noi"
}
````
#### login
##### url: http://localhost:8080/auth/login
##### http method: POST
Payload:
````
{
	"email": "test6@gmail.com",
	"password": "12345678",
}
````
Response:
````
{
    "jwt": "<jwt_value>",
    "message": "Success"
}
````
Copy jwt token and paste into request header

#### get detail
##### url: http://localhost:8080/auth/detail
##### http method: GET
##### Request header:
````
Authorization: <jwt_value>
````
