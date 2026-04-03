<?php get_header(); ?>

<section class="hero">
  <div class="hero-inner">
    <div class="hero-content">
      <div class="hero-badge"><?php echo esc_html(tll_opt('hero_badge', "India's #1 Leather Care Experts")); ?></div>
      <h1><?php echo wp_kses_post(nl2br(esc_html(tll_opt('hero_title', 'Your Luxury Deserves a Second Life')))); ?></h1>
      <p class="hero-desc"><?php echo esc_html(tll_opt('hero_text', 'Expert repair, restoration & dry cleaning for designer handbags, shoes, jackets & leather upholstery. 40+ years of craftsmanship. 60+ skilled artisans. Pan-India service.')); ?></p>
      <div class="hero-ctas">
        <a class="btn-primary" href="<?php echo esc_url(tll_opt('whatsapp', 'https://wa.me/911122795768')); ?>" target="_blank" rel="noopener"><?php esc_html_e('WhatsApp Us Now', 'leather-laundry'); ?></a>
        <a class="btn-secondary-hero" href="#before-after"><?php esc_html_e('See Transformations →', 'leather-laundry'); ?></a>
      </div>
      <div class="hero-trust">
        <div class="hero-trust-item"><div class="hero-trust-num">10K+</div><div class="hero-trust-label"><?php esc_html_e('Items Restored', 'leather-laundry'); ?></div></div>
        <div class="hero-trust-item"><div class="hero-trust-num">80+</div><div class="hero-trust-label"><?php esc_html_e('Luxury Brands', 'leather-laundry'); ?></div></div>
        <div class="hero-trust-item"><div class="hero-trust-num">11</div><div class="hero-trust-label"><?php esc_html_e('Cities Served', 'leather-laundry'); ?></div></div>
        <div class="hero-trust-item"><div class="hero-trust-num">4.8★</div><div class="hero-trust-label"><?php esc_html_e('Google Rating', 'leather-laundry'); ?></div></div>
      </div>
    </div>

    <div class="hero-visual">
      <div class="hero-img-main">
        <div class="grain"></div>
        <div class="hero-img-content">
          <div class="luxury-icon">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#C9A96E" stroke-width="1.5"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
          </div>
          <h3><?php esc_html_e('Crafted with', 'leather-laundry'); ?><br><?php esc_html_e('Love & Expertise', 'leather-laundry'); ?></h3>
          <p><?php esc_html_e('Every piece tells a story', 'leather-laundry'); ?></p>
        </div>
        <div class="hero-float-badge">
          <div>
            <div class="float-stars">★★★★★</div>
            <div class="float-text"><?php esc_html_e('Rated 4.8/5', 'leather-laundry'); ?></div>
            <div class="float-sub"><?php esc_html_e('Based on 500+ reviews', 'leather-laundry'); ?></div>
          </div>
        </div>
        <div class="hero-float-badge-2">
          <div class="float-2-text"><?php esc_html_e('UK Certified', 'leather-laundry'); ?></div>
          <div class="float-2-sub"><?php esc_html_e('LTT Trained Technician', 'leather-laundry'); ?></div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="brand-bar">
  <div class="brand-bar-inner">
    <div class="brand-bar-label"><?php esc_html_e('Trusted Partners', 'leather-laundry'); ?></div>
    <div class="brand-logos">
      <span class="brand-logo-item">Gucci</span>
      <span class="brand-logo-item">Dior</span>
      <span class="brand-logo-item">Valentino</span>
      <span class="brand-logo-item">Jimmy Choo</span>
      <span class="brand-logo-item">Bvlgari</span>
      <span class="brand-logo-item">Louboutin</span>
      <span class="brand-logo-item">Bottega Veneta</span>
      <span class="brand-logo-item">Montblanc</span>
      <span class="brand-logo-item">Berluti</span>
      <span class="brand-logo-item">Canali</span>
    </div>
  </div>
</div>

