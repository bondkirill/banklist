<?php
define("HOST","localhost"); //input host
define("USER","root"); // input user name
define("PASS","");  //input password
define("DB","cvdb");          // input your database

$connection = mysqli_connect(HOST,USER,PASS,DB) or die('not connection');
mysqli_set_charset($connection,'utf8') or die('NO UTF8 FORMAT');

function get_alldata(){
    global $connection;
    $query = "SELECT * FROM acc_date ORDER BY id DESC";
    $res = mysqli_query($connection,$query);
    $data = array();
    $count = null;
    while ($row = mysqli_fetch_assoc($res)){
        $data[$count] = $row;
        $count++;
    }
    return $data;

}



