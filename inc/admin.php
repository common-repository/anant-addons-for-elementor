<?php if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/*Admin and Theme Builder Page Main Hook */
function  anant_admin_page_init() {

  $customMenu = add_menu_page('anant-addons-for-elementor','Anant Addons','manage_options','anant_admin_menu','anant_admin_page', ANANT_URL.'assets/images/addons-icon.png',30 );

  add_submenu_page(
    'anant_admin_menu',
    __('Theme Builder'),
    __('Theme Builder'),
    'manage_options',
    'edit.php?post_type=anant-header-footer'
  );

  add_action( 'admin_print_styles-' . $customMenu, 'anant_admin_styles' );

  add_action( 'admin_init', 'anant_register_addons_settings' );
}

add_action('admin_menu','anant_admin_page_init');

function anant_admin_styles() {
  wp_enqueue_style('admin_assets',ANANT_URL.'assets/css/admin.css', array() , ANANT_VERSION);
}

function anant_registered_widgets(){
  
  $widgets = [

    "anant-hf-elements" => array(
      "widget_cat" => "Anant Header & Footer",
      "widgets" => array(
        array( 'ver' => 'lite', 'icon' => 'eicon-site-logo', 'slug' => 'Site Logo', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantSiteLogo' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-site-title', 'slug' => 'Site Title', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantSiteTitle' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-text-area', 'slug' => 'Site Tagline', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantSiteTagline' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-alert', 'slug' => 'Copyright', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantCopyright' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-site-search', 'slug' => 'Search', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantSearch' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-nav-menu', 'slug' => 'Menus', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantNavMenu' ),
        
        array( 'ver' => 'pro', 'icon' => 'eicon-mega-menu', 'slug' => 'Mega Menu', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantMegaMenu' ),
        
        array( 'ver' => 'pro', 'icon' => 'eicon-upload-circle-o', 'slug' => 'Scroll To Top', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantScrollToTop' ),
      )
    ),

    "anant-elements" => array(
      "widget_cat" => "Anant Addons",
      "widgets" => array(
        array( 'ver' => 'lite', 'icon' => 'eicon-info-box',         'slug' => 'Service ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/service/' , 'name' => 'Anant_Service' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-gallery-grid',     'slug' => 'Portfolio ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/portfolio/' , 'name' => 'Anant_Portfolio' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-gallery-masonry', 'slug' => 'Filter Gallery', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/filter-gallery/' , 'name' => 'AnantFilterGalley' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-price-table', 'slug' => 'Price Table', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/price-table/' , 'name' => 'AnantPrice' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-featured-image',   'slug' => 'Team ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/team/' , 'name' => 'Anant_Team' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-icon-box',         'slug' => 'Feature ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/feature/' , 'name' => 'Anant_Feature' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-testimonial', 'slug' => 'Testimonial ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/testimonial/' , 'name' => 'AnantTestimonial' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-person',           'slug' => 'Author', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets//author/' , 'name' => 'Anant_Author' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-post-list', 'slug' => 'Author List', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/author-list/' , 'name' => 'AnantAuthorlist' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-animated-headline','slug' => 'Dual Color Heading', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/dual-color-heading/' , 'name' => 'Anant_DualHeading' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-image-rollover', 'slug' => 'Call to Action ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/call-to-action/' , 'name' => 'AnantCalltoaction' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-download-button',  'slug' => 'Creative Button ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/creative-button/' , 'name' => 'Anant_CreativeButton' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-flip-box', 'slug' => 'Flip Box ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/flip-box/' , 'name' => 'AnantFlipbox' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-skill-bar', 'slug' => 'Progress Bar', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/progress-bar/' , 'name' => 'AnantProgressBar' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-favorite', 'slug' => 'Creative Icon ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/addons/creative-icon/' , 'name' => 'AnantCreativeIcon' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-dual-button',      'slug' => 'Dual Button ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/dual-button/' , 'name' => 'Anant_Dualbutton' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-time-line', 'slug' => 'Content Timeline', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/timeline/' , 'name' => 'AnantContentTimeline' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-table-of-contents', 'slug' => 'Business Hours', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/business-hours/' , 'name' => 'AnantBusinessHours' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-hotspot', 'slug' => 'Image Hotspot', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/image-hotspot/' , 'name' => 'AnantImageHotspot' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-price-list', 'slug' => 'Price List', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/price-list/' , 'name' => 'AnantPriceList' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-nav-menu', 'slug' => 'Price Menu', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/price-menu/' , 'name' => 'AnantPriceMenu' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-counter', 'slug' => 'Number ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/number-item/' , 'name' => 'AnantNumberItems' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-slider-full-screen', 'slug' => 'Slider ', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/slider/' , 'name' => 'AnantSlider' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-slider-3d', 'slug' => 'Service Carousel', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/service-carousel/' , 'name' => 'AnantServiceCarousel' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-testimonial-carousel', 'slug' => 'Testimonial Carousel', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/testimonial-carousel/' , 'name' => 'AnantTestimonialCarousel' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-carousel-loop', 'slug' => 'Portfolio Carousel', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/portfolio-carousel/' , 'name' => 'AnantPortfolioCarousel' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-slider-3d', 'slug' => 'Team Carousel', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/team-carousel/' , 'name' => 'AnantTeamCarousel' ),
        
        array( 'ver' => 'lite', 'icon' => 'eicon-image-before-after', 'slug' => 'Image Comparison', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/image-comparison/' , 'name' => 'AnantImageComparison' ),
    
        array( 'ver' => 'lite', 'icon' => 'eicon-form-vertical', 'slug' => 'Marquee Stripe', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/addons/marquee-stripe/' , 'name' => 'AnantMarqueeStipe' ),
    
        array( 'ver' => 'lite', 'icon' => 'fas fa-newspaper', 'slug' => 'Ads Banner', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-banner/' , 'name' => 'AnantAdsBanner' ),

      )
    ),

    "anant-blog-elements" => array(
      "widget_cat" => "Anant Blog",
      "widgets" => array(
        array( 'ver' => 'lite', 'icon' => 'eicon-posts-grid', 'slug' => 'Post Blog', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/blog-post/' , 'name' => 'AnantPostBlog' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-post-list', 'slug' => 'Post Blog List', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/blog-post-list/' , 'name' => 'AnantPostBlogList' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-post-slider', 'slug' => 'Post Blog Carousel', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/blog-carousel/' , 'name' => 'AnantBlogCarousel' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-posts-group', 'slug' => 'Featured Post Blog', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/featured-blog-post/' , 'name' => 'AnantFeaturedBlog' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-posts-masonry', 'slug' => 'Express Post Blog', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/express-blog-post/' , 'name' => 'AnantExpressBlog' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-bullet-list', 'slug' => 'Blog Category List', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/blog-post-category-list/' , 'name' => 'AnantCategoryList' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-column', 'slug' => 'Blog Single Category', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/single-category/' , 'name' => 'AnantSingleColumnCate' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-tabs', 'slug' => 'Post Category Tab', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/post-category-tab/' , 'name' => 'AnantPostCategoryTabWidget' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-posts-ticker', 'slug' => 'Post Ticker', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/post-ticker/' , 'name' => 'AnantPostTicket' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-video-playlist', 'slug' => 'Video Post', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/video-blog-post/' , 'name' => 'AnantVideoPost' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-time-line', 'slug' => 'Blog Timeline', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/blog-timeline/' , 'name' => 'AnantPostBlogTimeline' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-archive-title', 'slug' => 'Archive Title', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/addons/archive-title/' , 'name' => 'AnantArchiveTitle' ),
        
        array( 'ver' => 'lite', 'icon' => 'eicon-archive-posts', 'slug' => 'Archive Posts', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/addons/archive-post/' , 'name' => 'AnantArchivePost' ),
        
        array( 'ver' => 'lite', 'icon' => 'eicon-post-list', 'slug' => 'Archive Posts List', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/addons/archive-post-list/' , 'name' => 'AnantArchivePostList' ),
      )
    ),

    "anant-sng-blog-elements" => array(
      "widget_cat" => "Anant Single Blog",
      "widgets" => array(
        array( 'ver' => 'lite', 'icon' => 'eicon-post-title', 'slug' => 'Post Title', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantPostTitle' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-post-content', 'slug' => 'Post Description', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantPostDescription' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-featured-image', 'slug' => 'Post Featured Image', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantPostImage' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-sitemap', 'slug' => 'Post Categories', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantPostCategories' ),

        array( 'ver' => 'pro', 'icon' => 'eicon-tags', 'slug' => 'Post Tags', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantPostTags' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-post-info', 'slug' => 'Post Meta', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantPostMeta' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-post-navigation', 'slug' => 'Post Navigation', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantPostPagination' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-social-icons', 'slug' => 'Post Share Icons', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantPostShareIcons' ),
        
        array( 'ver' => 'pro', 'icon' => 'eicon-posts-justified', 'slug' => 'Related Post', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantrelatedPost' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-comments', 'slug' => 'Post Comment', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantPostComments' ),

        array( 'ver' => 'lite', 'icon' => 'eicon-person', 'slug' => 'Post Author', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/widgets/' , 'name' => 'AnantPostAuthor' ),
      )
    ),

    "anant-woo-elements" => array(
      "widget_cat" => "Anant Woocommerce",
      "widgets" => array(
        array('id' => 'woocommerce', 'ver' => 'pro' , 'icon' => 'eicon-product-images', 'slug' => 'Product Slider', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-slider/' , 'name' => 'AnantProductSlider' ),
     
        array('id' => 'woocommerce', 'ver' => 'lite' ,  'icon' => 'eicon-product-related', 'slug' => 'Product Grid', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-grid/' , 'name' => 'AnantProductGrid' ),
    
        array('id' => 'woocommerce', 'ver' => 'pro'  ,  'icon' => 'eicon-product-categories', 'slug' => 'Product Category Slider', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-category-slider/' , 'name' => 'AnantProductCategorySlider' ),
    
        array('id' => 'woocommerce', 'ver' => 'lite' ,  'icon' => 'eicon-product-add-to-cart', 'slug' => 'Product Category Grid', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-category-grid/' , 'name' => 'AnantProductCategoryGrid' ),
    
        array('id' => 'woocommerce', 'ver' => 'lite' ,  'icon' => 'eicon-tabs', 'slug' => 'Product Category Tab', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-category-tab/' , 'name' => 'AnantProductCategoryTabWidget' ),
        
        array('id' => 'woocommerce', 'ver' => 'lite' ,  'icon' => 'eicon-products', 'slug' => 'Products Grid with Nav', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-grid-with-nav/' , 'name' => 'AnantProductGridWithNav' ),
    
        array('id' => 'woocommerce', 'ver' => 'lite' ,  'icon' => 'eicon-cart', 'slug' => 'Cart', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/cart/' , 'name' => 'AnantCart' ),

        array('id' => 'woocommerce', 'ver' => 'lite' ,  'icon' => 'eicon-woo-cart', 'slug' => 'Cart Page', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/cart-page/' , 'name' => 'AnantCartPage' ),
        
        array('id' => 'woocommerce', 'ver' => 'lite' ,  'icon' => 'eicon-form-horizontal', 'slug' => 'Checkout Page', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/checkout-page/' , 'name' => 'AnantCheckoutPage' ),
        
        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-welcome', 'slug' => 'Wishlist Page', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/addons/wishlist-page/' , 'name' => 'AnantWishlistPage' ),

        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-favorite', 'slug' => 'Mini Wishlist', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/addons/wishlist/' , 'name' => 'AnantWishlistCount' ),

        array('id' => 'woocommerce', 'ver' => 'lite' ,  'icon' => 'eicon-my-account', 'slug' => 'Account Page', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/account-page/' , 'name' => 'AnantAccountPage' ),
    
        array('id' => 'woocommerce', 'ver' => 'lite' ,  'icon' => 'eicon-search-results', 'slug' => 'Woo Search', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/woo-search/' , 'name' => 'AnantWooSearch' ),
    
        array('id' => 'woocommerce', 'ver' => 'lite' ,  'icon' => 'eicon-countdown', 'slug' => 'Time Counter', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/addons/time-counter/' , 'name' => 'AnantTimeCounter' ),
       
      )
    ),

    "anant-sng-woo-elements" => array(
      "widget_cat" => "Anant Single Product",
      "widgets" => array(
        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-product-title', 'slug' => 'Product Title', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-title/' , 'name' => 'AnantProductTitle' ),

        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-product-description', 'slug' => 'Product Description', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-description/' , 'name' => 'AnantProductDescription' ),

        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-product-categories', 'slug' => 'Product Categories', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-categories/' , 'name' => 'AnantProductCategories' ),

        array('id' => 'woocommerce', 'ver' => 'pro', 'icon' => 'eicon-meta-data', 'slug' => 'Product Tags', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-tags/' , 'name' => 'AnantProductTags' ),

        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-product-images', 'slug' => 'Product Image', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-image/' , 'name' => 'AnantProductImage' ),

        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-purchase-summary', 'slug' => 'Product Sku', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-sku/' , 'name' => 'AnantProductSku' ),

        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-product-stock', 'slug' => 'Product Stock', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-stock/' , 'name' => 'AnantProductStock' ),

        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-counter', 'slug' => 'Product Quantity', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-quantiy/' , 'name' => 'AnantProductQuantity' ),

        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-product-add-to-cart', 'slug' => 'Product Buttons', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-buttons/' , 'name' => 'AnantProductButtons' ),
        
        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-product-price', 'slug' => 'Product Price', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-price/' , 'name' => 'AnantProductPrice' ),

        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-product-info', 'slug' => 'Product Details', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-details/' , 'name' => 'AnantProductDetails' ),

        array('id' => 'woocommerce', 'ver' => 'lite', 'icon' => 'eicon-product-rating', 'slug' => 'Product Rating', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/product-rating/' , 'name' => 'AnantProductRating' ),

        array('id' => 'woocommerce', 'ver' => 'pro', 'icon' => 'eicon-product-related', 'slug' => 'Related Product', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/related-product/' , 'name' => 'AnantRelatedProduct' ),
        
        array('id' => 'woocommerce', 'ver' => 'lite','icon' => 'eicon-product-title', 'slug' => 'Product Archive Title', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/addons/product-archive-title/' , 'name' => 'AnantProductArchiveTitle' ),

        array('id' => 'woocommerce', 'ver' => 'lite','icon' => 'eicon-products-archive', 'slug' => 'Product Archive', 'doc' => 'https://docs.anantaddons.com/', 'demo' => 'https://anantaddons.com/addons/product-archive-title/' , 'name' => 'AnantProductArchiveGrid' ),
      )
    ),

  ];

  return $widgets;
} 

function anant_third_party_widgets(){

  $widgets = [
    array( 'ver' => 'lite',  'id' => 'contact-form-7', 'icon' => 'eicon-form-horizontal', 'slug' => 'Contact Form 7', 'doc' => 'https://docs.anantaddons.com/', 'demo' => '/demo' , 'name' => 'AnantContactForm7' ),

    array( 'ver' => 'lite',  'id' => 'everest-forms', 'icon' => 'eicon-form-horizontal', 'slug' => 'Everest Form', 'doc' => 'https://docs.anantaddons.com/', 'demo' => '/demo' , 'name' => 'AnantEverestForms' ),

    array('ver' => 'lite', 'id' => 'ninja-forms', 'icon' => 'eicon-form-horizontal', 'slug' => 'Ninja Forms', 'doc' => 'https://docs.anantaddons.com/', 'demo' => '/demo' , 'name' => 'AnantNinjaForms' ),
  ];
  
  return $widgets;
  
}

function anant_register_addons_settings() { 
  foreach (anant_registered_widgets() as $widgets) {
    foreach ($widgets['widgets'] as $widget_setting) { 
      $widget_id = explode(" ",$widget_setting['slug']);
      $widget_id = implode("-anant-",$widget_id);
      register_setting( 'anant_elements_settings', $widget_id, [ 'default' => true ] );
    }
  }

  foreach (anant_third_party_widgets() as $widget_setting) {
    $widget_id = explode(" ",$widget_setting['slug']);
    $widget_id = implode("-anant-",$widget_id);
    register_setting( 'anant-3rd-elements-settings', $widget_id, [ 'default' => true ] );
  }

  register_setting( 'anant_elements_settings', 'anant_tab_settings' );
  register_setting( 'anant_elements_settings', 'wishlist_template_select' );
  register_setting( 'anant-3rd-elements-settings', 'anant_tab2_settings' );
}

function anant_admin_page() {    
  $All_Widgets = anant_registered_widgets();
  $Third_party_widgets = anant_third_party_widgets(); ?>
  <div class="anant-amin-wrapper">
    <div class="anant-admin-tabs-area"> 
      <nav id="anant_admin_tabs" class="anant-admin-tabs">
          <li class=" active" data-tab="tab1"><a ><i class="fas fa-home"></i><?php esc_html_e('Dashboard', 'anant-addons-for-elementor' ); ?></a></li>
          <li data-tab="tab2"><a ><i class="fas fa-box"></i><?php esc_html_e('Widgets', 'anant-addons-for-elementor' ); ?></a></li>
          <li data-tab="tab3"><a ><i class="fab fa-dropbox"></i><?php echo esc_html('3rd Party Widgets');?></a></li><span class="glider"></span>
          <li data-tab="tab4"><a><i class="fas fa-crown"></i><?php esc_html_e('Get Pro', 'anant-addons-for-elementor' ); ?></a></li><span class="glider"></span>
      </nav>
      <div id="tab-contents"> 
          <!-- anant-admin-tab-content -->
          <div id="tab1" class="anant-admin-tab-content active">
              <div class="anant-admin-grid-card">
                <div class="anant-admin-grid one">
                    <!-- anant-admin-widget -->
                    <div class="anant-admin-card bg-image" data-item="pro" style="background-image: url('<?php echo esc_url(ANANT_URL .'assets/images/background-image.png'); ?>')">
                      <div class="anant-admin-card-tittle-area">
                          <h3 class="tittle tag"><?php esc_html_e('Create professional websites without coding skills! Try WordPress templates with Elementor today. Collaborate remotely with full site import & cloud features.', 'anant-addons-for-elementor' ); ?></h3>
                      </div>
                      <ul class="anant-admin-card-list-area">
                        <li><?php esc_html_e("No Coading Required", 'anant-addons-for-elementor' ); ?></li>
                        <li><?php esc_html_e("Incredible, Ready Website Templates", 'anant-addons-for-elementor' ); ?></li>
                        <li><?php esc_html_e(" One-Click Full Site Import", 'anant-addons-for-elementor' ); ?></li>
                      </ul>
                    </div>
                    <!-- /anant-admin-widget -->
                </div>
                <div class="anant-admin-grid two">
                  <!-- anant-admin-widget -->
                  <div class="anant-admin-card">
                    <div class="anant-admin-wid-icon-area anant-admin-f-center">
                      <i class="fab fa-facebook"></i>
                    </div>
                    <div class="anant-admin-card-body">
                      <h3 class=""><?php esc_html_e('Join Our Facebook Group', 'anant-addons-for-elementor' ); ?></h3>
                      <p><?php esc_html_e('To get help or ask questions related to Anant Addons, joining the Facebook group would be a great idea.', 'anant-addons-for-elementor' ); ?></p>
                      <button class="anant-admin-card-button" ><a href="<?php echo esc_url('https://www.facebook.com/groups/991579552543741', 'anant-addons-for-elementor' )?>"><?php esc_html_e('Read More', 'anant-addons-for-elementor' ); ?></a></button>
                    </div>
                  </div>
                  <!-- /anant-admin-widget -->
                  <!-- anant-admin-widget -->
                  <div class="anant-admin-card">
                    <div class="anant-admin-wid-icon-area anant-admin-f-center">
                      <i class="fab fa-youtube"></i>
                    </div>
                    <div class="anant-admin-card-body">
                      <h3 class=""><?php esc_html_e('Subscribe to Our YouTube Channel', 'anant-addons-for-elementor' ); ?></h3>
                      <p><?php esc_html_e("If you're interested in staying up-to-date with the latest addons, subscribing to our YouTube channel is a great way to do it.", 'anant-addons-for-elementor' ); ?></p>
                      <button class="anant-admin-card-button" ><a href="<?php echo esc_url('https://www.youtube.com/@anantaddons')?>"><?php esc_html_e('Subscribe', 'anant-addons-for-elementor' ); ?></a></button>
                    </div>
                  </div>
                  <!-- /anant-admin-widget -->
                </div>
                <div class="anant-admin-grid three">
                  <!-- anant-admin-widget -->
                  <div class="anant-admin-card ser" data-item="pro">
                    <div class="anant-admin-wid-icon-area anant-admin-f-center">
                      <i class="far fa-file-alt"></i>
                    </div>
                    <div class="anant-admin-card-body">
                      <h5><?php esc_html_e('Documentation', 'anant-addons-for-elementor' ); ?></h5>
                      <p><?php esc_html_e("It's user-friendly and provides clear instructions, screenshots, and troubleshooting tips", 'anant-addons-for-elementor' ); ?></p>
                    </div>
                  </div>
                  <!-- /anant-admin-widget -->
                </div>
                <div class="anant-admin-grid three">
                  <!-- anant-admin-widget -->
                  <div class="anant-admin-card ser" data-item="pro">
                    <div class="anant-admin-wid-icon-area anant-admin-f-center">
                      <i class="fas fa-headset"></i>
                    </div>
                    <div class="anant-admin-card-body">
                      <h5><?php esc_html_e('Need Help?', 'anant-addons-for-elementor' ); ?></h5>
                      <p><?php esc_html_e("Need help with Anant Addons? We've got you covered! Contact us via live chat or support ticket", 'anant-addons-for-elementor' ); ?></p>
                    </div>
                  </div>
                  <!-- /anant-admin-widget -->

                </div>
              </div> 
          </div>
          <!-- /anant-admin-tab-content -->  
          <!-- anant-admin-tab-content -->
          <div id="tab2" class="anant-admin-tab-content">
            <form method="post" action="options.php">
              <!-- anant-admin-grid-3 -->
                <?php // Settings
                settings_fields( 'anant_elements_settings' );
                do_settings_sections( 'anant_elements_settings' );
                $All_in_one_toggle = sanitize_text_field(get_option('anant_tab_settings', 'on'));
                $All_in_one_toggle1 = sanitize_text_field(get_option('anant_tab_settings')); ?>
                <div class="anant-admin-filter-nav">
                    <div class="navigation__inner">
                        <button class="btn pri" data-filter="all"><?php esc_html_e('All', 'anant-addons-for-elementor' ); ?></button>
                        <button class="btn success free" data-filter="free"><?php esc_html_e('Free', 'anant-addons-for-elementor' ); ?></button>
                        <button class="btn pro" data-filter="pro"><?php esc_html_e('Pro', 'anant-addons-for-elementor' ); ?></button>
                    </div>
                    <div class="search-wrapper">
                      <div class="search-bar">
                        <input type="text" class="search" placeholder="Search..">
                        <a href="#"><i class="fas fa-search"></i></a>
                      </div>
                      <fieldset class="slide-btn">
                        <input type="radio" id="radio-1" name="anant_tab_settings" <?php echo esc_attr( $All_in_one_toggle == 'on' ? 'checked="checked"' : checked( '0', get_option( 'anant_tab_settings' ) ) ); ?> value="0">
                        <label class="tab active" for="radio-1"><?php esc_html_e('Activate All', 'anant-addons-for-elementor' ); ?></label>
                        <input type="radio" id="radio-2" name="anant_tab_settings" <?php checked( '1', get_option( 'anant_tab_settings' ) ); ?> value="1">
                        <label class="tab" for="radio-2"><?php esc_html_e('Deactivate All', 'anant-addons-for-elementor' ); ?></label>
                        <span class="glider"></span>
                      </fieldset>
                    </div>
                </div> <?php 
                foreach($All_Widgets as $cats){

                  if( $cats['widget_cat'] !== 'Anant Woocommerce' && ($cats['widget_cat'] !== 'Anant Single Product') ){ ?>
                    <div class="heading">
                      <h3 class="tittle"><?php echo $cats['widget_cat'] ?> </h3>
                    </div>
                  <?php }else{
                    if ( class_exists( 'woocommerce' ) ) { ?>
                      <div class="heading">
                        <h3 class="tittle"><?php echo $cats['widget_cat'] ?> </h3>
                      </div>
                    <?php }else{ ?>
                      <div class="heading">
                        <h3 class="tittle"><?php echo $cats['widget_cat'] ?> </h3>
                        <p class="anant-install-activate-woocommerce">
                          <span class="dashicons dashicons-info-outline"></span> 
                          <?php echo esc_html('Install and activate WooCommerce to use these widgets'); ?>
                        </p>
                      </div>
                    <?php } 
                  }  ?>

                  <div class="anant-admin-grid-3 mb-2">
                    <?php foreach ($cats['widgets'] as $widget) { 
                      
                      if($widget['ver'] == 'lite') {

                        $widget_id = explode(" ",$widget['slug']);
                        $widget_id = sanitize_text_field(implode("-anant-",$widget_id)); 
                        
                        if( $cats['widget_cat'] !== 'Anant Woocommerce'  && ($cats['widget_cat'] !== 'Anant Single Product') ){ ?>
                          <!-- anant-admin-widget -->
                            <div class="anant-admin-widget free" data-item="free">
                              <div class="anant-admin-wid-tittle-area anant-admin-f-center">
                                  <div class="anant-admin-wid-title-icon anant-admin-f-center">
                                    <i class="<?php echo esc_attr( $widget['icon']); ?>"></i>
                                  </div>
                                  <h5 class="tittle"><a href="<?php echo esc_url( $widget['demo']); ?>" target="_blank"><?php echo esc_html($widget['slug']); ?></a></h5>
                              </div>
                              <div class="anant-admin-wid-btn-area anant-admin-f-center">
                                  <a href="<?php echo esc_url($widget['doc']); ?>" target="_blank" class="doc"><i class="far fa-file-alt"></i></a>
                                  <a href="<?php echo esc_url($widget['demo']); ?>" target="_blank" class="edit"><i class="fas fa-external-link-alt"></i></a> 
                                  <div class="form-input">
                                    <input type="checkbox" name="<?php echo esc_attr($widget_id); ?>" <?php checked($widget_id, get_option($widget_id , $widget_id ) , $widget_id);?> value="<?php echo esc_attr($widget_id); ?>" class= "toggleable"  />
                                  </div>
                              </div>
                            </div>
                          <!-- /anant-admin-widget -->
                        <?php } else{ $plug_path = get_plugin_path($widget['id']); ?>
                          <?php if(!is_plugin_active($plug_path)){ ?>
                            <!-- anant-admin-widget -->
                            <div class="anant-admin-widget free"  data-item="free">
                              <div class="anant-admin-wid-tittle-area anant-admin-f-center">
                                  <div class="anant-admin-wid-title-icon anant-admin-f-center">
                                    <i class="<?php echo esc_attr( $widget['icon']); ?>"></i>
                                  </div>
                                  <h5 class="tittle"><a href="<?php echo esc_url( $widget['demo']); ?>" target="_blank"><?php echo esc_html( $widget['slug']); ?></a></h5>
                              </div>
                              <div class="anant-admin-wid-btn-area anant-admin-f-center">
                                  <a href="<?php echo esc_url( $widget['doc']); ?>" target="_blank" class="doc"><i class="far fa-file-alt"></i></a>
                                  <a href="<?php echo esc_url( $widget['demo']); ?>" target="_blank" class="edit"><i class="fas fa-external-link-alt"></i></a> 
                                  <div class="form-input">
                                    <a href="#" id="<?php echo esc_attr( $widget['id']); ?>"  class="downloder plug-btn" ><i class="fas fa-download"></i></a>
                                  </div>
                              </div>
                            </div>
                            <!-- /anant-admin-widget --> 
                          <?php } else {
                            $widget_id = explode(" ",$widget['slug']);
                            $widget_id = implode("-anant-",$widget_id); ?>
                              <!-- anant-admin-widget -->
                                <div class="anant-admin-widget free" data-item="free">
                                  <div class="anant-admin-wid-tittle-area anant-admin-f-center">
                                      <div class="anant-admin-wid-title-icon anant-admin-f-center">
                                        <i class="<?php echo esc_attr( $widget['icon']); ?>"></i>
                                      </div>
                                      <h5 class="tittle"><a href="<?php echo esc_url( $widget['demo']); ?>" target="_blank"><?php echo esc_html( $widget['slug']); ?></a></h5>
                                  </div>
                                  <div class="anant-admin-wid-btn-area anant-admin-f-center">
                                      <a href="<?php echo esc_url( $widget['doc']); ?>" target="_blank" class="doc"><i class="far fa-file-alt"></i></a>
                                      <a href="<?php echo esc_url( $widget['demo']); ?>" target="_blank" class="edit"><i class="fas fa-external-link-alt"></i></a> 
                                      <div class="form-input">
                                        <input type="checkbox" name="<?php echo esc_attr($widget_id); ?>" <?php checked($widget_id, get_option($widget_id , $widget_id ) , $widget_id);?> value="<?php echo esc_attr($widget_id); ?>" class= "toggleable" />
                                      </div>
                                  </div>
                              </div>
                              <!-- /anant-admin-widget -->

                          <?php } 

                        }
                      } else { ?>
                        
                        <!-- anant-admin-widget -->
                        <div class="anant-admin-widget pro" data-item="pro">
                            <div class="anant-admin-wid-tittle-area anant-admin-f-center">
                                <div class="anant-admin-wid-title-icon anant-admin-f-center">
                                  <i class="<?php echo esc_attr( $widget['icon']); ?>"></i>
                                </div>
                                <h5 class="tittle"><a href="<?php echo esc_url( $widget['demo']); ?>" target="_blank"><?php echo esc_html( $widget['slug']); ?></a></h5>
                            </div>
                            <div class="anant-admin-wid-btn-area anant-admin-f-center">
                                <a href="<?php echo esc_url( $widget['doc']); ?>" target="_blank" class="doc"><i class="far fa-file-alt"></i></a>
                                <a href="<?php echo esc_url( $widget['demo']); ?>" target="_blank" class="edit"><i class="fas fa-external-link-alt"></i></a> 
                                <div class="form-input">
                                  <input type="checkbox" class="rea">
                                  <a href="https://anantaddons.com/" class="overlay" target="_blank"></a>
                                </div>
                            </div>
                        </div>
                        <!-- /anant-admin-widget -->

                      <?php } 
                    } ?>
                                              
                  </div>  

                  <?php if( $cats['widget_cat'] == 'Anant Woocommerce' ){ ?>
      
                    <div class="ant-wishlist-temp-select-main"> 
                      <div class="ant-wishlist-temp-select-label">
                          <label><strong><?php esc_html_e('Select Wishlist Template', 'anant-addons-for-elementor'); ?></strong></label>
                      </div>
                      <div class="ant-wishlist-temp-select-wrapper">
                        <select name="wishlist_template_select" data-placeholder="Select Template" class="ant-wishlist-temp-select">
                          <option></option>
                          <?php // Get all posts, pages, and custom post types
                              $args = array(
                                  'post_type'      => array('post', 'page'), // You can add custom post types here
                                  'posts_per_page' => -1, // Get all posts
                                  'orderby'        => 'title',
                                  'order'          => 'ASC',
                              );
                              $all_posts = get_posts($args);

                              // Get saved option
                              $saved_value = get_option('wishlist_template_select');

                              // Loop through the posts and pages
                              foreach ($all_posts as $post) {
                                  $selected = ($saved_value == $post->ID) ? 'selected="selected"' : '';
                                  echo '<option value="' . esc_attr($post->ID) . '" ' . $selected . '>' . esc_html($post->post_title) . '</option>';
                              }
                          ?>
                        </select>
                      </div>
                    </div>
                    
                  <?php } ?>
                <?php } ?>

              <?php submit_button(esc_html( 'Save Settings', 'anant-addons-for-elementor' ), 'submit pri', 'save-set1', true); ?>
            </form>
          </div>
          <!-- /anant-admin-tab-content -->
          <!-- anant-admin-tab-content -->
          <div id="tab3" class="anant-admin-tab-content">
            <form method="post" action="options.php">
              <?php // Settings
                settings_fields( 'anant-3rd-elements-settings' );
                do_settings_sections( 'anant-3rd-elements-settings' ); 
                $All_in_one_toggle2 = get_option('anant_tab2_settings', 'on');
                $All_in_one_toggle3 = get_option('anant_tab2_settings'); ?>
                <div class="anant-admin-filter-nav">
                  <div class="search-wrapper">
                    <div class="search-bar">
                      <input type="text" class="search" placeholder="Search..">
                      <a href="#"><i class="fas fa-search"></i></a>
                    </div>
                    <div class="slide-btn">
                      <input type="radio" id="radio-3" name="anant_tab2_settings" <?php $All_in_one_toggle2 == 'on' ? esc_attr_e('checked="checked"') : checked( '0', get_option( 'anant_tab2_settings' ) ); ?> value="0" />
                      <label class="tab" for="radio-3"><?php echo esc_html('Activate All'); ?></label>
                      <input type="radio" id="radio-4" name="anant_tab2_settings" <?php checked( '1', get_option( 'anant_tab2_settings' ) ); ?> value="1" />
                      <label class="tab" for="radio-4"><?php echo esc_html('Deactivate All'); ?></label>
                      <span class="glider"></span>
                    </div>   
                  </div>
                </div>
              
              <div class="anant-admin-grid-3 mb-2">
                <?php foreach ($Third_party_widgets as $widget) { $plug_path = get_plugin_path($widget['id']);
              
                  if(!is_plugin_active($plug_path)){ ?>
                    <!-- anant-admin-widget -->
                    <div class="anant-admin-widget free"  data-item="free">
                      <div class="anant-admin-wid-tittle-area anant-admin-f-center">
                          <div class="anant-admin-wid-title-icon anant-admin-f-center">
                            <i class="<?php echo esc_attr( $widget['icon']); ?>"></i>
                          </div>
                          <h5 class="tittle"><a href="<?php echo esc_attr( $widget['demo']); ?>" target="_blank"><?php echo esc_html( $widget['slug']); ?></a></h5>
                      </div>
                      <div class="anant-admin-wid-btn-area anant-admin-f-center">
                          <a href="<?php echo esc_url( $widget['doc']); ?>" target="_blank" class="doc"><i class="far fa-file-alt"></i></a>
                          <a href="<?php echo esc_url( $widget['demo']); ?>" target="_blank" class="edit"><i class="fas fa-external-link-alt"></i></a> 
                          <div class="form-input">
                            <a href="#" id="<?php echo esc_attr( $widget['id']); ?>"  class="downloder plug-btn" ><i class="fas fa-download"></i></a>
                          </div>
                      </div>
                    </div>
                    <!-- /anant-admin-widget --> 
                  <?php } else {
                    $widget_id = explode(" ",$widget['name']);
                    $widget_id = implode("-anant-",$widget_id); ?>
                        <!-- anant-admin-widget -->
                        <div class="anant-admin-widget free" data-item="free">
                          <div class="anant-admin-wid-tittle-area anant-admin-f-center">
                              <div class="anant-admin-wid-title-icon anant-admin-f-center">
                                <i class="<?php echo esc_attr( $widget['icon']); ?>"></i>
                              </div>
                              <h5 class="tittle"><a href="<?php echo esc_url( $widget['demo']); ?>" target="_blank"><?php echo esc_html($widget['slug']); ?></a></h5>
                          </div>
                          <div class="anant-admin-wid-btn-area anant-admin-f-center">
                              <a href="<?php echo esc_url($widget['doc']); ?>" target="_blank" class="doc"><i class="far fa-file-alt"></i></a>
                              <a href="<?php echo esc_url($widget['demo']); ?>" target="_blank" class="edit"><i class="fas fa-external-link-alt"></i></a> 
                              <div class="form-input">
                                <input type="checkbox" name="<?php echo esc_attr($widget_id); ?>" <?php checked($widget_id, get_option($widget_id , $widget_id ) , $widget_id);?> value="<?php echo esc_attr($widget_id); ?>" class= "toggleable" />
                              </div>
                          </div>
                      </div>
                      <!-- /anant-admin-widget -->

                  <?php }
                  
                } ?>        
              </div> 
              
              <?php submit_button(__( 'Save Settings', 'anant-addons-for-elementor' ), 'submit pri', 'save-set2', true); ?>
            </form>
          </div>
          <!-- /anant-admin-tab-content -->
          <!-- anant-admin-tab-content -->
          <div id="tab4" class="anant-admin-tab-content">
            <div class="anant-admin-tb-heading">
              <h3 class="tittle"><?php esc_html_e('WHY GO WITH PRO?', 'anant-addons-for-elementor' ); ?></h3>
              <span><?php esc_html_e('Just Compare With Anant Addons Lite Vs Pro', 'anant-addons-for-elementor' ); ?></span>
            </div>
            <div class="anant-admin-table">
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle pri">
                    <div class="header">
                        <h4><?php esc_html_e('Features', 'anant-addons-for-elementor' ); ?></h4> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <h5><?php esc_html_e('Free', 'anant-addons-for-elementor' ); ?></h5>
                      </div>
                      <div class="checkable">
                        <h5 class="pro"><?php esc_html_e('Pro', 'anant-addons-for-elementor' ); ?></h5>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class="anant-admin-tb-list">
                        <span><?php esc_html_e('Core Widgets', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class="anant-admin-tb-list">
                        <span><?php esc_html_e('Theme Compatibility', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class="anant-admin-tb-list">
                        <span><?php esc_html_e('Dynamic Content & Custom Fields Capabilities', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class="anant-admin-tb-list">
                        <span><?php esc_html_e('Proper Documentation', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class="anant-admin-tb-list">
                        <span><?php esc_html_e('Updates & Support', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class="anant-admin-tb-list">
                        <span><?php esc_html_e('Header & Footer Builder', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-times"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class="anant-admin-tb-list">
                        <span><?php esc_html_e('Priority Support', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-times"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class=" anant-admin-tb-list">
                        <span><?php esc_html_e('WooCommerce Widgets', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-times"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class=" anant-admin-tb-list">
                        <span><?php esc_html_e('Ready Made Pages', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class=" anant-admin-tb-list">
                        <span><?php esc_html_e('Ready Made Header & Footer', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-times"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class=" anant-admin-tb-list">
                        <span><?php esc_html_e('Elementor Extended Widgets', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class=" anant-admin-tb-list">
                        <span><?php esc_html_e('Asset Manager', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class=" anant-admin-tb-list">
                        <span><?php esc_html_e('Add Shortcodes', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-times"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class=" anant-admin-tb-list">
                        <span><?php esc_html_e('Template Library (in Editor)', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
                <!-- anant-admin-feature-table -->
                  <div class="anant-admin-tb-tittle">
                    <div class=" anant-admin-tb-list">
                        <span><?php esc_html_e('Context Menu', 'anant-addons-for-elementor' ); ?></span> 
                    </div>
                    <div class="anant-admin-tb-offer">
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                      <div class="checkable">
                        <i class="fas fa-check"></i>
                      </div>
                    </div> 
                  </div>
                <!-- /anant-admin-feature-table -->
            </div>
          </div>
          <!-- /anant-admin-tab-content -->

      </div>
    </div>   
  </div>
<?php }

add_action('admin_enqueue_scripts', 'anant_ins_plug_js', 999);

function anant_ins_plug_js() {   
  $screen = get_current_screen();
  if ( isset( $screen->base ) && $screen->base == 'toplevel_page_anant_admin_menu') {
    wp_enqueue_script( 'anant-admin-js', ANANT_URL . 'assets/js/admin.js', [ 'jquery', 'suggest'], ANANT_VERSION, true );
    wp_enqueue_script( 'ins-plug', ANANT_URL . 'assets/js/ins-plug.js', array( 'jquery' ), ANANT_VERSION, true );
    wp_localize_script( 'ins-plug', 'ins_plug_ajax_obj', array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
      'nonce'    => wp_create_nonce( 'ins_plug_nonce' ), // Generate nonce
    ) );
  }
}

function get_plugin_path($plugin_slug) {
  include_once ABSPATH . 'wp-admin/includes/plugin.php';
  $all_plugins = get_plugins();
  foreach($all_plugins as $key => $wp_plugin) {
      $folder_arr = explode("/", $key);
      $folder = $folder_arr[0];
      if($folder == $plugin_slug) {
          return (string)$key;
          break;
      }
  }
  return false;
}

function install_plugin( $plugin ) {

  if ( ! isset( $plugin ) || empty( $plugin ) ) {
       return esc_html__( 'Invalid plugin slug', 'anant-addons-for-elementor' );
  }

  include_once ABSPATH . 'wp-admin/includes/plugin.php';
  include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
  include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

  $api = plugins_api(
      'plugin_information',
      array(
          'slug'   => sanitize_key( wp_unslash( $plugin ) ),
          'fields' => array(
              'sections' => false,
          ),
      )
  );

  if ( is_wp_error( $api ) ) {
       $status['errorMessage'] = $api->get_error_message();
       return $status;
  }

  $skin     = new WP_Ajax_Upgrader_Skin();
  $upgrader = new Plugin_Upgrader( $skin );
  $result   = $upgrader->install( $api->download_link );

  if ( is_wp_error( $result ) ) {
       return $result->get_error_message();
  } elseif ( is_wp_error( $skin->result ) ) {
       return $skin->result->get_error_message();
  } elseif ( $skin->get_errors()->has_errors() ) {
       return $skin->get_error_messages();
  } elseif ( is_null( $result ) ) {
      global $wp_filesystem;

      // Pass through the error from WP_Filesystem if one was raised.
      if ( $wp_filesystem instanceof WP_Filesystem_Base && is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->has_errors() ) {
              return esc_html( $wp_filesystem->errors->get_error_message() );
      }

      return esc_html__( 'Unable to connect to the filesystem. Please confirm your credentials.', 'anant-addons-for-elementor' );
  }

  /* translators: %s plugin name. */
  return sprintf( __( 'Successfully installed "%s" plugin!', 'anant-addons-for-elementor' ), $api->name );
}

/* Plugin Install */

function anant_plugin_has_installed($plugin_slug) {
  $all_plugins = get_plugins();
  foreach ($all_plugins as $key => $wp_plugin) {
      $folder_arr = explode("/", $key);
      $folder = $folder_arr[0];
      if ($folder == $plugin_slug) {
          return true;
      }
  }
  return false;
}

add_action( 'wp_ajax_install_act_plugin', 'anant_install_plugin' );

function anant_install_plugin() {
  if ( isset($_POST) ) {
      $plugs = $_POST['plugs'];
  }
  // Activate plugin.
  if ( current_user_can( 'activate_plugin' ) ) {
    if(anant_plugin_has_installed($plugs)){
      $plug_path = get_plugin_path($plugs);
      $result = activate_plugin($plug_path);
      if (is_wp_error($result)) {
        wp_send_json_error($result->get_error_message());
      } else {
        wp_send_json_success('Plugin activate successfully.');
      }
    }else{
      $result = install_plugin($plugs);
      if (is_wp_error($result)) {
        wp_send_json_error($result->get_error_message());
      }

      $result = activate_plugin( get_plugin_path($plugs));
      if (is_wp_error($result)) {
        wp_send_json_error($result->get_error_message());
      }else {
        wp_send_json_success('Plugin install & activate successfully.');
      }
    }
  }
}