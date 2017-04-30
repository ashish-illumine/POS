<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" ng-class="{'page-sidebar-menu-closed': settings.layout.pageSidebarClosed}">
        <li class="nav-item">
            <a href="{{url('/')}}/#/dashboard" class="nav-link nav-toggle">
                <i class="fa fa-home" aria-hidden="true"></i>
                <span class="title">Dashboard</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-tags" aria-hidden="true"></i>
                <span class="title">Products</span>
                <span class="selected"></span>
                <span class="arrow open"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="{{url('/')}}/#/category" class="nav-link ">
                        <span class="title">Category</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="{{url('/')}}/#/product" class="nav-link ">
                        <span class="title">Products</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link ">
                        <span class="title">Collections</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link ">
                        <span class="title">Inventory</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="#" class="nav-link ">
                        <span class="title">Transfer</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span class="title">Customers</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-bar-chart" aria-hidden="true"></i>
                <span class="title">Reports</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-gift" aria-hidden="true"></i>
                <span class="title">Discounts</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-cogs" aria-hidden="true"></i>
                <span class="title">Settings</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  ">
                    <a href="page_system_500_1.html" class="nav-link ">
                        <span class="title">General</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="page_system_500_2.html" class="nav-link " target="_blank">
                        <span class="title">Payments</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="page_system_500_2.html" class="nav-link " target="_blank">
                        <span class="title">Taxes</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="page_system_500_2.html" class="nav-link " target="_blank">
                        <span class="title">Outlets</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="page_system_500_2.html" class="nav-link " target="_blank">
                        <span class="title">Employees</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="page_system_500_2.html" class="nav-link " target="_blank">
                        <span class="title">Notifications</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>
