<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="announce-bar">
    <?php echo esc_html(tll_opt('announcement', "Free Pickup & Drop across India — Trusted by 10,000+ customers since 2015")); ?>
</div>

<header class="site-header" id="siteHeader">
  <div class="header-inner">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
      <div class="brand-mark">
        <?php echo esc_html(mb_substr(get_bloginfo('name') ?: 'TL', 0, 2)); ?>
      </div>
      <div class="brand-title">
        <?php echo esc_html(tll_opt('brand_name', get_bloginfo('name'))); ?>
        <small><?php echo esc_html(tll_opt('brand_tagline', get_bloginfo('description'))); ?></small>
      </div>
    </a>

    <nav class="primary-nav" aria-label="<?php esc_attr_e('Primary navigation', 'leather-laundry'); ?>">
      <?php
      if (has_nav_menu('primary')) {
          wp_nav_menu([
              'theme_location' => 'primary',
              'container' => false,
              'depth' => 2,
              'fallback_cb' => false,
          ]);
      } else {
          tll_render_default_primary_menu();
      }
      ?>
    </nav>

    <div class="header-actions">
      <a class="phone-link" href="tel:<?php echo esc_attr(tll_opt('phone_tel', '+919711255431')); ?>">
        <?php echo tll_inline_svg_icon('phone'); ?>
        <span><?php echo esc_html(tll_opt('phone', '+91 97112 55431')); ?></span>
      </a>
      <a class="btn-whatsapp" href="<?php echo esc_url(tll_opt('whatsapp', 'https://wa.me/911122795768')); ?>" target="_blank" rel="noopener">
        <?php echo tll_inline_svg_icon('wa'); ?>
        <span><?php echo esc_html(tll_opt('whatsapp_label', 'Get a Quote')); ?></span>
      </a>
      <button class="nav-toggle" type="button" aria-label="<?php esc_attr_e('Open menu', 'leather-laundry'); ?>" aria-controls="mobileDrawer" aria-expanded="false">
        <span></span>
      </button>
    </div>
  </div>
</header>

<div class="mobile-drawer" id="mobileDrawer" aria-hidden="true">
  <div class="mobile-panel">
    <div class="mobile-top">
      <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
        <div class="brand-mark"><?php echo esc_html(mb_substr(get_bloginfo('name') ?: 'TL', 0, 2)); ?></div>
        <div class="brand-title" style="font-size:16px">
          <?php echo esc_html(tll_opt('brand_name', get_bloginfo('name'))); ?>
          <small><?php echo esc_html(tll_opt('brand_tagline', get_bloginfo('description'))); ?></small>
        </div>
      </a>
      <button class="close-drawer" type="button" aria-label="<?php esc_attr_e('Close menu', 'leather-laundry'); ?>">&times;</button>
    </div>

    <div class="mobile-menu-wrap" data-mobile-accordion-root>
      <?php
      if (has_nav_menu('primary')) {
          wp_nav_menu([
              'theme_location' => 'primary',
              'container' => false,
              'depth' => 2,
              'fallback_cb' => false,
          ]);
      } else {
          tll_render_default_primary_menu();
      }
      ?>
    </div>

    <div class="mobile-section mobile-accordion-item">
      <button class="mobile-section-toggle" type="button" aria-expanded="false">
        <span><?php esc_html_e('Services', 'leather-laundry'); ?></span>
        <span class="mobile-caret" aria-hidden="true">›</span>
      </button>
      <div class="mobile-section-content">
        <?php
        if (has_nav_menu('services')) {
            wp_nav_menu([
                'theme_location' => 'services',
                'container' => false,
                'depth' => 1,
                'fallback_cb' => false,
            ]);
        } else {
            tll_render_services_menu_list();
        }
        ?>
      </div>
    </div>

    <div class="mobile-section mobile-accordion-item">
      <button class="mobile-section-toggle" type="button" aria-expanded="false">
        <span><?php esc_html_e('Cities', 'leather-laundry'); ?></span>
        <span class="mobile-caret" aria-hidden="true">›</span>
      </button>
      <div class="mobile-section-content">
        <?php
        if (has_nav_menu('cities')) {
            wp_nav_menu([
                'theme_location' => 'cities',
                'container' => false,
                'depth' => 1,
                'fallback_cb' => false,
            ]);
        } else {
            tll_render_cities_menu_list();
        }
        ?>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var drawer = document.getElementById('mobileDrawer');
  var openButton = document.querySelector('.nav-toggle');
  var closeButton = document.querySelector('.close-drawer');

  if (drawer && openButton) {
    openButton.addEventListener('click', function () {
      drawer.classList.add('open');
      drawer.setAttribute('aria-hidden', 'false');
      openButton.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
    });
  }

  if (drawer && closeButton && openButton) {
    closeButton.addEventListener('click', function () {
      drawer.classList.remove('open');
      drawer.setAttribute('aria-hidden', 'true');
      openButton.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    });
  }

  if (drawer) {
    drawer.addEventListener('click', function (event) {
      if (!event.target.classList.contains('mobile-drawer')) {
        return;
      }
      drawer.classList.remove('open');
      drawer.setAttribute('aria-hidden', 'true');
      if (openButton) {
        openButton.setAttribute('aria-expanded', 'false');
      }
      document.body.style.overflow = '';
    });
  }

  document.querySelectorAll('.mobile-menu-wrap .menu-item-has-children').forEach(function (item) {
    var link = item.querySelector(':scope > a');
    var subMenu = item.querySelector(':scope > .sub-menu');

    if (!link || !subMenu) {
      return;
    }

    var toggle = document.createElement('button');
    toggle.type = 'button';
    toggle.className = 'mobile-accordion-toggle';
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', 'Toggle submenu');
    toggle.innerHTML = '<span class="mobile-caret" aria-hidden="true">›</span>';
    link.insertAdjacentElement('afterend', toggle);

    toggle.addEventListener('click', function () {
      var isOpen = item.classList.toggle('open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  });

  document.querySelectorAll('.mobile-section-toggle').forEach(function (toggle) {
    toggle.addEventListener('click', function () {
      var wrapper = toggle.closest('.mobile-accordion-item');
      if (!wrapper) {
        return;
      }
      var isOpen = wrapper.classList.toggle('open');
      toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  });
});
</script>

<main id="content" class="site-main">
