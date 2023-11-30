<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

$placeholder = THEMEURI . 'images/resizer-wide.png';
$bannerURL = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url() : THEMEURI . '/images/hero-placeholder.png';
$has_banner = ( has_post_thumbnail() ) ? 'hasbanner':'nobanner';

global $post;
$current_id = $post->ID;
//$post_terms = array();
// if( get_post_type()=='post' ) {
//   $taxonomy = 'category';
//   $post_terms = get_the_terms($post->ID,$taxonomy);
// }
get_header(); ?>

<div id="primary" class="content-area-full content-default page-default-template <?php echo $has_banner ?>">
  <main id="main" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

      <figure class="post-feat-image" style="background-image:url('<?php echo $bannerURL ?>')">
        <?php if( has_post_thumbnail() ) { ?>
          <span class="img"><?php the_post_thumbnail(); ?></span>
        <?php } ?>
        <div class="topgrass"></div>    
      </figure>

      <div class="intro-section about <?php echo $section_class ?>">
        <div class="wrapper">
          <div class="flex-wrap">
            

           
             <div class="videoText">
                <div class="inside">
                  
                  <h1 class="post-title"><?php the_title() ?></h1>
                  
                </div>
             </div>
            
          </div>
        </div>
      </div>

      <div class="wrapper content-inner">
        <div class="post-entry">
          
        </div>
      </div>

      <section class="films-section">
        <div class="wrapper">
          <div class="film-info">
            <?php the_content(); ?>
          </div>
        </div>
      </section>

    <?php endwhile; ?>

    <?php //get_template_part('parts/other-videos'); ?>

  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
