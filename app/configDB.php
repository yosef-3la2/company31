<?php

// try {
//     $dns = "sqlsrv:Server=localhost;Database=db-project";  
//     $pdo = new PDO($dns, '', ''); 
// } catch (Exception $error) {
//     echo $error->getMessage();
// }

try {
    $dsn = "sqlsrv:Server=localhost;Database=test-db-project";
    $username = "";
    $password = "";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $pdo = new PDO($dsn, $username, $password, $options);
   
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>