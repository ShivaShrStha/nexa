<?php
// Get gallery images for public display
require_once 'admin/database.php';

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Create table if it doesn't exist
    $conn->exec("CREATE TABLE IF NOT EXISTS gallery (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT,
        image_path TEXT NOT NULL,
        category TEXT DEFAULT 'general',
        is_featured INTEGER DEFAULT 0,
        status TEXT DEFAULT 'published',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Get published gallery images
    $stmt = $conn->query("SELECT * FROM gallery WHERE status = 'published' ORDER BY is_featured DESC, created_at DESC");
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(Exception $e) {
    $images = [];
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Gallery | NexaEducationCountaltancy</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    /* Gallery specific styles */
    .gallery-hero {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      background-size: 400% 400%;
      animation: gradientShift 10s ease infinite;
      color: #fff;
      padding: 80px 0;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    
    .gallery-hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 30% 70%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 70% 30%, rgba(255,255,255,0.08) 0%, transparent 50%);
      pointer-events: none;
    }
    
    .gallery-filter {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin: 2rem 0;
      flex-wrap: wrap;
    }
    
    .filter-btn {
      padding: 0.75rem 1.5rem;
      background: #f8f9fa;
      border: 2px solid #e9ecef;
      border-radius: 25px;
      color: #495057;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      cursor: pointer;
    }
    
    .filter-btn:hover,
    .filter-btn.active {
      background: #667eea;
      color: white;
      border-color: #667eea;
      transform: translateY(-2px);
    }
    
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      margin-top: 3rem;
    }
    
    .gallery-item {
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 32px rgba(102, 126, 234, 0.08);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
    }
    
    .gallery-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #667eea, #764ba2);
      transform: scaleX(0);
      transition: transform 0.3s ease;
      z-index: 1;
    }
    
    .gallery-item:hover::before {
      transform: scaleX(1);
    }
    
    .gallery-item:hover {
      transform: translateY(-12px);
      box-shadow: 0 20px 60px rgba(102, 126, 234, 0.15);
    }
    
    .gallery-img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
    
    .gallery-item:hover .gallery-img {
      transform: scale(1.05);
    }
    
    .gallery-content {
      padding: 1.5rem;
    }
    
    .gallery-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #2c3e50;
      margin-bottom: 0.5rem;
    }
    
    .gallery-description {
      color: #5a6c7d;
      line-height: 1.6;
      margin-bottom: 1rem;
    }
    
    .gallery-category {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      background: linear-gradient(90deg, #667eea, #764ba2);
      color: white;
      border-radius: 15px;
      font-size: 0.85rem;
      font-weight: 600;
    }
    
    .featured-badge {
      position: absolute;
      top: 1rem;
      right: 1rem;
      background: #ff6b35;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 15px;
      font-size: 0.8rem;
      font-weight: 700;
      z-index: 2;
    }
    
    /* Modal for image preview */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.9);
    }
    
    .modal-content {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
      max-height: 80%;
      animation: zoom 0.6s;
    }
    
    @keyframes zoom {
      from {transform: scale(0)}
      to {transform: scale(1)}
    }
    
    .close {
      position: absolute;
      top: 15px;
      right: 35px;
      color: #f1f1f1;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
      cursor: pointer;
    }
    
    .close:hover {
      color: #bbb;
    }
    
    .empty-gallery {
      text-align: center;
      padding: 3rem;
      color: #6c757d;
    }
    
    .empty-gallery h3 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
      .gallery-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
      
      .gallery-filter {
        flex-direction: column;
        align-items: center;
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

  <main>
    <section class="gallery-hero reveal">
      <div class="container">
        <h1 class="section-title" style="font-size:2.5rem;">NexaEducation Gallery</h1>
        <p class="section-sub" style="font-size:1.2rem; max-width:600px; margin:0 auto; color: white;">Explore moments from our journey helping Nepali students achieve their dreams of studying in Japan. Success stories, events, and memorable experiences.</p>
      </div>
    </section>

    <section class="container reveal" style="padding: 60px 0;">
      <div class="gallery-filter">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="students">Students</button>
        <button class="filter-btn" data-filter="events">Events</button>
        <button class="filter-btn" data-filter="campus">Campus Life</button>
        <button class="filter-btn" data-filter="general">General</button>
      </div>

      <div class="gallery-grid">
        <?php if (!empty($images)): ?>
          <?php foreach ($images as $image): ?>
            <div class="gallery-item" data-category="<?php echo htmlspecialchars($image['category']); ?>">
              <?php if ($image['is_featured']): ?>
                <div class="featured-badge">Featured</div>
              <?php endif; ?>
              <img src="<?php echo htmlspecialchars($image['image_path']); ?>" 
                   alt="<?php echo htmlspecialchars($image['title']); ?>" 
                   class="gallery-img"
                   onclick="openModal('<?php echo htmlspecialchars($image['image_path']); ?>', '<?php echo htmlspecialchars($image['title']); ?>')">
              <div class="gallery-content">
                <h3 class="gallery-title"><?php echo htmlspecialchars($image['title']); ?></h3>
                <?php if ($image['description']): ?>
                  <p class="gallery-description"><?php echo htmlspecialchars($image['description']); ?></p>
                <?php endif; ?>
                <span class="gallery-category"><?php echo ucfirst(htmlspecialchars($image['category'])); ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="empty-gallery">
            <h3>Gallery Coming Soon</h3>
            <p>We're currently building our gallery with amazing photos from our students' journeys to Japan. Check back soon for inspiring success stories and memorable moments!</p>
            
            <!-- Sample gallery items for demonstration -->
            <div class="gallery-grid" style="margin-top: 2rem;">
              <div class="gallery-item" data-category="students">
                <div class="featured-badge">Featured</div>
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=800&auto=format&fit=crop" 
                     alt="Student Success Story" 
                     class="gallery-img"
                     onclick="openModal('https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=800&auto=format&fit=crop', 'Student Success Story')">
                <div class="gallery-content">
                  <h3 class="gallery-title">Student Success Story</h3>
                  <p class="gallery-description">Celebrating our students who successfully gained admission to top Japanese universities.</p>
                  <span class="gallery-category">Students</span>
                </div>
              </div>
              
              <div class="gallery-item" data-category="events">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop" 
                     alt="Cultural Event" 
                     class="gallery-img"
                     onclick="openModal('https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=800&auto=format&fit=crop', 'Cultural Event')">
                <div class="gallery-content">
                  <h3 class="gallery-title">Cultural Exchange Event</h3>
                  <p class="gallery-description">Students participating in Japanese cultural learning workshops and events.</p>
                  <span class="gallery-category">Events</span>
                </div>
              </div>
              
              <div class="gallery-item" data-category="campus">
                <img src="https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=800&auto=format&fit=crop" 
                     alt="Campus Life" 
                     class="gallery-img"
                     onclick="openModal('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=800&auto=format&fit=crop', 'Campus Life')">
                <div class="gallery-content">
                  <h3 class="gallery-title">Japanese University Campus</h3>
                  <p class="gallery-description">Beautiful campuses where our students are now studying and thriving.</p>
                  <span class="gallery-category">Campus</span>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <!-- Modal for image preview -->
  <div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
    <div id="caption" style="text-align: center; color: white; padding: 20px; font-size: 1.2rem;"></div>
  </div>

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
  <script>
    // Gallery filter functionality
    document.addEventListener('DOMContentLoaded', function() {
      const filterButtons = document.querySelectorAll('.filter-btn');
      const galleryItems = document.querySelectorAll('.gallery-item');

      filterButtons.forEach(button => {
        button.addEventListener('click', () => {
          const filter = button.getAttribute('data-filter');
          
          // Update active button
          filterButtons.forEach(btn => btn.classList.remove('active'));
          button.classList.add('active');
          
          // Filter gallery items
          galleryItems.forEach(item => {
            if (filter === 'all' || item.getAttribute('data-category') === filter) {
              item.style.display = 'block';
              item.style.animation = 'fadeIn 0.5s ease';
            } else {
              item.style.display = 'none';
            }
          });
        });
      });
    });

    // Modal functionality
    function openModal(imageSrc, title) {
      const modal = document.getElementById('imageModal');
      const modalImg = document.getElementById('modalImage');
      const caption = document.getElementById('caption');
      
      modal.style.display = 'block';
      modalImg.src = imageSrc;
      caption.innerHTML = title;
    }

    function closeModal() {
      document.getElementById('imageModal').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
      const modal = document.getElementById('imageModal');
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    }

    // Add fade in animation
    const style = document.createElement('style');
    style.textContent = `
      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
      }
    `;
    document.head.appendChild(style);
  </script>
</body>
</html>
