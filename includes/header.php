<?php 

require_once 'core/init.php';


$user = new User(); //Current


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
      <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">Project name</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
<?php if($user->isLoggedIn()) { ?>
              <li><a href="project.php">Projects</a></li>
              <li><a href="logout.php">Log Out</a></li>
<?php } else { ?>
        <li><a href="login.php">login</a></li>
        <li><a href="register.php">register</a></li>
<?php } ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
