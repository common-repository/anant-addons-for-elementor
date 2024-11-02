<?php // Main Builder Class
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
class Anant_Header_Footer_Elementor {

    private static $instance = null;
	public static function instance() {
		if ( is_null( self::$instance) ){
		    self::$instance = new self();
		}
		return self::$instance;
	}

    private function __construct() {
        
        // Initialize the post type.
        add_action('init', [ $this,'anant_post_type']);
        add_action('add_meta_boxes', [ $this,'anant_header_footer_meta_box']);
        add_action('save_post', [ $this,'anant_head_foot_meta_cb_save']);
        add_action('admin_print_styles', [ $this,'anant_main_plug_styles']);
        add_action('admin_enqueue_scripts', [ $this,'anant_main_plug_enqueue_script'], 999);

        //Setup Elementor header and footer builder
        add_filter('template_include', [$this, 'show_full_page'], 9999 );
        add_action( 'get_header', [$this, 'show_header'] );
        add_action( 'get_footer', [$this, 'show_footer'] );
        add_action( 'wp_enqueue_scripts', [ $this,'anant_enqueue_scripts']);
        add_action( '_anant_full_page_', [ $this,'anant_full_page_template'], 10);
        add_action( '_anant_head_', [ $this,'anant_head_template'], 10);
        add_action( '_anant_foot_', [ $this,'anant_foot_template'], 10);
        add_action( 'wp_ajax_anant_pt_update', [ $this,'anant_pt_input']);

	}

    function anant_post_type(){
        $labels = array(
            'name'                       => esc_html__('Anant Theme Builder',  'anant-addons-for-elementor'),
            'singular_name'              => esc_html__('item', 'anant-addons-for-elementor'),
            'menu_name'                  => esc_html__('Anant Theme Builder', 'anant-addons-for-elementor'),
            'name_admin_bar'             => esc_html__('Anant Theme Builder item', 'anant-addons-for-elementor'),
            'parent_item_colon'          => esc_html__( 'Parent Item', 'anant-addons-for-elementor' ),
            'all_items'                  => esc_html__( 'All Items', 'anant-addons-for-elementor' ),
            'view_item'                  => esc_html__( 'View Item', 'anant-addons-for-elementor' ),
            'add_new_item'               => esc_html__( 'Add New Item', 'anant-addons-for-elementor' ),
            'add_new'                    => esc_html__( 'Add New', 'anant-addons-for-elementor' ),
            'edit_item'                  => esc_html__( 'Edit Template', 'anant-addons-for-elementor' ),
            'update_item'                => esc_html__( 'Update Item', 'anant-addons-for-elementor' ),
            'search_items'               => esc_html__( 'Search Item', 'anant-addons-for-elementor' ),
            'not_found'                  => esc_html__( 'Not Found', 'anant-addons-for-elementor' ),
            'not_found_in_trash'         => esc_html__( 'Not found in Trash', 'anant-addons-for-elementor' ),
        );
    
        $args = array(
            'label'               => esc_html__( 'Anant Theme Builder', 'anant-addons-for-elementor' ),
            'description'         => esc_html__( 'Anant Theme Builder', 'anant-addons-for-elementor' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'elementor', 'permalink' ),
            'hierarchical'        => false,
            'public'              => true,
            'register_meta_box_cb' => array($this, "anant_header_footer_meta_box"),
            'show_ui'             => true,
            'show_in_menu'        => false,
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => false,
            'has_archive'         => true,
            'menu_icon'           => 'dashicons-editor-kitchensink'
      
        );

        register_post_type('anant-header-footer', $args);
    }

    function anant_header_footer_meta_box() {
        add_meta_box(
            'head-foot-metabox',
            esc_html__( 'Anant Theme Builder Metabox', 'anant-addons-for-elementor' ),
            array($this, "anant_head_foot_meta_cb"),
            'anant-header-footer'
        );
    }

