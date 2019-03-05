<?php 
/*
 Plugin Name: VW Scool Pro Posttype
 lugin URI: https://www.vwthemes.com/
 Description: Creating new post type for VW School Pro Theme.
 Author: VW Themes
 Version: 1.0
 Author URI: https://www.vwthemes.com/
*/

define( 'VW_SCHOOL_PRO_POSTTYPE_VERSION', '1.0' );

add_action( 'init', 'createpackages');
add_action( 'init', 'vw_school_pro_posttype_create_post_type' );

function vw_school_pro_posttype_create_post_type() {
  register_post_type( 'courses',
    array(
        'labels' => array(
            'name' => __( 'Courses','vw-school-pro-posttype' ),
            'singular_name' => __( 'Courses','vw-school-pro-posttype' )
        ),
        'capability_type' =>  'post',
        'menu_icon'  => 'dashicons-welcome-learn-more',
        'public' => true,
        'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'page-attributes',
        'comments'
        )
    )
  );
  register_post_type( 'events',
    array(
      'labels' => array(
        'name' => __( 'Events','vw-school-pro-posttype' ),
        'singular_name' => __( 'Events','vw-school-pro-posttype' )
      ),
        'capability_type' =>  'post',
        'menu_icon'  => 'dashicons-admin-home',
        'public' => true,
        'supports' => array(
          'title',
          'editor',
          'revisions',
          'thumbnail',
          'author'
      )
    )
  );
  register_post_type( 'testimonials',
    array(
  		'labels' => array(
  			'name' => __( 'Testimonials','vw-school-pro-posttype' ),
  			'singular_name' => __( 'Testimonials','vw-school-pro-posttype' )
  		),
  		'capability_type' => 'post',
  		'menu_icon'  => 'dashicons-businessman',
  		'public' => true,
  		'supports' => array(
  			'title',
  			'editor',
  			'thumbnail'
  		)
		)
	);
  register_post_type( 'team',
    array(
      'labels' => array(
        'name' => __( 'Our Team','vw-school-pro-posttype' ),
        'singular_name' => __( 'Our Team','vw-school-pro-posttype' )
      ),
        'capability_type' => 'post',
        'menu_icon'  => 'dashicons-businessman',
        'public' => true,
        'supports' => array( 
          'title',
          'editor',
          'thumbnail'
      )
    )
  );
}
function createpackages() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => __( 'Events Packages', 'vw-school-pro-posttype' ),
    'singular_name'     => __( 'Events Packages', 'vw-school-pro-posttype' ),
    'search_items'      => __( 'Search Ccats', 'vw-school-pro-posttype' ),
    'all_items'         => __( 'All Events Packages', 'vw-school-pro-posttype' ),
    'parent_item'       => __( 'Parent Events Packages', 'vw-school-pro-posttype' ),
    'parent_item_colon' => __( 'Parent Events Packages:', 'vw-school-pro-posttype' ),
    'edit_item'         => __( 'Edit Events Packages', 'vw-school-pro-posttype' ),
    'update_item'       => __( 'Update Events Packages', 'vw-school-pro-posttype' ),
    'add_new_item'      => __( 'Add New Events Packages', 'vw-school-pro-posttype' ),
    'new_item_name'     => __( 'New Events Packages Name', 'vw-school-pro-posttype' ),
    'menu_name'         => __( 'Events Packages', 'vw-school-pro-posttype' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'createpackages' ),
  );
  register_taxonomy( 'createpackages', array( 'events' ), $args );
}

