<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class VisatypeDetails extends Model
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
    protected $table = 'tbl_visa_type';
    //protected $fillable = ['contact_name', 'contact_mobile', 'contact_email', 'contact_content', 'created_at', 'updated_at'];

}
