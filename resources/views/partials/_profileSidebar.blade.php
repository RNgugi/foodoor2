<div class="sidebar clearfix m-b-20 ">
                            <div class="main-block" style="min-height: 600px;">
                               <div class="sidebar-title white-txt">
                                  <h6>Manage Account</h6>
                                  <i class="fa fa-user pull-right"></i> 
                               </div>
                               <ul>
                                   <li class="{{ request()->is('home') ? 'active' : ''  }}"><a href="/home" class="scroll">Profile</a></li>

                                    <li class="{{ request()->is('security') ? 'active' : ''  }}"><a href="/security" class="scroll">Security</a></li>

                                   <li class="{{ request()->is('orders') ? 'active' : ''  }}"><a href="/orders" class="scroll">Orders</a></li>

                                   <li class="{{ request()->is('payments') ? 'active' : ''  }}"><a href="/payments" class="scroll">Payments</a></li>

                                  
                               </ul>
                               <div class="clearfix"></div>
                            </div>
                            
                         </div>