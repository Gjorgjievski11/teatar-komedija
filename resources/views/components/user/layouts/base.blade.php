<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Театар Комедија</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/bcc8e670c5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
            <!-- Open Graph Meta Tags for Social Media Sharing -->
        <meta property="og:title" content="НУ Театар Комедија">
        <meta property="og:description" content="Театар Комедија е жанровски определен театар, кој ги негува сите подвидови на комедијата и на својот репертоар вбројува праизведби од македонски автори, комедии од класиците на светската книжевност и современи комедии од светската драматургија.">
        <meta property="og:image" content="{{ asset('meta.png') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="628">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Teatar Komedija">
        
        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="НУ Театар Комедија">
        <meta name="twitter:description" content="Театар Комедија е жанровски определен театар, кој ги негува сите подвидови на комедијата и на својот репертоар вбројува праизведби од македонски автори, комедии од класиците на светската книжевност и современи комедии од светската драматургија.">
        <meta name="twitter:image" content="{{ asset('meta.png') }}">
        <meta name="twitter:image:width" content="1200">
        <meta name="twitter:image:height" content="628"> 
    
    <!-- Additional Meta Tags -->
    <meta name="description" content="Театар Комедија е жанровски определен театар, кој ги негува сите подвидови на комедијата и на својот репертоар вбројува праизведби од македонски автори, комедии од класиците на светската книжевност и современи комедии од светската драматургија.">
    <meta name="keywords" content="theater, comedy, teatar komedija, skopje theater, macedonian theater, комедија, театар, театар комедија, скопски театар, македонски театар">
    
    @livewireStyles
</head>


<body class="font-Inter overflow-x-hidden">
    <x-user.layouts.header />
    {{ $slot }}
    <x-user.layouts.footer />
    @livewireScripts
</body>

</html>
