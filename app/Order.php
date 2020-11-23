<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function order_details()
    {
        return $this->hasMany(Order_details::class,'o_id',);
    }
    
    public function user()
    {
        return $this->belongsTo('App\User','u_id');
      }
      
      public function product()
      {
        
        return $this->hasManyThrough(Product::class,Order_details::class,'o_id','p_id');
        
        // return $this->hasMany('App\Product');
    }



    protected $table ="orders";
    protected $fillable=[
      'o_recipient',
      'o_recipient_phone',
      'o_recipient_address',
      'o_note',
      'o_status',
      'o_date',
      'u_id',
      'o_number',
      'od_id',
    ];
    protected $primaryKey = 'o_id';
}
