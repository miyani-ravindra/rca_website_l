<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
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
    protected $table = 'order_details';

    protected $primaryKey = 'order_id';

    protected $fillable = ['order_id', 'order_code', 'user_id', 'product_id', 'adult', 'child', 'infant', 'nationality','total_price', 'updated_at', 'created_at', 'travel_date', 'arrival_date', 'arrival_time', 'departure_date', 'departure_time', 'arriving_airport', 'departing_airport', 'arrival_airline', 'departure_airline', 'addon_service', 'hours', 'airport_coming_from', 'airport_going_to', 'arrival_flight_no', 'departure_flight_no', 'applicant_booking_status', 'status', 'payment_status','payment_timestamp'];
}
