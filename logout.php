<?php

setcookie('test' , "12345" , time()+3600 , "/" , "" , false, false);
if(! isset($_COOKIE['test'])){
    header("location: index.php");
    exit();
}
session_start();
try{
    $hash = $_COOKIE['ke'];
    $conn = new PDO("mysql:host=localhost;dbname=test" , "test" , "123456");
    $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("DELETE FROM sessions WHERE (hash = :hash)");
    $stmt->bindParam(":hash" , $hash , PDO::PARAM_STR);
    $stmt->execute();
} catch(PDOException $e) {
    echo "error occurred". $e->getMessage();
}

$_SESSION = array();
$params = session_get_cookie_params();
setcookie(session_name() , "" , time()-3600 , $params['path'], $params['domain'], $params['secure'] , $params['httponly'] );
setcookie('ke' , '' , time()-3600 , '/' , '' , false , true);
session_destroy();
header("location:index.php");
exit();

?>