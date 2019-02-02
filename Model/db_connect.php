<?php
/**
 * Created by PhpStorm.
 * User: Oscar Romanini
 * Date: 25/01/2019
 * Time: 21:15 **/

//Conexão com o BD

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "crmall";

$connect = mysqli_connect($servername, $username, $password, $db_name);
mysqli_set_charset($connect, "utf8");

if(mysqli_connect_error()):
    echo "Erro na conexão: ".mysqli_connect_error();
endif;