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

  <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('full_name')}}</span>
  <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('position')}}</span>
  <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('photo')}}</span>
  <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('bio')}}</span>
            

  <section class="section">
    <div class="row">

      <div class="card">
        <div class="card-body">

          <section class="row mb-2">


            <div class="col-md-8 float-end">
              <h5 class="card-title float-left">Teams:</h5>
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

          <!-- collapse rows -->
           @foreach ($members as $member)
              
              <div class="collapse" id="{{$member->slug}}">
                <div class="card card-body">

                  <form class="row g-3" method="POST" action="{{route('teamdetail.update', $member)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Full name:</label>
                        <div class="col-sm-10">
                          <input type="text" name="full_name" value="{{$member->full_name}}" class="form-control" id="inputText">
                        </div>
                      </div>
            
                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Position</label>
                        <div class="col-sm-10">
                          <input type="text" name="position" value="{{$member->position}}" class="form-control" id="inputEmail">
                        </div>
                      </div>
            
                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Bio:</label>
                        <div class="col-sm-10">
                          <input type="text" name="bio" value="{{$member->bio}}" class="form-control" id="inputEmail">
                        </div>
                      </div>
            
                      <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">Facebook link:</label>
                        <div class="col-sm-10">
                          <input type="text" name="fb" value="{{$member->fb ?? ''}}" class="form-control" id="inputPassword">
                        </div>
                      </div>
            
                      <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">Twitter link:</label>
                        <div class="col-sm-10">
                          <input type="text" name="twitter" value="{{$member->twitter ?? ''}}" class="form-control" id="inputPassword">
                        </div>
                      </div>
                      
                      <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">Instagram link:</label>
                        <div class="col-sm-10">
                          <input type="text" name="instagram" value="{{$member->instagram ?? ''}}" class="form-control" id="inputPassword">
                        </div>
                      </div>
                      
                      <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">LinkedIn link:</label>
                        <div class="col-sm-10">
                          <input type="text" name="linkedin" value="{{$member->linkedin ?? ''}}" class="form-control" id="inputPassword">
                        </div>
                      </div>
            
                      <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">Photo:</label>
                        <div class="col-sm-10">
                          <input type="file" name="photo" value="{{$member->photo ?? ''}}" class="form-control" id="inputPassword">
                        </div>
                      </div>
                    </div>
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    
                  </form>

                </div>
              </div>

           @endforeach 
            
        </div>
      </div>

    </div>
  </section>
  
  <section class="section row portfolio-container" data-aos="fade-up" data-aos-delay="200">

    @foreach ($members as $member)

    <div class="col-lg-2 col-md-4 portfolio-item filter-app mb-2">
      <div class="card m-1" style="width: 10rem;">
        <img src="{{$member->photo ? asset('storage/team/thumbnails/'.$member->photo) : asset('admin_assets/img/dummy-200x200.png')}}" class="card-img-top" alt="...">
        <div class="card-body item-center">
          <h6>{{$member->full_name}}
          <span class="badge rounded-pill bg-primary">{{$member->position}}</span>
        </h6>
        <p>{!!$member->bio!!}</p>
          
          <a href="#" class="btn btn-danger p-1 w-1 h-1 delete" id="{{$member->slug}}">
            <i class="bi bi-trash"></i>
          </a>
          <a class="btn btn-info p-1 w-1 h-1" data-bs-toggle="collapse" href="#{{$member->slug}}" role="button" aria-expanded="false" aria-controls="{{$member->slug}}">
            <i class="bi bi-pencil-square"></i>
          </a>
        </div>
      </div>
    </div> 

    @endforeach
    
  </section>
        
  

{{-- extra large modal  --}}
 <div class="modal fade" id="largeModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title fw-bold">Create New Portfolio:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form class="row g-3" method="POST" action="{{route('teamdetail.store')}}" enctype="multipart/form-data">
        @csrf
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Full name:</label>
            <div class="col-sm-10">
              <input type="text" name="full_name" class="form-control" id="inputText">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Position</label>
            <div class="col-sm-10">
              <input type="text" name="position" class="form-control" id="inputEmail">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Bio:</label>
            <div class="col-sm-10">
              <input type="text" name="bio" class="form-control" id="inputEmail">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">Facebook link:</label>
            <div class="col-sm-10">
              <input type="text" name="fb" class="form-control" id="inputPassword">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">Twitter link:</label>
            <div class="col-sm-10">
              <input type="text" name="twitter" class="form-control" id="inputPassword">
            </div>
          </div>
          
          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">Instagram link:</label>
            <div class="col-sm-10">
              <input type="text" name="instagram" class="form-control" id="inputPassword">
            </div>
          </div>
          
          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">LinkedIn link:</label>
            <div class="col-sm-10">
              <input type="text" name="linkedin" class="form-control" id="inputPassword">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">Photo:</label>
            <div class="col-sm-10">
              <input type="file" name="photo" class="form-control" id="inputPassword">
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
<!--End Large Modal-->



 {{-- end extra large modal --}}
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
                var url = '{{ route("teamdetail.destroy", ":member") }}';
                url = url.replace(':member', id);
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

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script type="text/javascript">
      $(document).ready(function () {
          $('.ckeditor').ckeditor();
      });
  </script>


<script>

var myCollapse = document.getElementById('myCollapse')
var bsCollapse = new bootstrap.Collapse(myCollapse, {
  toggle: false
})
</script>
  @endsection