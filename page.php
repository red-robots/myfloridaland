<?php
$bannerImage = get_field('banner_image');
$hasBanner = ( isset($bannerImage['image1']) && $bannerImage['image1'] ) ? 'hasBanner' : 'noBanner';
get_header(); 
?>

<div id="primary" class="content-area-full internalPage generic-layout <?php echo $hasBanner ?>">
  <main id="main-content" class="main-content">
  <?php while ( have_posts() ) : the_post(); ?>

      <?php if ($hasBanner=="noBanner") { ?>
      <div class="titlediv typical">
        <h1 class="page-title"><span><?php the_title(); ?></span></h1>
      </div>
      <?php } ?>

      <?php if ( get_the_content() ) { ?>
      <div class="entry-content"><?php the_content(); ?></div>
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
    
  <?php endwhile; ?>
  </main>
</div><!-- #primary -->

<?php //get_template_part('parts/steps'); ?>

<?php
get_footer();
