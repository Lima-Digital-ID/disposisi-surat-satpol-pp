<nav class="navbar header-navbar pcoded-header">
  <div class="navbar-wrapper">
      <div class="navbar-logo">
          <a href="{{ route('dashboard') }}" class="nav-logo">
            <img class="img-fluid" src="{{ asset('') }}png/satpol-pp.png" alt="Theme-Logo" width="70px"/> 
              <h3 class="mb-0">DISPOSISI</h3>
          </a>
          <a class="mobile-menu" id="mobile-collapse" href="#!">
              <i class="feather icon-menu icon-toggle-right"></i>
          </a>
          <a class="mobile-options waves-effect waves-light">
              <i class="feather icon-more-horizontal"></i>
          </a>
      </div>
      <div class="navbar-container container-fluid">
          <ul class="nav-left">
              <li class="header-search">
                  <div class="main-search morphsearch-search">
                      <div class="input-group">
                          <span class="input-group-prepend search-close">
                              <i class="feather icon-x input-group-text"></i>
                          </span>
                          <input type="text" class="form-control" placeholder="Enter Keyword">
                          <span class="input-group-append search-btn">
                              <i class="feather icon-search input-group-text"></i>
                          </span>
                      </div>
                  </div>
              </li>
              <li>
                  <a href="#!"
                      onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()"
                      class="waves-effect waves-light" data-cf-modified-d8424a08d31b5b8b406fded2-="">
                      <i class="full-screen feather icon-maximize"></i>
                  </a>
              </li>
          </ul>
          <ul class="nav-right">
              {{--  <li class="header-notification">
                  <div class="dropdown-primary dropdown">
                      <div class="dropdown-toggle" data-toggle="dropdown">
                          <i class="feather icon-bell"></i>
                          <span class="badge bg-c-red" id="count-notif"></span>
                      </div>
                      <ul class="show-notification notification-view dropdown-menu"
                          data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                          <li>
                              <h6>Notifications</h6>
                              <label class="label label-danger">New</label>
                          </li>
                          <li>
                              <div class="media">
                                  <img class="img-radius" src="{{ asset('') }}jpg/avatar-4.jpg"
                                      alt="Generic placeholder image">
                                  <div class="media-body">
                                      <h5 class="notification-user">{{auth()->user()->name}}</h5>
                                      <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                          elit.</p>
                                      <span class="notification-time">30 minutes ago</span>
                                  </div>
                              </div>
                          </li>
                          <li>
                              <div class="media">
                                  <img class="img-radius" src="{{ asset('') }}jpg/avatar-3.jpg"
                                      alt="Generic placeholder image">
                                  <div class="media-body">
                                      <h5 class="notification-user">Joseph William</h5>
                                      <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                          elit.</p>
                                      <span class="notification-time">30 minutes ago</span>
                                  </div>
                              </div>
                          </li>
                          <li>
                              <div class="media">
                                  <img class="img-radius" src="{{ asset('') }}jpg/avatar-4.jpg"
                                      alt="Generic placeholder image">
                                  <div class="media-body">
                                      <h5 class="notification-user">Sara Soudein</h5>
                                      <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                          elit.</p>
                                      <span class="notification-time">30 minutes ago</span>
                                  </div>
                              </div>
                          </li>
                      </ul>
                  </div>
              </li>  --}}
              {{-- <li class="header-notification">
                  <div class="dropdown-primary dropdown">
                      <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                          <i class="feather icon-message-square"></i>
                          <span class="badge bg-c-green">3</span>
                      </div>
                  </div>
              </li> --}}
              <li class="user-profile header-notification">
                  <div class="dropdown-primary dropdown">
                      <div class="dropdown-toggle" data-toggle="dropdown">
                          {{-- <img src="https://iupac.org/wp-content/uploads/2018/05/default-avatar.png" class="img-radius"
                              alt="User-Profile-Image"> --}}
                          <span>{{auth()->user()->nama}}</span>
                          <i class="feather icon-chevron-down"></i>
                      </div>
                      <ul class="show-notification profile-notification dropdown-menu"
                          data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                          {{--  <li>
                              <a href="{{ route('change_password') }}">
                                  <i class="feather icon-settings"></i> Ganti Password
                              </a>
                          </li>  --}}
                          {{-- <li>
                              <a href="#">
                                  <i class="feather icon-user"></i> Profile
                              </a>
                          </li>
                          <li>
                              <a href="email-inbox.html">
                                  <i class="feather icon-mail"></i> My Messages
                              </a>
                          </li>
                          <li>
                              <a href="auth-lock-screen.html">
                                  <i class="feather icon-lock"></i> Lock Screen
                              </a>
                          </li> --}}
                          <li>
                              <a class="dropdown-item" href="#" data-toggle="modal"
                                  data-target="#exampleModal">
                                  <i class="feather icon-log-out"></i>
                                  Logout
                              </a>
                          </li>
                          <li>
                              <a class="dropdown-item" href="{{ route('change_password') }}">
                                  <i class="fa fa-pencil-square-o"></i>
                                  Ubah Password
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>
          </ul>
      </div>
  </div>
</nav>