    function anant_head_foot_meta_cb( $post ){

        $post_types       = get_post_types();
        $post_types_unset = array(
            'attachment'          => 'attachment',
            'revision'            => 'revision',
            'nav_menu_item'       => 'nav_menu_item',
            'custom_css'          => 'custom_css',
            'customize_changeset' => 'customize_changeset',
            'oembed_cache'        => 'oembed_cache',
            'user_request'        => 'user_request',
            'wp_block'            => 'wp_block',
            'elementor_library'   => 'elementor_library',
            'elespare_builder'    => 'elespare_builder',
            'elementor-hf'        => 'elementor-hf',
            'elementor_font'      => 'elementor_font',
            'elementor_icons'     => 'elementor_icons',
            'wpforms'             => 'wpforms',
            'wpforms_log'         => 'wpforms_log',
            'acf-field-group'     => 'acf-field-group',
            'acf-field'           => 'acf-field',
            'booked_appointments' => 'booked_appointments',
            'wpcf7_contact_form'  => 'wpcf7_contact_form',
            'scheduled-action'    => 'scheduled-action',
            'shop_order'          => 'shop_order',
            'shop_order_refund'   => 'shop_order_refund',
            'shop_coupon'         => 'shop_coupon',
            'anant-header-footer'=> 'anant-header-footer',
            'anant-header-footer-pro' => 'anant-header-footer-pro', 
            'ant_mega_menu'       => 'ant_mega_menu',
            'wp_navigation'       => 'wp_navigation',
            'product_variation'   => 'product_variation',
            'shop_order_placehold'=> 'shop_order_placehold',
            'product'             => 'product',
            'wp_global_styles'    => 'wp_global_styles',
            'wp_template_part'    => 'wp_template_part',
            'wp_template'         => 'wp_template',
            'e-landing-page'      => 'e-landing-page',
        );
        $options = array_diff( $post_types, $post_types_unset );
        
        $template_type    = get_post_meta($post->ID, 'template_type', true);    
        
        $current_template = get_post_meta( $post->ID, '_display_on_template', true );
        
        $post_id      = get_post_meta( $post->ID, 'post_type_posts', true );
        
        $post_type    = get_post_meta( $post->ID, 'post_type_template', true );
        
        if(get_post_meta( $post->ID, '_display_on_template', true ) == ''){
            $current_template =  array('');
        }elseif(in_array( 'all', $current_template , true )){
            $current_template = array('','all');
        }else{

            $current_template = get_post_meta( $post->ID, '_display_on_template', true );
        } ?>
        <div class = "main_cls">
            <div class="template-type-main">
                <div class="temp-label">
                <label><strong><?php esc_html_e( 'Type of Template', 'anant-addons-for-elementor' ) ?></strong></label>
                </div>
                    <div class="template-type">
                    <select name="type_of_template" class="form-control selectpicker">
                        <option value="header" <?php selected($template_type, 'header' ); ?>><?php esc_html_e('Header', 'anant-addons-for-elementor'); ?></option>
                        <option value="footer" <?php selected($template_type, 'footer' ); ?>><?php esc_html_e('Footer', 'anant-addons-for-elementor'); ?></option>
                        <option value="body" <?php selected($template_type, 'body' ); ?>><?php esc_html_e('Full Page', 'anant-addons-for-elementor'); ?></option>
                    </select>
                    </div>
                </div>
        
            <div class="display--on">
                <div class="dis-label">
                    <label><strong><?php esc_html_e( 'Display On ', 'anant-addons-for-elementor' ) ?></strong></label>
                    <i class="bsf-target-rules-heading-help dashicons dashicons-editor-help"></i>
                </div>
                    <div class="custome-dropdown-wrapper">
                        <select name="_display_on_template[]" data-placeholder="multiple-select" class="custome-dropdown opt-display-on" multiple="multiple"  >
                                <option value="all"       <?php selected( in_array( 'all', $current_template, true ) ); ?>><?php esc_html_e( 'Entire Site', 'anant-addons-for-elementor' ) ?></option>
                                <option value="home"      <?php selected( in_array( 'home', $current_template, true ) ); ?>><?php esc_html_e( 'Home Page', 'anant-addons-for-elementor' ) ?></option>
                                <option value="singlePost"   <?php selected( in_array( 'singlePost', $current_template, true ) ); ?>><?php esc_html_e( 'Single post Page', 'anant-addons-for-elementor' ) ?></option>
                                <option value="blogArchive"   <?php selected( in_array( 'blogArchive', $current_template, true ) ); ?>><?php esc_html_e( 'Archive Page', 'anant-addons-for-elementor' ) ?></option>
                                <option value="search"    <?php selected( in_array( 'search', $current_template, true ) ); ?>><?php esc_html_e( 'Search Page', 'anant-addons-for-elementor' ) ?></option>
                                <option value="not_found" <?php selected( in_array( 'not_found', $current_template, true ) ); ?>><?php esc_html_e( '404 Page', 'anant-addons-for-elementor' ) ?></option>
                                <?php if ( class_exists( 'woocommerce' ) ) { ?> 
                                    <option value="mainShop" <?php selected( in_array( 'mainShop', $current_template, true ) ); ?>><?php esc_html_e( 'Shop Page', 'anant-addons-for-elementor' ) ?></option> 
                                    <option value="woocheckout" <?php selected( in_array( 'woocheckout', $current_template, true ) ); ?>><?php esc_html_e( 'Checkout Page', 'anant-addons-for-elementor' ) ?></option>
                                    <option value="currentProduct" <?php selected( in_array( 'currentProduct', $current_template, true ) ); ?>><?php esc_html_e( 'Single Product Page', 'anant-addons-for-elementor' ) ?></option>
                                    <option value="wooArchive" <?php selected( in_array( 'wooArchive', $current_template, true ) ); ?>><?php esc_html_e( 'Product Archive Page', 'anant-addons-for-elementor' ) ?></option><?php     
                                } ?>
                                <?php foreach($options as $option){ ?>
                                <option value="<?php echo esc_attr( $option ); ?>" <?php selected( in_array( $option, $current_template, true ) ); ?> style = " text-transform: capitalize;">
                                <?php echo esc_html( $option ); ?></option>
                            <?php } ?>
                        </select>
                    </div>
        
            </div>
            <div class="posttype_val">
                <input type="hidden" name="post_type_posts" value="<?php echo esc_attr( $post_id ); ?>">
                <input type="hidden" name="post_type_template" value="<?php echo esc_attr( $post_type ); ?>" class="post-type-template">
            </div>					
            <div class="display-on-post"></div>
        </div>
        <?php
    }

