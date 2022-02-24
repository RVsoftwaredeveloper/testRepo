<div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Practice </div>
        <div class="list-group list-group-flush">
           <a href="/home" class="list-group-item list-group-item-action bg-light {{ request()->routeIs('home*') ? 'active' : '' }}">Dashboard</a>
            <a href="/ajax-book-crud" class="list-group-item list-group-item-action bg-light {{ request()->routeIs('ajax-book-crud*') ? 'active' : '' }}">Books</a>
            <a href="/products" class="list-group-item list-group-item-action bg-light {{ request()->routeIs('products*') ? 'active' : '' }}">Products</a>
          <a href="/register" class="list-group-item list-group-item-action bg-light {{ request()->routeIs('register*') ? 'active' : '' }}">User</a>
            <!-- <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Status</a> -->
        </div>
        </div>
        <script>
            function activeMenu($uri = '') {
    $active = '';
    if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
        $active = 'active';
    }
    return $active;
}
</script>
