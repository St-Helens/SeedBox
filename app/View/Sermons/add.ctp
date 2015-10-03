
<div class="row">
<div class="col-lg-3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Actions</li>
<?php
/*
		<li><?php echo $this->Html->link(__('List Wickets'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Fixtures'), array('controller' => 'fixtures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fixture'), array('controller' => 'fixtures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Players'), array('controller' => 'players', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Player'), array('controller' => 'players', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		*/
		?>
	</ul>
</div>
</div>

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
		<legend><?php echo __('Add sermon') ?></legend>
	<?php
		echo $this->Form->input('topic');
		echo $this->Form->input('talk_code');
		echo $this->Form->input('speaker');
		echo $this->Form->input('series');
		echo $this->Form->input('bibleref');
	?>
	</fieldset>
<?php 
echo $this->Form->submit(__('Add'), array('class' => 'btn'));
echo $this->Form->end();
?>
</div>
</div>

</div>
