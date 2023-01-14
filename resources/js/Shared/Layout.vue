<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"
              ><i class="fas fa-bars"></i
            ></a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
          <img
            src="../../../public/AdminLTE/dist/img/AdminLTELogo.png"
            alt="Laundry App"
            class="brand-image img-circle elevation-3"
          />
          <span class="brand-text font-weight-light">Laundry App</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img
                alt="Avatar"
                class="table-avatar img-circle"
                src="../../../public/AdminLTE/dist/img/avatar5.png"
              />
            </div>
            <div class="info"></div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false"
            >
              <!-- Add icons to the links using the .nav-icon class
									with font-awesome or any other icon font library -->
              <li class="nav-item">
                <Link class="nav-link" href="/">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </Link>
              </li>

              <li class="nav-item">
                <Link class="nav-link" href="/about">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>About</p>
                </Link>
              </li>

              <li class="nav-item">
                <Link class="nav-link" href="/branch">
                  <i class="nav-icon fas fa-code-branch"></i>
                  <p>Branch</p>
                </Link>
              </li>

              <li class="nav-item">
                <Link class="nav-link" href="/order">
                  <i class="nav-icon fas fa-book"></i>
                  <p>Order</p>
                </Link>
              </li>

              <li class="nav-item">
                <Link class="nav-link" href="/employee">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Employee</p>
                </Link>
              </li>

              <li class="nav-item">
                <Link class="nav-link" href="/category">
                  <i class="nav-icon fas fa-tag"></i>
                  <p>Category</p>
                </Link>
              </li>

              <li class="nav-item">
                <Link class="nav-link" href="/logout">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>Logout</p>
                </Link>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <slot />
      </div>
      <!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
          Made with <i class="fa fa-heart" style="color: red"></i> by Mukramin
        </div>
        <!-- Default to the left -->
        <strong
          >Copyright &copy; 2014-2019
          <a href="https://adminlte.io">AdminLTE.io</a>.</strong
        >
        All rights reserved.
      </footer>
    </div>
  </body>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },
};
</script>

<style type="text/css">
.divider {
  width: 100%;
  height: 1px;
  background: #bbb;
  margin: 1rem 0;
}

a {
  color: inherit;
  text-decoration: none;
}

.clickable-row:hover {
  cursor: pointer;
}

</style>