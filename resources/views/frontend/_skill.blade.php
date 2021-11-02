    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills">
        <div class="container" data-aos="fade-up">
  
          <div class="row">
            <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
              <img src="{{asset('/storage/skill/'.$skill->photo)}}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
              <h3>{!! $skill->title !!}</h3>
              <p class="fst-italic">
                {!!$skill->subtitle!!}
              </p>
  
              <div class="skills-content">

                @foreach ($skills as $skill)
                  <div class="progress">
                    <span class="skill text-uppercase">{{$skill->progressbar_title}} <i class="val">{{$skill->percentage}}%</i></span>
                    <div class="progress-bar-wrap">
                      <div class="progress-bar" role="progressbar" aria-valuenow="{{$skill->percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                @endforeach
              </div>

                {{-- <div class="progress">
                  <span class="skill">CSS <i class="val">90%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
  
                <div class="progress">
                  <span class="skill">JavaScript <i class="val">75%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
  
                <div class="progress">
                  <span class="skill">Photoshop <i class="val">55%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div> --}}
  
              </div>
  
            </div>
          </div>
  
        </div>
      </section><!-- End Skills Section -->
  