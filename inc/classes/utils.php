<?php if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

function anant_placeholder_image_src() {
	$placeholder_image = ELEMENTOR_ASSETS_URL . 'images/placeholder.png';
	$placeholder_image = apply_filters( 'elementor/utils/get_placeholder_image_src', $placeholder_image );
	return $placeholder_image;
} 

function anant_get_all_authors( $demo = 0 ) {
    $args = array(
        'role__in'     => array('author', 'administrator', 'subscriber'),
        'orderby'      => 'display_name',
        'order'        => 'ASC',
        'number'       => null,
        'fields'       => 'all',
    );
    $authors = get_users( $args );
    $author_list = array();

	if($demo == 0){
		foreach ( $authors as $author ) {
			$author_list[$author->ID] = $author->display_name;
		}
	}else{
		foreach ( $authors as $author ) {
			$author_list[$author->display_name] = $author->display_name;
		}
	}

    return $author_list;
}

function anant_get_categories( $demo = 0 ) {
	$categories = get_categories([
		"hide_empty" => 0,
		"type"      => "post",
		"orderby"   => "name",
		"order"     => "ASC"
		]
	);

	$cat = [];
	if($demo == 0){
		foreach( $categories as $category ) {
			$cat[$category->term_id] = $category->name;
		}
	}else {
		foreach( $categories as $category ) {
			$cat[$category->slug] = $category->name;
		}
	}

	return $cat;
}

if (!function_exists('anant_get_post_title')) {
	function anant_get_post_title() {
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => -1,
		);

		$posts = new WP_Query($args);

		$post_list = [];

		if ($posts->have_posts()) {
			while ($posts->have_posts()) {
				$posts->the_post();
				$post_list[get_the_ID()] = get_the_title();
			}
			wp_reset_postdata();
		}

		return $post_list;
	}
}

function anant_get_tags() {
	$tags = get_tags(array(
		'hide_empty' => false
	));

	$tgs = [];

	foreach( $tags as $tag ) {
		$tgs[$tag->slug] = $tag->name;
	}

	return $tgs;
}

/**
 * Retrieve all post years
 */

function anant_get_post_years() {
    $years = [];

    $posts = get_posts([
        'posts_per_page' => -1,  // Retrieve all posts
        'post_type'      => 'post',
        'orderby'        => 'date',
        'order'          => 'ASC',
        'fields'         => 'ids',  // Retrieve only post IDs to optimize performance
    ]);

    foreach ($posts as $post_id) {
        $post_date = get_post_field('post_date', $post_id);
        $year = date('Y', strtotime($post_date));

        if (!in_array($year, $years)) {
            $years[$year] = $year;
        }
    }

    return $years;
}

/**
 * Retrieve all post months
 */
function anant_get_post_months() {
    $months = [];

    $posts = get_posts([
        'posts_per_page' => -1,
        'post_type'      => 'post',
        'orderby'        => 'date',
        'order'          => 'ASC',
        'fields'         => 'ids',
    ]);

    foreach ($posts as $post_id) {
        $post_date = get_post_field('post_date', $post_id);
        $month = date('n', strtotime($post_date));

        if (!in_array($month, $months)) {
            $months[$month] = $month;
        }
    }

    return $months;
}

/**
 * Retrieve all post days
 */
function anant_get_post_days() {
    $days = [];

    $posts = get_posts([
        'posts_per_page' => -1,
        'post_type'      => 'post',
        'orderby'        => 'date',
        'order'          => 'ASC',
        'fields'         => 'ids',
    ]);

    foreach ($posts as $post_id) {
        $post_date = get_post_field('post_date', $post_id);
        $day = date('j', strtotime($post_date));

        if (!in_array($day, $days)) {
            $days[] = $day;
        }
    }

    return $days;
}

if (!function_exists('get_all_post_types')) {
	function get_all_post_types() {
		$post_types = get_post_types(['public' => true], 'objects');

		$filtered_post_types = [];

		foreach ($post_types as $post_type => $details) {
			$filtered_post_types[$post_type] = $details->label;
		}

		return $filtered_post_types;
	}
}

