<footer class="footer {{ request()->is('/') ? '' : 'hidden-sm-down' }}" style="background: #000 !important;padding: 60px 0;">
            <div class="container">
                <!-- top footer statrs -->
                <div class="row top-footer">
                    
                    <div class="col-xs-12 col-sm-3 about color-gray">
                        <h5>Company</h5>
                        <ul>
                            <li><a target="_blank"  href="/about-us">About us</a> </li>
                            <li><a target="_blank"  href="/about-us">Contact Us</a> </li>
                            <li><a target="_blank"  href="/team">Team</a> </li>
                            <li><a target="_blank"  href="/careers">Careers</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-3 how-it-works-links color-gray">
                        <h5>Legals</h5>
                        <ul>
                            <li><a target="_blank"  href="/terms">Terms &amp; Conditions</a> </li>
                            <li><a target="_blank"  href="/privacy-policy">Privacy Policy</a> </li>

                        </ul>
                    </div>
                   
                    <div class="col-xs-12 col-sm-3 popular-locations color-gray" >
                     <h5>Serving locations</h5>
                        <ul>
                            <li><a target="_blank"  href="/restaurants/explore?lat=23.3440997&lng=85.30956200000003">Ranchi</a> </li>
                        </ul>
                    </div>

                     <div class="col-xs-12 col-sm-3 popular-locations color-gray" >
                        <a href="#bulkOrderModal" data-toggle="modal">
                            <img src="/images/bulk.png" alt="foodoor bulk order" style="width: 120px;margin-bottom: 20px;">
                        </a>
    
                        
                    </div>

                    
                </div>
                <!-- top footer ends -->
                <!-- bottom footer statrs -->
                <div class="bottom-footer" style="border-top:  1px solid #fff; padding-top: 20px;">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 payment-options color-gray hidden-sm-down">
                            <a href="#"> <img src="/images/logofooter.png" alt="foodoor white logo" style="width: 180px;"> </a>  
                        </div>
                        <div class="col-xs-12 col-sm-4 address color-gray" style="text-align: center;">
                            <h4 style="color: #fff;margin-top: 7px;">&copy; {{ date('Y') }} Foodoor</h4>
                        </div>    
                        <div class="col-xs-12 col-sm-4 additional-info color-white" style="text-align: center;">
                           <h4 style="color: #fff;font-weight: bold;"> 
                            <a class="text-white" target="_blank" href="https://www.facebook.com/Ranchifoodoor/"><i style="margin: 10px;" class="fa fa-facebook"></i></a>
                            <a class="text-white"  target="_blank" href="https://www.instagram.com/foodoor.in"><i style="margin: 10px;" class="fa fa-instagram"></i></a>
                            <a class="text-white"  target="_blank" href="https://www.instagram.com/foodoor.in"><i style="margin: 10px;" class="fa fa-rss"></i></a>
                            
                           </h4> 
                        </div>
                    </div>
                </div>
                <!-- bottom footer ends -->
            </div>
        </footer>