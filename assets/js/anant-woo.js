/**
  * Woocommerce product quickview js
 **/
  var ProductFeatureQuickView = function( $scope, $ ){ 
    const wId = $scope.data("id");
	const wrapper = document.querySelector(`.elementor-element-${wId}`);
	const outerWrapper = wrapper.querySelector(".anant-outer-wrapper");
    const SwipeExists = wrapper.querySelector('.swiper-container') !== null;
    const PoponeExists = $scope.find('.anant-popup') !== null;
    $scope.find('.quick-cls').click(function() {
        if(PoponeExists == true){
            $scope.find('.anant-popup').remove();
        }
        if(SwipeExists !== true){
            var thisEl = $(this);
            thisEl.parent().parent().toggleClass("popup");
            var product_id = $(this).find('.ant-tooltip').attr('data-prod-id');
            var data = {action: 'woo_quickview', product: product_id};

            $.ajax({
                url: myajax.ajaxurl,
                type: "POST",
                data: data,
                success: function (response) {
                    var jsdata = JSON.parse(response.data);
                    thisEl.parent().parent().append(jsdata);
                },
                complete: function() {
                    var quick_view = document.querySelectorAll('.close-btn');
                    for (var i = 0; i < quick_view.length; i++) {
                        quick_view[i].addEventListener('click', function(event) {
                            
                            var par = this.parentElement.parentElement.parentElement;
                            if(par.classList.contains('popup')){
                            par.classList.remove('popup');
                            this.parentElement.parentElement.remove();
    
                            }
                        });
                    }
                },
                error: function(errorThrown){
                    console.log(errorThrown);
                    console.log('quick view ajax error');
                },
            });
        }else{
            var thisEl = $(this);
            $scope.toggleClass("on_Pup");
            var product_id = $(this).find('.ant-tooltip').attr('data-prod-id');
            var data = {action: 'woo_quickview', product: product_id};

            $.ajax({
                url: myajax.ajaxurl,
                type: "POST",
                data: data,
                success: function (response) {
                    var jsdata = JSON.parse(response.data);
                    $scope.append(jsdata);
                },
                complete: function() {
                    var quick_view = document.querySelectorAll('.close-btn');
                    for (var i = 0; i < quick_view.length; i++) {
                        quick_view[i].addEventListener('click', function(event) {
                            
                            var par = this.parentElement.parentElement.parentElement;
                            if(par.classList.contains('on_Pup')){
                            par.classList.remove('on_Pup');
                            this.parentElement.parentElement.remove();
    
                            }
                        });
                    }
                },
                error: function(errorThrown){
                    console.log(errorThrown);
                    console.log('quick view ajax error');
                },
            });
        }
    
    });
    
}   

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/anant-product-grid.default', ProductFeatureQuickView);
});

/**
  * Woocommerce product add wishlist js
 **/

var addProductWishlist = function( $scope, $ ){ 
    const wId = $scope.data("id");
	const wrapper = document.querySelector(`.elementor-element-${wId}`);
	const outerWrapper = wrapper.querySelector(".anant-outer-wrapper");

    $scope.find('.wishlist-cls').click(function() { 
        $this = $(this);
        console.log('wishlist is clicked');
        var product_id = $(this).attr('product-id');
        var data = {action: 'anant_add_to_wishlist', product_id: product_id};

        $.ajax({
            url: myajax.ajaxurl,
            type: "POST",
            data: data,
            success: function (response) {
                console.log(response);
            },
            complete: function() {
                $scope.find('.ant-add-card-massage').addClass('show-massage');
                setTimeout(function() {
                    $scope.find('.ant-add-card-massage').removeClass('show-massage');
                }, 2500); 
            },
            error: function(errorThrown){
                console.log(errorThrown);
                console.log('wishlist ajax error');
            },
        });
    
    });
    
}

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/anant-product-grid.default', addProductWishlist);
});

/**
  * Woocommerce product remove wishlist js
 **/

