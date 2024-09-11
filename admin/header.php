<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="../assets/images/logo-dark.png" alt="" height="100">
            </span>
            <span class="logo-lg">
                <img src="../assets/images/logo-dark.png" alt="" height="100">
            </span>
        </a>
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="../assets/images/llogo-dark.png" alt="" height="100">
            </span>
            <span class="logo-lg mt-4" style="display: block;"> <!-- Added display: block; inline style -->
                <img src="../assets/images/logo-dark.png" alt="" height="100">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-apps">Menu</span></li>

                <li class="nav-item <?php if($currentPage === 'index.php') echo 'color active'; ?>">
                    <a href="index.php" class="nav-link menu-link"><i class="icon ri-home-3-fill"></i><span>Dashboard</span></a>
                </li>
                <!-- <li class="nav-item <?php if($currentPage === 'all_users.php') echo 'color active'; ?>">
                    <a href="all_users.php" class="nav-link menu-link"><i class="icon ri-home-3-fill"></i><span>All User Listing</span></a>
                </li> -->
                <li class="nav-item <?php if($currentPage === 'logout_page.php') echo 'active'; ?>">
                    <a href="logout_page.php" class="nav-link menu-link"><i class="ri-calendar-event-fill"></i><span>Logout</span></a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>