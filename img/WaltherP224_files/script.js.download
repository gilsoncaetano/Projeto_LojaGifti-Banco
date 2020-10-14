var $ =  jQuery.noConflict(); //Wordpress by default uses jQuery instead of $

jQuery(document).ready(function(){

  //Hover styles
  otw_hover_styles();

  //Socail shares
  otw_social_shares();

  // Responsive Videos
  otw_responsive_videos();

  // Blog image slides
  jQuery('.otw_blog_manager-format-gallery').each( function( i, v ) {
    $this = jQuery(this);

    if( $this.find('.slides').length > 0 ) {
      $this.flexslider({
        namespace: "otw-flex-",
        animation: "slide", // slide or fade
        animationLoop: true,
      });
    }
  });

  // Load More Other Items
  jQuery(document).on('click', '.js-otw_blog_manager-load-more a', function(e) {
    e.preventDefault();
    $this = jQuery(this);

    if( !$this.parent().hasClass('otw_blog_manager-load-more-newspapper') ) {

      $this.html('<div class="preloader">Loading posts...</div>');

      var url = $this.parent('.otw_blog_manager-load-more').parent().find('.otw_blog_manager-pagination.hide a').attr('href');

      if(url === 'undefined' || url === '#' || url === ''){
        $this.text($this.attr('data-empty'));
        return false;
      }

      $this.prop('disabled', true);

      $container = $this.parent().parent().parent().parent().parent().parent().parent().parent().find('.otw_blog_manager-blog-item-holder').parent();
      $mainContainer = $this.parent().parent().parent().parent().parent();

      jQuery.get(url, function(data) {
        if( data.length > 1 ) {
          $pagination = jQuery(data).find('.js-pagination_container').parent().parent();

          jQuery('.js-pagination_container').parent().parent().remove();

          $newElements = jQuery(data).find('.otw_blog_manager-blog-item-holder');

          $container.append( $newElements ); 

          $mainContainer.append( $pagination );
          
          otw_hover_styles();
          otw_responsive_videos();
          otw_social_shares();
          otw_enable_sliders();
          horizontal_layout('.otw_blog_manager-horizontal-layout-items');
        } else {
          $this.html('No More Posts Found').animate({ opacity: 1 }, 2000, function () {
            $this.fadeOut('fast');
          });
        }
      });

    }

  });

  // Load More Widgets
  jQuery(document).on('click', '.js-widget-otw_blog_manager-load-more a', function(e) {

    e.preventDefault();
    $this = jQuery(this);

    var url = $this.parent('.js-widget-otw_blog_manager-load-more').parent().find('.otw_blog_manager-pagination.hide a').attr('href');

    if(url === 'undefined' || url === '#' || url === ''){
      $this.text($this.attr('data-empty'));
      return false;
    }
    $this.html('<div class="preloader">Loading posts...</div>');
    $this.prop('disabled', true);

    $container = $this.parent().parent().parent().parent().parent().parent().find('.js-widget-list');    

    jQuery.get(url, function(data) {
      if( data.length > 1 ) {
        $pagination = jQuery(data).find('.js-otw_blog_manager-widget-pagination-holder').parent().parent();

        // Remove Load More
        $this.parent().parent().remove();

        // Add new Load More BTN
        jQuery('.js-otw_blog_manager-widget-pagination-holder').html( jQuery(data).find('.js-widget-pagination_container') );


        $container.append( jQuery(data).find('.js-widget-list').children() );
        otw_hover_styles();
        otw_responsive_videos();
        otw_social_shares();
        otw_enable_sliders();
      } else {
        $this.html('No More Posts Found').animate({ opacity: 1 }, 2000, function () {
          $this.fadeOut('fast');
        });
      }
    });

  });
 
  //Load More NewsPapper
  jQuery(document).on("click", '.otw_blog_manager-load-more-newspapper a',function(e){

    e.preventDefault();

    $this = jQuery(this);

    var url = $this.attr('href');

    if(url === 'undefined' || url === '#' || url === ''){
      $this.text($this.attr('data-empty'));
      return false;
    }
    $this.html('<div class="preloader">Loading posts...</div>');
    $container = jQuery(this).parent().parent().parent().parent().parent().find('.otw_blog_manager-blog-newspaper')

    jQuery.get(url, function(data) {
      if( data.length > 1 ) {
        var $newElements = jQuery( jQuery(data).find('.otw_blog_manager-blog-item-holder').html() );

        //slider fixing
        $newElements.find('.otw_blog_manager-blog-media-wrapper.otw_blog_manager-format-gallery').each(function(){
          var image = new Image();
          image.src = jQuery(this).find('.slides li img').attr("src");
          jQuery(this).css({'max-width': image.naturalWidth + 'px' });
          jQuery(this).find('.slides li').css({'max-width': image.naturalWidth + 'px' });
        });

        if($newElements.find('.otw_blog_manager-format-gallery .slides').length > 0 ) {
          $newElements.find('.otw_blog_manager-format-gallery').flexslider({
            namespace: "otw-flex-",
            animation: "slide"
          });
        }

        $paginationElement = jQuery(data).find('.js-pagination_container').parent().parent();

        if($this.data('isotope') !== false){
          
          $container.append( $newElements ).isotope( 'appended', $newElements, function(){
            jQuery(this).isotope('reLayout');
          });
        } else {
          $newElements.appendTo( $this.parent('.otw_blog_manager-load-more').parent().find('.otw_blog_manager-blog-item-holder') ).each(function(){
            if($this.data('layout') === 'horizontal'){
              horizontal_layout('.otw_blog_manager-horizontal-layout-items');
            }
          });
        }

        otw_social_shares();
        otw_enable_sliders();

        //next page
        jQuery('.js-pagination_container').parent().parent().remove();
        $container.parent().append( $paginationElement );
        otw_calculate_columns('.otw_blog_manager-mosaic-layout');
      } else {
        $this.html('No More Posts Found').animate({ opacity: 1 }, 2000, function () {
          $this.fadeOut('fast');
        });
      }
    });

    
  });

  //Infinite Scroll for Grid Layout 
  try {
  
    jQuery('.otw_blog_manager-infinite-pagination-holder').infinitescroll({
      navSelector  : '.otw_blog_manager-pagination',    // selector for the paged navigation 
      nextSelector : '.otw_blog_manager-pagination a',  // selector for the NEXT link (to page 2)
      itemSelector : '.otw_blog_manager-blog-item-holder',     // selector for all items you'll retrieve
      // debug: true,
      loading: {
          finishedMsg: 'No More Posts Found',
          msgText: 'Loading posts...',
          img: '//i.imgur.com/o4Qsgvx.gif'
        }
      },
      //call horizontal layout as a callback
      function( newElements ) {
        otw_hover_styles();
        otw_responsive_videos();
        otw_social_shares();
        otw_enable_sliders();
      }
    );
  } catch(err) { }

  //Infinite Scroll for Newspaper Layout
  try {
    jQuery('.otw_blog_manager-infinite-scroll').infinitescroll({
      navSelector  : '.otw_blog_manager-pagination',    // selector for the paged navigation 
      nextSelector : '.otw_blog_manager-pagination a',  // selector for the NEXT link (to page 2)
      itemSelector : '.otw_blog_manager-blog-newspaper-item',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'No More Posts Found',
          msgText: 'Loading posts...',
          img: '//i.imgur.com/o4Qsgvx.gif'
        }
      },
      //call Isotope as a callback
      function( newElements ) {
        var $newElements = jQuery(newElements);
        //slider fixing
        $newElements.find('.otw_blog_manager-blog-media-wrapper.otw_blog_manager-format-gallery').each(function(){
          var image = new Image();
          image.src = jQuery(this).find('.slides li img').attr("src");
          // jQuery(this).css({'max-width': image.naturalWidth + 'px' });
          // jQuery(this).find('.slides li').css({'max-width': image.naturalWidth + 'px' });
        });

        if($newElements.find('.otw_blog_manager-format-gallery .slides').length > 0 ) {
          $newElements.find('.otw_blog_manager-format-gallery').flexslider({
            namespace: "otw-flex-",
            animation: "slide"
          });
        }

        jQuery('.otw_blog_manager-infinite-scroll').isotope( 'appended', $newElements, function(){
          otw_hover_styles();
          otw_responsive_videos();
          otw_social_shares();
          otw_enable_sliders();
          otw_calculate_columns('.otw_blog_manager-mosaic-layout');
          jQuery(this).isotope('reLayout');
          
        });
      }
    );
  } catch(err) {

  }

  //Infinite Scroll for Horizontal Layout
  try {
    jQuery('.otw_blog_manager-horizontal-layout-items-infinite-scroll').infinitescroll({
      navSelector  : '.otw_blog_manager-pagination',    // selector for the paged navigation 
      nextSelector : '.otw_blog_manager-pagination a',  // selector for the NEXT link (to page 2)
      itemSelector : '.otw_blog_manager-horizontal-item',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'No More Posts Found',
          msgText: 'Loading posts...',
          img: '//i.imgur.com/o4Qsgvx.gif'
        }
      },

      //call horizontal layout as a callback
      function( newElements ) {
        $newElements = jQuery(newElements).find('.otw_blog_manager-horizontal-item');
        otw_social_shares();
        otw_enable_sliders();
        horizontal_layout('.otw_blog_manager-horizontal-layout-items');
      }
    );
  } catch(err) {

  }

  // Timeline
  try {
    jQuery('.otw_blog_manager-blog-timeline').infinitescroll({
      navSelector  : '.otw_blog_manager-pagination',    // selector for the paged navigation 
      nextSelector : '.otw_blog_manager-pagination a',  // selector for the NEXT link (to page 2)
      itemSelector : '.otw_blog_manager-blog-timeline-item',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'No More Posts Found',
          msgText: 'Loading posts...',
          img: '//i.imgur.com/o4Qsgvx.gif'
        }
      },
      //callback
      function( newElements ) {
        var $newElements = jQuery(newElements);

        //slider fixing
        $newElements.find('.otw_blog_manager-blog-media-wrapper.otw_blog_manager-format-gallery').each(function(){
          var image = new Image();
          image.src = jQuery(this).find('.slides li img').attr("src");
          // jQuery(this).css({'max-width': image.naturalWidth + 'px' });
          // jQuery(this).find('.slides li').css({'max-width': image.naturalWidth + 'px' });
        });

        if($newElements.find('.otw_blog_manager-format-gallery .slides').length > 0 ) {
          $newElements.find('.otw_blog_manager-format-gallery').flexslider({
            namespace: "otw-flex-",
            animation: "slide"
          });
        }

        //hover styles
        $newElements.each(function(){
          otw_hover_styles();
          otw_responsive_videos();
          otw_social_shares();
          otw_enable_sliders();
        });

        jQuery('.otw_blog_manager-blog-timeline').append($newElements);

        jQuery('#infscr-loading').remove().insertAfter( jQuery('.otw_blog_manager-blog-timeline .otw_blog_manager-blog-timeline-item:last') );

        timeline_layout_fixer();
      }
    );
  } catch(err) {

  }
  
  //Comment Form
  jQuery('.otw_blog_manager-btn-reply').on('click', function() {
    if (!jQuery(this).hasClass('otw_blog_manager-cancel-reply')) {

      var comForm = jQuery('.otw_blog_manager-comment-form').clone();
      jQuery('.otw_blog_manager-comment-form').remove();

      jQuery('.otw_blog_manager-btn-reply').removeClass('otw_blog_manager-cancel-reply').html('<b>reply</b>');
      jQuery(this).addClass('otw_blog_manager-cancel-reply').html('<b>cancel</b>');
      jQuery(this).parent().parent().append(comForm);

      jQuery(this).parent().parent().children('.otw_blog_manager-comment-form')
        .focus(function() {
          jQuery(this).siblings('i').addClass('otw_blog_manager-focused');
        })
        .focusout(function() {
          jQuery(this).siblings('i').removeClass('otw_blog_manager-focused');
        });
    }
  });

  jQuery(document)
    .on('click', '.otw_blog_manager-cancel-reply', function() {
      var comForm = jQuery(this).parent().siblings('.otw_blog_manager-comment-form').clone();
      jQuery(this).parent().siblings('.otw_blog_manager-comment-form').remove();

      jQuery(this).removeClass('otw_blog_manager-cancel-reply').html('<b>reply</b>');
      jQuery('.otw_blog_manager-single-post').append(comForm);
    })
    .on('click', '.otw_blog_manager-cancel-reply2', function(event) {
      event.preventDefault();

      var comForm = jQuery(this).parent().parent().clone();
      jQuery(this).parent().parent().remove();

      jQuery('.otw_blog_manager-cancel-reply').removeClass('otw_blog_manager-cancel-reply').html('<b>reply</b>');
      jQuery('.otw_blog_manager-single-post').append(comForm);
    })
    .on('focus', 'input, textarea', function() {
      jQuery(this).siblings('i').addClass('otw_blog_manager-focused');
    })
    .on('focusout', 'input, textarea', function() {
      jQuery(this).siblings('i').removeClass('otw_blog_manager-focused');
    });

  //Slider
  jQuery('.otw_blog_manager-slider').each(function(){
    var $this = jQuery(this);
  
    var flexNav = true; // Show Navigation
    var flexAuto = true;  // Auto play 

    if( $this.data('nav') === 0 ) {
      flexNav = false;
    }

    if( $this.data('auto-slide') === 0 ) {
      flexAuto = false;
    }

    var slider_animation = jQuery(this).data('animation');

    if($this.find('.slides').length > 0 ) {
      
      if( $this.hasClass('otw_blog_manager-carousel') ){
        var item_margin = $this.data('item-margin');
        var item_per_page = $this.data('item-per-page');
        var item_width = ( ($this.width() - ( item_margin * (item_per_page - 1) )) / item_per_page );

        var prev_text = "";
        var next_text = "";

        if($this.data('type') == "widget"){
          prev_text = '<i class="icon-angle-left"></i>';
          next_text = '<i class="icon-angle-right"></i>';
        }

        $this.flexslider({
          namespace: "otw-flex-",
          animation: slider_animation,
          animationLoop: false,
          prevText: prev_text,
          nextText: next_text,
          itemWidth: item_width,
          itemMargin: item_margin,
          controlNav: flexNav,
          slideshow: flexAuto
        });
      } else {

        $this.flexslider({
          namespace: "otw-flex-",
          controlNav: flexNav,
          animation: slider_animation,
          slideshow: flexAuto
        });
      }
    }
    // Hide bullets if paginations is not enabled
    if( $this.data('nav') === 0 ) {
      $this.find( jQuery('.otw-flex-control-nav') ).hide();
    }
  });

  //Timeline Layout
  jQuery('.otw_blog_manager-blog-timeline.with-heading').before('<div class="otw_blog_manager-blog-timeline-heading"></div>');
  timeline_layout_fixer();

  /* Input & Textarea Placeholder */
