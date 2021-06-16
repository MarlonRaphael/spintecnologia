<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Cknow\Money\Money;
use Cknow\Money\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = ['id'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'customer_id',
    'discount',
    'status',
    'total',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'customer_id' => 'int',
    'discount' => 'int',
    'total' => 'int',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = [
    'total_view',
    'discount_view',
  ];

  /**
   * @var string[]
   */
  protected $dates = [
    'created_at',
    'updated_at'
  ];

  public function customer()
  {
    return $this
      ->belongsTo(Customer::class)
      ->withDefault([
        'name' => 'User Deleted',
        'cpf' => 'User Deleted',
        'email' => 'User Deleted',
      ]);
  }

  public function products()
  {
    return $this
      ->belongsToMany(Product::class)
      ->withPivot('quantity');
  }

  //-------------------------------------------------------------------
  //          Accessor Methods
  //-------------------------------------------------------------------

  public function getDiscountViewAttribute()
  {
    return Money::BRL($this->discount);
  }

  public function getTotalViewAttribute()
  {
    return Money::BRL($this->total);
  }

  public function isOpened()
  {
    return $this->status === OrderStatus::Opened;
  }

  public function isPaid()
  {
    return $this->status === OrderStatus::Paid;
  }

  public function isCanceled()
  {
    return $this->status === OrderStatus::Cancelled;
  }

  public function payOrder()
  {
    if ($this->status === '0') {
      return $this->fill(['status' => OrderStatus::Paid])->save();
    }

    return false;
  }

  public function cancelOrder()
  {
    if ($this->status !== '2') {
      return $this->fill(['status' => OrderStatus::Cancelled])->save();
    }

    return false;
  }
}
