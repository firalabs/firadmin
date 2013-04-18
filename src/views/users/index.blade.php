<div class="container">

	<div class="row-fluid">	
		<div class="span12">		
			<?php echo View::make('firadmin::partials.form-message')?>	
			<h3><?php echo Lang::get('firadmin::admin.users')?></h3>					
		</div>	
	</div>
	
	<div class="row-fluid">	
		<div class="span12">
			Show
			<select class="input-small" onchange="window.location.href=$(this).val()">
				<option value="<?php echo URL::to(Config::get('firadmin::route.user'). '?take=10');?>" <?php echo Input::get('take') == 10?'selected':''?>>10</option>
				<option value="<?php echo URL::to(Config::get('firadmin::route.user'). '?take=25');?>" <?php echo Input::get('take') == 25?'selected':''?>>25</option>
				<option value="<?php echo URL::to(Config::get('firadmin::route.user'). '?take=50');?>" <?php echo Input::get('take') == 50?'selected':''?>>50</option>
				<option value="<?php echo URL::to(Config::get('firadmin::route.user'). '?take=100');?>" <?php echo Input::get('take') == 100?'selected':''?>>100</option>
			</select> entries			
			<a href="<?php echo URL::to(Config::get('firadmin::route.user') . '/create');?>" class="btn btn-success pull-right">
				<span class="icon-white icon-plus"></span> <?php echo Lang::get('firadmin::admin.add-user')?>
			</a>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span12">		
					
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
						<td><a href="<?php echo URL::to(Config::get('firadmin::route.user') . '/' . $user->id);?>"><?php echo $user->username?></a></td>
						<td><?php echo $user->email?></td>
						<td><?php echo $user->updated_at?></td>
						<td>
							<div class="btn-group">
								<a href="<?php echo URL::to(Config::get('firadmin::route.user') . '/' . $user->id . '/edit');?>" class="btn btn-small"><?php echo Lang::get('firadmin::admin.edit')?></a>
								<a data-toggle="dropdown" class="btn btn-small dropdown-toggle">
									<i class="icon-cog"></i>
								</a>
								<ul class="dropdown-menu pull-right">          
									<li><a href="<?php echo URL::to(Config::get('firadmin::route.user') . '/' . $user->id);?>"><?php echo Lang::get('firadmin::admin.show')?></a></li>
									<li>
										<a href="#" onclick="if(confirm('<?php echo Lang::get('firadmin::admin.delete-confirm')?>')){ return $('form[data-user-id=<?php echo $user->id?>]').submit()}"><?php echo Lang::get('firadmin::admin.delete')?></a>
										<form class="hidden" data-user-id="<?php echo $user->id?>" method="post" action="<?php echo URL::to(Config::get('firadmin::route.user') . '/' . $user->id);?>">
										<?php echo Form::token();?>
										<input type="hidden" name="_method" value="DELETE">
										</form>
									</li>
								</ul>
							</div>
						</td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
			
			<?php echo $users->links(); ?>			
		</div>
	</div>
</div>