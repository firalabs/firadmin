<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>

<div class="container">

	<form class="form-signin" method="post">
	
		<?php echo Form::token();?>
		<h3 class="form-signin-heading"><?php echo Lang::get('firadmin::admin.retrieve-password')?></h3>
		
		<?php echo View::make('firadmin::partials.form-message')?>
		
		<input type="text" name="email" class="input-block-level" placeholder="<?php echo Lang::get('firadmin::admin.email')?>">
		<a class="btn" href="<?php echo URL::to(Config::get('firadmin::route.login'))?>"><?php echo Lang::get('firadmin::admin.cancel')?></a>
		<button class="btn btn-primary" type="submit"><?php echo Lang::get('firadmin::admin.send-reminder')?></button>
	</form>
	
</div> <!-- /container -->