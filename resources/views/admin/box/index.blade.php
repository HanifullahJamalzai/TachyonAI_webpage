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
        <div class="card-body">

          <section class="row">

            <div class="col-md-8">
              <h5 class="card-title float-left">Inbox</h5>
            </div>
            
          </section>

          <!-- Table with hoverable rows -->
          
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">status</th>
                <th scope="col">Subject</th>
                <th scope="col" colspan="4">Message</th>
                <th scope="col">Recieved time</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($msgs)
                
                  @foreach ($msgs as $msg)
                  <tr>
                    <th scope="row">{{$msg->id}}</th>
                    <th><span class="badge bg-{{$msg->status == 0 ? 'success': 'secondary'}}">{{$msg->status == 0 ? 'Delivered': 'Seen'}}</span></th>
                    <td>{{$msg->subject}}</td>
  
                    <td colspan="4">
                      <div class="accordion">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{$msg->slug}}" aria-expanded="false" aria-controls="collapseOne">
                              {{$msg->email}}
                            </button>
                          </h2>
                          <div id="{{$msg->slug}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                            <form method="POST" action="{{route('box.update', $msg->slug)}}">
                              @csrf
                              @method("PUT")
                              
                              <textarea name="title" rows="10" cols="50">
                                {{$msg->message}}
                              </textarea>
                              @if ($msg->status == 0)
                              <button type="submit" class="btn btn-info w-100 px-2 mt-3 mb-1">Put in Seen-Messages list</button>
                              @endif
                            </form>
                          </div>
                        </div>
                      </div>
                    </td>
                    
                    <td>{{$msg->created_at->diffforhumans()}}</td>
  
                    <td>
                      <div class="card-body">
                        <a href="#" class="btn btn-danger p-3 w-1 h-1 delete" id="{{$msg->slug}}">
                          <i class="bi bi-trash"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
              @else
                
              <h2>Inbox is Empty</h2>
              
              @endif

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
                var url = '{{ route("box.destroy", ":msg") }}';
                url = url.replace(':msg', id);
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