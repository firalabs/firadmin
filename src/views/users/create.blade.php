<div class="container">
	<div class="row-fluid">
		<div class="span12">
		
			<?php echo View::make('firadmin::partials.form-message')?>			
			<h3><?php echo Lang::get('admin.store-user')?></h3>
							
			<form method="post" action="<?php echo URL::to('admin/user');?>">
			<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
							
				<fieldset>
					
					<label><?php echo Lang::get('admin.username')?></label>
					<?php echo Form::text('username', Input::old('username'));?>
					
					<label><?php echo Lang::get('admin.email')?></label>
					<?php echo Form::text('email', Input::old('email'));?>
					
					<label><?php echo Lang::get('admin.password')?></label>
					<?php echo Form::password('password');?>
					
					<label><?php echo Lang::get('admin.password_confirmation')?></label>
					<?php echo Form::password('password_confirmation');?>
					
					<label><?php echo Lang::get('admin.roles')?></label>
					<?php foreach (Config::get('firadmin::roles') as $role => $permissions){?>
					<label class="checkbox">
					<?php echo Form::checkbox('roles[]', $role, in_array($role, $selected_roles));?><?php echo ucfirst($role)?>
					</label>
					<?php }?>
					
					<div class="form-actions">
						<?php echo Form::button(Lang::get('admin.store-user'), array('class' => 'btn btn-primary'));?>
						<a href="<?php echo URL::to('admin/user/');?>" class="btn"><?php echo Lang::get('admin.cancel')?></a>
					</div>
					
				</fieldset>
			</form>
			
		</div>
	</div>
</div>