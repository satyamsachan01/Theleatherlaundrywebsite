<?php get_header(); ?>
<section class="archive-wrap">
  <div class="container">
    <div class="section-header">
      <div class="section-label"><?php esc_html_e('Search Results', 'leather-laundry'); ?></div>
      <h1 class="section-title"><?php printf(esc_html__('Results for: %s', 'leather-laundry'), esc_html(get_search_query())); ?></h1>
    </div>
    <div class="posts-grid">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="post-card">
          <a href="<?php the_permalink(); ?>">
            <div class="thumb"><?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?></div>
            <div class="body">
              <div class="meta"><?php echo esc_html(get_post_type()); ?></div>
              <h3><?php the_title(); ?></h3>
              <p><?php echo esc_html(wp_trim_words(get_the_excerpt() ?: get_the_content(), 18)); ?></p>
            </div>
          </a>
        </article>
      <?php endwhile; else : ?>
        <div class="content-card"><?php esc_html_e('No results found.', 'leather-laundry'); ?></div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
