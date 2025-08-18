// Mobile nav toggle with overlay & aria (resilient / re-query on use)
function getEl(id){ return document.getElementById(id); }
function openNav(){
  const hamburger = getEl('hamburger');
  const mainnav = getEl('mainnav');
  const navOverlay = getEl('navOverlay');
  if(!mainnav || !hamburger || !navOverlay) return;
  mainnav.classList.add('open');
  mainnav.setAttribute('aria-hidden','false');
  hamburger.setAttribute('aria-expanded','true');
  navOverlay.classList.add('active');
  navOverlay.setAttribute('aria-hidden','false');
  // prevent body scroll when open
  document.body.classList.add('nav-open');
  // focus first link
  mainnav.querySelector('a')?.focus();
}
function closeNav(){
  const hamburger = getEl('hamburger');
  const mainnav = getEl('mainnav');
  const navOverlay = getEl('navOverlay');
  if(!mainnav || !hamburger || !navOverlay) return;
  mainnav.classList.remove('open');
  // on wider screens keep nav visible for accessibility
  mainnav.setAttribute('aria-hidden', window.innerWidth > 900 ? 'false' : 'true');
  hamburger.setAttribute('aria-expanded','false');
  navOverlay.classList.remove('active');
  navOverlay.setAttribute('aria-hidden','true');
  // restore body scroll
  document.body.classList.remove('nav-open');
  hamburger.focus();
}

// Use event delegation so handlers remain valid after resize
document.addEventListener('click', (e)=>{
  const hb = e.target.closest('#hamburger');
  if(hb){
    const mainnav = getEl('mainnav');
    if(mainnav && mainnav.classList.contains('open')) closeNav(); else openNav();
  }
  if(e.target.closest('#navOverlay')) closeNav();
});

// Close nav on Escape (re-query when handling)
document.addEventListener('keydown', (e)=>{
  if(e.key === 'Escape'){
    const mainnav = getEl('mainnav');
    if(mainnav && mainnav.classList.contains('open')) closeNav();
  }
});

// Ensure nav state is correct on resize (avoid stale open state when switching layouts)
window.addEventListener('resize', ()=>{
  const mainnav = getEl('mainnav');
  const navOverlay = getEl('navOverlay');
  const hamburger = getEl('hamburger');
  if(!mainnav || !navOverlay || !hamburger) return;
  if(window.innerWidth > 900){
    // desktop layout: make sure nav is visible and overlay removed
    mainnav.classList.remove('open');
    mainnav.setAttribute('aria-hidden','false');
    navOverlay.classList.remove('active');
    navOverlay.setAttribute('aria-hidden','true');
    hamburger.setAttribute('aria-expanded','false');
    // ensure body class removed
    document.body.classList.remove('nav-open');
  } else {
    // mobile layout: keep nav closed by default
    mainnav.setAttribute('aria-hidden','true');
    hamburger.setAttribute('aria-expanded','false');
  }
});

// Sticky header shadow on scroll
const navwrap = document.querySelector('.navwrap');
window.addEventListener('scroll', ()=>{
  if(window.scrollY > 20) navwrap.classList.add('scrolled'); else navwrap.classList.remove('scrolled');
});

// Smooth internal links
document.querySelectorAll('a[href^="#"]').forEach(a=>{
  a.addEventListener('click', (e)=>{
    const target = document.querySelector(a.getAttribute('href'));
    if(target){e.preventDefault(); target.scrollIntoView({behavior:'smooth',block:'start'}); closeNav();}
  });
});

// Reveal on scroll
const reveals = document.querySelectorAll('.reveal');
const revealObserver = new IntersectionObserver((entries, obs) => {
  entries.forEach(entry => {
    if(entry.isIntersecting){
      entry.target.classList.add('is-visible');
      obs.unobserve(entry.target);
    }
  });
},{threshold:0.18});
reveals.forEach(r=>revealObserver.observe(r));

// Animated counters
const counters = document.querySelectorAll('.count');
const speed = 120;
const runCounter = (el)=>{
  const target = +el.getAttribute('data-target');
  let count = 0;
  const step = Math.ceil(target / speed);
  const timer = setInterval(()=>{
    count += step;
    if(count >= target){
      el.textContent = target;
      clearInterval(timer);
    } else {
      el.textContent = count;
    }
  },20);
};

const obs = new IntersectionObserver(entries=>{
  entries.forEach(entry=>{
    if(entry.isIntersecting){
      runCounter(entry.target);
      obs.unobserve(entry.target);
    }
  })
},{threshold:0.6});

