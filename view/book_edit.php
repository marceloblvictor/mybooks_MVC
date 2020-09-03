<?php

$title_attempt = $title_error = "";
$author_attempt = $author_error = "";
$result_message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

     // Validação 
    if(empty(trim($_POST["title_input"]))){
        $title_error = "Por favor, insira o novo título do livro.";
    }
    else {
        $title_attempt = trim($_POST["title_input"]);
    }

    if(empty(trim($_POST["author_input"]))){
        $author_error = "Por favor, insira um novo autor para o livro.";
    }
    else {
        $author_attempt = trim($_POST["author_input"]);
    }

    $description_attempt = trim($_POST["description_input"]);
        
    require_once "config.php";


    // Certifica-se de que o livro já está no Banco de Dados
    if (!empty($title_attempt) && !empty($author_attempt)) {
       
        $result = $controller->model->editBook($title_attempt, $author_attempt, $description_attempt, $controller->context["book"]->get_id());

        if(!$result){
            die("Erro na conexão com a database.");
        }
        else {
            header("Location: /mybooks/index.php");
            
        }
    }       
}

?>

<h2 class="form-header">Editar o Livro <?php echo $controller->context["book"]->get_title()?></h2>


<form class="form-container" action="" method="POST">   
<?php echo "<p>$result_message</p>"; ?>
    <label for="title_input">Novo Título*:</label>
    <input type="text" name="title_input">
    <?php echo "<p class='text-danger'>$title_error</p>"; ?>
    
    <label for="author_input">Novo Autor*:</label>
    <input type="text" name="author_input">
    <?php echo "<p class='text-danger'>$author_error</p>"; ?>

    <label for="description_input">Nova Descrição:</label>
    <input type="text" name="description_input" height="100px" width="200px">

    <input id="submit-btn" type="submit" class="btn btn-primary" value="OK">
</form>
<br>