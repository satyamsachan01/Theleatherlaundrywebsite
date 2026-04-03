<?php get_header(); ?>
<section class="page-wrap">
  <div class="container">
    <div class="content-card">
      <?php while (have_posts()) : the_post(); ?>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <div class="entry-content"><?php the_content(); ?></div>
      <?php endwhile; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
