<div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item "> <a class="nav-link nav-toggler  hidden-md-up  waves-effect waves-dark" href="javascript:void(0)"><i class="fas  fa-bars"></i></a></li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="fas fa-bars"></i></a> </li> 
                     <li class="nav-item mt-3">ADMIN</li>
					</ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item"><a href="{{url('/logout')}}" class="btn btn-sm btn-danger">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider mt-0" style="margin-bottom: 5px"></li>
                        <li>
                            <a href="{{'/'}}">
                                <span><i class="fa fa-tachometer-alt"></i></span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{'/'}}">
                                <span><i class="fas fa-users"></i></span>
                                <span class="hide-menu">Visitor</span>
                            </a>
                        </li> --}}
                        <li>
                            <a href="#">
                                <span><i class="fas fa-file-upload"></i></span>
                                <span class="hide-menu">Upload Article</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{'/articleform'}}">
                                        <span><i class="fas fa-edit"></i></span>
                                        <span class="hide-menu">Article Form</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{'/upload_article'}}">
                                        <span><i class="fas fa-list"></i></span>
                                        <span class="hide-menu">Article List</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">
                                <span><i class="fas fa-sitemap"></i></span>
                                <span class="hide-menu">Category</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{'/add_category'}}">
                                        <span><i class="fas fa-clipboard-list"></i></span>
                                        <span class="hide-menu">Add Category</span>
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="{{'/add_sub_category'}}">
                                        <span><i class="fas fa-clipboard-list"></i></span>
                                        <span class="hide-menu">Add Sub Category</span>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        
<div class="page-wrapper">