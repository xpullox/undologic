<?php if ($this->Session->check('Message.auth')) echo $this->Session->flash('auth'); ?>
<body class="login">

<div class="wrapper wrapper-login">


	<?php echo $this->Form->create('User'); ?>





	<div class="container container-login animated fadeIn" style="display: block;">
		<h3 class="text-center"> <br href="<?= $this->webroot; ?>" class="logo">
			<img src="<?= $this->webroot; ?>images/updatecase.png" alt="navbar brand" style="height: 40px;"><br/>
			</a>Reset Password</h3>
		<div class="login-form">

			<div class="form-group form-floating-label">

				<?php echo $this->Form->input('User.email', array(
					'type' => 'text',
					'label' => false,
					'placeholder' => 'Email',
					'class'=>'form-control input-border-bottom filled',
					'id' => "username"

				)); ?>

			</div>

			<div class="form-action">
				<?= $this->Form->submit('Start the reset process', array('class' => "btn btn-primary btn-rounded btn-login pull-right")); ?>

				<a href="<?= $this->webroot; ?>login" class="btn btn-warning btn-rounded btn-login pull-right">Return to Login</a>


			</div>
			<div class="row form-sub m-0">
				<div class="col col-md-6">
					<div class="custom-control custom-checkbox">


					</div>
				</div>
				<div class="col col-md-12 login-forget text-center">

				</div>
			</div>

		</div>
	</div>

	<?= $this->Form->end(); ?>




