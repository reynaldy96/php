<?php

namespace App\Http\Controllers\Admin\Order;

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
use DataTables;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::where(['status_transaksi'=> false])->paginate(10);
        return view('Pages.Admin.Order.Index', compact('order'));
    }

    public function edit($id)
    {
        $waiting =  Order::where(['status_transaksi'=> false])->first();

        return view('Pages.Admin.Order.Update',compact('waiting'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'status_transaksi' => 'required',
            'status_transaksi1' => 'required',
        ]);
  
        $data=array();
        $data['status_transaksi'] = $request->status_transaksi;

        $data1=array();
        $data1['status_transaksi'] = $request->status_transaksi1;

        $updateorder = Order::findOrFail($id)->update($data);

        $updateorder = BankTransferOrderProduct::where('order_id',$id)->update($data1);

            if ($updateorder) {
                $notification = Toastr::success('Status Data Pesanan Berhasil diTambahkan','Success');
                    return Redirect()->route('order_admin')->with($notification);
            }else{
                $notification = Toastr::Error('Status Data Pesanan Gagal diTambahkan, Pastikan Data sudah diPeriksa !!!','Error');
                    return Redirect()->route('order_edit_waiting_admin')->with($notification);
            }
    }
}
