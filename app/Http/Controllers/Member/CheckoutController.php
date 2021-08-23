<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Bank\BankTransfer;
use App\Model\Order;
use App\Model\Product;
use App\Model\Refund\RefundOrderProduct;
use App\Model\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use Brian2694\Toastr\Facades\Toastr;
use Sentinel;
use Storage;
use Cartalyst\Sentinel\Users\UserInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Model\UserProduct;
use App\Model\Order\OrderProduk;
use App\Model\Order\BankTransferOrderProduct;
use App\Model\Order\DistinationTransactionOrderProduk;
use App\Model\ProductsImages;
use App\Model\ProductsThumbnailImages;
use App\Model\Wilayah\Provinsi;
use App\Model\Wilayah\Kota;
use App\Model\Wilayah\Kabupaten;
use App\Model\Category\Category;
use App\Model\Category\SubCategory;
use App\Model\Category\BrandCategory;
use Response;
use App\Model\ProdukCategory\CategoryProduk;
use App\Model\ProdukCategory\SubCategoryProduk;
use App\Model\ProdukCategory\BrandCategoryProduk;

use App\Model\Kepemilikan\HandsProduk;
use App\Model\ProdukCod\CodProduk;
use App\Model\Cods;

use App\Model\WilayahProduk\ProvinsiProduk;
use App\Model\WilayahProduk\KabupatenProduk;
use App\Model\WilayahProduk\KotaProduk;

class CheckoutController extends Controller
{
    public function getStateList($param)
    {
        $city = Kota::where('province_id','=',$param)->get();

        $options = array();      
            foreach ($city as $arrayForEach) {         
                $options += array($arrayForEach->id => $arrayForEach->name);                
            }

        return Response::json($options);
    }

    public function getCityList($param)
    {
        $cities = Kabupaten::where('city_id','=',$param)->get();

        $options = array();      
            foreach ($cities as $arrayForEach) {         
                $options += array($arrayForEach->id => $arrayForEach->name);                
            }
        
        return Response::json($options);                
    }

    public function index()
    {
        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('shop.index');
        }

        if (Sentinel::getUser() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }

        
        $countries = Provinsi::all();

        $bank = BankTransfer::all();

        return view('Pages.Member.Checkout.Index')->with([
            'discount' => getNumbers()->get('discount'),
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'countries' => $countries,
            'bank' => $bank,
            'newTotal' => getNumbers()->get('newTotal'),
        ]);
    }

    public function store(Request $request)
    {
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Sorry! One of the items in your cart is no longer avialble.');
        }

        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug.', '.$item->qty;
        })->values()->toJson();


        $order = $this->addToOrdersTables($request, null);
        Mail::send(new OrderPlaced($order));

        $this->decreaseQuantities();

        Cart::instance('default')->destroy();

        return redirect()->route('orders.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
    }

    protected function addToOrdersTables($request, $error)
    {
        $order = Order::create([
            'user_id' => Sentinel::getUser() ? Sentinel::getUser()->id : null,
            'billing_email' => $request->billing_email,
            'billing_name' => $request->billing_name,
            'billing_address' => $request->billing_address,
            'billing_phone' => $request->billing_phone,
            'billing_discount' => getNumbers()->get('discount'),
            'billing_discount_code' => getNumbers()->get('code'),
            'billing_subtotal' => getNumbers()->get('newSubtotal'),
            'billing_tax' => getNumbers()->get('newTax'),
            'billing_total' => getNumbers()->get('newTotal'),
            'kode_pembayaran' => mt_rand(100000,999999),
            'status_transaksi' => $request->status_transaksi,
        ]);

        foreach (Cart::content() as $item) {
            OrderProduk::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        foreach (Cart::content() as $item) {
            DistinationTransactionOrderProduk::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'districts_id' => $request->districts_id,
                'tempat_transaksi' => $request->tempat_transaksi,
            ]);
        }

        return $order;
    }

    protected function decreaseQuantities()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);
            $product->update(['quantity' => $product->quantity - $item->qty]);
        }
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