        function anant_head_foot_meta_cb_save( $post_id ){

            if ( isset( $_REQUEST['_display_on_template'] ) ) {
                $array = array_map( 'sanitize_text_field', wp_unslash( $_POST['_display_on_template'] ) );
                update_post_meta( $post_id, '_display_on_template',  $array );
            }
            
            if ( isset( $_REQUEST['type_of_template'] ) ) {
                update_post_meta( $post_id, 'template_type',  sanitize_text_field( $_POST[ 'type_of_template' ] ) );
            }
            
            if ( isset( $_REQUEST['post_type_template'] ) ) {
                update_post_meta( $post_id, 'post_type_template',  sanitize_text_field( $_POST[ 'post_type_template' ] ) );
            }
            
            if ( isset( $_REQUEST['post_type_posts'] ) ) {
                update_post_meta( $post_id, 'post_type_posts',  sanitize_text_field( $_POST[ 'post_type_posts' ] ) );
            }
            
        }
        
        function anant_main_plug_styles() {
            wp_enqueue_style( 'style',  ANANT_URL . "assets/css/meta-box.css", array(), ANANT_VERSION);
            wp_enqueue_style( 'select2-min-css', ANANT_URL . "assets/css/select2.min.css", array(), ANANT_VERSION);
        }
            
