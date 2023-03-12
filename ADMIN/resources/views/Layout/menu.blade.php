
<div id="main-wrapper">
  <header>
    <!-- Sidebar -->
    <nav
         id="sidebarMenu"
         class="collapse d-lg-block sidebar collapse bg-white"
         >
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a style="color: currentColor; border-radius: 14px;"
             href="{{'/'}}"
             class="list-group-item list-group-item-action py-2 ripple"
             aria-current="true"
             >
            <i class="fas fa-tachometer-alt fa-fw me-3"></i
              ><span>Dashboard</span>
          </a>

          <div class="accordion accordion-flush" id="article-menu">
            <div class="list-group-item list-group-item-action py-2 ripple" data-mdb-toggle="collapse" data-mdb-target="#article-submenu" aria-expanded="false" aria-controls="article-submenu" style="color: currentColor; border-radius: 14px;">
              <i class="fas fa-newspaper fa-fw me-3"></i>
              <span>Article</span>
              <i class="fas fa-caret-down ms-auto"></i>
            </div>
            <div id="article-submenu" class="collapse collapsible" aria-labelledby="article-menu">
              <a style="color: currentColor; border-radius: 14px;" href="{{'/articleform'}}" class="list-group-item list-group-item-action py-2">Article Form</a>
              <a style="color: currentColor; border-radius: 14px;" href="{{'/upload_article'}}" class="list-group-item list-group-item-action py-2">Article List</a>
            </div>
          </div>


          <div class="accordion accordion-flush" id="category-menu">
            <div class="list-group-item list-group-item-action py-2 ripple" data-mdb-toggle="collapse" data-mdb-target="#category-submenu" aria-expanded="false" aria-controls="category-submenu" style="color: currentColor; border-radius: 14px;">
              <i class="fas fa-folder fa-fw me-3"></i>
              <span>Category</span>
              <i class="fas fa-caret-down ms-auto"></i>
            </div>
            <div id="category-submenu" class="collapse collapsible" aria-labelledby="category-menu">
              <a style="color: currentColor; border-radius: 14px;" href="{{'/add_category'}}" class="list-group-item list-group-item-action py-2">Add Category</a>
              <a style="color: currentColor; border-radius: 14px;" href="{{'/add_sub_category'}}" class="list-group-item list-group-item-action py-2">Add Sub Category</a>
            </div>
          </div>

          <div class="accordion accordion-flush" id="user-menu">
            <div class="list-group-item list-group-item-action py-2 ripple" data-mdb-toggle="collapse" data-mdb-target="#user-submenu" aria-expanded="false" aria-controls="user-submenu" style="color: currentColor; border-radius: 14px;">
              <i class="fas fa-user fa-fw me-3"></i>
              <span>Users</span>
              <i class="fas fa-caret-down ms-auto"></i>
            </div>
            <div id="user-submenu" class="collapse collapsible" aria-labelledby="user-menu">
              <a style="color: currentColor; border-radius: 14px;" href="{{'/add_catego'}}" class="list-group-item list-group-item-action py-2">Create User</a>
              <a style="color: currentColor; border-radius: 14px;" href="{{'/add_sub_cate'}}" class="list-group-item list-group-item-action py-2">User List</a>
            </div>
          </div>

          <div class="accordion accordion-flush" id="add-menu">
            <div class="list-group-item list-group-item-action py-2 ripple" data-mdb-toggle="collapse" data-mdb-target="#add-submenu" aria-expanded="false" aria-controls="add-submenu" style="color: currentColor; border-radius: 14px;">
              <i class="fas fa-bars fa-fw me-3"></i>
              <span>Menu</span>
              <i class="fas fa-caret-down ms-auto"></i>
            </div>
            <div id="add-submenu" class="collapse collapsible" aria-labelledby="add-menu">
              <a style="color: currentColor; border-radius: 14px;" href="{{'/add_catego'}}" class="list-group-item list-group-item-action py-2">Add Menu</a>
              <a style="color: currentColor; border-radius: 14px;" href="{{'/add_sub_cate'}}" class="list-group-item list-group-item-action py-2">Menu List</a>
            </div>
          </div>

          
          <div class="accordion accordion-flush" id="add-tag">
            <div class="list-group-item list-group-item-action py-2 ripple" data-mdb-toggle="collapse" data-mdb-target="#add-submenu-tag" aria-expanded="false" aria-controls="add-submenu-tag" style="color: currentColor; border-radius: 14px;">
              <i class="fas fa-tag fa-fw me-3"></i>
              <span>Tag</span>
              <i class="fas fa-caret-down ms-auto"></i>
            </div>
            <div id="add-submenu-tag" class="collapse collapsible" aria-labelledby="add-tag">
              <a style="color: currentColor; border-radius: 14px;" href="{{'/add_catego'}}" class="list-group-item list-group-item-action py-2">Add Tag</a>
              <a style="color: currentColor; border-radius: 14px;" href="{{'/add_sub_cate'}}" class="list-group-item list-group-item-action py-2">Tag List</a>
            </div>
          </div>

          <a style="color: currentColor; border-radius: 14px;"
          href="{{'#'}}"
          class="list-group-item list-group-item-action py-2 ripple"
          aria-current="true"
          >
          <i class="fas fa-info-circle fa-fw me-3"></i>
         <span>Site info</span>
       </a>
          
        </div>
      </div>
    </nav>
    <!-- Sidebar -->
  
    <!-- Navbar -->
    <nav
         id="main-navbar"
         class="navbar navbar-expand-lg navbar-light bg-white fixed-top"
         >
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
          <i class="fas fa-bars"></i>
        </button>
  
        <!-- Brand -->
        <a class="navbar-brand" href="#">
         ADMIN
        </a>
        <!-- Search form -->
        <form class="d-none d-md-flex input-group w-auto my-auto">
          <input
                 autocomplete="off"
                 type="search"
                 class="form-control rounded"
                 placeholder='Search (ctrl + "/" to focus)'
                 style="min-width: 225px"
                 />
          <span class="input-group-text border-0"
                ><i class="fas fa-search"></i
            ></span>
        </form>
  
        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <li class="nav-item dropdown">
            <a
               class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
               href="#"
               id="navbarDropdownMenuLink"
               role="button"
               data-mdb-toggle="dropdown"
               aria-expanded="false"
               >
              <img
                   src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
                   class="rounded-circle"
                   height="22"
                   alt=""
                   loading="lazy"
                   />
            </a>
            <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdownMenuLink"
                >
              <li><a class="dropdown-item" href="#">My profile</a></li>
              <li><a class="dropdown-item" href="{{url('/logout')}}">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->
</div>
        
<div class="page-wrapper">