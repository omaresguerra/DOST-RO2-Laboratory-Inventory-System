<?php if (count($errors) > 0): ?>
	<div class="alert alert-danger" role="alert" style="font-family: Verdana;  -webkit-animation:animatezooming 0.8s;animation:animatezooming 0.8s; ">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
		<?php foreach ($errors as $error): ?>
			<p><?php echo "".$error.""; ?></p>
			<?php endforeach ?>
	</div>
<?php endif ?>