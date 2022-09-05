<nav class="navbar is-light is-transparent">

    <div class="navbar-brand">

        <a  href="/" class="navbar-item">
            <img src="{{asset('images/app_header_logo.svg')}}" alt="header logo">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar_ana">
            <span aria-hidden="true" />
            <span aria-hidden="true" />
            <span aria-hidden="true" />
        </a>

    </div>

    <div id="navbar_ana" class="navbar-menu">

      <div class="navbar-start" id="navstart">

        @if(Auth::check())

           <a href="{{route('dashboard')}}" class="navbar-item">
                Login Action 1
            </a>

            <a href="/list-records/asset" class="navbar-item">
                Login Action 2
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <p class="navbar-link">Letter</p>
                <div class="navbar-dropdown">
                    <a href="/letter-gui" class="navbar-item">Add</a>
                    <a href="/letter-list" class="navbar-item">List All</a>
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <p class="navbar-link">Companies</p>
                <div class="navbar-dropdown">
                    <a href="/company-gui" class="navbar-item">Add</a>
                    <a href="/company-list" class="navbar-item">List All</a>
                </div>
            </div>













          @endif





















      </div>

      <div class="navbar-end">

        <div class="navbar-item">
          <div class="buttons">

              @if(Auth::check())

                <div class="navbar-item has-dropdown is-hoverable">
                    <p class="navbar-link">
                        {{ Auth::user()->name }}
                    </p>

                    <div class="navbar-dropdown">


                      <a  href="/projects" class="navbar-item">Settings</a>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a :href="route('logout')" class="navbar-item"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                        </a>
                        </form>

                    </div>
                  </div>
              @else
                <a href="{{route('login')}}" class="navbar-item">
                    Login
                </a>

                <a href="{{route('register')}}" class="navbar-item">
                    Register
                </a>

              @endif

          </div>
        </div>

      </div>

    </div>

  </nav>
