<?php //echo '<pre>'; print_r($_SESSION)?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="/templates/css/style.css">
    <title>Тестовое задание</title>
  </head>
  <body>
	  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
		  <header class="masthead mb-auto">
			<div class="inner">
			  <h1 class="masthead-brand">Тестовое задание</h1>
			  <nav class="nav nav-masthead justify-content-center">
				<a class="nav-link" href="/">Главная</a>
				<?php if(isset($_SESSION['userLogin'])):?>
				<a class="nav-link" href="/logout/">Выйти</a>
				<a class="nav-link" href="/admin/"><?php echo $_SESSION['userLogin'] ?></a>
				<?php else: ?>
				<a class="nav-link" href="/login/">Войти</a>
				<?php endif;?>
			  </nav>
			</div>
		  </header>
		  <main role="main" class="inner cover">