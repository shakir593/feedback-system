<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('dashboard.index') }}" class="sidebar-logo">
            <img src="{{ asset('backend/assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="sidebar-menu-group-title">
                <a  href="{{ route('dashboard.index') }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="dropdown">
                    <a  href="javascript:void(0)">
                        <iconify-icon icon="hugeicons:invoice-03" class="menu-icon"></iconify-icon>
                        <span>Feedbacok Management</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                        <a href="{{ route('feedback-category.index') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Feedback Categories</a>
                        </li>
                        <li>
                        <a href="{{ route('feedback.index') }}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Feedback</a>
                        </li>
                    </ul>
                </li>

            </ul>
    </div>
</aside>