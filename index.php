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
	// $user_id = 2;
	// $stmt = $conn->query("SELECT * FROM posts WHERE user_id = '$user_id'");
	// while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
	// 	echo 'Post number: '.$res['post_id'].': title: '.$res['title'].'<br>';
	// }

	/******************************/
	//Insert data to DB
	//На основании именнованных параметров

	// $title = 'I have an appartment';
	// $cat_id = '1';
	// $content = 'Wonderfull appartment for rent at Marina Roscha close to city center';
	// $user_id = '1';

	// $insertQuery = "INSERT INTO posts (title, cat_id, content, user_id) VALUE(:title, :cat_id, :content, :user_id)";
	// $insert_stmt = $conn->prepare($insertQuery);
	// $insert_stmt->execute(['title' => $title, 'cat_id' => $cat_id, 'content' => $content, 'user_id' => $user_id]);

	// if ($insertQuery) {
	// 	echo 'Succefull insert'.'<br>';
	// } else {
	// 	echo 'Something went wrong'.'<br>';
	// }

/******************************/

//Delete Data from DB;

	$post_id = '7';

	$deleteQuery = "DELETE FROM posts WHERE post_id = :post_id";
	$del_stmt = $conn->prepare($deleteQuery);
	$del_stmt->execute(['post_id' => $post_id]);

	if ($deleteQuery) {
		echo 'Succefull delete data'.'<br>';
	} else {
		echo 'Something went wrong into delete data'.'<br>';
	}

//Перебираем записи и выводим нужную информацию
	while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
		echo 'Post number: '.$res['post_id'].': title: '.$res['title'].'<br>';
	}

?>