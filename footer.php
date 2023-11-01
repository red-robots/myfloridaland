	</div><!-- #content -->

  <?php  
  $footer_logo = get_field('footer_logo','option');
  $appstore_link = get_field('appstore_link','option');
  $googleplay_link = get_field('googleplay_link','option');
  $footer_app_label = get_field('footer_app_label','option');
  $appstore_link = get_field('appstore_link','option');
  $googleplay_link = get_field('googleplay_link','option');

  $socialMedia = get_social_media();
  ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
   <div class="wrapper">
     <div class="flexwrap">
       <?php if ($footer_logo) { ?>
        <figure class="footCol footLogo">
          <img src="<?php echo $footer_logo['url'] ?>" alt="<?php echo $footer_logo['title'] ?>">
        </figure> 
       <?php } ?>

      <?php if (has_nav_menu('footer')) { ?>
        <nav class="footCol footerNav">
          <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu','container_class'=>'footer-wrapper') ); ?>
        </nav>  
      <?php } ?>

      <?php if ($socialMedia) { ?>
      <div class="footCol socialMediaLinks">
        <?php foreach ($socialMedia as $s) { ?>
          <a href="<?php echo $s['url'] ?>" target="_blank" class="social" aria-label="<?php echo $s['type'] ?>"><i class="<?php echo $s['icon'] ?>"></i></a>
        <?php } ?>
      </div>
      <?php } ?>


      <?php if ($appstore_link || $googleplay_link) { ?>
      <div class="footCol appInfo">
        <?php if ($footer_app_label) { ?>
        <div class="wtitle"><?php echo $footer_app_label ?></div>
        <?php } ?>
        
        <?php if ($appstore_link) { ?>
        <div class="appDiv">
          <a href="<?php echo $appstore_link ?>" target="_blank" class="app-button apple" aria-label="Apple App Store"></a>
        </div>
        <?php } ?>
        <?php if ($googleplay_link) { ?>
        <div class="appDiv">
          <a href="<?php echo $googleplay_link ?>" target="_blank" class="app-button google" aria-label="Google Play Store"></a>
        </div>
        <?php } ?>
      </div>
      <?php } ?>

     </div>
   </div>	
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