/*---------------------------------courses ---------------------------------------*/
function vw_school_pro_posttype_bn_tutor_meta() {
    add_meta_box( 'vw_school_pro_posttype_bn_meta', __( 'Enter tutor','vw-school-pro-posttype' ), 'vw_school_pro_posttype_bn_meta_priceback', 'courses', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_school_pro_posttype_bn_tutor_meta');
}
/* Adds a meta box for custom post */
function vw_school_pro_posttype_bn_meta_priceback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'vw_school_pro_posttype_bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    ?>
    <div id="courses_custom_stuff">
        <table id="list-table">         
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-1">
                    <td class="left">
                        <?php esc_html_e( 'Subtitle', 'vw-school-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <textarea class="widefat" id="meta-subtitle" name="meta-subtitle" type="text"  value="<?php echo $bn_stored_meta['meta-subtitle'][0]; ?>" ><?php echo $bn_stored_meta['meta-subtitle'][0]; ?></textarea>
                    </td>
                </tr> 
                <tr id="meta-2">
                    <td class="left">
                        <?php esc_html_e( 'Price', 'vw-school-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="number" name="meta-price" id="meta-price" value="<?php echo esc_html($bn_stored_meta['meta-price'][0]); ?>" />
                    </td>
                </tr>                
                <tr id="meta-7">
                  <td class="left">
                    <?php esc_html_e( 'Tutor', 'vw-school-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="text" name="meta-tutor" id="meta-tutor" value="<?php echo esc_html($bn_stored_meta['meta-tutor'][0]); ?>" />
                  </td>
                </tr>
                <tr id="meta-9">
                  <td class="left">
                    <?php esc_html_e( 'Starts', 'vw-school-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="text" name="meta-starts" id="meta-starts" class="meta-starts regular-text" value="<?php echo $bn_stored_meta['meta-starts'][0]; ?>">
                  </td>
                </tr>
                <tr id="meta-9">
                  <td class="left">
                    <?php esc_html_e( 'Duration', 'vw-school-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="text" name="meta-duration" id="meta-duration" class="meta-duration regular-text" value="<?php echo $bn_stored_meta['meta-duration'][0]; ?>">
                  </td>
                </tr>
                <tr id="meta-9">
                  <td class="left">
                    <?php esc_html_e( 'Institution', 'vw-school-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="text" name="meta-institution" id="meta-institution" class="meta-institution regular-text" value="<?php echo $bn_stored_meta['meta-institution'][0]; ?>">
                  </td>
                </tr>
                <tr id="meta-9">
                  <td class="left">
                    <?php esc_html_e( 'Seats Available', 'vw-school-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="text" name="meta-seat" id="meta-seat" class="meta-seat regular-text" value="<?php echo $bn_stored_meta['meta-seat'][0]; ?>">
                  </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}
/* Saves the custom fields meta input */
function vw_school_pro_posttype_bn_metadesig_courses_save( $post_id ) {
  if( isset( $_POST[ 'meta-subtitle' ] ) ) {
        update_post_meta( $post_id, 'meta-subtitle', sanitize_text_field($_POST[ 'meta-subtitle' ]) );
    }
    if( isset( $_POST[ 'meta-price' ] ) ) {
        update_post_meta( $post_id, 'meta-price', sanitize_text_field($_POST[ 'meta-price' ]) );
    }
    if( isset( $_POST[ 'meta-tutor' ] ) ) {
        update_post_meta( $post_id, 'meta-tutor', sanitize_text_field($_POST[ 'meta-tutor' ]) );
    }
    if( isset( $_POST[ 'meta-starts' ] ) ) {
        update_post_meta( $post_id, 'meta-starts', sanitize_text_field($_POST[ 'meta-starts' ]) );
    }
    if( isset( $_POST[ 'meta-duration' ] ) ) {
        update_post_meta( $post_id, 'meta-duration', sanitize_text_field($_POST[ 'meta-duration' ]) );
    }
    if( isset( $_POST[ 'meta-institution' ] ) ) {
        update_post_meta( $post_id, 'meta-institution', sanitize_text_field($_POST[ 'meta-institution' ]) );
    }
    if( isset( $_POST[ 'meta-seat' ] ) ) {
        update_post_meta( $post_id, 'meta-seat', sanitize_text_field($_POST[ 'meta-seat' ]) );
    }
}
add_action( 'save_post', 'vw_school_pro_posttype_bn_metadesig_courses_save' );

/*--------------------------------------Events------------------------------------------*/
/* Adds a meta box to the Trainer editing screen */
function vw_school_pro_bn_custom_meta_events() {
    add_meta_box( 'bn_meta', __( 'Events Meta', 'vw-school-pro-posttype' ), 'vw_school_pro_bn_meta_callback_events', 'events', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'vw_school_pro_bn_custom_meta_events');
}
/* Adds a meta box for custom post */
function vw_school_pro_bn_meta_callback_events( $post_id ) {
    wp_nonce_field( basename( __FILE__ ), 'bn_nonce' );
    $bn_stored_meta = get_post_meta( $post_id->ID );

    //location details
    if(!empty($bn_stored_meta['meta-location'][0]))
      $bn_meta_location = $bn_stored_meta['meta-location'][0];
    else
      $bn_meta_location = '';

    //date details
    if(!empty($bn_stored_meta['meta-date'][0]))
      $bn_meta_date = $bn_stored_meta['meta-date'][0];
    else
      $bn_meta_date = '';

    //Time details
    if(!empty($bn_stored_meta['meta-time'][0]))
      $bn_meta_time = $bn_stored_meta['meta-time'][0];
    else
      $bn_meta_time = '';

    ?>
  <div id="property_stuff">
    <table id="list-table">     
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left" id="meta-location">
            <?php _e( 'Location', 'vw-school-pro-posttype' )?>
          </td>
          <td class="left" >
            <input class="widefat" id="meta-location" name="meta-location" type="text" value="<?php echo esc_attr($bn_meta_location); ?>" >
          </td>
        </tr>
        <tr id="meta-2">
          <td class="left">
            <?php _e( 'Date', 'vw-school-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="meta-date" id="meta-date" value="<?php echo esc_attr($bn_meta_date); ?>" />
          </td>
        </tr>
        <tr id="meta-3">
          <td class="left">
            <?php _e( 'Time', 'vw-school-pro-posttype' )?>
          </td>
          <td class="left">
            <input type="text" name="meta-time" id="meta-time" value="<?php echo esc_attr($bn_meta_time); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
    <?php
}

/* Saves the custom meta input */
function vw_school_pro_bn_meta_save_events( $post_id ) {
  if (!isset($_POST['bn_nonce']) || !wp_verify_nonce($_POST['bn_nonce'], basename(__FILE__))) {
    return;
    }

    if (!current_user_can('edit_post', $post_id)) {
    return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
    }
    // Save location
    if( isset( $_POST[ 'meta-location' ] ) ) {
        update_post_meta( $post_id, 'meta-location', $_POST[ 'meta-location' ] );
    }
    if( isset( $_POST[ 'meta-date' ] ) ) {
        update_post_meta( $post_id, 'meta-date', $_POST[ 'meta-date' ] );
    }
    // Save main meta_propertyid
    if( isset( $_POST[ 'meta-time' ] ) ) {
        update_post_meta( $post_id, 'meta-time', $_POST[ 'meta-time' ] );
    }
  }
add_action( 'save_post', 'vw_school_pro_bn_meta_save_events' );

/*---------------------------------- Testimonial section -------------------------------------*/
/* Adds a meta box to the Testimonial editing screen */
function vw_school_pro_posttype_bn_testimonial_meta_box() {
	add_meta_box( 'vw-school-pro-posttype-testimonial-meta', __( 'Enter Details', 'vw-school-pro-posttype' ), 'vw_school_pro_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_school_pro_posttype_bn_testimonial_meta_box');
}

/* Adds a meta box for custom post */
function vw_school_pro_posttype_bn_testimonial_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'vw_school_pro_posttype_posttype_testimonial_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
	$desigstory = get_post_meta( $post->ID, 'vw_school_pro_posttype_testimonial_desigstory', true );
	?>
	<div id="testimonials_custom_stuff">
		<table id="list">
			<tbody id="the-list" data-wp-lists="list:meta">
				<tr id="meta-1">
					<td class="left">
						<?php _e( 'Designation', 'vw-school-pro-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="vw_school_pro_posttype_testimonial_desigstory" id="vw_school_pro_posttype_testimonial_desigstory" value="<?php echo esc_attr( $desigstory ); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
}

/* Saves the custom meta input */
function vw_school_pro_posttype_bn_metadesig_save( $post_id ) {
	if (!isset($_POST['vw_school_pro_posttype_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['vw_school_pro_posttype_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Save desig.
	if( isset( $_POST[ 'vw_school_pro_posttype_testimonial_desigstory' ] ) ) {
		update_post_meta( $post_id, 'vw_school_pro_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'vw_school_pro_posttype_testimonial_desigstory']) );
	}

}

add_action( 'save_post', 'vw_school_pro_posttype_bn_metadesig_save' );

/*---------------------------------- Testimonials shortcode --------------------------------------*/
function vw_school_pro_posttype_testimonial_func( $atts ) {

    $testimonial = ''; 
    $testimonial = '<div class="row">';
    $custom_url = '';
      $new = new WP_Query( array( 'post_type' => 'testimonials' ) );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $excerpt = wp_trim_words(get_the_excerpt(),25);
          if(has_post_thumbnail()) {
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
          $thumb_url = $thumb['0'];
          }
          $desigstory= get_post_meta($post_id,'vw_school_pro_posttype_testimonial_desigstory',true);
            $testimonial .= '
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="our_testimonials_outer testimonial-shortcode">
                            <div class="testimonials_inner row m-0">
                              <div class="testimonials-icon col-lg-5 p-0">
                                <img src="'.$thumb_url.'" alt=""/>
                              </div>
                              <div class="testimonials-box col-lg-7">
                                <h3>'.get_the_title().'</h3>
                                <h5>'.$desigstory.'</h5>
                                <p>'.$excerpt.'</p>
                              </div>
                            </div>
                          </div>
                        </div>';  
            if($k%3 == 0){
                $testimonial.= '<div class="clearfix"></div>'; 
            } 
          $k++;         
        endwhile; 
        wp_reset_postdata();
      else :
        $project = '<h2 class="center">'.__('Not Found','vw-school-pro-posttype').'</h2>';
      endif;
    $testimonial.= '</div>';
  return $testimonial;
  //
}
add_shortcode( 'vw-school-pro-testimonials', 'vw_school_pro_posttype_testimonial_func' );

/*-------------------------------------- Expert -------------------------------------------*/
/* Adds a meta box for Designation */
function vw_school_pro_posttype_bn_team_meta() {
    add_meta_box( 'vw_school_pro_posttype_bn_meta', __( 'Enter Details','vw-school-pro-posttype' ), 'vw_school_pro_posttype_ex_bn_meta_callback', 'team', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_school_pro_posttype_bn_team_meta');
}
/* Adds a meta box for custom post */
function vw_school_pro_posttype_ex_bn_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'vw_school_pro_posttype_bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );

    //Email details
    if(!empty($bn_stored_meta['meta-desig'][0]))
      $bn_meta_desig = $bn_stored_meta['meta-desig'][0];
    else
      $bn_meta_desig = '';

    //Phone details
    if(!empty($bn_stored_meta['meta-call'][0]))
      $bn_meta_call = $bn_stored_meta['meta-call'][0];
    else
      $bn_meta_call = '';


    //facebook details
    if(!empty($bn_stored_meta['meta-facebookurl'][0]))
      $bn_meta_facebookurl = $bn_stored_meta['meta-facebookurl'][0];
    else
      $bn_meta_facebookurl = '';


    //linkdenurl details
    if(!empty($bn_stored_meta['meta-linkdenurl'][0]))
      $bn_meta_linkdenurl = $bn_stored_meta['meta-linkdenurl'][0];
    else
      $bn_meta_linkdenurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['meta-twitterurl'][0]))
      $bn_meta_twitterurl = $bn_stored_meta['meta-twitterurl'][0];
    else
      $bn_meta_twitterurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['meta-googleplusurl'][0]))
      $bn_meta_googleplusurl = $bn_stored_meta['meta-googleplusurl'][0];
    else
      $bn_meta_googleplusurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['meta-designation'][0]))
      $bn_meta_designation = $bn_stored_meta['meta-designation'][0];
    else
      $bn_meta_designation = '';

    ?>
    <div id="agent_custom_stuff">
        <table id="list-table">         
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-1">
                    <td class="left">
                        <?php _e( 'Email', 'vw-school-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-desig" id="meta-desig" value="<?php echo esc_attr($bn_meta_desig); ?>" />
                    </td>
                </tr>
                <tr id="meta-2">
                    <td class="left">
                        <?php _e( 'Phone Number', 'vw-school-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-call" id="meta-call" value="<?php echo esc_attr($bn_meta_call); ?>" />
                    </td>
                </tr>
                <tr id="meta-3">
                  <td class="left">
                    <?php _e( 'Facebook Url', 'vw-school-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-facebookurl" id="meta-facebookurl" value="<?php echo esc_url($bn_meta_facebookurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-4">
                  <td class="left">
                    <?php _e( 'Linkedin URL', 'vw-school-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-linkdenurl" id="meta-linkdenurl" value="<?php echo esc_url($bn_meta_linkdenurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-5">
                  <td class="left">
                    <?php _e( 'Twitter Url', 'vw-school-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-twitterurl" id="meta-twitterurl" value="<?php echo esc_url( $bn_meta_twitterurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-6">
                  <td class="left">
                    <?php _e( 'GooglePlus URL', 'vw-school-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-googleplusurl" id="meta-googleplusurl" value="<?php echo esc_url($bn_meta_googleplusurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-7">
                  <td class="left">
                    <?php _e( 'Designation', 'vw-school-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="text" name="meta-designation" id="meta-designation" value="<?php echo esc_attr($bn_meta_designation); ?>" />
                  </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}
/* Saves the custom Designation meta input */
function vw_school_pro_posttype_ex_bn_metadesig_save( $post_id ) {
    if( isset( $_POST[ 'meta-desig' ] ) ) {
        update_post_meta( $post_id, 'meta-desig', esc_html($_POST[ 'meta-desig' ]) );
    }
    if( isset( $_POST[ 'meta-call' ] ) ) {
        update_post_meta( $post_id, 'meta-call', esc_html($_POST[ 'meta-call' ]) );
    }
    // Save facebookurl
    if( isset( $_POST[ 'meta-facebookurl' ] ) ) {
        update_post_meta( $post_id, 'meta-facebookurl', esc_url($_POST[ 'meta-facebookurl' ]) );
    }
    // Save linkdenurl
    if( isset( $_POST[ 'meta-linkdenurl' ] ) ) {
        update_post_meta( $post_id, 'meta-linkdenurl', esc_url($_POST[ 'meta-linkdenurl' ]) );
    }
    if( isset( $_POST[ 'meta-twitterurl' ] ) ) {
        update_post_meta( $post_id, 'meta-twitterurl', esc_url($_POST[ 'meta-twitterurl' ]) );
    }
    // Save googleplusurl
    if( isset( $_POST[ 'meta-googleplusurl' ] ) ) {
        update_post_meta( $post_id, 'meta-googleplusurl', esc_url($_POST[ 'meta-googleplusurl' ]) );
    }
    // Save designation
    if( isset( $_POST[ 'meta-designation' ] ) ) {
        update_post_meta( $post_id, 'meta-designation', esc_html($_POST[ 'meta-designation' ]) );
    }
}
add_action( 'save_post', 'vw_school_pro_posttype_ex_bn_metadesig_save' );

add_action( 'save_post', 'bn_meta_save' );
/* Saves the custom meta input */
function bn_meta_save( $post_id ) {
  if( isset( $_POST[ 'vw_school_pro_posttype_team_featured' ] )) {
      update_post_meta( $post_id, 'vw_school_pro_posttype_team_featured', esc_attr(1));
  }else{
    update_post_meta( $post_id, 'vw_school_pro_posttype_team_featured', esc_attr(0));
  }
}
/*------------------------------------- SHORTCODES -------------------------------------*/

/*------------------------------------- Team Shorthcode -------------------------------------*/
function vw_school_pro_posttype_agent_func( $atts ) {
    $team = ''; 
    $team = '<div class="row">';
      $new = new WP_Query( array( 'post_type' => 'team') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();

          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
          $url = $thumb['0'];
          $excerpt = vw_school_pro_string_limit_words(get_the_excerpt(),20);
          $designation= get_post_meta($post_id,'meta-designation',true);
          $call= get_post_meta($post_id,'meta-call',true);
          $facebookurl= get_post_meta($post_id,'meta-facebookurl',true);
          $linkedin=get_post_meta($post_id,'meta-linkdenurl',true);
          $twitter=get_post_meta($post_id,'meta-twitterurl',true);
          $googleplus=get_post_meta($post_id,'meta-googleplusurl',true);

          $team .= '<div class="col-lg-3 col-md-3">
                      <div class="team_wrap mb-4">
                        <div class="team-image">
                          <img src="'.$url.'" alt=""/>
                        <div class="team-socialbox"> 
                          <div class="inner_socio">';
                          if(get_post_meta($post_id,'meta-facebookurl',true)){
                          $team .= '<a class="" href="'.$facebookurl.'" target="_blank"><i class="fab fa-facebook-f"></i></a>';
                          }
                          if(get_post_meta($post_id,'meta-twitterurl',true)){
                          $team .= '<a class="" href="'.$twitter.'" target="_blank"><i class="fab fa-twitter"></i></a>';
                          }
                          if(get_post_meta($post_id,'meta-linkdenurl',true)){ 
                          $team .= '<a class="" href="'.$linkedin.'" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
                          }
                          if(get_post_meta($post_id,'meta-googleplusurl',true)){ 
                          $team .= '<a class="" href="'.$googleplus.'" target="_blank"><i class="fab fa-google-plus-g"></i></a>';
                          }
                          $team .= '</div>
                        </div>
                      </div>
                      <div class="team-box">
                        <h4 class="team_name"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>
                        <p>'.$designation.'</p>
                        <p>'.$call.'</p>
                      </div>
                  </div>
                </div>';
          if($k%2 == 0){
              $team.= '<div class="clearfix"></div>'; 
          } 
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $team.= '</div>';
      else :
        $team = '<div id="expert" class="expert_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','vw-school-pro-posttype').'</h2></div>';
      endif;
    return $team;
}
add_shortcode( 'vw-school-pro-team', 'vw_school_pro_posttype_agent_func' );

/*events shortcode */
function vw_school_pro_events_shortcode( $atts ) {
  $events = '<div class="outer-prop">';
  $rent = '';
  $args = array(
    'post_type' => 'events'
  );
  $query = new WP_Query( $args );
  $events .= "<div class='row'>";
    if ( $query->have_posts() ){
      while ( $query->have_posts() ) : $query->the_post();
        $post_id = get_the_ID();
          if(get_post_meta($post_id,'meta-status',true) == 'Rent'){ $rent = 'prop_rent';}
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
            $location = get_post_meta($post_id,'meta-location',true);
            $date = get_post_meta($post_id,'meta-date',true);
            $time = get_post_meta($post_id,'meta-time',true);
            $url = $thumb['0'];
            $events .= '<div class="col-lg-4 col-md-4">
                          <div class="events mb-3">
                          <div class="price_div">
                            <span class="entry-date price priceshortcode pull-right">
                            '.get_the_time(get_option('date_format')).'
                            </span>
                          </div>
                          <div class="image-box"> 
                            <img src="'.$url.'" alt=""/>
                           <div class="event-title">                  
                              <h4><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>
                            </div>
                            <div class="eventpost_meta mt-2">
                              <span class="entry-date datebox"><i class="fas fa-stopwatch mr-2"></i>'.esc_html($date).'</span>
                              <span class="ml-3">'.esc_html($time).'</span>
                              <p class="mb-0 mt-2 event_location"><i class="fas fa-map-marker-alt mr-2"></i>'.esc_html($location).'</p>
                           </div>
                          </div>
                        </div>
                      </div>';
      endwhile;    
      wp_reset_postdata();
    }else{ 
      $events .='<h2 class="center">'.__('Post Not Found','vw-school-pro-posttype').'</h2>';
    }
  $events .= '</div>
  </div>';
  return $events;
}
add_shortcode( 'vw-school-pro-all-events', 'vw_school_pro_events_shortcode' );

/*--------------------------- courses shorthcode --------------------------------------*/
function vw_school_pro_posttype_courses_func( $atts, $cat_name ) {
    $courses = ''; 
    $custom_url ='';
    $cat_name = isset( $atts['cat_name'] ) ? esc_html( $atts['cat_name'] ) : '';
    $courses = '<div class="row">';
    $args = array(
      'post_type' => 'courses',
      'createpackages'=> $cat_name
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :
    $k=1;
    $new = new WP_Query('post_type=courses'); 
    while ($new->have_posts()) : $new->the_post();
      $post_id = get_the_ID();
      $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
      if(has_post_thumbnail()) { $thumb_url = $thumb['0']; }
      $excerpt = vw_school_pro_string_limit_words(get_the_excerpt(),15);
      $tutor= get_post_meta($post_id,'meta-tutor',true);
      $fprice= get_post_meta($post_id,'meta-price',true);
      $seat= get_post_meta($post_id,'meta-seat',true);
      $course= get_post_meta($post_id,'meta-duration',true);
      $institution= get_post_meta($post_id,'meta-institution',true);
      $comments_count = get_comments_number( $post_id );
      $courses .= '<div class="col-lg-4">
                      <div class="post-image-shortcode">
                        <div class="price_div">
                          <span class="price pull-right">'.esc_html(get_theme_mod('vw_school_pro_school_currency',__('$','vw-school-pro'))).''.$fprice.'</span>
                        </div> 
                        <div class="">
                          <img src="'.$thumb_url.'" alt=""/>
                        </div>
                        <div class="textcontent-box">
                          <div class="textcontent">
                            <h4><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>
                            <div class="row">
                              <div class="col-6">
                                  <p>'.esc_html('By: ').$tutor.'</p>';
                             $courses .= '</div>
                              <div class="col-6">
                                <span class="entry-date">'.get_the_time(get_option('date_format')).'</span>
                              </div>
                            </div>
                            <p>'.get_the_content().'</p>
                            <a class="continue-reading" href="'.get_the_permalink().'">'.esc_html('Apply Now').'</a>
                          </div>
                          <div class="row feature-type text-center">
                            <div class="col-md-3 col-3 p-0 feature-col">
                              <p><span>'.$course.'</span>'.esc_html('Course').'</p>
                            </div>
                            <div class="col-md-3 col-3 p-0 feature-col">
                              <p><span>'.$seat.'</span>'.esc_html('Class').'</p>
                            </div>
                            <div class="col-md-6 col-6 p-0">                         
                                <p><span>'.$institution.'</span>'.esc_html('Institution').'</p>
                          </div>
                        </div>
                      </div>
                    </div>                
                  </div>';
              
      if($k%2 == 0){
          $courses.= '<div class="clearfix"></div>'; 
      } 
      $k++;         
  endwhile; 
  wp_reset_postdata();
  $courses.= '</div>';
  else :
    $courses = '<h2 class="center">'.esc_html_e('Not Found','vw-school-pro-posttype').'</h2>';
  endif;
  return $courses;
}
add_shortcode( 'vw-school-pro-all-courses', 'vw_school_pro_posttype_courses_func' );

add_action( 'vw_school_pro_posttype_plugins_loaded', 'vw_school_pro_posttype_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function academic_education_pro_posttype_load_textdomain() {
  load_plugin_textdomain( 'vw-school-pro-posttype', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}