<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                <span class="hamburger-box">
                <span class="hamburger-inner"></span>
                </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
            <span class="hamburger-box">
            <span class="hamburger-inner"></span>
            </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
        <span class="btn-icon-wrapper">
        <i class="fa fa-ellipsis-v fa-w-6"></i>
        </span>
        </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="{{ Request::is('admin/cate_product*','admin/product*') ? 'mm-active' : '' }}"><a href="#">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Quản lý Phim
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.cate_product.home') }}" class="{{ Request::is('admin/cate_product*') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>Danh mục
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.product.index') }}" class="{{ Request::is('admin/product') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>Tất cả phim
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.product.chua_xong') }}" class="{{ Request::is('admin/product/chua-xong') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>Đang update
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.product.full') }}" class="{{ Request::is('admin/product/full') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>Đã full
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.product.comingsoon') }}" class="{{ Request::is('admin/product/comingsoon') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>Comingson
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('admin/cate_post*','admin/post*') ? 'mm-active' : '' }}"><a href="#">
                    <i class="metismenu-icon pe-7s-news-paper"></i>
                    Quản lý bài viết
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.cate_post.home') }}" class="{{ Request::is('admin/cate_post*') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>Danh mục
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.post.index') }}" class="{{ Request::is('admin/post*') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>Bài viết
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('admin/slide*') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.slide.index') }}">
                    <i class="metismenu-icon pe-7s-photo"></i>Quản lý ảnh+Slide</a>
                </li>
                <li class="{{ Request::is('admin/intro*') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.intro.index') }}">
                    <i class="metismenu-icon pe-7s-id"></i>Quản lý giới thiệu</a>
                </li>
                <li class="{{ Request::is('admin/contact*') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.contact.index') }}">
                    <i class="metismenu-icon pe-7s-mail-open"></i>Quản lý liên hệ</a>
                </li>
                <li class="{{ Request::is('admin/administrator*') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.administrator.home') }}">
                    <i class="metismenu-icon pe-7s-users"></i>Quản lý tài khoản</a>
                </li>
                <li class="{{ Request::is('admin/logs*') ? 'mm-active' : '' }}">
                    <a href="{{ route('log-view') }}" target="_blank">
                    <i class="metismenu-icon pe-7s-cart"></i>Xem log</a>
                </li>
                <li class="{{ Request::is('admin/setting*') ? 'mm-active' : '' }}">
                    <a href="{{ route('admin.setting') }}">
                    <i class="metismenu-icon pe-7s-config"></i>Cấu hình web</a>
                </li>
            </ul>
        </div>
    </div>
</div>