var removeProductWishlist = function( $scope, $ ){ 
    const wId = $scope.data("id");
	const wrapper = document.querySelector(`.elementor-element-${wId}`);
	const outerWrapper = wrapper.querySelector(".anant-outer-wrapper");

    $scope.find('.product-remover').click(function() { 
        $this = $(this);
        console.log('wishlist is clicked');
        var product_id = $(this).data('product_id');
        var data = {action: 'anant_remove_from_wishlist', product_id: product_id};

        $.ajax({
            url: myajax.ajaxurl,
            type: "POST",
            data: data,
            success: function (response) {
                console.log(response);
            },
            complete: function() {
                window.location.reload();
            },
            error: function(errorThrown){
                console.log(errorThrown);
                console.log('wishlist ajax error');
            },
        });
    
    });
    
}

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/anant-wishlist-page.default', removeProductWishlist);
});

/**
	* Search widget JS
	*/
	var WidgetanantWooSearchButton = function( $scope, $ ){

		if ( 'undefined' == typeof $scope )
			return;

			var $input = $scope.find( "input.anant_search_input" );
			var $clear = $scope.find( "button#clear" );
			var $clear_with_button = $scope.find( "button#clear-with-button" );
			var $search_button = $scope.find( ".anant-search-submit" );
			var $toggle_search = $scope.find( ".anant-search-icon-toggle input" );
			var $search_wrap = $scope.find( ".anant-search-wrapper" );

		$scope.find( '.search-btn i.fa-search' ).on( 'click', function( ){
			$scope.find( ".anant-search-wrapper" ).toggleClass( "anant-input-focus" );					
		});	

		$toggle_search.css( 'padding-right', $toggle_search.next().outerWidth() + 'px' );

		$input.on( 'keyup', function(){
			$clear.style = (this.value.length) ? $clear.css('visibility','visible'): $clear.css('visibility','hidden');
			$clear_with_button.style = (this.value.length) ? $clear_with_button.css('visibility','visible'): $clear_with_button.css('visibility','hidden');
			$clear_with_button.css( 'right', $search_button.outerWidth() + 'px' );
		});

		$clear.on("click",function(){
			this.style = $clear.css('visibility','hidden');
			$input.value = "";
		});
		$clear_with_button.on("click",function(){
			this.style = $clear_with_button.css('visibility','hidden');
			$input.value = "";
		});

	    // var searchRequest;	

        // $input.autocomplete({
        //     source: function(term, suggest){
        //         var term1 = $scope.find( "input.anant_search_input" ).val();
        //         try { searchRequest.abort(); } catch(e){}
        //         searchRequest = $.post(myajax.ajaxurl, { srchwoo: term1, action: 'search_woo_site' }, function(res) {
        //             var rspns = eval(res.data);
        //             var na = [];
        //             $.map(rspns, function(item) {
        //             let result = item.toLowerCase().includes(term1.toLowerCase());
        //                 if(result == true){
        //                     na.push(item);
        //                 }	
        //             });
        //                 suggest(na);
        //         });
        //     }
        // });
  
		const searchInput = wrapper.querySelector('#ant-search-input');
		const suggestionsContainer = wrapper.querySelector('#ant-suggestions-container');

		searchInput.addEventListener('input', function() {
			const inputText = searchInput.value.trim().toLowerCase();
			console.log(inputText);
            var thisEl = $(this);
            var data = {action: 'search_site', search_item: inputText};
        
            jQuery.ajax({
                url: myajax.ajaxurl,
                type: "POST",
                data: data,
                success: function (response) {
                    var suggestions = JSON.parse(response.data);
					if (inputText === '') {
						suggestionsContainer.innerHTML = "";
						return;
					}
			
					const filteredSuggestions = suggestions.filter(suggestion =>
						suggestion.title.toLowerCase().includes(inputText)
					);
                    console.log(suggestions);

			
					displaySuggestions(filteredSuggestions);
                },
                error: function(errorThrown){
                    console.log(errorThrown);
                    console.log('woo search ajax error');
                },
            });
		});

		function displaySuggestions(suggestionsList) {
			suggestionsContainer.innerHTML = '';
	
			if (suggestionsList.length === 0) {
				suggestionsContainer.innerHTML = '<div class="ant-no-results"><p>No results found</p></div>';
				suggestionsContainer.style.display = 'block';
				return;
			}
	
			suggestionsList.forEach(suggestion => {
				const suggestionElement = document.createElement('div');
				suggestionElement.className = 'search-suggestion'; 
				// Create title anchor tag
				const titleAnchorElement = document.createElement('a');
				titleAnchorElement.href = suggestion.url; 
				titleAnchorElement.target = '_blank'; 
		
				// Create title element
				const titleElement = document.createElement('p');
				titleAnchorElement.textContent = suggestion.title;
				titleElement.appendChild(titleAnchorElement);
				suggestionElement.appendChild(titleElement);
		
				suggestionElement.addEventListener('click', function() {
					searchInput.value = suggestion.title;
					suggestionsContainer.style.display = 'none';
				});
		
				suggestionsContainer.appendChild(suggestionElement);
			});
	
			suggestionsContainer.style.display = 'block';
		}
	
		document.addEventListener('click', function(event) {
			if (event.target !== searchInput && event.target !== suggestionsContainer) {
				suggestionsContainer.style.display = 'none';
			}
		});

	}

	jQuery(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/anant-woo-search.default', WidgetanantWooSearchButton );
	});

    var ProductButtons = function( $scope, $ ){  
        const wId = $scope.data("id");
        const wrapper = document.querySelector(`.elementor-element-${wId}`);
        const outerWrapper = wrapper.querySelector(".anant-outer-wrapper");
    
        $scope.find('.anant-product-button-one , .anant-product-button-two').on('click', function(e) {
    
            var product_id = $(this).attr('product-id');
            var btn_type = $(this).attr('id');
            var quantity = $(this).attr('value');
    
            jQuery.ajax({
                type: 'POST',
                url: myajax.ajaxurl,
                data: {
                    'action': 'ajax_add_to_cart',
                    'product_id': product_id,
                    'quantity': quantity,
                },
                success: function(response) {
                 
                    if(btn_type === 'ant-btn-cart'){    
                        $scope.find('form .ant-add-card-massage').addClass('show-massage');
                        setTimeout(function() {
                            $scope.find('form .ant-add-card-massage').removeClass('show-massage');
                        }, 5000);  
                    }else{
                        window.location.href = response['cart_url'];
                    }
                        console.log(response);
                        console.log(btn_type);
                }
            });
        });
    
    }
    
    jQuery(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/anant-product-button.default', ProductButtons);
    }); 
    
    var ProductQuantity = function( $scope, $ ){  
        const wId = $scope.data("id");
        const wrapper = document.querySelector(`.elementor-element-${wId}`);
        const outerWrapper = wrapper.querySelector(".anant-outer-wrapper");
    
        // Get the DOM elements for the buttons
        var buttonPlus = wrapper.querySelector(".ant-icon-plus");
        var buttonMinus = wrapper.querySelector(".ant-icon-minus");
    
    
        buttonPlus.addEventListener("click", 
        function (event) {
            var button = event.target;
            var qtyContainer = button.closest(".ant-quantity-group");
            var inputQty = qtyContainer.querySelector(".ant-quantity-control");
            inputQty.value = Number(inputQty.value) + 1;
        });
    
        buttonMinus.addEventListener("click", 
        function (event) {
            var button = event.target;
            var qtyContainer = button.closest(".ant-quantity-group");
            var inputQty = qtyContainer.querySelector(".ant-quantity-control");
            var amount = Number(inputQty.value);
            if (amount > 0) {
                inputQty.value = amount - 1;
            }
        });
    
    }
    
    jQuery(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/anant-product-quantity.default', ProductQuantity);
    });
    
    var ProductDetails = function( $scope, $ ){  
        const wId = $scope.data("id");
        const wrapper = document.querySelector(`.elementor-element-${wId}`);
        const outerWrapper = wrapper.querySelector(".anant-outer-wrapper");
        const prev_type = $scope.find('.anant-product-details').attr('prev-type');
        
        if(prev_type === 'demo'){
        $( 'body' )
            // Tabs
            .on( 'init', $scope.find('.wc-tabs-wrapper').add($scope.find('.woocommerce-tabs')), function() {
                $( this ).find( '.wc-tab, .woocommerce-tabs .panel:not(.panel .panel)' ).hide();
    
                var hash  = window.location.hash;
                var url   = window.location.href;
                var $tabs = $( this ).find( '.wc-tabs, ul.tabs' ).first();
    
                if ( hash.toLowerCase().indexOf( 'comment-' ) >= 0 || hash === '#reviews' || hash === '#tab-reviews' ) {
                    $tabs.find( 'li.reviews_tab a' ).trigger( 'click' );
                } else if ( url.indexOf( 'comment-page-' ) > 0 || url.indexOf( 'cpage=' ) > 0 ) {
                    $tabs.find( 'li.reviews_tab a' ).trigger( 'click' );
                } else if ( hash === '#tab-additional_information' ) {
                    $tabs.find( 'li.additional_information_tab a' ).trigger( 'click' );
                } else {
                    $tabs.find( 'li:first a' ).trigger( 'click' );
                }
            } )
            .on( 'click', '.wc-tabs li a, ul.tabs li a', function( e ) {
                e.preventDefault();
                var $tab          = $( this );
                var $tabs_wrapper = $tab.closest( '.wc-tabs-wrapper, .woocommerce-tabs' );
                var $tabs         = $tabs_wrapper.find( '.wc-tabs, ul.tabs' );
    
                $tabs.find( 'li' ).removeClass( 'active' );
                $tabs_wrapper.find( '.wc-tab, .panel:not(.panel .panel)' ).hide();
    
                $tab.closest( 'li' ).addClass( 'active' );
                $tabs_wrapper.find( '#' + $tab.attr( 'href' ).split( '#' )[1] ).show();
            } )
            // Review link
            .on( 'click', 'a.woocommerce-review-link', function() {
                $( '.reviews_tab a' ).trigger( 'click' );
                return true;
            } )
            // Star ratings for comments
            .on( 'init', '#rating', function() {
                if($( '#rating' ).attr('style') !== 'display: none;'){
                    $( '#rating' )
                        .hide()
                        .before(
                            '<p class="stars">\
                                <span>\
                                    <a class="star-1" href="#">1</a>\
                                    <a class="star-2" href="#">2</a>\
                                    <a class="star-3" href="#">3</a>\
                                    <a class="star-4" href="#">4</a>\
                                    <a class="star-5" href="#">5</a>\
                                </span>\
                            </p>'
                        );
    
                }
            } )
            .on( 'click', '#respond p.stars a', function() {
                var $star   	= $( this ),
                    $rating 	= $( this ).closest( '#respond' ).find( '#rating' ),
                    $container 	= $( this ).closest( '.stars' );
    
                $rating.val( $star.text() );
                $star.siblings( 'a' ).removeClass( 'active' );
                $star.addClass( 'active' );
                $container.addClass( 'selected' );
    
                return false;
            } )
            .on( 'click', '#respond #submit', function() {
                var $rating = $( this ).closest( '#respond' ).find( '#rating' ),
                    rating  = $rating.val();
    
                if ( $rating.length > 0 && ! rating && wc_single_product_params.review_rating_required === 'yes' ) {
                    window.alert( wc_single_product_params.i18n_required_rating_text );
    
                    return false;
                }
            } );
    
            // Init Tabs and Star Ratings
            $( '.wc-tabs-wrapper, .woocommerce-tabs, #rating' ).trigger( 'init' );
    
        }
    
    }
    
    jQuery(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/anant-product-details.default', ProductDetails);
    });

    var ProductImage = function( $scope, $ ){  
        const wId = $scope.data("id");
        const wrapper = document.querySelector(`.elementor-element-${wId}`);
        const outerWrapper = wrapper.querySelector(".anant-outer-wrapper");
        const zoomer_type = $scope.find('.anant-product-image').attr('zoom-type');
        const slide_align = $scope.find('.anant-product-image').attr('slide-align');
        const autoplay = $scope.find('.anant-product-image').attr('auto');
        const autoplaySpeed = $scope.find('.anant-product-image').attr('speed');
        const switch_speed = parseInt($scope.find('.anant-product-image').attr('switch-speed'));
        const loop = $scope.find('.anant-product-image').attr('swipe-loop') === 'yes' ? true : false;
    
        if(zoomer_type === 'inner'){
        const productImages = wrapper.querySelectorAll('.inner .ant-big-single-img');
    
            productImages.forEach((image) => {
    
                image.addEventListener('mouseover', function () {
                    const imageElement = this.querySelector('.ant-single-main-img');
                    imageElement.style.transform = 'scale(' + this.getAttribute('imageScale') + ')';
                });
    
                image.addEventListener('mouseout', function () {
                    const imageElement = this.querySelector('.ant-single-main-img');
                    imageElement.style.transform = 'scale(1)';
                });
    
                image.addEventListener('mousemove', (e) => {
                    const imageElement = image.querySelector('.ant-single-main-img');
                    const { clientX, clientY } = e;
                    const { left, top, width, height } = image.getBoundingClientRect();
    
                    const x = (clientX - left) / width;
                    const y = (clientY - top) / height;
    
                    // Calculate the transform-origin based on mouse position
                    const transformOrigin = `${x * 100}% ${y * 100}%`;
    
                    // Apply the new transform-origin
                    imageElement.style.transformOrigin = transformOrigin;
                });
    
            });
        } else {
            // Select the pane container using vanilla JavaScript
            var paneContainer = wrapper.querySelector('.ant-single-detail.outer');
    
            // Select all elements with the class "swiper-slide" using vanilla JavaScript
            var swiperSlides = wrapper.querySelectorAll('.ant-single-imageBox.outer .ant-big-single-img');
    
            // Iterate through each swiper-slide element and initialize Drift for each image
            swiperSlides.forEach(function(slide) {
            var image = slide.querySelector('.ant-single-main-img');
            
            if (image) {
                // console.log(image);
                new Drift(image, {
                paneContainer: paneContainer,
                inlinePane: false,
                });
            }
            });
    
        }  
    
        console.log(loop);
        
        if(slide_align === 'horizontal_slide'){  
    
            var sliderThumbnail = new Swiper('.horizontal_slide .horizontal.anant-product-image-gallery-img', {
                loop:false,
                autoplay: autoplay === 'yes'
                    ? {
                            delay: autoplaySpeed,
                            disableOnInteraction: false,
                      }
                    : false,
                speed: switch_speed,
                slidesPerView: 5,
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
            });
        
            var slider = new Swiper('.horizontal_slide .anant-product-image-main-img', {
                loop:loop,
                autoplay: autoplay === 'yes'
                    ? {
                            delay: autoplaySpeed,
                            disableOnInteraction: false,
                      }
                    : false,
                speed: switch_speed,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.ant-single-imageBox.horizontal_slide .swiper-button-next',
                    prevEl: '.ant-single-imageBox.horizontal_slide .swiper-button-prev',
                },
                thumbs: {
                    swiper: sliderThumbnail
                }
            });
            
        } else {
    
            var verticalSliderThumbnail = new Swiper('.vertical_slide .vertical.anant-product-image-gallery-img', { 
                loop:false,
                autoplay: autoplay === 'yes'
                    ? {
                            delay: autoplaySpeed,
                            disableOnInteraction: false,
                      }
                    : false,
                 speed: switch_speed,
                direction: 'vertical',
                slidesPerView: 5,
                freeMode: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
              });
              
              var verticalProductSlider = new Swiper('.vertical_slide .anant-product-image-main-img', {
                loop:loop,
                autoplay: autoplay === 'yes'
                    ? {
                            delay: autoplaySpeed,
                            disableOnInteraction: false,
                      }
                    : false,
                    
                speed: switch_speed,
                navigation: {
                  nextEl: '.ant-single-imageBox.vertical_slide .swiper-button-next',
                  prevEl: '.ant-single-imageBox.vertical_slide .swiper-button-prev',
                },
                thumbs: {
                  swiper: verticalSliderThumbnail
                }
              });
    
        }  
    }
    
    jQuery(window).on('elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction('frontend/element_ready/anant-product-image.default', ProductImage);
    });

    /**
      * Woocommerce login / signup page js
     **/
    
    var anantAccountPage = function( $scope, $ ){ 
        const wId = $scope.data("id");
        const wrapper = document.querySelector(`.elementor-element-${wId}`);
        const outerWrapper = wrapper.querySelector(".anant-outer-wrapper");
    
        $scope.find('#login-id').on('change',function() {
            var checked = this.checked;
            $scope.find('.u-column1.col-1').show();
            $scope.find('.u-column2.col-2').hide();
        });
    
        $scope.find('#signup-id').on('change',function() {
            var checked = this.checked;
            $scope.find('.u-column2.col-2').show();
            $scope.find('.u-column1.col-1').hide();
        });
        
    }
    
    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/anant-account-page.default', anantAccountPage);
    });

