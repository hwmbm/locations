<?php
/**
 * Created by PhpStorm.
 * User: BM
 * Date: 2017/10/19
 * Time: 23:05
 */
session_start();
$userid = $_SESSION['memberid'];
try {
    $pdo = new PDO("mysql:host=localhost;dbname=imooc","root","root123",array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $pdo->query("set names utf8");
    $sql = "delete from shop_cart where userid=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array([$userid]));
    $rows = $stmt->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}
if ($rows) {
    $response = array(
        'error'=>0,
        'errmsg'=>'success',
        'data'=>true,
    );
} else {
    $response = array(
        'error'=>1,
         'errmsg'=>'fail',
        'data'=>false,
    );
}
echo json_encode($response);

