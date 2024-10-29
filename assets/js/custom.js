(function ($) {

  /**
   * Nav widgets JS
   */
  var WidgetanantNavMenu = function( $scope, $ ){ 
    const wId = $scope.data("id");
    const wrapper = document.querySelector(`.elementor-element-${wId}`);
    const outerWrapper = wrapper.querySelector(".anant-outer-wrapper");

    var acc = Array.from(wrapper .getElementsByClassName("arrow-sb"));
    acc.forEach(function (item) {
       item.addEventListener("click", function () {
          this.classList.toggle("active");
          var panel = this.nextElementSibling;
          if (panel.style.display === "block") {
             panel.style.display = "none";
          } else {
             panel.style.display = "block";
          }
       });
    });

    if ($scope.find('.header-menu').length) {
      wrapper.querySelector('.ant-menu-btn').onclick = function (e) {
        console.log('yes ');
        var nav = wrapper.querySelector('.ant-menu-btn'); 
        var main_nav = wrapper.querySelector('.ant-nav-wp'); 
        nav.classList.toggle('on'); 
        main_nav.classList.toggle('show'); 
        e.preventDefault();
        $("#ant-main-menu").css("transition", "all 0.8s"); 
        $scope.find('.ant-menu-btn').find('.fa-bars').toggleClass('fa-times');
      } 
    }

    wrapper.querySelectorAll('.sb-menu > .has-children').forEach(function (menuItem) {
      menuItem.addEventListener('mouseenter', function () {
          const submenu = menuItem.querySelector('.sb-menu');
          const rect = submenu.getBoundingClientRect();
          console.log([rect.right, window.innerWidth - 70]);
          if ((rect.right > (window.innerWidth - 70) && submenu.style.right === '') || (rect.left < 0 && submenu.style.left === '')) {
            // Toggle direction only if required
            if (rect.right > (window.innerWidth - 70)) {
                submenu.style.left = 'auto';
                submenu.style.right = '100%';
                submenu.parentElement.classList.add('sb-left');
            } else {
                submenu.style.left = '100%';
                submenu.style.right = 'auto';
            }
          }
      });
    });

  }

  jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/anant-nav-menu.default', WidgetanantNavMenu);
  });
  
  var WidgetProgressBar = function( $scope, $ ){
    const wId = $scope.data("id");
  
    const wrapper = document.querySelector(`.elementor-element-${wId}`);
    let suffdiv = wrapper.querySelector('.anant-progress-items');
  
    let suffix =  suffdiv.getAttribute("prog-suffix");
    const progress_bars = wrapper.querySelector('.ant-pro-percentage');
  
      let SPEED = 25;
  
      let limit = parseInt(progress_bars.innerHTML, 10);
  
      for(let i = 0; i <= limit; i++) {
          setTimeout(function () {
            progress_bars.innerHTML = i + suffix;
          }, SPEED * i);
      }
  
  
  }
  jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/anant-progress-bar.default', WidgetProgressBar);
  });

  const imageHotspot = function( $scope, $ ){
  
    const wId = $scope.data("id");
    const wrapper = document.querySelector(`.elementor-element-${wId}`);
    let suffdiv = wrapper.querySelector('.ant-image-hotspots');
    let suffix =  suffdiv.getAttribute("tigger");
  
    if ( suffix === 'by_click' ) {
      $scope.find('.ant-hotspot-item').each(function(){
        $(this).on("click", function() {
          $(this).find('.ant-hotspot-tooltip').toggleClass('ant-tooltip-trigger');
        });
      });
      
    }
  
  };
  
  jQuery(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/anant-image-hotspot.default",imageHotspot
    );
  });

  var WidgetTimeline = function( $scope, $ ){ 
    // -------------------- TIMELINE ---------------------------- 
    var items = $scope.find(".ant-timeline-items .timeline-dot"),
    timelineHeight = $scope.find(".ant-timeline-items").height(),
    greyLine = $scope.find('.timeline-line'),
    lineToDraw = $scope.find('.timeline-inner-line');

    // sets the height that the greyLine (.default-line) should be according to `.timeline ul` height

    // run this function only if draw line exists on the page
    if(lineToDraw.length) {
      $(window).on('scroll', function () {

        // Need to constantly get '.draw-line' height to compare against '.default-line'
        var redLineHeight = lineToDraw.height(),
        greyLineHeight = greyLine.height(),
        windowDistance = $(window).scrollTop(),
        windowHeight = $(window).height() / 2,
        timelineDistance = $scope.find(".ant-timeline-items").offset().top;

        if(windowDistance >= timelineDistance - windowHeight) {
          line = windowDistance - timelineDistance + windowHeight;

          if(line <= greyLineHeight) {
            lineToDraw.css({
              'height' : line + 8 + 'px'
            });
          }
        }

        // This takes care of adding the class in-view to the li:before items
        var bottom = lineToDraw.offset().top + lineToDraw.outerHeight(true);
        items.each(function(index){
          var circlePosition = $(this).offset();

          if(bottom > circlePosition.top) {				
            $(this).addClass('highlighted-dot');
          } else {
            $(this).removeClass('highlighted-dot');
          }
        });	
      });
    }  
  }

  jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/anant-timeline.default', WidgetTimeline);
  });

  jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/anant-post-blog-timeline.default', WidgetTimeline);
  });

  var marquee_stripe = function( $scope, $ ){ 
    var ticker = $scope.find( ".anant-marquee-stripe" );
    var mainDiv = $scope.find('.anant-marquee-main');
    var PauseVal =  (mainDiv.attr('tickerHover') == 'yes' ) ? true : false;
    var tickerSlide = mainDiv.marquee({
      speed: 70,
      direction: 'right', 
      delayBeforeStart: 0,
      duplicated: true,
      pauseOnHover: PauseVal,
      startVisible: true,
      loop: -1
    });
  }
  jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/anant-marquee-stripe.default', marquee_stripe);
  });

  // Product Banner
  const pos = document.documentElement;
  pos.addEventListener("mousemove", e =>{
  pos.style.setProperty('--x', e.clientX + "px");
  pos.style.setProperty('--y', e.clientY + "px");
  });

  function startTimeCounter() {
      document.querySelectorAll('.offer-timer .timer').forEach(timer => {
          const endDate = new Date(timer.dataset.date).getTime();
          if (isNaN(endDate)) {
              console.error(`Invalid date format: ${timer.dataset.date}`);
              return;
          }
          const spans = {
              days: timer.querySelector('.days span'),
              hours: timer.querySelector('.hours span'),
              minutes: timer.querySelector('.minutes span'),
              seconds: timer.querySelector('.seconds span')
          };
          const updateTimer = () => {
              const now = new Date().getTime();
              let time = endDate - now;
              if (time <= 0) {
                  clearInterval(timerInterval);
                  Object.values(spans).forEach(span => span.textContent = '00');
                  return;
              }
              const units = {
                  days: Math.floor(time / (1000 * 60 * 60 * 24)),
                  hours: Math.floor((time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
                  minutes: Math.floor((time % (1000 * 60 * 60)) / (1000 * 60)),
                  seconds: Math.floor((time % (1000 * 60)) / 1000)
              };
              for (let unit in units) {
                  spans[unit].textContent = String(units[unit]).padStart(2, '0');
              }
          };
          const timerInterval = setInterval(updateTimer, 1000);
          updateTimer();
      });
  }
  
  jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/anant-time-counter.default', startTimeCounter);
  });
  
} )( jQuery );