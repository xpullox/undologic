<?= $this->Form->create('User', array(
	'method' => 'post',
	'url' => 'login',
)); ?>




<?= $this->Form->input('email', array(
	'type' => 'email',
	'class' => 'form-control'
)); ?>

<?= $this->Form->input('password', array(
	'type' => 'password',
	'class' => 'form-control'
)); ?>

<?php echo $this->Form->button('Login', array(
	'class' => 'form-control'
)); ?>

<?php echo $this->Form->end(); ?>
