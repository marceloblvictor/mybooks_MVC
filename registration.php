<?php

require_once "config.php";

$username_attempt = $username_error = "";
$password_attempt = $password_error = "";
$success_message = "";


if (isset($_POST["submission"])) {

     // Validação 
    if(empty(trim($_POST["username_input"]))){
        $username_error = "Por favor, insira um usuário.";
    }
    else {
        $username_attempt = trim($_POST["username_input"]);
    }
    if(empty(trim($_POST["password_input"]))){
        $password_error = "Por favor, insira uma senha.";
    }
    else {
        if (trim($_POST["password_input"]) === trim($_POST["confirm_input"])) {
           $password_attempt = trim($_POST["password_input"]);
        }
        else {
            $password_error = "Erro na confirmação de senha.";
        }
        
    }

    $sql = "SELECT id, username, password FROM user WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username_attempt);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Certifica que o nome de usuário está disponível
    if (empty($user)) {
       
        // Cria o usuário na DB se a confirmação de senha tiver sido bem sucedida
        if (!empty($password_attempt)) {

            $passwordHash = password_hash($password_attempt, PASSWORD_BCRYPT, array("cost" => 12));

            $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':username', $username_attempt);
            $stmt->bindValue(':password', $passwordHash);
            $result = $stmt->execute();
    
            if($result){
                $success_message = "Usuário criado com sucesso!";
            }
            else {
                die("Erro na conexão com a database.");
            }
            
        }       
    }
    
    else {
        $username_error = "Nome de usuário já existente. Favor escolher outro.";
        
    }
}
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title> MyBooks </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="view/css/bootstrap.css" rel='stylesheet' type='text/css'>
  <link href="view/css/styles.css" rel='stylesheet' type='text/css'>
</head>

<body>

  <nav class="navbar fixed-top navbar-light bg-light">
        <ul>
          <li class="nav-item">
              <a class="nav-link" href="index.php">Início</a>
          </li>    
          <?php 
            if (isset($_SESSION["logged_in"]) && isset($_SESSION["user_id"])) {
                
                echo "<li class='nav-item'><a class='nav-link' href='view/logout.php'>Logout</a></li>";
                echo "<li class='nav-item nav-logged'>Olá, " . $_SESSION['username'] . "!</li>";
            }
          ?>
        </ul>
  </nav>

  <h1 class="welcome-title">My Books</h1>

  <section class=container-section>


    <h2 class="form-header">Inscrição</h2>
    <?php echo "<p class='text-success'>$success_message</p>"; ?>

    <form class="form-container" action="" method="post">
            <label for="username_input">Nome de Usuário*:</label>
            <input type="text" name="username_input">
            <?php echo "<p class='text-danger'>$username_error</p>"; ?>

            <label for="password_input">Senha*:</label>
            <input type="password" name="password_input">
            <?php echo "<p class='text-danger'>$password_error</p>"; ?>

            <label for="confirm_input">Confirmar Senha*:</label>
            <input type="password" name="confirm_input">
            
            <input id="submit-btn" class="btn btn-primary" type="submit" name="submission" value="OK"></button>
    </form>

  </section>

