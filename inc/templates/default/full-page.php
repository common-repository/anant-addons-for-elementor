<?php
/**
 * Full Page 
 *
 * Handle Full Page.
 *
 * @package Anant_Full_Page_Template
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

get_header(); ?>
	<div id="anant-full-page" class="anant-full-page-site">
		<?php do_action( '_anant_full_page_' ); ?>
	</div>     
<?php get_footer(); ?>
