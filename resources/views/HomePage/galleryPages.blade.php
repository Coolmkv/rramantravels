@extends('layouts.webSite')

@section('title', 'Gallery')
@section('content')

    <!-- Gallery Area start -->
    <style>
       h2 {
            font-size: 3rem;
            font-weight: 700;
         background: linear-gradient(45deg, #ff9933, #b22222, #1e3c72, #228b22);
   background-size: 300% 300%;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 4s ease-in-out infinite;
            margin-bottom: 20px;
            position: relative;
        }

         h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, transparent, #ff6b8a, transparent);
            border-radius: 2px;
            animation: underlineGlow 2s ease-in-out infinite alternate;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes underlineGlow {
            from { box-shadow: 0 0 5px #ff6b6b; }
            to { box-shadow: 0 0 20px #ff6b6b, 0 0 30px #ff6b6b; }
        }    /* Floating Background Emojis */
        .emoji-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }

        .floating-emoji {
            position: absolute;
            font-size: 2rem;
            opacity: 0.1;
            animation: float 20s infinite linear;
        }

        .floating-emoji:nth-child(1) { left: 10%; animation-delay: 0s; }
        .floating-emoji:nth-child(2) { left: 20%; animation-delay: -2s; }
        .floating-emoji:nth-child(3) { left: 30%; animation-delay: -4s; }
        .floating-emoji:nth-child(4) { left: 40%; animation-delay: -6s; }
        .floating-emoji:nth-child(5) { left: 50%; animation-delay: -8s; }
        .floating-emoji:nth-child(6) { left: 60%; animation-delay: -10s; }
        .floating-emoji:nth-child(7) { left: 70%; animation-delay: -12s; }
        .floating-emoji:nth-child(8) { left: 80%; animation-delay: -14s; }
        .floating-emoji:nth-child(9) { left: 90%; animation-delay: -16s; }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.1;
            }
            90% {
                opacity: 0.1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Animated Background Particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: sparkle 3s infinite;
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0); }
            50% { opacity: 1; transform: scale(1); }
        }

        /* Main Gallery Styles */
        .gallery-section {
            padding: 120px 0 100px;
            position: relative;
            z-index: 1;
        }

        .blog-banner {
            margin-bottom: 50px;
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .blog-banner img {
            max-height: 300px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .blog-banner:hover img {
            transform: scale(1.05);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-title {
            text-align: center;
            margin-top: 20px;
            color: white;
            animation: fadeInUp 1s ease-out;
        }

     
        @keyframes textGlow {
            from { filter: drop-shadow(0 0 10px rgba(255,255,255,0.3)); }
            to { filter: drop-shadow(0 0 20px rgba(255,255,255,0.6)); }
        }

        .section-title p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            padding: 20px 0;
        }

        .gallery-item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideInUp 0.8s ease-out;
        }

        .gallery-item:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
            background: rgba(255, 255, 255, 0.15);
        }

        .image-container {
            position: relative;
            overflow: hidden;
            height: 250px;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.6s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1) rotate(2deg);
            filter: brightness(1.1) saturate(1.2);
        }

        .overlay-link {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 1.5rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .gallery-item:hover .overlay-link {
            transform: translate(-50%, -50%) scale(1);
        }

        .overlay-link:hover {
            background: #fff;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            text-align: center;
         background-color: rgba(241, 196, 15, 0.5);
   backdrop-filter: blur(10px);
            opacity: 0;
            transform: translateY(100%);
            transition: all 0.4s ease;
            border-radius: 0 0 20px 20px;
        }

        .content h5 {
            color: white;
            font-size: 12px;
            margin: 0;
            transition: all 0.3s ease;
        }

        .gallery-item:hover .content {
            opacity: 1;
            transform: translateY(0);
        }

        .gallery-item:hover .content h5 {
            text-shadow: 0 2px 15px rgba(0,0,0,0.5);
            transform: scale(1.05);
        }

        /* Staggered Animation */
        .gallery-item:nth-child(1) { animation-delay: 0.1s; }
        .gallery-item:nth-child(2) { animation-delay: 0.2s; }
        .gallery-item:nth-child(3) { animation-delay: 0.3s; }
        .gallery-item:nth-child(4) { animation-delay: 0.4s; }
        .gallery-item:nth-child(5) { animation-delay: 0.5s; }
        .gallery-item:nth-child(6) { animation-delay: 0.6s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .floating-emoji {
                font-size: 1.5rem;
            }
        }

        /* Fun cursor effect */
        .gallery-item {
            cursor: pointer;
        }

        /* Additional decorative elements */
        .decorative-circle {
            position: absolute;
            width: 200px;
            height: 200px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: rotate 20s linear infinite;
        }

        .decorative-circle:nth-child(1) {
            top: 10%;
            right: 10%;
            animation-delay: 0s;
        }

        .decorative-circle:nth-child(2) {
            bottom: 10%;
            left: 10%;
            animation-delay: -10s;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
    </style>
    
    <section class=" py-20">
    <!-- Floating Emoji Background -->
    <div class="emoji-bg">
        <div class="floating-emoji">📸</div>
        <div class="floating-emoji">🌟</div>
        <div class="floating-emoji">✨</div>
        <div class="floating-emoji">🎨</div>
        <div class="floating-emoji">🏞️</div>
        <div class="floating-emoji">🌅</div>
        <div class="floating-emoji">🏔️</div>
        <div class="floating-emoji">🏖️</div>
        <div class="floating-emoji">🌊</div>
    </div>

    <!-- Animated Particles -->
    <div class="particles" id="particles"></div>

    <!-- Decorative Circles -->
    <div class="decorative-circle"></div>
    <div class="decorative-circle"></div>

    <section class="gallery-section">
        <!-- Banner -->
        <div class="">
            <img src="./assets/images/imageabout1.jpg" style="width:100%;max-height:250px" alt="Gallery Banner">
        </div>
        
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    /* General Form Styles */
    .search-form {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        padding: 20px;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
        gap: 20px;
        flex-wrap: wrap;
        max-width: 1300px;
        margin: 0 auto;
        border-radius: 15px;
    }

    .form-heading {
        flex-basis: 100%;
        text-align: center;
        font-size: 1.3rem;
        font-weight: bold;
        color: black;
        margin-bottom: 15px;
    }

    /* Form Group with Box & Icon */
    .form-group {
        position: relative;
        flex: 1;
        min-width: 150px;
        margin-bottom:0px !important;
    }

    .form-group i {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: #888;
        font-size: 1rem;
        pointer-events: none;
        transition: 0.3s;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 12px 12px 40px; /* padding-left for icon */
        border: 1px solid #ddd;
        border-radius: 8px;
        outline: none;
        font-size: 1rem;
        font-weight: 500;
        background: #fafafa;
        transition: 0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #43a047;
        background: #fff;
    }

    .form-group input:focus + i,
    .form-group textarea:focus + i {
        color: #43a047;
    }

    textarea {
        resize: none;
    }

    .search-btn {
        background: #F1C40F;
        color: black;
        border: none;
        border-radius: 30px;
        padding: 14px 30px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        white-space: nowrap;
        align-self: center;
    }

    .search-btn:hover {
        background: #43a047;
        color: #fff;
    }

    /* Medium Devices (Tablets: 768px - 991px) */
    @media (min-width: 768px) and (max-width: 991px) {
        .search-form {
            gap: 15px;
            padding: 15px;
        }

        .form-group {
            flex: 1 1 calc(50% - 7.5px);
        }

        .search-btn {
            flex-basis: 100%;
            margin-top: 10px;
        }
    }

    /* Small Devices (Mobile: <768px) */
    @media (max-width: 767px) {
        .search-form {
            flex-direction: column;
            gap: 12px;
            padding: 15px;
        }

        .form-group {
            flex: 1 1 100%;
        }

        .search-btn {
            width: 100%;
        }
    }
</style>

<section class="pb-3">
    <form id="aboutForm" class="search-form">
        @csrf
        <span class="form-heading">Discover Odisha: Where Culture Meets Adventure</span>

        <div class="form-group">
            <input type="text" name="name" placeholder="Your Name" required>
            <i class="fa fa-user"></i>
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Your Email" required>
            <i class="fa fa-envelope"></i>
        </div>

        <div class="form-group">
            <input type="tel" name="phone" placeholder="Your Phone" required>
            <i class="fa fa-phone"></i>
        </div>

        <div class="form-group">
            <textarea name="message" placeholder="Your Message" rows="1" required></textarea>
            <i class="fa fa-comment"></i>
        </div>

        <button class="search-btn" type="submit">Submit</button>
    </form>
</section>
<script>
    document.getElementById('aboutForm').addEventListener('submit', function(e) {
        e.preventDefault(); // prevent default form submit

        let form = e.target;
        let formData = new FormData(form);

        fetch("{{ route('query.submit') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Show toast message
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });

            // Reset form fields
            form.reset();
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
            });
        });
    });
    </script>
   
        <div class="container ">
            <!-- Section Title -->
            <div class="section-title">
                <h2>✨ Explore Our Photo Gallery ✨</h2>
                <p style="color:black">🌟 One site many popular experiences you'll remember 🌟</p>
            </div>
           <div class="gallery-grid">
    @foreach($galleryImages as $item)
        <div class="gallery-item">
            <div class="image-container">
                <img src="{{ $item->local_image ?? $item->image_link }}" alt="{{ $item->alternate_text ?? 'Gallery Image' }}">
                <a href="{{ $item->local_image ?? $item->image_link }}"
                   data-fancybox="gallery"
                   data-caption="{{ $item->title }}"
                   class="overlay-link">
                   ➡️
                </a>
            </div>
            <div class="content">
                <h5>{{ $item->title }}</h5>
            </div>
        </div>
    @endforeach
