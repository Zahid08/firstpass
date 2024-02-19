<header class="position-absolute top-0 w-100 dark_menu">
    <nav class="navbar navbar-expand-lg py-0">
        <div class="container">
            <a class="navbar-brand d-inline-block d-lg-none" href="{{URL::to ('/')}}">
                <img src="{!! url ('frontend_assets/images/site-logo.png') !!}" alt="site-logo">
            </a>
            <div class="d-flex d-lg-none mob_toggler">
                
                @if(auth()->guest())
                    <a class="nav-link book_btn btn btn-primary p-0" href="{{URL::to ('/login')}}">Login</a>
                @else
                    <a class="nav-link book_btn btn btn-primary p-0" href="javascript:void(0)" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                @endif
                
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                        <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                </button>
            </div>
            <div class="offcanvas offcanvas-start main_menu" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <a class="navbar-brand d-inline-block d-lg-none" href="{{URL::to ('/')}}">
                        <img src="{!! url ('frontend_assets/images/site-logo.png') !!}" alt="site-logo">
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    </button>
                </div>
                <div class="offcanvas-body w-100">
                    <div class="row w-100 d-flex align-items-center m-0 overflow-hidden">
                        <ul class="navbar-nav col-xl-4 col-lg-5 p-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{URL::to ('/')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{URL::to ('/driving-lessons')}}">Driving lessons</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{URL::to ('/driving-lessons/test-package')}}">Test packages</a>
                            </li>
                        </ul>
                        <div class=" d-lg-inline-block d-none col-xl-4 col-lg-2 text-center">
                            <a class="navbar-brand" href="{{URL::to ('/')}}">
                                <img src="{!! url ('frontend_assets/images/site-logo.png') !!}" alt="site-logo">
                            </a>
                        </div>
                        <ul class="navbar-nav col-xl-4 col-lg-5 d-flex align-items-center justify-content-end p-0 contact_navbar">
                            <li class="nav-item">
                                <a class="nav-link" href="{{URL::to ('/contact')}}">Contact</a>
                            </li>
                            @if(auth()->user())
                                <li>
                                    <a class="nav-link" href="{{URL::to ('/login')}}">My Account</a>
                                </li>
                            @endif
                            <li class="nav-item d-lg-inline-block d-sm-none d-block border-0 p-3 p-sm-0">
                                @if(auth()->guest())
                                    <a class="nav-link book_btn btn btn-primary p-0" href="{{URL::to ('/login')}}">Login</a>
                                @else
                                    <a class="nav-link book_btn btn btn-primary p-0" href="javascript:void(0)" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
