<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title> MyBooks </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <style>
      * {
      list-style: none;
      box-sizing: border-box;
    
    
      }

      body {
          margin-top: 50px;
          height: 600px;
          background-color: rgb(209, 209, 209);
          
        
      }

      nav {
          height: 50px;
          
          -webkit-box-shadow: 3px 3px 5px 6px #ccc;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
          -moz-box-shadow:    3px 3px 5px 6px #ccc;  /* Firefox 3.5 - 3.6 */
          box-shadow:         3px 3px 5px 6px #ccc;  /* Opera 10.5, IE 9, Firefox 4+, Chrome 6+, iOS 5 */
      }

      nav ul {
          display: flex;
      }

      .index-btn {
          margin-left: 10px;
      }

      .new-book-btn {
          position: relative;
          left: 80px;
      }

      #submit-btn {
          position: relative;
          top: 10px;
      }

      .welcome-title {
          font-size: 64px;
          color: #007bff;
          position: relative;
          top: 20px;
          left: 100px;
      }

      .container-section {
          height: 300px;
          width: 300px;
          margin: auto;
          position: relative;
          top: 100px;
      }

      .form-container {
          display: flex;
          flex-direction: column;
          align-content: space-between;
          background-color: whitesmoke;
          border-radius: 25px;
          padding: 50px;
      }  

      .form-header {
          align-self: center;
          text-align: center;
          position: relative;
          bottom: 10px;
          
          
      }

      .btn-danger {
          margin-right: 40px;
        
      }

        .nav-logged {
          color: #007bff;
          font-size: 20px;
          font-weight: bold;
          position: relative;
          top: 4px;
      }
     

  </style>
</head>

<body>

  <nav class="navbar fixed-top navbar-light bg-light">
        <ul>
          <li class="nav-item">
              <a class="nav-link" href="index.php">Meus Livros</a>
          </li>    
          <?php 
            if (isset($_SESSION["logged_in"]) && isset($_SESSION["user_id"])) {
                
                echo "<li class='nav-item'><a class='nav-link' href='/mybooks/logout.php'>Logout</a></li>";
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