/*  jQuery('input[type="text"], textarea').each(function(){
    jQuery(this).attr({'data-value': jQuery(this).attr('placeholder')});
    jQuery(this).removeAttr('placeholder');
    jQuery(this).attr({'value': jQuery(this).attr('data-value')});
  });

  jQuery('input[type="text"], textarea').focus(function(){
    jQuery(this).removeClass('error');
    if(jQuery(this).val().toLowerCase() === jQuery(this).attr('data-value').toLowerCase()){
      jQuery(this).val('');
    } 
  }).blur( function(){ 
    if(jQuery(this).val() === ''){
      jQuery(this).val(jQuery(this).attr('data-value'));
    }
  });
*/
  //IE8 hover fixer
  jQuery('.hover-style-14-desaturate a, .hover-style-16-orton a').on('mouseenter', function(){
    jQuery(this).find('.otw_blog_manager-hover-img').css({'opacity': '0'});
  }).on('mouseleave', function(){
    jQuery(this).find('.otw_blog_manager-hover-img').css({'opacity': '1'});
  });

  jQuery('.hover-style-15-blur a, .hover-style-17-glow a').on('mouseenter', function(){
    jQuery(this).find('.otw_blog_manager-hover-img').css({'opacity': '1'});
  }).on('mouseleave', function(){
    jQuery(this).find('.otw_blog_manager-hover-img').css({'opacity': '0'});
  });
});

