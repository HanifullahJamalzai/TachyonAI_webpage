
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>Contact</h2>
            <p>{!!$contact->description!!}</p>
          </div>
  
          <div class="row">
  
            <div class="col-lg-5 d-flex align-items-stretch">
              <div class="info">
                <div class="address">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>{{$contact->location}}</p>
                </div>
  
                <div class="email">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>{{$contact->email}}</p>
                </div>
  
                <div class="phone">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>{{$contact->call}}</p>
                </div>
  
                {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d52596.34327520399!2d69.09625864647279!3d34.521349918433515!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1635788045127!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> --}}

                <iframe src="{{$contact->map}}" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
              </div>
  
            </div>
  
            <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
              <form action="{{route('message')}}" method="POST" id="php-email-form">
                @csrf
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="name">Your Name</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name">
                    <span class="badge bg-danger">{{$errors->first('name')}}</span>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="name">Your Email</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}" id="email">
                    <span class="badge bg-danger">{{$errors->first('email')}}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="name">Subject</label>
                  <input type="text" class="form-control" name="subject" value="{{old('subject')}}" id="subject">
                  <span class="badge bg-danger">{{$errors->first('subject')}}</span>
                </div>
                <div class="form-group">
                  <label for="name">Message</label>
                  <textarea class="form-control" name="message" rows="10">{{old('message')}}</textarea>
                  <span class="badge bg-danger">{{$errors->first('message')}}</span>
                </div>
                
                <div class="text-center">
                  <button type="submit">Send Message</button>
                </div>

              </form>
            </div>
  
          </div>
  
        </div>
      </section><!-- End Contact Section -->
  
  