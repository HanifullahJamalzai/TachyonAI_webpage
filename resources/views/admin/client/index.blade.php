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

      <div class="card">
        <div class="card-body pt-4">
          {{-- <h5 class="card-title">Multi Columns Form</h5> --}}

          <!-- Multi Columns Form -->
          <form class="row g-3" method="POST" enctype="multipart/form-data" @if(isset($client)) action="{{route('client.update', $client)}}" @else  action="{{route('client.store')}}" @endif>
            @csrf
            @if(isset($client))
            @method('PUT')
            @endif

            <div class="col-md-4">
              <input type="text" name="name" class="form-control" @if(isset($client)) value="{{$client->name}}" @endif  placeholder="Name here">
              <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('name')}}</span>
              {{-- *</span>Write name of your client here</s> --}}
            </div>
            <div class="col-md-4">
              <input type="file" name="logo" @if(isset($client)) value="{{$client->logo}}" @endif class="form-control">
              <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('logo')}}</span>
            </div>
            <div class="col-md-4">
              @if (isset($client))
              <button type="submit" class="btn btn-info">Update</button>
              @else
              <button type="submit" class="btn btn-primary">Submit</button>
              @endif
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form>
          <!-- End Multi Columns Form -->
        </div>
      </div>

      <div class="card">
        <div class="card-body">

          <section class="row">


            <div class="col-md-8">
              <h5 class="card-title float-left">Client data table</h5>
            </div>

            {{-- Plus icon --}}
            {{-- <div class="col-md-4  float-right iconslist">
                <div class="icon">
                  <i class="bi bi-plus-circle-fill"></i>
                </div>
            </div> --}}
            {{-- end plus icon --}}
            
          </section>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Logo</th>
                <th scope="col">Name</th>
                <th scope="col">Create Date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($clients as $client)
                <tr>
                  <th scope="row">{{$client->id}}</th>
                  <td>
                    <img src="{{asset('/storage/client/thumbnails/'.$client->logo)}}" alt="">
                  </td>
                  <td>{{$client->name}}</td>
                  <td>{{$client->created_at->diffforhumans()}}</td>
                  <td>
                    <div class="card-body">
                      <a href="#" class="btn btn-danger p-1 w-1 h-1 delete" id="{{$client->slug}}">
                        <i class="bi bi-trash"></i>
                      </a>
                      <a href="{{route('client.edit', $client)}}" class="btn btn-info p-1 w-1 h-1">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      {{-- <button type="button" class="btn btn-danger w-3 h-3"><i class="bi bi-trash"></i></button> --}}
                      {{-- <button type="button" class="btn btn-info w-3 h-3"><i class="bi bi-pencil-square"></i></button> --}}
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

  @endsection