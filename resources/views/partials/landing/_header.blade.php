 <header id="header" class="header-scroll top-header headrom animated headroom--not-bottom fadeInDown headroom--top">
            <!-- .navbar -->
            <nav class="navbar navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="/"> <img class="img-rounded" style="width: 180px;" src="/images/logonew.png" alt="Foodoor logo"> </a>

                     <button class="navbar-toggler hidden-lg-up pull-xs-right" type="button" id="navbarSideButton">&#9776;</button>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse" style="margin-top: 10px;">
                        <ul class="nav navbar-nav">
                            
                            
                             <li class="nav-item"> <a class="nav-link {{ request()->is('contact') ? 'active' : '' }} " href="/contact">Contact Us</a> </li>
                         
                          @guest

                                <li class="nav-item"> <a class="nav-link {{ request()->is('login') ? 'active' : '' }} btn btn-border" href="{{ route('login') }}">Sign In</a> </li>
                            
                            <li class="nav-item"> <a class="nav-link  {{ request()->is('register') ? 'active' : '' }} btn" href="{{ route('register') }}">Create Account </a> </li>

                            @else 
                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> &nbsp;{{ auth()->user()->name }}</a>
                                <div class="dropdown-menu"> 
                                    <a class="dropdown-item" href="/home">&nbsp; Profile</a>  
                                    <a class="dropdown-item" href="/orders">&nbsp; Orders</a> 

                                     <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                         &nbsp; {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> 
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>

                <ul class="navbar-side hidden-sm-up" id="navbarSide">
                  <li class="navbar-side-item">
                    @guest
                    <a href="{{ route('login') }}" class="side-link">Sign In</a>
                    <a href="{{ route('register') }}" class="side-link">Create Account</a>
                    @else
                        <a class="side-link" href="/home">Profile</a>  
                        <a class="side-link" href="/orders">Orders</a> 

                         <a class="side-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                        </a>

                                   
                    @endguest
                    <a href="/contact" class="side-link">Contact Us</a>
                  </li>
                  <!-- insert more side-items if you so choose -->
                </ul>

                <div class="overlay"></div>
            </nav>
            <!-- /.navbar -->
        </header>