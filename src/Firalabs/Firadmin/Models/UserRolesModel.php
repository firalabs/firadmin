<?php namespace Firalabs\Firadmin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Roles model associates to users
 * 
 * @author maxime.beaudoin
 */
class UserRolesModel extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_roles';
	
	/**
	 * Users relation
	 */
	public function user()
    {
        return $this->belongsTo('Firalabs\Firadmin\Models\UserModel');
    }

}