<section class="section" id="services">
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label"><?php esc_html_e('What We Do', 'leather-laundry'); ?></div>
      <h2 class="section-title"><?php esc_html_e('Expert Care for Every Luxury Piece', 'leather-laundry'); ?></h2>
      <p class="section-subtitle"><?php esc_html_e('From beloved handbags to well-worn shoes, we bring your treasured items back to their original glory.', 'leather-laundry'); ?></p>
    </div>

    <div class="grid-3">
      <?php
      $services = get_posts([
          'post_type' => 'tll_service',
          'posts_per_page' => 6,
          'post_status' => 'publish',
          'orderby' => 'menu_order title',
          'order' => 'ASC',
      ]);

      if ($services) :
          foreach ($services as $service) :
              setup_postdata($service);
              $price = get_post_meta($service->ID, 'service_price', true);
              $icon = get_post_meta($service->ID, 'service_icon', true) ?: 'default';
              ?>
              <article <?php post_class('card service-card fade-in', $service->ID); ?>>
                <?php if ($price): ?><div class="service-price"><?php echo esc_html($price); ?></div><?php endif; ?>
                <div class="service-card-img"><div class="service-icon"><?php echo tll_icon_svg($icon); ?></div></div>
                <div class="service-card-body">
                  <h3><a href="<?php echo esc_url(get_permalink($service)); ?>"><?php echo esc_html(get_the_title($service)); ?></a></h3>
                  <p><?php echo esc_html(get_the_excerpt($service) ?: wp_trim_words(wp_strip_all_tags($service->post_content), 22)); ?></p>
                  <a class="service-card-link" href="<?php echo esc_url(get_permalink($service)); ?>"><?php esc_html_e('Explore Services', 'leather-laundry'); ?> <span>→</span></a>
                </div>
              </article>
              <?php
          endforeach;
          wp_reset_postdata();
      else :
          foreach (tll_get_default_services() as $service) : ?>
            <article class="card service-card fade-in">
              <div class="service-price"><?php echo esc_html($service['price']); ?></div>
              <div class="service-card-img"><div class="service-icon"><?php echo tll_icon_svg($service['icon']); ?></div></div>
              <div class="service-card-body">
                <h3><?php echo esc_html($service['title']); ?></h3>
                <p><?php echo esc_html($service['desc']); ?></p>
                <span class="service-card-link"><?php esc_html_e('Explore Services', 'leather-laundry'); ?> <span>→</span></span>
              </div>
            </article>
          <?php endforeach;
      endif;
      ?>
    </div>
  </div>
</section>

<section class="section section-muted" id="cities">
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label"><?php esc_html_e('Cities', 'leather-laundry'); ?></div>
      <h2 class="section-title"><?php esc_html_e('Serving Major Cities Across India', 'leather-laundry'); ?></h2>
      <p class="section-subtitle"><?php esc_html_e('Add, edit, or replace city pages from the WordPress admin and keep the menu in sync.', 'leather-laundry'); ?></p>
    </div>
    <div class="grid-4">
      <?php
      $cities = get_posts([
          'post_type' => 'tll_city',
          'posts_per_page' => 11,
          'post_status' => 'publish',
          'orderby' => 'menu_order title',
          'order' => 'ASC',
      ]);
      if ($cities) :
          foreach ($cities as $city) : ?>
            <article class="card trust-card fade-in" style="text-align:left">
              <div class="trust-icon" style="margin-left:0">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21s7-4.35 7-11a7 7 0 10-14 0c0 6.65 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
              </div>
              <h3><?php echo esc_html(get_the_title($city)); ?></h3>
              <p><?php echo esc_html(get_the_excerpt($city) ?: wp_trim_words(wp_strip_all_tags($city->post_content), 16)); ?></p>
            </article>
          <?php endforeach;
      else :
          foreach (tll_get_default_cities() as $city) : ?>
            <article class="card trust-card fade-in" style="text-align:left">
              <div class="trust-icon" style="margin-left:0">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 21s7-4.35 7-11a7 7 0 10-14 0c0 6.65 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
              </div>
              <h3><?php echo esc_html($city); ?></h3>
              <p><?php esc_html_e('Local pickup, restoration and doorstep service available.', 'leather-laundry'); ?></p>
            </article>
          <?php endforeach;
      endif;
      ?>
    </div>
  </div>
</section>

