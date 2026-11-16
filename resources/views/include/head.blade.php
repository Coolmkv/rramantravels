<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="description" content="Explore Jagannath Puri with sacred temple visits, golden beaches, spiritual vibes, and vibrant culture. Perfect tour packages for families, groups, and devotees">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="google-site-verification" content="j37auzKUwLy91mQcSfJnJ8fWuWt3Pmp--1MySzCLagY">

<!-- Title -->
<title>@yield('title','Jagannath Puri Affordable Tour Packages for You and Pilgrims')</title>

<!-- Favicon -->
@php
    $faviconLogo = getWebsiteElements()['Logo'] ?? null;
    $faviconUrl = $faviconLogo
        ? (
            \Illuminate\Support\Str::startsWith($faviconLogo, ['http://', 'https://'])
                ? $faviconLogo
                : asset(ltrim($faviconLogo, '/'))
        )
        : "";
@endphp
<link rel="icon" href="{{ $faviconUrl }}" type="image/png">

<!-- Google Font (optimized preload) -->
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Canonical -->
<link rel="canonical" href="{{ url('/') }}">

<!-- LOCAL CSS (kept only necessary files) -->
<link rel="stylesheet" href="{{ asset('assets/css/flaticon.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/nice-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">

<!-- Swiper (only one version kept) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<!-- Font Awesome latest -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous">

<!-- Google Analytics tag (ONLY ONE – merged) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-BR4C9P8T7P"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){ dataLayer.push(arguments); }
  gtag('js', new Date());
  gtag('config', 'G-BR4C9P8T7P');
</script>

<!-- Schema.org (kept – correct) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebSite",
  "name": "odishavoyages",
  "url": "{{ url('/') }}",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{{ url('tours') }}{search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type": "ListItem","position": 1,"name": "odishavoyages","item": "{{ url('/') }}"},
    {"@type": "ListItem","position": 2,"name": "tours","item": "{{ url('tours') }}"},
    {"@type": "ListItem","position": 3,"name": "destinations","item": "{{ url('destinations') }}"},
    {"@type": "ListItem","position": 4,"name": "activitiespage","item": "{{ url('activitiespage') }}"},
    {"@type": "ListItem","position": 5,"name": "service-page","item": "{{ url('service-page') }}"},
    {"@type": "ListItem","position": 6,"name": "gallery","item": "{{ url('gallery') }}"}
  ]
}
</script>