var $container = jQuery('.otw_blog_manager-blog-newspaper');

//Blog Newspaper Filter

jQuery(window).on('load', function() {
  // Isotope
  try {
     $container = jQuery('.otw_blog_manager-blog-newspaper');
    
    otw_calculate_columns('.otw_blog_manager-mosaic-layout');

    $container.isotope({
      itemSelector: '.otw_blog_manager-blog-newspaper-item',
      layoutMode: 'masonry',
      getSortData: {
        date: function( $elem ) {
          return parseInt(String($elem.find('.otw_blog_manager-blog-date a').attr('data-date')).replace(/-/g, ""));
        },
        alphabetical: function( $elem ) {
          return $elem.find('.otw_blog_manager-blog-title a').text();
        }
      },
      onLayout: function( $elem, instance ) {

        if( $container.find('.otw_blog_manager-mosaic-layout').length !== 0 ) {
          otw_calculate_columns('.otw_blog_manager-mosaic-layout');
        }
      }
    });

    var $optionSets_filter = jQuery('.option-set.otw_blog_manager-blog-filter'),
        $optionLinks_filter = $optionSets_filter.find('a');

    $optionLinks_filter.click(function(e) {
      e.preventDefault();

      var $this = jQuery(this);


      if ($this.hasClass('selected')) {
        return false;
      }

      var $optionSet = $this.parents('.option-set');
      $optionSet.find('.selected').removeClass('selected');
      $this.addClass('selected');

      var selector = jQuery(this).data('filter');

      jQuery(this).parents('.otw_blog_manager-blog-newspaper-filter').parent().parent().parent().find($container).isotope({filter: selector});
    });
  } catch(err) {

  }

  //Blog Sorting
  var $optionSets_sort = jQuery('.option-set.otw_blog_manager-blog-sort'),
      $optionLinks_sort = $optionSets_sort.find('a');

  $optionLinks_sort.click(function(e){
    e.preventDefault();

    var $this = jQuery(this);

    if ($this.hasClass('selected')) {
      return false;
    }

    var $optionSet = $this.parents('.option-set');
    $optionSet.find('.selected').removeClass('selected');
    $this.addClass('selected');

    var value = $this.attr('data-option-value');
    jQuery(this).parents('.otw_blog_manager-blog-newspaper-sort').parent().parent().parent().find($container).isotope({ sortBy : value });
  });

  //Slider width fixing
  jQuery('.otw_blog_manager-blog-media-wrapper.otw_blog_manager-format-gallery.slider').each(function(){
    var image = new Image();
    image.src = jQuery(this).find('.slides li img').attr("src");
    jQuery(this).css({'max-width': image.naturalWidth + 'px' });
    jQuery(this).find('.slides li').css({'max-width': image.naturalWidth + 'px' });
  });

  //horizontal layout
  horizontal_layout('.otw_blog_manager-horizontal-layout-items');
});

