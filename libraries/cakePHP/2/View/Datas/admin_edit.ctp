<?php

//The columns are set from the controller and are auto generated below, so you can leave commented, but can be overridden here
//$model = 'Product';
//$columns = array(
//    'id',
//    'name',
//    'created',
//    'modified'
//);

// if you want to leave out a specific column
// unset($columns[ array_search('column_to_leave_out', $columns) ]);
?>
<div>
	<?php echo $this->Form->create($model, array(
		'novalidate' => true,
		//'type' => 'file' //uncomment if you want to upload files
	));?>
	<fieldset>
		<legend><?php echo __('Edit ' . $model); ?></legend>
		<?php foreach ($columns as $column): ?>
			<?= $this->Form->input($column, array('label' => $column)); ?>
		<?php endforeach; ?>

		<?php if (0): //For a hasAndBelongsToMany ?>
			<?= $this->Form->input('Pricing', array(
				'options' => $pricingList,
				'multiple' => 'checkbox',
			)); ?>
		<?php endif; ?>

	</fieldset>
	<?php echo $this->Form->end(__('Submit', TRUE));?>
</div>
