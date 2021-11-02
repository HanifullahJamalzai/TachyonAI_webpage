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

      <div class="card col-md-8">
        <div class="card-body">
          <!-- Vertical Form -->
          <form class="row g-3" method="POST" enctype="multipart/form-data" @if(isset($skill)) action="{{route('skill.update', $skill)}}" @else action="{{route('skill.store')}}" @endif >
            @csrf
            @if(isset($skill))
            @method('PUT')
            @endif

            <span class="text-danger text-sm error-text">{{$errors->first('title')}}</span>
            <label for="title" class="form-label fw-bold">Title:</label>
            <div class="col-12">
              <textarea type="text" name="title" class="form-control ckeditor" id="title">
                {{$skill->title ?? ''}}
              </textarea>
            </div>
            

            <div class="col-12 ">
              <label for="subtitle" class="form-label fw-bold">Subtitle:</label>
              <span class="text-danger text-sm error-text">{{$errors->first('subtitle')}}</span>
              <textarea type="text" name="subtitle" class="form-control ckeditor"  id="subtitle">
                {{$skill->subtitle ?? ''}}
              </textarea>
            </div>

            <div class="col-12 ">
              <span class="text-danger text-sm error-text">{{$errors->first('photo')}}</span>
              <input type="file" name="photo">
            </div>
            <div class="col-12">
              @if(isset($skill))
                <button type="submit" class="btn btn-primary">Update</button>
              @else
                <button type="submit" class="btn btn-primary">Submit</button>
              @endif
            </div>
          </form><!-- Vertical Form -->
  
        </div>
      </div>

      <div class=" col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Photo</h5>
            <img src="{{asset('/storage/skill/thumbnails/'.$skill->photo)}}" alt="">
          </div>
        </div>
      </div>
      

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