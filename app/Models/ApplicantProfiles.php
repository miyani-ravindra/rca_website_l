<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ApplicantProfiles extends Model
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
    protected $table = 'applicant_profiles';

    protected $primaryKey = 'profile_id';

    protected $fillable = ['profile_id', 'user_id', 'username', 'surname', 'passport_detail_id', 'nationality', 'mobile_number', 'created_at', 'updated_at', 'order_id'];
}
