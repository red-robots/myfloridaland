<?php 
get_header(); 
?>

<?php while ( have_posts() ) : the_post(); ?>

  <?php  
    $intro_videoThumb = get_field('about_video_thumbnail');
    $intro_videoLink = get_field('about_video_url');
    $intro_videoText = get_field('about_intro_text');
    $intro_class = ( $intro_videoThumb  && $intro_videoLink && $intro_videoText ) ? 'half':'full';
  ?>
    <div class="intro-section <?php echo $intro_class ?>">
      <div class="wrapper">
        <div class="flex-wrap">
          <?php if ( $intro_videoThumb  && $intro_videoLink ) { ?>
           <figure class="videoFrame">
             <a href="<?php echo $intro_videoLink ?>" class="videoLink videopopup" data-fancybox="video-gallery">
               <span class="videoImage" style="background-image:url('<?php echo $intro_videoThumb['url'] ?>')"></span>
               <span class="player-button"></span>
               <img src="<?php echo THEMEURI ?>/images/video-helper.png" class="resizer" alt="">
             </a>
           </figure> 
          <?php } ?>

          <?php if ( $intro_videoText ) { ?>
           <div class="videoText">
              <div class="inside">
                <?php echo $intro_videoText ?>
              </div>
           </div>
          <?php } ?>
        </div>
      </div>
    </div>

  <?php if ( get_the_content() ) { ?>
    <div class="entry-content"><?php the_content() ?></div>
  <?php } ?>

<?php endwhile; ?>

<?php
get_footer();