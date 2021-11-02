  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{$page == 'Dashboard' ? 'active' : ''}}" href="{{route('admin')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{$page == 'Hero' ? 'active' : ''}}"  href="{{route('hero.index')}}">
          <i class="bi bi-menu-button-wide"></i><span>Hero</span><i class="ms-auto"></i>
        </a>
      </li><!-- End Hero Nav -->

      <li class="nav-item">
        <a class="nav-link {{$page == 'Client' ? 'active' : ''}}"  href="{{route('client.index')}}">
          <i class="bi bi-braces"></i><span>Client</span><i class="ms-auto"></i>
          {{-- <i class="bi bi-archive"></i> --}}
        </a>
      </li><!-- End Client Nav -->

      <li class="nav-item">
        <a class="nav-link {{$page == 'About' ? 'active' : ''}}"  href="{{route('about.index')}}">
          <i class="bi bi-emoji-sunglasses"></i><span>About</span><i class="ms-auto"></i>
          {{-- <i class="bi bi-archive"></i> --}}
        </a>
      </li><!-- End About Nav -->

      <li class="nav-item">
        <a class="nav-link {{$page == 'Why' ? 'active' : ''}}" data-bs-target="#why-nav" data-bs-toggle="collapse">
          <i class="bi bi-clipboard-data"></i><span>Why-us</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="why-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('why.index')}}">
              <i class="bi bi-circle"></i><span>Why-us</span>
            </a>
          </li>
          <li>
            <a href="{{route('whyusaccordion.index')}}">
              <i class="bi bi-circle"></i><span>Why-us accordions</span>
            </a>
          </li>
        </ul>
      </li><!-- End Why Nav -->

      <li class="nav-item">
        <a class="nav-link {{$page == 'Skill' ? 'active' : ''}}" data-bs-target="#skill-nav" data-bs-toggle="collapse">
          <i class="bi bi-tools"></i><span>Skill</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="skill-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('skill.index')}}">
              <i class="bi bi-circle"></i><span>Skill</span>
            </a>
          </li>
          <li>
            <a href="{{route('skillprogress.index')}}">
              <i class="bi bi-circle"></i><span>Skill Progressbars</span>
            </a>
          </li>
        </ul>
      </li><!-- End Skill Nav -->

      <li class="nav-item">
        <a class="nav-link {{$page == 'Service' ? 'active' : ''}}" data-bs-target="#service-nav" data-bs-toggle="collapse">
          <i class="bi bi-truck"></i><span>Service</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="service-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('service.index')}}">
              <i class="bi bi-circle"></i><span>Service</span>
            </a>
          </li>
          <li>
            <a href="{{route('servicebox.index')}}">
              <i class="bi bi-circle"></i><span>Service Box</span>
            </a>
          </li>
        </ul>
      </li><!-- End Service Nav -->

      
      <li class="nav-item">
        <a class="nav-link {{$page == 'Icon' ? 'active' : ''}}" target="_blank" href="{{route('icon')}}">
          <i class="bi bi-gem"></i><span>Icons</span>
        </a>
      </li><!-- End Icons Nav -->

      <li class="nav-item">
        <a class="nav-link {{$page == 'CTA' ? 'active' : ''}}" href="{{route('cta.index')}}">
          <i class="bi bi-phone"></i><span>CTA</span>
        </a>
      </li><!-- End CTA Nav -->

      
      <li class="nav-item">
        <a class="nav-link {{$page == 'Portfolio' ? 'active' : ''}}" data-bs-target="#portfolio-nav" data-bs-toggle="collapse">
          <i class="bi bi-stack"></i><span>Portfolio</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="portfolio-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('portfolio.index')}}">
              <i class="bi bi-circle"></i><span>Portfolio Description</span>
            </a>
          </li>
          <li>
            <a href="{{route('portfoliodetail.index')}}">
              <i class="bi bi-circle"></i><span>Portfolios examples</span>
            </a>
          </li>
        </ul>
      </li><!-- End Portfolio Nav -->


      <li class="nav-item">
        <a class="nav-link {{$page == 'Team' ? 'active' : ''}}" data-bs-target="#team-nav" data-bs-toggle="collapse">
          <i class="bi bi-people-fill"></i><span>Team</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="team-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('team.index')}}">
              <i class="bi bi-circle"></i><span>Team Description</span>
            </a>
          </li>
          <li>
            <a href="{{route('teamdetail.index')}}">
              <i class="bi bi-circle"></i><span>Team member</span>
            </a>
          </li>
        </ul>
      </li><!-- End Team Nav -->


      <li class="nav-item">
        <a class="nav-link {{$page == 'Pricing' ? 'active' : ''}}" data-bs-target="#pricing-nav" data-bs-toggle="collapse">
          <i class="bi bi-currency-dollar"></i><span>Pricing</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="pricing-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('pricing.index')}}">
              <i class="bi bi-circle"></i><span>Pricing Description</span>
            </a>
          </li>
          <li>
            <a href="{{route('pricingdetail.index')}}">
              <i class="bi bi-circle"></i><span>Pricing plans</span>
            </a>
          </li>
        </ul>
      </li><!-- End Pricing Nav -->


      <li class="nav-item">
        <a class="nav-link {{$page == 'FAQ' ? 'active' : ''}}" data-bs-target="#faq-nav" data-bs-toggle="collapse">
          <i class="bi bi-question-circle"></i><span>F.A.Q</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="faq-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('faq.index')}}">
              <i class="bi bi-circle"></i><span>F.A.Q Description</span>
            </a>
          </li>
          <li>
            <a href="{{route('faqaccordion.index')}}">
              <i class="bi bi-circle"></i><span>F.A.Qs</span>
            </a>
          </li>
        </ul>
      </li><!-- End FAQ Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed {{$page == 'Contact' ? 'active' : ''}}" href="{{route('contact.index')}}">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->


      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link " href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->
