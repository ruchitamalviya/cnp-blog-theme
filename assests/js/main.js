jQuery(document).ready(function(){
  jQuery('.carousel').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay:false,
    autoplaySpeed: 2000,
    dots:true,
    prevArrow: false,
    nextArrow: false,
    centerMode: true,
    responsive: [{
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      }

    }, {
      breakpoint: 800,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        dots: true,
        infinite: true,

      }
    },  {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
      }
    }]
  });
  
  jQuery.fn.equalHeights = function(){
    let max_height = 0;
     jQuery(this).each(function(){
      max_height = Math.max($(this).height(), max_height);
    });

     jQuery(this).each(function(){
       jQuery(this).height(max_height);
    });
  };

  jQuery(document).ready(function(){
     jQuery('.equal_height').equalHeights();
  });

  jQuery(".clr-text").click(function(){
    jQuery(".search-field").val(" "); 
  });

  jQuery(".search_btn").click(function(){
    jQuery( ".search_input" ).show('slow');
    jQuery(".search_input").css('display','flex'); 
    jQuery( "#search_text" ).focus();
    jQuery(".search_input").css('transition','opacity .2s,min-width .4s');
     
  });

  jQuery('body > *').click(function(e){

    if ( jQuery(e.target).closest('.search_box_main').length )
        return false;

    jQuery(".search_input").hide();
  });

  let page = 2;
  jQuery('body').on('click', '.btn_see_more', function() {  
    jQuery(".btn_see_more").prop("disabled",true);
    let data = {
        'action': 'load_posts_by_ajax',
        'page': page,
        'security': see_more_post.security
    };

    jQuery.get(see_more_post.ajaxurl, data, function(response) {
      let responseObj = JSON.parse(response);
      if ( responseObj.success == 1 ) {
        jQuery(".btn_see_more").prop("disabled",false);
        if(jQuery.trim(responseObj.posts) != '') {
              jQuery('.card_section_3').append(responseObj.posts);
              page++;

        }

        if ( !responseObj.has_next_page ) {
          jQuery(".btn_see_more").hide();
        }
      } else {
        alert("Sorry! an error occurred.");
      }
    });
  });

  jQuery("#search_posts").click(function(e){
    e.preventDefault();
    let searchField = jQuery("#search-field").val();
    let data = {
          'action': 'load_search_results',
          'searchField': searchField
    };

    jQuery.get(see_more_post.ajaxurl, data, function(response) {
         let responseObj = JSON.parse(response);
        jQuery('.rs').html(responseObj.search_posts); 
    });
  }); 

  let resultPage = 2;
  jQuery('body').on('click', '.btn_see_more_search', function() { 
    jQuery(".btn_see_more_search").prop("disabled",true);
    let searchField = jQuery("#search-field").val();
    let data = {
      'action': 'load_serach_posts_by_ajax',
      'resultPage': resultPage,
      'searchField':searchField,
      'security': see_more_post.security
    };

    jQuery.get(see_more_post.ajaxurl, data, function(response) {
      let responseObject = JSON.parse(response);
      if ( responseObject.success == 1 ) {
        jQuery(".btn_see_more_search").prop("disabled",false);
        if(jQuery.trim(responseObject.loadposts) != '') {
          jQuery('.card_section_3').append(responseObject.loadposts);
             resultPage++;
        }

        if ( !responseObject.has_next_page ) {
          jQuery(".btn_see_more_search").hide();
        }
        
      } else {
        alert("Sorry! an error occurred.");
      }
    });
  });
  function updateQueryString(key, value) {
    if (history.pushState) {
        let searchParams = new URLSearchParams(window.location.search);
        searchParams.set(key, value);
        let newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + searchParams.toString();
        window.history.pushState({path: newurl}, '', newurl);
    }
  }
   
  jQuery("#search-field").change(function(){
    updateQueryString('q',jQuery(this).val());
  }); 
  
});

document.getElementById('menu-toggle')
.addEventListener('click', function(){
  document.body.classList.toggle('nav-open');
});


 