<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserLeads extends Model
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'user_leads';

    protected $primaryKey = 'lead_id';

    protected $fillable = ['lead_id', 'name', 'email_id', 'phone_number', 'nationality', 'travelling_to', 'residing_in', 'passport_type','airport_code', 'arrival_date', 'departure_date', 'adult', 'child', 'infant', 'order_id', 'product_id', 'created_at', 'updated_at', 'session_id', 'status'];
}
