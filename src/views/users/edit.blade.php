<script>
$('document').ready(function(){
	if(window.location.hash != ""){ 
		$('.enabled-tabs a[href="'+window.location.hash+'"]').tab('show'); 
	}
});
</script>

<div class="container">
	<div class="row-fluid">	
		<div class="span12">
		
			<?php echo View::make('firadmin::partials.form-message')?>			
			<h3><?php echo Lang::get('firadmin::admin.edit-user')?></h3>
					
		</div>	
	</div>
	<div class="row-fluid">
		<div class="span12">
				
			<ul class="nav nav-tabs enabled-tabs">
				<li class="active"><a href="#profile" data-toggle="tab"><?php echo Lang::get('firadmin::admin.profile')?></a></li>
				<li><a href="#change-password" data-toggle="tab"><?php echo Lang::get('firadmin::admin.change-password')?></a></li>
			</ul>
			
			<div class="tab-content">
							
				<div class="tab-pane active" id="profile">
					<form method="post" action="<?php echo URL::to(Config::get('firadmin::route.user') . '/' . $user->id);?>">
						<?php echo Form::token();?>
						<input type="hidden" name="_method" value="PUT">
						
						<fieldset>
							
							<label><?php echo Lang::get('firadmin::admin.username')?></label>
							<?php echo Form::text('username', Input::old('username', isset($user)?$user->username:''));?>
							
							<label><?php echo Lang::get('firadmin::admin.email')?></label>
							<?php echo Form::text('email', Input::old('email', isset($user)?$user->email:''));?>
					
							<label><?php echo Lang::get('firadmin::admin.roles')?></label>
							<?php foreach (Config::get('firadmin::roles') as $role => $permissions){?>
							<label class="checkbox">
							<?php echo Form::checkbox('roles[]', $role, in_array($role, $selected_roles));?><?php echo ucfirst($role)?>
							</label>
							<?php }?>
							
							<div class="form-actions">
								<?php echo Form::submit(Lang::get('firadmin::admin.update-user'), array('class' => 'btn btn-primary'));?>
								<a href="<?php echo URL::to(Config::get('firadmin::route.user'));?>" class="btn"><?php echo Lang::get('firadmin::admin.cancel')?></a>
							</div>
							
						</fieldset>
					</form>
				</div>
				
				<div class="tab-pane" id="change-password">
					<form method="post" action="<?php echo URL::to(Config::get('firadmin::route.user') . '/' . $user->id . '/change-password');?>">
						<?php echo Form::token();?>
						<input type="hidden" name="_method" value="PUT">
						
						<fieldset>
					
							<label><?php echo Lang::get('firadmin::admin.password')?></label>
							<input type="password" name="password" value="">
							
							<label><?php echo Lang::get('firadmin::admin.password_confirmation')?></label>
							<input type="password" name="password_confirmation" value="">
							
							<div class="form-actions">
								<button class="btn btn-primary"><?php echo Lang::get('firadmin::admin.change-password')?></button>
								<a href="<?php echo URL::to(Config::get('firadmin::route.user'));?>" class="btn"><?php echo Lang::get('firadmin::admin.cancel')?></a>
							</div>
							
						</fieldset>
					</form>
				</div>
				
			</div>
			
		</div>
	</div>
</div>