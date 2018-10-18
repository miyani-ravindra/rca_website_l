<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{   
    /*protected $fillable = [
        'username',
        'company',
        // add all other fields
    ];*/

    /**
     * The database name used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    protected $primaryKey = 'user_id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = ['user_id', 'email_id', 'mobile_no', 'username', 'nationality', 'created_at', 'updated_at'];

}
