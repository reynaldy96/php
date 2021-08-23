<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Brian2694\Toastr\Facades\Toastr;
class SaveForLaterController extends Controller
{
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        $notification = Toastr::success('Barang Berhasil diHapus pada Cart anda ','Success');
        
        return back()->with($notification);
    }

    public function switchToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        $notification = Toastr::success('Barang sudah tersedia dalam Cart anda ','Success');

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with($notification);
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Product');

        $cart = Toastr::success('Barang Berhasil pindah pada Cart anda','Success');

        return redirect()->route('cart.index')->with($cart);
    }
}
