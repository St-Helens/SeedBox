<?php
?>
            <ul class="nav nav-list">
              <li class="nav-header">Maintenance</li>
              <?php
              /*
              <li><?php echo $this->Html->link(__('phpMyAdmin'), '/phpMyAdmin'); ?></li>
              <li><?php echo $this->Html->link(__('phpMemcachedAdmin'), '/phpMemcachedAdmin'); ?></li>
              */
              ?>
              <li><?php echo $this->Html->link(__('Error log'), array('controller' => 'admin', 'action' => 'errorLog')); ?></li>
              <?php
              /*<li><?php echo $this->Html->link(__('Debug log'), array('controller' => 'admin', 'action' => 'debugLog')); ?></li>
              <li><?php echo $this->Html->link(__('Search log'), array('controller' => 'admin', 'action' => 'searchLog')); ?></li>
              <li><?php echo $this->Html->link(__('Fetch log'), array('controller' => 'admin', 'action' => 'fetchLog')); ?></li>
              <li><?php echo $this->Html->link(__('Store log'), array('controller' => 'admin', 'action' => 'storeLog')); ?></li>
              <li><?php echo $this->Html->link(__('Upload log'), array('controller' => 'admin', 'action' => 'uploadLog')); ?></li>
              <li><?php echo $this->Html->link(__('Memcached'), array('controller' => 'admin', 'action' => 'memcachedStats')); ?></li>
              <li><?php echo $this->Html->link(__('Redis'), array('controller' => 'admin', 'action' => 'redisInfo')); ?></li>
              <li class="nav-header">Social</li>
              <li><a href="https://www.facebook.com/crosspreach">Facebook</a></li>*/
              ?>
              <li class="nav-header">User</li>
              <li><?php echo $this->Html->link(__('List users'), array('controller' => 'Users', 'action' => 'index')); ?></li>
              <li><?php echo $this->Html->link(__('Add user'), array('controller' => 'Users', 'action' => 'add')); ?></li>
              <?php
              ?>
            </ul>