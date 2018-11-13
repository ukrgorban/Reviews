<?php require_once(ROOT.'/views/layouts/header.php') ?>
	<!--<div class='jumbotron'>
		<?php //echo '<pre>'; print_r($reviewsList);?>
	</div>-->
    <div class="wrapper">
		<?php if(isset($errors) && $errors !== false): ?>
		<div class="alert alert-danger alert-reviews" role="alert">
			<?php foreach($errors as $error): ?>
			<p><?php echo $error ?></p>
			<?php endforeach;?>
		</div>
		<?php endif;?>
		<?php if(isset($isAddItem)): ?>
		<div class="alert alert-success alert-reviews" role="alert">Ваш отзыв добавлен и отправлен на модерацию!</div>
		<?php endif;?>
		<h3>Отзывы</h3>
		<div class="sort">
			<?php if($reviewsList): ?>
			<p>Сортировать по:</p>
			<form method="POST">
				<input type="hidden" name="sort" value="date">
				<input type="hidden" name="direction" value="DESC">
				<button class="btn btn-success btn-sm" type="submit">Дате</button>
			</form>
			<form method="POST">
				<input type="hidden" name="sort" value="name">
				<input type="hidden" name="direction" value="ASC">
				<button class="btn btn-primary btn-sm" type="submit">Имени</button>
			</form>
			<form method="POST">
			
				<input type="hidden" name="sort" value="email">
				<input type="hidden" name="direction" value="ASC">
				<button class="btn btn-danger btn-sm" type="submit">Email</button>
			</form>
			<!--<a href="/" class="btn btn-success btn-sm">Дате</a>
			<a href="?sort=name&direction=ASC" class="btn btn-primary btn-sm">Имени</a>
			<a href="?sort=email&direction=ASC" class="btn btn-danger btn-sm">Email</a>-->
			<?php endif ?>
		<?php foreach($reviewsList as $review): ?>
		<div class="jumbotron">
			<div class="info">
				<div class="img">
					<img class="rounded mx-auto d-block" src="<?php echo $review['img'] ? 'images/'.$review['img'] : 'templates/img/anonymous.jpg' ?>">
				</div>
				<h3><?php echo $review['name'] ?></h3>
			</div>
			<p class="lead"><?php echo $review['text'] ?></p>
			<div class="other-info">
				<span class="email"><?php echo $review['email'] ?></span>
				<span class="date"><?php echo $review['date'] ?></span>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="wrapper">
		<h3>Добавить отзыв</h3>
		<form method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="exampleInputName">Имя</label>
				<input 
					type="text" 
					name="name" 
					class="form-control" 
					id="name" 
					placeholder="Введите имя" 
					value="<?php echo (isset($name)) ? $name : '' ?>">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<input 
					type="text" 
					name="email" 
					class="form-control" 
					id="email" 
					placeholder="Введите email" 
					value="<?php echo (isset($email)) ? $email : '' ?>">
			</div>
			<div class="form-group">
				<label for="exampleFormControlFile1">Выбрать аватарку</label>
				<input type="file" id="file" name="img" class="form-control-file" id="exampleFormControlFile1">
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1">Введите текст</label>
				<textarea name="text" id="text" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo (isset($text)) ? $text : '' ?></textarea>
			</div>
			<button type="submit" name="review" class="btn btn-primary">Отправить</button>
			<button id="preview" type="button" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-warning">Предварительный просмотр</button>
		</form>
	</div>
<?php require_once(ROOT.'/views/layouts/footer.php') ?>