<?php  if (count($errors) > 0) { ?>
	<div class="alert alert-danger mt-3 text-center" role="alert">
  	<?php foreach ($errors as $error) : ?>
  	  <?= $error ?>
  	<?php endforeach ?>
  </div>
<?php  } ?>

<?php  if (isset($_SESSION['reg_success_msg'])) { ?>
	<div class="alert alert-success mt-3 text-center" role="alert">
	 <?= $_SESSION['reg_success_msg'] ?>
</div>
<?php unset($_SESSION['reg_success_msg']); } ?>

