<?php

//используем MAMP, phpMyAdmin / процедурный подход

//подключение к phpMyAdmin
$user = 'root';
$password = 'root';
$db = '*****';
$host = 'localhost';
$port = 3306;

ini_set('display_errors',1);  //улавливаем ошибки
error_reporting(E_ALL);       //улавливаем ошибки

$link = mysqli_init();
$success = mysqli_real_connect(
   $link,
   $host,
   $user,
   $password,
   $db,
   $port
);
if ($link == false){
    print("Ошибка: Невозможно подключиться к mySQL".mysqli_connect_error()."<br>");
}
else{
    print("Соединение установлено"."<br>");
}


//Создаём новую таблицу
$sql = "CREATE TABLE Users(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR (30) NOT NULL, 
    city VARCHAR (30) NOT NULL, 
    password VARCHAR (30) NOT NULL)";

if (mysqli_query($link, $sql)) {
    echo "Таблица Users успешно создана"."<br>";
}
else{
    echo "Ошибка: " . mysqli_error($link)."<br>";
}


//добавляем значения в таблицу
$insert = "INSERT INTO Users (name, city) VALUES 
    ('Sam', 'Mos'), 
    ('Bob', 'San'), 
    ('Alice', 'Krsk')";
if(mysqli_query($link, $insert)){
    echo "Данные успешно добавлены"."<br>";
}
else{
    echo "Ошибка: " . mysqli_error($link)."<br>";
}

//set global sql_mode="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" - если ошибка Field 'password' doesn't have a default value 


//выводим значения из таблицы
$select = "SELECT * FROM Users";
if($result = mysqli_query($link, $select)){
    foreach($result as $row){
        
        echo "<br>";
        echo $row["id"] ."<br>";
        echo $row["name"] . "<br>";
        echo $row["city"] . "<br>";
        echo $row["password"] . "<br>";
        echo "<br>";
        
    }
    mysqli_free_result($result);
}
else{
    echo "Ошибка: " . mysqli_error($link)."<br>";
}


//удаляем ненужную строку в таблицу
$delete = "DELETE FROM Users WHERE id = 4";
if(mysqli_query($link, $delete)){
 
} else{
    echo "Ошибка: " . mysqli_error($link)."<br>";
}
        
mysqli_close($link);

?>