//Hover styles
function otw_hover_styles(){

  jQuery('.hover-style-1-full > a, .hover-style-2-shadowin > a, .hover-style-3-border > a, .hover-style-7-shadowout > a').each(function(){
    if( jQuery(this).find('span.theHoverBorder').length == 0 ){
      jQuery(this).append('<span class="theHoverBorder"></span>');
    }
  });

  jQuery('.hover-style-4-slidetop > a, .hover-style-5-slideright > a, .hover-style-8-slidedown > a, .hover-style-9-slideleft > a').each(function(){
    if( jQuery(this).find('span.theHoverBorder').length == 0 ){
      var icon = jQuery(this).parents('.otw_blog_manager-blog-media-wrapper').attr('data-icon');
      jQuery(this).append('<span class="theHoverBorder"><i class="'+ icon +'"></i></span>');
    }
  });

  //Special effects
  jQuery('img', '.hover-style-14-desaturate').each(function(){
    
    jQuery(this).clone().addClass("otw_blog_manager-hover-img").insertAfter( jQuery(this) ).load(function(){
      Pixastic.process(this, "desaturate");
    });

  });

  jQuery('img', '.hover-style-15-blur').each(function(){
    // if( jQuery(this).parent().hasClass('otw-media-container') )
    jQuery(this).clone().addClass("otw_blog_manager-hover-img").insertAfter(jQuery(this)).load(function(){
      Pixastic.process(this, "blurfast", {amount: 0.3});
    });
  });

  jQuery('img', '.hover-style-16-orton').each(function(){
    jQuery(this).clone().addClass("otw_blog_manager-hover-img").insertAfter(jQuery(this)).load(function(){
      Pixastic.process(this, "blurfast", {amount: 0.05});
    });
  });

  jQuery('img', '.hover-style-17-glow').each(function(){
    jQuery(this).clone().addClass("otw_blog_manager-hover-img").insertAfter(jQuery(this)).load(function(){
      Pixastic.process(this, "glow", {amount: 0.3, radius: 0.2});
    });
  });

  //IE8 hover fixer
  jQuery('.hover-style-15-blur a .otw_blog_manager-hover-img, .hover-style-17-glow a .otw_blog_manager-hover-img').css({'opacity': '0'});
  jQuery('.hover-style-14-desaturate a .otw_blog_manager-hover-img, .hover-style-16-orton a .otw_blog_manager-hover-img').css({'opacity': '1'});

  //IE8 frameborder fixer
  jQuery('.otw_blog_manager-format-video iframe, .otw_blog_manager-format-audio iframe').each(function(){
    jQuery(this).attr({'frameBorder': 'no'});
  });
}