if (!function_exists('array_value_check_in_string')) {
	function array_value_check_in_string($string , $array) {
		foreach ($array as $value) {
			if (strpos($string, $value) !== false) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'anant_get_attachment_alt' ) ) {
	function anant_get_attachment_alt( $attachment_id ) {
		if ( ! $attachment_id ) {
			return '';
		}

		$attachment = get_post( $attachment_id );
		if ( ! $attachment ) {
			return '';
		}

		$alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
		if ( ! $alt ) {
			$alt = $attachment->post_excerpt;
			if ( ! $alt ) {
				$alt = $attachment->post_title;
			}
		}
		return trim( wp_strip_all_tags( $alt ) );
	}
}

/** Woocommerce releated Functions */
if ( class_exists( 'woocommerce' ) ) {

	if (!function_exists('anant_get_woo_products')) {
		function anant_get_woo_products() {
			$args = array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'posts_per_page' => -1,
			);
	
			$products = new WP_Query($args);
	
			$product_list = [];
	
			if ($products->have_posts()) {
				while ($products->have_posts()) {
					$products->the_post();
					global $product;
					$product_list[get_the_ID()] = get_the_title();
				}
				wp_reset_postdata();
			}
	
			return $product_list;
		}
	} 

	if ( ! function_exists( 'anant_get_product_types' ) ) {
		function anant_get_product_types() {
			$product_types_lists = wc_get_product_types();
			return $product_types_lists;
		}
	}
	
	if ( ! function_exists( 'anant_display_product_rating' ) ) {
		function anant_display_product_rating( $average, $rating_count, $id ) {
			if ( 0 === $average ) {
				$html  = '<div class="anant-star-rating">';
				$html .= wc_get_star_rating_html( $average, $rating_count );
				$html .= '</div>';
				return $html;
			} else {
				return wc_get_rating_html( $average, $rating_count );
			}
		}
	}
	
	if ( ! function_exists( 'anant_get_product_category' ) ) {
		function anant_get_product_category($type = 0) {
			$categories = get_categories(
				[
					'hide_empty' => 0,
					'taxonomy'   => 'product_cat', // mention taxonomy here.
				]
			);
		
			$category_lists = [];
			
			if($type == 1){
				foreach ( $categories as $category ) {
					// phpcs:ignore Squiz.PHP.CommentedOutCode.Found
					// $category_lists[$category->term_id] = $category->name;
					$category_lists[ $category->term_id ] = $category->name . ' (' . $category->count . ')';
				}
			}elseif ($type == 0) {
				foreach ( $categories as $category ) {
					// phpcs:ignore Squiz.PHP.CommentedOutCode.Found
					$category_lists[ $category->name ] = $category->name . ' (' . $category->count . ')';
				}
			}
		
			if ( count( $category_lists ) > 0 ) {
				return $category_lists;
			}
		
			return false;
		}
	}

	/** Get Woocommerce Categories */
	if (!function_exists('anant_get_woo_categories')) {
		function anant_get_woo_categories ($demo = 0 ) {
			$terms = get_terms(array(
				'taxonomy' => 'product_cat',
				'hide_empty' => false,
			));
	
			$term_list = [];
			if($demo == 0){
				foreach ($terms as $term) {
					$term_list[$term->term_id] = $term->name;
				}
			}else{
				foreach ($terms as $term) {
					$term_list[$term->name] = $term->name;
				}
			}
	
			return $term_list;
		}
	}

	if (!function_exists('anant_get_product_tags')) {
		function anant_get_product_tags( $demo = 0 ) {
			$terms = get_terms(array(
				'taxonomy' => 'product_tag',
				'hide_empty' => false,
			));
			$term_array = [];
			$term_array[''] = '';
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) && $demo == 0 ) {
				foreach ( $terms as $term ) {
					$term_array[ $term->slug ] = $term->name;
				}
				return $term_array;
			} elseif( ! empty( $terms ) && ! is_wp_error( $terms ) && $demo == 1 ){
				foreach ( $terms as $term ) {
					$term_array[ $term->name ] = $term->name;
				}
				return $term_array;
			}
			return false;
		}
	}

	function anant_get_all_category() {
		$categories = get_categories(
			[
				'hide_empty' => 0,
				// phpcs:ignore Squiz.PHP.CommentedOutCode.Found
				//'exclude'  =>  1,
				'taxonomy'   => 'product_cat', // mention taxonomy here.
			]
		);
	
		if ( count( $categories ) > 0 ) {
			return $categories;
		}
	
		return false;
	}

	function get_category_details_by_name( $name ) {
		$slug       = '';
		$id         = '';
		$categories = anant_get_all_category();
		foreach ( $categories as $category ) {
			if ( $name === $category->name ) {
				$slug = $category->slug;
				$id   = $category->cat_ID;
			}
		}
	
		return [
			'slug' => $slug,
			'id'   => $id,
		];
	}

	function woocommerceCategorySlug( $id ){
		$term = get_term_by('id', $id, 'product_cat', 'ARRAY_A');
		return $term['slug'];
	}

}

function in_multi_array($needle, $haystack) {
    foreach ($haystack as $item) {
        if (is_array($item) || is_object($item)) {
            if (in_multi_array($needle, $item)) {
                return true;
            }
        } else {
			// print_r($item);
            if ($item === $needle) {
                return true;
            }
        }
    }
    return false;
}