<section class="section" id="before-after">
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label"><?php esc_html_e('Transformations', 'leather-laundry'); ?></div>
      <h2 class="section-title"><?php esc_html_e('See the Difference We Make', 'leather-laundry'); ?></h2>
      <p class="section-subtitle"><?php esc_html_e('Real results from the workshop — every piece restored with care and precision.', 'leather-laundry'); ?></p>
    </div>

    <div class="ba-grid">
      <?php
      $items = get_posts([
          'post_type' => 'tll_before_after',
          'posts_per_page' => 3,
          'post_status' => 'publish',
          'orderby' => 'menu_order title',
          'order' => 'ASC',
      ]);
      if ($items) :
          foreach ($items as $item) : ?>
            <article class="card fade-in">
              <div class="ba-images">
                <div class="ba-img before"><?php esc_html_e('Before', 'leather-laundry'); ?></div>
                <div class="ba-img after"><?php esc_html_e('After', 'leather-laundry'); ?></div>
                <div class="ba-divider"><?php echo tll_inline_svg_icon('check'); ?></div>
              </div>
              <div class="ba-info">
                <h3><?php echo esc_html(get_the_title($item)); ?></h3>
                <p><?php echo esc_html(get_the_excerpt($item) ?: wp_trim_words(wp_strip_all_tags($item->post_content), 16)); ?></p>
                <span class="ba-tag"><?php echo esc_html(get_post_meta($item->ID, 'ba_tag', true) ?: __('✓ Restored', 'leather-laundry')); ?></span>
              </div>
            </article>
          <?php endforeach;
      else :
          $defaults = [
              ['title' => 'Chanel Bag Restoration', 'desc' => 'Full colour restoration & hardware polishing', 'tag' => '✓ Restored in 7 days'],
              ['title' => 'Louboutin Heel Colour Change', 'desc' => 'Patent leather redye & sole restoration', 'tag' => '✓ Like brand new'],
              ['title' => 'LV Shape Correction', 'desc' => 'Complete reshaping & leather conditioning', 'tag' => '✓ Memory restored'],
          ];
          foreach ($defaults as $item) : ?>
            <article class="card fade-in">
              <div class="ba-images">
                <div class="ba-img before"><?php esc_html_e('Before', 'leather-laundry'); ?></div>
                <div class="ba-img after"><?php esc_html_e('After', 'leather-laundry'); ?></div>
                <div class="ba-divider"><?php echo tll_inline_svg_icon('check'); ?></div>
              </div>
              <div class="ba-info">
                <h3><?php echo esc_html($item['title']); ?></h3>
                <p><?php echo esc_html($item['desc']); ?></p>
                <span class="ba-tag"><?php echo esc_html($item['tag']); ?></span>
              </div>
            </article>
          <?php endforeach;
      endif;
      ?>
    </div>
  </div>
</section>

