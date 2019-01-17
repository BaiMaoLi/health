<!-- Navigation -->
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto" style="margin:auto">
                <li class="nav-item mx-0 mx-lg-1" name="oo">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#" style="margin-left: 100px">HOME</a>
                </li>
                <li class="nav-item mx-0 mx-lg-1" name="oo">
                    @if(auth::check())

                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" style="margin-left: 100px"
                           onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                           LOGOUT
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{url('page1')}}" style="margin-left: 100px">LOGIN</a>
                    @endif

                </li>
                <li class="nav-item mx-0 mx-lg-1" name="oo">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#disclaimer" style="margin-left: 100px">DISCLAIMER</a>
                </li>
                <li class="nav-item mx-0 mx-lg-1" name="oo">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact" style="margin-left: 100px">CONTACT US</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
