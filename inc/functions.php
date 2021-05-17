<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * @Packge     : Seogo Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author     URI : http://colorlib.com/wp/
 *
 */


/*===========================================================
	Get elementor templates
============================================================*/
function get_elementor_templates() {
	$options = [];
	$args = [
		'post_type' => 'elementor_library',
		'posts_per_page' => -1,
	];

	$page_templates = get_posts($args);

	if (!empty($page_templates) && !is_wp_error($page_templates)) {
		foreach ($page_templates as $post) {
			$options[$post->ID] = $post->post_title;
		}
	}
	return $options;
}

// Section Heading
function seogo_section_heading( $title = '', $subtitle = '' ) {
	if( $title || $subtitle ) :
	?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-heading text-center">
						<?php
						// Sub title
						if ( $subtitle ) {
							echo '<p>' . esc_html( $subtitle ) . '</p>';
						}
						// Title
						if ( $title ) {
							echo '<h2>' . esc_html( $title ) . '</h2>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	endif;
}

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'seogo_companion_frontend_scripts', 99 );
function seogo_companion_frontend_scripts() {

	wp_enqueue_script( 'seogo-companion-script', plugins_url( '../js/loadmore-ajax.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'seogo-common-js', plugins_url( '../js/common.js', __FILE__ ), array( 'jquery' ), '1.0', true );

}
// 
add_action( 'wp_ajax_seogo_portfolio_ajax', 'seogo_portfolio_ajax' );

add_action( 'wp_ajax_nopriv_seogo_portfolio_ajax', 'seogo_portfolio_ajax' );
function seogo_portfolio_ajax( ){

	ob_start();

	if( !empty( $_POST['elsettings'] ) ):


		$items = array_slice( $_POST['elsettings'], $_POST['postNumber'] );

	    $i = 0;
	    foreach( $items as $val ):

	    $tagclass = sanitize_title_with_dashes( $val['label'] );
	    $i++;
	?>
	<div class="single_gallery_item <?php echo esc_attr( $tagclass ); ?>">
	    <?php 
	    if( !empty( $val['img']['url'] ) ){
	        echo '<img src="'.esc_url( $val['img']['url'] ).'" />';
	    }
	    ?>
	    <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
	        <div class="port-hover-text text-center">
	            <?php 
	            if( !empty( $val['title'] ) ){
	                echo seogo_heading_tag(
	                    array(
	                        'tag'  => 'h4',
	                        'text' => esc_html( $val['title'] )
	                    )
	                );
	            }

	            if( !empty( $val['sub-title-url'] ) &&  !empty( $val['sub-title'] ) ){
	                echo '<a href="'.esc_url( $val['sub-title-url'] ).'">'.esc_html( $val['sub-title'] ).'</a>';
	            }else{
	                echo '<p>'.esc_html( $val['sub-title'] ).'</p>';
	            }
	            ?>
	            
	        </div>
	    </div>
	</div>

	<?php 

	if( !empty( $_POST['postIncrNumber'] ) ){

	    if( $i == $_POST['postIncrNumber'] ){
	        break;
	    }
	}
	    endforeach;
	endif;
	echo ob_get_clean();
	die();
}

	// Update the post/page by your arguments
	function seogo_update_the_followed_post_page_status( $title = 'Hello world!', $type = 'post', $status = 'draft', $message = false ){

		// Get the post/page by title
		$target_post_id = get_page_by_title( $title, OBJECT, $type);

		// Post/page arguments
		$target_post = array(
			'ID'    => $target_post_id->ID,
			'post_status'   => $type,
		);

		if ( $message == true ) {
			// Update the post/page
			$update_status = wp_update_post( $target_post, true );
		} else {
			// Update the post/page
			$update_status = wp_update_post( $target_post, false );
		}

		return $update_status;
	}


	
// Cases - Custom Post Type
function seogo_custom_posts() {	
	$labels = array(
		'name'               => _x( 'Cases', 'post type general name', 'seogo-companion' ),
		'singular_name'      => _x( 'Case', 'post type singular name', 'seogo-companion' ),
		'menu_name'          => _x( 'Cases', 'admin menu', 'seogo-companion' ),
		'name_admin_bar'     => _x( 'Case', 'add new on admin bar', 'seogo-companion' ),
		'add_new'            => _x( 'Add New', 'case', 'seogo-companion' ),
		'add_new_item'       => __( 'Add New Case', 'seogo-companion' ),
		'new_item'           => __( 'New Case', 'seogo-companion' ),
		'edit_item'          => __( 'Edit Case', 'seogo-companion' ),
		'view_item'          => __( 'View Case', 'seogo-companion' ),
		'all_items'          => __( 'All Cases', 'seogo-companion' ),
		'search_items'       => __( 'Search Cases', 'seogo-companion' ),
		'parent_item_colon'  => __( 'Parent Cases:', 'seogo-companion' ),
		'not_found'          => __( 'No cases found.', 'seogo-companion' ),
		'not_found_in_trash' => __( 'No cases found in Trash.', 'seogo-companion' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'seogo-companion' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'cases' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'case', $args );

	// case-cat - Custom taxonomy
	$labels = array(
		'name'              => _x( 'Case Category', 'taxonomy general name', 'seogo-companion' ),
		'singular_name'     => _x( 'Case Categories', 'taxonomy singular name', 'seogo-companion' ),
		'search_items'      => __( 'Search Case Categories', 'seogo-companion' ),
		'all_items'         => __( 'All Cases Categories', 'seogo-companion' ),
		'parent_item'       => __( 'Parent Case Category', 'seogo-companion' ),
		'parent_item_colon' => __( 'Parent Case Category:', 'seogo-companion' ),
		'edit_item'         => __( 'Edit Case Category', 'seogo-companion' ),
		'update_item'       => __( 'Update Case Category', 'seogo-companion' ),
		'add_new_item'      => __( 'Add New Case Category', 'seogo-companion' ),
		'new_item_name'     => __( 'New Case Category Name', 'seogo-companion' ),
		'menu_name'         => __( 'Case Category', 'seogo-companion' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'case-category' ),
	);

	register_taxonomy( 'case-cat', array( 'case' ), $args );

}
add_action( 'init', 'seogo_custom_posts' );



/*=========================================================
    Cases Section
========================================================*/
function seogo_case_section( $post_order ){ 
	$cases = new WP_Query( array(
		'post_type' => 'case',
		'order' => $post_order,

	) );
	
	if( $cases->have_posts() ) {
		while ( $cases->have_posts() ) {
			$cases->the_post();			
			$case_cat = get_the_terms(get_the_ID(), 'case-cat');
			$case_img      = get_the_post_thumbnail( get_the_ID(), 'seogo_case_study_thumb_362x240', '', array( 'alt' => get_the_title() ) );
			?>
			<div class="single_case">
				<?php 
					if ( $case_img ) {
						echo '
							<div class="case_thumb">
								'.$case_img.'
							</div>
						';
					}
				?>
				<div class="case_heading">
					<span><?php echo $case_cat[0]->name?></span>
					<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
				</div>
			</div>
			<?php
		}
	}
}

// Related cases for Single Page
function seogo_related_cases( $current_post_id = null ){
	$related_cases = new WP_Query( array(
        'post_type' => 'case',
		'post__not_in' => array( $current_post_id ),
        // 'posts_per_page'    => $pnumber,
    ) );
	?>
	<!-- case_study_area  -->
	<div class="case_study_area case_page">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="section_title mb-40">
						<h3><?php _e('Related Cases', 'seogo-companion')?></h3>
					</div>
				</div>
			</div>
			<div class="row">
				<?php
				if( $related_cases->have_posts() ) {
					while ( $related_cases->have_posts() ) {
						$related_cases->the_post();			
						$case_cat = get_the_terms(get_the_ID(), 'case-cat');
						$case_img = get_the_post_thumbnail( get_the_ID(), 'seogo_case_study_thumb_362x240', '', array( 'alt' => get_the_title() ) );
						?>
						<div class="col-xl-4 col-md-6 col-lg-4">
							<div class="single_case">
								<?php 
									if ( $case_img ) {
										echo '
											<div class="case_thumb">
												'.$case_img.'
											</div>
										';
									}
								?>
								<div class="case_heading">
									<span><?php echo $case_cat[0]->name?></span>
									<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
								</div>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
	<?php
}