<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\UserProduct;
use App\Model\ProductsImages;
use App\Model\ProductsThumbnailImages;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Sentinel;

class CartController extends Controller
{
    public function index()
    {
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Sorry! One of the items in your cart is no longer avialble.');
        }

        $mightAlsoLike = Product::mightAlsoLike()->get();
        
        return view('Pages.Guest.Cart.Index')->with([
            'mightAlsoLike' => $mightAlsoLike,
            'taxshop' => getNumbers()->get('taxshop'),
            'taxsystem' => getNumbers()->get('taxsystem'),
            'discount' => getNumbers()->get('discount'),
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal'),			
			'discounttoko' => getNumbers()->get('discounttoko'),
            'newSubtotaltoko' => getNumbers()->get('newSubtotaltoko'),
            'newTaxToko' => getNumbers()->get('newTaxToko'),
            'newTotalToko' => getNumbers()->get('newTotalToko'),
        ]);
    }

    public function store(Product $product)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });
        
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index');
        }

        Cart::add($product->id, $product->name, 1, $product->price)
            ->associate('App\Model\Product');

        $cart = Toastr::success('Barang Berhasil pindah pada Cart anda','Success');

        return redirect()->route('cart.index')->with($cart);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);

        if ($validator->fails()) {
            session()->flash('errors', collect(['Quantity must be between 1 and 5.']));
            return response()->json(['success' => false], 400);
        }

        if ($request->quantity > $request->productQuantity) {
            session()->flash('errors', collect(['We currently do not have enough items in stock.']));
            return response()->json(['success' => false], 400);
        }

        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Cart::remove($id);

        $notification = Toastr::success('Barang Berhasil diHapus pada Cart anda ','Success');

        return back()->with($notification);
    }

    public function switchToSaveForLater($id)
    {
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Sorry! One of the items in your cart is no longer avialble.');
        }
        
        $item = Cart::get($id);

        Cart::remove($id);

        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index');
        }

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Model\Product');

        $cart = Toastr::success('Barang Berhasil disimpan','Success');

        return redirect()->route('cart.index')->with($cart);
    }

    protected function productsAreNoLongerAvailable()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty) {
                return true;
            }
        }

        return false;
    }

}
