    <nav class="navbar navbar-expand-lg navbar-light pt-4 pb-4 mb-4">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
         <img src="{{asset('assets/images/logos/UNAKI-Logo-Universitas-300x107.png')}}" class="img nav-image">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto" >
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
              <a class="nav-link {{Request::is(['login']) ? 'text-accent' : 'text-dark2' }}" href="{{ url('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{Request::is(['penerimaan-mahasiswa-baru']) ? 'text-accent' : 'text-dark2' }}" href="{{ url('register') }}">{{ __('Penerimaan Mahasiswa Baru') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark2" href="https://unaki.ac.id">Website Resmi</a>
            </li>
            @else
            
            @auth()
            <li class="nav-item">
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
            @endauth

            @auth('admin')
            <li class="nav-item">
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
            @endauth

            @auth('lecturer')
            <li class="nav-item">
              <a class="dropdown-item" href="{{ route('logout.lecturer') }}"
              onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout.lecturer') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
            @endauth
            @endguest
            </ul>
        </div>
      </div>
    </nav>
