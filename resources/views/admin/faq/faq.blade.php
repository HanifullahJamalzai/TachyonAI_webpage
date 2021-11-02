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
              <h5 class="card-title float-left">FAQ Accordions</h5>
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
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Created at</th>
                <th scope="col" colspan="10">Answer</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
     
              <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('question')}}</span>
              <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('answer')}}</span>
                 
              @foreach ($faqs as $faq)
                <tr>
                  <th scope="row">{{$faq->id}}</th>
                  <td>{{$faq->created_at->diffforhumans()}}</td>
                  <td colspan="10">
                    <div class="accordion">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{$faq->slug}}" aria-expanded="false" aria-controls="collapseOne">
                            {!!$faq->question!!}
                          </button>
                        </h2>
                        <div id="{{$faq->slug}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                          <form method="POST" action="{{route('faqaccordion.update', $faq->slug)}}">
                            @csrf
                            @method("PUT")
                            
                            <textarea name="question" id="ckeditor" class="ckeditor" cols="30">
                              {{$faq->question}}
                            </textarea>
                            
                            <textarea name="answer" id="ckeditor" class="ckeditor" cols="30" rows="10">
                              {{$faq->answer}}
                            </textarea>

                            <button type="submit" class="btn btn-info w-100 px-2 mt-3 mb-1">Update</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="card-body">
                      <a href="#" class="btn btn-danger p-3 w-1 h-1 delete" id="{{$faq->slug}}">
                        <i class="bi bi-trash"></i>
                      </a>
                    </div>
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
        <h5 class="modal-title fw-bold">FAQs Section:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form class="row g-3" method="POST" action="{{route('faqaccordion.store')}}">
        @csrf

        <div class="modal-body">

          <div class="col-md-12">
            <label for="inputName5" class="form-label fw-bold">Question:</label>
            <textarea name="question" id="ckeditor" class="form-control ckeditor" cols="30" rows="1"></textarea>
          </div>
          
          <div class="col-md-12">
            <label for="inputName5" class="form-label fw-bold">Answer:</label>
            <textarea name="answer" id="ckeditor" class="form-control ckeditor" cols="30" rows="2"></textarea>
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
                var url = '{{ route("faqaccordion.destroy", ":faq") }}';
                url = url.replace(':faq', id);
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