<?php

//$authdotuser = $this->Session->read('Auth.User');
?>
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">SeedBox</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      	<li><a href="/search">Search</a></li>
      	<li><a href="/add">Add</a></li>
      
        <?php
        /*<li class="active"><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        */
        ?>
      </ul>
      <?php
      /*<form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      */
      ?>
      <ul class="nav navbar-nav navbar-right">
      	<?php
      	if ($authdotuser) {
      		if ($authdotuser['group_id'] == 1) {
        		echo "<li><a href=\"/admin\">Admin</a></li>";
      		} else {
      			//echo "<li><a href=\"#\">not admin</a></li>";
        	}
        	
      	?>
        <li><a href="/users/logout">Log out</a></li>
        <?php
        	
        /*<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>*/
        } else {
        	//echo "<li><a href=\"/users/login\">Log in</a></li>";
        }
        ?>
      </ul>
      <?php
      ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
/*
<div class="navbar">
  <div class="container">

    <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    <!-- Be sure to leave the brand out there if you want it shown -->
    <a class="navbar-brand" href="/">UCare</a>

    <!-- Place everything within .nav-collapse to hide it until above 768px -->
    <div class="nav-collapse collapse navbar-responsive-collapse">
      
      <ul class="nav navbar-nav">
      
  </ul>
  <?php
  	//echo $this->element('searchbox2');
			if ($authdotuser) {
			?>
			<p class="navbar-text pull-right">
			<?php
			if ($authdotuser['group_id'] == 1) {
			?>
			<a href="/admin">Admin</a> | 
			<?php
			}
			?>
			<a href="/profile/<?php echo $authdotuser['id']?>"><?php echo $authdotuser['email']?></a> | <?php
					echo "<a href=\"/users/logout/\">Logout</a>";
				//}
			
			?></p>
          <?php
          } else {
          	?>
			<p class="navbar-text pull-right"><a href="/users/login">Login</a> | <a href="/users/join">Join</a></p>
          	<?php
          }
          ?>
    </div><!-- /.nav-collapse -->
  </div><!-- /.container -->
</div><!-- /.navbar -->

<?php
*/
/*
?>
    <div class="navbar navbar-fixed-top">
      <?php
      //<div class="navbar-inner">
      ?>
        <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">SharedBookshelves</a>
          <div class="nav-collapse collapse navbar-responsive-collapse">
            <ul class="nav">
            	<?php
            		//fix active
            		//echo "<pre>";
            		//print_r($this->params);
            		//echo "</pre>";
            	
            	//fix
            	if (($this->params['controller'] == 'pages') &&
            		($this->params['action'] == 'display') &&
            		($this->params['pass'][0] == 'about')) {
            		echo "<li class=\"active\">";
            	} else {
            		echo "<li>";
            	}
            	?><a href="/about/">About</a></li>
            	<?php
            	if (($this->params['controller'] == 'users') &&
            		($this->params['action'] == 'contact')) {
            		echo "<li class=\"active\">";
            	} else {
            		echo "<li>";
            	}
            	?><a href="/contact/"><?php echo __('Contact');?></a></li>
            	<?php
            	//fix
            	?>
			</ul>
			<?php
			if ($authdotuser) {
			?>
			<p class="navbar-text pull-right"><a href="/admin">Admin</a> | <a href="/users/logout">Logout</a></p>
          <?php
          } else {
          	?>
			<p class="navbar-text pull-right"><a href="/users/login">Login</a></p>
          	<?php
          }
          ?></div><!--/.nav-collapse -->
			<div style="margin:8px;">
			<?php
			*/
			/*
			<div style="float:left;margin-right:5px;"><a href="https://twitter.com/sharedbooks" class="twitter-follow-button" data-show-count="false">Follow @sharedbooks</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
	<?php
	*/
	/*
	?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=186431284711709";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="fb-subscribe" data-href="https://www.facebook.com/david.butler1" data-layout="button_count" data-show-faces="false" data-width="450"></div>
	<?php
	*/
	
	/*
	<div id="likebutton">
	<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FSharedBookshelvescom%2F143695365662869&amp;layout=standard&amp;show_faces=false&amp;width=210&amp;action=like&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:210px; height:35px;" allowTransparency="true"></iframe>
	</div>
	*/
/*
	?>
          </div>
        </div>
      </div>
    </div>
<?php
*/
?>    