function timeline_layout_fixer(){
  jQuery('.otw_blog_manager-blog-timeline .otw_blog_manager-blog-timeline-item').removeClass('odd').removeClass('even');
  jQuery('.otw_blog_manager-blog-timeline .otw_blog_manager-blog-timeline-item:nth-child(2n-1)').addClass('odd');
  jQuery('.otw_blog_manager-blog-timeline .otw_blog_manager-blog-timeline-item:nth-child(2n)').addClass('even');
}

(function($,sr){
  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
    var timeout;

    return function debounced () {
      var obj = this, args = arguments;
      function delayed () {
        if (!execAsap)
          func.apply(obj, args);
        timeout = null;
      };

      if (timeout)
        clearTimeout(timeout);
      else if (execAsap)
        func.apply(obj, args);

      timeout = setTimeout(delayed, threshold || 100);
    };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
})(jQuery,'smartresize');

//Window resize event
jQuery(window).smartresize(function(){  
  try {
    otw_calculate_columns('.otw_blog_manager-mosaic-layout');
  } catch(err) { }

  try {
    $container.isotope("reLayout");
  } catch(err) { }

  try {
    horizontal_layout('.otw_blog_manager-horizontal-layout-items');
  } catch(err) { }
});

function otw_enable_sliders () {
  jQuery('.otw_blog_manager-format-gallery').each( function( i, v ) {
    $this = jQuery(this);
    
    if( $this.find('.slides').length > 0 ) {
      $this.flexslider({
        namespace: "otw-flex-",
        animation: "slide", // slide or fade
        animationLoop: true
      });
    }
  });
}

