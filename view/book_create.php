<?php

$title_attempt = $title_error = "";
$author_attempt = $author_error = "";
$success_message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

     // Validação 
    if(empty(trim($_POST["title_input"]))){
        $title_error = "Por favor, insira o título do livro.";
    }
    else {
        $title_attempt = trim($_POST["title_input"]);
    }

    if(empty(trim($_POST["author_input"]))){
        $author_error = "Por favor, insira um autor para o livro.";
    }
    else {
        $author_attempt = trim($_POST["author_input"]);
    }

    $description_attempt = trim($_POST["description_input"]);
        
    require_once "config.php";

    global $pdo;

    $sql = "SELECT title FROM book WHERE title = :title AND user = :user";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $title_attempt);
    $stmt->bindValue(':user', $_SESSION["user_id"]);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Certifica-se de que o livro não já está no Banco de Dados
    if (empty($row) && !empty($title_attempt) && !empty($author_attempt)) {
       
        $result = $controller->model->createBook($title_attempt, $author_attempt, $description_attempt, $_SESSION["user_id"]);

        if($result){
            $success_message = "Livro adicionado com sucesso!";
        }
        else {
            die("Erro na conexão com a database.");
        }
    }       
    else {

        $title_error = "Livro já registrado. Favor adicionar outro.";
        
    }
}

?>

<h2 class="form-header">Adicionar Livro</h2>


<form class="form-container" action="" method="POST">   
<?php echo "<p class='text-success'>$success_message</p>"; ?>
    <label for="title_input">Título*:</label>
    <input type="text" name="title_input">
    <?php echo "<p class='text-danger'>$title_error</p>"; ?>
    
    <label for="author_input">Autor*:</label>
    <input type="text" name="author_input">
    <?php echo "<p class='text-danger'>$author_error</p>"; ?>

    <label for="description_input">Descrição:</label>
    <input type="text" name="description_input" height="100px" width="200px">

    <input id="submit-btn" type="submit" class="btn btn-primary" value="OK">
</form>
<br>