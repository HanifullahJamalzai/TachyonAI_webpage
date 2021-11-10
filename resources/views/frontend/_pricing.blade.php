    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>Pricing</h2>
            <p>{!! $pricing->description!!}</p>
          </div>
  
          <div class="row">

            @php
                $delay = 0;
            @endphp
            @foreach ($plans as $plan)
               
            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="{{$delay+100}}">
              <div class="box">
                <h3>{{$plan->title}}</h3>
                <h4><sup>$</sup>{{$plan->price}}<span>{{$plan->duration}}</span></h4>
                <ul>
                  {!! $plan->description !!}
                </ul>
                {{-- <a href="{{route('stripe-payment.handleGet', $plan->price)}}" class="buy-btn">Get Started</a> --}}
                <a href="#" class="buy-btn">Get Started</a>
              </div>
            </div>
   
            @endforeach
            {{-- <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
              <div class="box featured">
                <h3>Business Plan</h3>
                <h4><sup>$</sup>29<span>per month</span></h4>
                <ul>
                  <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                  <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                  <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                  <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                  <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
                </ul>
                <a href="#" class="buy-btn">Get Started</a>
              </div>
            </div>
  
            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
              <div class="box">
                <h3>Developer Plan</h3>
                <h4><sup>$</sup>49<span>per month</span></h4>
                <ul>
                  <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                  <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                  <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                  <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                  <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
                </ul>
                <a href="#" class="buy-btn">Get Started</a>
              </div>
            </div>
   --}}
          </div>
  
        </div>
      </section><!-- End Pricing Section -->
  