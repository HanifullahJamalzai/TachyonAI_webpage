    <!-- ======= Cliens Section ======= -->
    <section id="cliens" class="cliens section-bg">
        <div class="container">
  
          <div class="row" data-aos="zoom-in">
            @foreach ($clients as $client)
            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
              <img src="{{asset('/storage/client/'.$client->logo)}}" class="img-fluid" alt="{{$client->name}}" title="{{$client->name}}">
            </div>
            @endforeach
          </div>
        </div>
    </section><!-- End Cliens Section -->
  