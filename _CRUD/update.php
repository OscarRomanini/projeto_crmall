<?php
/**
 * Created by PhpStorm.
 * User: Oscar Romanini
 * Date: 26/01/2019
 * Time: 14:04
 */


session_start();
require_once '../db_connect.php';

//CLEAR (TRATA ATAQUES)

function clear($input){
    global $connect;
    $var = mysqli_escape_string($connect, $input);
    $var = htmlspecialchars($var);
    return $var;
}

if(isset($_POST['btn-editar'])):
    $nome = clear($_POST['nome']);
    $nasc = clear($_POST['nascimento']);
    $sexo = clear($_POST['sexo']);
    $cep = clear($_POST['cep']);
    $endereco = clear($_POST['endereco']);
    $num = clear($_POST['num']);
    $complemento = clear($_POST['complemento']);
    $bairro = clear($_POST['bairro']);
    $estado = clear($_POST['estado']);
    $cidade = clear($_POST['cidade']);

    $id = mysqli_escape_string($connect, $_POST['id']);

    $sql = "UPDATE clientes SET nome = '$nome', nasc = '$nasc', sexo = '$sexo', cep = '$cep', endereco = '$endereco', num = '$num', complemento = '$complemento', bairro = '$bairro', estado = '$estado', cidade = '$cidade'";

    if(mysqli_query($connect, $sql)):
        $_SESSION['mensagem'] = "Atualizado com sucesso!";
        header('Location: ../index.php');
    else:
        $_SESSION['mensagem'] = "Erro ao atualizar!";
        header('Location: .../index.php');
    endif;
endif;


