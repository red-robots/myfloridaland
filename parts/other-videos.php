<?php 
  global $post;
  $current_id = $post->ID; 
  $perpage = ( get_field('num_items_films') ) ? get_field('num_items_films') : 3;
  $args = array(
    'posts_per_page'  => 3,
    'post_type'       => 'films',
    'post_status'     => 'publish',
    'post__not_in'    => array($current_id)
  );
  $films = new WP_Query($args);
  $featuredFilms = array();
  if ( $films->have_posts() ) { ?>
  <section class="films-section">
    <div class="wrapper">
      <div class="flex-wrap">
        <?php while ( $films->have_posts() ) : $films->the_post(); ?>
          <?php  
          $small_title = get_field('small_title');
          $video_thumb = get_field('video_thumbnail');
          $video_link = get_field('video_link');
          $video_description = get_field('video_description');
          $section_class = ( $video_thumb  && $video_link && $video_description ) ? 'half':'full';
          $featuredFilms[] = get_the_ID();
          ?>
          <div class="film-info <?php echo $section_class ?>">
            <div class="flex-wrap">
            <?php if ( $video_thumb  && $video_link ) { ?>
             <figure class="videoFrame">
               <a href="<?php echo $video_link ?>" class="videoLink videopopup" data-fancybox="video">
                 <span class="videoImage" style="background-image:url('<?php echo $video_thumb['url'] ?>')"></span>
                 <span class="player-button"></span>
                 <img src="<?php echo THEMEURI ?>/images/video-helper.png" class="resizer" alt="">
               </a>
             </figure> 
            <?php } ?>

            <?php if ( $video_description ) { ?>
             <div class="videoText">
                <div class="inside">
                  <div class="titlediv">
                  <?php if($small_title) { ?>
                    <div class="infotype"><?php echo $small_title ?></div>
                  <?php } ?>
                    <h3 class="infotitle"><a href="<?php echo get_permalink() ?>"><?php echo get_the_title() ?></a></h3>
                  </div>
                  <div class="infotext">
                    <?php echo $video_description ?>
                    <?php if ($video_link) { ?>
                      <p class="link"><a href="<?php echo $video_link ?>" class="videopopup" data-fancybox="video">Click to Watch Video</a></p>    
                    <?php } ?>
                  </div>
                </div>
             </div>
            <?php } ?>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
    <div class="forest">
      <div class="bird" data-aos="fade-up-right" data-aos-delay="80" data-aos-offset="200" data-aos-duration="1000"></div>
      <div class="tree" data-aos="fade-up" data-aos-delay="40" data-aos-duration="800"></div>
    </div>
  </section>
  <?php } ?>