<div class="container">
	<div class="row-fluid">
		<div class="span12">
			
			<table class="table">
				<thead>
					<tr>
						<th>Label</th>
						<th>Value</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><strong><?php echo Lang::get('firadmin::admin.email')?></strong></td>
						<td><?php echo $user->email?></td>
					</tr>
					<tr>
						<td><strong><?php echo Lang::get('firadmin::admin.username')?></strong></td>
						<td><?php echo $user->username?></td>
					</tr>
					<tr>
						<td><strong><?php echo Lang::get('firadmin::admin.roles')?></strong></td>
						<td>
							<?php foreach ($user->roles as $role){?>
							<?php echo $role->role?><br>
							<?php }?>
						</td>
					</tr>
					<tr>
						<td><strong><?php echo Lang::get('firadmin::admin.created-at')?></strong></td>
						<td><?php echo $user->created_at?></td>
					</tr>
					<tr>
						<td><strong><?php echo Lang::get('firadmin::admin.updated-at')?></strong></td>
						<td><?php echo $user->updated_at?></td>
					</tr>
				</tbody>
			</table>
					
			<div class="form-actions">
				<a href="<?php echo URL::to(Config::get('firadmin::route.user') . '/' . $user->id . '/edit');?>" class="btn btn-primary"><?php echo Lang::get('firadmin::admin.edit')?></a>
				<a href="<?php echo URL::to(Config::get('firadmin::route.user'));?>" class="btn"><?php echo Lang::get('firadmin::admin.return')?></a>
			</div>
			
		</div>
	</div>
</div>