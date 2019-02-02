<?php
/**
 * Created by PhpStorm.
 * User: Oscar Romanini
 * Date: 25/01/2019
 * Time: 21:20
 */



//Conexão
require_once '../Model/db_connect.php';

//Iniciar sessão

session_start();

//Botão entrar

if (isset($_POST['entrar'])):
    $erros = array();
    $login = mysqli_escape_string($connect, $_POST['login']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    //Se login ou senha estiverem em branco...
    if(empty($login) or empty($senha)):
        $erros[] = "<li>Preencha os campos!</li>";

    //Se estiverem preenchidos...
    else:
        $sql = "SELECT usuario FROM usuarios WHERE usuario = '$login'";
        $resultado = mysqli_query($connect, $sql);

        if (mysqli_num_rows($resultado) > 0):
            $senha = md5($senha);

        if (mysqli_num_rows($resultado) == 1):
            $dados = mysqli_fetch_array($resultado);
             $_SESSION['logado'] = true;
             $_SESSION['id_usuario'] = $dados['id'];
             header('Location: index.php');
        else:
            $erros[] = "<li>Usuário e senha não conferem!</li>";
        endif;

        //Se o usuário não for encontrado no Banco...
        else:
            $erros[] = "<li>usuário inexistente</li>";

        endif;
    endif;
endif;

?>

<html>

<link href="_CSS/login.css" type="text/css" rel="stylesheet">


<head>


</head>
    <title>Login</title>
    <meta charset="UTF-8">

<body>



            <?php

            if(!empty($erros)):
                foreach ($erros as $erro):
                echo $erro;
                endforeach;
                endif;

            ?>

    <div id="bloco" name="bloco" class="login-page">

    <form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post" class="form">
        <label rel="login">Login </label><input type="text" name="login" autocomplete="disable"><br>
        <label rel="senha">Senha </label><input type="password" name="senha" autocomplete="disable"><br>
        <button type="submit" name="entrar">ENTRAR</button>
    </form>

    </div>

</body>


</html>
