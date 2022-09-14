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



            <a href="/list-records/asset" class="navbar-item">
                Regulations
            </a>

            <a href="/mom-greet" class="navbar-item">eMoM</a>
            <a href="/ai-list" class="navbar-item">AI</a>
            <a href="/letter-list" class="navbar-item">Letter</a>


            <div class="navbar-item has-dropdown is-hoverable">
                <p class="navbar-link">Settings</p>
                <div class="navbar-dropdown">
                    <a href="/company-list" class="navbar-item">Companies</a>
                    <a href="/mom-list" class="navbar-item">MoM</a>
                    <a href="/ai-list" class="navbar-item">Action Item</a>
                </div>
            </div>







          @endif

      </div>

      <div class="navbar-end">

        <div class="navbar-item">
          <div class="buttons">

              @if(Auth::check())

                <a href="{{ route('lang.switch', 'tr') }}" class="navbar-item is-small {{ app()->getLocale() == 'tr' ? 'has-background-warning':''}}">TR</a>
                <a href="{{ route('lang.switch', 'en') }}" class="navbar-item {{ app()->getLocale() == 'en' ? 'has-background-warning':''}}">EN</a>

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
