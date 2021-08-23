<nav id="menu">
    <ul class="links">
        @if(Sentinel::check())
        <li>
            {{ Sentinel::getUser()->first_name }}
        </li> 
        <li>
            <a><i class="fa fa-user-circle" aria-hidden="true"></i> Account Saya</a>
        </li>

        <li>   
            <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart  @if (Cart::instance('default')->count() > 0)<span class="badge badge-danger badge-counter"> {{ Cart::instance('default')->count() }} </span>@endif</a>
        </li> 

        <li>
            <a href="{{ route('jual') }}"><i class="fas fa-chart-line" aria-hidden="true"></i> Dashboard</a>
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
            <a href="{{ route('jual_barang') }}"><i class="fas fa-hand-holding"></i> Jual Barang </a>
        </li> 
    
        <li>   
            <a href="{{ route('konfirmasi.index') }}"><i class="fas fa-comments-dollar"></i> Konfirmasi Pembayaran</a>
        </li> 

        <li>
            <a href=""><i class="fas fa-bell fa-fw"></i> Notification</a>
        </li>

        <li>   
            <a href="{{ route('orders.index') }}"><i class="fa fa-handshake-o" aria-hidden="true"></i> Order</a>
        </li> 

        <li>   
            <a href="{{ route('jual') }}"><i class="fa fa-hand-lizard-o" aria-hidden="true"></i> Pengembalian Dana</a>
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