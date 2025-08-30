<?php
// Copyright © 2025 Shiva Sharan Shrestha. All rights reserved. This code is part of NexaEducationCountaltancy.

// Add sample blog posts for testing
require_once 'admin/database.php';

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Create table if it doesn't exist
    $conn->exec("CREATE TABLE IF NOT EXISTS blog_posts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        content TEXT NOT NULL,
        excerpt TEXT,
        author TEXT DEFAULT 'NexaEducation Admin',
        featured_image TEXT,
        status TEXT DEFAULT 'published',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Check if we already have posts
    $stmt = $conn->query("SELECT COUNT(*) as count FROM blog_posts");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] == 0) {
        // Add sample posts
        $samplePosts = [
            [
                'title' => 'How to Prepare for Japanese University Admissions',
                'content' => 'Studying in Japan is a dream for many Nepali students. Here\'s a comprehensive guide on how to prepare for Japanese university admissions...',
                'excerpt' => 'A step-by-step guide for Nepali students: application timelines, required documents, and tips for a successful admission process.',
                'author' => 'NexaEducation Team',
                'featured_image' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?q=80&w=800&auto=format&fit=crop',
                'status' => 'published'
            ],
            [
                'title' => 'Visa Application Tips for Japan',
                'content' => 'Getting a student visa for Japan requires careful preparation and attention to detail. Here are essential tips...',
                'excerpt' => 'Essential advice for Nepali students on preparing and submitting your Japanese student visa application, including common mistakes to avoid.',
                'author' => 'NexaEducation Team',
                'featured_image' => 'https://images.unsplash.com/photo-1503676382389-4809596d5290?q=80&w=800&auto=format&fit=crop',
                'status' => 'published'
            ],
            [
                'title' => 'Student Life in Japan: What to Expect',
                'content' => 'Life as an international student in Japan is unique and exciting. Here\'s what you can expect...',
                'excerpt' => 'Discover the culture, campus life, and opportunities for Nepali students in Japan. Tips for adapting and thriving abroad.',
                'author' => 'NexaEducation Team',
                'featured_image' => 'https://images.unsplash.com/photo-1513258496099-48168024aec0?q=80&w=800&auto=format&fit=crop',
                'status' => 'published'
            ]
        ];
        
        $stmt = $conn->prepare("INSERT INTO blog_posts (title, content, excerpt, author, featured_image, status) VALUES (?, ?, ?, ?, ?, ?)");
        
        foreach ($samplePosts as $post) {
            $stmt->execute([
                $post['title'],
                $post['content'],
                $post['excerpt'],
                $post['author'],
                $post['featured_image'],
                $post['status']
            ]);
        }
        
        echo "Sample blog posts added successfully!";
    } else {
        echo "Blog posts already exist. Count: " . $result['count'];
    }
    
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
