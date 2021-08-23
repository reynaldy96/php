<?php

use Carbon\Carbon;

function presentPrice($price)
{
    return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
}

function presentDate($date)
{
    return Carbon::parse($date)->format('M d, Y');
}

function setActiveCategory($category, $output = 'active')
{
    return request()->category == $category ? $output : '';
}

function productImage($path)
{
    return $path && file_exists('thumbnail/'.$path) ?  Storage::disk('thumbnail'.$path) : asset('img/not-found.jpg');
}

function getNumbers()
{
    $tax = config('cart.tax') / 100;

    $taxsystem = config('cart.tax');

    $taxshop = config('cart.toko');

    $taxtoko = config('cart.toko') / 100;

    $discount = session()->get('coupon')['discount'] ?? 0;

    $code = session()->get('coupon')['name'] ?? null;

    $newSubtotal = Cart::subtotal();
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }

    $newTax = $newSubtotal * $tax;

    $newTotal = $newSubtotal * (1 + $tax);

    $discounttoko = session()->get('coupon')['discount'] ?? 0;

    $codetoko = session()->get('coupon')['name'] ?? null;

    $newSubtotaltoko = Cart::subtotal();
    if ($newSubtotaltoko < 0) {
        $newSubtotaltoko = 0;
    }

    $newTaxToko = $newSubtotaltoko * $taxtoko;

    $newTotalToko = $newSubtotaltoko * (1 + $tax + $taxtoko);

    return collect([
        'tax' => $tax,
        'taxsystem' => $taxsystem,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
        'taxtoko' => $taxtoko,
        'discounttoko' => $discounttoko,
        'codetoko' => $codetoko,
        'taxshop' => $taxshop,
        'newSubtotaltoko' => $newSubtotaltoko,
        'newTaxToko' => $newTaxToko,
        'newTotalToko' => $newTotalToko,
    ]);
}

function getStockLevel($quantity)
{
    if ($quantity > setting('site.stock_threshold', 5)) {
        $stockLevel = '<div class="badge badge-success">In Stock</div>';
    } elseif ($quantity <= setting('site.stock_threshold', 5) && $quantity > 0) {
        $stockLevel = '<div class="badge badge-warning">Low Stock</div>';
    } else {
        $stockLevel = '<div class="badge badge-danger">Not available</div>';
    }

    return $stockLevel;
}