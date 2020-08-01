<?php

	$host = 'localhost';
	$user = 'root';
	$dbname = 'pdo_db';
	$password = '';

	try {
		$conn = new PDO("mysql:host=$host; dbname=$dbname", $user, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected Successfully".'<br>';
	}
	catch (PDOException $e) {
		echo "connection failed:".$e->getMessage();
		die();
	}

	//установливаем режим выборки данных из db в ввиде ассоциативного массива;
	$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	//выбираем ВСЁ (все колонки) из таблицы 'posts'
	$stmt = $conn->query('SELECT * FROM posts');

	//Перебираем записи и выводим нужную информацию
	// while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
	// 	echo 'Post number: '.$res['post_id'].': title: '.$res['title'].'<br>';
	// }
	//Перебираем записи и выводим нужную информацию согласно определенным параметрам (user_id);
	$user_id = 2;
	$stmt = $conn->query("SELECT * FROM posts WHERE user_id = '$user_id'");
	while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo 'Post number: '.$res['post_id'].': title: '.$res['title'].'<br>';
	}
?>