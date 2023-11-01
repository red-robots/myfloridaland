<?php
/**
 * Template Name: Sitemap
 */

$bannerImage = get_field('banner_image');
$hasBanner = ( isset($bannerImage['image1']) && $bannerImage['image1'] ) ? 'hasBanner' : 'noBanner';
get_header(); 

print_r($banner);
?>

<div id="primary" class="content-area-full sitemap generic-layout <?php echo $hasBanner ?>">
  <main id="main" class="site-main wrapper" role="main">
    <?php while ( have_posts() ) : the_post(); ?>

      <?php if ($hasBanner=="noBanner") { ?>
      <div class="titlediv">
        <h1 class="page-title"><span><?php the_title(); ?></span></h1>
      </div>
      <?php } ?>

      <?php  
        $intro_icon = get_field('intro_icon');
        $intro_text = get_field('intro_text');
        if($intro_text) { ?>
        <section class="section section-intro">
          <div class="wrapper">
            <?php if ($intro_icon) { ?>
            <figure class="intro-icon">
              <img src="<?php echo $intro_icon['url'] ?>" alt="" />
            </figure>
            <?php } ?>  
            <div class="intro-text"><?php echo anti_email_spam($intro_text) ?></div>
          </div>
        </section>
      <?php } ?>

      <?php if ( has_nav_menu('sitemap') ) { ?>
      <div id="sitemap-wrap">
        <?php wp_nav_menu( array( 'theme_location' => 'sitemap', 'menu_id' => 'sitemap','container_class'=>'sitemap-links') ); ?>
      </div>
      <?php } ?>

    <?php endwhile; ?>  
  </main>
</div>

<?php
get_footer();
