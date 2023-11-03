	</div><!-- #content -->

  <?php
  $custom_logo_id = get_theme_mod( 'custom_logo' );
  $logoImg = ($custom_logo_id) ? wp_get_attachment_image_src($custom_logo_id,'large') : '';
  ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
   <div class="wrapper">

    <div class="footer-site-info">
      <?php if( get_custom_logo() ) { ?>
        <div class="footer-logo"><img src="<?php echo $logoImg[0]  ?>" alt="<?php bloginfo('name'); ?> Logo"></div>
      <?php } ?>
      <div class="sitename"><?php bloginfo('name'); ?></div>
     </div>

   </div>	
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
