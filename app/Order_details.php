<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
  public function order()
  {
      return $this->belongsTo(Order::class,'o_id');
  }
  public function product()
  {
    return $this->hasMany(Product::class,'p_id');
  }

    protected $table ="order_details";
    protected $fillable=[

      'p_id',
      'od_id',
      'od_size',
      'od_color',
      'od_quantity',
      'od_price',
      'od_total',
      'od_filename',
      'o_id',
    ];
    protected $primaryKey = 'od_id';//
}