<section class="section section-dark" id="how-it-works">
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label"><?php esc_html_e('Simple Process', 'leather-laundry'); ?></div>
      <h2 class="section-title"><?php esc_html_e('4 Easy Steps to Restored Luxury', 'leather-laundry'); ?></h2>
      <p class="section-subtitle"><?php esc_html_e("We've made it effortless — from your doorstep and back.", 'leather-laundry'); ?></p>
    </div>
    <div class="process-steps">
      <?php
      $steps = [
          ['n' => '1', 't' => 'Book / WhatsApp', 'd' => 'Send photos and tell us what needs attention.'],
          ['n' => '2', 't' => 'Pickup', 'd' => 'We arrange collection from your location.'],
          ['n' => '3', 't' => 'Restore', 'd' => 'Our artisans clean, repair and refinish.'],
          ['n' => '4', 't' => 'Deliver', 'd' => 'We return the item after quality checks.'],
      ];
      foreach ($steps as $step) : ?>
        <div class="process-step fade-in">
          <div class="step-num"><?php echo esc_html($step['n']); ?></div>
          <h3 class="step-title"><?php echo esc_html($step['t']); ?></h3>
          <p class="step-desc"><?php echo esc_html($step['d']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label"><?php esc_html_e('Why Choose Us', 'leather-laundry'); ?></div>
      <h2 class="section-title"><?php esc_html_e('Luxury Care With Trust Built In', 'leather-laundry'); ?></h2>
    </div>
    <div class="trust-grid">
      <?php
      $trust = [
          ['t' => 'Expert Craftsmanship', 'd' => 'Detailed restoration work with premium finishing.'],
          ['t' => 'Pickup & Drop', 'd' => 'Convenient service flow for busy customers.'],
          ['t' => 'Transparent Pricing', 'd' => 'Easy-to-read service blocks and clear CTAs.'],
          ['t' => 'Responsive First', 'd' => 'Optimized for mobile, tablet and desktop.'],
      ];
      foreach ($trust as $item) : ?>
        <div class="trust-card fade-in">
          <div class="trust-icon"><?php echo tll_inline_svg_icon('check'); ?></div>
          <h3><?php echo esc_html($item['t']); ?></h3>
          <p><?php echo esc_html($item['d']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-dark" id="testimonials">
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label"><?php esc_html_e('Testimonials', 'leather-laundry'); ?></div>
      <h2 class="section-title"><?php esc_html_e('Loved by Customers Across India', 'leather-laundry'); ?></h2>
    </div>
    <div class="testimonials-track">
      <?php
      $testimonials = get_posts([
          'post_type' => 'tll_testimonial',
          'posts_per_page' => 3,
          'post_status' => 'publish',
          'orderby' => 'menu_order title',
          'order' => 'ASC',
      ]);
      if ($testimonials) :
          foreach ($testimonials as $t) :
              $city = get_post_meta($t->ID, 'testimonial_city', true);
              $name = get_the_title($t);
              ?>
              <article class="testimonial-card fade-in">
                <div class="testimonial-stars">★★★★★</div>
                <p class="testimonial-text"><?php echo esc_html(get_the_excerpt($t) ?: wp_trim_words(wp_strip_all_tags($t->post_content), 28)); ?></p>
                <div class="testimonial-author">
                  <div class="testimonial-avatar"><?php echo esc_html(mb_substr($name ?: 'A', 0, 1)); ?></div>
                  <div>
                    <div class="testimonial-name"><?php echo esc_html($name); ?></div>
                    <div class="testimonial-city"><?php echo esc_html($city ?: __('Customer', 'leather-laundry')); ?></div>
                  </div>
                </div>
              </article>
              <?php
          endforeach;
      else :
          foreach (tll_get_default_testimonials() as $t) : ?>
            <article class="testimonial-card fade-in">
              <div class="testimonial-stars">★★★★★</div>
              <p class="testimonial-text"><?php echo esc_html($t['text']); ?></p>
              <div class="testimonial-author">
                <div class="testimonial-avatar"><?php echo esc_html(mb_substr($t['name'], 0, 1)); ?></div>
                <div>
                  <div class="testimonial-name"><?php echo esc_html($t['name']); ?></div>
                  <div class="testimonial-city"><?php echo esc_html($t['city']); ?></div>
                </div>
              </div>
            </article>
          <?php endforeach;
      endif;
      ?>
    </div>
  </div>
</section>

<section class="section" id="about">
  <div class="container">
    <div class="founder-section">
      <div class="founder-img-wrap fade-in">
        <div class="founder-img"><?php esc_html_e('Founder / Workshop Visual', 'leather-laundry'); ?></div>
        <div class="founder-credential">
          <strong><?php esc_html_e('Trusted Craft', 'leather-laundry'); ?></strong>
          <span><?php esc_html_e('Premium material care and restoration', 'leather-laundry'); ?></span>
        </div>
      </div>
      <div class="founder-content fade-in">
        <h2><?php esc_html_e('A premium layout designed to feel handcrafted.', 'leather-laundry'); ?></h2>
        <p><?php esc_html_e('This WordPress theme gives you the exact structure you need to replace the mockup with real pages, cities, services, testimonials and blog content. Fonts, spacing and palette are aligned to the brand directions visible in your uploaded HTML file.', 'leather-laundry'); ?></p>
        <div class="founder-creds">
          <span class="founder-cred-tag"><?php echo tll_inline_svg_icon('check'); ?><?php esc_html_e('Easy to edit in WP Admin', 'leather-laundry'); ?></span>
          <span class="founder-cred-tag"><?php echo tll_inline_svg_icon('check'); ?><?php esc_html_e('Mobile drawer menu included', 'leather-laundry'); ?></span>
          <span class="founder-cred-tag"><?php echo tll_inline_svg_icon('check'); ?><?php esc_html_e('Services & Cities post types', 'leather-laundry'); ?></span>
        </div>
        <a class="btn-primary" href="<?php echo esc_url(tll_opt('whatsapp', 'https://wa.me/911122795768')); ?>" target="_blank" rel="noopener"><?php esc_html_e('Start Customizing', 'leather-laundry'); ?></a>
      </div>
    </div>
  </div>
</section>

<section class="section section-muted" id="care-tips">
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label"><?php esc_html_e('Care Tips', 'leather-laundry'); ?></div>
      <h2 class="section-title"><?php esc_html_e('Recent Blog Posts and Care Tips', 'leather-laundry'); ?></h2>
      <p class="section-subtitle"><?php esc_html_e('Use regular WordPress posts or a Care Tips category for this section.', 'leather-laundry'); ?></p>
    </div>
    <div class="posts-grid">
      <?php
      $recent = new WP_Query([
          'post_type' => 'post',
          'posts_per_page' => 3,
      ]);
      if ($recent->have_posts()) :
          while ($recent->have_posts()) : $recent->the_post(); ?>
            <article class="post-card fade-in">
              <a href="<?php the_permalink(); ?>">
                <div class="thumb">
                  <?php if (has_post_thumbnail()) : the_post_thumbnail('large'); endif; ?>
                </div>
                <div class="body">
                  <div class="meta"><?php echo esc_html(get_the_date()); ?></div>
                  <h3><?php the_title(); ?></h3>
                  <p><?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(), 18)); ?></p>
                </div>
              </a>
            </article>
          <?php endwhile; wp_reset_postdata();
      else :
          for ($i = 1; $i <= 3; $i++) : ?>
            <article class="post-card fade-in">
              <div class="thumb"></div>
              <div class="body">
                <div class="meta"><?php esc_html_e('Blog / Care Tip', 'leather-laundry'); ?></div>
                <h3><?php echo esc_html(sprintf(__('Sample Post %d', 'leather-laundry'), $i)); ?></h3>
                <p><?php esc_html_e('Publish your own blog content to replace these placeholders.', 'leather-laundry'); ?></p>
              </div>
            </article>
          <?php endfor;
      endif;
      ?>
    </div>
  </div>
