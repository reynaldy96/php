<?php

namespace App\Model\Order;

use Illuminate\Database\Eloquent\Model;

class BankTransferOrderProduct extends Model
{
    protected $guarded = [];

    protected $table = 'bank_transfer_order_product';

    public function BankTransferOrderProductImages()
    {
        return $this->hasOne('App\Model\Order\BanktransferOrderProductImages');
    }
}
