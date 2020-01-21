<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
          integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <!-- Custom fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>Sofra</title>
    <style>
        .star-rating li {
            color: gold;
        }
    </style>
    @yield('style')
</head>

<body>

<!--==============navbar section=======-->
<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-light" style="background-color: #ECECEC;">
            @if(auth()->guard('client-web')->check())
            <div class="col-md-4 col-sm-12 ">
               <a href="{{url('show-cart')}}"><i class="fas fa-shopping-cart"></i>{{session()->has('cart')?session()->get('cart')->totalQty:'0'}}</a>
                <div class="dropdown">
                    <i class="fas fa-user-circle dropbtn "></i>
                    <div class="dropdown-content " >
                        <a href="{{url('client-profile')}}">profile</a>
                        <a href="{{url('client-change-password')}}"><i class="fa fa-key"></i>change password</a>
                        <a href="{{url('/logout')}}"><i class="fa fa-arrow"></i>logout</a>
                    </div>
                </div>
            </div>
            @endif
            @if(auth()->guard('restaurant-web')->check())
                    <div class="col-md-4 col-sm-12 ">
                        <div class="dropdown">
                            <i class="fas fa-user-circle dropbtn "></i>
                            <div class="dropdown-content " >
                                <a href="{{url('restaurant-profile')}}">profile</a>
                                <a href="{{url('restaurant-change-password')}}"><i class="fa fa-key"></i>change password</a>
                                <a href="{{url('/logout')}}"><i class="fa fa-arrow"></i>logout</a>
                            </div>
                        </div>
                    </div>
                @endif

            <div class="col-md-4 col-sm-12 logo-up">
                <img class="logo" src="{{asset('front/images/sofra%20logo-1@2x.png')}}">
            </div>
            <div class="col-md-4 col-sm-12 burger">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01"
                        aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-hamburger"></i>
                </button>
            </div>


            <div class="collapse navbar-collapse " id="navbarsExample01">
                <ul class="navbar-nav custom">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('index')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('contact')}}">contact us</a>
                    </li>


                </ul>

            </div>
        </nav>
    </div>
</div>

@yield('content')
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-desc">
                    <div class="who-us">
                        <i class="fa fa-pencil"></i>
                        <h3>من نحن</h3>
                    </div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.<br> Nam enim voluptatibus ullam
                        deleniti culpa accusamus <br> fugit doloremque blanditiis provident pariatur, maiores harum
                        error<br> porro nihil quidem eligendi magnam sunt aut?</p>
                    <ul class="list-unstyled links">
                        <li>
                            <a href="#" class="fa fa-facebook-square"></a>
                        </li>
                        <li>
                            <a href="#" class="fa fa-twitter"></a>
                        </li>
                        <li>
                            <a href="#" class="fa fa-instagram"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <a href="{{url('index')}}" class="footer-logo">
                    <img src="{{asset('front/images/sofra logo-1.png')}}" alt="Footer-logo">
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
@include('sweetalert::alert')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
@stack('script')

</body>

</html>