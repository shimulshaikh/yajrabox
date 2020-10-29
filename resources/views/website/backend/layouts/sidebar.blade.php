<!-- START LEFT ASIDE SECTION -->
            <aside class="main-sidebar">
                <!-- START SIDEBAR SECTION -->
                <section class="sidebar">
                    <!-- START SIDEBAR USER PANEL PART -->
                    <div class="user-panel">
                        <div style="font-weight: bold;"><img class="img-responsive searchIcon" src="{{asset('backend/dist/img/searchIcon.png')}}"><span>Menu</span></div>
                    </div><!-- SIDEBAR USER PANEL PART END -->




                    <!-- START SIDEBAR MENU PART -->
                    <ul class="sidebar-menu">
                        <li class="treeview">
                            <a href="#">
                                <img class="img-responsive searchIcon" src="{{asset('backend/dist/img/searchIcon.png')}}">
                                <span class="aside-main-menu">Products</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-caret-down pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('productCategory.index')}}"><img class="img-responsive bulletIcon" src="{{asset('backend/dist/img/bulletIcon.png')}}">Product Category</a></li>
                                <li><a href="{{route('product.index')}}"><img class="img-responsive bulletIcon" src="{{asset('backend/dist/img/bulletIcon.png')}}">Product</a></li>
                                <li><a href="{{route('productImage.index')}}"><img class="img-responsive bulletIcon" src="{{asset('backend/dist/img/bulletIcon.png')}}">Product Image</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <img class="img-responsive searchIcon" src="{{asset('backend/dist/img/searchIcon.png')}}">
                                <span class="aside-main-menu">Customers</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-caret-down pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{route('customer.index')}}"><img class="img-responsive bulletIcon" src="{{asset('backend/dist/img/bulletIcon.png')}}">Customer</a></li>
                            </ul>
                        </li>

                    </ul><!-- SIDEBAR MENU PART END -->
                </section><!-- START SIDEBAR SECTION -->
            </aside><!-- LEFT ASIDE SECTION END -->