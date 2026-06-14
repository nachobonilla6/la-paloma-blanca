<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-WBB3NHBG');</script>
  <!-- End Google Tag Manager -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $content->meta_title ?? 'La Paloma Blanca – Beachfront Condo for Sale, South Jacó' }}</title>
  <meta name="description" content="{{ $content->meta_description ?? '2-bed, 2-bath beachfront condo for sale at La Paloma Blanca in South Jacó, Costa Rica.' }}" />
  <meta property="og:title" content="La Paloma Blanca – Beachfront Condo for Sale" />
  <meta property="og:description" content="2-bed, 2-bath beachfront condo in South Jacó, Costa Rica. Direct beach access." />
  <meta property="og:image" content="{{ $images[0]->image_path ?? '/la-paloma/photos/beach-sunset2.jpeg' }}" />
  <meta property="og:type" content="website" />
  <meta name="theme-color" content="#0d2818" />
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌴</text></svg>" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,500;0,600;1,300;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('lp-assets/css/style.css') }}" />
</head>
<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WBB3NHBG"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  @php
    $features = $content->feature_list ?? [];
    $lifeHighlights = $content->life_highlights ?? [];
    $beachHighlights = $content->beach_highlights ?? [];
  @endphp

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FLRSK9H"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- ===== NAV ===== -->
  <nav id="navbar">
    <div class="nav-inner">
      <span class="nav-logo">La Paloma Blanca <span class="nav-logo-tag">For Sale</span></span>
      <ul class="nav-links">
        <li><a href="#details">Details</a></li>
        <li><a href="#amenities">Amenities</a></li>
        <li><a href="#gallery">Gallery</a></li>
        <li><a href="#video">Video</a></li>
        <li><a href="#beach">The Beach</a></li>
        <li><a href="#contact" class="nav-cta">Contact</a></li>
      </ul>
      <button class="nav-toggle" id="navToggle" aria-label="Menu">
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </nav>

  <!-- ===== HERO ===== -->
  <section class="hero" id="hero"@if($content->hero_image) style="background-image: url('{{ asset($content->hero_image) }}'); background-size: cover; background-position: center;"@endif>
    <div class="hero-overlay"></div>
    <div class="hero-bg-scroll"></div>
    <div class="hero-content">
      <div class="hero-badge animate-fade-in">{{ $content->hero_badge ?? 'For Sale — Owned by William' }}</div>
      <h1 class="animate-fade-in-up">{{ $content->hero_title ?? 'Beachfront Condo' }}<br /><span class="hero-accent">{{ $content->hero_accent ?? 'La Paloma Blanca' }}</span></h1>
      <p class="hero-subtitle animate-fade-in-up">{{ $content->hero_subtitle ?? 'South Jacó, Costa Rica' }}</p>
      <p class="hero-tagline animate-fade-in-up">{!! nl2br(e($content->hero_tagline ?? '2 Bedrooms • 2 Bathrooms • Approx. 1,000 sq ft')) !!}</p>
      <div class="hero-actions animate-fade-in-up">
        <a href="#details" class="btn btn-primary">Explore</a>
        <a href="#contact" class="btn btn-outline">Schedule a Viewing</a>
      </div>
    </div>
    <div class="hero-scroll-hint">
      <span>Scroll</span>
      <i class="fas fa-chevron-down"></i>
    </div>
  </section>

  <!-- ===== DETAILS ===== -->
  <section id="details" class="section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">The Property</span>
        <h2>{{ $content->details_title ?? 'Beachfront Condo for Sale' }}</h2>
        @if($content->details_intro)
          <p class="section-intro">{{ $content->details_intro }}</p>
        @endif
      </div>

      <div class="details-grid">
        <div class="details-text animate-on-scroll">
          <h3 class="details-subtitle">Property Features</h3>
          @if(!empty($features))
            <ul class="feature-list">
              @foreach($features as $feature)
                <li><i class="{{ $feature['icon'] ?? 'fas fa-check' }}"></i> {{ $feature['text'] ?? '' }}</li>
              @endforeach
            </ul>
          @else
            <ul class="feature-list">
              <li><i class="fas fa-bed"></i> 2 spacious bedrooms</li>
              <li><i class="fas fa-bath"></i> 2 full bathrooms</li>
              <li><i class="fas fa-vector-square"></i> Approximately 1,000 sq ft of living space</li>
              <li><i class="fas fa-car"></i> Dedicated owner parking</li>
              <li><i class="fas fa-shield-alt"></i> 24-hour gated security</li>
              <li><i class="fas fa-swimmer"></i> Four swimming pools</li>
              <li><i class="fas fa-leaf"></i> Tropical gardens throughout the property</li>
              <li><i class="fas fa-umbrella-beach"></i> Direct beach access</li>
              <li><i class="fas fa-chart-line"></i> Strong rental and investment potential</li>
            </ul>
          @endif
          @if($content->details_description)
            <p>{{ $content->details_description }}</p>
          @endif
          <a href="#contact" class="btn btn-primary">Schedule a Viewing</a>
        </div>
        <div class="details-image animate-on-scroll">
          <img src="{{ asset($content->details_image ?? $images[0]->image_path ?? '/lp-photos/pool.jpeg') }}" alt="Pool area at La Paloma Blanca" />
        </div>
      </div>

      @if($content->life_title || $content->life_text)
      <div class="life-section animate-on-scroll">
        <h3>{{ $content->life_title ?? 'Life at La Paloma Blanca' }}</h3>
        @if($content->life_text)<p>{{ $content->life_text }}</p>@endif
        @if(!empty($lifeHighlights))
        <div class="life-highlights">
          @foreach($lifeHighlights as $item)
          <div class="life-item">
            <i class="{{ $item['icon'] ?? 'fas fa-check' }} life-icon"></i>
            <span>{{ $item['text'] ?? '' }}</span>
          </div>
          @endforeach
        </div>
        @endif
      </div>
      @endif

      @if($content->surf_title || $content->surf_text)
      <div class="surf-section animate-on-scroll">
        <h3>{{ $content->surf_title ?? "A Surfer's Paradise" }}</h3>
        @if($content->surf_text)<p>{{ $content->surf_text }}</p>@endif
      </div>
      @endif
    </div>
  </section>

  <!-- ===== AMENITIES ===== -->
  <section id="amenities" class="section section-alt">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">Complex Amenities</span>
        <h2>{{ $content->amenities_title ?? 'Resort-Style Living' }}</h2>
        @if($content->amenities_intro)
          <p class="section-intro">{{ $content->amenities_intro }}</p>
        @endif
      </div>
      <div class="amenities-grid">
        @forelse($amenities as $amenity)
        <div class="amenity-card animate-on-scroll">
          <div class="amenity-icon-wrap"><i class="{{ $amenity->icon }}"></i></div>
          <h3>{{ $amenity->title }}</h3>
          @if($amenity->description)<p>{{ $amenity->description }}</p>@endif
        </div>
        @empty
        <div class="amenity-card animate-on-scroll">
          <div class="amenity-icon-wrap"><i class="fas fa-swimmer"></i></div>
          <h3>4 Swimming Pools</h3>
          <p>Four beautifully maintained pools surrounded by tropical gardens.</p>
        </div>
        <div class="amenity-card animate-on-scroll">
          <div class="amenity-icon-wrap"><i class="fas fa-shield-alt"></i></div>
          <h3>24/7 Security</h3>
          <p>Gated entry with round-the-clock security personnel.</p>
        </div>
        <div class="amenity-card animate-on-scroll">
          <div class="amenity-icon-wrap"><i class="fas fa-leaf"></i></div>
          <h3>Tropical Gardens</h3>
          <p>Lush walkways and mature landscaping throughout the complex.</p>
        </div>
        <div class="amenity-card animate-on-scroll">
          <div class="amenity-icon-wrap"><i class="fas fa-car"></i></div>
          <h3>Owner Parking</h3>
          <p>Dedicated parking space included with the unit.</p>
        </div>
        <div class="amenity-card animate-on-scroll">
          <div class="amenity-icon-wrap"><i class="fas fa-umbrella-beach"></i></div>
          <h3>Direct Beach Access</h3>
          <p>Private back gate opens onto the sand.</p>
        </div>
        <div class="amenity-card animate-on-scroll">
          <div class="amenity-icon-wrap"><i class="fas fa-sun"></i></div>
          <h3>Sunset Views</h3>
          <p>Incredible Pacific sunsets from the complex.</p>
        </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- ===== GALLERY ===== -->
  <section id="gallery" class="section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">Gallery</span>
        <h2>{{ $content->gallery_title ?? 'Photos' }}</h2>
        @if($content->gallery_intro)<p class="section-intro">{{ $content->gallery_intro }}</p>@endif
      </div>
      <div class="gallery-grid" id="galleryGrid">
        @forelse($images as $img)
        <div class="gallery-item animate-on-scroll">
          <img src="{{ asset($img->image_path) }}" alt="{{ $img->alt_text ?? 'Gallery image' }}" loading="lazy" />
        </div>
        @empty
        <p style="grid-column:1/-1;text-align:center;color:#888;">Gallery images coming soon.</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- ===== VIDEO TOUR ===== -->
  <section id="video" class="section section-alt">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">Video Tour</span>
        <h2>{{ $content->video_title ?? 'See the Neighborhood' }}</h2>
        @if($content->video_intro)<p class="section-intro">{{ $content->video_intro }}</p>@endif
      </div>
      <div class="video-grid">
        @if($content->video_1_src ?? false)
        <div class="video-card animate-on-scroll">
          <video controls poster="{{ $images[0]->image_path ?? '' }}">
            <source src="{{ $content->video_1_src }}" type="video/mp4" />
          </video>
          @if($content->video_1_label)<p class="video-label"><i class="fas fa-road"></i> {{ $content->video_1_label }}</p>@endif
        </div>
        @endif
        @if($content->video_2_src ?? false)
        <div class="video-card animate-on-scroll">
          <video controls poster="{{ $images[1]->image_path ?? '' }}">
            <source src="{{ $content->video_2_src }}" type="video/mp4" />
          </video>
          @if($content->video_2_label)<p class="video-label"><i class="fas fa-building"></i> {{ $content->video_2_label }}</p>@endif
        </div>
        @endif
      </div>
    </div>
  </section>

  <!-- ===== THE BEACH ===== -->
  <section id="beach" class="section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">The Beach</span>
        <h2>Your New Backyard</h2>
        @if($content->beach_intro)<p class="section-intro">{{ $content->beach_intro }}</p>@endif
      </div>

      <div class="beach-content">
        @if($content->beach_text_1 || $content->beach_text_2)
        <div class="beach-text animate-on-scroll">
          @if($content->beach_text_1)<p>{{ $content->beach_text_1 }}</p>@endif
          @if($content->beach_text_2)<p>{{ $content->beach_text_2 }}</p>@endif
        </div>
        @endif
               @if($content->beach_image_1 || $content->beach_image_2)
        <div class="beach-images animate-on-scroll">
          @if($content->beach_image_1) <img src="{{ asset($content->beach_image_1) }}" alt="Sunset at South Jacó beach" /> @endif
          @if($content->beach_image_2) <img src="{{ asset($content->beach_image_2) }}" alt="Street leading to the beach" /> @endif
        </div>
        @endif      </div>

      @if(!empty($beachHighlights))
      <div class="beach-highlights animate-on-scroll">
        <h3>{{ $content->beach_highlights_title ?? 'Beach Highlights' }}</h3>
        <div class="highlights-list">
          @foreach($beachHighlights as $item)
          <div class="highlight-item"><i class="fas fa-check"></i> {{ $item['text'] ?? '' }}</div>
          @endforeach
        </div>
      </div>
      @endif

      @if($content->surfing_title || $content->surfing_text)
      <div class="beach-subsection animate-on-scroll">
        <h3>{{ $content->surfing_title ?? 'Surfing' }}</h3>
        <p>{{ $content->surfing_text ?? '' }}</p>
      </div>
      @endif

      @if($content->sunset_title || $content->sunset_text)
      <div class="beach-subsection animate-on-scroll">
        <h3>{{ $content->sunset_title ?? 'Sunset Views' }}</h3>
        <p>{{ $content->sunset_text ?? '' }}</p>
      </div>
      @endif
    </div>
  </section>

  <!-- ===== ARTICLES ===== -->
  <section id="articles" class="section section-alt">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">{{ $content->articles_badge ?? 'Why Costa Rica' }}</span>
        <h2>{{ $content->articles_title ?? "Happiest Country in the World" }}</h2>
        @if($content->articles_intro)<p class="section-intro">{{ $content->articles_intro }}</p>@endif
      </div>
      <div class="articles-list">
        @forelse($articles as $article)
        <a href="{{ $article->url }}" target="_blank" rel="noopener" class="article-card animate-on-scroll">
          <span class="article-source">{{ $article->source }}</span>
          <span class="article-title">{{ $article->title }}</span>
          @if($article->description)<span class="article-desc">{{ $article->description }}</span>@endif
        </a>
        @empty
        <p style="grid-column:1/-1;text-align:center;color:#888;">Articles coming soon.</p>
        @endforelse
      </div>
    </div>
  </section>

  <!-- ===== CONTACT ===== -->
  <section id="contact" class="section">
    <div class="container">
      <div class="section-header animate-on-scroll">
        <span class="section-label">Get in Touch</span>
        <h2>{{ $content->contact_title ?? 'Interested in This Property?' }}</h2>
        <p class="section-intro">
          This is my personal unit — I'm selling it directly, no agents involved.
          Reach out anytime for more information or to schedule a private viewing.
        </p>
      </div>
      <div class="contact-grid">
        <div class="contact-card animate-on-scroll">
          <div class="contact-card-icon"><i class="fas fa-map-marker-alt"></i></div>
          <h3>Location</h3>
          <p>La Paloma Blanca<br />South Jacó, Costa Rica</p>
        </div>
        <div class="contact-card animate-on-scroll">
          <div class="contact-card-icon"><i class="fas fa-user"></i></div>
          <h3>Owner</h3>
          <p>{{ $content->owner_name ?? 'William' }}<br />Direct from owner, no agents</p>
        </div>
        <div class="contact-card animate-on-scroll">
          <div class="contact-card-icon"><i class="fas fa-envelope"></i></div>
          <h3>Email</h3>
          <p><a href="mailto:{{ $content->contact_email ?? 'willishel77@gmail.com' }}">{{ $content->contact_email ?? 'willishel77@gmail.com' }}</a></p>
        </div>
        <div class="contact-card animate-on-scroll">
          <div class="contact-card-icon"><i class="fas fa-phone-alt"></i></div>
          <h3>Phone</h3>
          <p><a href="tel:{{ $content->contact_phone ?? '+184****0404' }}">{{ $content->contact_phone ?? '+1 845 943 0404' }}</a></p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== FOOTER ===== -->
  <footer>
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <h4>La Paloma Blanca</h4>
          <p>South Jacó, Costa Rica</p>
        </div>
        <div class="footer-links">
          <a href="#details">Details</a>
          <a href="#gallery">Gallery</a>
          <a href="#beach">The Beach</a>
          <a href="#contact">Contact</a>
        </div>
        <div class="footer-contact">
          <p>{{ $content->owner_name ?? 'William' }} — Owner</p>
          <a href="mailto:{{ $content->contact_email ?? 'willishel77@gmail.com' }}">{{ $content->contact_email ?? 'willishel77@gmail.com' }}</a>
          <a href="tel:{{ $content->contact_phone ?? '+184****0404' }}">{{ $content->contact_phone ?? '+1 845 943 0404' }}</a>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} La Paloma Blanca &mdash; All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- WhatsApp Floating Button -->
  <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $content->contact_whatsapp ?? '+184****0404') }}?text=Hi%20William%2C%20I'm%20interested%20in%20your%20condo%20at%20La%20Paloma%20Blanca" target="_blank" rel="noopener" class="whatsapp-btn" aria-label="Contact via WhatsApp">
    <i class="fab fa-whatsapp"></i>
  </a>

  <!-- Lightbox -->
  <div id="lightbox" class="lightbox hidden">
    <span class="lightbox-close">&times;</span>
    <button class="lightbox-prev" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
    <img class="lightbox-img" id="lightboxImg" src="" alt="" />
    <button class="lightbox-next" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
    <div class="lightbox-counter" id="lightboxCounter"></div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
  <script src="{{ asset('lp-assets/js/main.js') }}"></script>
</body>
</html>
