<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-responsive.min.css" rel="stylesheet">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="../assets/js/html5shiv.js"></script>
	<![endif]-->
	
	<!-- Le javascript
	================================================== -->
	<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>

	<style>
		body {
			padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		}
    </style>
	
</head>

<body>

	<?php if(Request::segment(2) !== 'login'):?>
	<!-- Main navigation -->
	<div class="navbar navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="brand" href="#"><?php echo $project_name?></a>
				<div class="nav-collapse collapse">
					<ul class="nav pull-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon icon-user"></span> <?php echo !empty(Auth::user()->username)?Auth::user()->username:''?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo URL::to('admin/user/' .  (!empty(Auth::user()->id)?Auth::user()->id:''))?>"><?php echo Lang::get('firadmin::admin.profile')?></a></li>
								<li><a href="<?php echo URL::to('admin/logout');?>"><?php echo Lang::get('firadmin::admin.logout')?></a></li>
               				</ul>
              			</li>
					</ul>
					<ul class="nav">
						<?php foreach ($navigation as $uri => $title):?>
						<li <?php echo (Request::path() == $uri)?'class="active"':'';?>><a href="<?php echo URL::to($uri);?>"><?php echo $title;?></a></li>
						<?php endforeach;?>
						
					</ul>
					
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<?php endif;?>
  
  	{{$content}}
  	
	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
  
</body>
</html>