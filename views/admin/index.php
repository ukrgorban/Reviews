<?php require_once(ROOT.'/views/layouts/header.php') ?>
<h2 class="text-center">Панель управления</h2>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#allReviews" role="tab" aria-controls="home" aria-selected="true">Все отзывы</a>
  </li>
  <!--<li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
  </li>-->
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="allReviews" role="tabpanel" aria-labelledby="home-tab">
	<table class="table table-dark">
	  <thead>
		<tr>
		  <th scope="col">#</th>
		  <th scope="col">Картинка</th>
		  <th scope="col">Комментарий</th>
		  <th scope="col">Имя</th>
		  <th scope="col">Email</th>
		  <th scope="col">Дата публикации</th>
		  <th scope="col">Принят/отклонен</th>
		  <th scope="col">Статус</th>
		  <th scope="col">Редактировать</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php if($allReviewsList): ?>
	  <?php $i = 1; foreach($allReviewsList as $review): ?>
		<tr>
		  <th scope="row"><?php echo $i++ ?></th>
		  <td><img src="<?php echo ($review['img']) ? '/images/'.$review['img'] : '/templates/img/anonymous.jpg' ?>"></td>
		  <td>
			<?php if($review['edited']): ?>
			<span class="badge badge-warning">Изменен администратором</span><br>
			<?php endif; ?>
			<?php echo $review['text'] ?>
		  </td>
		  <td><?php echo $review['name'] ?></td>
		  <td><?php echo $review['email'] ?></td>
		  <td><?php echo $review['date'] ?></td>
		  <td>
			<?php if($review['published']): ?>
			<form method="POST">
				<input type="hidden" name="reject" value="1">
				<input type="hidden" name="id" value="<?php echo $review['id'] ?>">
				<button type="submit" class="btn btn-info btn-sm">Отклонить</button>
			</form>
			<?php else: ?>
			<form method="POST">
				<input type="hidden" name="reject" value="0">
				<input type="hidden" name="id" value="<?php echo $review['id'] ?>">
				<button type="submit" class="btn btn-success btn-sm">Принять</button>
			</form>
			<?php endif ?>
		  </td>
		  <td>
			<?php echo ($review['published']) ? 'Активно' : 'Не активно'?>
		  </td>
		  <td>
			<a href="/admin/update/<?php echo $review['id']?>" class="btn btn-danger btn-sm" >Редактировать</a>
		  </td>
		</tr>
	  <?php endforeach; ?>
	  <?php endif; ?>
	  </tbody>
	</table>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>
<?php require_once(ROOT.'/views/layouts/footer.php') ?>