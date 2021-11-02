

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">
  
          <div class="row">
  
            <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">
  
              <div class="content">
                <h3>{!!$why->title!!}</h3>
                <p>{!! $why->subtitle !!}</p>
              </div>
  
              <div class="accordion-list">
                <ul>
                  @php $num = 1; @endphp
                  @foreach ($whyusaccordion as $accordion)
                    <li>
                      <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-{{$accordion->id}}"><span>0{{$num++}}</span>{!!$accordion->title!!}<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>

                      <div id="accordion-list-{{$accordion->id}}" class="collapse" data-bs-parent=".accordion-list">
                        <p>{!!$accordion->description!!}</p>
                      </div>
                    </li>

                  @endforeach
                </ul>
              </div>
  
            </div>
  
            <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("{{asset('/storage/whyUs/'.$why->photo)}}");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
          </div>
  
        </div>
      </section><!-- End Why Us Section -->
  