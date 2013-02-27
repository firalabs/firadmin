<div class="container">
	<div class="row-fluid">
		<div class="span12">
		
			<?php echo View::make('firadmin::partials.form-message')?>			
			<h3><?php echo Lang::get('admin.store-user')?></h3>
							
			<form method="post" action="<?php echo URL::to('admin/user');?>">
			<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
							
				<fieldset>
					
					<label><?php echo Lang::get('admin.username')?></label>
					<input type="text" name="username" value="<?php echo Input::old('username')?>">
					
					<label><?php echo Lang::get('admin.email')?></label>
					<input type="text" name="email" value="<?php echo Input::old('email')?>">
					
					<label><?php echo Lang::get('admin.password')?></label>
					<input type="password" name="password" value="">
					
					<label><?php echo Lang::get('admin.password_confirmation')?></label>
					<input type="password" name="password_confirmation" value="">
					
					<label><?php echo Lang::get('admin.roles')?></label>
					<?php foreach (Config::get('firadmin::roles') as $role => $permissions){?>
					<label class="checkbox">
					<input type="checkbox" name="roles[]" value="<?php echo $role?>"><?php echo ucfirst($role)?>
					</label>
					<?php }?>
					
					<div class="form-actions">
						<button class="btn btn-primary"><?php echo Lang::get('admin.store-user')?></button>
						<a href="<?php echo URL::to('admin/user/');?>" class="btn"><?php echo Lang::get('admin.cancel')?></a>
					</div>
					
				</fieldset>
			</form>
			
		</div>
	</div>
</div>