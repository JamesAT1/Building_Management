<style>
  #icons {
    color: #fff;
  }

  .active p,
  .active .nav-icon {
    color: #1384ae;
    font-size: 1.0rem;
  }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-warning elevation-4" style="background-color: #1384ae; color:white">
  <!-- Brand Logo -->
  <a href="{{ config('app.url', '/') }}" class="brand-link">
    <!--<img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">-->
    Building Management
  </a>
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <!-- <img src="" class="img-circle elevation-2" alt="User Image"> -->
      @if(session('user_auth') != null)
      {{session('user_auth')[0]->user_firstname . " " . session('user_auth')[0]->user_lastname}}
      @endif
    </div>
    <div class="info">
      <a href="#" class="d-block">
      </a>
    </div>
  </div>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!--<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>-->
    @section('sidebar')
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if(session('user_auth')[0]->user_rule_status == 0)
        <li class="nav-item ">
          <a href="{{url('/index')}}" class="nav-link {{ (request()->is('/')) ? 'active' : '' || (request()->is('index')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              หน้าหลัก
              <span class="right badge badge-danger">กำลังพัฒนา</span>
            </p>
          </a>
        </li>
        @endif
        @if(session('user_auth')[0]->user_rule_status == 0)
        <li class="nav-item">
          <a href="{{url('/show_user')}}" class="nav-link {{ (request()->is('show_user')) ? 'active' : '' || (request()->is('insert_user')) ? 'active' : ''}} ">
            <i class="nav-icon fas fa-solid fa-user"></i>
            <p>
              สมาชิก
            </p>
          </a>
        </li>
        @endif
        <li class="nav-item {{ (request()->is('checkIn_management')) ? 'menu-open' : 'menu-close'}} ||  {{ (request()->is('check_in')) ? 'menu-open' : 'menu-close'}}">
          <a href="#" class="nav-link {{ (request()->is('checkIn_management')) ? 'active' : ''}} || {{ (request()->is('check_in')) ? 'active' : ''}}">
            <i class="nav-icon fas fa-solid fa-briefcase"></i>
            <p>
              เช็คอิน-เช็คเอ้าท์
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('/check_in')}}" class="nav-link {{ (request()->is('check_in')) ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>ลงบันทึกการเข้างาน</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/checkIn_management')}}" class="nav-link {{ (request()->is('checkIn_management')) ? 'active' : ''}} ">
                <i class="far fa-circle nav-icon"></i>
                <p>สถานะผู้มาทำงาน</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{url('/check_machine')}}" class="nav-link {{ (request()->is('check_machine')) ? 'active' : '' || (request()->is('insert_machine')) ? 'active' : '' || (request()->is('report_check_machine')) ? 'active' : '' || (request()->is('row_report_check_machine')) ? 'active' : '' || (request()->is('checking_machine/*')) ? 'active' : ''}} ">
            <i class="nav-icon fas fa-solid fa-temperature-half"></i>
            <p>
              เช็คห้องเครื่อง
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('/list_repairs')}}" class="nav-link {{ (request()->is('list_repairs')) ? 'active' : '' || (request()->is('process_repair/*')) ? 'active' : '' || (request()->is('insert_list_repair')) ? 'active' : ''}} ">
            <i class="fa-solid nav-icon fas fa-screwdriver-wrench"></i>
            <p>
              งานที่มอบหมาย/แจ้งซ่อม
            </p>
          </a>
        </li>
        @if(session('user_auth')[0]->user_rule_status == 0)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-solid fa-file-invoice"></i>
            <p>
              ค่าน้ำ-ค่าไฟ
              <span class="right badge badge-danger">กำลังพัฒนา</span>
            </p>
          </a>
        </li>
        @endif
        @if(session('user_auth')[0]->user_rule_status == 0)
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-microchip"></i>
            <p>
              ตรวจเครื่องจักร
              <span class="right badge badge-danger">กำลังพัฒนา</span>
            </p>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{url('/logout')}}" class="logout nav-link">
            <i class="nav-icon fas fa-solid fa-arrow-right-to-bracket"></i>
            <p>
              ออกจากระบบ
            </p>
          </a>
        </li>
        </li>
      </ul>
    </nav>
    @show
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>