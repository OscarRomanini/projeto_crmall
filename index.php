<?php
/**
 * Created by PhpStorm.
 * User: Oscar Romanini
 * Date: 26/01/2019
 * Time: 09:23
 */

//conexão

include_once 'db_connect.php';

//Mensagem

include_once 'mensagem.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema de cadastro de clientes</title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="_CSS/index.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
<div class="row">
    <div class="col">
        <h3 class="light">Clientes</h3>
        <table class="striped">
            <thead>
                <tr>
                    <th>Nome                     </th>
                    <th>Data de nascimento       </th>
                    <th>Sexo                     </th>
                    <th>Cep                      </th>
                    <th>endereço                 </th>
                    <th>Número                   </th>
                    <th>complemento              </th>
                    <th>Bairro                   </th>
                    <th>Estado                   </th>
                    <th>Cidade                   </th>
                </tr>
            </thead>
        <tbody>

        <?php
            $sql = "SELECT * FROM clientes";
            $resultado = mysqli_query($connect, $sql);
            if(mysqli_num_rows($resultado) > 0):

            while($dados = mysqli_fetch_array($resultado)):

        ?>

        <tr>
            <td><?php echo $dados['nome']; ?></td>
            <td><?php echo $dados['nasc']; ?></td>
            <td><?php echo $dados['sexo']; ?></td>
            <td><?php echo $dados['cep']; ?></td>
            <td><?php echo $dados['endereco']; ?></td>
            <td><?php echo $dados['num']; ?></td>
            <td><?php echo $dados['complemento']; ?></td>
            <td><?php echo $dados['bairro']; ?></td>
            <td><?php echo $dados['estado']; ?></td>
            <td><?php echo $dados['cidade']; ?></td>
            <td><a href="editar.php?id=<?php echo $dados['id']; ?>" class="btn-floating orange"><i class="material-icons">edit</i> </a></td>
            <td><a href="#modal<?php echo $dados['id']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i> </a></td>

            <!---Estrutura do modal -->

            <div id="modal<?php echo $dados['id']; ?>" class="modal">
                <div class="modal-content">
                    <h4>Cuidado!</h4>
                    <p>Tem certeza que deseja excluir esse cliente?</p>
                </div>
                <div class="modal-footer">

                    <form action="_CRUD/delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $dados['id']?>">
                        <button type="submit" name="btn-deletar" class="btn red">Sim, quero deletar</button>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>

                    </form>
                </div>
            </div>
        </tr>

        <?php
        endwhile;
        else: ?>

        <tr>
            <td> - </td>
            <td> - </td>
            <td> - </td>
            <td> - </td>
            <td> - </td>
            <td> - </td>
            <td> - </td>
            <td> - </td>
            <td> - </td>
            <td> - </td>

        </tr>

        <?php
        endif;
        ?>

        </tbody>
        </table>
        <br>
        <a href="adicionar.php" class="btn">Adicionar cliente</a>

    </div>
</div>

<footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
</script>
<script> M.AutoInit(); </script>
</footer>

</body>
</html>