</section>

<section class="section" id="faqs">
  <div class="container">
    <div class="section-header fade-in">
      <div class="section-label"><?php esc_html_e('FAQs', 'leather-laundry'); ?></div>
      <h2 class="section-title"><?php esc_html_e('Common Questions', 'leather-laundry'); ?></h2>
    </div>
    <div class="faqs">
      <?php
      $faqs = get_posts([
          'post_type' => 'tll_faq',
          'posts_per_page' => 4,
          'post_status' => 'publish',
          'orderby' => 'menu_order title',
          'order' => 'ASC',
      ]);
      if ($faqs) :
          foreach ($faqs as $faq) : ?>
            <div class="faq-item fade-in">
              <button type="button">
                <span><?php echo esc_html(get_the_title($faq)); ?></span>
                <span class="chev">⌄</span>
              </button>
              <div class="answer"><?php echo wp_kses_post(wpautop($faq->post_content)); ?></div>
            </div>
          <?php endforeach;
      else :
          foreach (tll_get_default_faqs() as $faq) : ?>
            <div class="faq-item fade-in">
              <button type="button">
                <span><?php echo esc_html($faq['q']); ?></span>
                <span class="chev">⌄</span>
              </button>
              <div class="answer"><?php echo esc_html($faq['a']); ?></div>
            </div>
          <?php endforeach;
      endif;
      ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="cta-section fade-in">
      <h2><?php esc_html_e('Ready to replace the mockup with your real website?', 'leather-laundry'); ?></h2>
      <p><?php esc_html_e('Upload the theme, edit the Services and Cities post types, set your menus, add your logo and launch.', 'leather-laundry'); ?></p>
      <div class="cta-buttons">
        <a class="btn-primary" href="<?php echo esc_url(tll_opt('whatsapp', 'https://wa.me/911122795768')); ?>" target="_blank" rel="noopener"><?php esc_html_e('Message on WhatsApp', 'leather-laundry'); ?></a>
        <a class="btn-secondary-hero" href="<?php echo esc_url(home_url('/contact-us/')); ?>"><?php esc_html_e('Contact Us', 'leather-laundry'); ?></a>
      </div>
      <div class="cta-reassurance">
        <span><?php echo tll_inline_svg_icon('check'); ?><?php esc_html_e('Responsive layout', 'leather-laundry'); ?></span>
        <span><?php echo tll_inline_svg_icon('check'); ?><?php esc_html_e('Menu & page ready', 'leather-laundry'); ?></span>
        <span><?php echo tll_inline_svg_icon('check'); ?><?php esc_html_e('Easy content editing', 'leather-laundry'); ?></span>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
