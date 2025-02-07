	</div><!-- #content -->

  <?php
  $custom_logo_id = get_theme_mod( 'custom_logo' );
  $logoImg = ($custom_logo_id) ? wp_get_attachment_image_src($custom_logo_id,'large') : '';
  $credit = get_field('credit', 'option');
  ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
   <div class="wrapper">

    <div class="footer-site-info">
      <?php if( get_custom_logo() ) { ?>
        <div class="footer-logo">
          <a href="<?php bloginfo('url'); ?>/">
            <img src="<?php echo $logoImg[0]  ?>" alt="<?php bloginfo('name'); ?> Logo">
          </a>
        </div>
      <?php } ?>

      <div class="sitename"><?php bloginfo('name'); ?></div>
      <div class="credit"><?php echo $credit; ?></div>
     </div>

   </div>	
	</footer><!-- #colophon -->
</div><!-- #page -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
AOS.init();
</script>
<?php wp_footer(); ?>
</body>
</html>
