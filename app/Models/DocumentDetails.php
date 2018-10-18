<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DocumentDetails extends Model
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

    protected $primaryKey = 'doc_id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'document_details';
    protected $fillable = ['doc_id', 'user_id', 'applicant_id', 'doc_type', 'doc_size', 'doc_url', 'doc_mime_type', 'created_at', 'updated_at'];

}
