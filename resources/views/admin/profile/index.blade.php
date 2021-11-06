@extends('admin.layouts.app')


@section('styles')

<style>

  .iconslist{
    margin: 0;
    padding: 0;
    margin-right: 0px !important;
  
  }

  .bi-plus-lg{
    float: right;
  }    
</style>
@endsection

@section('content')


<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
        <li class="breadcrumb-item active">{{$page}}</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <span class="text-danger text-sm error-text">{{$errors->first('name')}}</span>
  <span class="text-danger text-sm error-text">{{$errors->first('email')}}</span>
  <span class="text-danger text-sm error-text">{{$errors->first('password')}}</span>
  <span class="text-danger text-sm error-text">{{$errors->first('phone')}}</span>

  <section class="section">
    <div class="row">

      <div class="card">
        <div class="card-body">

            <section class="row mb-2">


            <div class="col-md-8 float-end">
                <h5 class="card-title float-left">Profile:</h5>
            </div>

            {{-- Plus icon --}}
            <div class="col-md-4 iconslist">
                {{-- <div class="icon"> --}}
                    <a  type="button" class="float-end plus-circle" id="plus-circle" data-bs-toggle="modal" data-bs-target="#largeModal">
                    <i class="bi bi-plus-lg"></i>
                    </a>
                {{-- </div> --}}
            </div>
            {{-- end plus icon --}}
            </section>


           
            <section class="section profile">
                <div class="row">

                <div class="col-xl-10">

                    <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-list">Profiles List</button>
                        </li>

                        </ul>
                        <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                            <div class="col-lg-9 col-md-8">{{$profile[0]->name}}</div>
                            </div>

                            <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">{{$profile[0]->email}}</div>
                            </div>

                            <div class="row">
                            <div class="col-lg-3 col-md-4 label">User type</div>
                            <div class="col-lg-9 col-md-8">{{$profile[0]->user_type}}</div>
                            </div>

                            <div class="row">
                            <div class="col-lg-3 col-md-4 label">Phone</div>
                            <div class="col-lg-9 col-md-8">{{$profile[0]->phone}}</div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form method="POST" action="{{route('profile.update',$profile[0]->slug)}}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                    <div class="col-md-8 col-lg-9">
                                    <input name="name" type="text" class="form-control" id="name" value="{{$profile[0]->name}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                    <input name="email" type="email" class="form-control" id="Email" value="{{$profile[0]->email}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">User type</label>
                                    <div class="col-md-8 col-lg-9" class="form-control">
                                        <select name="user_type" class="form-control">
                                            <option value="author" {{$profile[0]->user_type == 'author' ? 'selected' : ''}}>Author</option>
                                            <option value="admin" {{$profile[0]->user_type == 'admin' ? 'selected' : ''}}>Admin</option>
                                            <option value="guest" {{$profile[0]->user_type == 'guest' ? 'selected' : ''}}>Guest</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                    <div class="col-md-8 col-lg-9">
                                    <input name="phone" type="number" class="form-control" id="Phone" value="{{$profile[0]->phone}}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                    <input name="password" type="password" class="form-control" id="password">
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    <label for="confirm_password" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                    <input name="confirm_password" type="password" class="form-control" id="confirm_password">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                        {{-- profile list table --}}
                        <div class="tab-pane fade profile-edit pt-3" id="profile-list">
                            <!-- Table with hoverable rows -->
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php $num = 1; @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{$num++}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->user_type}}</td>
                                        <td>
                                            <div class="card-body">
                                                <a href="#" class="btn btn-danger p-1 w-1 h-1 delete" id="{{$user->slug}}">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                                <a href="{{route('profile.edit', $user)}}" class="btn btn-info p-1 w-1 h-1" data-bs-toggle="modal" data-bs-target="#profileModal{{$user->slug}}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                           @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with hoverable rows -->

                            
               
                        </div>
                        {{-- end profile list table --}}

                        </div><!-- End Bordered Tabs -->

                    </div>
                    </div>

                </div>
                </div>
            </section>


        </div>
      </div>
    </div>
  </section>


{{-- extra large modal  --}}
<div class="modal fade" id="largeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" data-bs-backdrop="false">
      <div class="modal-content">
        
        <div class="modal-header mb-2">
          <h5 class="modal-title fw-bold">New Profile:</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form class="row g-3" method="POST" action="{{route('profile.store')}}">
              @csrf
    
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                    <input name="name" type="text" class="form-control" id="name">
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                    <input name="email" type="email" class="form-control" id="Email">
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">User type</label>
                    <div class="col-md-8 col-lg-9">
                        <select name="user_type" class="form-control">
                            <option value="author">Author</option>
                            <option value="admin">Admin</option>
                            <option value="guest">Guest</option>
                        </select>
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                    <input name="phone" type="number" class="form-control" id="Phone">
                    </div>
                </div>
    
                <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Password</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control rounded-right" id="password">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="password_confirmation" type="password" class="form-control rounded-right" id="password">
                    </div>
                </div>
    
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
  
      </div>
    </div>
</div>
<!--End Large Modal-->
  

{{-- Profile large modal  --}}
@foreach ($users as $user)

    <div class="modal fade" id="profileModal{{$user->slug}}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" data-bs-backdrop="false">
        <div class="modal-content">
            
            <div class="modal-header mb-2">
            <h5 class="modal-title fw-bold">Edit Profile:</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" method="POST" action="{{route('profile.update', $user->slug)}}">
                @csrf
                @method('PUT')
        
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="name" value="{{$user->name}}" type="text" class="form-control" id="name">
                        </div>
                    </div>
        
                    <div class="row mb-3">
                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="email" value="{{$user->email}}" type="email" class="form-control" id="Email">
                        </div>
                    </div>
        
                    <div class="row mb-3">
                        <label for="company" class="col-md-4 col-lg-3 col-form-label">User type</label>
                        <div class="col-md-8 col-lg-9">
                            <select name="user_type" class="form-control">
                                <option value="author" {{$profile[0]->user_type == 'author' ? 'selected' : ''}}>Author</option>
                                <option value="admin" {{$profile[0]->user_type == 'admin' ? 'selected' : ''}}>Admin</option>
                                <option value="guest" {{$profile[0]->user_type == 'guest' ? 'selected' : ''}}>Guest</option>
                            </select>
                        </div>
                    </div>
        
                    <div class="row mb-3">
                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="phone" value="{{$user->phone}}" type="number" class="form-control" id="Phone">
                        </div>
                    </div>
        
                    <div class="row mb-3">
                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="password" type="password" class="form-control rounded-right" id="password">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="confirm_password" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="confirm_password" type="password" class="form-control rounded-right" id="confirm_password">
                        </div>
                    </div>
        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>

        </div>
        </div>
    </div>
@endforeach
<!--End Profile Modal-->

        
  
@endsection

  @section('scripts')

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script>
    $(document).on('click', '.delete', function () {

        console.log('hi before');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                console.log('hi after');
                
                var id = $(this).attr('id');
                var url = '{{ route("pricingdetail.destroy", ":plan") }}';
                url = url.replace(':plan', id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'DELETE',
                    datatype: 'json',
                    data: {

                        "_method": 'DELETE',

                    },
                    success: function (data) {
                        location.reload();
                    }
                })
            }
        })
    });

  </script>



  {{-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script> --}}
  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script type="text/javascript">
      $(document).ready(function () {
          $('.ckeditor').ckeditor();
      });
  </script>

  <script>
      const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
    
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    // toggle the eye icon
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
    });
  </script>
  @endsection