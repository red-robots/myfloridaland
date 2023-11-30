<?php 
get_header(); 
?>

<?php while ( have_posts() ) : the_post(); ?>

  <?php  
    $intro_videoThumb = get_field('about_video_thumbnail');
    $intro_videoLink = get_field('about_video_url');
    $intro_videoText = get_field('about_intro_text');
    $page_link = get_field('page_link');
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
                <?php if ($page_link) { ?>
                  <p class="link"><a href="<?php echo $page_link['url'] ?>" class="about-link"><?php echo $page_link['title'] ?></a></p>    
                <?php } ?>
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
  $perpage = ( get_field('num_items_films') ) ? get_field('num_items_films') : 3;
  $args = array(
    'posts_per_page'  => $perpage,
    'post_type'       => 'films',
    'post_status'     => 'publish',
    'meta_query'      =>  array(
      array(
        'key'     => 'featured',
        'compare' => '=',
        'value'   => 'yes',
      )
    )
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
          if($video_description) {
            $video_description = shortenText( strip_tags($video_description), 150, ".","...");
          }
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

  <?php  
  $feat_category = get_field('feat_category');
  $feat_textcontent = get_field('feat_textcontent');
  $args2 = array(
    'posts_per_page'  => 15,
    'post_type'       => 'films',
    'post_status'     => 'publish',
    'meta_query'      =>  array(
      'relation' => 'OR',
      array(
        'key'     => 'featured',
        'compare' => '=',
        'value'   => 'no',
      ),
      array(
        'key'     => 'featured',
        'compare' => 'NOT EXISTS'
      )
    )
  );

  if($featuredFilms) {
    $args2['post__not_in'] = $featuredFilms;
  }
  $posts = new WP_Query($args2);
  if( $feat_textcontent ) { ?>
  <section class="featured-items-section">
    <div class="wrapper">
      <?php if ($feat_category) { ?><div class="category"><?php echo $feat_category ?></div><?php } ?>
      <div class="textwrap"><?php echo $feat_textcontent ?></div>
      <?php if ( $posts->have_posts() ) { ?>
      <div class="recent-films">
        <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
          <div class="info">
            <a href="<?php echo get_permalink() ?>"><?php the_title() ?></a>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
      <?php } ?>
    </div>
  </section>
  <?php } ?>
<?php
get_footer();