        function anant_main_plug_enqueue_script() {   
            wp_enqueue_script( 'main-js', ANANT_URL . 'assets/js/main.js',array( 'jquery', 'suggest' ), 0.1 , true );
        
            $localize = array(
                'url'   => admin_url( 'admin-ajax.php' ),
                'nonce' => wp_create_nonce( 'anant_pt_nonce' ),
                'edit'  => admin_url( 'edit.php?post_type=anant-header-footer' ),
            );
        
            wp_localize_script(
                'main-js',
                'admin',
                $localize
            );
        
            wp_enqueue_script( 'select2-min-js', ANANT_URL . 'assets/js/select2.min.js',array( 'jquery'), '4.0.13' , true);
        }

        function show_full_page($template) {
            $full_page_template_id = $this->full_page_template_id();
            if ($full_page_template_id) {
                
                get_header(); ?>
                    <div id="anant-full-page" class="anant-full-page-site">
                        <?php $full_page_template = \Elementor\Plugin::instance()->frontend->get_builder_content( $full_page_template_id, false );

                        if ( '' === $full_page_template ) { return $template; }

                        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        echo ''. $full_page_template; ?>
                    </div>     
                <?php get_footer(); 
            }else{
                return $template;
            }
        }

        function show_header() {
            $head_template_id = $this->head_template_id();
            if ( $head_template_id) {
                require plugin_dir_path( __FILE__ ) . 'templates/default/header.php';
                $template   = array();
                $template[] = 'header.php';
                remove_all_actions( 'wp_head' );
                ob_start();
                locate_template( $template, true );
                ob_get_clean();
            }
        }
            
        function show_footer() {  
            $foot_template_id = $this->foot_template_id();
            if ( $foot_template_id) {
                require plugin_dir_path( __FILE__ ) . 'templates/default/footer.php';
                $template   = array();
                $template[] = 'footer.php';
                remove_all_actions( 'wp_footer' );
                ob_start();
                locate_template( $template, true );
                ob_get_clean();
            }
        }
        
        function anant_enqueue_scripts() {

            if($this->full_page_template_id()){
        
                if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
                    $css_file = new \Elementor\Core\Files\CSS\Post( $this->full_page_template_id() );
                } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
                    $css_file = new \Elementor\Post_CSS_File( $this->full_page_template_id() );
                }
        
