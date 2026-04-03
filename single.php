<?php get_header(); ?>
<section class="single-wrap">
  <div class="container">
    <article class="content-card">
      <?php while (have_posts()) : the_post(); ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="meta"><?php echo esc_html(get_the_date()); ?></div>
        <div class="entry-content"><?php the_content(); ?></div>
      <?php endwhile; ?>
    </article>
  </div>
</section>
<?php get_footer(); ?>
