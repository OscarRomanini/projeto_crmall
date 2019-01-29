<?php
/**
 * Created by PhpStorm.
 * User: Oscar Romanini
* Date: 27/01/2019
* Time: 15:52
*/

include_once 'db_connect.php';


//SELECT

if (isset($_GET['id'])):
    $id = mysqli_escape_string($connect, $_GET['id']);
    $sql = "SELECT * FROM clientes WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
endif;

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
    <!--BOOTSTRAP-->
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//assets.locaweb.com.br/locastyle/2.0.6/stylesheets/locastyle.css">


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- JQUERY -->

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
    <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#estado").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>

</head>

<div class="row">
    <div class="col s12 m6 push-m3">
        <!--Adicionar um novo cliente-->
        <h3 class="light"> Editar Cliente</h3>

<form action="_CRUD/update.php" method="post">

    <!--Nome-->
    <div class="input-field col s12">
        <input type="text" name="nome" id="nome" value="<?php echo $dados['nome']; ?>" required>
        <label for="nome">Nome</label>
    </div>

    <!--Nascimento-->
    <div class="input-field col s12">
        <input type="text" class="form-control" placeholder="Ex.: dd/mm/aaaa" data-mask="00/00/0000" maxlength="10" autocomplete="off" id="nascimento" name="nascimento" value="<?php echo $dados['nascimento']; ?>" required>
        <label for="nascimento">Nascimento</label>
    </div>

    <!--Sexo-->
    <div class="with-gap">
        <label for="sexo">Sexo </label>
        <p>
            <label>
                <input name="sexo" type="radio" value="M" value="<?php echo $dados['sexo']; ?>" checked/>
                <span>Masculino</span>
            </label>
        </p>
        <p>
            <label>
                <input name="sexo" type="radio" value="F" value="<?php echo $dados['sexo']; ?>"/>
                <span>Feminino</span>
            </label>
        </p>

    </div>

    <!----------------------------------------  CEP  -------------------------------------------------------------->


    <div class="input-field col s12">

        <input type="text" name="cep" id="cep" maxlength="8" value="<?php echo $dados['cep']; ?>">
        <label for="cep">CEP </label>


    </div>
    <!------------------------------------------------------------------------------------------------------->

    <!--Endereço-->
    <div class="input-field col s12">
        <input type="text" name="endereco" id="endereco" placeholder="..." value="<?php echo $dados['endereco']; ?>" >
        <label for="endereco">Endereco </label>
    </div>

    <!--Numero-->
    <div class="input-field col s12">
        <input type="number" name="num" id="num" value="<?php echo $dados['num']; ?>">
        <label for="num">Número </label>
    </div>

    <!--Complemento-->
    <div class="input-field col s12">
        <input type="text" name="complemento" id="complemento" value="<?php echo $dados['complemento']; ?>">
        <label for="complemento">Complemento</label>
    </div>

    <!--Bairro-->
    <div class="input-field col s12">
        <input type="text" name="bairro" id="bairro" value="<?php echo $dados['bairro']; ?>" placeholder="..">
        <label for="bairro">Bairro </label>
    </div>

    <!--Estado-->
    <div class="input-field col s12">
        <input type="text" name="estado" id="estado" value="<?php echo $dados['estado']; ?>" placeholder="...">
        <label for="estado">Estado</label>
    </div>

    <!--Cidade-->
    <div class="input-field col s12">
        <input type="text" name="cidade" id="cidade" placeholder="..." value="<?php echo $dados['cidade']; ?>" >
        <label for="cidade">Cidade</label>
    </div>

    <button type="submit" name="btn-editar" class="btn"> Editar </button>
    <a href="index.php" class="btn green">Listagem de clientes</a>

</form>

    </div>
</div>

<footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>M.AutoInit();</script>
    <!-- Atente-se para a ordem: primeiro jquery, depois locastyle, depois o JS do Bootstrap. -->
    <script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="//code.jquery.com/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="//assets.locaweb.com.br/locastyle/2.0.6/javascripts/locastyle.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>


</footer>

</body>
</html>


