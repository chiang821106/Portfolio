<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    

    public function order()
    {
        return $this->belongsTo(Order::class,'p_id');
    }


    public function order_details()
    {
        return $this->belongsTo(Order_details::class,'p_id');
    }



    public function user()
    {
        return $this->belongsTo(User::class,'u_id');
    }

    
    protected $table ="products";
    protected $fillable=[

      
      'p_name',
      'p_description',
      'p_photo',
      'p_price',
      'p_color',
      'p_filename',
      'p_filename_design',
      'p_filename_private',
      'u_id',
      'p_total',
        
    ];

    public $timestamps = false;
    protected $primaryKey = 'p_id';
}
