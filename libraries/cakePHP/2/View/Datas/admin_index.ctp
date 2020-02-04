<?php
//$model = 'InvItem';
//$columns = array(
//    'id',
//    'name',
//    'created',
//    'modified'
//);
?>
<fieldset>
	<legend>
		<?= $model; ?> <?php echo $this->Html->link(__('Add new', TRUE), array(
			// 'admin' => TRUE,
			'action' => 'edit', 'new'
		)); ?>
	</legend>

	<?php echo $this->Form->create($model); ?>
	<?php echo $this->Form->input('search'); ?>
	<?php echo $this->Form->end(__('search', TRUE)); ?>

	<h2><?php echo __($model); ?></h2>
	<table cellpadding="0" cellspacing="0" class="display table table-striped table-hover">
		<tr>
			<th class="actions"><?php echo __('Actions'); ?></th>
			<?php foreach ($columns as $column): ?>
				<th><?php echo $this->Paginator->sort($column, $column); ?></th>
			<?php endforeach; ?>

		</tr>
		<?php foreach ($records as $each): ?>
			<tr>
				<td class="actions">
					<?php echo $this->Html->link(__('Edit', TRUE), array(
						'action' => 'edit', $each[ $model ][ 'id' ]
					)); ?>
					<?php echo $this->Html->link(__('Delete', TRUE), array(
						'action' => 'delete', $each[ $model ][ 'id' ]
					), NULL, sprintf(__('Are you sure you want to delete?', TRUE), $each[ $model ][ 'id' ])); ?>
				</td>
				<?php foreach ($columns as $column): ?>
					<td><?php echo $each[ $model ][ $column ]; ?>&nbsp;</td>
				<?php endforeach; ?>

			</tr>
		<?php endforeach; ?>
	</table>

	<div class="previous_next">

		<?php echo $this->paginator->prev('<< Previous ', array(
			'class' => 'PrevPg'
		), null, array(
			'class' => 'disabled'
		)); ?>

		<?php echo $this->Paginator->numbers(); ?>

		<?php
		echo $this->paginator->counter(array(
			'format' => ' of %pages% pages (showing %current% of %count%)'
		));
		?>

		<?php echo $this->paginator->next(' Next >>', array(
			'class' => 'NextPg'
		), null, array(
			'class' => 'disabled'
		));
		?>
	</div>

</fieldset>
