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

      <div class="card col-md-12">
        <div class="card-body">
          <!-- Vertical Form -->
          <form class="row g-3" method="POST" @if(isset($faq)) action="{{route('faq.update', $faq)}}" @else action="{{route('faq.store')}}" @endif >
            @cannot('isGuest')
              @csrf
            @endcannot  
            @if(isset($faq))
            @method('PUT')
            @endif

            <span class="text-danger text-sm error-text">{{$errors->first('description')}}</span>
            <label for="title" class="form-label fw-bold text-center">Description:</label>
            <div class="col-12">
              <textarea type="text" name="description" class="form-control ckeditor" id="title">
                {{$faq->description ?? ''}}
              </textarea>
            </div>

            @cannot('isGuest')
              
            <div class="col-12">
              @if(isset($faq))
                <button type="submit" class="btn btn-primary">Update</button>
              @else
                <button type="submit" class="btn btn-primary">Submit</button>
              @endif
            </div>
            
            @endcannot
          </form><!-- Vertical Form -->
  
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