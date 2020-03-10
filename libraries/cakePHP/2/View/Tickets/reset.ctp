



<?php if ($this->Session->check('Message.auth')) echo $this->Session->flash('auth'); ?>
<body class="login">

<div class="wrapper wrapper-login">


	<form action="" method="post">





	<div class="container container-login animated fadeIn" style="display: block;">
		<h3 class="text-center"> <br href="<?= $this->webroot; ?>" class="logo">
			<img src="<?= $this->webroot; ?>images/updatecase.png" alt="navbar brand" style="height: 40px;"><br/>
			</a>Please enter your new password.</h3>
		<div class="login-form">

			<div class="form-group form-floating-label">


				<?php echo $this->Form->hidden('hash'); ?>
				<?php echo $this->Form->input('password', array(
					'label' => false,
					'placeholder' => 'Password',
					'class'=>'form-control input-border-bottom filled',
					'type' => 'password')); ?>

				<?php echo $this->Form->input('passwordVerify', array(
					'label' => false,
					'placeholder' => 'Verify Password',
					'class'=>'form-control input-border-bottom filled',
					'type' => 'password')); ?>





			</div>

			<div class="form-action">
				<?= $this->Form->submit('Change Password', array('class' => "btn btn-primary btn-rounded btn-login pull-right")); ?>

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





	</form>




