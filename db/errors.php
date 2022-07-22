<?php  if (count($errors) > 0) : ?>
  <div class="blockquote text-center m-2 border border-danger border-3 rounded">
  	<?php foreach ($errors as $error) : ?>
  	  <p ><?= $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
