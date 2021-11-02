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

  <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('title')}}</span>
  <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('price')}}</span>
  <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('duration')}}</span>
  <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('description')}}</span>
            

  <section class="section">
    <div class="row">

      <div class="card">
        <div class="card-body">

          <section class="row mb-2">


            <div class="col-md-8 float-end">
              <h5 class="card-title float-left">Pricing:</h5>
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
           @foreach ($plans as $plan)
              
              <div class="collapse" id="{{$plan->slug}}">
                <div class="card card-body">

                  <form class="row g-3" method="POST" action="{{route('pricingdetail.update', $plan)}}">
                    @csrf
                    @method('PUT')
                    
                    <div class="modal-body">

                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Title:</label>
                        <div class="col-sm-10">
                          <input type="text" name="title" value="{{$plan->title}}" class="form-control" id="inputText">
                        </div>
                      </div>
            
                      <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Price</label>
                        <div class="col-sm-10">
                          <input type="number" name="price" value="{{$plan->price}}" class="form-control" id="inputEmail">
                        </div>
                      </div>
            
                      <div class="row mb-3">
                        <label for="duration" class="col-sm-2 col-form-label fw-bold">Duration:</label>
                        <div class="col-sm-10">
                          <input type="text" name="duration" value="{{$plan->duration}}" class="form-control" id="duration">
                        </div>
                      </div>
            
                      <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">Description:</label>
                        <div class="col-sm-10">
                          <textarea name="description" class="ckeditor" id="ckeditor" cols="30" rows="10">
                            {{$plan->description}}
                          </textarea>
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
    @foreach ($plans as $plan)

    <div class="col-lg-2 col-md-4 portfolio-item filter-app mb-2">
      <div class="card m-1" style="width: 10rem;">
        <div class="card-body item-center">
          <h6>{{$plan->title}}</h6>
          <h6 class="badge rounded-pill bg-primary">{{ $plan->price }}</h6><br>
          <h6 class="badge rounded-pill bg-warning">{{ $plan->duration }}</h6>
        <p>{!!$plan->description!!}</p>
          
          <a href="#" class="btn btn-danger p-1 w-1 h-1 delete" id="{{$plan->slug}}">
            <i class="bi bi-trash"></i>
          </a>
          <a class="btn btn-info p-1 w-1 h-1" data-bs-toggle="collapse" href="#{{$plan->slug}}" role="button" aria-expanded="false" aria-controls="{{$plan->slug}}">
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
        <h5 class="modal-title fw-bold">Create New Pricing Plan:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form class="row g-3" method="POST" action="{{route('pricingdetail.store')}}">
        @csrf
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Title:</label>
            <div class="col-sm-10">
              <input type="text" name="title" class="form-control" id="inputText">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">Price</label>
            <div class="col-sm-10">
              <input type="number" name="price" class="form-control" id="inputEmail">
            </div>
          </div>

          <div class="row mb-3">
            <label for="duration" class="col-sm-2 col-form-label fw-bold">Duration:</label>
            <div class="col-sm-10">
              <input type="text" name="duration" class="form-control" id="duration">
            </div>
          </div>

          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label fw-bold">Description:</label>
            <div class="col-sm-10">
              
              <textarea name="description" class="ckeditor" id="ckeditor" cols="30" rows="10"></textarea>
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