<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{config('app.name')}} | Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha - v4.6.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <body>

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top ">
          <div class="container d-flex align-items-center">
      
            <h1 class="logo me-auto"><a href="{{route('homepage')}}">TachyonAI</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      
            <nav id="navbar" class="navbar">
              <ul>
                <li><a class="nav-link scrollto" href="{{route('homepage')}}">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="{{route('homepage')}}">Services</a></li>
                <li><a class="nav-link scrollto" href="{{route('homepage')}}">Portfolio</a></li>
                <li><a class="nav-link scrollto" href="{{route('homepage')}}">Team</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
      
          </div>
        </header><!-- End Header -->

        
  @include('frontend._hero')


  <main id="main">


    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>About Us</h2>
          </div>
  
          <div class="row content">
            <div class="col-lg-6">
              {!!$about->description1!!}
              
            </div>
            
            <div class="col-lg-6 pt-4 pt-lg-0">
              {!!$about->description2!!}
            </div>
            
          
          </div>
  
        </div>
      </section>
      
      <!-- End About Us Section -->

    {{-- <div class="flex items-center justify-end mt-4">
        <a class="btn" href="{{ url('auth/facebook') }}"
            style="background: #3B5499; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
            Login with Facebook
        </a>
    </div> --}}
        <!-- Comments section-->
        <section class="mb-5">
            <div class="card bg-light">
                <div class="card-body">

                    <div class="section-title float-start" style="color: #47B2E4; background: #fff;">
                        <h3>Comment Section:</h3> 
                    </div>

           
                    <!-- Comment form-->
                    <form class="mb-4" method="POST" action="{{route('comment.store')}}">
                        @csrf
                        @method('POST')
                        
                        <textarea class="form-control mb-2" name="description" rows="3" placeholder="Join the discussion and leave a comment!">
                            {{old('description')}}
                        </textarea>
                        <span class="badge bg-danger">{{$errors->first('description')}}</span>
                        <button type="submit" class="btn btn-info rounded-pill float-end mr-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Submit">
                           Submit <i class="bi bi-caret-right-fill"></i>
                        </button>
                    </form>


                    {{-- if not logged in  show --}}

                    {{-- <button type="button" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#smallModal">
                        <i class="bi bi-lock-fill"></i> Login to submit a comment 
                    </button> --}}

                    {{-- end logged in button  --}}


                    
                    @foreach ($comments as $comment)
                    <!-- Comment with nested comments-->
                    <div class="d-flex mb-4">
                        <!-- Parent comment-->
                        <div class="flex-shrink-0">
                            <img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." />
                        </div>
                        <div class="ms-3">
                            <div class="fw-bold">Commenter Name</div>
                                {{$comment->description}}
                            {{-- If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks. --}}
                            
                            @foreach ($comment->replies as $reply)
                                <!-- Child comment 2-->
                                <div class="d-flex mt-4">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Replier Name</div>
                                        {{$reply->description}}
                                        {{-- When you put money directly to a problem, it makes a good headline. --}}
                                    </div>
                                </div>
                            @endforeach

                            <!-- Child comment 1-->
                            <div class="d-flex mt-4">
                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <form class="mb-4" method="POST" action="{{route('reply.store')}}">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                        <input type="text" class="form-control mb-2" style="width: 800px" name="description" value="{{old('description')}}" placeholder="Reply ...">
                                        <span class="badge bg-danger">{{$errors->first('description')}}</span>
                                       
                                        <button type="submit" class="btn btn-info rounded-pill float-end mr-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Submit">
                                           Submit <i class="bi bi-caret-right-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        </div>
                    
                    @endforeach

                    <!-- Single comment-->
                        
                        {{-- <div class="d-flex">
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">Commenter Name</div>
                                When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                            </div>
                        </div> --}}

                </div>
            </div>
        </section>



    {{-- @include('frontend._contact') --}}


{{-- 
    <div class="modal fade p-4" id="smallModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Login to authorize</h5>
            </div> --}}
            {{-- <div class="modal-body">
                <div class="flex items-center justify-end mt-4">
                    <a class="btn" href="{{ url('auth/facebook') }}"
                        style="background: #3B5499; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                        Login with Facebook
                    </a>
                </div> --}}
                {{-- <div class="flex items-center justify-end mt-4"> --}}
                    {{-- <a class="btn" href="{{ url('auth/facebook') }}"
                        style="background: #3B5499; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                        Login with Google
                    </a> --}}
                    {{-- <a href="{{ url('auth/google') }}">
                        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                    </a>
                </div>
             --}}
                {{-- <div class="flex items-center justify-end mt-4">
                    <a class="btn" href="{{ url('auth/facebook') }}"
                        style="background: #3B5499; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                        Login with Linkedin
                    </a>
                </div>
            
                <div class="flex items-center justify-end mt-4">
                    <a class="btn" href="{{ url('auth/facebook') }}"
                        style="background: #3B5499; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                        Login with twitter
                    </a>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <a class="btn" href="{{ url('auth/facebook') }}"
                        style="background: #3B5499; color: #ffffff; padding: 10px; width: 100%; text-align: center; display: block; border-radius:3px;">
                        Login with Github
                    </a>
                </div>
            </div> --}}

            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div><!-- End Small Modal-->
       --}}
      

  </main>


  @include('frontend._footer')


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/waypoints/noframework.waypoints.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

      <!--common script for all pages-->

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
      <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
  
        @if(Session::has('success'))
        Swal.fire({
        icon: 'success',
        title: "{{ Session::get('success')}}"
        })
        @endif
        
        @if(Session::has('subscribe'))
        toast.fire({
        icon: 'success',
        title: "{{ Session::get('success')}}"
        })
        @endif
        
        @if(Session::has('comment_success'))
        toast.fire({
        icon: 'success',
        title: "{{ Session::get('success')}}"
        })
        @endif
        
        @if(Session::has('subscribe_error'))
        toast.fire({
        icon: 'error',
        title: "{{ Session::get('success')}}"
        })
        @endif

      </script>
  
      {{-- end common scripts for all pages --}}
      
</body>

</html>