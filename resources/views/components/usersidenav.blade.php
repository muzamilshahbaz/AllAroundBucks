  <!-- Left Sidebar -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->






                                @yield('sideNavLinks')

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/settings" aria-expanded="false">

                                <span class="hide-menu">Settings</span>
                            </a>
                        </li>

                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="404.html" aria-expanded="false">

                                <span class="hide-menu">Help & Support</span>
                            </a>
                        </li> --}}

                        <li class="text-center p-20 upgrade-btn">
                            <a href="/logout" class="btn btn-block btn-danger text-white" style="background-color: tomato">
                                Sign Out</a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
