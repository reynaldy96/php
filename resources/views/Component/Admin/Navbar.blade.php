<nav id="menu">
    <ul class="links">     
        <li>
            <a><i class="fa fa-user-circle" aria-hidden="true"></i> Account Saya</a>
        </li>

        <li>
            <a href="{{ route('dashboard_admin') }}"><i class="fas fa-chart-line" aria-hidden="true"></i> Dashboard</a>
        </li>

        @php($unread = \App\Model\QaTopic::unreadCount())
        <li>   
            <a href="{{ route('messenger.index') }}"><i class="fas fa-envelope"></i> Inbox  
            @if($unread > 0)
                <span class="badge badge-danger badge-counter">( {{ $unread }} )</span>
            @endif
            </a>
        
        </li> 

        <li>
            <a href=""><i class="fas fa-bell fa-fw"></i> Notification</a>
        </li>

        <li>
            <a> <i class="fab fa-accusoft"></i> Jenis Category Barang  </a>
        </li> 

        <br>
        
        <li>   
            <a href="{{ route('category_admin') }}"><i class="fas fa-angle-double-right"></i> Category Barang </a>
        </li> 

        <li>   
            <a href="{{ route('subcategory_admin') }}"><i class="fas fa-angle-double-right"></i> Jenis Category Barang </a>
        </li> 

        <li>   
            <a href="{{ route('merkcategory_admin') }}"><i class="fas fa-angle-double-right"></i> Merk Category Barang </a>
        </li> 
        
        <li>
            <a> <i class="fas fa-handshake"></i> Kepemilikan Barang  </a>
        </li> 

        <br>
        
        <li>   
            <a href="{{ route('hand_admin') }}"><i class="fas fa-angle-double-right"></i> Kepemilikan Barang </a>
        </li> 

        <li>
            <a> <i class="fas fa-handshake"></i> Transaksi Cod  </a>
        </li> 

        <br>
        
        <li>   
            <a href="{{ route('cods_admin') }}"><i class="fas fa-angle-double-right"></i> Add Transaksi Method</a>
        </li> 

        <li>
            <a> <i class="fas fa-globe-asia"></i> Wilayah Indonesia</a>
        </li> 

        <br>
        
        <li>   
            <a href="{{ route('Provinsi_admin') }}"><i class="fas fa-angle-double-right"></i> Provinsi Indonesia</a>
        </li> 

        <li>   
            <a href="{{ route('kabupaten_admin') }}"><i class="fas fa-angle-double-right"></i> Kabupaten Indonesia</a>
        </li> 

        <li>   
            <a href="{{ route('kota_admin') }}"><i class="fas fa-angle-double-right"></i> Kota Indonesia</a>
        </li> 

        <li>
            <a> <i class="fab fa-acquisitions-incorporated"></i> Status Produk </a>
        </li> 

        <br>
        
        <li>   
            <a href="{{ route('waiting_admin') }}"><i class="fas fa-angle-double-right"></i> Waiting Status Produk</a>
        </li> 

        <li>   
            <a href="{{ route('publish_admin') }}"><i class="fas fa-angle-double-right"></i> Publish Status Produk</a>
        </li> 

        <li>   
            <a href="{{ route('unpublish_admin') }}"><i class="fas fa-angle-double-right"></i> UnPublish Status Produk</a>
        </li> 

        <li>
            <a href=""> <i class="fas fa-hand-holding-usd"></i> Order Produk </a>
        </li> 

        <br>
        
        <li>   
            <a href="{{ route('order_admin') }}"><i class="fas fa-angle-double-right"></i> Waiting Order Produk</a>
        </li> 

        <li>   
            <a href=""><i class="fas fa-angle-double-right"></i> Publish Order Produk</a>
        </li> 

        <li>   
            <a href=""><i class="fas fa-angle-double-right"></i> UnPublish Order Produk</a>
        </li> 

        <br>

        <li>
            <a> <i class="fas fa-shield-alt"></i> Permission User</a>
        </li> 

        <br>
        
        <li>   
            <a href="{{ route('user_admin') }}"><i class="fas fa-angle-double-right"></i> All User </a>
        </li> 

        <li>   
            <a href=""><i class="fas fa-angle-double-right"></i> Role User </a>
        </li> 

        <br>
           
        <li>  
            <a onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li> 

        <hr>
        <br>
        <br>

        <li>
            {{ Sentinel::getUser()->first_name }}
        </li> 

        <br>
    </ul>
</nav>