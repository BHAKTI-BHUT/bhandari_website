<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <?php
  $googlePlace = function_exists('get_google_place_details') ? get_google_place_details() : [];
  $gRating     = isset($googlePlace['rating']) ? floatval($googlePlace['rating']) : 4.9;
  $gCount      = isset($googlePlace['user_ratings_total']) ? intval($googlePlace['user_ratings_total']) : 18;
  $gAddress    = isset($googlePlace['formatted_address']) ? $googlePlace['formatted_address'] : 'Office No. 504, Baba Arcade, Harola, Sector 5, Noida, Uttar Pradesh 201301';
  $gLat        = isset($googlePlace['geometry']['location']['lat']) ? $googlePlace['geometry']['location']['lat'] : 28.5878278;
  $gLng        = isset($googlePlace['geometry']['location']['lng']) ? $googlePlace['geometry']['location']['lng'] : 77.3188016;
  $gMapUrl     = isset($googlePlace['url']) ? $googlePlace['url'] : 'https://maps.google.com/?cid=11321227447965075053';

  if (!@$city) $city = isset($address2) ? "$address2" : "Noida";
  if (!@$state) $state = isset($companystate) ? "$companystate" : "Uttar Pradesh";
  if (!@$img) $img = base_url('') . "assets/images/logo/logo.jpg";
  $clean_uri = trim($this->uri->uri_string(), '/');
  if (empty($clean_uri) || $clean_uri === 'home') {
      $url = rtrim(base_url(), '/') . '/';
  } else {
      $url = rtrim(base_url($clean_uri), '/');
  }
  $url = strtolower($url);
  $robots_meta = (!empty($noindex) && $noindex) ? 'noindex, follow' : 'index, follow';

  // ── Smart Page Name & Location Scope Detection ──
  $segments = array_values(array_filter(explode('/', $clean_uri)));
  $seg1 = strtolower($segments[0] ?? '');
  $seg2 = strtolower($segments[1] ?? '');

  $detectedPage = 'home';
  $detectedLoc  = null;

  if (empty($clean_uri) || $clean_uri === 'home') {
      $detectedPage = 'home';
      $detectedLoc  = null;
  } elseif (in_array($seg1, ['about', 'about-us', 'about_us'])) {
      $detectedPage = 'about-us';
  } elseif (in_array($seg1, ['why-choose-us', 'why_choose_us', 'choose'])) {
      $detectedPage = 'why-choose-us';
  } elseif (in_array($seg1, ['branches', 'our-branches', 'our_branches'])) {
      $detectedPage = 'branches';
  } elseif (in_array($seg1, ['testimonials', 'reviews', 'customer-reviews', 'testimonial'])) {
      $detectedPage = 'reviews';
  } elseif (in_array($seg1, ['online-booking', 'booking', 'bookings'])) {
      $detectedPage = 'online-booking';
  } elseif (in_array($seg1, ['my-bookings', 'my_bookings'])) {
      $detectedPage = 'my-bookings';
  } elseif (in_array($seg1, ['contact', 'contacts', 'contact-us', 'contact_us'])) {
      $detectedPage = 'contact-us';
  } elseif ($seg1 === 'faq' || $seg1 === 'faqs') {
      $detectedPage = 'faq';
  } elseif ($seg1 === 'infrastructure') {
      $detectedPage = 'infrastructure';
  } elseif ($seg1 === 'photo-gallery') {
      $detectedPage = 'photo-gallery';
  } elseif ($seg1 === 'video-gallery') {
      $detectedPage = 'video-gallery';
  } elseif (in_array($seg1, ['term-and-condition', 'terms-and-conditions', 'terms-and-condition', 'term_and_condition', 'terms'])) {
      $detectedPage = 'term-and-condition';
  } elseif (in_array($seg1, ['privacy', 'privacy-policy', 'privacy_policy'])) {
      $detectedPage = 'privacy-policy';
  } elseif (in_array($seg1, ['cancellation-refund', 'cancellation-and-refund', 'cancellation_refund'])) {
      $detectedPage = 'cancellation-refund';
  } elseif ($seg1 === 'blogs' || $seg1 === 'blog') {
      $detectedPage = (!empty($seg2) && $seg1 === 'blog') ? 'blog/' . $seg2 : 'blogs';
  } elseif ($seg1 === 'services') {
      $detectedPage = !empty($seg2) ? $seg2 : 'services';
  } elseif (in_array($seg1, [
      'home-relocation', 'office-relocation', 'car-transportation-service',
      'packing-unpacking', 'loading-unloading', 'warehousing-services',
      'goods-insurance', 'courier-and-cargo', 'luggage-delivery'
  ])) {
      $detectedPage = $seg1;
  } else {
      // Check for City/State routes or custom slug
      if (preg_match('/^packers-movers-([a-z0-9\-]+)-india$/', $seg1, $m)) {
          $detectedPage = 'location_page';
          $detectedLoc  = $m[1];
      } elseif (preg_match('/^([a-z0-9\-]+)-packers-movers-([a-z0-9\-]+)$/', $seg1, $m)) {
          $detectedPage = 'location_page';
          $detectedLoc  = $m[2];
      } elseif (preg_match('/^home-shifting-in-([a-z0-9\-]+)$/', $seg1, $m)) {
          $detectedPage = 'location_page';
          $detectedLoc  = $m[1];
      } else {
          $detectedPage = 'location_page';
          $detectedLoc  = $clean_uri;
      }
  }

  // Override with explicit variables if set by controller
  $seoPageName = !empty($seo_page_name) ? $seo_page_name : $detectedPage;
  $seoLocParam = !empty($seo_location) ? $seo_location : $detectedLoc;
  if (empty($seoLocParam) && $seoPageName === 'location_page' && !empty($city)) {
      $seoLocParam = strtolower(trim($city));
  }

  // Fetch dynamic SEO settings from Database (seo_settings table)
  $dbSeo = function_exists('get_seo_setting') ? get_seo_setting($seoPageName, $seoLocParam) : null;
  if (!$dbSeo && !empty($clean_uri)) {
      $dbSeo = get_seo_setting($clean_uri, null);
  }

  if (!empty($dbSeo)) {
      if (!empty($dbSeo['meta_title']))       $title = $dbSeo['meta_title'];
      if (!empty($dbSeo['meta_description'])) $description = $dbSeo['meta_description'];
      if (!empty($dbSeo['meta_keywords']))    $keywords = $dbSeo['meta_keywords'];
  }

  if (!@$description) {
    $description = "Bhandari Packers and Movers offers top-rated (" . $gRating . "★ Google Reviews) home shifting, office relocation, car transport, and packing services across India. Professional, affordable, and safe relocation.";
  }
  ?>
  <title><?= @$title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= @$description ?>" />
  <meta name="keywords" content="<?= @$keywords ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
  <link rel="canonical" href="<?= @$url ?>" />
  <meta name="author" content="<?= $company3 ?>" />
  <meta name="copyright" content="<?= $company3 ?>" />
  <meta name="reply-to" content="<?= $replyToMail ?>" />
  <meta name="expires" content="never" />
  <meta name="og_title" property="og:title" content="<?= @$title ?>">
  <meta property="og:type" content="website">
  <meta name="og_site_name" property="og:site_name" content="<?= $company3 ?>" />
  <meta property="og:image" content="<?= $img ?>" />
  <meta name="og_url" property="og:url" content="<?= @$url ?>" />
  <meta property="og:description" content="<?= @$description ?>" />
  <meta name="coverage" content="Worldwide" />
  <meta name="allow-search" content="yes" />
  <meta name="robots" content="<?= $robots_meta ?>" />
  <meta property="al:web:url" content="<?= @$url ?>">
  <meta name="theme-color" content="<?= $themeColor ?>">
  <meta name="HandheldFriendly" content="True">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="<?= $themeColor ?>">
  <meta name="allow-search" content="yes" />
  <?php $stateCodes = ['Andhra Pradesh' => 'AP', 'Arunachal Pradesh' => 'AR', 'Assam' => 'AS', 'Bihar' => 'BR', 'Chhattisgarh' => 'CG', 'Goa' => 'GA', 'Gujarat' => 'GJ', 'Haryana' => 'HR', 'Himachal Pradesh' => 'HP', 'Jharkhand' => 'JH', 'Karnataka' => 'KA', 'Kerala' => 'KL', 'Madhya Pradesh' => 'MP', 'Maharashtra' => 'MH', 'Manipur' => 'MN', 'Meghalaya' => 'ML', 'Mizoram' => 'MZ', 'Nagaland' => 'NL', 'Odisha' => 'OR', 'Punjab' => 'PB', 'Rajasthan' => 'RJ', 'Sikkim' => 'SK', 'Tamil Nadu' => 'TN', 'Telangana' => 'TG', 'Tripura' => 'TR', 'Uttar Pradesh' => 'UP', 'Uttarakhand' => 'UK', 'West Bengal' => 'WB', 'Delhi' => 'DL', 'Jammu and Kashmir' => 'JK', 'Ladakh' => 'LA', 'Puducherry' => 'PY', 'Chandigarh' => 'CH', 'Andaman and Nicobar Islands' => 'AN', 'Lakshadweep' => 'LD', 'Dadra and Nagar Haveli and Daman and Diu' => 'DN',];
  $stateName = "$state";
  $stateShortCode = $stateCodes[$stateName] ?? $companystate;
  ?>
  <meta name="geo.region" content="IN-<?= $stateShortCode ?>">
  <meta name="geo.placename" content="<?= @$city ?>">
  <meta name="geo.position" content="<?= $gLat ?>;<?= $gLng ?>">
  <meta name="ICBM" content="<?= $gLat ?>, <?= $gLng ?>">
  <meta name="revisit-after" content="weekly" />
  <meta name="distribution" content="global" />
  <meta name="language" content="en" />
  <link rel="apple-touch-icon" href="<?= !empty($favicon_url) ? $favicon_url : base_url('assets/images/logo/logo.jpg') ?>">
  <link rel="shortcut icon" href="<?= !empty($favicon_url) ? $favicon_url : base_url('assets/images/logo/logo.jpg') ?>">

  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "<?= $company3 ?>",
      "url": "<?= base_url() ?>",
      "logo": "<?= !empty($logo_url) ? $logo_url : base_url('assets/images/logo/logo.jpg') ?>"
    }
  </script>
  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "LocalBusiness",
      "name": "<?= $company3 ?>",
      "url": "<?= base_url() ?>",
      "image": ["<?= !empty($logo_url) ? $logo_url : base_url('assets/images/logo/logo.jpg') ?>"],
      "hasMap": "<?= $gMapUrl ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?= $address1 ?>",
        "addressLocality": "<?= !empty($city) ? $city : $address2 ?>",
        "postalCode": "<?= $postalCode ?>",
        "addressRegion": "<?= !empty($state) ? $state : $addressRegion ?>",
        "addressCountry": "India"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": <?= $gLat ?>,
        "longitude": <?= $gLng ?>
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?= $gRating ?>",
        "ratingCount": "<?= $gCount ?>",
        "bestRating": "5",
        "worstRating": "1"
      },
      "paymentAccepted": ["Cash", "Master Card", "Visa Card", "Debit Cards", "Cheques", "Credit Card", "UPI"],
      "priceRange": "₹500 - ₹40000",
      "telephone": "<?= $phone ?>",
      "email": "<?= $mail ?>",
      "openingHours": "Mo-Sa 09:00-18:00"
    }
  </script>
  <?php if (empty($clean_uri) || $clean_uri === 'home'): /* Homepage-only: MovingCompany schema */ ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "MovingCompany",
    "name": "<?= $company3 ?>",
    "url": "<?= base_url() ?>",
    "logo": "<?= !empty($logo_url) ? $logo_url : base_url('assets/images/logo/logo.jpg') ?>",
    "image": "<?= !empty($logo_url) ? $logo_url : base_url('assets/images/logo/logo.jpg') ?>",
    "description": "Trusted packers and movers in Noida and Greater Noida. Govt. registered, ISO 9001:2015 certified. Home shifting, office relocation, car transport across India.",
    "telephone": "+91<?= preg_replace('/[^0-9]/', '', $phone) ?>",
    "email": "<?= $mail ?>",
    "foundingDate": "2010",
    "areaServed": [
      {"@type": "City", "name": "Noida"},
      {"@type": "City", "name": "Greater Noida"},
      {"@type": "City", "name": "Ghaziabad"},
      {"@type": "City", "name": "Delhi"}
    ],
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= $address1 ?>",
      "addressLocality": "<?= !empty($city) ? $city : $address2 ?>",
      "postalCode": "<?= $postalCode ?>",
      "addressRegion": "Uttar Pradesh",
      "addressCountry": "IN"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": <?= $gLat ?>,
      "longitude": <?= $gLng ?>
    },
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "<?= $gRating ?>",
      "ratingCount": "<?= $gCount ?>",
      "bestRating": "5",
      "worstRating": "1"
    },
    "sameAs": [
      <?= !empty($facebookhtml) ? '"' . htmlspecialchars($facebookhtml) . '",' : '' ?>
      <?= !empty($youtubehtml) ? '"' . htmlspecialchars($youtubehtml) . '",' : '' ?>
      "<?= $gMapUrl ?>"
    ],
    "openingHoursSpecification": [
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
        "opens": "09:00",
        "closes": "19:00"
      }
    ],
    "priceRange": "₹₹",
    "paymentAccepted": "Cash, UPI, Credit Card, Debit Card",
    "hasOfferCatalog": {
      "@type": "OfferCatalog",
      "name": "Packers and Movers Services",
      "itemListElement": [
        {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Home Shifting in Noida"}},
        {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Office Relocation Noida"}},
        {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Car Transportation Noida"}},
        {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Packing Unpacking Service"}},
        {"@type": "Offer", "itemOffered": {"@type": "Service", "name": "Warehouse Storage Noida"}}
      ]
    }
  }
  </script>
  <?php endif; ?>
  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Product",
      "sku": "<?= $sku ?>",
      "mpn": "<?= $mpn ?>",
      "name": "Packers and Movers Services in <?= $city ?>",
      "image": "<?= $img ?>",
      "description": "<?= @$description ?>",
      "url": "<?= $url ?>",
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "<?= $ratingValue ?>",
        "ratingCount": "<?= $ratingCount ?>"
      },
      "review": {
        "@type": "Review",
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "<?= $ratingValue ?>",
          "bestRating": "5"
        },
        "author": {
          "@type": "Person",
          "name": "<?= $company3 ?>"
        }
      },
      "offers": {
        "@type": "Offer",
        "price": "4999.00",
        "priceCurrency": "INR",
        "priceValidUntil": "<?= date("Y-m-") ?>30",
        "availability": "https://schema.org/InStock",
        "url": "<?= $url ?>"
      },
      "brand": {
        "@type": "Brand",
        "name": "<?= $company3 ?>",
        "image": "<?= $img ?>"
      }
    }
  </script>

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16643071116">
  </script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'AW-16643071116');
  </script>
  <!-- CSS and Java Script -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css?V=2.6') ?>">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body style="margin: 0; padding: 0; background-color: #ffffff;">