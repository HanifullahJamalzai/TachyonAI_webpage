    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>Services</h2>
            <p>{!!$service->description!!}</p>
          </div>
  
          <div class="row">
            @php
                $delay = 0;
            @endphp
            @foreach ($serviceboxes as $servicebox)
              <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="{{$delay+100}}">
                <div class="icon-box">
                  <div class="icon"><i class="{{$servicebox->icon}}"></i></div>
                  <h4><a href="" class="display-1"><strong>{!! $servicebox->title !!}</strong></a></h4>
                  <p>{!! $servicebox->description !!}</p>
                </div>
              </div>
            @endforeach
  
          </div>
  
        </div>
      </section><!-- End Services Section -->
  