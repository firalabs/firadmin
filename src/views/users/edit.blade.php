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
			
			<h3><?php echo Lang::get('admin.edit-user')?></h3>
				
			<ul class="nav nav-tabs enabled-tabs">
				<li class="active"><a href="#profile" data-toggle="tab"><?php echo Lang::get('admin.profil')?></a></li>
				<li><a href="#change-password" data-toggle="tab"><?php echo Lang::get('admin.change-password')?></a></li>
			</ul>
			
			<div class="tab-content">
							
				<div class="tab-pane active" id="profile">
					<form method="post" action="<?php echo URL::to('admin/user/' . $user->id);?>">
						<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
						<input type="hidden" name="_method" value="PUT">
						
						<fieldset>
							
							<label><?php echo Lang::get('admin.username')?></label>
							<input type="text" name="username" value="<?php echo Input::old('username', isset($user)?$user->username:'')?>">
							
							<label><?php echo Lang::get('admin.email')?></label>
							<input type="text" name="email" value="<?php echo Input::old('email', isset($user)?$user->email:'')?>">
					
							<label><?php echo Lang::get('admin.roles')?></label>
							<?php foreach (Config::get('firadmin::roles') as $role => $permissions){?>
							<label class="checkbox">
							<input type="checkbox" name="roles[]" value="<?php echo $role?>" <?php echo in_array($role, $user->getRoles())?'checked="checked"':''?>><?php echo ucfirst($role)?>
							</label>
							<?php }?>
							
							<div class="form-actions">
								<button class="btn btn-primary"><?php echo Lang::get('admin.update-user')?></button>
								<a href="<?php echo URL::to('admin/user/');?>" class="btn"><?php echo Lang::get('admin.cancel')?></a>
							</div>
							
						</fieldset>
					</form>
				</div>
				
				<div class="tab-pane" id="change-password">
					<form method="post" action="<?php echo URL::to('admin/user/' . $user->id . '/change-password');?>">
						<input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
						<input type="hidden" name="_method" value="PUT">
						
						<fieldset>
					
							<label><?php echo Lang::get('admin.password')?></label>
							<input type="password" name="password" value="">
							
							<label><?php echo Lang::get('admin.password_confirmation')?></label>
							<input type="password" name="password_confirmation" value="">
							
							<div class="form-actions">
								<button class="btn btn-primary"><?php echo Lang::get('admin.change-password')?></button>
								<a href="<?php echo URL::to('admin/user/');?>" class="btn"><?php echo Lang::get('admin.cancel')?></a>
							</div>
							
						</fieldset>
					</form>
				</div>
				
			</div>
			
		</div>
	</div>
</div>