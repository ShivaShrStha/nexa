<?php
// Include security check
require_once 'security.php';

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - NexaEducation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }
        
        .admin-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .admin-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
        }
        
        .admin-nav {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .nav-tabs {
            display: flex;
            gap: 1rem;
        }
        
        .nav-tab {
            padding: 0.75rem 1.5rem;
            background: #f8f9fa;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-tab.active {
            background: #667eea;
            color: white;
        }
        
        .nav-tab:hover {
            background: #5a6fd8;
            color: white;
        }
        
        .admin-content {
            padding: 0 2rem;
        }
        
        .content-section {
            display: none;
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .content-section.active {
            display: block;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #333;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        
        .data-table th,
        .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }
        
        .data-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        
        .data-table tr:hover {
            background: #f8f9fa;
        }
        
        .no-data {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            padding: 2rem;
        }
        
        .refresh-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            margin-bottom: 1rem;
        }
        
        .refresh-btn:hover {
            background: #218838;
        }
        
        .blog-form {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        @media (max-width: 768px) {
            .admin-header, .admin-nav, .admin-content {
                padding: 1rem;
            }
            
            .nav-tabs {
                flex-direction: column;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .data-table {
                font-size: 0.9rem;
            }
        }
    </style>
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
</head>
<body>
    <div class="admin-header">
        <h1>📊 NexaEducation Admin Dashboard</h1>
        <div style="float: right;">
            <a href="?logout=1" style="color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 5px; font-size: 14px;">🚪 Logout</a>
        </div>
        <div style="clear: both;"></div>
    </div>
    
    <div class="admin-nav">
        <div class="nav-tabs">
            <button class="nav-tab active" onclick="showSection('dashboard')">Dashboard</button>
            <button class="nav-tab" onclick="showSection('course-requests')">Course Requests</button>
            <button class="nav-tab" onclick="showSection('newsletter')">Newsletter</button>
            <button class="nav-tab" onclick="showSection('contact-messages')">Contact Messages</button>
            <button class="nav-tab" onclick="showSection('blog-posts')">Blog Posts</button>
            <button class="nav-tab" onclick="showSection('create-blog')">Create Blog</button>
            <button class="nav-tab" onclick="showSection('gallery')">Gallery</button>
            <button class="nav-tab" onclick="showSection('upload-gallery')">Upload Images</button>
        </div>
    </div>
    
    <div class="admin-content">
        <!-- Dashboard Section -->
        <div id="dashboard" class="content-section active">
            <h2 class="section-title">📈 Dashboard Overview</h2>
            <div class="stats-grid" id="statsGrid">
                <!-- Stats will be loaded here -->
            </div>
        </div>
        
        <!-- Course Requests Section -->
        <div id="course-requests" class="content-section">
            <h2 class="section-title">📚 Course Requests</h2>
            <div style="margin-bottom: 1rem;">
                <button class="refresh-btn" onclick="loadCourseRequests()">🔄 Refresh</button>
                <button class="refresh-btn" onclick="exportToExcel('course_requests')" style="background: #28a745; margin-left: 0.5rem;">📥 Export CSV</button>
            </div>
            <div id="courseRequestsTable">
                <!-- Table will be loaded here -->
            </div>
        </div>
        
        <!-- Newsletter Section -->
        <div id="newsletter" class="content-section">
            <h2 class="section-title">📧 Newsletter Subscriptions</h2>
            <div style="margin-bottom: 1rem;">
                <button class="refresh-btn" onclick="loadNewsletterSubscriptions()">🔄 Refresh</button>
                <button class="refresh-btn" onclick="exportToExcel('newsletter')" style="background: #28a745; margin-left: 0.5rem;">📥 Export CSV</button>
            </div>
            <div id="newsletterTable">
                <!-- Table will be loaded here -->
            </div>
        </div>
        
        <!-- Contact Messages Section -->
        <div id="contact-messages" class="content-section">
            <h2 class="section-title">💬 Contact Messages</h2>
            <div style="margin-bottom: 1rem;">
                <button class="refresh-btn" onclick="loadContactMessages()">🔄 Refresh</button>
                <button class="refresh-btn" onclick="exportToExcel('contacts')" style="background: #28a745; margin-left: 0.5rem;">📥 Export CSV</button>
            </div>
            <div id="contactMessagesTable">
                <!-- Table will be loaded here -->
            </div>
        </div>
        
        <!-- Blog Posts Section -->
        <div id="blog-posts" class="content-section">
            <h2 class="section-title">📝 Blog Posts</h2>
            <div style="margin-bottom: 1rem;">
                <button class="refresh-btn" onclick="loadBlogPosts()">🔄 Refresh</button>
            </div>
            <div id="blogPostsTable">
                <!-- Table will be loaded here -->
            </div>
        </div>
        
        <!-- Create Blog Section -->
        <div id="create-blog" class="content-section">
            <h2 class="section-title">✍️ Create New Blog Post</h2>
            <form id="blogForm" class="blog-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="blogTitle">Title *</label>
                    <input type="text" id="blogTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="blogAuthor">Author</label>
                    <input type="text" id="blogAuthor" name="author" value="NexaEducation Admin">
                </div>
                <div class="form-group">
                    <label for="blogImage">Featured Image</label>
                    <input type="file" id="blogImage" name="featured_image" accept="image/*">
                    <small style="color: #666; font-size: 0.9rem;">Upload an image (JPG, PNG, GIF - Max 5MB)</small>
                </div>
                <div class="form-group">
                    <label for="blogExcerpt">Excerpt</label>
                    <textarea id="blogExcerpt" name="excerpt" rows="3" placeholder="Short description (optional - auto-generated if empty)"></textarea>
                </div>
                <div class="form-group">
                    <label for="blogContent">Content *</label>
                    <textarea id="blogContent" name="content" rows="10" required placeholder="Write your blog post content here..."></textarea>
                </div>
                <button type="submit" class="refresh-btn" style="background: #28a745;">📝 Publish Blog Post</button>
                <div id="blogMessage" style="display:none; margin-top:10px; padding:10px; border-radius:5px;"></div>
            </form>
        </div>
        
        <!-- Gallery Section -->
        <div id="gallery" class="content-section">
            <h2 class="section-title">🖼️ Gallery Images</h2>
            <div style="margin-bottom: 1rem;">
                <button class="refresh-btn" onclick="loadGalleryImages()">🔄 Refresh</button>
            </div>
            <div id="galleryTable">
                <!-- Table will be loaded here -->
            </div>
        </div>
        
        <!-- Upload Gallery Section -->
        <div id="upload-gallery" class="content-section">
            <h2 class="section-title">📤 Upload Gallery Images</h2>
            <form class="blog-form" id="galleryForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="galleryTitle">Image Title</label>
                    <input type="text" id="galleryTitle" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="galleryDescription">Description (Optional)</label>
                    <textarea id="galleryDescription" name="description" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="galleryImage">Select Image</label>
                    <input type="file" id="galleryImage" name="image" accept="image/*" required>
                    <small style="color: #6c757d;">Supported formats: JPG, PNG, GIF (Max: 5MB)</small>
                </div>
                
                <div class="form-group">
                    <label for="galleryCategory">Category</label>
                    <select id="galleryCategory" name="category" required>
                        <option value="general">General</option>
                        <option value="students">Students</option>
                        <option value="events">Events</option>
                        <option value="campus">Campus Life</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>
                        <input type="checkbox" id="galleryFeatured" name="is_featured" value="1">
                        Mark as Featured
                    </label>
                </div>
                
                <div class="form-group">
                    <label for="galleryStatus">Status</label>
                    <select id="galleryStatus" name="status">
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Upload Image</button>
            </form>
        </div>
    </div>
    
    <!-- Modal for editing gallery image -->
    <div id="editGalleryModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center;">
      <div style="background:#fff; padding:32px 24px; border-radius:12px; max-width:400px; width:100%; position:relative;">
        <h3 style="margin-bottom:18px;">Edit Gallery Image</h3>
        <form id="editGalleryForm">
          <input type="hidden" name="id" id="editGalleryId">
          <div style="margin-bottom:12px;"><label>Title</label><input type="text" name="title" id="editGalleryTitle" style="width:100%;padding:8px;"></div>
          <div style="margin-bottom:12px;"><label>Description</label><textarea name="description" id="editGalleryDescription" style="width:100%;padding:8px;"></textarea></div>
          <div style="margin-bottom:12px;"><label>Category</label><input type="text" name="category" id="editGalleryCategory" style="width:100%;padding:8px;"></div>
          <div style="margin-bottom:12px;"><label>Status</label><select name="status" id="editGalleryStatus" style="width:100%;padding:8px;"><option value="published">Published</option><option value="draft">Draft</option></select></div>
          <div style="margin-bottom:12px;"><label>Featured</label><select name="is_featured" id="editGalleryFeatured" style="width:100%;padding:8px;"><option value="1">Yes</option><option value="0">No</option></select></div>
          <button type="submit" style="background:#007bff;color:#fff;padding:10px 18px;border:none;border-radius:6px;">Save Changes</button>
          <button type="button" onclick="closeEditGalleryModal()" style="margin-left:10px;">Cancel</button>
        </form>
      </div>
    </div>

    <!-- Edit Blog Post Modal -->
    <div id="editBlogModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center;">
      <div style="background:#fff; padding:32px 24px; border-radius:12px; max-width:500px; width:100%; position:relative;">
        <h3 style="margin-bottom:18px;">Edit Blog Post</h3>
        <form id="editBlogForm">
          <input type="hidden" name="id" id="editBlogId">
          <div style="margin-bottom:12px;"><label>Title</label><input type="text" name="title" id="editBlogTitle" style="width:100%;padding:8px;"></div>
          <div style="margin-bottom:12px;"><label>Author</label><input type="text" name="author" id="editBlogAuthor" style="width:100%;padding:8px;"></div>
          <div style="margin-bottom:12px;"><label>Excerpt</label><textarea name="excerpt" id="editBlogExcerpt" style="width:100%;padding:8px;"></textarea></div>
          <div style="margin-bottom:12px;"><label>Status</label><select name="status" id="editBlogStatus" style="width:100%;padding:8px;"><option value="published">Published</option><option value="draft">Draft</option></select></div>
          <button type="submit" style="background:#007bff;color:#fff;padding:10px 18px;border:none;border-radius:6px;">Save Changes</button>
          <button type="button" onclick="closeEditBlogModal()" style="margin-left:10px;">Cancel</button>
        </form>
      </div>
    </div>
    <!-- Edit Course Request Modal -->
    <div id="editCourseRequestModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center;">
      <div style="background:#fff; padding:32px 24px; border-radius:12px; max-width:500px; width:100%; position:relative;">
        <h3 style="margin-bottom:18px;">Edit Course Request</h3>
        <form id="editCourseRequestForm">
          <input type="hidden" name="id" id="editCourseRequestId">
          <div style="margin-bottom:12px;"><label>First Name</label><input type="text" name="first_name" id="editCourseFirstName" style="width:100%;padding:8px;"></div>
          <div style="margin-bottom:12px;"><label>Last Name</label><input type="text" name="last_name" id="editCourseLastName" style="width:100%;padding:8px;"></div>
          <div style="margin-bottom:12px;"><label>Email</label><input type="email" name="email" id="editCourseEmail" style="width:100%;padding:8px;"></div>
          <div style="margin-bottom:12px;"><label>Phone</label><input type="text" name="phone" id="editCoursePhone" style="width:100%;padding:8px;"></div>
          <div style="margin-bottom:12px;"><label>Subject</label><input type="text" name="subject" id="editCourseSubject" style="width:100%;padding:8px;"></div>
          <button type="submit" style="background:#007bff;color:#fff;padding:10px 18px;border:none;border-radius:6px;">Save Changes</button>
          <button type="button" onclick="closeEditCourseRequestModal()" style="margin-left:10px;">Cancel</button>
        </form>
      </div>
    </div>
    <!-- Edit Newsletter Modal -->
    <div id="editNewsletterModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center;">
      <div style="background:#fff; padding:32px 24px; border-radius:12px; max-width:400px; width:100%; position:relative;">
        <h3 style="margin-bottom:18px;">Edit Newsletter Subscription</h3>
        <form id="editNewsletterForm">
          <input type="hidden" name="id" id="editNewsletterId">
          <div style="margin-bottom:12px;"><label>Email</label><input type="email" name="email" id="editNewsletterEmail" style="width:100%;padding:8px;"></div>
          <button type="submit" style="background:#007bff;color:#fff;padding:10px 18px;border:none;border-radius:6px;">Save Changes</button>
          <button type="button" onclick="closeEditNewsletterModal()" style="margin-left:10px;">Cancel</button>
        </form>
      </div>
    </div>
    <!-- Edit Contact Message Modal -->
    <div id="editContactMessageModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center;">
      <div style="background:#fff; padding:32px 24px; border-radius:12px; max-width:500px; width:100%; position:relative;">
        <h3 style="margin-bottom:18px;">Edit Contact Message</h3>
        <form id="editContactMessageForm">
          <input type="hidden" name="id" id="editContactMessageId">
          <div style="margin-bottom:12px;"><label>Name</label><input type="text" name="name" id="editContactName" style="width:100%;padding:8px;"></div>
          <div style="margin-bottom:12px;"><label>Email</label><input type="email" name="email" id="editContactEmail" style="width:100%;padding:8px;"></div>
          <div style="margin-bottom:12px;"><label>Subject</label><input type="text" name="subject" id="editContactSubject" style="width:100%;padding:8px;"></div>
          <div style="margin-bottom:12px;"><label>Message</label><textarea name="message" id="editContactMessage" style="width:100%;padding:8px;"></textarea></div>
          <button type="submit" style="background:#007bff;color:#fff;padding:10px 18px;border:none;border-radius:6px;">Save Changes</button>
          <button type="button" onclick="closeEditContactMessageModal()" style="margin-left:10px;">Cancel</button>
        </form>
      </div>
    </div>
    <script>
        // Navigation functionality
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.nav-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected section
            document.getElementById(sectionId).classList.add('active');
            
            // Add active class to clicked tab
            event.target.classList.add('active');
            
            // Load data for the section
            if (sectionId === 'dashboard') {
                loadDashboard();
            } else if (sectionId === 'course-requests') {
                loadCourseRequests();
            } else if (sectionId === 'newsletter') {
                loadNewsletterSubscriptions();
            } else if (sectionId === 'contact-messages') {
                loadContactMessages();
            } else if (sectionId === 'blog-posts') {
                loadBlogPosts();
            }
        }
        
        // Load dashboard stats
        function loadDashboard() {
            fetch('get_stats.php')
                .then(response => response.json())
                .then(data => {
                    const statsGrid = document.getElementById('statsGrid');
                    statsGrid.innerHTML = `
                        <div class="stat-card">
                            <div class="stat-number">${data.course_requests || 0}</div>
                            <div class="stat-label">Course Requests</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">${data.newsletter_subscriptions || 0}</div>
                            <div class="stat-label">Newsletter Subscribers</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">${data.contact_messages || 0}</div>
                            <div class="stat-label">Contact Messages</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">${data.blog_posts || 0}</div>
                            <div class="stat-label">Blog Posts</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">${data.gallery_images || 0}</div>
                            <div class="stat-label">Gallery Images</div>
                        </div>
                    `;
                })
                .catch(error => {
                    console.error('Error loading stats:', error);
                });
        }
        
        // Load course requests
        function loadCourseRequests() {
            fetch('get_course_requests.php')
                .then(response => response.json())
                .then(data => {
                    const tableContainer = document.getElementById('courseRequestsTable');
                    
                    if (data.length === 0) {
                        tableContainer.innerHTML = '<div class="no-data">No course requests yet.</div>';
                        return;
                    }
                    
                    let tableHTML = `
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    
                    data.forEach(request => {
                        tableHTML += `
                            <tr>
                                <td>${request.id}</td>
                                <td>${request.first_name}</td>
                                <td>${request.last_name}</td>
                                <td>${request.email}</td>
                                <td>${request.phone}</td>
                                <td>${request.subject}</td>
                                <td>${new Date(request.created_at).toLocaleDateString()}</td>
                                <td>
                                    <button onclick="editCourseRequest(${request.id})" style="background:#007bff;color:white;border:none;padding:4px 8px;border-radius:4px;cursor:pointer;">Edit</button>
                                    <button onclick="deleteCourseRequest(${request.id})" style="background:#dc3545;color:white;border:none;padding:4px 8px;border-radius:4px;cursor:pointer;">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    
                    tableHTML += '</tbody></table>';
                    tableContainer.innerHTML = tableHTML;
                })
                .catch(error => {
                    console.error('Error loading course requests:', error);
                });
        }
        
        // Load newsletter subscriptions
        function loadNewsletterSubscriptions() {
            fetch('get_newsletter.php')
                .then(response => response.json())
                .then(data => {
                    const tableContainer = document.getElementById('newsletterTable');
                    
                    if (data.length === 0) {
                        tableContainer.innerHTML = '<div class="no-data">No newsletter subscriptions yet.</div>';
                        return;
                    }
                    
                    let tableHTML = `
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Subscription Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    
                    data.forEach(subscription => {
                        tableHTML += `
                            <tr>
                                <td>${subscription.id}</td>
                                <td>${subscription.email}</td>
                                <td>${new Date(subscription.created_at).toLocaleDateString()}</td>
                                <td>
                                    <button onclick="editNewsletterSubscription(${subscription.id})" style="background:#007bff;color:white;border:none;padding:4px 8px;border-radius:4px;cursor:pointer;">Edit</button>
                                    <button onclick="deleteNewsletterSubscription(${subscription.id})" style="background:#dc3545;color:white;border:none;padding:4px 8px;border-radius:4px;cursor:pointer;">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    
                    tableHTML += '</tbody></table>';
                    tableContainer.innerHTML = tableHTML;
                })
                .catch(error => {
                    console.error('Error loading newsletter subscriptions:', error);
                });
        }
        
        // Load contact messages
        function loadContactMessages() {
            fetch('get_contact_messages.php')
                .then(response => response.json())
                .then(data => {
                    const tableContainer = document.getElementById('contactMessagesTable');
                    
                    if (data.length === 0) {
                        tableContainer.innerHTML = '<div class="no-data">No contact messages yet.</div>';
                        return;
                    }
                    
                    let tableHTML = `
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    
                    data.forEach(message => {
                        tableHTML += `
                            <tr>
                                <td>${message.id}</td>
                                <td>${message.name}</td>
                                <td>${message.email}</td>
                                <td>${message.subject}</td>
                                <td>${message.message.substring(0, 50)}${message.message.length > 50 ? '...' : ''}</td>
                                <td>${new Date(message.created_at).toLocaleDateString()}</td>
                                <td>
                                    <button onclick="editContactMessage(${message.id})" style="background:#007bff;color:white;border:none;padding:4px 8px;border-radius:4px;cursor:pointer;">Edit</button>
                                    <button onclick="deleteContactMessage(${message.id})" style="background:#dc3545;color:white;border:none;padding:4px 8px;border-radius:4px;cursor:pointer;">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    
                    tableHTML += '</tbody></table>';
                    tableContainer.innerHTML = tableHTML;
                })
                .catch(error => {
                    console.error('Error loading contact messages:', error);
                });
        }
        
        // Load blog posts
        function loadBlogPosts() {
            fetch('get_blog_posts.php')
                .then(response => response.json())
                .then(data => {
                    const tableContainer = document.getElementById('blogPostsTable');
                    
                    if (data.length === 0) {
                        tableContainer.innerHTML = '<div class="no-data">No blog posts yet.</div>';
                        return;
                    }
                    
                    let tableHTML = `
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Excerpt</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    
                    data.forEach(post => {
                        tableHTML += `
                            <tr>
                                <td>${post.id}</td>
                                <td>${post.title}</td>
                                <td>${post.author}</td>
                                <td>${post.excerpt ? post.excerpt.substring(0, 50) + '...' : 'No excerpt'}</td>
                                <td><span style="color: green;">●</span> ${post.status}</td>
                                <td>${new Date(post.created_at).toLocaleDateString()}</td>
                                <td>
                                    <button onclick="editBlogPost(${post.id})" style="background:#007bff;color:white;border:none;padding:4px 8px;border-radius:4px;cursor:pointer;">Edit</button>
                                    <button onclick="deleteBlogPost(${post.id})" style="background:#dc3545;color:white;border:none;padding:4px 8px;border-radius:4px;cursor:pointer;">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    
                    tableHTML += '</tbody></table>';
                    tableContainer.innerHTML = tableHTML;
                })
                .catch(error => {
                    console.error('Error loading blog posts:', error);
                });
        }
        
        // Load gallery images
        function loadGalleryImages() {
            fetch('get_gallery_images.php')
                .then(response => response.json())
                .then(data => {
                    let html = `
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    
                    if (data.length > 0) {
                        data.forEach(image => {
                            html += `
                                <tr>
                                    <td><img src="../${image.image_path}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;"></td>
                                    <td>${image.title}</td>
                                    <td><span style="background: #667eea; color: white; padding: 2px 8px; border-radius: 12px; font-size: 0.8rem;">${image.category}</span></td>
                                    <td>${image.is_featured ? '⭐ Yes' : 'No'}</td>
                                    <td><span style="color: ${image.status === 'published' ? 'green' : 'orange'};">${image.status}</span></td>
                                    <td>${new Date(image.created_at).toLocaleDateString()}</td>
                                    <td>
                                        <button onclick='openEditGalleryModal(${JSON.stringify(image)})' style='background:#007bff;color:#fff;border:none;padding:4px 8px;border-radius:4px;cursor:pointer;'>Edit</button>
                                        <button onclick='deleteGalleryImage(${image.id})' style='background: #dc3545; color: white; border: none; padding: 4px 8px; border-radius: 4px; cursor: pointer;'>Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                    } else {
                        html += '<tr><td colspan="7" class="no-data">No gallery images found</td></tr>';
                    }
                    
                    html += '</tbody></table>';
                    document.getElementById('galleryTable').innerHTML = html;
                })
                .catch(error => console.error('Error loading gallery images:', error));
        }

        function deleteGalleryImage(id) {
            if (confirm('Are you sure you want to delete this image?')) {
                fetch('delete_gallery_image.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({id: id})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadGalleryImages();
                        showNotification('Image deleted successfully', 'success');
                    } else {
                        showNotification('Error deleting image: ' + data.message, 'error');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        // Gallery form submission
        document.getElementById('galleryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('process_gallery_upload.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Image uploaded successfully!', 'success');
                    this.reset();
                    loadGalleryImages();
                } else {
                    showNotification('Error: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error uploading image', 'error');
            });
        });
        
        // Handle blog form submission
        document.addEventListener('DOMContentLoaded', function() {
            const blogForm = document.getElementById('blogForm');
            if (blogForm) {
                blogForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(blogForm);
                    const submitBtn = blogForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.textContent;
                    const messageDiv = document.getElementById('blogMessage');
                    
                    try {
                        submitBtn.textContent = 'Publishing...';
                        submitBtn.disabled = true;
                        
                        const response = await fetch('process_blog_post.php', {
                            method: 'POST',
                            body: formData
                        });
                        
                        const result = await response.json();
                        
                        if (result.success) {
                            messageDiv.style.display = 'block';
                            messageDiv.style.backgroundColor = '#d4edda';
                            messageDiv.style.color = '#155724';
                            messageDiv.style.border = '1px solid #c3e6cb';
                            messageDiv.textContent = result.message;
                            blogForm.reset();
                            document.getElementById('blogAuthor').value = 'NexaEducation Admin';
                        } else {
                            messageDiv.style.display = 'block';
                            messageDiv.style.backgroundColor = '#f8d7da';
                            messageDiv.style.color = '#721c24';
                            messageDiv.style.border = '1px solid #f5c6cb';
                            messageDiv.textContent = result.message;
                        }
                        
                        setTimeout(() => {
                            messageDiv.style.display = 'none';
                        }, 5000);
                        
                    } catch (error) {
                        messageDiv.style.display = 'block';
                        messageDiv.style.backgroundColor = '#f8d7da';
                        messageDiv.style.color = '#721c24';
                        messageDiv.textContent = 'Error creating blog post. Please try again.';
                    } finally {
                        submitBtn.textContent = originalText;
                        submitBtn.disabled = false;
                    }
                });
            }
            
            loadDashboard();
        });

        // Excel Export Functions
        function exportToExcel(type) {
            let data = [];
            let filename = '';
            
            switch(type) {
                case 'newsletter':
                    fetch('get_newsletter.php')
                        .then(response => response.json())
                        .then(subscribers => {
                            exportData(subscribers, 'Newsletter_Subscribers_' + new Date().toISOString().split('T')[0] + '.csv', [
                                {key: 'id', label: 'ID'},
                                {key: 'email', label: 'Email'},
                                {key: 'subscribed_at', label: 'Subscribed Date'}
                            ]);
                        });
                    break;
                    
                case 'contacts':
                    fetch('get_contact_messages.php')
                        .then(response => response.json())
                        .then(messages => {
                            exportData(messages, 'Contact_Messages_' + new Date().toISOString().split('T')[0] + '.csv', [
                                {key: 'id', label: 'ID'},
                                {key: 'name', label: 'Name'},
                                {key: 'email', label: 'Email'},
                                {key: 'subject', label: 'Subject'},
                                {key: 'message', label: 'Message'},
                                {key: 'created_at', label: 'Date'}
                            ]);
                        });
                    break;
                    
                case 'course_requests':
                    fetch('get_course_requests.php')
                        .then(response => response.json())
                        .then(requests => {
                            exportData(requests, 'Course_Requests_' + new Date().toISOString().split('T')[0] + '.csv', [
                                {key: 'id', label: 'ID'},
                                {key: 'first_name', label: 'First Name'},
                                {key: 'last_name', label: 'Last Name'},
                                {key: 'email', label: 'Email'},
                                {key: 'phone', label: 'Phone'},
                                {key: 'subject', label: 'Subject'},
                                {key: 'created_at', label: 'Date'}
                            ]);
                        });
                    break;
                    
                case 'blog_posts':
                    fetch('get_blog_posts.php')
                        .then(response => response.json())
                        .then(posts => {
                            exportData(posts, 'Blog_Posts_' + new Date().toISOString().split('T')[0] + '.csv', [
                                {key: 'id', label: 'ID'},
                                {key: 'title', label: 'Title'},
                                {key: 'author', label: 'Author'},
                                {key: 'status', label: 'Status'},
                                {key: 'created_at', label: 'Created Date'}
                            ]);
                        });
                    break;
                    
                case 'gallery':
                    fetch('get_gallery_images.php')
                        .then(response => response.json())
                        .then(images => {
                            exportData(images, 'Gallery_Images_' + new Date().toISOString().split('T')[0] + '.csv', [
                                {key: 'id', label: 'ID'},
                                {key: 'title', label: 'Title'},
                                {key: 'category', label: 'Category'},
                                {key: 'is_featured', label: 'Featured'},
                                {key: 'status', label: 'Status'},
                                {key: 'created_at', label: 'Created Date'}
                            ]);
                        });
                    break;
            }
        }
        
        function exportData(data, filename, columns) {
            if (!data || data.length === 0) {
                showNotification('No data to export', 'error');
                return;
            }
            
            // Create CSV content
            let csv = '';
            
            // Add headers
            csv += columns.map(col => col.label).join(',') + '\n';
            
            // Add data rows
            data.forEach(row => {
                csv += columns.map(col => {
                    let value = row[col.key] || '';
                    // Escape commas and quotes in CSV
                    if (typeof value === 'string' && (value.includes(',') || value.includes('"'))) {
                        value = '"' + value.replace(/"/g, '""') + '"';
                    }
                    return value;
                }).join(',') + '\n';
            });
            
            // Create and download file
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            
            if (link.download !== undefined) {
                const url = URL.createObjectURL(blob);
                link.setAttribute('href', url);
                link.setAttribute('download', filename);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                showNotification('Data exported successfully!', 'success');
            } else {
                showNotification('Export not supported in this browser', 'error');
            }
        }

        function openEditGalleryModal(image) {
          document.getElementById('editGalleryId').value = image.id;
          document.getElementById('editGalleryTitle').value = image.title;
          document.getElementById('editGalleryDescription').value = image.description || '';
          document.getElementById('editGalleryCategory').value = image.category;
          document.getElementById('editGalleryStatus').value = image.status;
          document.getElementById('editGalleryFeatured').value = image.is_featured ? '1' : '0';
          document.getElementById('editGalleryModal').style.display = 'flex';
        }
        function closeEditGalleryModal() {
          document.getElementById('editGalleryModal').style.display = 'none';
        }
        document.getElementById('editGalleryForm').onsubmit = function(e) {
          e.preventDefault();
          const id = document.getElementById('editGalleryId').value;
          const title = document.getElementById('editGalleryTitle').value;
          const description = document.getElementById('editGalleryDescription').value;
          const category = document.getElementById('editGalleryCategory').value;
          const status = document.getElementById('editGalleryStatus').value;
          const is_featured = document.getElementById('editGalleryFeatured').value;
          fetch('admin/edit_gallery_image.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({id, title, description, category, status, is_featured})
          })
          .then(res => res.json())
          .then(data => {
            if(data.success){
              closeEditGalleryModal();
              loadGalleryImages();
              alert('Gallery image updated successfully');
            }else{
              alert('Error: ' + data.message);
            }
          });
        };

        // --- CRUD JS for Blog Posts ---
        function deleteBlogPost(id) {
            if (confirm('Are you sure you want to delete this blog post?')) {
                fetch('delete_blog_post.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        loadBlogPosts();
                        showNotification('Blog post deleted successfully', 'success');
                    } else {
                        showNotification('Error deleting blog post: ' + data.message, 'error');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function editBlogPost(id) {
            fetch('get_blog_posts.php')
                .then(res => res.json())
                .then(posts => {
                    const post = posts.find(p => p.id == id);
                    if (post) {
                        openEditBlogModal(post);
                    }
                });
        }

        // --- CRUD JS for Course Requests ---
        function deleteCourseRequest(id) {
            if (confirm('Are you sure you want to delete this course request?')) {
                fetch('delete_course_request.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        loadCourseRequests();
                        showNotification('Course request deleted successfully', 'success');
                    } else {
                        showNotification('Error deleting course request: ' + data.message, 'error');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function editCourseRequest(id) {
            fetch('get_course_requests.php')
                .then(res => res.json())
                .then(requests => {
                    const req = requests.find(r => r.id == id);
                    if (req) {
                        openEditCourseRequestModal(req);
                    }
                });
        }

        // --- CRUD JS for Newsletter ---
        function deleteNewsletterSubscription(id) {
            if (confirm('Are you sure you want to delete this newsletter subscription?')) {
                fetch('delete_newsletter.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        loadNewsletterSubscriptions();
                        showNotification('Newsletter subscription deleted successfully', 'success');
                    } else {
                        showNotification('Error deleting newsletter subscription: ' + data.message, 'error');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function editNewsletterSubscription(id) {
            fetch('get_newsletter.php')
                .then(res => res.json())
                .then(subs => {
                    const sub = subs.find(s => s.id == id);
                    if (sub) {
                        openEditNewsletterModal(sub);
                    }
                });
        }

        // --- CRUD JS for Contact Messages ---
        function deleteContactMessage(id) {
            if (confirm('Are you sure you want to delete this contact message?')) {
                fetch('delete_contact_message.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        loadContactMessages();
                        showNotification('Contact message deleted successfully', 'success');
                    } else {
                        showNotification('Error deleting contact message: ' + data.message, 'error');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function editContactMessage(id) {
            fetch('get_contact_messages.php')
                .then(res => res.json())
                .then(msgs => {
                    const msg = msgs.find(m => m.id == id);
                    if (msg) {
                        openEditContactMessageModal(msg);
                    }
                });
        }

        // Add missing showNotification function
        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 600;
                z-index: 10000;
                transition: all 0.3s ease;
                ${type === 'success' ? 'background: #28a745;' : 'background: #dc3545;'}
            `;
            notification.textContent = message;
            
            // Add to page
            document.body.appendChild(notification);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // --- Blog Post Edit Modal Logic ---
        function openEditBlogModal(post) {
            document.getElementById('editBlogId').value = post.id;
            document.getElementById('editBlogTitle').value = post.title;
            document.getElementById('editBlogAuthor').value = post.author;
            document.getElementById('editBlogExcerpt').value = post.excerpt || '';
            document.getElementById('editBlogStatus').value = post.status;
            document.getElementById('editBlogModal').style.display = 'flex';
        }
        
        function closeEditBlogModal() {
            document.getElementById('editBlogModal').style.display = 'none';
        }
        
        document.getElementById('editBlogForm').onsubmit = function(e) {
            e.preventDefault();
            const id = document.getElementById('editBlogId').value;
            const title = document.getElementById('editBlogTitle').value;
            const author = document.getElementById('editBlogAuthor').value;
            const excerpt = document.getElementById('editBlogExcerpt').value;
            const status = document.getElementById('editBlogStatus').value;
            fetch('edit_blog_post.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, title, author, excerpt, status })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeEditBlogModal();
                    loadBlogPosts();
                    showNotification('Blog post updated successfully', 'success');
                } else {
                    showNotification('Error: ' + data.message, 'error');
                }
            });
        };

        // --- Course Request Edit Modal Logic ---
        function openEditCourseRequestModal(req) {
            document.getElementById('editCourseRequestId').value = req.id;
            document.getElementById('editCourseFirstName').value = req.first_name;
            document.getElementById('editCourseLastName').value = req.last_name;
            document.getElementById('editCourseEmail').value = req.email;
            document.getElementById('editCoursePhone').value = req.phone;
            document.getElementById('editCourseSubject').value = req.subject;
            document.getElementById('editCourseRequestModal').style.display = 'flex';
        }
        
        function closeEditCourseRequestModal() {
            document.getElementById('editCourseRequestModal').style.display = 'none';
        }
        
        document.getElementById('editCourseRequestForm').onsubmit = function(e) {
            e.preventDefault();
            const id = document.getElementById('editCourseRequestId').value;
            const first_name = document.getElementById('editCourseFirstName').value;
            const last_name = document.getElementById('editCourseLastName').value;
            const email = document.getElementById('editCourseEmail').value;
            const phone = document.getElementById('editCoursePhone').value;
            const subject = document.getElementById('editCourseSubject').value;
            fetch('edit_course_request.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, first_name, last_name, email, phone, subject })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeEditCourseRequestModal();
                    loadCourseRequests();
                    showNotification('Course request updated successfully', 'success');
                } else {
                    showNotification('Error: ' + data.message, 'error');
                }
            });
        };

        // --- Newsletter Edit Modal Logic ---
        function openEditNewsletterModal(sub) {
            document.getElementById('editNewsletterId').value = sub.id;
            document.getElementById('editNewsletterEmail').value = sub.email;
            document.getElementById('editNewsletterModal').style.display = 'flex';
        }
        
        function closeEditNewsletterModal() {
            document.getElementById('editNewsletterModal').style.display = 'none';
        }
        
        document.getElementById('editNewsletterForm').onsubmit = function(e) {
            e.preventDefault();
            const id = document.getElementById('editNewsletterId').value;
            const email = document.getElementById('editNewsletterEmail').value;
            fetch('edit_newsletter.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, email })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeEditNewsletterModal();
                    loadNewsletterSubscriptions();
                    showNotification('Newsletter subscription updated successfully', 'success');
                } else {
                    showNotification('Error: ' + data.message, 'error');
                }
            });
        };

        // --- Contact Message Edit Modal Logic ---
        function openEditContactMessageModal(msg) {
            document.getElementById('editContactMessageId').value = msg.id;
            document.getElementById('editContactName').value = msg.name;
            document.getElementById('editContactEmail').value = msg.email;
            document.getElementById('editContactSubject').value = msg.subject;
            document.getElementById('editContactMessage').value = msg.message;
            document.getElementById('editContactMessageModal').style.display = 'flex';
        }
        
        function closeEditContactMessageModal() {
            document.getElementById('editContactMessageModal').style.display = 'none';
        }
        
        document.getElementById('editContactMessageForm').onsubmit = function(e) {
            e.preventDefault();
            const id = document.getElementById('editContactMessageId').value;
            const name = document.getElementById('editContactName').value;
            const email = document.getElementById('editContactEmail').value;
            const subject = document.getElementById('editContactSubject').value;
            const message = document.getElementById('editContactMessage').value;
            fetch('edit_contact_message.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, name, email, subject, message })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeEditContactMessageModal();
                    loadContactMessages();
                    showNotification('Contact message updated successfully', 'success');
                } else {
                    showNotification('Error: ' + data.message, 'error');
                }
            });
        };
    </script>
</body>
</html>
