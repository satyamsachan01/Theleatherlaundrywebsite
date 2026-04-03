</main>

<?php $wa = tll_opt('whatsapp', 'https://wa.me/911122795768'); ?>
<a class="whatsapp-float" href="<?php echo esc_url($wa); ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
  <?php echo tll_inline_svg_icon('wa'); ?>
  <span class="wa-tooltip">WhatsApp us</span>
</a>

<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" style="margin-bottom:10px">
          <div class="brand-mark"><?php echo esc_html(mb_substr(get_bloginfo('name') ?: 'TL', 0, 2)); ?></div>
          <div class="brand-title" style="color:#fff">
            <?php echo esc_html(tll_opt('brand_name', get_bloginfo('name'))); ?>
            <small><?php echo esc_html(tll_opt('brand_tagline', get_bloginfo('description'))); ?></small>
          </div>
        </a>
        <p><?php echo esc_html__('Premium leather care, restoration and repair with a luxury-first visual language. Built to match your mockup and ready for WordPress content editing.', 'leather-laundry'); ?></p>
        <div class="footer-socials">
          <a class="footer-social-icon" href="<?php echo esc_url(tll_opt('whatsapp', 'https://wa.me/911122795768')); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><?php echo tll_inline_svg_icon('wa'); ?></a>
          <a class="footer-social-icon" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Website"><?php echo tll_inline_svg_icon('check'); ?></a>
        </div>
      </div>

      <div class="footer-col">
        <h4><?php esc_html_e('Pages', 'leather-laundry'); ?></h4>
        <?php
        if (has_nav_menu('footer')) {
            wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'depth' => 1]);
        } else {
            echo '<ul>';
            echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
            echo '<li><a href="' . esc_url(home_url('/about/')) . '">About</a></li>';
            echo '<li><a href="' . esc_url(home_url('/contact-us/')) . '">Contact</a></li>';
            echo '</ul>';
        }
        ?>
      </div>

      <div class="footer-col">
        <h4><?php esc_html_e('Services', 'leather-laundry'); ?></h4>
        <ul>
          <?php foreach (tll_get_default_services() as $service): ?>
            <li><a href="<?php echo esc_url(get_post_type_archive_link('tll_service') ?: home_url('/services/')); ?>"><?php echo esc_html($service['title']); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="footer-col">
        <h4><?php esc_html_e('Cities', 'leather-laundry'); ?></h4>
        <ul>
          <?php foreach (tll_get_default_cities() as $city): ?>
            <li><a href="<?php echo esc_url(get_post_type_archive_link('tll_city') ?: home_url('/cities/')); ?>"><?php echo esc_html($city); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <div>&copy; <?php echo esc_html(date_i18n('Y')); ?> <?php echo esc_html(tll_opt('brand_name', get_bloginfo('name'))); ?></div>
      <div><?php esc_html_e('Designed for luxury restoration websites.', 'leather-laundry'); ?></div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
