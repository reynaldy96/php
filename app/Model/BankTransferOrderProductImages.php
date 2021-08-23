<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BankTransferOrderProductImages extends Model
{
    protected $guarded = [];

    protected $table = 'bank_transfer_order_product_images';

    public function images()
    {
        return $this->hasMany('App\Model\Bank\BankTransfer');
    }
}