counters.forEach(c=>obs.observe(c));

// Form handling with PHP backend
function showMessage(elementId, message, isSuccess = true) {
  const element = document.getElementById(elementId);
  if (!element) return;
  
  element.textContent = message;
  element.style.display = 'block';
  element.style.backgroundColor = isSuccess ? '#d4edda' : '#f8d7da';
  element.style.color = isSuccess ? '#155724' : '#721c24';
  element.style.border = isSuccess ? '1px solid #c3e6cb' : '1px solid #f5c6cb';
  
  setTimeout(() => {
    element.style.display = 'none';
  }, 5000);
}

// Course request form (guarded so pages without the request form won't throw)
const requestForm = document.getElementById('requestForm');
if(requestForm){
  requestForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(requestForm);
    const submitBtn = requestForm.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    
    try {
      submitBtn.textContent = 'Sending...';
      submitBtn.disabled = true;
      
      const response = await fetch('admin/process_course_request.php', {
        method: 'POST',
        body: formData
      });
      
      const result = await response.json();
      
      if (result.success) {
        showMessage('requestMessage', result.message, true);
        requestForm.reset();
      } else {
        showMessage('requestMessage', result.message, false);
      }
    } catch (error) {
      showMessage('requestMessage', 'Error submitting form. Please try again.', false);
    } finally {
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    }
  });
}

// Newsletter form handling
const newsletterForm = document.getElementById('newsletterForm');
if(newsletterForm){
  newsletterForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(newsletterForm);
    const submitBtn = newsletterForm.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    
    try {
      submitBtn.textContent = 'Subscribing...';
      submitBtn.disabled = true;
      
      const response = await fetch('admin/process_newsletter.php', {
        method: 'POST',
        body: formData
      });
      
      const result = await response.json();
      
      if (result.success) {
        showMessage('newsletterMessage', result.message, true);
        newsletterForm.reset();
        submitBtn.textContent = 'Subscribed ✓';
        setTimeout(() => {
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
        }, 3000);
      } else {
        showMessage('newsletterMessage', result.message, false);
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      }
    } catch (error) {
      showMessage('newsletterMessage', 'Error subscribing. Please try again.', false);
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    }
  });
}

// Contact form handling
const contactForm = document.getElementById('contactForm');
if(contactForm){
  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(contactForm);
    const submitBtn = contactForm.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    
    try {
      submitBtn.textContent = 'Sending...';
      submitBtn.disabled = true;
      
      const response = await fetch('admin/process_contact.php', {
        method: 'POST',
        body: formData
      });
      
      const result = await response.json();
      
      if (result.success) {
        showMessage('contactMessage', result.message, true);
        contactForm.reset();
      } else {
        showMessage('contactMessage', result.message, false);
      }
    } catch (error) {
      showMessage('contactMessage', 'Error sending message. Please try again.', false);
    } finally {
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
    }
  });
}

// focus style for nav links (query dynamically so resize / DOM changes are handled)
document.querySelectorAll('#mainnav a').forEach(link=>{
  link.addEventListener('focus', ()=> link.classList.add('focused'));
  link.addEventListener('blur', ()=> link.classList.remove('focused'));
});

