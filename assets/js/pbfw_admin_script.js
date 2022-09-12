//jquery tab
jQuery(document).ready(function() {
    //slider setting options by tabbing
    jQuery('ul.nav-tab-wrapper li').click(function(){
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('ul.nav-tab-wrapper li').removeClass('nav-tab-active');
        jQuery('.tab-content').removeClass('current');
        jQuery(this).addClass('nav-tab-active');
        jQuery("#"+tab_id).addClass('current');
    });

    jQuery('#pbfw_select_product').select2({
  	    ajax: {
			url: ajaxurl,
			dataType: 'json',
			allowClear: true,
			data: function (params) {
				return {
    				q: params.term,
    				action: 'pbfw_product_ajax'
  				};
  			},
			processResults: function( data ) {
				var options = [];
				if ( data ) {
 					jQuery.each( data, function( index, text ) { 
						options.push( { id: text[0], text: text[1], 'price': text[2]} );
					});
 				}
				return {
					results: options
				};
			},
			cache: true
		},
		minimumInputLength: 3
	});

    var pro_con = jQuery('.pbfw_pro_condition').find(":selected").val();
    if(pro_con == "") {
    	jQuery('.pbfw_price_div').hide();
    	jQuery('.pbfw_category_div').hide();
    	jQuery('.pbfw_tag_div').hide();
    	jQuery('.pbfw_onsale_div').hide();
    	jQuery('.pbfw_product_div').hide();
    }
    if(pro_con == "all_products") {
    	jQuery('.pbfw_price_div').hide();
    	jQuery('.pbfw_category_div').hide();
    	jQuery('.pbfw_tag_div').hide();
    	jQuery('.pbfw_onsale_div').hide();
    	jQuery('.pbfw_product_div').hide();
    }
    if(pro_con == "selected_products") {
    	jQuery('.pbfw_product_div').show();
    	jQuery('.pbfw_price_div').hide();
    	jQuery('.pbfw_category_div').hide();
    	jQuery('.pbfw_tag_div').hide();
    	jQuery('.pbfw_onsale_div').hide();
    }
    if(pro_con == "price") {
    	jQuery('.pbfw_price_div').show();
    	jQuery('.pbfw_category_div').hide();
    	jQuery('.pbfw_tag_div').hide();
    	jQuery('.pbfw_onsale_div').hide();
    	jQuery('.pbfw_product_div').hide();
    }
    if(pro_con == "category") {
    	jQuery('.pbfw_category_div').show();
    	jQuery('.pbfw_price_div').hide();
    	jQuery('.pbfw_tag_div').hide();
    	jQuery('.pbfw_onsale_div').hide();
    	jQuery('.pbfw_product_div').hide();
    }
    if(pro_con == "tag") {
    	jQuery('.pbfw_tag_div').show();
    	jQuery('.pbfw_category_div').hide();
    	jQuery('.pbfw_price_div').hide();
    	jQuery('.pbfw_onsale_div').hide();
    	jQuery('.pbfw_product_div').hide();
    }
    if(pro_con == "onsale") {
    	jQuery('.pbfw_onsale_div').show();
    	jQuery('.pbfw_tag_div').hide();
    	jQuery('.pbfw_category_div').hide();
    	jQuery('.pbfw_price_div').hide();
    	jQuery('.pbfw_product_div').hide();
    }


    var price_con = jQuery('.pbfw_price_condition').find(":selected").val();
    if(price_con == "between") {
    	jQuery('.pbfw_price_between_div').show();
    	jQuery('.pbfw_price_single_div').hide();
    }
    if(price_con == "lessthan") {
    	jQuery('.pbfw_price_single_div').show();
    	jQuery('.pbfw_price_between_div').hide();
    }
    if(price_con == "greaterthan") {
    	jQuery('.pbfw_price_single_div').show();
    	jQuery('.pbfw_price_between_div').hide();
    }

	jQuery('.pbfw_pro_condition').change(function() {
	    var option = jQuery(this).find('option:selected');
	    var val = option.val();

	   	if(val == "") {
	    	jQuery('.pbfw_price_div').hide();
	    	jQuery('.pbfw_category_div').hide();
	    	jQuery('.pbfw_tag_div').hide();
	    	jQuery('.pbfw_onsale_div').hide();
	    	jQuery('.pbfw_product_div').hide();
	    }
	    if(val == "all_products") {
	    	jQuery('.pbfw_price_div').hide();
	    	jQuery('.pbfw_category_div').hide();
	    	jQuery('.pbfw_tag_div').hide();
	    	jQuery('.pbfw_onsale_div').hide();
	    	jQuery('.pbfw_product_div').hide();
	    }
	    if(val == "selected_products") {
	    	jQuery('.pbfw_product_div').show();
	    	jQuery('.pbfw_price_div').hide();
	    	jQuery('.pbfw_category_div').hide();
	    	jQuery('.pbfw_tag_div').hide();
	    	jQuery('.pbfw_onsale_div').hide();
	    }
	    if(val == "price") {
	    	jQuery('.pbfw_price_div').show();
	    	jQuery('.pbfw_category_div').hide();
	    	jQuery('.pbfw_tag_div').hide();
	    	jQuery('.pbfw_onsale_div').hide();
	    	jQuery('.pbfw_product_div').hide();
	    }
	    if(val == "category") {
	    	jQuery('.pbfw_category_div').show();
	    	jQuery('.pbfw_price_div').hide();
	    	jQuery('.pbfw_tag_div').hide();
	    	jQuery('.pbfw_onsale_div').hide();
	    	jQuery('.pbfw_product_div').hide();
	    }
	    if(val == "tag") {
	    	jQuery('.pbfw_tag_div').show();
	    	jQuery('.pbfw_category_div').hide();
	    	jQuery('.pbfw_price_div').hide();
	    	jQuery('.pbfw_onsale_div').hide();
	    	jQuery('.pbfw_product_div').hide();
	    }
	    if(val == "onsale") {
	    	jQuery('.pbfw_onsale_div').show();
	    	jQuery('.pbfw_tag_div').hide();
	    	jQuery('.pbfw_category_div').hide();
	    	jQuery('.pbfw_price_div').hide();
	    	jQuery('.pbfw_product_div').hide();
	    }
	    
	});



	jQuery('.pbfw_price_condition').change(function() {
	    var option = jQuery(this).find('option:selected');
	    var val = option.val();

	    if(val == "between") {
	    	jQuery('.pbfw_price_between_div').show();
	    	jQuery('.pbfw_price_single_div').hide();
	    }
	    if(val == "lessthan") {
	    	jQuery('.pbfw_price_single_div').show();
	    	jQuery('.pbfw_price_between_div').hide();
	    }	    
	    if(val == "greaterthan") {
	    	jQuery('.pbfw_price_single_div').show();
	    	jQuery('.pbfw_price_between_div').hide();
	    }
	});

        if(pbfwDATA.badge_define == "or_text_badge" || pbfwDATA.badge_define == ""){
               jQuery("#tab-image").hide(); 
       			jQuery("#tab-text").show(); 
        }else{
                jQuery("#tab-image").show();
         		jQuery("#tab-text").hide();
        }
        if(pbfwDATA.pbfw_background == "or_badge_image" || pbfwDATA.pbfw_background == ""){
               	jQuery(".pbfw_back_badge").show();
         		jQuery(".pbfw_back_img_class").hide();
        }else{
                jQuery(".pbfw_back_badge").hide(); 
       			jQuery(".pbfw_back_img_class").show(); 
        }

	jQuery('.radioBtnClass_badge').click(function(){

		var radioValue = jQuery("input[name='pbfw_background']:checked").val();

        	if(radioValue == "or_badge_image"){
         		jQuery(".pbfw_back_badge").show();
         		jQuery(".pbfw_back_img_class").hide();
       		}else{
       			jQuery(".pbfw_back_badge").hide(); 
       			jQuery(".pbfw_back_img_class").show(); 
       		}

	});

	jQuery("input[name='badge_define']:checked").closest('li').addClass('active');

	jQuery('.badge_define').click(function(){
		var radioValue = jQuery("input[name='badge_define']:checked").val();
		jQuery("li.tab-link").removeClass('active');
        	if(radioValue == "or_text_badge"){
        		jQuery(this).closest('li').addClass('active');
        		jQuery("#tab-image").hide(); 
       			jQuery("#tab-text").show(); 
       		}else{
       			jQuery(this).closest('li').addClass('active');
       			jQuery("#tab-image").show();
         		jQuery("#tab-text").hide();
       		}
	});

	if(pbfwDATA.pbfw_image_position == "custom_position"){
		jQuery(".custom_position").css('display','inline-block'); 	
	}
	jQuery('.pbfw_image_position').on('change', function() {
	  	if(this.value == "custom_position"){
	  		jQuery(".custom_position").css('display','inline-block'); 
	  	}else{
	  		jQuery(".custom_position").css('display','none');	  		
	  	}
	});
})

