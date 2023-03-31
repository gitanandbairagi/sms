<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="position:sticky;top:0">
    <div class="container">
      <a href="../../index3.html" class="navbar-brand">
        <img src="{{url('assets/images/sms_tansparent_logo.png')}}" alt="sms_logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SMS Society Management System</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ route('index') }}" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#sectionContactUs" class="nav-link">Contact</a>
          </li>
          <li class="nav-item">
            <a href="#sectionAboutUs" class="nav-link">About Us</a>
          </li>
        </ul>
        @if (actual_link() != url('login'))
            <!-- Right navbar links -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="btn btn-sm btn-outline-primary" href="#sectionCheckPrices" role="button">Check Prices</a>
              <a class="btn btn-sm btn-outline-success" href="{{ route('login', 'member') }}" role="button">SignIn</a>
            </li>
          </ul>
        </div>  
        @endif      
      </div>
    </div>
  </nav>
  <!-- /.navbar -->