// Sliding testimonials
const testimonials = [
  {
    quote: "NexaEducation made my university application process smooth and stress-free. Their team was always available to answer my questions!",
    name: "Prakash Shrestha",
    role: "Sophomore, Tokyo University",
    img: "https://randomuser.me/api/portraits/men/32.jpg"
  },
  {
    quote: "Thanks to Nexa, I received my student visa on time and felt prepared for life in Japan. Highly recommended!",
    name: "Sujata Karki",
    role: "Graduate, Kyoto Institute",
    img: "https://randomuser.me/api/portraits/women/44.jpg"
  },
  {
    quote: "The coaching and resources from NexaEducationCountaltancy helped me pass my entrance exams and settle in quickly.",
    name: "Bikash Thapa",
    role: "Freshman, Osaka University",
    img: "https://randomuser.me/api/portraits/men/65.jpg"
  },
  {
    quote: "Nexa's mentorship gave me confidence for interviews and cultural adaptation. I recommend them to every Nepali student!",
    name: "Rita Gurung",
    role: "Exchange Student, Waseda University",
    img: "https://randomuser.me/api/portraits/women/68.jpg"
  },
  {
    quote: "Visa support was excellent. NexaEducationCountaltancy guided me through every step and made it easy.",
    name: "Amit Joshi",
    role: "Master's, Nagoya University",
    img: "https://randomuser.me/api/portraits/men/23.jpg"
  },
  {
    quote: "I loved the language prep classes. The teachers were patient and the materials were top-notch.",
    name: "Manisha Rai",
    role: "Language Student, Tokyo",
    img: "https://randomuser.me/api/portraits/women/12.jpg"
  },
  {
    quote: "Nexa helped me find scholarships and affordable programs. Their advice saved me a lot of money.",
    name: "Sandeep Lama",
    role: "Scholarship Recipient, Kobe University",
    img: "https://randomuser.me/api/portraits/men/41.jpg"
  },
  {
    quote: "The pre-departure sessions were so useful. I felt ready for life in Japan before I even arrived.",
    name: "Puja Shrestha",
    role: "First Year, Sophia University",
    img: "https://randomuser.me/api/portraits/women/53.jpg"
  },
  {
    quote: "Nexa's team is friendly and knowledgeable. They made the whole process enjoyable.",
    name: "Rajiv KC",
    role: "Business Student, Ritsumeikan University",
    img: "https://randomuser.me/api/portraits/men/77.jpg"
  },
  {
    quote: "I was nervous about moving abroad, but NexaEducationCountaltancy supported me every step of the way.",
    name: "Anita Magar",
    role: "Graduate, Fukuoka University",
    img: "https://randomuser.me/api/portraits/women/21.jpg"
  }
];

// Testimonial slider (only run if the slider element exists)
const testimonialSliderEl = document.getElementById('testimonialSlider');
if(testimonialSliderEl){
  function showTestimonial(idx) {
    const t = testimonials[idx];
    testimonialSliderEl.innerHTML = `
      <div class="testimonial-card testimonial-slide">
        <div class="testimonial-quote">“${t.quote}”</div>
        <div class="testimonial-meta">
          <img src="${t.img}" alt="${t.name}" class="testimonial-img">
          <div>
            <div class="testimonial-name">${t.name}</div>
            <div class="testimonial-role">${t.role}</div>
          </div>
        </div>
      </div>
    `;
  }
  let testimonialIdx = 0;
  showTestimonial(testimonialIdx);
  setInterval(() => {
    testimonialIdx = (testimonialIdx + 1) % testimonials.length;
    showTestimonial(testimonialIdx);
  }, 2000);
}

// Enhanced Sticky Header with Hide/Show on Scroll
let lastScrollY = window.scrollY;
let isScrollingUp = false;
let scrollTimeout;
let headerVisible = true;

function handleScroll() {
  const navwrap = document.querySelector('.navwrap');
  if (!navwrap) return;

  const currentScrollY = window.scrollY;
  const scrollDelta = Math.abs(currentScrollY - lastScrollY);
  
  // Clear existing timeout
  clearTimeout(scrollTimeout);
  
  // Only process significant scroll movements
  if (scrollDelta < 3) return;
  
  if (currentScrollY > 100) {
    navwrap.classList.add('scrolled');
    
    if (currentScrollY < lastScrollY && scrollDelta > 10) {
      // Scrolling up significantly - show header
      if (!headerVisible) {
        navwrap.classList.remove('header-hide');
        navwrap.classList.add('header-show');
        headerVisible = true;
      }
    } else if (currentScrollY > lastScrollY && scrollDelta > 10 && currentScrollY > 200) {
      // Scrolling down significantly and past threshold - hide header
      if (headerVisible) {
        navwrap.classList.add('header-hide');
        navwrap.classList.remove('header-show');
        headerVisible = false;
      }
    }
  } else {
    // At top of page - always show header
    navwrap.classList.remove('scrolled', 'header-hide');
    navwrap.classList.add('header-show');
    headerVisible = true;
  }

  // Set timeout to show header after scrolling stops
  scrollTimeout = setTimeout(() => {
    if (!headerVisible) {
      navwrap.classList.remove('header-hide');
      navwrap.classList.add('header-show');
      headerVisible = true;
    }
  }, 1000);

  lastScrollY = currentScrollY;
}

// Throttle scroll events for better performance
let ticking = false;
function requestTick() {
  if (!ticking) {
    requestAnimationFrame(handleScroll);
    ticking = true;
    setTimeout(() => { ticking = false; }, 16);
  }
}

window.addEventListener('scroll', requestTick, { passive: true });

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
  const navwrap = document.querySelector('.navwrap');
  if (navwrap) {
    navwrap.classList.add('header-show');
    headerVisible = true;
  }
  handleScroll();
});
