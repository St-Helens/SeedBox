<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/*
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid developpppment php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
<?php
*/
?>
<!DOCTYPE html>
<?php 
	//echo $this->Facebook->html(); 
	echo "<html>";
	?>
  <head>
    <meta charset="utf-8">
    
<?php
	if (!isset($title)) {
		$title = "Seedbox";
	}
	if (!isset($keywords)) {
		$keywords = "Seedbox";
	} else {
		$keywords .= "Seedbox";
	}
	if (!isset($description)) {
		$description = $title;
	}
?>
    <title><?php echo $title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description?>">
    <meta name="keywords" content="<?php echo $keywords?>">
    <?php
    /*<meta name="author" content="David Butler">*/
	?>
    <!-- Le styles -->
  <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <?php
		echo $this->Html->css('bootstrap.min');
		//<link href="../assets/css/bootstrap.css" rel="stylesheet">
    /*
    ?>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <?php
    */
    ?>
    <style>
        html, body {
            height: 100%;
        }
    	/*body { 
            height: 100%;
    		padding-top: 70px;
    		padding-bottom: 70px; 
    	}*/
    	<?php
    	/*
    	?>
        html, body {
            height: 100%;
        }*/
        ?>
        footer {
            color: #666;
            display:block;
            padding: 17px 0 18px 0;
            margin-top: 20px;
            border-top: 1px solid #eeeeee;
            text-align:center;
        }
        <?php
        /*
        footer a {
            color: #999;
        }
        footer a:hover {
            color: #efefef;
        }
        .wrapper {
            min-height: 100%;
            height: auto !important;
            height: 100%;
            margin: 0 auto -72px;
        }
        .push {
            height: 63px;
        }
        .wrapper > .container {
            padding-top: 60px;
        }
        <?php
        */
        ?>
    </style>
    <?php
		//echo $this->Html->css('bootstrap-responsive.min');
    	//<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
	?>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<?php
		echo $this->Html->meta('icon');
?>
<?php
//fix
/*
<!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    */
/*<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8740818-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>*/

?>

  </head>
  <body>
  <?php
/*<script type="text/javascript">
window.google_analytics_uacct = "UA-33529034-37";
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-33529034-37', 'crosspreach.com');
  ga('require', 'linkid', 'linkid.js');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>*/
/*
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-33529034-47', 'auto');
  ga('send', 'pageview');

</script>
<?php
*/
$authdotuser = $this->Session->read('Auth.User');
?>

	<div class="wrapper">
	<?php
		echo $this->element('navbar', array('authdotuser' => $authdotuser));
	/*
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">Brand</a>
          <div class="nav-collapse">
            <ul class="nav">
            	<?php
            		//fix active
            	?>
              <li class="active"><a href="/">Home</a></li>
              <li><a href="/about/">About</a></li>
              <li><a href="/software/">Software</a></li>
              <li><a href="/apps/">Apps</a></li>
              <li><a href="/projects/">Projects</a></li>
              <li><a href="/blog/">Blog</a></li>
              <li><a href="/contact/"><?php echo __('Contact');?></a></li>
			</ul>

          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>*/
?>
    <div class="container">
		<div id="content">
			<?php 
			echo $this->Session->flash(); 
			echo $content_for_layout; 
			?>
		</div>

    </div> <!-- /container -->
    <?php
      /*<div class="push"><!--//--></div>*/
      ?>
</div>
<footer class="footer">
      <div class="container">
      <small>&copy; <?php echo date("Y");?> SeedBox<br />
      <?php
      //<a href="/privacy">Privacy</a> <a href="/terms">Terms</a>
      ?><br />
      <?php
      /*<a href="http://twitter.com/crosspreach">Twitter</a> <a href="http://facebook.com/crosspreach">Facebook</a>*/
      ?>
      </small>
      </div>
</footer>
    <!-- Le javascript
    ================================================== -->
<?php
//fix
	//$javascript->link(‘myScript’, false);
	//echo $scripts_for_layout;
//<script src="/js/jquery-1.7.min.js"></script>
    ?>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery-1.7.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    
  <script src="/js/jquery-ui.min.js"></script>
    <script>
    /*$('.carousel').carousel()*/
    
    $('.container').tooltip({
      selector: "a[rel=tooltip]"
    })

    $("a[rel=popover]")
      .popover()
      .click(function(e) {
        e.preventDefault()
      })
    </script>
<?php
/*
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-typeahead.js"></script>*/
    /*<script src="/js/bootstrap-transition.js"></script>
    <script src="/js/bootstrap-alert.js"></script>
    <script src="/js/bootstrap-modal.js"></script>
    <script src="/js/bootstrap-dropdown.js"></script>
    <script src="/js/bootstrap-scrollspy.js"></script>
    <script src="/js/bootstrap-tab.js"></script>
    <script src="/js/bootstrap-tooltip.js"></script>
    <script src="/js/bootstrap-popover.js"></script>
    <script src="/js/bootstrap-button.js"></script>
    <script src="/js/bootstrap-collapse.js"></script>
    <script src="/js/bootstrap-carousel.js"></script>
    <script src="/js/bootstrap-typeahead.js"></script>*/

    echo $this->Js->writeBuffer();
	//echo $this->Facebook->init(); 
	//echo $this->element('sql_dump'); 
	?>
</body>
</html>