//Masonry layout
function otw_calculate_columns(container) {
  
  jQuery(container).each(function(){

    var $this = jQuery(this),
      containerWidth = $this.width(),
      minCol = Math.floor(containerWidth / 12);
      
    if (minCol*3 >= 200) {
      jQuery('> .otw_blog_manager-iso-item', $this).each(function() {
        
        var $this = jQuery(this);
        if ($this.hasClass('otw_blog_manager-1-4')) {
          $this.css('width', minCol*3);
        } else if ($this.hasClass('otw_blog_manager-2-4') || $this.hasClass('otw_blog_manager-1-2')) {
          $this.css('width', minCol*6);
        } else if ($this.hasClass('otw_blog_manager-1-3')) {
          $this.css('width', minCol*4);
        } else if ($this.hasClass('otw_blog_manager-2-3')) {
          $this.css('width', minCol*8);
        }
      });

    } else if ( minCol*3 < 200 && minCol*3 > 150) {
      jQuery('> .otw_blog_manager-iso-item', $this).each(function() {
        
        var $this = jQuery(this);
        if ($this.hasClass('otw_blog_manager-1-4')) {
          $this.css('width', minCol*6);
        } else if ($this.hasClass('otw_blog_manager-2-4') || $this.hasClass('otw_blog_manager-1-2')) {
          $this.css('width', minCol*12);
        } else if ($this.hasClass('otw_blog_manager-1-3')) {
          $this.css('width', minCol*6);
        } else if ($this.hasClass('otw_blog_manager-2-3')) {
          $this.css('width', minCol*12);
        }
      });

    }  else if ( minCol*3 <= 150) {
      jQuery('> .otw_blog_manager-iso-item', $this).each(function() {
        jQuery(this).css('width', minCol*12);
      });
    }

    jQuery('> .otw_blog_manager-iso-item', $this).each(function() {

      if( (jQuery(this).hasClass('otw_blog_manager-1-2') || jQuery(this).hasClass('otw_blog_manager-2-3')) && jQuery(this).hasClass('height1')){
        jQuery(this).css('height', jQuery(this).outerWidth()/2);
        // jQuery(this).css('width', '-=1'); // Hack for spacing sincer margin-right: -1px is ignored
      } else if(jQuery(this).hasClass('height2')){
        jQuery(this).css('height', jQuery(this).outerWidth()*2);
      } else {
        jQuery(this).css('height', jQuery(this).outerWidth());
      }

      // console.log ( jQuery(this) );
      
      $imgWidth = jQuery(this).find('.otw_blog_manager-blog-media-wrapper').find('img').width();
      $imgHeight = jQuery(this).find('.otw_blog_manager-blog-media-wrapper').find('img').height();
      console.log ( jQuery(this).width(), jQuery(this).height() );
      console.log ( $imgWidth, $imgHeight );
      jQuery(this).find('.otw_blog_manager-blog-media-wrapper').css({'width': jQuery(this).width(), 'height': jQuery(this).height() });

      // if( $imgHeight > jQuery(this).height() ) {
      //   $heightDif = $imgHeight - jQuery(this).height();
      //   $negativeMove = $heightDif / 2;
      //   console.log( $negativeMove );
      //   jQuery(this).find('.otw_blog_manager-blog-media-wrapper').find('img').css({'margin-top': -$negativeMove});
      // }

    });
  });

}

