<?php
// Copyright © 2025 Shiva Sharan Shrestha. All rights reserved. This code is part of NexaEducationCountaltancy.
// Contact page - add form processing functionality
$message = '';
$messageClass = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        require_once 'admin/database.php';
        $db = new Database();
        $conn = $db->getConnection();
        
        // Create table if it doesn't exist
        $conn->exec("CREATE TABLE IF NOT EXISTS contact_messages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            subject TEXT NOT NULL,
            message TEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");
        
        // Insert message
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'],
            $_POST['email'],
            $_POST['subject'],
            $_POST['message']
        ]);
        
        $message = "Thank you! Your message has been sent successfully.";
        $messageClass = "success";
        
    } catch(Exception $e) {
        $message = "Sorry, there was an error sending your message. Please try again.";
        $messageClass = "error";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Contact Us | NexaEducationCountaltancy</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <style>
    /* Remove old .contact-main and .contact-card styles that restrict width */
    .contact-main { max-width: unset; margin: 0; padding: 0; }
    .contact-card { display: none; }
    .contact-flex {
      display: flex;
      gap: 32px;
      max-width: 1100px;
      margin: 0 auto;
      padding: 32px 12px;
      flex-wrap: wrap;
      align-items: stretch;
    }
    .contact-left {
      flex: 1 1 440px;
      min-width: 320px;
      background: #fff;
      border-radius: 22px;
      box-shadow: 0 4px 32px rgba(77,124,243,0.13);
      padding: 44px 36px 38px 36px;
      text-align: left;
      margin-bottom: 18px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .contact-right {
      flex: 1 1 440px;
      min-width: 320px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: stretch;
      margin-bottom: 18px;
    }
    .map-title {
      font-size: 1.2rem;
      font-weight: 700;
      color: #4d7cf3;
      margin-bottom: 10px;
      text-align: left;
    }
    .map-embed {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .map-embed iframe {
      width: 100%;
      height: 100%;
      min-height: 340px;
      max-height: 480px;
      border-radius: 12px;
      border: 0;
      box-shadow: 0 2px 12px rgba(77,124,243,0.08);
      background: #eaf0ff;
    }
    .contact-title {
      font-size: 2.3rem;
      font-weight: 800;
      color: #355dcf;
      margin-bottom: 18px;
      letter-spacing: -1px;
    }
    .contact-info {
      font-size: 1.18rem;
      color: #333445;
      margin-bottom: 22px;
    }
    .contact-details {
      margin-bottom: 22px;
      font-size: 1.08rem;
    }
    .contact-details span {
      display: block;
      margin-bottom: 10px;
      font-weight: 600;
    }
    .contact-details a {
      color: #4d7cf3;
      text-decoration: none;
      font-weight: 600;
      font-size: 1.08rem;
    }
    .contact-form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      grid-gap: 18px 24px;
      margin-top: 22px;
      align-items: start;
      background: #f7faff;
      border-radius: 14px;
      padding: 28px 18px 18px 18px;
      box-shadow: 0 2px 12px rgba(77,124,243,0.07);
    }
    .contact-form input,
    .contact-form textarea {
      font-size: 1.08rem;
      padding: 16px 14px;
      border-radius: 8px;
      border: 1.5px solid #eaf0ff;
      margin-bottom: 0;
      background: #fff;
      transition: border 0.18s;
    }
    .contact-form input:focus,
    .contact-form textarea:focus {
      border-color: #4d7cf3;
      outline: none;
    }
    .contact-form input[name="name"] {
      grid-column: 1;
      grid-row: 1;
    }
    .contact-form input[name="email"] {
      grid-column: 2;
      grid-row: 1;
    }
    .contact-form input[name="subject"] {
      grid-column: 1 / span 2;
      grid-row: 2;
    }
    .contact-form textarea {
      grid-column: 1 / span 2;
      grid-row: 3;
      resize: vertical;
      min-height: 110px;
    }
    .contact-form button {
      grid-column: 1 / span 2;
      grid-row: 4;
      width: 100%;
      margin-top: 10px;
      background: #4d7cf3;
      color: #fff;
      border: none;
      padding: 18px 0;
      border-radius: 8px;
      font-size: 1.18rem;
      font-weight: 700;
      cursor: pointer;
      box-shadow: 0 2px 12px rgba(77,124,243,0.10);
      transition: background 0.18s;
      letter-spacing: 0.5px;
    }
    .contact-form button:hover {
      background: #355dcf;
    }
    .contact-success {
      grid-column: 1 / span 2;
      grid-row: 5;
      color: #2a9d4b;
      font-weight: 700;
      margin-top: 14px;
      text-align: center;
      font-size: 1.08rem;
    }
    .form-message.success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    .form-message.error {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    @media (max-width: 900px) {
      .contact-flex {
        flex-direction: column;
        gap: 0;
        padding: 18px 4px;
      }
      .contact-left, .contact-right {
        margin-bottom: 18px;
        padding: 18px 8px;
        min-width: 0;
      }
      .map-embed iframe {
        min-height: 180px;
        max-height: 320px;
      }
    }
    @media (max-width: 700px) {
      .contact-form {
        grid-template-columns: 1fr;
        padding: 18px 6px 12px 6px;
        box-shadow: none;
      }
      .contact-form input,
      .contact-form textarea,
      .contact-form button {
        width: 100%;
        font-size: 1rem;
        margin-bottom: 10px;
      }
      .contact-form input[name="name"],
      .contact-form input[name="email"],
      .contact-form input[name="subject"],
      .contact-form textarea,
      .contact-form button,
      .contact-success {
        grid-column: 1;
      }
      .contact-left, .contact-right {
        padding: 12px 4px;
      }
      .contact-title {
        font-size: 1.5rem;
      }
      .contact-info {
        font-size: 1rem;
      }
    }
    @media (max-width: 500px) {
      .contact-main {
        padding: 0;
      }
      .contact-flex {
        padding: 0 2px;
      }
      .contact-left, .contact-right {
        padding: 8px 2px;
        border-radius: 10px;
      }
      .contact-title {
        font-size: 1.1rem;
      }
      .contact-info {
        font-size: 0.95rem;
      }
      .contact-details {
        font-size: 0.95rem;
      }
      .map-embed iframe {
        min-height: 120px;
        max-height: 180px;
      }
    }
  </style>
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
  <main class="contact-main">
    <div class="contact-flex">
      <div class="contact-left">
        <div class="contact-title">We'd love to hear from you!</div>
        <div class="contact-info">Reach out for admissions, programs, or any questions about studying in Japan.</div>
        <div class="contact-details">
          <span>Phone: <a href="tel:+9779851417660">+977 9851417660</a></span>
          <span>Email: <a href="mailto:info@nexaeduconsult.com">info@nexaeduconsult.com</a></span>
          <span>Address: Banasthali Chowk, Kathmandu</span>
        </div>
        
        <?php if ($message): ?>
          <div class="form-message <?php echo $messageClass; ?>" style="margin-bottom: 20px; padding: 15px; border-radius: 8px; font-weight: 600;">
            <?php echo htmlspecialchars($message); ?>
          </div>
        <?php endif; ?>
        
        <form class="contact-form" method="POST">
          <input type="text" name="name" placeholder="Your Name" required>
          <input type="email" name="email" placeholder="Your Email" required>
          <input type="text" name="subject" placeholder="Subject" required>
          <textarea name="message" rows="4" placeholder="Your Message" required></textarea>
          <button type="submit">Send Message</button>
        </form>
      </div>
      <div class="contact-right">
        <div class="map-title">Our Location</div>
        <div class="map-embed">
          <iframe src="https://www.google.com/maps?q=Banasthali+Chowk,+Kathmandu,+Nepal&output=embed" width="100%" height="320" style="border:0; border-radius:12px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
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
