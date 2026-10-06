<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('dashboard.index') }}" class="sidebar-logo">
            <img src="{{ asset('backend/assets/images/dashboard-logo.png') }}" alt="site logo" class="light-logo">
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
            <li class="dropdown {{ request()->routeIs('feedback.*', 'feedback-category.*') ? 'open' : '' }}">
                    <a  href="javascript:void(0)">
                        <iconify-icon icon="hugeicons:invoice-03" class="menu-icon"></iconify-icon>
                        <span>Feedbacok Management</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->routeIs('feedback-category.*') ? 'active-page' : '' }}">
                        <a href="{{ route('feedback-category.index') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Feedback Categories</a>
                        </li>
                        <li class="{{ request()->routeIs('feedback.*') ? 'active-page' : '' }}">
                        <a href="{{ route('feedback.index') }}"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Feedback</a>
                        </li>
                    </ul>
                </li>

            </ul>
    </div>
    <form action="{{ route('logout') }}" method="POST" class="sidebar-logout">
        @csrf
        <button type="submit">
            <iconify-icon icon="lucide:power" class="menu-icon"></iconify-icon>
            <span>Log Out</span>
        </button>
    </form>
</aside>

<style>
    .sidebar {
        display: flex;
        flex-direction: column;
    }

    .sidebar .sidebar-menu-area {
        height: auto;
        flex: 1 1 auto;
        min-height: 0;
    }

    .sidebar-logout {
        margin-top: auto;
        padding: 0.75rem 1rem 2.25rem;
        border-inline-end: 1px solid var(--neutral-200);
    }

    .sidebar-logout button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: 0;
        border-radius: 8px;
        background: var(--button-secondary);
        color: var(--brand);
        font-size: 0.875rem;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
    }

    .sidebar-logout button:hover {
        color: var(--brand);
    }

    .sidebar-logout .menu-icon {
        font-size: 1.125rem;
        margin-inline-end: 0.5rem;
        color: var(--brand);
    }

    .sidebar.active .sidebar-logout span {
        display: none;
    }

    .sidebar.active:hover .sidebar-logout span {
        display: inline;
    }
</style>