function horizontal_layout(container){

  jQuery(container).each(function(){
    
    jQuery(this).css({'opacity': '0'});

    var $this = jQuery(this),
      container_width = jQuery(document).find('.otw_blog_manager-horizontal-layout-wrapper').width(),
      row = 1,
      item_margin = $this.find('.otw_blog_manager-blog-item-holder').data('item-margin'),
      cache_width = 0,
      height_items = [];

    $this.find('.otw_blog_manager-blog-item-holder').children('.otw_blog_manager-horizontal-item').each(function(){

      if( jQuery(this).attr('data-original-width') === undefined ){
        var $img = jQuery(this).find('.otw_blog_manager-blog-media-wrapper img');

        jQuery(this).attr({'data-original-width': $img.attr('width')});
        jQuery(this).attr({'data-original-height': $img.attr('height')});

        //remove image size
        $img.attr({'width': ''});
        $img.attr({'height': ''});

      }

      jQuery(this).css({'margin-right': ''});

      cache_width += ( jQuery(this).data('original-width') + item_margin );


      jQuery(this).attr({'data-row': row});

      if( cache_width >= container_width ){
        //new height = original height / original width x new width
        height_items.push( Math.floor(jQuery(this).data('original-height') / (cache_width - item_margin ) * container_width) );

        jQuery(this).css({'margin-right': '-5px'});

        cache_width = 0;
        row += 1;
      }
    });


    for (var i = 0; i < height_items.length; i++) {
      cache_width = 0;
      $this.find('.otw_blog_manager-blog-item-holder').children('.otw_blog_manager-horizontal-item[data-row="'+ (i + 1) +'"]').each(function($itemIndex){
        //new width = original wdith / original height x new height
        var new_width = Math.ceil( jQuery(this).data('original-width') / jQuery(this).data('original-height') * height_items[i] );

        cache_width += (new_width+4);
        
        if( cache_width >= container_width ) {
          new_width -= ( cache_width - container_width );
        }

        jQuery(this).find('.otw_blog_manager-blog-media-wrapper').css( {'width': new_width + 'px', 'height': parseInt(height_items[i]) });

      });
    }

    if( $this.find('.otw_blog_manager-blog-item-holder').children('.otw_blog_manager-horizontal-item[data-row="'+ row +'"]').length > 0 ){
      $this.find('.otw_blog_manager-blog-item-holder').children('.otw_blog_manager-horizontal-item[data-row="'+ row +'"]').each(function(){
        jQuery(this).find('.otw_blog_manager-blog-media-wrapper').css({'width': jQuery(this).data('original-width') + 'px', 'height': jQuery(this).data('original-height') });
      });

      $this.find('.otw_blog_manager-blog-item-holder').children('.otw_blog_manager-horizontal-item[data-row="'+ row +'"]:last-child').css({'margin-right': '0px'});
    }

    $this.css({'opacity': '1'});
  });
}

