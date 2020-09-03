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

    <?php global $controller; include $controller->content; ?>

  </section>

</body>
</html>