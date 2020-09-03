<h2 class="form-header">Novo Livro</h2>

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