//Social shares
function otw_social_shares(){  

  jQuery('.otw_blog_manager-social-share-buttons-wrapper').each(function(){

    var $this = jQuery(this);
        title = jQuery(this).data('title'),
        description = jQuery(this).data('description'),
        image = jQuery(this).data('image'),
        postUrl = jQuery(this).data('url');

    jQuery.ajax({
      type: 'POST',
      url: socialShareURL,
      dataType: 'json',
      cache: false,
      data: { url: postUrl },
      success: function(data) {
        if(data.info !== 'error'){
          $this.find('.otw_blog-manager-social-share').each(function(){
            if(jQuery(this).hasClass('otw-facebook')){
              jQuery(this).append('<span class="data-shares">'+ data.facebook +'</span>');
              // jQuery(this).attr({'href': 'http://www.facebook.com/sharer.php?u='+ postUrl});
            } else if(jQuery(this).hasClass('otw-twitter')){
              jQuery(this).append('<span class="data-shares">'+ data.twitter +'</span>');
              // jQuery(this).attr({'href': 'https://twitter.com/intent/tweet?source=tweetbutton&text='+ escape(title) +'&url='+ encodeURIComponent(postUrl)});
            } else if(jQuery(this).hasClass('otw-google_plus')){
              jQuery(this).append('<span class="data-shares">'+ data.google_plus +'</span>');
              // jQuery(this).attr({'href': 'https://plus.google.com/share?url='+ postUrl});
            } else if(jQuery(this).hasClass('otw-linkedin')){
              jQuery(this).append('<span class="data-shares">'+ data.linkedin +'</span>');
              // jQuery(this).attr({'href': 'http://www.linkedin.com/shareArticle?mini=true&url='+ encodeURIComponent(postUrl) +'&title='+ escape(title) +'&summary='+ escape(description)});
            } else if(jQuery(this).hasClass('otw-pinterest')){
              jQuery(this).append('<span class="data-shares">'+ data.pinterest +'</span>');
              // jQuery(this).attr({'href': 'http://pinterest.com/pin/create/button/?url='+ encodeURIComponent(postUrl) +'&media='+ encodeURIComponent(image) +'&description='+ escape(description)});
            }
          });
        }
      }
    });

  });

  jQuery('.otw_blog_manager-social-wrapper').each(function(){
    var $this = jQuery(this);
        title = jQuery(this).data('title'),
        description = jQuery(this).data('description'),
        image = jQuery(this).data('image'),
        url = jQuery(this).data('url');

        

    jQuery(this).children('.otw_blog_manager-social-item').each(function(){
      if(jQuery(this).hasClass('otw-facebook')){
        jQuery(this).attr({'href': 'http://www.facebook.com/sharer.php?u='+ url});
      } else if(jQuery(this).hasClass('otw-twitter')){
        jQuery(this).attr({'href': 'https://twitter.com/intent/tweet?source=tweetbutton&url='+ encodeURIComponent(url) +'&text='+ escape(title)});
      } else if(jQuery(this).hasClass('otw-google_plus')){
        jQuery(this).attr({'href': 'https://plus.google.com/share?url='+ url});
      } else if(jQuery(this).hasClass('otw-linkedin')){
        jQuery(this).attr({'href': 'http://www.linkedin.com/shareArticle?mini=true&url='+ encodeURIComponent(url) +'&title='+ escape(title) +'&summary='+ escape(description)});
      } else if(jQuery(this).hasClass('otw-pinterest')){
        jQuery(this).attr({'href': 'http://pinterest.com/pin/create/button/?url='+ encodeURIComponent(url) +'&media='+ encodeURIComponent(image) +'&description='+ escape(description)});
      }
    });
  });

  update_social_stuff();

}


function update_social_stuff() {
  //Twitter
  
  jQuery.getScript("//platform.twitter.com/widgets.js");  
  
  // G+
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
}

function otw_responsive_videos() {
  jQuery('.otw_blog_manager-blog-media-wrapper').fitVids({ customSelector: "iframe[src*='soundcloud.com']"});
}