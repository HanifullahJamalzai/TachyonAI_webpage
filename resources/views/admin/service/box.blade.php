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
              <h5 class="card-title float-left">Services:</h5>
            </div>
            
            @cannot('isGuest')
            {{-- Plus icon --}}
            <div class="col-md-4 iconslist">
                {{-- <div class="icon"> --}}
                  <a  type="button" class="float-end plus-circle" id="plus-circle" data-bs-toggle="modal" data-bs-target="#largeModal">
                    <i class="bi bi-plus-lg"></i>
                  </a>
                {{-- </div> --}}
            </div>
            {{-- end plus icon --}}
            @endcannot
          </section>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Icon</th>
                <th scope="col">Title</th>
                <th scope="col" colspan="3">Description</th>
                <th scope="col">Created at</th>
                @cannot('isGuest')
                  <th scope="col">Action</th>
                @endcannot
              </tr>
            </thead>
            <tbody>
              @foreach ($serviceboxes as $service)
              
              <div class="collapse" id="{{$service->slug}}">
                <div class="card card-body">
                  <form class="row g-3" method="POST" action="{{route('servicebox.update', $service)}}">
                    @cannot('isGuest')
                      @csrf
                    @endcannot
                    @method('PUT')
                    <div class="modal-body">
            
                        <div class="col-md-12">
                            <label for="icon" class="form-label fw-bold">Icon:</label>
                            <input type="text" name="icon" style="width: 100%; height: 40px;" value="{{$service->icon}}" placeholder="bx bxl-adobe">
                            <span class="badge badge-pill badge-info">Info</span>
                        </div>
            
                        <div class="col-md-12">
                            <label for="title" class="form-label fw-bold">Title:</label>
                            <textarea name="title" class="ckeditor" id="ckeditor" cols="30" rows="10">
                              {{$service->title}}
                            </textarea>
                        </div>
            
                      <div class="col-md-12">
                        <label for="description" class="form-label fw-bold">Description:</label>
                        <textarea name="description" id="ckeditor" class="form-control ckeditor" cols="30" rows="2">
                          {{$service->description}}
                        </textarea>
                      </div>
            
                    </div>
                    @cannot('isGuest')
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" href="#{{$service->slug}}" role="button" aria-expanded="false" aria-controls="{{$service->slug}}">Close</button>
                        <button type="submit" class="btn btn-primary">Update Service</button>
                      </div>
                    @endcannot
                  </form>
                </div>
              </div>
              
                <tr>
                  <th scope="row">{{$service->id}}</th>
                  <td>{{$service->icon}}</td>
                  <td>{!!$service->title!!}</td>
                  <td colspan="3">{!!$service->description!!}</td>
                  <td>{{$service->created_at}}</td>
                  @cannot('isGuest')
                    <td>
                      <a href="#" class="btn btn-danger p-1 w-1 h-1 delete" id="{{$service->slug}}">
                      <i class="bi bi-trash"></i>
                      </a>
                      <a class="btn btn-info p-1 w-1 h-1" data-bs-toggle="collapse" href="#{{$service->slug}}" role="button" aria-expanded="false" aria-controls="{{$service->slug}}">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                    </td>
                  @endcannot
                </tr>
              @endforeach 

            </tbody>
          </table>
          <!-- End Table with hoverable rows -->

        </div>
      </div>

    </div>
  </section>


  {{-- extra large modal  --}}
 <div class="modal fade" id="largeModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title fw-bold">Create New Service:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form class="row g-3" method="POST" action="{{route('servicebox.store')}}">
        @csrf

        <div class="modal-body">

            <div class="col-md-12">
                <label for="icon" class="form-label fw-bold">Icon:</label>
                <input type="text" name="icon" style="width: 100%; height: 40px;" placeholder="bx bxl-adobe">
                <span class="badge badge-pill badge-info">Info</span>
            </div>

            <div class="col-md-12">
                <label for="title" class="form-label fw-bold">Title:</label>
                <textarea name="title" class="ckeditor" id="ckeditor" cols="30" rows="10"></textarea>
            </div>

          <div class="col-md-12">
            <label for="description" class="form-label fw-bold">Description:</label>
            <textarea name="description" id="ckeditor" class="form-control ckeditor" cols="30" rows="2"></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Service</button>
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
                var url = '{{ route("servicebox.destroy", ":service") }}';
                url = url.replace(':service', id);
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
// var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
// var collapseList = collapseElementList.map(function (collapseEl) {
//   return new bootstrap.Collapse(collapseEl)
// })
var myCollapse = document.getElementById('myCollapse')
var bsCollapse = new bootstrap.Collapse(myCollapse, {
  toggle: false
})
</script>
  @endsection