 <header id="header" class="header-scroll top-header headrom animated headroom--not-bottom fadeInDown headroom--top">
            <!-- .navbar -->
            <nav class="navbar navbar-light">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="/"> <img class="img-rounded" style="width: 180px;" src="/images/logonew.png" alt=""> </a>
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
            </nav>
            <!-- /.navbar -->
        </header>