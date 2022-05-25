<!-- Navigation -->
<aside id="sidebar" class="sidebar d-flex flex-column flex-shrink-0 p-3 border-end border-primary mt-5">
    <ul class="nav nav-pills d-flex">
        <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="sidebar-expand">
                <i class="fa-solid fa-angles-left me-2 nav-link-icon"></i>
                <span class="nav-link-text">Collapse Menu</span>
            </a>
        </li>
    </ul>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">
                <i class="fa-solid fa-house me-2 nav-link-icon"></i>
                <span class="nav-link-text">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link {{ Request::routeIs('categories.index') ? 'active' : '' }}">
                <i class="fa-solid fa-newspaper me-2 nav-link-icon"></i>
                <span class="nav-link-text">All Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link">
                <i class="fa-solid fa-newspaper me-2 nav-link-icon"></i>
                <span class="nav-link-text">Trashed Categories</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('products.index') }}" class="nav-link {{ Request::routeIs('products.index') ? 'active' : '' }}">
                <i class="fa-solid fa-newspaper me-2 nav-link-icon"></i>
                <span class="nav-link-text">All Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('products.index') }}" class="nav-link">
                <i class="fa-solid fa-newspaper me-2 nav-link-icon"></i>
                <span class="nav-link-text">Trashed Products</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('priceType.index') }}" class="nav-link">
                <i class="fa-regular fa-calendar me-2 nav-link-icon"></i>
                <span class="nav-link-text">All Price Types</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-regular fa-calendar me-2 nav-link-icon"></i>
                <span class="nav-link-text">Trashed Price Types</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-regular fa-user me-2 nav-link-icon"></i>
                <span class="nav-link-text">All Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-gear me-2 nav-link-icon"></i>
                <span class="nav-link-text">Settings</span>
            </a>
        </li>
    </ul>
</aside>