const tabs = ($scope, $) => {
	const wId = $scope.data('id');
	const wrapper = document.querySelector(`.elementor-element-${wId}`);
	const outerWrapper = wrapper.querySelector('.anant-outer-wrapper');
	if (!outerWrapper) return;
	const widgetId = outerWrapper.getAttribute('data-wid');
	const sliderWrapper = document.querySelector(`#anant_slider_${widgetId}`);
	const swiperClass = `.swiper-${widgetId}`;
	const tabs = $scope.find('.anant-product-tabs-grid');

	const change = (id) => {
		if (!id) return;
		if (sliderWrapper) swiper();
	};

	if (!sliderWrapper) {
		const prodGrid = document.querySelector('.anant-product-grid-wrapper');
		change(prodGrid.getAttribute('data-first_tab_id'));
	}

	if (tabs.length > 0) {
		tabs.each(function (index, tab) {
			$(tab)
				.find('.tabs li')
				.click(function (e) {
					e.preventDefault();
					const id = $(this).data('id');
					const sliders = document.querySelectorAll(`.anant_product_wrapper.anant-${widgetId}`)
					const selectedTab = document.querySelector(`.anant_product_wrapper.${id}`);
					[...sliders].forEach(slider => {
						slider.classList.add('anant_hide');
					});
					selectedTab.classList.remove('anant_hide');
					change(id);
					$(this).siblings().removeClass('active');
					$(this)
						.parents('.anant-product-tabs-grid')
						.find('.products')
						.removeClass('active');

					$(this).addClass('active');
					$(this).parents('.anant-product-tabs-grid').find(`#${id}`).addClass('active');
				});
		});
	}

	if (!sliderWrapper) return;

	const firstTabId = sliderWrapper.getAttribute('data-first_tab_id');

	const slideToShow = parseInt(sliderWrapper.getAttribute('data-slide-to-show'));
	const slideToShowMobile = parseInt(sliderWrapper.getAttribute('data-slide-to-show-mobile'));
	const slideToShowTablet = parseInt(sliderWrapper.getAttribute('data-slide-to-show-tablet'));
	const slideToScroll = parseInt(sliderWrapper.getAttribute('data-slides-to-scroll'));
	const slideToScrollMobile = parseInt(sliderWrapper.getAttribute('data-slides-to-scroll-mobile'));
	const slideToScrollTablet = parseInt(sliderWrapper.getAttribute('data-slides-to-scroll-tablet'));
	const slideSpaceBetween = sliderWrapper.getAttribute('data-slides-space-between');
	const slideSpaceBetweenMobile = sliderWrapper.getAttribute('data-slides-space-between-mobile');
	const slideSpaceBetweenTablet = sliderWrapper.getAttribute('data-slides-space-between-tablet');
	const autoplay = sliderWrapper.getAttribute('data-autoplay');
	const autoplaySpeed = sliderWrapper.getAttribute('data-autoplay-speed');

	const transitionBetweenSlides = parseInt(sliderWrapper.getAttribute('data-transition_between_slides'));
	const loop = sliderWrapper.getAttribute('data-loop');
	const mousewheel = sliderWrapper.getAttribute('data-mousewheel');
	const keyboardControl = sliderWrapper.getAttribute('data-keyboard_control');
	const clickable = sliderWrapper.getAttribute('data-clickable');

	const swiper = () => {
		const swiper = new Swiper(swiperClass, {
			loop,
			autoplay: autoplay
				? {
						delay: autoplaySpeed,
						disableOnInteraction: false,
				  }
				: false,
			mousewheel: mousewheel
				? {
						enable: true,
				  }
				: false,
			keyboardControl,
			speed: transitionBetweenSlides,
			scrollbar: {
				el: '.swiper-scrollbar',
				draggable: true,
				hide: true,
				snapOnRelease: true,
			},
			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
				clickable,
			},
			// Navigation arrows
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			breakpoints: {
				// when window width is >= 320px
				320: {
					slidesPerView: slideToShowMobile,
					spaceBetween: slideSpaceBetweenMobile,
					slidesPerGroup: slideToScrollMobile,
					// direction: directionMobile,
				},
				// when window width is >= 480px
				767: {
					slidesPerView: slideToShowTablet,
					spaceBetween: slideSpaceBetweenTablet,
					slidesPerGroup: slideToScrollTablet,
					// direction: directionTablet,
				},
				// when window width is >= 640px
				1024: {
					slidesPerView: slideToShow,
					spaceBetween: slideSpaceBetween,
					slidesPerGroup: slideToScroll,
					// direction: direction,
				},
			},
		});
	};
	change(firstTabId);
};

jQuery(window).on('elementor/frontend/init', function () {
	elementorFrontend.hooks.addAction('frontend/element_ready/anant-product-category-tab.default', tabs);
});