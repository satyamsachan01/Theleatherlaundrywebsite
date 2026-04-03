<?php get_header(); ?>
<section class="single-wrap">
  <div class="container">
    <div class="content-card">
      <h1 class="entry-title"><?php esc_html_e('Page not found', 'leather-laundry'); ?></h1>
      <div class="entry-content">
        <p><?php esc_html_e('The page you are looking for does not exist or has been moved.', 'leather-laundry'); ?></p>
        <p><a class="btn-primary" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Go back home', 'leather-laundry'); ?></a></p>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>
