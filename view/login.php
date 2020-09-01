<?php
require_once "config.php";
require_once "model/Model.php";

$username_attempt = $username_error = "";
$password_attempt = $password_error = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
 
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
        $password_attempt = trim($_POST["password_input"]);
    }

    $sql = "SELECT id, username, password FROM user WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username_attempt);
    $stmt->execute();
    
    $user_row = $stmt->fetch();
    
    // Username não foi encontrado na DB
    if (empty($user_row)) {
        if (!empty(trim($_POST["username_input"]))){
            $username_error = "Usuário e/ou senha inválido(s).";
        }     
        
    }

    // Username encontrado na DB. Vamos verificar se o password digitado foi o correto:
    else {

        // necessário implementar password_verify quando a página de registrar estiver pronta!
        //$is_password_valid = password_verify($password_attempt, $user["password"]);

        //if ($is_password_valid) {
          if ($user_row["password"] === $password_attempt) {

                        
            $_SESSION['user_id'] = $user_row['id'];
            $_SESSION['username'] = $user_row['username'];
            $_SESSION['logged_in'] = time();
            header('Location: index.php');
            exit;

        }
        else {
            $username_error = "Usuário e/ou senha inválido(s).";

        }
    }
    
}


?>

<h2 class="form-header">Login</h2>

<form class="form-container" action="" method="POST">   
    <label for="username_input">Nome de Usuário:</label>
    <input type="text" name="username_input">
    <?php echo "<p class='text-danger'>$username_error</p>"; ?>
    
    <label for="password_input">Senha:</label>
    <input type="password" name="password_input">
    <?php echo "<p class='text-danger'>$password_error</p>"; ?>
    <input type="submit" class="btn btn-primary" value="OK">
</form>
<br>
<a href="view/registration.php"><button class="btn btn-primary">CRIAR CONTA</button></a>