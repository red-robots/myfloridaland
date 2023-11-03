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
      <?php  
        $small_title = get_field('small_title');
        $video_thumb = get_field('video_thumbnail');
        $video_link = get_field('video_link');
        $video_description = get_field('video_description');
        $section_class = ( $video_thumb  && $video_link && $video_description ) ? 'half':'full';
      ?>

      <div class="intro-section <?php echo $section_class ?>">
        <div class="wrapper">
          <div class="flex-wrap">
            <?php if ( $video_thumb  && $video_link ) { ?>
             <figure class="videoFrame">
               <a href="<?php echo $video_link ?>" class="videoLink videopopup" data-fancybox="video-gallery">
                 <span class="videoImage" style="background-image:url('<?php echo $video_thumb['url'] ?>')"></span>
                 <span class="player-button"></span>
                 <img src="<?php echo THEMEURI ?>/images/video-helper.png" class="resizer" alt="">
               </a>
             </figure> 
            <?php } ?>

            <?php if ( $video_description ) { ?>
             <div class="videoText">
                <div class="inside">
                  <?php if($small_title) { ?>
                    <div class="category"><?php echo $small_title ?></div>
                  <?php } ?>
                  <h1 class="post-title"><?php echo get_the_title() ?></h1>
                  <?php echo $video_description ?>
                </div>
             </div>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="wrapper content-inner">
        <div class="post-entry">
          <?php the_content(); ?>
        </div>
      </div>

		<?php endwhile; ?>

    <?php get_template_part('parts/other-videos'); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
