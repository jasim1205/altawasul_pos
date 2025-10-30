<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Vendor CSS Files -->
  <link href="{{ asset('public/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('public/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

  <!-- Template Main CSS File -->
  <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <style>
    header{
      background-color: #3a58b3 !important;
    }
    .color-logo{
      color: white !important;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between text-white">
      <a href="index.html" class="logo d-flex align-items-center text-white">
        <img src="{{ asset('public/assets/img/logo.png') }}" alt="" class="color-logo">
        <span class="d-none d-lg-block text-white">Al-TAWASUL</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2 text-white">K. Anderson</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li> -->
            <li>
              <hr class="dropdown-divider">
            </li>

           

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          {{-- <li>
            <a href="{{ route('company.index') }}">
              <i class="bi bi-circle"></i><span>Company</span>
            </a>
          </li>
          <li>
            <a href="{{ route('category.index') }}">
              <i class="bi bi-circle"></i><span>Category</span>
            </a>
          </li> --}}
          <li>
            <a href="{{ route('product.create') }}">
              <i class="bi bi-circle"></i><span>Create Product</span>
            </a>
          </li>
          <li>
            <a href="{{ route('product.index') }}">
              <i class="bi bi-circle"></i><span>Product List</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('supplier.index') }}">
          <i class="bi bi-person"></i><span>Suppliers</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('customer.index') }}">
          <i class="bi bi-person"></i><span>Customers</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('purchase.index') }}">
          <i class="bi bi-menu-button-wide"></i><span>Purchases</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('creditpurchase.index') }}">
          <i class="bi bi-menu-button-wide"></i><span>Credit Purchases</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('usedpurchase.index') }}">
          <i class="bi bi-menu-button-wide"></i><span>Used Purchases</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('bngpurchase.index') }}">
          <i class="bi bi-menu-button-wide"></i><span>BNG Purchases</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('stock.index') }}">
          <i class="bi bi-menu-button-wide"></i><span>Stock</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('sale.index') }}">
          <i class="bi bi-menu-button-wide"></i><span>Sales</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('dailyexpense.index') }}">
          <i class="bi bi-menu-button-wide"></i><span>Daily Expenses</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('homeexpense.index') }}">
          <i class="bi bi-menu-button-wide"></i><span>Home Expenses</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
       
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Report</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('yearly_purchase') }}">
              <i class="bi bi-circle"></i><span>Yearly Purchase Report</span>
            </a>
          </li>
          <li>
            <a href="{{ route('yearly_sale') }}">
              <i class="bi bi-circle"></i><span>Yearly Sale Report</span>
            </a>
          </li>
          <li>
            <a href="{{ route('yearly_expense') }}">
              <i class="bi bi-circle"></i><span>Yearly Expense Report</span>
            </a>
          </li>
          <li>
            <a href="{{ route('yearly_report') }}">
              <i class="bi bi-circle"></i><span>Yearly Report</span>
            </a>
          </li>
          <li>
            <a href="{{ route('supplier_report') }}">
              <i class="bi bi-circle"></i><span>Supplier Report</span>
            </a>
          </li>
          <li>
            <a href="{{ route('customer_report') }}">
              <i class="bi bi-circle"></i><span>Customer Report</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Tables Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>@yield('title')</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">@yield('page-title')</a></li>
          <li class="breadcrumb-item active">@yield('page-subtitle')</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
      {{-- <div class="page-wrapper">
          <div class="page-content">
              
          </div>
      </div> --}}
      <section class="section dashboard">
        @yield('content')
      </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      {{-- <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div> --}}
    </footer><!-- End Footer -->
  
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
    <!-- Vendor JS Files -->
    <script src="{{ asset('public/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendor/php-email-form/validate.js') }}"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
  
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <!-- Template Main JS File -->
    <script src="{{ asset('public/assets/js/main.js') }}"></script>
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
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
       
    @stack('scripts')
     <script>
        function printDiv(divName) {
            var prtContent = document.getElementById(divName);
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write('<link rel="stylesheet" href="{{ asset('public/syndron/assets/css/app.css') }}" type="text/css"/>');
            WinPrint.document.write('<link href="{{ asset('public/syndron/assets/css/bootstrap.min.css') }}" rel="stylesheet">');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.onload =function(){
                WinPrint.focus();
                WinPrint.print();
                WinPrint.close();
            }
        };
    </script>

    <!--app JS-->
    {{-- <script src="{{ asset('public/syndron/assets/js/app.js') }}"></script> --}}
  </body>
  
  </html>
