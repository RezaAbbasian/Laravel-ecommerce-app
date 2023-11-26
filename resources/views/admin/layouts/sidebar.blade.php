<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">بیبی شیک شاپ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">مدیر کل سایت</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.products.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            <i class="right fas fa-angle-left"></i>
                            محصولات
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.products.index')}}" class="nav-link">
                                <i class="fas fa-file-circle-plus nav-icon"></i>
                                <p>مشاهده تمام محصولات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.products.create')}}" class="nav-link">
                                <i class="fa-solid fa-file-circle-plus nav-icon"></i>
                                <p>افزودن محصول</p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('admin.products.index')}}" class="nav-link">--}}
{{--                                <i class="fas fa-circle nav-icon"></i>--}}
{{--                                <p>لیست ویژگی</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            <i class="right fas fa-angle-left"></i>
                            دسته بندی
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.categories.index')}}" class="nav-link">
                                <i class="far fa-folder-plus nav-icon"></i>
                                <p>مشاهده دسته بندی ها</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.categories.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>افزودن دسته بندی جدید</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-tags"></i>
                        <p>
                            <i class="right fas fa-angle-left"></i>
                            تگ
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.tags.index')}}" class="nav-link">
                                <i class="fa-solid fa-tag nav-icon"></i>
                                <p>مشاهده تگ ها</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.tags.create')}}" class="nav-link">
                                <i class="fa-solid fa-tag nav-icon"></i>
                                <p>افزودن تگ</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            <i class="right fas fa-angle-left"></i>
                            برندها
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.brands.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>لیست برندها</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.brands.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>افزودن برند جدید</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            <i class="right fas fa-angle-left"></i>
                            سفارشات
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.orders.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>لیست کل سفارشات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.orders.index').'/?search=Processing'}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>سفارشات پرداخت شده</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.orders.index').'/?search=Pending Payment'}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>سفارشات پرداخت نشده</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.orders.index').'/?search=Completed'}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>سفارشات ارسال شده</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.orders.index').'/?search=Failed'}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>سفارشات لغو شده</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.orders.index').'/?search=2'}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>سفارشات 3 روزه</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.orders.index').'/?search=3'}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>سفارشات 15 روزه</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.ordersexport')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>دانلود فایل سفارشات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.ordersimportfile')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ورود اطلاعات پستی</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            <i class="right fas fa-angle-left"></i>
                            پرداخت ها
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.payments.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>لیست پرداخت ها</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>
                            <i class="right fas fa-angle-left"></i>
                            مشتریان
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.users.index')}}" class="nav-link">
                                <i class="fa-solid fa-users nav-icon"></i>
                                <p>لیست  مشتریان</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.users.create')}}" class="nav-link">
                                <i class="fa-solid fa-user-plus nav-icon"></i>
                                <p>افزودن مشتری جدید</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            <i class="right fas fa-angle-left"></i>
                            کد تخفیف
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.coupons.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>لیست کدهای تخفیف</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.coupons.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>افزودن کد تخفیف جدید</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            <i class="right fas fa-angle-left"></i>
                            حمل و نقل
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.shipping.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>حمل و نقل ها</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.shipping.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ایجاد حمل و نقل جدید</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            <i class="right fas fa-angle-left"></i>
                            نوتیفیکیشن
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>لیست نوتیفیکیشن ها</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ارسال نوتیفیکیشن</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            <i class="right fas fa-angle-left"></i>
                            باشگاه مشتریان
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>مدیریت جوایز</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>افزودن جایزه</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