</div>
        </div>
    </section>
    </section>
    <script>
  Fancybox.bind("[data-fancybox='gallery']", {
    Thumbs: {
      autoStart: true,
    },
    Toolbar: {
      display: [
        "zoom",
        "close", // show close button
      ],
    },
  });
</script>
<!-- Fancybox CSS -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"
/>
<!-- Fancybox JS -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>

    <script>
        
        // Create animated particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 3 + 's';
                particle.style.animationDuration = (Math.random() * 2 + 2) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Add hover effects with emoji reactions
        function addHoverEffects() {
            const galleryItems = document.querySelectorAll('.gallery-item');
            
            galleryItems.forEach((item, index) => {
                item.addEventListener('mouseenter', () => {
                    // Create temporary emoji burst
                    const emoji = ['💫', '⭐', '✨', '🌟', '💖'][index % 5];
                    createEmojiBurst(item, emoji);
                });
            });
        }

        function createEmojiBurst(element, emoji) {
            for (let i = 0; i < 5; i++) {
                const emojiElement = document.createElement('div');
                emojiElement.textContent = emoji;
                emojiElement.style.position = 'absolute';
                emojiElement.style.fontSize = '1.5rem';
                emojiElement.style.pointerEvents = 'none';
                emojiElement.style.zIndex = '1000';
                emojiElement.style.left = '50%';
                emojiElement.style.top = '50%';
                emojiElement.style.transform = 'translate(-50%, -50%)';
                emojiElement.style.opacity = '1';
                
                element.style.position = 'relative';
                element.appendChild(emojiElement);

                // Animate the burst
                const angle = (i / 5) * 2 * Math.PI;
                const distance = 80;
                const x = Math.cos(angle) * distance;
                const y = Math.sin(angle) * distance;

                emojiElement.animate([
                    { transform: 'translate(-50%, -50%) scale(0)', opacity: 1 },
                    { transform: `translate(calc(-50% + ${x}px), calc(-50% + ${y}px)) scale(1)`, opacity: 0 }
                ], {
                    duration: 800,
                    easing: 'ease-out'
                }).onfinish = () => emojiElement.remove();
            }
        }

        // Parallax effect for floating emojis
        function addParallaxEffect() {
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelectorAll('.floating-emoji');
                
                parallax.forEach((element, index) => {
                    const speed = (index + 1) * 0.1;
                    element.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });
        }

        // Mouse trail effect
        function addMouseTrail() {
            let mouseX = 0, mouseY = 0;
            let trail = [];
            
            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
                
                const trailElement = document.createElement('div');
                trailElement.style.position = 'fixed';
                trailElement.style.left = mouseX + 'px';
                trailElement.style.top = mouseY + 'px';
                trailElement.style.width = '6px';
                trailElement.style.height = '6px';
                trailElement.style.background = 'rgba(255, 255, 255, 0.6)';
                trailElement.style.borderRadius = '50%';
                trailElement.style.pointerEvents = 'none';
                trailElement.style.zIndex = '999';
                
                document.body.appendChild(trailElement);
                
                setTimeout(() => {
                    trailElement.remove();
                }, 500);
                
                trailElement.animate([
                    { opacity: 1, transform: 'scale(1)' },
                    { opacity: 0, transform: 'scale(0)' }
                ], {
                    duration: 500,
                    easing: 'ease-out'
                });
            });
        }

        // Initialize all effects
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            addHoverEffects();
            addParallaxEffect();
            addMouseTrail();
        });
    </script>
  <!-- Gallery Area end -->


@endsection
