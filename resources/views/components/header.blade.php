



<style>
    .carousel-item {
        height: 65vh;
        min-height: 350px;
        background: no-repeat center center scroll;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    .navbar-nav .nav-link.cart-button {
    padding: 0.5rem 1rem; /* Add some padding to maintain size */
    flex-shrink: 0; /* Prevent button from shrinking */
}
    .navbar-nav .nav-link:hover {
    color: green !important;
  }
  .btn-login {
    background-color: green !important;
    color: white !important;
}
.cart-button {
  position: relative;
  padding: 0.5rem 1rem;
  flex-shrink: 0;
}

.cart-count {
  position: absolute;
  top: 0;
  right: 0;
  background-color: red;
  color: white;
  padding: 0.2rem 0.5rem;
  border-radius: 50%;
  font-size: 12px;
}

.cart-count::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 10px;
  height: 10px;
  background-color: white;
  border-radius: 50%;
}
.btn-logout {
    background-color: red !important;
    color: white !important;
}





    .main-navbar{
        border-bottom: 1px solid #ccc;
    }
    .main-navbar .top-navbar{
        background-color: black;
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .main-navbar .top-navbar .brand-name{
        color: #fff;
    }
    .main-navbar .top-navbar .nav-link{
        color: #fff;
        font-size: 16px;
        font-weight: 500;
    }
    .main-navbar .top-navbar .dropdown-menu{
        padding: 0px 0px;
        border-radius: 0px;
    }
    .main-navbar .top-navbar .dropdown-menu .dropdown-item{
        padding: 8px 16px;
        border-bottom: 1px solid #ccc;
        font-size: 14px;
    }
    .main-navbar .top-navbar .dropdown-menu .dropdown-item i{
        width: 20px;
        text-align: center;
        color: #2874f0;
        font-size: 14px;
    }
    .main-navbar .navbar{
        padding: 0px;
        background-color: #ddd;
    }
    .main-navbar .navbar .nav-item .nav-link{
        padding: 8px 20px;
        color: #000;
        font-size: 15px;
    }

    @media only screen and (max-width: 600px) {
        .main-navbar .top-navbar .nav-link{
            font-size: 12px;
            padding: 8px 10px;
        }
    }
</style>
<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <h5 class="brand-name">Abu-Maaz.T</h5>
                </div>
                <div class="col-md-5 my-auto">
                    <form role="search">
                        <div class="input-group">
                        <form action="/search" method="GET" class="d-flex">
    <input type="search" name="query" placeholder="Search your product" class="form-control" />
    <button type="submit" class="btn bg-white">
        <svg width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
    </button>
</form>

                        </div>
                    </form>
                </div>
                <div class="col-md-5 my-auto">
                    <ul class="nav justify-content-end">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="/cart">
                                <i class="fa fa-shopping-cart"></i> Cart 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-heart"></i> About Abu-Maaz
                            </a>
                        </li>
                        <li class="nav-item me-2">
@guest
<a class="nav-link btn btn-login" href="{{ route('login') }}">Login</a>
@else
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
</form>
<a class="nav-link btn btn-logout" href="{{ route('logout') }}"
onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
Logout
</a>
@endguest
</li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>
