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
						<td><strong>Email</strong></td>
						<td><?php echo $user->email?></td>
					</tr>
					<tr>
						<td><strong>Username</strong></td>
						<td><?php echo $user->username?></td>
					</tr>
					<tr>
						<td><strong>Created at</strong></td>
						<td><?php echo $user->created_at?></td>
					</tr>
					<tr>
						<td><strong>Updated at</strong></td>
						<td><?php echo $user->updated_at?></td>
					</tr>
				</tbody>
			</table>
					
			<div class="form-actions">
				<a href="<?php echo URL::to('admin/user/' . $user->id . '/edit');?>" class="btn btn-primary"><?php echo Lang::get('admin.edit')?></a>
				<a href="<?php echo URL::to('admin/user/');?>" class="btn"><?php echo Lang::get('admin.return')?></a>
			</div>
			
		</div>
	</div>
</div>