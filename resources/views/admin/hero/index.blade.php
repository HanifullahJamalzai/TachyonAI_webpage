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

      <div class="col-lg-8">
    
        <div class="card pt-3">
          <div class="card-body">
            <!-- Vertical Form -->
            <form class="row g-3" method="POST" enctype="multipart/form-data" @if(isset($hero)) action="{{route('hero.update', $hero)}}" @else action="{{route('hero.store')}}" @endif >
              @cannot('isGuest')
                @csrf
              @endcannot
              @if(isset($hero))
              @method('PUT')
              @endif

              <label for="title" class="form-label fw-bold">Title here:</label>
              <span class="text-danger text-sm error-text">{{$errors->first('title')}}</span>
              <div class="col-12">
                <textarea type="text" name="title" class="form-control ckeditor" id="title">
                  {{$hero->title ?? ''}}
                </textarea>
              </div>
              

              <label for="subtitle" class="form-label fw-bold">Subtitle here:</label>
              <div class="col-12 ">
                <span class="text-danger text-sm error-text">{{$errors->first('subtitle')}}</span>
                <textarea type="text" name="subtitle" class="form-control ckeditor"  id="subtitle">
                  {{$hero->subtitle ?? ''}}
                </textarea>
              </div>

              <div class="col-12">
                <label for="videolink" class="form-label fw-bold">Youtube Video Link:</label>
                <input type="text" name="video_link" class="form-control" value="{{$hero->video_link ?? old('video_link')}}" placeholder="Past link here" id="videolink">
              </div>
              
              <div class="col-12">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" name="photo" class="form-control" value="{{$hero->photo ?? ''}}" id="photo">
              </div>
              @cannot('isGuest')
                
              <div class="col-12">
                <button type="submit" class="btn btn-primary">
                  @if(isset($hero))
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

      
      <div class=" col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Photo</h5>
            <img src="{{$hero->photo ? asset('/storage/hero/thumbnails/'.$hero->photo) : asset('admin_assets/img/not-found.svg')}}" alt="">
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