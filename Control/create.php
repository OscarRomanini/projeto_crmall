<?php
/**
 * Created by PhpStorm.
 * User: Oscar Romanini
 * Date: 26/01/2019
 * Time: 10:12
 */

session_start();
require_once '../Model/db_connect.php';

//CLEAR (TRATA ATAQUES)

function clear($input){
    global $connect;
    $var = mysqli_escape_string($connect, $input);
    $var = htmlspecialchars($var);
    return $var;
}

if(isset($_POST['btn-cadastrar'])):
    $nome = clear($_POST['nome']);
    $nasc = clear($_POST['nasc']);
    $sexo = clear($_POST['sexo']);
    $cep = clear($_POST['cep']);
    $endereco = clear($_POST['endereco']);
    $num = clear($_POST['num']);
    $complemento = clear($_POST['complemento']);
    $bairro = clear($_POST['bairro']);
    $estado = clear($_POST['estado']);
    $cidade = clear($_POST['cidade']);


$sql = "INSERT INTO clientes(nome, nasc, sexo, cep, endereco, num, complemento, bairro, estado, cidade) VALUES ('$nome', '$nasc', '$sexo' ,'$cep ', '$endereco', '$num', '$complemento', '$bairro','$estado' ,'$cidade ')";


    if(mysqli_query($connect, $sql)):
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('Location: ../View/index.php');
    else:
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header('Location: .../View/index.php');
    endif;
 endif;


