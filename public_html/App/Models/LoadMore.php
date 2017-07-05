<?php

	header('Content-Type: application/json');

	$pdo = new PDO("mysql:host=localhost;dbname=recipe", "root", "");

	$articles = [];

	$start = isset($_GET['start']) ? (int)$_GET['start'] -1 : 0;
	$count = isset($_GET['count']) ? (int)$_GET['count'] : 1;

	$article = $pdo->query("SELECT SQL_CALC_FOUND_ROWS * FROM recipes LIMIT {$start}, {$count}");
	$articlesTotal = $pdo->query("SELECT FOUND_ROWS() AS count")->fetch(PDO::FETCH_ASSOC)['count'];

	if($articlesCount = $article->rowCount()) {
		$articles = $article->fetchAll(PDO::FETCH_OBJ);
	}
echo json_encode(array(
		'items' => $articles,
		'last' => ($start + $count) >= $articlesTotal ? true : false,
		'start' => $start,
		'count' => $count
	));