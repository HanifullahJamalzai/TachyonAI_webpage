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

  
  <section class="section contact">

    <div class="row gy-4">

      <div class="col-xl-12">
        <div class="card p-4">

        <form class="row g-3" method="POST" @if(isset($contact)) action="{{route('contact.update', $contact)}}" @else  action="{{route('contact.store')}}" @endif>
            @csrf
            @if(isset($contact))
            @method('PUT')
            @endif

            <div class="row gy-4">

              <div class="col-md-6">
                <input type="text" name="location" value="{{$contact->location}}" class="form-control" placeholder="Location">
                <span style="font-size: 12px" style="font-size: 12px" >{{$errors->first('location')}}</span>
              </div>

              <div class="col-md-6 ">
                <input type="text" class="form-control" name="email" value="{{$contact->email}}" placeholder="Contact Email">
                <span style="font-size: 12px" style="font-size: 12px" >{{$errors->first('email')}}</span>
              </div>

              <div class="col-md-6">
                <input type="number" name="call" value="{{$contact->call}}" class="form-control" placeholder="Contact Number">
                <span style="font-size: 12px" style="font-size: 12px" >{{$errors->first('call')}}</span>
              </div>

              <div class="col-md-6 ">
                <input type="text" class="form-control" name="map" value="{{$contact->map}}" placeholder="Map">
                <span style="font-size: 12px" style="font-size: 12px" >{{$errors->first('map')}}</span>
              </div>

              <div class="col-md-12">
                <textarea class="form-control ckeditor" id="ckeditor" name="description" rows="6" placeholder="Message">
                    {{$contact->description}}
                </textarea>
              </div>
              <span style="font-size: 12px" style="font-size: 12px" >{{$errors->first('description')}}</span>

              @if (isset($contact))
              <button type="submit" class="btn btn-primary">Update</button>
              @else
              <button type="submit" class="btn btn-primary">Submit</button>
              @endif
            </div>
            
            </div>
          </form>
        </div>

      </div>

    </div>

  </section>

  
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
                var url = '{{ route("client.destroy", ":client") }}';
                url = url.replace(':client', id);
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