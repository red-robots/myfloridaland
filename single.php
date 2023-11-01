<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

$placeholder = THEMEURI . 'images/rectangle.png';
$banner = get_field("banner_image");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
global $post;
$post_terms = array();
if( get_post_type()=='post' ) {
  $taxonomy = 'category';
  $post_terms = get_the_terms($post->ID,$taxonomy);
}
get_header(); ?>

<div id="primary" class="content-area-full content-default page-default-template <?php echo $has_banner ?>">
	<main id="main" class="site-main wrapper" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

      <header class="post-header">
        <?php 
        $post_date = get_the_date('m/d/Y');
        $categoryNames = '';
        if($post_terms) { ?>
          <?php $i=1; foreach($post_terms as $term) { 
            $termName = $term->name;
            $categoryLink = get_term_link($term,$taxonomy);
            $comma = ($i>1) ? ', ':'';
            $categoryNames .=  $comma . '<a href="'.$categoryLink.'">'.$termName.'</a>';
            ?>
          <?php $i++; } ?>
        <?php } ?>
        <div class="post-meta">
          <?php if( $categoryNames ) { ?><?php echo $categoryNames ?> | <?php } ?><?php echo $post_date; ?> | By: <?php echo get_the_author(); ?>
        </div>
        <h1><?php the_title(); ?></h1>
        <?php if( $subtitle = get_field('post_subtitle') ) { ?>
        <div class="subtitle"><?php echo $subtitle?></div>
        <?php } ?>
      </header>

      <?php if( has_post_thumbnail() ) { ?>
        <figure class="post-feat-image"><?php the_post_thumbnail(); ?></figure>
      <?php } ?>

      <div class="post-entry">
        <?php the_content(); ?>
      </div>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
