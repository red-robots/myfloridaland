<?php  
if( is_home() || is_front_page() ) {
  $banner = get_field('static_banner');
  $bannerText = get_field('static_banner_text');
  if( $banner ) { ?>
  
  <h1 class="hidden-title"><?php echo get_bloginfo('') ?></h1>
  <div class="home-banner">
    <figure style="background-image:url('<?php echo $banner['url'] ?>')">
      <img src="<?php echo THEMEURI ?>/images/resizer-wide.png" alt="">
    </figure>
    <?php if($bannerText) { ?>
    <div class="banner-text">
      <div class="inside">
        <?php echo $bannerText ?>
      </div>
    </div>
    <?php } ?>
    <!-- <div class="topgrass">
      <img src="<?php //echo THEMEURI ?>/images/top-grass.png" alt="">
    </div> -->
    <div class="topgrass" style="background-image:url('<?php echo THEMEURI ?>/images/top-grass.png')"></div>    
  </div>

  <?php } ?>

<?php } else { ?>

  <?php if( is_page() ) { ?>


  <?php } ?>

<?php } ?>