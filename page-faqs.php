<?php
/*
 * Template Name: FAQs
 */
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
      ?>

      <section class="section section-intro">
        <div class="wrapper">
          <?php if ($intro_icon) { ?>
          <figure class="intro-icon">
            <img src="<?php echo $intro_icon['url'] ?>" alt="" />
          </figure>
          <?php } ?>  
          <?php if ($intro_text) { ?><div class="intro-text"><?php echo anti_email_spam($intro_text) ?></div><?php } ?>
        </div>
      </section>


      <?php if( have_rows('faqs') ) { ?>
      <section class="section section-faqs">
        <div class="wrapper">
          <div class="faqs">
          <?php $i=1; while( have_rows('faqs') ) : the_row(); 
            $topic = get_sub_field('topic');
            $faqs = get_sub_field('faqs');
            if($topic && $faqs) { ?>
              <div class="faq-topic<?php echo ($i==1) ? ' active':''?>">
                <div class="inner">
                  <h2 class="topic"><a href="javascript:void(0)"><span class="expand"></span><?php echo $topic; ?></a></h2>
                  <div class="faq-items">
                  <?php foreach ($faqs as $f) { 
                    $question = $f['question'];
                    $answer = $f['answer'];
                    if($question) { ?>
                    <div class="item">
                      <h3 class="question">Q: <?php echo $question ?></h3>
                      <div class="answer"><?php echo $answer ?></div>
                    </div>
                    <?php } ?>
                  <?php } ?>
                  </div>
                </div>
              </div>
            <?php $i++; } ?>
          <?php endwhile; ?>
          </div>
        </div>
      </section>
      <?php } ?>
    
  <?php endwhile; ?>
  </main>
</div><!-- #primary -->

<?php get_template_part('parts/steps'); ?>

<?php
get_footer();
