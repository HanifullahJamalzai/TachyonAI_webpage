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
              <h5 class="card-title float-left">Why-Us Accordions</h5>
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
                <th scope="col">Created at</th>
                <th scope="col" colspan="10">Title</th>
                @cannot('isGuest')
                  <th scope="col">Action</th>
                @endcannot
              </tr>
            </thead>
            <tbody>
              
              @foreach ($accordions as $accordion)
                <tr>
                  <th scope="row">{{$accordion->id}}</th>
                  <td>{{$accordion->created_at->diffforhumans()}}</td>
                  <td colspan="10">
                    <div class="accordion">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{$accordion->slug}}" aria-expanded="false" aria-controls="collapseOne">
                            {!!$accordion->title!!}
                          </button>
                        </h2>
                        <div id="{{$accordion->slug}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                          <form method="POST" action="{{route('whyusaccordion.update', $accordion->slug)}}">
                            @cannot('isGuest')
                              @csrf
                            @endcannot
                            @method("PUT")
                            
                            <textarea name="title" id="ckeditor" class="ckeditor" cols="30">
                              {{$accordion->title}}
                            </textarea>
                            
                            <textarea name="description" id="ckeditor" class="ckeditor" cols="30" rows="10">
                              {{$accordion->description}}
                            </textarea>
                            @cannot('isGuest')
                              <button type="submit" class="btn btn-info w-100 px-2 mt-3 mb-1">Update</button>
                            @endcannot
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    @cannot('isGuest')
                      
                    <div class="card-body">
                      <a href="#" class="btn btn-danger p-3 w-1 h-1 delete" id="{{$accordion->slug}}">
                        <i class="bi bi-trash"></i>
                      </a>
                    </div>
                    
                    @endcannot
                  </td>
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
        <h5 class="modal-title fw-bold">Create New Accordion for Why-us Section:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form class="row g-3" method="POST" action="{{route('whyusaccordion.store')}}">
        @csrf

        <div class="modal-body">

          <div class="col-md-12">
            <label for="inputName5" class="form-label fw-bold">Title:</label>
            <textarea name="title" id="ckeditor" class="form-control ckeditor" cols="30" rows="1"></textarea>
          </div>
          
          <div class="col-md-12">
            <label for="inputName5" class="form-label fw-bold">Description:</label>
            <textarea name="description" id="ckeditor" class="form-control ckeditor" cols="30" rows="2"></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add accordion</button>
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
                var url = '{{ route("whyusaccordion.destroy", ":accordion") }}';
                url = url.replace(':accordion', id);
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
  @endsection