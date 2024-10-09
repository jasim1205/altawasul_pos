@extends('layouts.app')
@section('title','Al Tawasul')
@section('content')
  <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Purchase</p>
              <h4 class="my-1">{{$purchase}}</h4>
              <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>Today Purchase</p>
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
              <p class="mb-0 text-secondary">Sale</p>
              <h4 class="my-1">{{$sale}}</h4>
              <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>Today Sale</p>
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
              <p class="mb-0 text-secondary">Expense</p>
              <h4 class="my-1">{{$expense}}</h4>
              <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>Today Expense</p>
            </div>
            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
            </div>
          </div>
          <div id="chart3"></div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Monthly Purchase</p>
              <h4 class="my-1">{{$monthlypurchase}}</h4>
              <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>Monthly Purchase</p>
            </div>
            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
            </div>
          </div>
          <div id="chart5"></div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Monthly Sale</p>
              <h4 class="my-1">{{$monthlysale}}</h4>
              <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>Monthly Sale</p>
            </div>
            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
            </div>
          </div>
          <div id="chart6"></div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Monthly Expense</p>
              <h4 class="my-1">{{$monthlyexpense}}</h4>
              <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>Monthly Expense</p>
            </div>
            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
            </div>
          </div>
          <div id="chart7"></div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Total Purchase</p>
              <h4 class="my-1">{{$totalpurchase}}</h4>
              <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>Today Purchase</p>
            </div>
            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
            </div>
          </div>
          <div id="chart8"></div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Total Sale</p>
              <h4 class="my-1">{{$totalsale}}</h4>
              <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>Today Sale</p>
            </div>
            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
            </div>
          </div>
          <div id="chart9"></div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Total Expense</p>
              <h4 class="my-1">{{$totalexpense}}</h4>
              <p class="mb-0 font-13 text-danger"><i class='bx bxs-down-arrow align-middle'></i>Total Expense</p>
            </div>
            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
            </div>
          </div>
          <div id="chart10"></div>
        </div>
      </div>
    </div>
  </div>
  <!--end row-->
 

@endsection