                $css_file->enqueue();
            }

            if($this->head_template_id()){

                if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
                    $css_file = new \Elementor\Core\Files\CSS\Post( $this->head_template_id() );
                } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
                    $css_file = new \Elementor\Post_CSS_File( $this->head_template_id() );
                }

                $css_file->enqueue();
            }
        
            if($this->foot_template_id()){
                
                if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
                    $css_file = new \Elementor\Core\Files\CSS\Post( $this->foot_template_id() );
                } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
                    $css_file = new \Elementor\Post_CSS_File( $this->foot_template_id() );
                }
        
                $css_file->enqueue();
            }
        }

        function anant_full_page_template() {
            global $post;
            
            if ( ! empty( $post ) ) {
                $id   = $post->ID;
                $post_type = get_post_type( $post->ID );
            }
        
            $path      = plugin_dir_path( __FILE__ ) . 'templates/content/full-page-content.php';
            $template_type = $this->template_type();
            
            if ( ! empty( $template_type ) ) {
                
                $full_page = $this->show_template( $template_type, 'body' );
                if ( ! $full_page ) {
                    $full_page = $this->show_all('body');
                }
            }
        
            if ( is_singular() ) {
                $full_page = $this->present_single( $id, $post_type, 'body' );
        
                if ( ! $full_page ) {
                    $full_page = $this->total_single( $id, $post_type, 'body' );
                    if ( ! $full_page ) {
                        $full_page = $this->show_all('body');
                    }
                }
            }

            if($full_page == false){
        
            }else{
                $this->generate( $full_page, $path );
            }
        }
        
        function anant_head_template() {
            global $post;
            
            if ( ! empty( $post ) ) {
                $id   = $post->ID;
                $post_type = get_post_type( $post->ID );
            }
        
            $path      = plugin_dir_path( __FILE__ ) . 'templates/content/content-header.php';
            $template_type = $this->template_type();
            
            if ( ! empty( $template_type ) ) {
                
                $header = $this->show_template( $template_type, 'header' );
                if ( ! $header ) {
                    $header = $this->show_all('header');
                }

                if($header == false){
                    return;
                }else{
                    $this->generate( $header, $path );
                }
            }
        
            if ( is_singular() ) {
                $header = $this->present_single( $id, $post_type, 'header' );
        
                if ( ! $header ) {
                    $header = $this->total_single( $id, $post_type, 'header' );
                    if ( ! $header ) {
                        $header = $this->show_all('header');
                    }
                }

                if($header == false){
                    return;
                }else{
                    $this->generate( $header, $path );
                }
            }
        }
            
        function anant_foot_template() {
            global $post;
            
            if ( ! empty( $post ) ) {
                $id        = $post->ID;
                $post_type = get_post_type( $post->ID );
            }
        
            $path      = plugin_dir_path( __FILE__ ) . 'templates/content/content-footer.php';
            $template_type = $this->template_type();
            
            if ( ! empty( $template_type ) ) {
                $footer = $this->show_template( $template_type, 'footer' );
                if ( ! $footer ) {
                    $footer = $this->show_all( 'footer' );
                }

                if($footer == false){
                    return;
                }else{
                    $this->generate( $footer, $path );
                }
            }
        
            if ( is_singular() ) {
                $footer = $this->present_single( $id, $post_type, 'footer' );
                if ( ! $footer ) {
                    $footer = $this->total_single( $id, $post_type, 'footer' );
                    if ( ! $footer ) {
                        $footer = $this->show_all( 'footer' );
                    }
                }

                if($footer == false){
                    return;
                }else{
                    $this->generate( $footer, $path );
                }
            }
        }
        
        function show_all( $type ) {    
            $args = array(
                'post_type'           => 'anant-header-footer',
                'orderby'             => 'id',
                'order'               => 'DESC',
                'posts_per_page'      => 1,
                'ignore_sticky_posts' => 1,
                'meta_query'          => array( 
                    array(
                        'key'     => 'template_type',
                        'compare' => 'LIKE',
                        'value'   => $type,
                    ),
                    array(
                        'key'     => '_display_on_template',
                        'compare' => 'LIKE',
                        'value'   => 'all',
                    ),
                ),
            );
        
            $header = new \WP_Query( $args );
        
            if ( $header->have_posts() ) {
                return $header;
            } else {
                return false;
            }
        }
        
        function show_template( $template_type, $type ) {
            if ( empty( $template_type ) ) {
                return false;
            }
            $args   = array(
                'post_type'           => 'anant-header-footer',
                'orderby'             => 'id',
                'order'               => 'DESC',
                'posts_per_page'      => 1,
                'ignore_sticky_posts' => 1,
                'meta_query'          => array( 
                    array(
                        'key'     => 'template_type',
                        'compare' => 'LIKE',
                        'value'   => $type,
                    ),
                    array(
                        'key'     => '_display_on_template',
                        'compare' => 'LIKE',
                        'value'   => $template_type,
                    ),
                ),
            );
            $header = new \WP_Query( $args );
        
            if ( $header->have_posts() ) {
                return $header;
            } else {
                return false;
            }
        }
        
        function present_single( $id, $post_type, $type ) {
            if ( ! is_singular()  ) {
                return false;
            }
        
            $args = array(
                'post_type'           => 'anant-header-footer',
                'orderby'             => 'id',
                'order'               => 'DESC',
                'posts_per_page'      => -1,
                'ignore_sticky_posts' => 1,
                'meta_query'          => array(
                    array(
                        'key'     => 'template_type',
                        'compare' => 'LIKE',
                        'value'   => $type,
                    ),
                    array(
                        'key'     => 'post_type_template',
                        'compare' => 'LIKE',
                        'value'   => $post_type,
                    ),
                ),
            );
            $header = new \WP_Query( $args );
                
            if ( $header->have_posts() ) {
                
                $list_header = $header->posts;
                $current     = array();   
        
                foreach ( $list_header as $key => $post ) {
                    
                    $list_id = get_post_meta( $post->ID, 'post_type_posts', true );
                    if ( ! empty( $list_id ) || 'all' != $list_id ) { 
                        $post_id = explode( ',', $list_id );
                        if ( in_array( $id, $post_id ) ) { 
                            $current[0] = $post;
                        }
                    }
                }
                wp_reset_postdata();
        
                if ( empty( $current ) ) {
        
                    return false;
                } else {
                    $header->posts      = $current;
                    $header->post_count = 1;
                    return $header;
                }
            } else {
                return false;
            }
        }    
            
        function total_single( $post_id, $post_type, $type) {
            if ( ! is_singular() ) {
                return false;
            }
            $args   = array(
                'post_type'           => 'anant-header-footer',
                'orderby'             => 'id',
                'order'               => 'DESC',
                'posts_per_page'      => 1,
                'ignore_sticky_posts' => 1,
                'meta_query'          => array(
                    array(
                        'key'     => 'template_type',
                        'compare' => 'LIKE',
                        'value'   => $type,
                    ),
                    array(
                        'key'     => 'post_type_template',
                        'compare' => 'LIKE',
                        'value'   => $post_type,
                    ),
                    array(
                        'key'     => 'post_type_posts',
                        'compare' => 'LIKE',
                        'value'   => 'all',
                    ),
                ),
            );
            $header = new \WP_Query( $args );
        
            if ( $header->have_posts() ) {
                return $header;
            } else {
                return false;
            }
        }       
        
        function template_type() {
            $template_type = '';

            if ( class_exists( 'woocommerce' ) ) {
                if( is_front_page() || is_home() ) {
                    $template_type = 'home';
                }elseif ( is_archive() && ! is_shop() && get_post_type() === 'post' ) {
                    $template_type = 'blogArchive';
                }elseif ( is_single() && is_singular('post') ) {
                    $template_type = 'singlePost';
                }elseif ( is_search() ) {
                    $template_type = 'search';
                }elseif ( is_404() ) {
                    $template_type = 'not_found';
                }elseif ( is_shop() ) {
                    $template_type = 'mainShop';
                }elseif ( is_archive() && get_post_type() === 'product' && ! is_shop() ) {
                    $template_type = 'wooArchive';
                }elseif ( is_product() && is_singular('product') ) {
                    $template_type = 'currentProduct';
                }elseif ( is_checkout() ) {
                    $template_type = 'woocheckout';  
                }
            }else{
                if( is_front_page() || is_home() ) {
                    $template_type = 'home';
                }elseif ( is_single() && is_singular('post') ) {
                    $template_type = 'singlePost';
                }elseif ( is_archive() && get_post_type() === 'post' ) {
                    $template_type = 'blogArchive';
                }elseif ( is_search() ) {
                    $template_type = 'search';
                }elseif ( is_404() ) {
                    $template_type = 'not_found';
                }
            }
            return $template_type;
        }
        
        function generate( $content, $path ) {
            if ( $content->have_posts() ) {
                while ( $content->have_posts() ) {
                    $content->the_post();
                    load_template( $path );
                }
                wp_reset_postdata();
            }
        }

        function elementor_maintenance_check(){
            $maintain_mode     = get_option( 'elementor_maintenance_mode_mode' );
            $maintain_template = get_option( 'elementor_maintenance_mode_template_id' );
            if ( 'coming_soon' == $maintain_mode && $maintain_template == $post_id ) {
                return false;
            }
        }

        function full_page_template_id() { 
            global $post;
            
            if ( ! empty( $post ) ) {
                $post_id   = $post->ID;
                $post_type = get_post_type( $post->ID );
            }else{
                $post_id   = NULL;
                $post_type = NULL;
            }
            $this->elementor_maintenance_check();

            $template_type = $this->template_type();
            $id        = '';
        
            if ( $this->show_all('body') || $this->show_template( $template_type , 'body' ) || $this->total_single( $post_id, $post_type, 'body' ) || $this->present_single( $post_id, $post_type, 'body' ) ) {
                
                if ( $this->show_all('body') ) {
                    $full_page = $this->show_all('body');
                }
                if ( $this->show_template( $template_type , 'body' ) ) {
                    $full_page = $this->show_template( $template_type , 'body' );
                }
                if ( $this->total_single( $post_id, $post_type, 'body' ) ) {
                    $full_page = $this->total_single( $post_id, $post_type, 'body' );
                }
                if ( $this->present_single( $post_id, $post_type, 'body' ) ) {
                    $full_page = $this->present_single( $post_id, $post_type, 'body' );
                }
        
                while ( $full_page->have_posts() ) {
                    $full_page->the_post();
                    $id = get_the_ID();
                }
                wp_reset_postdata();
                return $id;
        
            } else {
                return false;
            }
        }
        
        function head_template_id() { 
            global $post;
            
            if ( ! empty( $post ) ) {
                $post_id   = $post->ID;
                $post_type = get_post_type( $post->ID );
            }else{
                $post_id   = NULL;
                $post_type = NULL;
            }
            $this->elementor_maintenance_check();

            $template_type = $this->template_type();
            $id        = '';
        
            if ( $this->show_all('header') || $this->show_template( $template_type , 'header' ) || $this->total_single( $post_id, $post_type, 'header' ) || $this->present_single( $post_id, $post_type, 'header' ) ) {
                
                if ( $this->show_all('header') ) {
                    $header = $this->show_all('header');
                }
                if ( $this->show_template( $template_type , 'header' ) ) {
                    $header = $this->show_template( $template_type , 'header' );
                }
                if ( $this->total_single( $post_id, $post_type, 'header' ) ) {
                    $header = $this->total_single( $post_id, $post_type, 'header' );
                }
                if ( $this->present_single( $post_id, $post_type, 'header' ) ) {
                    $header = $this->present_single( $post_id, $post_type, 'header' );
                }
        
                while ( $header->have_posts() ) {
                    $header->the_post();
                    $id = get_the_ID();
                }
                wp_reset_postdata();
                return $id;
        
            } else {
                return false;
            }
        }
        
        function foot_template_id() {
            global $post;
        
            if ( ! empty( $post ) ) {
                $post_id   = $post->ID;
                $post_type = get_post_type( $post->ID );
            }else{
                $post_id   = NULL;
                $post_type = NULL;
            }
        
            $this->elementor_maintenance_check();

            $template_type = $this->template_type();
            $id        = '';
        
            if ( $this->show_all( 'footer' ) || $this->show_template( $template_type, 'footer' ) || $this->total_single( $post_id, $post_type, 'footer' ) || $this->present_single( $post_id, $post_type, 'footer' ) ) {
                
                if ( $this->show_all( 'footer' ) ) {
                    $header = $this->show_all( 'footer' );
                }
                if ( $this->show_template( $template_type, 'footer' ) ) {
                    $header = $this->show_template( $template_type, 'footer' );
                }
                if ( $this->total_single( $post_id, $post_type, 'footer' ) ) {
                    $header = $this->total_single( $post_id, $post_type, 'footer' );
                }
                if ( $this->present_single( $post_id, $post_type, 'footer' ) ) {
                    $header = $this->present_single( $post_id, $post_type, 'footer' );
                }
        
                while ( $header->have_posts() ) {
                    $header->the_post();
                    $id = get_the_ID();
                }
                wp_reset_postdata();
        
                return $id;
        
            } else {
                return false;
            }
        }

        function anant_pt_input() {

            if ( isset($_POST) ) {
                $post_type = $_POST['post_type1'];
                $post_type =  implode(",",$post_type);
            }
                
            if ( 'all' !== $post_type && 'blogArchive' !== $post_type && 'search' !== $post_type && 'home' !== $post_type && 'not_found' !== $post_type ) : ?>
        
            <input type="hidden" name="post_type_posts" value="all">
            <input type="hidden" name="post_type_template" value="<?php echo esc_attr( $post_type ); ?>" class="post-type-template">
        
            <?php endif; die();
        }          
}