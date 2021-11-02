
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>Portfolio</h2>
            <p>{!! $portfolio->description !!}</p>
          </div>
  
          <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            @foreach ($cat as $c)
            <li data-filter=".filter-{{$c->type}}">{{$c->type}}</li>
            @endforeach
          </ul>
  
          <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
            @foreach ($portfolios as $portfolio)
                
            <div class="col-lg-4 col-md-6 portfolio-item filter-{{$portfolio->type}}">
              <div class="portfolio-img"><img src="{{asset('storage/portfolio/'.$portfolio->photo)}}" class="img-fluid" alt=""></div>
              <div class="portfolio-info">
                <h4>{{$portfolio->title}}</h4>
                <p>{{$portfolio->type}}</p>
                <a href="{{asset('storage/portfolio/'.$portfolio->photo)}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="{{$portfolio->title}}"><i class="bx bx-plus"></i></a>
                <a href="#" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
  
            @endforeach
          </div>
  
        </div>
      </section><!-- End Portfolio Section -->
  