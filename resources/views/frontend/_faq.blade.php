    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>Frequently Asked Questions</h2>
            <p>
              {!! $faq->description !!}
            </p>
          </div>
  
          <div class="faq-list">
            <ul>
              @php
                  $delay = 0;
              @endphp
              @foreach ($faqs as $faq)
                  
              <li data-aos="fade-up" data-aos-delay="{{$delay+100}}">
                <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-{{$faq->slug}}">
                  {!! $faq->question !!} 
                <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                <div id="faq-list-{{$faq->slug}}" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    {!! $faq->answer !!}
                  </p>
                </div>
              </li>
  
              @endforeach

            </ul>
          </div>
  
        </div>
      </section><!-- End Frequently Asked Questions Section -->
  