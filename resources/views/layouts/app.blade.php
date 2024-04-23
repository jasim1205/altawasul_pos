<!doctype html>
<html lang="en">
<!-- Mirrored from codervent.com/syndron/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jul 2023 03:54:59 GMT -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('public/syndron/assets/images/favicon-32x32.png') }}" type="image/png"/>
	<!--plugins-->
	<link href="{{ asset('public/syndron/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet"/>
	<link href="{{ asset('public/syndron/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/syndron/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('public/syndron/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('public/syndron/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('public/syndron/assets/css/pace.min.css') }}" rel="stylesheet"/>
	<script src="{{ asset('public/syndron/assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('public/syndron/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('public/syndron/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="{{ asset('public/syndron/assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('public/syndron/assets/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('public/syndron/assets/css/dark-theme.css') }}"/>
	<link rel="stylesheet" href="{{ asset('public/syndron/assets/css/semi-dark.css') }}"/>
	<link rel="stylesheet" href="{{ asset('public/syndron/assets/css/header-colors.css') }}"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
	<title>Syndron - Bootstrap 5 Admin Dashboard Template</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
      <!--sidebar wrapper -->
      <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
          <div>
            {{-- <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon"> --}}
          </div>
          <div>
            <h4 class="logo-text">Al-Tawasul</h4>
          </div>
          <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
          </div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
          <li>
            <a href="{{ route('dashboard') }}" class="has-arrow">
              <div class="parent-icon"><i class='bx bx-home-alt'></i>
              </div>
              <div class="menu-title">Dashboard</div>
            </a>
            <ul>
              {{-- <li> <a href="index.html"><i class='bx bx-radio-circle'></i>eCommerce</a>
              </li>
              <li> <a href="index2.html"><i class='bx bx-radio-circle'></i>Analytics</a>
              </li> --}}
            </ul>
          </li>
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="bx bx-category"></i>
              </div>
              <div class="menu-title">Application</div>
            </a>
            <ul>
              <li> <a href="{{ route('company.index') }}"><i class='bx bx-radio-circle'></i>Company List</a>
              </li>
              <li> <a href="{{ route('category.index') }}"><i class='bx bx-radio-circle'></i>Category List</a>
              </li>
              <li> <a href="{{ route('product.index') }}"><i class='bx bx-radio-circle'></i>Product List</a>
              </li>
            </ul>
          <li>
            <a href="{{ route('purchase.index') }}" class="has-arrow">
              <div class="parent-icon"><i class="bx bx-category"></i>
              </div>
              <div class="menu-title">Purchase</div>
            </a>
          </li>
          <li>
            <a href="{{ route('stock.index') }}" class="has-arrow">
              <div class="parent-icon"><i class="bx bx-category"></i>
              </div>
              <div class="menu-title">Stock</div>
            </a>
          </li>
          {{-- <li class="menu-label">UI Elements</li>
          <li>
            <a href="widgets.html">
              <div class="parent-icon"><i class='bx bx-cookie'></i>
              </div>
              <div class="menu-title">Widgets</div>
            </a>
          </li>
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class='bx bx-cart'></i>
              </div>
              <div class="menu-title">eCommerce</div>
            </a>
            <ul>
              <li> <a href="ecommerce-products.html"><i class='bx bx-radio-circle'></i>Products</a>
              </li>
              <li> <a href="ecommerce-products-details.html"><i class='bx bx-radio-circle'></i>Product Details</a>
              </li>
              <li> <a href="ecommerce-add-new-products.html"><i class='bx bx-radio-circle'></i>Add New Products</a>
              </li>
              <li> <a href="ecommerce-orders.html"><i class='bx bx-radio-circle'></i>Orders</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
              </div>
              <div class="menu-title">Components</div>
            </a>
            <ul>
              <li> <a href="component-alerts.html"><i class='bx bx-radio-circle'></i>Alerts</a>
              </li>
              <li> <a href="component-accordions.html"><i class='bx bx-radio-circle'></i>Accordions</a>
              </li>
              <li> <a href="component-badges.html"><i class='bx bx-radio-circle'></i>Badges</a>
              </li>
              <li> <a href="component-buttons.html"><i class='bx bx-radio-circle'></i>Buttons</a>
              </li>
              <li> <a href="component-cards.html"><i class='bx bx-radio-circle'></i>Cards</a>
              </li>
              <li> <a href="component-carousels.html"><i class='bx bx-radio-circle'></i>Carousels</a>
              </li>
              <li> <a href="component-list-groups.html"><i class='bx bx-radio-circle'></i>List Groups</a>
              </li>
              <li> <a href="component-media-object.html"><i class='bx bx-radio-circle'></i>Media Objects</a>
              </li>
              <li> <a href="component-modals.html"><i class='bx bx-radio-circle'></i>Modals</a>
              </li>
              <li> <a href="component-navs-tabs.html"><i class='bx bx-radio-circle'></i>Navs & Tabs</a>
              </li>
              <li> <a href="component-navbar.html"><i class='bx bx-radio-circle'></i>Navbar</a>
              </li>
              <li> <a href="component-paginations.html"><i class='bx bx-radio-circle'></i>Pagination</a>
              </li>
              <li> <a href="component-popovers-tooltips.html"><i class='bx bx-radio-circle'></i>Popovers & Tooltips</a>
              </li>
              <li> <a href="component-progress-bars.html"><i class='bx bx-radio-circle'></i>Progress</a>
              </li>
              <li> <a href="component-spinners.html"><i class='bx bx-radio-circle'></i>Spinners</a>
              </li>
              <li> <a href="component-notifications.html"><i class='bx bx-radio-circle'></i>Notifications</a>
              </li>
              <li> <a href="component-avtars-chips.html"><i class='bx bx-radio-circle'></i>Avatrs & Chips</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class="bx bx-repeat"></i>
              </div>
              <div class="menu-title">Content</div>
            </a>
            <ul>
              <li> <a href="content-grid-system.html"><i class='bx bx-radio-circle'></i>Grid System</a>
              </li>
              <li> <a href="content-typography.html"><i class='bx bx-radio-circle'></i>Typography</a>
              </li>
              <li> <a href="content-text-utilities.html"><i class='bx bx-radio-circle'></i>Text Utilities</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
              </div>
              <div class="menu-title">Icons</div>
            </a>
            <ul>
              <li> <a href="icons-line-icons.html"><i class='bx bx-radio-circle'></i>Line Icons</a>
              </li>
              <li> <a href="icons-boxicons.html"><i class='bx bx-radio-circle'></i>Boxicons</a>
              </li>
              <li> <a href="icons-feather-icons.html"><i class='bx bx-radio-circle'></i>Feather Icons</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="form-froala-editor.html">
              <div class="parent-icon"><i class='bx bx-code-alt'></i>
              </div>
              <div class="menu-title">Froala Editor</div>
            </a>
          </li>
          <li class="menu-label">Forms & Tables</li>
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class='bx bx-message-square-edit'></i>
              </div>
              <div class="menu-title">Forms</div>
            </a>
            <ul>
              <li> <a href="form-elements.html"><i class='bx bx-radio-circle'></i>Form Elements</a>
              </li>
              <li> <a href="form-input-group.html"><i class='bx bx-radio-circle'></i>Input Groups</a>
              </li>
              <li> <a href="form-radios-and-checkboxes.html"><i class='bx bx-radio-circle'></i>Radios & Checkboxes</a>
              </li>
              <li> <a href="form-layouts.html"><i class='bx bx-radio-circle'></i>Forms Layouts</a>
              </li>
              <li> <a href="form-validations.html"><i class='bx bx-radio-circle'></i>Form Validation</a>
              </li>
              <li> <a href="form-wizard.html"><i class='bx bx-radio-circle'></i>Form Wizard</a>
              </li>
              <li> <a href="form-text-editor.html"><i class='bx bx-radio-circle'></i>Text Editor</a>
              </li>
              <li> <a href="form-file-upload.html"><i class='bx bx-radio-circle'></i>File Upload</a>
              </li>
              <li> <a href="form-date-time-pickes.html"><i class='bx bx-radio-circle'></i>Date Pickers</a>
              </li>
              <li> <a href="form-select2.html"><i class='bx bx-radio-circle'></i>Select2</a>
              </li>
              <li> <a href="form-repeater.html"><i class='bx bx-radio-circle'></i>Form Repeater</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class="bx bx-grid-alt"></i>
              </div>
              <div class="menu-title">Tables</div>
            </a>
            <ul>
              <li> <a href="table-basic-table.html"><i class='bx bx-radio-circle'></i>Basic Table</a>
              </li>
              <li> <a href="table-datatable.html"><i class='bx bx-radio-circle'></i>Data Table</a>
              </li>
            </ul>
          </li>
          <li class="menu-label">Pages</li>
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class="bx bx-lock"></i>
              </div>
              <div class="menu-title">Authentication</div>
            </a>
            <ul>
              <li><a class="has-arrow" href="javascript:;"><i class='bx bx-radio-circle'></i>Basic</a>
                <ul>
                  <li><a href="auth-basic-signin.html" target="_blank"><i class='bx bx-radio-circle'></i>Sign In</a></li>
                  <li><a href="auth-basic-signup.html" target="_blank"><i class='bx bx-radio-circle'></i>Sign Up</a></li>
                  <li><a href="auth-basic-forgot-password.html" target="_blank"><i class='bx bx-radio-circle'></i>Forgot Password</a></li>
                  <li><a href="auth-basic-reset-password.html" target="_blank"><i class='bx bx-radio-circle'></i>Reset Password</a></li>
                </ul>
              </li>
              <li><a class="has-arrow" href="javascript:;"><i class='bx bx-radio-circle'></i>Cover</a>
                <ul>
                  <li><a href="auth-cover-signin.html" target="_blank"><i class='bx bx-radio-circle'></i>Sign In</a></li>
                  <li><a href="auth-cover-signup.html" target="_blank"><i class='bx bx-radio-circle'></i>Sign Up</a></li>
                  <li><a href="auth-cover-forgot-password.html" target="_blank"><i class='bx bx-radio-circle'></i>Forgot Password</a></li>
                  <li><a href="auth-cover-reset-password.html" target="_blank"><i class='bx bx-radio-circle'></i>Reset Password</a></li>
                </ul>
              </li>
              <li><a class="has-arrow" href="javascript:;"><i class='bx bx-radio-circle'></i>With Header Footer</a>
                <ul>
                  <li><a href="auth-header-footer-signin.html" target="_blank"><i class='bx bx-radio-circle'></i>Sign In</a></li>
                  <li><a href="auth-header-footer-signup.html" target="_blank"><i class='bx bx-radio-circle'></i>Sign Up</a></li>
                  <li><a href="auth-header-footer-forgot-password.html" target="_blank"><i class='bx bx-radio-circle'></i>Forgot Password</a></li>
                  <li><a href="auth-header-footer-reset-password.html" target="_blank"><i class='bx bx-radio-circle'></i>Reset Password</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="user-profile.html">
              <div class="parent-icon"><i class="bx bx-user-circle"></i>
              </div>
              <div class="menu-title">User Profile</div>
            </a>
          </li>
          <li>
            <a href="timeline.html">
              <div class="parent-icon"> <i class="bx bx-video-recording"></i>
              </div>
              <div class="menu-title">Timeline</div>
            </a>
          </li>
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class="bx bx-error"></i>
              </div>
              <div class="menu-title">Errors</div>
            </a>
            <ul>
              <li> <a href="errors-404-error.html" target="_blank"><i class='bx bx-radio-circle'></i>404 Error</a>
              </li>
              <li> <a href="errors-500-error.html" target="_blank"><i class='bx bx-radio-circle'></i>500 Error</a>
              </li>
              <li> <a href="errors-coming-soon.html" target="_blank"><i class='bx bx-radio-circle'></i>Coming Soon</a>
              </li>
              <li> <a href="error-blank-page.html" target="_blank"><i class='bx bx-radio-circle'></i>Blank Page</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="faq.html">
              <div class="parent-icon"><i class="bx bx-help-circle"></i>
              </div>
              <div class="menu-title">FAQ</div>
            </a>
          </li>
          <li>
            <a href="pricing-table.html">
              <div class="parent-icon"><i class="bx bx-diamond"></i>
              </div>
              <div class="menu-title">Pricing</div>
            </a>
          </li>
          <li class="menu-label">Charts & Maps</li>
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class="bx bx-line-chart"></i>
              </div>
              <div class="menu-title">Charts</div>
            </a>
            <ul>
              <li> <a href="charts-apex-chart.html"><i class='bx bx-radio-circle'></i>Apex</a>
              </li>
              <li> <a href="charts-chartjs.html"><i class='bx bx-radio-circle'></i>Chartjs</a>
              </li>
              <li> <a href="charts-highcharts.html"><i class='bx bx-radio-circle'></i>Highcharts</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class="bx bx-map-alt"></i>
              </div>
              <div class="menu-title">Maps</div>
            </a>
            <ul>
              <li> <a href="map-google-maps.html"><i class='bx bx-radio-circle'></i>Google Maps</a>
              </li>
              <li> <a href="map-vector-maps.html"><i class='bx bx-radio-circle'></i>Vector Maps</a>
              </li>
            </ul>
          </li>
          <li class="menu-label">Others</li>
          <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class="bx bx-menu"></i>
              </div>
              <div class="menu-title">Menu Levels</div>
            </a>
            <ul>
              <li> <a class="has-arrow" href="javascript:;"><i class='bx bx-radio-circle'></i>Level One</a>
                <ul>
                  <li> <a class="has-arrow" href="javascript:;"><i class='bx bx-radio-circle'></i>Level Two</a>
                    <ul>
                      <li> <a href="javascript:;"><i class='bx bx-radio-circle'></i>Level Three</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:;">
              <div class="parent-icon"><i class="bx bx-folder"></i>
              </div>
              <div class="menu-title">Documentation</div>
            </a>
          </li>
          <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
              <div class="parent-icon"><i class="bx bx-support"></i>
              </div>
              <div class="menu-title">Support</div>
            </a>
          </li> --}}
        </ul>
        <!--end navigation-->
      </div>
      <!--end sidebar wrapper -->
      <!--start header -->
      <header>
        <div class="topbar d-flex align-items-center">
          <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
              <div class="top-menu ms-auto">
              <ul class="navbar-nav align-items-center gap-1">
                <li class="nav-item dropdown dropdown-app">
                  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" href="javascript:;">
                    <!-- <i class='bx bx-grid-alt'></i> -->
                  </a>
                  <div class="">
                    <div class="app-container p-2 my-2">
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown dropdown-large">
                  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown">
                    <!-- <i class='bx bx-bell'></i> -->
                  </a>
                  <div class="">
                    <div class="header-notifications-list">
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown dropdown-large">
                  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- <i class='bx bx-shopping-bag'></i> -->
                  </a>
                  <div class="dropdown-menu dropdown-menu-end">
                    <div class="header-message-list">
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="user-box dropdown px-3">
              <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{-- <img src="assets/images/avatars/avatar-2.png" class="user-img" alt="user avatar"> --}}
                <div class="user-info">
                  <p class="user-name mb-0">MD.Monir Hossain</p>
                  {{-- <p class="designattion mb-0">Web Designer</p> --}}
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                {{-- <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-cog fs-5"></i><span>Settings</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-home-circle fs-5"></i><span>Dashboard</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-dollar-circle fs-5"></i><span>Earnings</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="bx bx-download fs-5"></i><span>Downloads</span></a>
                </li>
                <li>
                  <div class="dropdown-divider mb-0"></div>
                </li> --}}
                <li><a class="dropdown-item d-flex align-items-center" href="{{ route('logOut') }}"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </header>
      <!--end header -->
      <!--start page wrapper -->
      <div class="page-wrapper">
          <div class="page-content">
              @yield('content')
          </div>
      </div>
      <!--end page wrapper -->
      <!--start overlay-->
      <div class="overlay toggle-icon"></div>
      <!--end overlay-->
      <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
      <!--End Back To Top Button-->
      <footer class="page-footer">
        <p class="mb-0">Copyright © 2023. All right reserved.</p>
      </footer>
    </div>
    <!--end wrapper-->


    <!-- Bootstrap JS -->
    <script src="{{ asset('public/syndron/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('public/syndron/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/syndron/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('public/syndron/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('public/syndron/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('public/syndron/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('public/syndron/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/syndron/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

    <script src="{{ asset('public/syndron/assets/js/index.js') }}"></script>
    <script>
      $(document).ready(function() {
        $('#example').DataTable();
        } );
    </script>
    <script>
      $(document).ready(function() {
        var table = $('#example2').DataTable( {
          lengthChange: false,
          buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
      
        table.buttons().container()
          .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
      } );
    </script>

    <!--app JS-->
    <script src="{{ asset('public/syndron/assets/js/app.js') }}"></script>
</body>
<!-- Mirrored from codervent.com/syndron/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jul 2023 03:55:08 GMT -->
</html>