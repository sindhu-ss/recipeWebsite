<?php

require '../../recipeWebsite-config.inc.php';

// Connect to the database
$dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);

// Filter the username
$username = $_POST['username'];

// Prepare the query
$sql = "SELECT username FROM users WHERE username = '$username'";

// Prepare and Run the query
$result = $dbc->prepare($sql);
 
$result->execute();
$record = $result->fetch(PDO::FETCH_ASSOC);
if($record){
   $status = true;
}

// If result failed
if( $status ) {
	// Query failed
	echo '<span style="color:red; padding-top:.6em;" class="glyphicon glyphicon-remove"></span> Username already in use';
} else {
	// No results found
	// Username not in use
	echo '<span style="color:green; padding-top:.6em;" class="glyphicon glyphicon-ok"></span>  Username is available';
}