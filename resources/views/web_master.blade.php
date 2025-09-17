<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Primary Meta Tags -->
  <title>Swipetrend Pvt Ltd — Hitachi Air Conditioning Experts in Patna</title>
  <meta name="title" content="Swipetrend Pvt Ltd — Hitachi Air Conditioning Experts in Patna">
  <meta name="description" content="Swipetrend Private Limited provides residential & commercial Hitachi air conditioning solutions in Patna and nearby areas: Split, Window, VRF, Ductable AC installation, chillers & controls. Timely delivery with professional service.">

  <!-- Keywords -->
  <meta name="keywords" content="Swipetrend, Hitachi AC Patna, VRF installation, ductable AC, split AC, window AC, chillers, air conditioning services, HVAC Patna, commercial AC installation, residential AC installation">

  <!-- Author -->
  <meta name="author" content="Ankur Aditya">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://swipetrend.in/">
  <meta property="og:title" content="Swipetrend Pvt Ltd — Hitachi Air Conditioning Experts in Patna">
  <meta property="og:description" content="Residential & Commercial AC solutions: Split, Window, VRF, Ductable, chillers & controls in Patna. Trusted Hitachi partner.">
  <meta property="og:image" content="assets/img/Open-Graph-Facebook-og-image.png">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="https://swipetrend.in/">
  <meta name="twitter:title" content="Swipetrend Pvt Ltd — Hitachi Air Conditioning Experts in Patna">
  <meta name="twitter:description" content="Residential & Commercial AC solutions: Split, Window, VRF, Ductable, chillers & controls in Patna. Trusted Hitachi partner.">
  <meta name="twitter:image" content="assets/img/Open-Graph-Facebook-og-image.png">

<!-- Mobile -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#2B6CB0">

  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon.png">
  <link rel="apple-touch-icon" href="assets/img/favicon.png">
  <meta name="msapplication-TileImage" content="assets/img/favicon.png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>

  <!-- External CSS -->
  <link href="{{asset('frontend/assets/css/styles.css')}}" rel="stylesheet" />
</head>
<body>

    <!-- Header -->
    @include('layouts.header')
    <!-- /Header -->

    <!-- Main Page -->
    @yield('main')
    <!-- End Main Page -->

    <!-- Footer -->
    @include('layouts.footer')
    <!-- /Footer -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('y').textContent = new Date().getFullYear();
  </script>
</body>
</html>
