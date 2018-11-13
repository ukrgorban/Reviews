<?php require_once(ROOT.'/views/layouts/header.php') ?>
<div class="wrapper">
	<div class="jumbotron col-md-4" id="login">
		<form class="form-signin" method="POST">
			<h1 class="h3 mb-3 font-weight-normal">Введите данные</h1>
			<label for="inputLogin" class="sr-only">Логин</label>
			<input name="login" class="form-control" type="text" id="inputLogin" placeholder="Login" autofocus>
			<label for="inputPassword" class="sr-only">Пароль</label>
			<input name="password" class="form-control" type="password" id="inputPassword" placeholder="Password">
			<button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
		</form>
		<?php if($error): ?>
		<div class="alert alert-danger" role="alert">
		  Доступ запрещен!
		</div>
		<?php endif; ?>
	</div>
</div>
<?php require_once(ROOT.'/views/layouts/footer.php') ?>