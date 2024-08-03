<?php
session_start();
  define('SITEURL','http://localhost/Food-Order/');
  define('DB_USERNAME' , 'root'); 
  define('LOCALHOST','localhost');
  define('DB_PASSWORD','');
  define('DB_NAME','food_order');

  $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die (mysqli_error()); //database connection
  $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //selecting database
?>

<!-- 
$dsn = "mysql:host=localhost;dbname=food_order";
   $password = '';

   try {
       $conn = new PDO($dsn, $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       // Prepare statement
       $stmt = $conn->prepare($sql);

       // Bind parameters
       $stmt->bindParam(':full_name', $full_name);
       $stmt->bindParam(':user_name', $user_name);
       $stmt->bindParam(':password', $password);

       // Execute query
       $stmt->execute();

       echo "Record inserted successfully";
   } catch(PDOException $e) {
       echo "Failed: " . $e->getMessage();
   }

   // Close connection
   $conn = null; -->
