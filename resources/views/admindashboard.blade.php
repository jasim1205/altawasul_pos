@extends('layouts.app')
@section('title','Al Tawasul')
@section('content')
  <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Revenue</p>
              <h4 class="my-1">$4805</h4>
              <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>$34 Since last week</p>
            </div>
            <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-wallet'></i>
            </div>
          </div>
          <div id="chart1"></div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Total Customers</p>
              <h4 class="my-1">8.4K</h4>
              <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>14% Since last week</p>
            </div>
            <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bxs-group'></i>
            </div>
          </div>
          <div id="chart2"></div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Store Visitors</p>
              <h4 class="my-1">59K</h4>
              <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>12.4% Since last week</p>
            </div>
            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
            </div>
          </div>
          <div id="chart3"></div>
        </div>
      </div>
    </div>
  </div>
  <!--end row-->
  <div class="row">
    <div class="col d-flex">
      <div class="card radius-10 w-100">
        <div class="card-header border-bottom-0">
          <div class="d-flex align-items-center">
            <div>
              <h5 class="mb-1">Top Products</h5>
              <p class="mb-0 font-13 text-secondary"><i class='bx bxs-calendar'></i>in last 30 days revenue</p>
            </div>
            <div class="dropdown ms-auto">
              <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:;">Action</a>
                </li>
                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="product-list p-3 mb-3">
          <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
            <div class="col-sm-6">
              <div class="d-flex align-items-center">
                <div class="product-img">
                  <img src="assets/images/icons/chair.png" alt="" />
                </div>
                <div class="ms-2">
                  <h6 class="mb-1">Light Blue Chair</h6>
                  <p class="mb-0">$240.00</p>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <h6 class="mb-1">$2140.00</h6>
              <p class="mb-0">345 Sales</p>
            </div>
            <div class="col-sm">
              <div id="chart5"></div>
            </div>
          </div>
          <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
            <div class="col-sm-6">
              <div class="d-flex align-items-center">
                <div class="product-img">
                  <img src="assets/images/icons/user-interface.png" alt="" />
                </div>
                <div class="ms-2">
                  <h6 class="mb-1">Honor Mobile 7x</h6>
                  <p class="mb-0">$159.00</p>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <h6 class="mb-1">$3570.00</h6>
              <p class="mb-0">148 Sales</p>
            </div>
            <div class="col-sm">
              <div id="chart6"></div>
            </div>
          </div>
          <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
            <div class="col-sm-6">
              <div class="d-flex align-items-center">
                <div class="product-img">
                  <img src="assets/images/icons/watch.png" alt="" />
                </div>
                <div class="ms-2">
                  <h6 class="mb-1">Hand Watch</h6>
                  <p class="mb-0">$250.00</p>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <h6 class="mb-1">$3650.00</h6>
              <p class="mb-0">122 Sales</p>
            </div>
            <div class="col-sm">
              <div id="chart7"></div>
            </div>
          </div>
          <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
            <div class="col-sm-6">
              <div class="d-flex align-items-center">
                <div class="product-img">
                  <img src="assets/images/icons/idea.png" alt="" />
                </div>
                <div class="ms-2">
                  <h6 class="mb-1">Mini Laptop</h6>
                  <p class="mb-0">$260.00</p>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <h6 class="mb-1">$6320.00</h6>
              <p class="mb-0">452 Sales</p>
            </div>
            <div class="col-sm">
              <div id="chart8"></div>
            </div>
          </div>
          <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
            <div class="col-sm-6">
              <div class="d-flex align-items-center">
                <div class="product-img">
                  <img src="assets/images/icons/tshirt.png" alt="" />
                </div>
                <div class="ms-2">
                  <h6 class="mb-1">Slim-T-Shirt</h6>
                  <p class="mb-0">$112.00</p>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <h6 class="mb-1">$2360.00</h6>
              <p class="mb-0">572 Sales</p>
            </div>
            <div class="col-sm">
              <div id="chart9"></div>
            </div>
          </div>
          <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
            <div class="col-sm-6">
              <div class="d-flex align-items-center">
                <div class="product-img">
                  <img src="assets/images/icons/headphones.png" alt="" />
                </div>
                <div class="ms-2">
                  <h6 class="mb-1">Smart Headphones</h6>
                  <p class="mb-0">$360.00</p>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <h6 class="mb-1">$9840.00</h6>
              <p class="mb-0">275 Sales</p>
            </div>
            <div class="col-sm">
              <div id="chart10"></div>
            </div>
          </div>
          <div class="row border mx-0 py-2 radius-10 cursor-pointer">
            <div class="col-sm-6">
              <div class="d-flex align-items-center">
                <div class="product-img">
                  <img src="assets/images/icons/shoes.png" alt="" />
                </div>
                <div class="ms-2">
                  <h6 class="mb-1">Green Sports Shoes</h6>
                  <p class="mb-0">$410.00</p>
                </div>
              </div>
            </div>
            <div class="col-sm">
              <h6 class="mb-1">$3840.00</h6>
              <p class="mb-0">265 Sales</p>
            </div>
            <div class="col-sm">
              <div id="chart11"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end row-->
  <div class="row">
    <div class="col-xl-12 d-flex">
      <div class="card radius-10 w-100">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <h5 class="mb-1">Transaction History</h5>
              <p class="mb-0 font-13 text-secondary"><i class='bx bxs-calendar'></i>in last 30 days revenue</p>
            </div>
            <div class="dropdown ms-auto">
              <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="javascript:;">Action</a>
                </li>
                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="table-responsive mt-4">
            <table class="table align-middle mb-0 table-hover" id="Transaction-History">
              <thead class="table-light">
                <tr>
                  <th>Payment Name</th>
                  <th>Date & Time</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-1.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from Michle Jhon</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #8547846</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 10, 2021</td>
                  <td>+256.00</td>
                  <td>
                    <div class="badge rounded-pill bg-success w-100">Completed</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-2.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from Pauline Bird</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #9653248</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 12, 2021</td>
                  <td>+566.00</td>
                  <td>
                    <div class="badge rounded-pill bg-info text-dark w-100">In Progress</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-3.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from Ralph Alva</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #7689524</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 14, 2021</td>
                  <td>+636.00</td>
                  <td>
                    <div class="badge rounded-pill bg-danger w-100">Declined</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-4.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from John Roman</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #8335884</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 15, 2021</td>
                  <td>+246.00</td>
                  <td>
                    <div class="badge rounded-pill bg-success w-100">Completed</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-7.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from David Buckley</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #7865986</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 16, 2021</td>
                  <td>+876.00</td>
                  <td>
                    <div class="badge rounded-pill bg-info text-dark w-100">In Progress</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-8.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from Lewis Cruz</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #8576420</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 18, 2021</td>
                  <td>+536.00</td>
                  <td>
                    <div class="badge rounded-pill bg-success w-100">Completed</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-9.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from James Caviness</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #3775420</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 18, 2021</td>
                  <td>+536.00</td>
                  <td>
                    <div class="badge rounded-pill bg-success w-100">Completed</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-10.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from Peter Costanzo</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #3768920</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 19, 2021</td>
                  <td>+536.00</td>
                  <td>
                    <div class="badge rounded-pill bg-success w-100">Completed</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-11.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from Johnny Seitz</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #9673520</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 20, 2021</td>
                  <td>+86.00</td>
                  <td>
                    <div class="badge rounded-pill bg-danger w-100">Declined</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-12.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from Lewis Cruz</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #8576420</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 18, 2021</td>
                  <td>+536.00</td>
                  <td>
                    <div class="badge rounded-pill bg-success w-100">Completed</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-13.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from David Buckley</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #8576420</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 22, 2021</td>
                  <td>+854.00</td>
                  <td>
                    <div class="badge rounded-pill bg-info text-dark w-100">In Progress</div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="">
                        <img src="assets/images/avatars/avatar-14.png" class="rounded-circle" width="46" height="46" alt="" />
                      </div>
                      <div class="ms-2">
                        <h6 class="mb-1 font-14">Payment from Thomas Wheeler</h6>
                        <p class="mb-0 font-13 text-secondary">Refrence Id #4278620</p>
                      </div>
                    </div>
                  </td>
                  <td>Jan 18, 2021</td>
                  <td>+536.00</td>
                  <td>
                    <div class="badge rounded-pill bg-success w-100">Completed</div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
              <!--end row-->
{{-- <div class="page-heading">
  <h3>Profile Statistics</h3>
</div>
<div class="col-12 col-lg-12">
    <div class="row">
      <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body px-4 py-4-5">
            <div class="row">
              <div
                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
              >
                <div class="stats-icon purple mb-2">
                  <i class="iconly-boldShow"></i>
                </div>
              </div>
              <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                <h6 class="text-muted font-semibold">
                  Profile Views
                </h6>
                <h6 class="font-extrabold mb-0">112.000</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body px-4 py-4-5">
            <div class="row">
              <div
                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
              >
                <div class="stats-icon blue mb-2">
                  <i class="iconly-boldProfile"></i>
                </div>
              </div>
              <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                <h6 class="text-muted font-semibold">Followers</h6>
                <h6 class="font-extrabold mb-0">183.000</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body px-4 py-4-5">
            <div class="row">
              <div
                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
              >
                <div class="stats-icon green mb-2">
                  <i class="iconly-boldAdd-User"></i>
                </div>
              </div>
              <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                <h6 class="text-muted font-semibold">Following</h6>
                <h6 class="font-extrabold mb-0">80.000</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
          <div class="card-body px-4 py-4-5">
            <div class="row">
              <div
                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start"
              >
                <div class="stats-icon red mb-2">
                  <i class="iconly-boldBookmark"></i>
                </div>
              </div>
              <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                <h6 class="text-muted font-semibold">Saved Post</h6>
                <h6 class="font-extrabold mb-0">112</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Profile Visit</h4>
          </div>
          <div class="card-body">
            <div id="chart-profile-visit"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-xl-4">
        <div class="card">
          <div class="card-header">
            <h4>Profile Visit</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-7">
                <div class="d-flex align-items-center">
                  <svg
                    class="bi text-primary"
                    width="32"
                    height="32"
                    fill="blue"
                    style="width: 10px"
                  >
                    <use
                      xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill"
                    />
                  </svg>
                  <h5 class="mb-0 ms-3">Europe</h5>
                </div>
              </div>
              <div class="col-5">
                <h5 class="mb-0 text-end">862</h5>
              </div>
              <div class="col-12">
                <div id="chart-europe"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-7">
                <div class="d-flex align-items-center">
                  <svg
                    class="bi text-success"
                    width="32"
                    height="32"
                    fill="blue"
                    style="width: 10px"
                  >
                    <use
                      xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill"
                    />
                  </svg>
                  <h5 class="mb-0 ms-3">America</h5>
                </div>
              </div>
              <div class="col-5">
                <h5 class="mb-0 text-end">375</h5>
              </div>
              <div class="col-12">
                <div id="chart-america"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-7">
                <div class="d-flex align-items-center">
                  <svg
                    class="bi text-danger"
                    width="32"
                    height="32"
                    fill="blue"
                    style="width: 10px"
                  >
                    <use
                      xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill"
                    />
                  </svg>
                  <h5 class="mb-0 ms-3">Indonesia</h5>
                </div>
              </div>
              <div class="col-5">
                <h5 class="mb-0 text-end">1025</h5>
              </div>
              <div class="col-12">
                <div id="chart-indonesia"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-8">
        <div class="card">
          <div class="card-header">
            <h4>Latest Comments</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-lg">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Comment</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="col-3">
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-md">
                          <img src="{{asset('public/assets/compiled/jpg/5.jpg')}}" />
                        </div>
                        <p class="font-bold ms-3 mb-0">Si Cantik</p>
                      </div>
                    </td>
                    <td class="col-auto">
                      <p class="mb-0">
                        Congratulations on your graduation!
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td class="col-3">
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-md">
                          <img src="{{asset('public/assets/compiled/jpg/2.jpg')}}" />
                        </div>
                        <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                      </div>
                    </td>
                    <td class="col-auto">
                      <p class="mb-0">
                        Wow amazing design! Can you make another
                        tutorial for this design?
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div> --}}

@endsection