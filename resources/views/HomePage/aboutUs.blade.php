@extends('layouts.webSite')
@section('title', 'About Us')
@section('content')

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
        }
</style>

        
        <!-- About Area start -->
        <section class="about-area-two py-50 pt-140 rel z-1">
       <div class="">
       <img src="./assets/images/imageabout1.jpg" style="max-height:200px;width:100%" alt=""> 
       </div>   
            <div class="container pt-5" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                <h2 class="text-center">About Us</h2>
           <p style="text-align:justify">Welcome to odishavoyages.com, your ultimate guide to exploring the vibrant state of Odisha. We are passionate about showcasing the cultural richness, spiritual heritage, and natural beauty of this incredible region. From the majestic Sun Temple of Konark and the sacred Jagannath Temple in Puri to the serene waters
             of Chilika Lake and the lush greenery of Daringbadi, we bring you curated travel
              experiences that combine history, adventure, and relaxation.</p>

<p style="text-align:justify">Our mission is to make your journey through Odisha seamless, memorable, and enriching. We offer carefully crafted travel packages, expert local guidance, and insider tips to help you discover hidden gems, participate in traditional 
  festivals, and experience authentic Odia culture.
   Whether you are a history enthusiast, nature lover, spiritual seeker, or simply looking for a peaceful getaway,
   odishavoyages.com is here to turn your Odisha dreams into reality.</p>
                </div>
        </section>

      <section class="about-section">
  <div class="container">
    <div class="row">
        <h2 class="text-center">About Odisha</h2>
      
      <!-- Left Side Image -->
      <div class="col-left" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
        <img src="https://s7ap1.scene7.com/is/image/incredibleindia/sri-jagannath-temple-puri-odisha-1-attr-hero?qlt=82&ts=1726663747217" alt="Odisha Image">
      </div>

      <!-- Right Side Text -->
      <div class="col-right" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
        <p style="text-align:justify">
        Odisha, located on the eastern coast of India along the Bay of Bengal, is a land of rich history, vibrant culture, and natural beauty. The state has a heritage that dates back over 5,000 years, with evidence of ancient dynasties, religions, and civilizations visible in its temples, monuments, and traditional art forms. Odisha is famous for its exquisite temple architecture, including the Sun Temple at Konark and the Jagannath Temple at Puri, both of which attract pilgrims and tourists from all over the world. Its diverse landscape ranges from serene beaches like Puri and Chandipur to lush forests, wildlife sanctuaries, and picturesque hill stations such as Daringbadi. Chilika Lake, Asia’s largest brackish water lagoon, is a haven for migratory birds and dolphins, drawing nature enthusiasts year-round. Odisha is also known for its classical dance form Odissi, intricate 
        handicrafts like Pattachitra paintings and silver filigree work, and colorful festivals such as Rath Yatra and Durga Puja. The state blends spirituality, culture, history, and natural wonders, making it a unique and unforgettable travel destination in India.</p>
      </div>

    </div>
  </div>
</section>

<!-- Vision, Mission, Values Section -->
<section class="vmv-section py-5" style="background-color: #fff;">
  <div class="container" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
    <h2 class="text-center mb-5">Our Vision, Mission & Values</h2>
    
    <div class="row mb-4">
      <div class="col-md-12">
        <h4><strong>Our Vision</strong></h4>
        <p style="text-align:justify;">
          To be the most trusted and preferred travel companion for exploring the true essence of Odisha – its heritage, culture, spirituality, and natural beauty – by delivering authentic and enriching travel experiences.
        </p>
      </div>
    </div>
    
    <div class="row mb-4">
      <div class="col-md-12">
        <h4><strong>Our Mission</strong></h4>
        <p style="text-align:justify;">
          Our mission is to promote Odisha as a world-class travel destination by offering curated travel packages, personalized services, and immersive journeys that connect travelers with the heart and soul of the region. We are committed to sustainable tourism, supporting local communities, and preserving Odisha’s cultural and natural heritage.
        </p>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <h4><strong>Our Values</strong></h4>
        <ul style="text-align:justify; padding-left: 20px; line-height: 1.8;">
          <li><strong>Authenticity:</strong> Showcasing the real Odisha through local experiences.</li>
          <li><strong>Integrity:</strong> Honest, transparent, and customer-first approach.</li>
          <li><strong>Sustainability:</strong> Promoting eco-friendly and responsible tourism.</li>
          <li><strong>Excellence:</strong> Delivering the highest quality of service.</li>
          <li><strong>Respect:</strong> Valuing local communities, cultures, and the environment.</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<style>
.vmv-section h4 {
  color: #1e3c72;
  font-weight: 600;
  margin-bottom: 10px;
}
.vmv-section p, .vmv-section li {
  color: #444;
  font-size: 1.05rem;
}
.vmv-section ul {
  list-style-type: disc;
}
</style>

<script>
      AOS.init({
            duration: 1000,
            offset: 100,
            once: true
        });
</script>
<style>
.about-section {
  padding: 60px 20px;
  background: #f9f9f9;
}
.about-section .row {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 20px;
}
.about-section .col-left {
  flex: 1 1 40%;
  text-align: center;
}
.about-section .col-left img {
  max-width: 100%;
  border-radius: 12px;
}
.about-section .col-right {
  flex: 1 1 55%;
  padding: 25px;
  border-radius: 12px;
}
.about-section .col-right h2 {
  margin-bottom: 20px;
  font-weight: 600;
  color: #333;
}
.about-section .col-right p {
  color: #555;
  line-height: 1.7;
  margin-bottom: 15px;
}
</style>


       
@endsection         
            
        