<?php
// Copyright © 2025 Shiva Sharan Shrestha. All rights reserved. This code is part of NexaEducationCountaltancy.
// About page - no dynamic content needed yet
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>About Us | NexaEducationCountaltancy</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
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
          <img src="assets/img/nexalogoTrans.png" alt="NexaEducation Logo" class="logo-img" style="height:60px;">
        </a>
        <!-- hamburger + overlay required by assets/js/main.js for mobile nav -->
        <button id="hamburger" class="hamburger" aria-expanded="false" aria-controls="mainnav" aria-label="Open menu">☰</button>
        <div id="navOverlay" class="nav-overlay" aria-hidden="true"></div>
        <nav class="mainnav" id="mainnav" aria-hidden="true">
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/#courses">Courses</a></li>
            <li><a href="/blog">Blog</a></li>
            <li><a href="/gallery">Gallery</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
  <header class="about-header" style="background: #3661b7; color: #fff; padding: 48px 0; text-align: center;">
    <h1 style="font-size:2.4rem; font-weight:800; margin-bottom:12px;">About NexaEducationCountaltancy</h1>
    <p style="font-size:1.2rem; font-weight:400; margin-bottom:18px;">Empowering Nepali students for success in Japan through expert guidance, mentorship, and support.</p>
    <div class="container">
      <div class="top-left" style="font-size:1.1rem; font-weight:600; color:#eaf0ff; margin-top:10px;">
        <a href="mailto:info@nexaeduconsult.com" class="top-email" style="color:#eaf0ff; text-decoration:underline;">info@nexaeduconsult.com</a>
        <span class="sep">&nbsp;|&nbsp;</span>
        <a href="tel:+0477333454221" class="call-link" aria-label="Call Nexa Education" style="color:#eaf0ff; text-decoration:underline;">+04 77 333 454 221</a>
      </div>
    </div>
  </header>
  <main class="about-main">
    <section class="about-section">
      <div class="about-title">Our Mission</div>
      <div class="about-text">
        NexaEducationCountaltancy is dedicated to helping Nepali students achieve their dreams of studying in Japan. We provide personalized mentorship, admissions support, and cultural orientation to ensure a smooth transition and successful academic journey.
      </div>
    </section>
    <section class="about-section">
      <div class="about-title">Meet Our Team</div>
      <div class="about-grid">
        <div class="about-card">
          <img src="https://images.unsplash.com/photo-1511367461989-f85a21fda167?auto=format&fit=crop&w=400&q=80" alt="Founder" class="about-img">
          <div class="about-card-title">Shiva Sharan Shrestha</div>
          <div class="about-card-desc">Founder & Lead Consultant. 12+ years guiding students to top Japanese universities.</div>
        </div>
        <div class="about-card">
          <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=400&q=80" alt="Mentor" class="about-img">
          <div class="about-card-title">Mina Tamang</div>
          <div class="about-card-desc">Admissions Mentor. Expert in visa, scholarships, and university selection.</div>
        </div>
        <div class="about-card">
          <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?auto=format&fit=crop&w=400&q=80" alt="Language Coach" class="about-img">
          <div class="about-card-title">Ryohei Sato</div>
          <div class="about-card-desc">Japanese Language Coach. Native speaker, JLPT prep specialist.</div>
        </div>
      </div>
    </section>
    <section class="about-section">
      <div class="about-title">Why Choose Us?</div>
      <div class="about-grid">
        <div class="about-card">
          <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80" alt="Support" class="about-img">
          <div class="about-card-title">Personalized Support</div>
          <div class="about-card-desc">One-on-one guidance from application to arrival in Japan.</div>
        </div>
        <div class="about-card">
          <img src="https://images.unsplash.com/photo-1503676382389-4809596d5290?auto=format&fit=crop&w=400&q=80" alt="Network" class="about-img">
          <div class="about-card-title">Strong Network</div>
          <div class="about-card-desc">Connections with top universities, language schools, and employers.</div>
        </div>
        <div class="about-card">
          <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=400&q=80" alt="Success" class="about-img">
          <div class="about-card-title">Proven Success</div>
          <div class="about-card-desc">Hundreds of students placed in leading Japanese institutions.</div>
        </div>
      </div>
    </section>
  </main>
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
  <footer class="site-footer">
    <div class="container footer-grid">
      <div>
        <h4>Useful Links</h4>
        <ul>
          <li><a href="/about">About us</a></li>
          <li><a href="/#courses">Courses</a></li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="/gallery">Gallery</a></li>
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
          <li><a href="/blog" style="color: #ccc; text-decoration: none;">Japanese University Admissions</a></li>
          <li><a href="/blog" style="color: #ccc; text-decoration: none;">Visa Application Tips</a></li>
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
