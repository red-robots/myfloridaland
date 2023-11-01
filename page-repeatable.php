<?php
/**
 * Template Name: Repeatable Blocks
 */

get_header(); 
?>
<div id="primary" class="content-area-full repeatable-layout ">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

    <h1 class="pageTitleHidden"><?php echo get_the_title(); ?></h1>
			
      <?php if( have_rows('repeatable_blocks') ) { ?>
      <div class="repeatable-blocks">
        <?php $n=1; while( have_rows('repeatable_blocks') ): the_row(); ?>
          <?php if( get_row_layout() == 'fullwidth_section' ) { 
            $icon = get_sub_field('icon');
            $content = get_sub_field('content');
            $buttons = get_sub_field('buttons'); 
            if($content) { ?>
            <div class="repeatable fullwidthBlock">
              <div class="wrapper">
                <?php if ($icon) { ?>
                <figure class="icon">
                  <img src="<?php echo $icon['url'] ?>" alt="" />
                </figure>  
                <?php } ?>
                <?php if ($content) { ?><div class="text"><?php echo anti_email_spam($content) ?></div><?php } ?>
                <?php if ($buttons) { ?>
                <div class="buttonsWrapper">
                  <?php foreach ($buttons as $btn) { 
                    $b = $btn['link'];
                    $btnTitle = ( isset($b['title']) && $b['title'] ) ? $b['title'] : ''; 
                    $btnLink = ( isset($b['url']) && $b['url'] ) ? $b['url'] : ''; 
                    $btnTarget = ( isset($b['target']) && $b['target'] ) ? $b['target'] : '_self'; 
                    if($btnTitle && $btnLink) { ?>
                    <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
                    <?php } ?>
                  <?php } ?>
                </div>  
                <?php } ?>
              </div>
            </div>
            <?php } ?> 

          <?php } else if ( get_row_layout() == 'two_column_block' ) { 
            $content = get_sub_field('content2'); 
            $textcolor = get_sub_field('textcolor');
            $color = ($textcolor) ? $textcolor : '#000';
            $buttons = get_sub_field('buttons2'); 
            $content_position = get_sub_field('content_position');
            $imageBlock = get_sub_field('image_block');
            $bgImage = get_sub_field('background_image');
            $background_color = get_sub_field('background_color');
            $bgColor = ($background_color) ? $background_color : '#FFF';
            ?>
            <div class="repeatable twoColumnBlock content-<?php echo $content_position ?>" style="background-color:<?php echo $bgColor?>">
              <div class="wrapper">
                <div class="flexwrap">
                  <?php if ($content) { ?>
                    <div class="textCol">
                      <div class="text" style="color:<?php echo $color?>"><?php echo anti_email_spam($content) ?></div>
                      <?php if ($buttons) { ?>
                      <div class="buttonsWrapper">
                        <?php foreach ($buttons as $btn) { 
                          $b = $btn['link'];
                          $btnTitle = ( isset($b['title']) && $b['title'] ) ? $b['title'] : ''; 
                          $btnLink = ( isset($b['url']) && $b['url'] ) ? $b['url'] : ''; 
                          $btnTarget = ( isset($b['target']) && $b['target'] ) ? $b['target'] : '_self'; 
                          if($btnTitle && $btnLink) { ?>
                          <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
                          <?php } ?>
                        <?php } ?>
                      </div>  
                      <?php } ?>
                    </div>
                  <?php } ?>
                  <?php if ($imageBlock) { ?>
                    <figure class="imageCol">
                      <img src="<?php echo $imageBlock['url'] ?>" alt="" />
                    </figure>  
                  <?php } ?>
                </div>
              </div>
              <?php if ($bgImage) { ?>
              <div class="bgImage" style="background-image:url('<?php echo $bgImage['url'] ?>');"></div>  
              <?php } ?>
            </div>
          <?php $n++; } else if ( get_row_layout() == 'grid_layout' ) {  
            $blocks = get_sub_field('blocks'); ?> 
            <div class="repeatable grid-layout">
              <div class="wrapper">
                <div class="flexwrap blocks">
                  <?php foreach ($blocks as $b) { 
                    $title = $b['title'];
                    $text = $b['text'];
                    $btn = $b['button'];
                    $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
                    $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
                    $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
                    $image = $b['image'];
                    ?>
                    <div class="block">
                      <div class="inside">
                        <?php if ($image) { ?>
                        <div class="bImage">
                          <figure style="background-image:url('<?php echo $image['url'] ?>')">
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/rectangle-lg.png" alt="">
                          </figure>
                        </div>
                        <div class="desc">
                          <?php } ?>
                          <?php if ($title) { ?>
                          <div class="bTitle"><?php echo $title ?></div>
                          <?php } ?>
                          <?php if ($text) { ?>
                          <div class="bText"><?php echo $text ?></div>
                          <?php } ?>
                          <?php if ($btnTitle && $btnLink) { ?>
                          <div class="buttondiv">
                            <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } ?>

        <?php endwhile; ?>
      </div>
      <?php } ?>

		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_template_part('parts/steps'); ?>

<?php
get_footer();
