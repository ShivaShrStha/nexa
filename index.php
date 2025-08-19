<?php
// Homepage with dynamic content capabilities
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>NexaEducationCountaltancy - Study in Japan</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
</head>
<body>
  <header class="site-header">
    <div class="topbar">
      <div class="container">
        <div class="top-left">
          <a href="mailto:info@nexaeduconsult.com" class="top-email">info@nexaeduconsult.com</a>
          <span class="sep">&nbsp;|&nbsp;</span>
          <a href="mailto:nexaeduu@gmail.com" class="top-email">nexaeduu@gmail.com</a>
          <span class="sep">&nbsp;|&nbsp;</span>
          <a href="tel:+9779851417660" class="call-link" aria-label="Call Nexa Education">+977 9851417660</a>
        </div>
      </div>
    </div>
    <div class="navwrap">
      <div class="container navcontainer">
        <a class="logo" href="/">
          <img src="assets/img/nexalogoTrans.png" alt="NexaEducation Logo" class="logo-img" style="height:90px;">
        </a>
        <!-- hamburger + overlay required by assets/js/main.js for mobile nav -->
        <button id="hamburger" class="hamburger" aria-expanded="false" aria-controls="mainnav" aria-label="Open menu">☰</button>
        <div id="navOverlay" class="nav-overlay" aria-hidden="true"></div>
        <nav class="mainnav" id="mainnav" aria-hidden="true">
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="#courses">Courses</a></li>
            <li><a href="/blog">Blog</a></li>
            <li><a href="/gallery">Gallery</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <main>
    <section class="hero reveal" id="home" style="background-image: linear-gradient(rgba(54,93,183,0.75), rgba(54,93,183,0.75)), url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&s=7b3b291180c4e0a45a8b9fb64b5c7d09');">
      <div class="container hero-inner">
        <p class="eyebrow">Nepal → Japan Student Consultancy</p>
        <h1>Study & Succeed in Japan</h1>
        <p class="lead">We help Nepali students navigate admissions, visas and pre-departure preparation for study opportunities in Japan. Trusted guidance from application to arrival.</p>
        <div class="hero-ctas">
          <a class="btn btn-primary pulse" href="#courses">Get Coaching</a>
          <a class="btn btn-outline" href="#courses">Explore Programs</a>
        </div>
      </div>
    </section>

    <section class="features container reveal">
      <h2 class="section-title">Choose Mentorship</h2>
      <p class="section-sub">Personalised mentorship for Nepali students aiming to study in Japan — application support, test prep and cultural orientation to ensure a successful start.</p>
      <div class="feature-grid">
        <div class="feature">
          <div class="f-icon">
            <!-- book icon -->
            <svg class="icon-svg" width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M3 6.5A2.5 2.5 0 0 1 5.5 4H19" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M3 19.5A2.5 2.5 0 0 0 5.5 22H19" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M3 6.5v13M5.5 4v18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <h3>Pre-departure Coaching</h3>
          <p>Personalised coaching to prepare academically and culturally for life and study in Japan.</p>
          <a class="btn btn-small" href="#">View Program</a>
        </div>
        <div class="feature">
          <div class="f-icon">
            <!-- passport icon -->
            <svg class="icon-svg" width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <rect x="3" y="4" width="14" height="16" rx="2" stroke="currentColor" stroke-width="1.6"/>
              <path d="M7 8h8M7 12h8M7 16h4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <h3>Visa & Admission Support</h3>
          <p>Step-by-step assistance with university applications, visa processing and document verification.</p>
          <a class="btn btn-small" href="#">Read More</a>
        </div>
        <div class="feature">
          <div class="f-icon">
            <!-- materials icon -->
            <svg class="icon-svg" width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M4 6h16M4 12h16M4 18h10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="18" cy="18" r="3" stroke="currentColor" stroke-width="1.6"/>
            </svg>
          </div>
          <h3>Study Materials</h3>
          <p>Curated resources and practice materials for language tests and entrance requirements.</p>
          <a class="btn btn-small" href="#">Shop Now</a>
        </div>
      </div>
    </section>

    <section class="courses reveal" id="courses">
      <div class="container">
        <h2 class="section-title">Our Courses</h2>
        <p class="section-sub">Explore our language, admissions and career-prep programs designed to prepare Nepali students for studying and living in Japan.</p>
        <div class="card-grid">
          <article class="card">
            <img src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=7f0b8f9f5ff30ec8f9f1e6d7b2c8e2f6"
                 srcset="https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=400 400w, https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=800 800w, https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=1200 1200w"
                 sizes="(max-width:640px) 100vw, (max-width:1000px) 48vw, 33vw"
                 loading="lazy" alt="Japanese Language Prep">
            <div class="card-body">
              <h3>Japanese Language Prep</h3>
              <p class="meta">Program by NexaEducationCountaltancy</p>
              <p class="excerpt">Intensive Japanese language courses tailored for entrance exams and daily life in Japan.</p>
              <a class="btn btn-small" href="#">View Program</a>
            </div>
          </article>

          <article class="card">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=7a3c85f4e6c96e1b5c3e6b067f6a4b1a"
                 srcset="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=400 400w, https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=800 800w, https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200 1200w"
                 sizes="(max-width:640px) 100vw, (max-width:1000px) 48vw, 33vw"
                 loading="lazy" alt="University Admission Guidance">
            <div class="card-body">
              <h3>University Admission Guidance</h3>
              <p class="meta">Program by NexaEducationCountaltancy</p>
              <p class="excerpt">One-on-one support for selecting programs, preparing applications and writing impactful statements.</p>
              <a class="btn btn-small" href="#">View Program</a>
            </div>
          </article>

          <article class="card">
            <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3"
                 srcset="https://images.unsplash.com/photo-1464983953574-0892a716854b?q=80&w=400 400w, https://images.unsplash.com/photo-1464983953574-0892a716854b?q=80&w=800 800w, https://images.unsplash.com/photo-1464983953574-0892a716854b?q=80&w=1200 1200w"
                 sizes="(max-width:640px) 100vw, (max-width:1000px) 48vw, 33vw"
                 loading="lazy" alt="Career Pathways in Japan - Modern Tokyo skyline with business district">
            <div class="card-body">
              <h3>Career Pathways in Japan</h3>
              <p class="meta">Program by NexaEducationCountaltancy</p>
              <p class="excerpt">Comprehensive guidance on internships, part-time work opportunities, and diverse career paths available for international students in Japan's dynamic job market.</p>
              <a class="btn btn-small" href="/career-pathways">View Program</a>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- Career Pathways in Japan Section -->
    <section class="career-pathways container reveal" style="padding: 80px 0; background: linear-gradient(180deg, #f8faff 0%, #ffffff 100%);">
      <h2 class="section-title">Career Pathways in Japan</h2>
      <p class="section-sub">Discover diverse career opportunities and pathways for Nepali students in Japan. From technology to healthcare, Japan offers exceptional career prospects for international graduates.</p>
      
      <div class="pathway-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 40px; margin-top: 48px;">
        <div class="pathway-item" style="background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(102, 126, 234, 0.08); transition: all 0.3s ease;">
          <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=800&auto=format&fit=crop" 
               alt="Technology Careers" 
               style="width: 100%; height: 200px; object-fit: cover;">
          <div style="padding: 24px;">
            <h3 style="color: #2c3e50; margin-bottom: 12px;">Technology & Engineering</h3>
            <p style="color: #5a6c7d; line-height: 1.6; margin-bottom: 16px;">Japan leads in robotics, AI, and automotive technology. Great opportunities in companies like Sony, Toyota, and Honda.</p>
            <ul style="color: #667eea; margin: 0; padding-left: 20px;">
              <li>Software Development</li>
              <li>Robotics Engineering</li>
              <li>Automotive Design</li>
              <li>AI & Machine Learning</li>
            </ul>
          </div>
        </div>
        
        <div class="pathway-item" style="background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(102, 126, 234, 0.08); transition: all 0.3s ease;">
          <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?q=80&w=800&auto=format&fit=crop" 
               alt="Business Careers" 
               style="width: 100%; height: 200px; object-fit: cover;">
          <div style="padding: 24px;">
            <h3 style="color: #2c3e50; margin-bottom: 12px;">Business & Finance</h3>
            <p style="color: #5a6c7d; line-height: 1.6; margin-bottom: 16px;">Japan's robust economy offers excellent opportunities in banking, consulting, and international trade.</p>
            <ul style="color: #667eea; margin: 0; padding-left: 20px;">
              <li>Investment Banking</li>
              <li>Management Consulting</li>
              <li>International Trade</li>
              <li>Corporate Strategy</li>
            </ul>
          </div>
        </div>
        
        <div class="pathway-item" style="background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(102, 126, 234, 0.08); transition: all 0.3s ease;">
          <img src="https://images.unsplash.com/photo-1559757175-0eb30cd8c063?q=80&w=800&auto=format&fit=crop" 
               alt="Healthcare & Research - Medical professionals in modern Japanese laboratory" 
               style="width: 100%; height: 200px; object-fit: cover;">
          <div style="padding: 24px;">
            <h3 style="color: #2c3e50; margin-bottom: 12px;">Healthcare & Research</h3>
            <p style="color: #5a6c7d; line-height: 1.6; margin-bottom: 16px;">Japan's advanced healthcare system offers world-class opportunities in medical research, pharmaceuticals, and cutting-edge biotechnology innovation.</p>
            <ul style="color: #667eea; margin: 0; padding-left: 20px;">
              <li>Medical Research & Clinical Trials</li>
              <li>Pharmaceutical Development</li>
              <li>Biotechnology & Genomics</li>
              <li>Healthcare Administration</li>
            </ul>
          </div>
        </div>
        
        <div class="pathway-item" style="background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(102, 126, 234, 0.08); transition: all 0.3s ease;">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=800&auto=format&fit=crop" 
               alt="Education Careers" 
               style="width: 100%; height: 200px; object-fit: cover;">
          <div style="padding: 24px;">
            <h3 style="color: #2c3e50; margin-bottom: 12px;">Education & Research</h3>
            <p style="color: #5a6c7d; line-height: 1.6; margin-bottom: 16px;">Teaching opportunities and academic research positions in prestigious Japanese universities and institutions.</p>
            <ul style="color: #667eea; margin: 0; padding-left: 20px;">
              <li>University Teaching</li>
              <li>Academic Research</li>
              <li>Language Education</li>
              <li>Educational Technology</li>
            </ul>
          </div>
        </div>
        
        <div class="pathway-item" style="background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(102, 126, 234, 0.08); transition: all 0.3s ease;">
          <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?q=80&w=800&auto=format&fit=crop" 
               alt="Creative Industries" 
               style="width: 100%; height: 200px; object-fit: cover;">
          <div style="padding: 24px;">
            <h3 style="color: #2c3e50; margin-bottom: 12px;">Creative Industries</h3>
            <p style="color: #5a6c7d; line-height: 1.6; margin-bottom: 16px;">Japan's rich culture industry offers opportunities in animation, gaming, fashion, and media production.</p>
            <ul style="color: #667eea; margin: 0; padding-left: 20px;">
              <li>Animation & Manga</li>
              <li>Game Development</li>
              <li>Fashion Design</li>
              <li>Media Production</li>
            </ul>
          </div>
        </div>
        
        <div class="pathway-item" style="background: #fff; border-radius: 20px; overflow: hidden; box-shadow: 0 8px 32px rgba(102, 126, 234, 0.08); transition: all 0.3s ease;">
          <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=800&auto=format&fit=crop" 
               alt="Hospitality & Tourism" 
               style="width: 100%; height: 200px; object-fit: cover;">
          <div style="padding: 24px;">
            <h3 style="color: #2c3e50; margin-bottom: 12px;">Hospitality & Tourism</h3>
            <p style="color: #5a6c7d; line-height: 1.6; margin-bottom: 16px;">Growing tourism industry with opportunities in hotel management, event planning, and cultural exchange programs.</p>
            <ul style="color: #667eea; margin: 0; padding-left: 20px;">
              <li>Hotel Management</li>
              <li>Event Planning</li>
              <li>Tour Operations</li>
              <li>Cultural Exchange</li>
            </ul>
          </div>
        </div>
      </div>
      
      <div style="text-align: center; margin-top: 40px;">
        <a class="btn btn-primary" href="#courses" style="padding: 16px 32px; font-size: 1.1rem;">Explore Our Career Prep Programs</a>
      </div>
    </section>

    <section class="counters reveal">
      <div class="container counter-inner">
        <div class="counter-item">
          <div class="count" data-target="12">0</div>
          <div class="count-label">Years Experience</div>
        </div>
        <div class="counter-item">
          <div class="count" data-target="182">0</div>
          <div class="count-label">Books & DVDs</div>
        </div>
        <div class="counter-item">
          <div class="count" data-target="102">0</div>
          <div class="count-label">Business Growth</div>
        </div>
        <div class="counter-item">
          <div class="count" data-target="322">0</div>
          <div class="count-label">Articles</div>
        </div>
      </div>
    </section>

    <section class="why container reveal">
      <h2 class="section-title">Why Choose our Courses</h2>
      <p class="section-sub">Expert guidance on admissions, visa processing, scholarships and job-readiness — we make the transition from Nepal to Japan smooth and reliable.</p>

      <div class="why-grid">
        <div class="why-left">
          <div class="why-item"><span class="check">✔</span>
            <div>
              <h4>Lower total costs</h4>
              <p>Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</p>
            </div>
          </div>

          <div class="why-item"><span class="check">✔</span>
            <div>
              <h4>Variety of programs and courses</h4>
              <p>Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</p>
            </div>
          </div>

          <div class="why-item"><span class="check">✔</span>
            <div>
              <h4>More comfortable learning</h4>
              <p>Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</p>
            </div>
          </div>
        </div>

        <aside class="request-card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 420px; background: #fff; border-radius: 18px; box-shadow: 0 8px 32px rgba(102,126,234,0.10); padding: 40px 32px; max-width: 420px; margin: 0 auto;">
          <h3 style="font-size: 2rem; font-weight: 700; color: #222; text-align: center; margin-bottom: 8px;">Request Free Course</h3>
          <div style="width: 60px; height: 4px; background: linear-gradient(90deg,#667eea,#764ba2); border-radius: 2px; margin: 0 auto 24px auto;"></div>
          <form id="requestForm" style="width: 100%; display: flex; flex-direction: column; gap: 18px;">
            <div style="display: flex; gap: 16px; width: 100%;">
              <input name="first_name" placeholder="First name" required style="flex:1; min-width:0; padding: 14px 12px; font-size: 1.05rem; border-radius: 8px; border: 1px solid #e3e6f0; background: #f8faff;">
              <input name="last_name" placeholder="Last name" required style="flex:1; min-width:0; padding: 14px 12px; font-size: 1.05rem; border-radius: 8px; border: 1px solid #e3e6f0; background: #f8faff;">
            </div>
            <div style="display: flex; gap: 16px; width: 100%;">
              <input name="email" type="email" placeholder="Email Address" required style="flex:1; min-width:0; padding: 14px 12px; font-size: 1.05rem; border-radius: 8px; border: 1px solid #e3e6f0; background: #f8faff;">
              <input name="phone" placeholder="Phone Number" required style="flex:1; min-width:0; padding: 14px 12px; font-size: 1.05rem; border-radius: 8px; border: 1px solid #e3e6f0; background: #f8faff;">
            </div>
            <input name="subject" placeholder="Subject" class="full" required style="padding: 14px 12px; font-size: 1.05rem; border-radius: 8px; border: 1px solid #e3e6f0; background: #f8faff;">
            <button class="btn btn-primary full" type="submit" style="padding: 16px 0; font-size: 1.1rem; border-radius: 8px; margin-top: 8px;">Get Free Course Now</button>
            <div class="form-message" id="requestMessage" style="display:none; margin-top:10px; padding:10px; border-radius:5px;"></div>
          </form>
        </aside>
      </div>
    </section>

    <section class="testimonials reveal">
      <div class="container testimonials-inner">
        <h2 class="section-title">Student Testimonials</h2>
        <p class="section-sub">Hear from Nepali students who succeeded in Japan with NexaEducationCountaltancy's guidance.</p>
        <div class="testimonial-slider" id="testimonialSlider">
          <!-- Slides will be injected by JS -->
        </div>
      </div>
    </section>

    <section class="newsletter reveal">
      <div class="container newsletter-inner">
        <div>
          <h3>Subscribe Now to Our Newsletter !</h3>
          <p>Stay updated with the latest news, study opportunities, and success stories for Nepali students pursuing education in Japan.</p>
        </div>
        <form class="newsletter-form" id="newsletterForm">
          <input name="email" placeholder="Enter your email" type="email" required>
          <button id="newsletterBtn" class="btn btn-dark micro" type="submit">Subscribe</button>
          <div class="form-message" id="newsletterMessage" style="display:none; margin-top:10px; padding:8px; border-radius:5px; font-size:0.9rem;"></div>
        </form>
      </div>
    </section>
  </main>
  

  <footer class="site-footer">
    <div class="container footer-grid">
      <div>
        <h4>Useful Links</h4>
        <ul>
          <li><a href="/about">About us</a></li>
          <li><a href="#courses">Courses</a></li>
          <li>Pages</li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="/contact">Contact</a></li>
        </ul>
      </div>

     
      <div>
        <h4>Social links</h4>
        <ul>
          <li>Facebook</li>
          <li>Twitter</li>
          <li>Google Plus</li>
          <li>Youtube</li>
          <li>Linkedin</li>
          <li>Instagram</li>
        </ul>
      </div>

      <div>
        <h4>Recent Blog Posts</h4>
        <ul>
          <li><a href="/blog" style="color: #ccc; text-decoration: none;">Japanese University Admissions</a> - Aug 16, 2025</li>
          <li><a href="/blog" style="color: #ccc; text-decoration: none;">Visa Application Tips</a> - July 16, 2025</li>
        </ul>
      </div>
      <div class="footer-facebook">
        <h4>Follow us on Facebook</h4>
        <div class="fb-page-embed">
          <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fnexaeduconsult&tabs=timeline&width=340&height=180&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="180" style="border:none;overflow:hidden;border-radius:10px;" scrolling="yes" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </div>
      </div>
    </div>

    <div class="container copyright">Copyright NexaEducationCountaltancy | All right Reserved</div>
  </footer>

  <script src="assets/js/main.js"></script>
</body>
</html>
