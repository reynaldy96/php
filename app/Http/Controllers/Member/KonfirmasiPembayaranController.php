<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Model\Bank\BankTransfer;
use App\Model\Order\BankTransferOrderProduct;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\Product;
use Brian2694\Toastr\Facades\Toastr;
use Sentinel;
use Storage;
use App\Model\BankTransferOrderProductImages;
use App\Model\Order\OrderProduk;

class KonfirmasiPembayaranController extends Controller
{
    public function index()
    {
        return view('Pages.Member.Order.KonfirmasiPembayaran');
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3',
        ]);

        $query = $request->input('query');

        $products = Order::where('kode_pembayaran', 'like', "%$query%")->get();

        return view('Pages.Member.Order.SearchResult')->with('products', $products);
    }

    public function edit($id)
    {
        $order = Order::find($id);

        $bank = BankTransfer::all();

        $orderproduk = OrderProduk::where('order_id', $id)->first();

        return view('Pages.Member.Order.Edit',compact('order','bank','orderproduk'));
    }

    public function store(Request $request, $id)
    {
        $user = Sentinel::getUser();
        $thumbnails = $request->thumbnails;
        $order_id = $request->order_id;
        $bank_transfer_id = $request->bank_transfer_id;
        $product_id = $request->product_id;
        $imagePath = Storage::disk('confirmation')->put($user->first_name . '/posts/' . $id, $thumbnails);
            
            $order = BankTransferOrderProduct::create([
                'bank_transfer_id' => $bank_transfer_id,
                'order_id' => $order_id,
                'product_id' => $product_id,
                'bank_transfer_image_path' => '/confirmation/' . $imagePath,
            ]);

            $data=array();
            $data['status_transaksi'] = 1;

            $data2=array();
            $data2['status_transaksi'] = 1;
    
            $update = Order::findOrFail($id)->update($data);
            
            OrderProduk::findOrFail($id)->update($data2);
            
            if ($update) {
                $notification = Toastr::success('Konfirmasi Barang telah diTerima, Menunggu Konfirmasi Admin','Success');
                    return Redirect()->route('orders.index')->with($notification);
            }else{
                $notification = Toastr::Error('Gagal Update Status Product, Pastikan Product User sudah diPeriksa !!!','Error');
                    return Redirect()->route('orders.index')->with($notification);
            }

    }
}
