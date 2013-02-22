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
	
		<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
		<input type="hidden" name="token" value="{{ $token }}">
		
		<h2 class="form-signin-heading">Reset your password</h2>
		
		<?php echo View::make('firadmin::partials.form-message')?>
		
		<input type="text" name="email" class="input-block-level" placeholder="Email address">		
		<input type="password" name="password" class="input-block-level">		
		<input type="password" name="password_confirmation" class="input-block-level">
		
		<button class="btn btn-large btn-primary" type="submit">Reset</button>
	</form>
	
</div> <!-- /container -->