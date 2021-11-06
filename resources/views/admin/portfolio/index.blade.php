@extends('admin.layouts.app')

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

      <div class="col-lg-12">
    
        <div class="card pt-3">
          <div class="card-body">
            <!-- Vertical Form -->
            <form class="row g-3" method="POST" enctype="multipart/form-data" @if(isset($portfolio)) action="{{route('portfolio.update', $portfolio)}}" @else action="{{route('portfolio.store')}}" @endif >
             @cannot('isGuest')
               @csrf
             @endcannot 
              @if(isset($portfolio))
              @method('PUT')
              @endif

              <label for="description" class="form-label fw-bold">Description:</label>
              <div class="col-12 ">
                <span class="text-danger text-sm error-text">{{$errors->first('description')}}</span>
                <textarea type="text" name="description" class="form-control ckeditor"  id="description">
                  {{$portfolio->description ?? ''}}
                </textarea>
              </div>
              @cannot('isGuest')
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">
                    @if(isset($portfolio))
                      Update
                    @else
                      Submit
                    @endif
                  </button>
                </div>
              @endcannot
            </form><!-- Vertical Form -->
    
          </div>
        </div>
    
      </div>

    </div>
  </section>

 
  
  @endsection

  @section('scripts')

  {{-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script> --}}
  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script type="text/javascript">
      $(document).ready(function () {
          $('.ckeditor').ckeditor();
      });
  </script>
  @endsection