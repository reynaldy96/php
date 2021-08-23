@component('mail::message')
# Order Received

Konfirmasi Pemesanan anda {{ $order->kode_pembayaran }}

**Order ID:** {{ $order->id }}

**Email:** {{ $order->billing_email }}

**Items Ordered**

@foreach ($order->products as $product)
Barang : {{ $product->name }} <br>
Harga : @currency($product->price)<br>
Jumlah Barang: {{ $product->pivot->quantity }} <br>
@endforeach

**Jumlah Pesanan :** @currency($order->billing_subtotal) <br>

**Biaya System 1% :** @currency($order->billing_tax) <br>

**Total yang Harus diBayar 1% :** @currency($order->billing_total) <br>

You can get further details about your order by logging into our website.

@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Go to Website
@endcomponent

Thank you again for choosing us.

Regards,<br>
{{ config('app.name') }}
@endcomponent
