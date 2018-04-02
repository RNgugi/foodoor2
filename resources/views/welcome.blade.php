
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Foodoor.in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-grid.css" />
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/css/homepage.css" />
    <link rel="stylesheet" type="text/css" href="/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="/css/chosen.css" />
    <link rel="stylesheet" type="text/css" href="/css/colors.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    
</head>
<body>



<div class="theme-layout" id="scrollup">
    
    <div class="responsive-header">
        <div class="responsive-menubar">
           <div class="res-logo"><a href="index.html" title=""><img src="images/resource/logo.png" alt=""></a></div>
           <div class="menu-resaction">
              <div class="res-openmenu">
                 <img src="images/icon.png" alt=""> Menu
              </div>
              <div class="res-closemenu">
                 <img src="images/icon2.png" alt=""> Close
              </div>
           </div>
        </div>
        <div class="responsive-opensec">
        @guest
           <div class="btn-extars">
              <a href="/register" title="" class="post-job-btn">Sign Up</a>
              <ul class="account-btns">
                 <li class=""><a title="" href="/login">Login</a></li>
              </ul>
           </div>
           @endguest
           <!-- Btn Extras -->
           <!-- <form class="res-search">
              <input placeholder="Job title, keywords or company name" type="text">
              <button type="submit"><i class="la la-search"></i></button>
           </form> -->
           <div class="responsivemenu">
            <ul>
              @auth
                         <li class="menu-item-has-children">
                          <a href="{{ route('home') }}" title="">{{ auth()->user()->name }}</a>
                           <ul>
                              <li><a href="#" title=""><i class="fa fa-user"></i> Manage Profile</a></li>
                              <li><a href="#" title=""><i class="fa fa-file-text"></i> My Orders</a></li>

                              <li> <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>  {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></li>
                           </ul>
                        </li>
                        @endauth
                        </ul>
           </div>
        </div>
    </div>
    <header class="style2">
        <div class="menu-sec">
           <div class="container">
              <div class="logo">
                 <a href="/" title=""><img src="images/resource/logo.png" alt=""></a>
              </div>
              <!-- Logo -->
              @guest
              <div class="btn-extars">
                 <a href="/register" title="" class="post-job-btn">Sign Up</a>
                 <a href="/login" title="" class="post-job-btn m-l-15">Login</a>
              </div>
              @endguest
              <!-- Btn Extras -->
              <nav>
              <ul>
               @auth
                         <li class="menu-item-has-children">
                          <a href="{{ route('home') }}" title="">{{ auth()->user()->name }}</a>
                           <ul>
                              <li><a href="#" title=""><i class="fa fa-user"></i> Manage Profile</a></li>
                              <li><a href="#" title=""><i class="fa fa-file-text"></i> My Orders</a></li>

                              <li> <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>  {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></li>
                           </ul>
                        </li>
                        @endauth
                </ul>
              </nav>
              <!-- Menus -->
           </div>
        </div>
    </header>

    <section>
        <div class="block no-padding">
            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-featured-sec style2">
                            <ul class="main-slider-sec style2 text-arrows">
                                <li class="slideHome"><img src="/images/resource/mslider3.jpg" alt="" /></li>
                                <li class="slideHome"><img src="/images/resource/mslider2.jpg" alt="" /></li>
                            </ul>
                            <div class="job-search-sec">
                                <div class="job-search style2">
                                    <p class="text-center banner-sub-heading">Are you Hungry ? Want a food at your door step...</p>
                                    <h3>Foodoor Coming soon @ Ranchi</h3>
                                    <span class="text-center banner-sub-heading">When you think food think foodoor..</span>
                                    <div class="quick-select-sec">
                                    <div class="row">
                                       <div class="col-lg-4 col-md-4 col-sm-4">
                                          <div class="quick-select">
                                             <a href="#" title="">
                                             <i class="la la-home"></i>
                                             <span>Quality Assured Restaurants</span>
                                             </a>
                                          </div>
                                          
                                       </div>
                                       <div class="col-lg-4 col-md-4 col-sm-4">
                                          <div class="quick-select">
                                             <a href="#" title="">
                                             <i class="la la-truck "></i>
                                             <span>Fastest Food Delivery</span>
                                             </a>
                                          </div>
                                          
                                       </div>
                                       <div class="col-lg-3 col-md-3 col-sm-3">
                                          <div class="quick-select">
                                             <a href="#" title="">
                                             <i class="la la-history"></i>
                                             <span>24 Hrs in Your Service</span>
                                             </a>
                                          </div>
                                          
                                       </div>
                                    </div>
                                 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="job-grid-sec">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <a href="/restaurants">
                                        <div class="job-grid" style="background-image: url('images/resource/restaurant.png');;background-size: 100% 100%;">
                                            <div class="overlay">
                                                <p class="types-banner-title">Restaurants</p>
                                            </div>
                                        </div><!-- JOB Grid -->
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <a href="/bakery">
                                        <div class="job-grid" style="background-image: url('images/resource/bakery.png');;background-size: 100% 100%;">
                                            <div class="overlay">
                                                <p class="types-banner-title">Bakery</p>        
                                            </div>
                                        </div><!-- JOB Grid -->
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <a href="/sweets">
                                        <div class="job-grid" style="background-image: url('images/resource/sweets.png');;background-size: 100% 100%;">
                                            <div class="overlay">
                                                <p class="types-banner-title">Sweets</p>        
                                            </div>
                                        </div><!-- JOB Grid -->
                                    </a>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="block gray">
           <div class="container">
              <div class="row">
                 <div class="col-lg-12">
                    <div class="heading">
                       <h2>How It Works</h2>
                       <span>Each day, more than 1 thousand Foodies turn to website in their search for food, making over <br>100's of orders every day.
                       </span>
                    </div>
                    <!-- Heading -->
                    <div class="how-to-sec">
                       <div class="how-to">
                          <span class="how-icon"><i class="la la-university"></i></span>
                          <h3>Choose A Restaurant</h3>
                          <p>Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
                       </div>
                       <div class="how-to">
                          <span class="how-icon"><i class="la la-cutlery"></i></span>
                          <h3>Choose Your Food</h3>
                          <p>Browse profiles, reviews, and proposals then interview top candidates. </p>
                       </div>
                       <div class="how-to">
                          <span class="how-icon"><i class="la la-map-marker"></i></span>
                          <h3>Get Delivered</h3>
                          <p>Use the Upwork platform to chat, share files, and collaborate from your desktop or on the go.</p>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
    </section>

    <section>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Our Parteners</h2>
                            <span>Some of the companies to whome we trust and belive.</span>
                        </div><!-- Heading -->
                        <div class="top-company-sec">
                            <div class="row" id="companies-carousel">
                                <div class="col-lg-3">
                                    <div class="top-compnay">
                                        <img src="images/resource/tc1.jpg" alt="" />
                                        <h3><a href="#" title="">Symtech</a></h3>
                                        <span>United States, Los Angeles</span>
                                    </div><!-- Top Company -->
                                </div>
                                <div class="col-lg-3">
                                    <div class="top-compnay">
                                        <img src="images/resource/tc2.jpg" alt="" />
                                        <h3><a href="#" title="">Symtech</a></h3>
                                        <span>United States, Los Angeles</span>
                                    </div><!-- Top Company -->
                                </div>
                                <div class="col-lg-3">
                                    <div class="top-compnay">
                                        <img src="images/resource/tc3.jpg" alt="" />
                                        <h3><a href="#" title="">Symtech</a></h3>
                                        <span>United States, Los Angeles</span>
                                    </div><!-- Top Company -->
                                </div>
                                <div class="col-lg-3">
                                    <div class="top-compnay">
                                        <img src="images/resource/tc4.jpg" alt="" />
                                        <h3><a href="#" title="">Symtech</a></h3>
                                        <span>United States, Los Angeles</span>
                                    </div><!-- Top Company -->
                                </div>
                                <div class="col-lg-3">
                                    <div class="top-compnay">
                                        <img src="images/resource/tc2.jpg" alt="" />
                                        <h3><a href="#" title="">Symtech</a></h3>
                                        <span>United States, Los Angeles</span>
                                    </div><!-- Top Company -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </section>

    <section>
        <div class="block gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading">
                            <h2>Kind Words From Happy Candidates</h2>
                            <span>What other people thought about the service provided by JobHunt</span>
                        </div><!-- Heading -->
                        <div class="reviews-sec" id="reviews">
                            <div class="col-lg-12">
                                <div class="reviews style2">
                                    <img src="images/resource/r1.jpg" alt="" />
                                    <h3>Augusta Silva <span>Web designer</span></h3>
                                    <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service level that they offer!</p>
                                </div><!-- Reviews -->
                            </div>
                            <div class="col-lg-12">
                                <div class="reviews style2">
                                    <img src="images/resource/r2.jpg" alt="" />
                                    <h3>Ali Tufan <span>Web designer</span></h3>
                                    <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service level that they offer!</p>
                                </div><!-- Reviews -->
                            </div>
                            <div class="col-lg-12">
                                <div class="reviews style2">
                                    <img src="images/resource/r1.jpg" alt="" />
                                    <h3>Augusta Silva <span>Web designer</span></h3>
                                    <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service level that they offer!</p>
                                </div><!-- Reviews -->
                            </div>
                            <div class="col-lg-12">
                                <div class="reviews style2">
                                    <img src="images/resource/r2.jpg" alt="" />
                                    <h3>Ali Tufan <span>Web designer</span></h3>
                                    <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service level that they offer!</p>
                                </div><!-- Reviews -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </section>

    <section class="display-image">
        <div class="img-background">
            <img src="images/resource/footer-img.jpg" style="width: 100%;" class="img-responsive">
        </div>  
    </section>

    <footer class="gray">
            <div class="bottom-line style2">
               <span>© 2018 Foodoor.in All rights reserved. Design by Solicitous</span>
               <a href="#scrollup" class="scrollup" title=""><i class="la la-arrow-up"></i></a>
            </div>
    </footer>

</div>

<div class="account-popup-area signin-popup-box">
    <div class="account-popup">
        <span class="close-popup"><i class="la la-close"></i></span>
        <h3>User Login</h3>
        <span>Click To Login With Demo User</span>
        <div class="select-user">
            <span>Candidate</span>
            <span>Employer</span>
        </div>
        <form>
            <div class="cfield">
                <input type="text" placeholder="Username" />
                <i class="la la-user"></i>
            </div>
            <div class="cfield">
                <input type="password" placeholder="********" />
                <i class="la la-key"></i>
            </div>
            <p class="remember-label">
                <input type="checkbox" name="cb" id="cb1"><label for="cb1">Remember me</label>
            </p>
            <a href="#" title="">Forgot Password?</a>
            <button type="submit">Login</button>
        </form>
        <div class="extra-login">
            <span>Or</span>
            <div class="login-social">
                <a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
                <a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
            </div>
        </div>
    </div>
</div><!-- LOGIN POPUP -->

<div class="account-popup-area signup-popup-box">
    <div class="account-popup">
        <span class="close-popup"><i class="la la-close"></i></span>
        <h3>Sign Up</h3>
        <div class="select-user">
            <span>Candidate</span>
            <span>Employer</span>
        </div>
        <form>
            <div class="cfield">
                <input type="text" placeholder="Username" />
                <i class="la la-user"></i>
            </div>
            <div class="cfield">
                <input type="password" placeholder="********" />
                <i class="la la-key"></i>
            </div>
            <div class="cfield">
                <input type="text" placeholder="Email" />
                <i class="la la-envelope-o"></i>
            </div>
            <div class="dropdown-field">
                <select data-placeholder="Please Select Specialism" class="chosen">
                    <option>Web Development</option>
                    <option>Web Designing</option>
                    <option>Art & Culture</option>
                    <option>Reading & Writing</option>
                </select>
            </div>
            <div class="cfield">
                <input type="text" placeholder="Phone Number" />
                <i class="la la-phone"></i>
            </div>
            <button type="submit">Signup</button>
        </form>
        <div class="extra-login">
            <span>Or</span>
            <div class="login-social">
                <a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
                <a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
            </div>
        </div>
    </div>
</div><!-- SIGNUP POPUP -->

<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/modernizr.js" type="text/javascript"></script>
<script src="/js/script.js" type="text/javascript"></script>
<script src="/js/wow.min.js" type="text/javascript"></script>
<script src="/js/slick.min.js" type="text/javascript"></script>
<script src="/js/parallax.js" type="text/javascript"></script>
<script src="/js/select-chosen.js" type="text/javascript"></script>
<script src="/js/counter.js" type="text/javascript"></script>

</body>
</html>

