<?php require_once(ROOT.'/views/layouts/header.php') ?>
<a href="/admin/" class="btn btn-info btn-edit">Назад</a>
<h2>Комментарий оставил <?php echo $review['email'] ?> <?php echo $review['date'] ?></h2>
<form method="POST">
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Комментарий</label>
    <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="6"><?php echo $review['text']?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Изменить</button>
</form>
<?php require_once(ROOT.'/views/layouts/footer.php') ?>