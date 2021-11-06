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
            <form class="row g-3" method="POST" enctype="multipart/form-data" @if(isset($service)) action="{{route('service.update', $service)}}" @else action="{{route('service.store')}}" @endif >
             @cannot('isGuest')
               @csrf
             @endcannot
              @if(isset($service))
              @method('PUT')
              @endif

              <label for="title" class="form-label fw-bold text-center">Service Description</label>
              <span class="text-danger text-sm error-text">{{$errors->first('description')}}</span>
              <div class="col-12">
                <textarea type="text" name="description" class="form-control ckeditor" id="ckeditor">
                  {{$service->description ?? ''}}
                </textarea>
              </div>
              @cannot('isGuest')
                <div class="col-12">
                  <button type="submit" class="btn btn-primary col-md-12">
                    @if(isset($service))
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

{{--       
      <div class=" col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Photo</h5>
            <img src="{{$hero->photo ? asset('/storage/hero/thumbnails/'.$hero->photo) : asset('admin_assets/img/not-found.svg')}}" alt="">
          </div>
        </div>
      </div>
       --}}

    </div>
  </section>

 
  
  @endsection

  @section('scripts')

  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script type="text/javascript">
      $(document).ready(function () {
          $('.ckeditor').ckeditor();
      });
  </script>
  @endsection