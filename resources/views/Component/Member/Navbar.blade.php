<nav id="menu">
    <ul class="links">
        @if(Sentinel::check())

        <li>   
            <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart  @if (Cart::instance('default')->count() > 0)<span class="badge badge-danger badge-counter"> {{ Cart::instance('default')->count() }} </span>@endif</a>
        </li> 

        @php($unread = \App\Model\QaTopic::unreadCount())
        <li>   
            <a href="{{ route('messenger.index') }}"><i class="fa fa-inbox"></i> Inbox  
            @if($unread > 0)
                <span class="badge badge-danger badge-counter">( {{ $unread }} )</span>
            @endif
            </a>        
        </li> 

        <li>
            Menu Pembeli
        </li> 

        <li>
            <a><i class="fa fa-user-circle" aria-hidden="true"></i> Account Saya</a>
        </li>

        <li>
            <a href="{{ route('jual') }}"><i class="fa fa-university" aria-hidden="true"></i> Dashboard</a>
        </li>

        <li>   
            <a href="{{ route('konfirmasi.index') }}"><i class="fa fa-money" aria-hidden="true"></i> Konfirmasi Pembayaran</a>
        </li> 
        @php($unread = \App\Model\NotificationQaTopic::unreadCount())
        <li>
            <a href="{{route('notification.member')}}"><i class="fa fa-bell-o"></i> Notification
                @if($unread > 0)
                    <span class="badge badge-danger badge-counter">( {{ $unread }} )</span>
                @endif
            </a>
        </li>

        <li>   
            <a href="{{ route('orders.index') }}"><i class="fa fa-handshake-o" aria-hidden="true"></i> Order</a>
        </li> 

        <li>   
            <a href="{{ route('jual') }}"><i class="fa fa-hand-lizard-o" aria-hidden="true"></i> Refund</a>
        </li> 

        <hr>

        <li>
            Menu Penjual
        </li> 
        
        <br>

        <li>
            <a href="{{ route('jual') }}"><i class="fa fa-area-chart" aria-hidden="true"></i> Dashboard</a>
        </li>
        
        <li>   
            <a href="{{ route('jual_barang') }}"><i class="fa fa-handshake-o" aria-hidden="true"></i> Jual Barang </a>
        </li> 
    
        <li>
            <a href=""><i class="fa fa-bell-o"></i> Notification</a>
        </li>

        <li>  
            <a onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout.user') }}" method="POST" style="display: none;">
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

        @else

        <li>   
            <a href="{{ route('jual') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-danger badge-counter"> 0 </span></a>
        </li> 

        <li>
            <a href="{{ route('login') }}"><i class="fa fa-key" aria-hidden="true"></i> {{ __('Login') }}</a>
        </li>
            
        @if (Route::has('register'))
        
        <li>
            <a href="{{ route('register') }}"><i class="fas fa-edit" aria-hidden="true"></i> {{ __('Register') }}</a>
        </li>
        
        @endif
        @endif
    </ul>
</nav>