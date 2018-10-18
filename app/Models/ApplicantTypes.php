<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ApplicantTypes extends Model
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
    protected $table = 'applicant_types';
    protected $fillable = ['applicant_type_id', 'applicant_type_desc', 'created_at', 'updated_at'];

}
