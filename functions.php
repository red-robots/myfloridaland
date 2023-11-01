<?php
/**
 * bellaworks functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bellaworks
 */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/anti-email-spam.php';


/**
 * Theme Specific additions.
 */
require get_template_directory() . '/inc/theme.php';

/**
 * Block & Disable All New User Registrations & Comments Completely.
 * Description:  This simple plugin blocks all users from being able to register no matter what, 
 *				 this also blocks comments from being able to be inserted into the database.
 */
require get_template_directory() . '/inc/block-all-registration-and-comments.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/visual-biography-editor/visual-editor-biography.php';


function exportPosts() {
  global $wpdb;
  $prefix = 'SERVMASK_PREFIX_';
  $mydb = new wpdb('root','','bella_happynestlive','localhost');
  $query = "SELECT p.* FROM ".$prefix."posts p WHERE p.post_type='post' AND p.post_status='publish' OR p.post_status='draft'";
  $posts = $mydb->get_results($query);
  $uploads_dir = wp_upload_dir();
  $uploads_dir = $uploads_dir['basedir'] . '/';
  //$uploads_dir = str_replace('/uploads','/',$uploads_dir) . 'uploads-live/';
  $postIds = [];
  $userid = 4; /* HappyNest */
  if($posts) {
    foreach($posts as $p) {
      $id = $p->ID;
      $p->post_author = $userid;
      $p->post_parent = 0;
      $postarr = $p;
      unset($postarr->ID);

      $termsQuery = "SELECT tm.name, tm.slug FROM ".$prefix."term_relationships rel, ".$prefix."terms tm WHERE rel.term_taxonomy_id=tm.term_id AND rel.object_id=".$id;
      $terms = $mydb->get_results($termsQuery);
      $postTermIds = [];
      if($terms) {
        foreach($terms as $term) {
          $termName = $term->name;
          $termSlug = $term->slug;
          $a_query = "SELECT term.* FROM ".$wpdb->prefix."terms term WHERE term.name='".$termName."' AND term.slug='".$termSlug."'";
          $a_terms = $wpdb->get_results($a_query);
          if($a_terms) {
            foreach($a_terms as $a) {
              $postTermIds[] = $a->term_id;
            }
          }
        }
      }      


      $imgQuery = "SELECT post_title,post_name,guid FROM ".$prefix."posts p WHERE p.post_type='attachment' AND post_parent=".$id;
      $img = $mydb->get_row($imgQuery);
      // if($img) {
      //   $path = $img->guid;
      //   $file = explode('/wp-content/uploads/',$path)[1];
      //   $featuredImage = '';
      //   if( file_exists($uploads_dir . $file) ) {
      //     $absoluteFilePath = $uploads_dir . $file;
      //     $featuredImage = get_site_url() .'/wp-content/uploads/'. $file;
      //     $finfo = finfo_open(FILEINFO_MIME_TYPE);
      //     $mimeType = finfo_file($finfo, $absoluteFilePath);
      //     print_r( $absoluteFilePath . '<br>');
      //   }
      // }


      
      
      // $postarr = array(
      //   'post_title' => $p->post_title,
      //   'post_content' => $p->post_content,
      //   'post_date' => $p->post_date,
      //   'post_date_gmt' => $p->post_date_gmt,
      //   'post_excerpt' => $p->post_excerpt;
      //   'post_type' => 'post',
      //   'post_status' => $p->post_status,
      //   'post_author' => $userid 
      // );

      $insert_id = wp_insert_post($postarr, true);
      if (!is_wp_error($insert_id)) {
        if($postTermIds) {
          wp_set_post_terms( $insert_id, $postTermIds, 'category');
        }
        
        if($img) {
          $path = $img->guid;
          $file = explode('/wp-content/uploads/',$path)[1];
          $featuredImage = '';
          if( file_exists($uploads_dir . $file) ) {
            $absoluteFilePath = $uploads_dir . $file;
            $featuredImage = get_site_url() .'/wp-content/uploads/'. $file;
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $absoluteFilePath);
            $attachment = array(
              'post_title' => $img->post_title,
              'post_name' => $img->post_name,
              'guid'=> $featuredImage,
              'post_mime_type' => $mimeType,
              'post_author' => $userid,
              'post_status' => 'inherit'
            );
            $attach_id = wp_insert_attachment($attachment, $absoluteFilePath, $insert_id);
            // Include image.php
            require_once ABSPATH . 'wp-admin/includes/image.php';
            // Define attachment metadata
            $attach_data = wp_generate_attachment_metadata($attach_id, $absoluteFilePath);
            // Assign metadata to attachment
            wp_update_attachment_metadata($attach_id, $attach_data);
            // And finally assign featured image to post
            $thumbnail = set_post_thumbnail($insert_id, $attach_id);
          }
        }
      }
      $postIds[] = $insert_id;

    }
  }

  if($postIds) {
    echo 'Total posts imported: ' . count($postIds);
  }
  

  // Create the category
  // $category_query = "SELECT trm.* FROM ".$prefix."term_taxonomy tax,".$prefix."terms trm WHERE tax.taxonomy='category' AND tax.term_id=trm.term_id AND trm.slug!='uncategorized'";
  // $categories = $mydb->get_results($category_query);
  // $newCatIds = [];
  // if( $categories ) {
  //   foreach($categories as $cat) {
  //     $slug = sanitize_title($cat->name);
  //     $args['slug'] = $slug;
  //     $newCatIds[] = wp_insert_term($cat->name,'category',$args);
  //   }
  // }
}

