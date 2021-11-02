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


  <section class="section">
    <div class="row">

      <div class="card">
        <div class="card-body">

          <section class="row">


            <div class="col-md-8 float-end">
              <h5 class="card-title float-left">Portfolios:</h5>
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

          <!-- Table with hoverable rows -->
            @foreach ($portfolios as $portfolio)
              
              <div class="collapse" id="{{$portfolio->slug}}">
                <div class="card card-body">
                  <form class="row g-3" method="POST" action="{{route('portfoliodetail.update', $portfolio)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
            
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="title" value={{$portfolio->title}} id="floatingInput" placeholder="example: App3">
                        <label for="floatingInput fw-bold">Title for Portfolio:</label>
                      </div>
          
                      <div class="mb-3">
                        <label for="exampleDataList" class="form-label fw-bold">Category:</label>
                        <input class="form-control" value={{$portfolio->type}} list="datalistOptions" name="type" id="exampleDataList" placeholder="example: App3">
                        <datalist id="datalistOptions">
                            <option value="IOS">
                            <option value="Android">
                            <option value="Web">
                            <option value="Card">
                        </datalist>
                      </div>
                      
                      <div>
                        <label for="photo" class="form-label fw-bold">Photo:</label>
                        <input type="file" name="photo" id="">
                      </div>
                    </div>
            
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" href="#{{$portfolio->slug}}" role="button" aria-expanded="false" aria-controls="{{$portfolio->slug}}">Close</button>
                      <button type="submit" class="btn btn-primary">Update Portfolio</button>
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

    @foreach ($portfolios as $portfolio)
    <div class="col-lg-4 col-md-6 portfolio-item filter-app mb-2">
      <div class="card m-1" style="width: 17rem;">
        <img src="{{$portfolio->photo ? asset('storage/portfolio/'.$portfolio->photo) : asset('admin_assets/img/dummy-200x200.png')}}" class="card-img-top" alt="...">
        <div class="card-body item-center">
          <h6>{{$portfolio->title}}
          <span class="badge rounded-pill bg-primary">{{$portfolio->type}}</span>
        </h6>
          
          <a href="#" class="btn btn-danger p-1 w-1 h-1 delete" id="{{$portfolio->slug}}">
            <i class="bi bi-trash"></i>
          </a>
          <a class="btn btn-info p-1 w-1 h-1" data-bs-toggle="collapse" href="#{{$portfolio->slug}}" role="button" aria-expanded="false" aria-controls="{{$portfolio->slug}}">
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

      <form class="row g-3" method="POST" action="{{route('portfoliodetail.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="modal-body">


            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="title" id="floatingInput" placeholder="example: App3">
              <label for="floatingInput fw-bold">Title for Portfolio:</label>
            </div>

            <div class="mb-3">
              <label for="exampleDataList" class="form-label fw-bold">Category:</label>
              <input class="form-control" list="datalistOptions" name="type" id="exampleDataList" placeholder="example: App3">
              <datalist id="datalistOptions">
                  <option value="IOS">
                  <option value="Android">
                  <option value="Web">
                  <option value="Card">
              </datalist>
            </div>

            <div>
              <label for="photo" class="form-label fw-bold">Photo:</label>
              <input type="file" name="photo" id="">
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Portfolio</button>
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
                var url = '{{ route("portfoliodetail.destroy", ":portfolio") }}';
                url = url.replace(':portfolio', id);
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