
<div class="row">
<div class="col-lg-6">
<div class="form">
<?php echo $this->Form->create('Sermon', array(
	//'type' => 'file',
	'inputDefaults' => array(
			'div' => array('class' => 'form-group'),
        	'class' => array('form-control'),
    	)
	));?>
	<fieldset>
		<legend><?php echo __('Search sermon archive') ?></legend>
	<?php
		echo $this->Form->input('q', array(
			'placeholder' => 'Search term',
			'label' => false
		));
	?>
	</fieldset>
<?php 
echo $this->Form->submit(__('Search'), array(
	'class' => 'btn',
	));
echo $this->Form->end();
?>
</div>
</div>

</div>
