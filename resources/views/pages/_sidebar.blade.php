<div class="sidebar clearfix m-b-20 ">
                            <div class="main-block" id="profile-block" style="min-height: 600px;">
                               <div class="sidebar-title white-txt">
                                  <h6>Foodoor Help</h6>
                                  <i class="fa fa-user pull-right"></i> 
                               </div>
                               <ul>
                                   <li class="{{ request()->is('about-us') ? 'active' : ''  }}"><a href="/about-us" class="scroll">About</a></li>

                                    <li class="{{ request()->is('contact') ? 'active' : ''  }}"><a href="/contact" class="scroll">Contact Us</a></li>
                                   
                                   <li class="{{ request()->is('team') ? 'active' : ''  }}"><a href="/team" class="scroll">Our Team</a></li>

                                   <li class="{{ request()->is('careers') ? 'active' : ''  }}"><a href="/careers" class="scroll">Careers</a></li>

                                   <li class="{{ request()->is('terms') ? 'active' : ''  }}"><a href="/terms" class="scroll">Terms &amp; Conditions</a></li>

                                   <li class="{{ request()->is('privacy-policy') ? 'active' : ''  }}"><a href="/privacy-policy" class="scroll">Privacy Policy</a></li>

                                   

                                  
                               </ul>
                               <div class="clearfix"></div>
                            </div>
                            
                         </div>