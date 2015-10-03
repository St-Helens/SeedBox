<?php
if (!isset($modulus)) {
	$modulus = 11;
}
if (!isset($model)) {
	$models = ClassRegistry::keys();
	$model = Inflector::camelize(current($models));
}
if (!isset($pageCount)) {
	$page = $this->params['paging'][$model]['page'];
	$pageCount = $this->params['paging'][$model]['pageCount'];
} else {
}

		/*echo "<pre>";
		print_r($this->params);
		echo "</pre>";
		echo "pagecount".$pageCount;*/
		if (isset($controller)) {
			if (isset($action)) { 
				$this->Paginator->options(array('url' => array('controller' => $controller, 'action' => $action, 'order' => '')));
			} else {
				$this->Paginator->options(array('url' => array('controller' => $controller, 'order' => '')));
			}
		}
?>
<div class="pagination pagination-centered">
	<ul class="pagination">
		<?php
		if (isset($controller)) { 
			echo str_replace('page:', '', $this->Paginator->first('<<', array('tag' => 'li'))); 
			echo str_replace('page:', '', $this->Paginator->prev('<', array(
				'tag' => 'li',
				'class' => 'prev',
			), $this->Paginator->link('<', array()), array(
				'tag' => 'li',
				'escape' => false,
				'class' => 'prev disabled',
			))); 
		} else {
			echo $this->Paginator->first('<<', array('tag' => 'li')); 
			echo $this->Paginator->prev('<', array(
				'tag' => 'li',
				'class' => 'prev',
			), $this->Paginator->link('<', array()), array(
				'tag' => 'li',
				'escape' => false,
				'class' => 'prev disabled',
			));
		}
		if ($modulus > $pageCount) {
			$modulus = $pageCount;
		}
		$start = $page - intval($modulus / 2);
		if ($start < 1) {
			$start = 1;
		}
		$end = $start + $modulus;
		if ($end > $pageCount) {
			$end = $pageCount + 1;
			$start = $end - $modulus;
		}
		//echo "end".$end;
		for ($i = $start; $i < $end; $i++) {
			if (isset($controller) && isset($action)) {
				$url = array('controller' => $controller, 'action' => $action."/".$i);
			//} else if (isset($controller)) {
			//	$url = array('controller' => $controller, 'action' => $i);
			} else {
				$url = array('page' => $i);
			}
			
			$class = null;
			if ($i == $page) {
				$url = array();
				$class = 'active';
			}
			$link = $this->Html->tag('li', $this->Paginator->link($i, $url), array(
				'class' => $class,
			));
			echo $link;//."asdf";
		}
		
		if (isset($controller)) { 
			echo str_replace('page:', '', $this->Paginator->next('>', array(
				'tag' => 'li',
				'class' => 'next',
			), $this->Paginator->link('>', array()), array(
				'tag' => 'li',
				'escape' => false,
				'class' => 'next disabled',
			))); 
			echo str_replace('page:', '', str_replace('<>', '', $this->Html->tag('li', $this->Paginator->last('>>', array(
				'tag' => null,
			)), array(
				'class' => 'next',
			)))); 
		} else {
			echo $this->Paginator->next('>', array(
				'tag' => 'li',
				'class' => 'next',
			), $this->Paginator->link('>', array()), array(
				'tag' => 'li',
				'escape' => false,
				'class' => 'next disabled',
			)); 
			echo str_replace('<>', '', $this->Html->tag('li', $this->Paginator->last('>>', array(
				'tag' => null,
			)), array(
				'class' => 'next',
			))); 
		}
		?>
	</ul>
</div>