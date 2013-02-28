<div class="container">
	<div class="row-fluid">
		<div class="span12">
		
			<?php echo View::make('firadmin::partials.form-message')?>
	
			<h3 class="pull-left"><?php echo Lang::get('firadmin::admin.users')?></h3>	
			<a href="<?php echo URL::to('admin/user/create');?>" class="btn btn-primary pull-right"><?php echo Lang::get('firadmin::admin.add-user')?></a>
				
			<table class="table">
				<thead>
					<tr>
						<th><?php echo Lang::get('firadmin::admin.username')?></th>
						<th><?php echo Lang::get('firadmin::admin.email')?></th>
						<th><?php echo Lang::get('firadmin::admin.updated-at')?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user):?>
					<tr>
						<td><a href="<?php echo URL::to('admin/user/' . $user->id);?>"><?php echo $user->username?></a></td>
						<td><?php echo $user->email?></td>
						<td><?php echo $user->updated_at?></td>
						<td>
							<div class="btn-group">
								<a data-toggle="dropdown" class="btn btn-small dropdown-toggle">
									<i class="icon-cog"></i>
								</a>
								<ul class="dropdown-menu">          
									<li><a href="<?php echo URL::to('admin/user/' . $user->id);?>"><?php echo Lang::get('firadmin::admin.show')?></a></li>
									<li><a href="<?php echo URL::to('admin/user/' . $user->id . '/edit');?>"><?php echo Lang::get('firadmin::admin.edit')?></a></li>
									<li><a href="<?php echo URL::to('admin/user/' . $user->id) . '/destroy';?>" onclick="return confirm('<?php echo Lang::get('firadmin::admin.delete-confirm')?>')"><?php echo Lang::get('firadmin::admin.delete')?></a></li>
								</ul>
							</div>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			
		</div>
	</div>
</div>