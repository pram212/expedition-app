<?php

namespace App\Models\CRM;

use App\Models\District;
use App\Models\Master\category;
use App\Models\Master\PaymentStatus;
use App\Models\Master\ShippmentStatus;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * RELATION METHOD
     */

     public function category()
     {
        return $this->belongsTo(category::class);
     }

     public function paymentStatus()
     {
        return $this->belongsTo(PaymentStatus::class, 'payment_statuses_id');
     }

     public function shippmentStatus()
     {
        return $this->belongsTo(ShippmentStatus::class, 'shippment_statuses_id');
     }

     public function district()
     {
        return $this->belongsTo(District::class);
     }

     public function village()
     {
        return $this->belongsTo(Village::class);
     }

}
