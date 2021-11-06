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

      @cannot('isGuest')
        <div class="card">
          <div class="card-body pt-4">

            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" enctype="multipart/form-data" @if(isset($skill)) action="{{route('skillprogress.update', $skill)}}" @else  action="{{route('skillprogress.store')}}" @endif>
              @csrf
              @if(isset($skill))
              @method('PUT')
              @endif

              <div class="col-md-4">
                <input type="text" name="progressbar_title" class="form-control" @if(isset($skill)) value="{{$skill->progressbar_title}}" @endif  placeholder="Progress bar title">
                <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('progressbar_title')}}</span>
              </div>

              <div class="col-md-4">
                <input type="number" name="percentage" @if(isset($skill)) value="{{$skill->percentage}}" @endif class="form-control" placeholder="0 - 100 ">
                <span class="text-dark" style="font-size: 12px"><span class="text-danger"> {{$errors->first('percentage')}}</span>
              </div>
              
              <div class="col-md-4">
                @if (isset($skill))
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
      @endcannot

      <div class="card">
        <div class="card-body">

          <section class="row">


            <div class="col-md-8">
              <h5 class="card-title float-left">Skills data table</h5>
            </div>
          </section>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Percentage</th>
                <th scope="col">Create Date</th>
                @cannot('isGuest')
                  <th scope="col">Action</th>
                @endcannot
              </tr>
            </thead>
            <tbody>
              @foreach ($skills as $skill)
                <tr>
                  <th scope="row">{{$skill->id}}</th>
                  <td>{{$skill->progressbar_title}}</td>
                  <td>{{$skill->percentage}}</td>
                  <td>{{$skill->created_at->diffforhumans()}}</td>
                  @cannot('isGuest')
                    <td>
                      <div class="card-body">
                        <a href="#" class="btn btn-danger p-1 w-1 h-1 delete" id="{{$skill->slug}}">
                          <i class="bi bi-trash"></i>
                        </a>
                        <a href="{{route('skillprogress.edit', $skill->slug)}}" class="btn btn-info p-1 w-1 h-1">
                          <i class="bi bi-pencil-square"></i>
                        </a>
                      </div>
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
                var url = '{{ route("skillprogress.destroy", ":skill") }}';
                url = url.replace(':skill', id);
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