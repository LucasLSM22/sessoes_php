<?php
// Verifica se o formulário foi enviado
if(isset($_POST['submit'])) {
    // Obtém a opção selecionada
    $opcao = $_POST['opcao'];

    // Lê o arquivo de resultados
    $arquivo = 'resultados.txt';
    $resultados = file($arquivo, FILE_IGNORE_NEW_LINES);

    // Incrementa o contador da opção selecionada
    switch ($opcao) {
        case 'opcao1':
            $resultados[0]++;
            break;
        case 'opcao2':
            $resultados[1]++;
            break;
        case 'opcao3':
            $resultados[2]++;
            break;
    }

    // Grava os resultados  no arquivo
    file_put_contents($arquivo, implode("\n", $resultados));
}

// Lê o arquivo de resultados  para exibir os resultados atualizados
$resultados = file('resultados.txt', FILE_IGNORE_NEW_LINES);
$total_votos = array_sum($resultados); 

//condicao para ser executada caso o botao excluir seja clicado
if(isset($_POST['excluir'])) {
    //atribuindo os valores 0 para resultados
    $resultados = array(0, 0, 0);
    //gravando resultados no arquivo
    file_put_contents('resultados.txt', implode("\n", $resultados));
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>

<body class="bg-body-tertiary">

    <div class="container text-center bg-body-tertiary">

        <div class="row">
            <! a tag div class="col" foi utilizada para alinhamento do site em colunas ->
                <div class="col-1">
                    &nbsp;
                </div>

                <div class="col bg-primary">
                    <!implementando o menu ->
                        <nav class="navbar bg-primary navbar-expand-lg" data-bs-theme="dark">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="#">Sistema WEB</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <div class="navbar-nav">
                                        <a class="nav-link active" aria-current="page" href="index.php">Votação</a>
                                        <a class="nav-link" href="#">Resultados</a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                </div>

                <div class="col-1">
            &nbsp;
          </div>
        </div>

            <div class="row">
            <div class="col-1">
              &nbsp;
              </div>
             
                <div class="col bg-white">
                  &nbsp;
                 </div>

                 <div class="col-1">
                  &nbsp;
              </div>
          </div>
          
          <div class="row">
            <div class="col-1">
              
              &nbsp;
          </div>

            <div class="col bg-white">
                <!implementando os resultados ->
                    <div bs-primary >
                    <div class="col bg-white d-flex justify-content-center">
                       <div><br>
                       <?php
                                // Recupera os dados da sessão
                                session_start();

                                // Verifica se o usuário está logado
                                if (isset($_SESSION['username'])) {
                                    echo "Olá, " . $_SESSION['username'] . "!";
                                } else {
                                    // Redireciona o usuário para a página de login
                                    header('Location: index.php');
                                    exit;
                                }

                                // Verifica se a solicitação é para fazer logout
                                if (isset($_GET['logout'])) {
                                    // Destrói a sessão
                                    session_destroy();
                                    // Redireciona o usuário para a página inicial
                                    header('Location: index.php');
                                    exit;
                                }
                                ?>
                       <h3 class="text-start fs-3">Resultados da votacao</h3>
                       <! exibindo os dados do arquivo resultados, abrindo o php e utilizando o echo ->
                        <p class="text-start fs-5"><?php for ($i = 0; $i < count($resultados); $i++) {
                                        //fazendo o calculo de porcentagem
                                        $porcentagem = ($resultados[$i] / $total_votos) * 100;
                                        //exibindo os resultados
                                        echo "<li> Opção ".($i+1).": ".$resultados[$i]." votos (".$porcentagem."%)</li>";
                                    }
                            ?> </p>

                   
                    <! implementando os botes excluir e voltar ->
                    <form method="POST">
                        <a href="telavotacao.php" class="btn btn-primary">Votar novamente</a>
                        <button type="submit" name="excluir" class="btn btn-danger">Excluir dados</button>
                    </form>
                    &nbsp;
                    </div>
                </div> 
            </div>
            
            </div>

            <div class="col-1">
                &nbsp;
            </div>
        

        </div>
    </div>
</body>

</html>