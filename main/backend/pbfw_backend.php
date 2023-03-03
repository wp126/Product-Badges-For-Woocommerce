<?php

if (!defined('ABSPATH')){
    exit;
}

add_action('init',  'PBFW_create_custpost');
function PBFW_create_custpost() {
    $post_type = 'pbfw_product_badges';
    $singular_name = 'Product Badge';
    $plural_name = 'Product Badges';
    $slug = 'pbfw_product_badges';
    $labels = array(
        'name'               => _x( $plural_name, 'post type general name', 'product-badges-for-woocommerce' ),
        'singular_name'      => _x( $singular_name, 'post type singular name', 'product-badges-for-woocommerce' ),
        'menu_name'          => _x( $singular_name, 'admin menu name', 'product-badges-for-woocommerce' ),
        'name_admin_bar'     => _x( $singular_name, 'add new name on admin bar', 'product-badges-for-woocommerce' ),
        'add_new'            => __( 'Add New', 'product-badges-for-woocommerce' ),
        'add_new_item'       => __( 'Add New '.$singular_name, 'product-badges-for-woocommerce' ),
        'new_item'           => __( 'New '.$singular_name, 'product-badges-for-woocommerce' ),
        'edit_item'          => __( 'Edit '.$singular_name, 'product-badges-for-woocommerce' ),
        'view_item'          => __( 'View '.$singular_name, 'product-badges-for-woocommerce' ),
        'all_items'          => __( 'All '.$plural_name, 'product-badges-for-woocommerce' ),
        'search_items'       => __( 'Search '.$plural_name, 'product-badges-for-woocommerce' ),
        'parent_item_colon'  => __( 'Parent '.$plural_name.':', 'product-badges-for-woocommerce' ),
        'not_found'          => __( 'No Table found.', 'product-badges-for-woocommerce' ),
        'not_found_in_trash' => __( 'No Table found in Trash.', 'product-badges-for-woocommerce' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'product-badges-for-woocommerce' ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => $slug ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title' ),
        'menu_icon'          => 'dashicons-awards'
    );
    register_post_type( $post_type, $args );
}

add_action('add_meta_boxes',  'PBFW_add_meta_box');
function PBFW_add_meta_box() {
    add_meta_box(
        'PBFW_metabox',
        __( 'Label Settings', 'product-badges-for-woocommerce' ),
        'PBFW_metabox_cb',
        'pbfw_product_badges',
        'normal'
    );
}

function PBFW_metabox_cb( $post ) {
    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'PBFW_meta_save', 'PBFW_meta_save_nounce' );
    ?> 
    <div class="pbfw_container">
        <div id="poststuff">
            <ul class="nav-tab-wrapper woo-nav-tab-wrapper">
                <li class="nav-tab nav-tab-active" data-tab="tab-default">
                    <?php echo __( 'Default Settings', 'product-badges-for-woocommerce' );?>
                </li>
                <li class="nav-tab" data-tab="tab-data">
                    <?php echo __( 'Label Design', 'product-badges-for-woocommerce' );?>
                </li>
                <li class="nav-tab" data-tab="tab-general">
                    <?php echo __( 'Product Settings', 'product-badges-for-woocommerce' );?>
                </li>
            </ul>
            <div id="tab-default" class="tab-content current">
                <div class="postbox">
                    <div class="postbox-header">
                        <h2><?php echo __( 'Default Settings', 'product-badges-for-woocommerce' ); ?></h2>
                    </div>
                    <div class="inside">
                        <table class="pbfw_table_section_main">
                            <tr>
                                <th>
                                    <?php echo __( 'Show Label', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                    <?php
                                    $lbl = get_post_meta($post->ID, 'pbfw_show_label', true);

                                    if( $lbl == '') {
                                        $lbl = 'on';
                                    }
                                    ?>
                                    <input type="checkbox" name="pbfw_show_label" <?php if($lbl == "on") { echo "checked"; } ?>>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <?php echo __( 'Badge Position', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                    <?php $bagde_position = get_post_meta($post->ID,'pbfw_image_position',true); ?>
                                    <select class="pbfw_image_position regular-text" name="pbfw_image_position">
                                        <option value="top_left" <?php if($bagde_position == "top_left") { echo "selected"; } ?>><?php echo __( 'Top-left', 'product-badges-for-woocommerce' );?></option>
                                        <option value="top_right" <?php if($bagde_position == "top_right") { echo "selected"; } ?>><?php echo __( 'Top-Right', 'product-badges-for-woocommerce' );?></option>
                                        <option value="bottom_left" <?php if($bagde_position == "bottom_left") { echo "selected"; } ?>><?php echo __( 'Bottom-left', 'product-badges-for-woocommerce' );?></option>
                                        <option value="bottom_right" <?php if($bagde_position == "bottom_right") { echo "selected"; } ?>><?php echo __( 'Bottom-right', 'product-badges-for-woocommerce' );?></option>
                                        <option value="custom_position" <?php if($bagde_position == "custom_position") { echo "selected"; } ?>><?php echo __( 'Custom Position', 'product-badges-for-woocommerce' );?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="custom_position">
                                <th></th>
                                <td>
                                    <?php
                                    $top = get_post_meta($post->ID, 'pbfw_top', true); 
                                    $left = get_post_meta($post->ID, 'pbfw_left', true); 
                                    $right = get_post_meta($post->ID, 'pbfw_right', true); 
                                    $bottom = get_post_meta($post->ID, 'pbfw_bottom', true); 

                                    if(empty($left)) {
                                        $left = "-20";
                                    } else {
                                        $left = $left;
                                    }

                                    if(empty($right)) {
                                        $right = "0";
                                    } else {
                                        $right = $right;
                                    }

                                    if(empty($top)) {
                                        $top = "-20";
                                    } else {
                                        $top = $top;
                                    }

                                    if(empty($bottom)) {
                                        $bottom = "0";
                                    } else {
                                        $bottom = $bottom;
                                    }                                        
                                    ?>
                                    <label><?php echo __( 'Left', 'product-badges-for-woocommerce' );?></label>
                                    <input type="number" class="regular-text" name="pbfw_left" value="<?php echo esc_attr($left); ?>">
                                    <label><?php echo __( 'Right', 'product-badges-for-woocommerce' );?></label> 
                                    <input type="number" class="regular-text" name="pbfw_right" value="<?php echo esc_attr($right); ?>">
                                    <label><?php echo __( 'Top', 'product-badges-for-woocommerce' );?></label>
                                    <input type="number" class="regular-text" name="pbfw_top" value="<?php echo esc_attr($top); ?>">
                                    <label><?php echo __( 'Bottom', 'product-badges-for-woocommerce' );?></label>
                                    <input type="number" class="regular-text" name="pbfw_bottom" value="<?php echo esc_attr($bottom); ?>">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <?php echo __( 'Show Label Single product page', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                    <?php
                                    // $pbfw_show_label_single_pro = get_post_meta($post->ID, 'pbfw_show_label_single_pro', true);
                                    // if( $pbfw_show_label_single_pro == '') {
                                    //     $pbfw_show_label_single_pro = 'on';
                                    // }
                                    ?>
                                    <input type="checkbox" name="pbfw_show_label_single_pro"  disabled>
                                    <label class="IBFW_pro_link"><?php echo __( 'This Option Available in ', 'product-badges-for-woocommerce' );?><a href="https://www.plugin999.com/plugin/product-badges-for-woocommerce/" target="_blank"><?php echo __( 'Pro Version', 'product-badges-for-woocommerce' );?></a></label>
                                </td>
                            </tr>
                        </table>  
                    </div> 
                </div>
            </div>
            <div id="tab-data" class="tab-content">
                <div class="pbfw_inner_container">
                    <ul class="pbfw_inner_tabs">
                        <li class="tab-link" data-tab="tab-text">
                            <input type="radio" id="or_text_badge" class="badge_define" name="badge_define" value="or_text_badge" <?php if(empty(get_post_meta($post->ID,'badge_define',true ))||get_post_meta( $post->ID,'badge_define',true )=="or_text_badge"){ echo "checked=checked"; } ?>><label for="or_text_badge"><?php echo __( 'Text Badge', 'product-badges-for-woocommerce' );?></label>
                            <?php //echo __( 'Text Badge', 'product-badges-for-woocommerce' );?>
                        </li>
                        <li class="tab-link" data-tab="tab-image">
                            <input type="radio" id="or_image_badge" class="badge_define" name="badge_define" value="or_image_badge" <?php if(get_post_meta( $post->ID , 'badge_define',true )=="or_image_badge"){ echo "checked=checked"; } ?>><label for="or_image_badge"><?php echo __( 'Image Badge', 'product-badges-for-woocommerce' );?></label>
                        </li> 
                    </ul>
                    <div id="tab-text" class="tab-contentt">
                        <div class="postbox">
                            <div class="postbox-header">
                                <h2><?php echo __( 'Text Badge Settings', 'product-badges-for-woocommerce' ); ?></h2>
                            </div>
                            <div class="inside">
                                <table class="pbfw_table_section_main">
                                    <tr>
                                        <th>
                                            <?php echo __( 'Discount Text', 'product-badges-for-woocommerce' );?>
                                        </th>
                                        <td>
                                            <?php 
                                            $pbfw_discount_text = get_post_meta($post->ID,'pbfw_discount_text',true);
                                            if(empty($pbfw_discount_text)) {
                                                $pbfw_discount_text = "Sale";
                                            } else {
                                                $pbfw_discount_text = $pbfw_discount_text;
                                            }
                                            ?>
                                            <input type="text" class="regular-text" name="pbfw_discount_text" value="<?php echo esc_attr($pbfw_discount_text); ?>">
                                            <span class="pbfw_desc"><?php echo __( 'Use the <strong>&lt;br&gt;</strong> tag to enter line breaks between words.', 'product-badges-for-woocommerce' );?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <?php echo __( 'Label Font Color', 'product-badges-for-woocommerce' );?>
                                        </th>
                                        <td>
                                            <?php
                                            $pbfw_font_clr = get_post_meta( $post->ID, 'pbfw_font_clr', true);
                                            if($pbfw_font_clr == '') {
                                                $pbfw_font_clr = '#ffffff';
                                            }
                                            ?>
                                            <input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo esc_attr($pbfw_font_clr); ?>" name="pbfw_font_clr" value="<?php echo esc_attr($pbfw_font_clr); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <?php echo __( 'Background Color', 'product-badges-for-woocommerce' );?>
                                        </th>
                                        <td>
                                            <?php
                                            $pbfw_bg_clr = get_post_meta( $post->ID, 'pbfw_bg_clr', true);
                                            if($pbfw_bg_clr == '') {
                                                $pbfw_bg_clr = '#000000';
                                            }
                                            ?>
                                            <input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo esc_attr($pbfw_bg_clr); ?>" name="pbfw_bg_clr" value="<?php echo esc_attr($pbfw_bg_clr); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <?php echo __( 'Font Size', 'product-badges-for-woocommerce' );?>
                                        </th>
                                        <td>
                                            <?php 
                                            $pbfw_ft_size = get_post_meta($post->ID,'pbfw_ft_size',true); 
                                            if(empty($pbfw_ft_size)) {
                                                $ft_size = "12";
                                            } else {
                                                $ft_size = $pbfw_ft_size;
                                            }
                                            ?>
                                            <input type="number" class="regular-text" name="pbfw_ft_size" value="<?php echo esc_attr($ft_size); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <?php echo __( 'Label Shape', 'product-badges-for-woocommerce' );?>
                                        </th>
                                        <td>
                                            <?php $shape = get_post_meta($post->ID, 'pbfw_lbl_shape', true); ?>
                                            <label class="layersMenu">
                                                <input type="radio" name="pbfw_lbl_shape" value="square" <?php if($shape == "square" || empty($shape)){ echo "checked"; }?> />
                                                <div class="pbfw_square_data">
                                                    <div class="pbfw_square"></div>
                                                </div>
                                            </label>

                                            <label class="layersMenu">
                                                <input type="radio" name="pbfw_lbl_shape" value="rectangle" <?php if($shape == "rectangle"){ echo "checked"; }?>/>
                                                <div class="pbfw_square_data">
                                                    <div class="pbfw_rectangle"></div>
                                                </div>
                                            </label>

                                            <label class="layersMenu">
                                                <input type="radio" name="pbfw_lbl_shape" value="rectangle_up" <?php if($shape == "rectangle_up"){ echo "checked"; }?>/>
                                                <div class="pbfw_square_data">
                                                    <div class="pbfw_rectangle_up"></div>
                                                </div>
                                            </label>
                                            <label class="layersMenu">
                                                <input type="radio" name="pbfw_lbl_shape" value="offers" <?php if($shape == "offers"){ echo "checked"; }?>/>
                                                <div class="pbfw_square_data">
                                                    <div class="pbfw_offers">
                                                        <i style="background-color:#dac6c8; border-color:#dac6c8;" class="template-i "></i>            
                                                        <i style="background-color:#dac6c8; border-color:#dac6c8;" class="template-i-before "></i>
                                                    </div>
                                                </div>
                                            </label>

                                            <label class="layersMenu">
                                                <input type="radio" name="pbfw_lbl_shape" value="tag" <?php if($shape == "tag"){ echo "checked"; }?>/>
                                                <div class="pbfw_square_data">
                                                    <div class="pbfw_tag">
                                                        <i style="background-color:#8aaae5; border-color:#8aaae5;" class="template-span-before "></i>
                                                    </div>
                                                </div>
                                            </label>

                                            <label class="layersMenu">
                                                <input type="radio" name="pbfw_lbl_shape" value="collar" <?php if($shape == "collar"){ echo "checked"; }?>/>
                                                <div class="pbfw_square_data">
                                                    <div class="pbfw_collar">
                                                        <i style="background-color:#295f2d; border-color:#295f2d;" class="template-span-before "></i>
                                                        <i style="background-color:#295f2d; border-color:#295f2d;" class="template-i-after "></i>
                                                    </div>
                                                </div>
                                            </label>

                                            <label class="layersMenu">
                                                <input type="radio" name="pbfw_lbl_shape" value="rectangle_round" <?php if($shape == "rectangle_round") { echo "checked"; } ?>/>
                                                <div class="pbfw_square_data">
                                                    <div class="pbfw_rectangle_round">
                                                    </div>
                                                </div>
                                            </label>

                                            <label class="layersMenu">
                                                <input type="radio" name="pbfw_lbl_shape" value="rectangle_circle" <?php if($shape == "rectangle_circle") { echo "checked"; } ?>/>
                                                <div class="pbfw_square_data">
                                                    <div class="pbfw_rectangle_circle">
                                                    </div>
                                                </div>
                                            </label>

                                            <label class="layersMenu">
                                                <input type="radio" name="pbfw_lbl_shape" value="circle" <?php if($shape == "circle") { echo "checked"; }?> />
                                                <div class="pbfw_square_data">
                                                    <div class="pbfw_circle">
                                                    </div>
                                                </div>
                                            </label>

                                            <label class="layersMenu">
                                                <input type="radio" name="pbfw_lbl_shape" value="corner_badge" <?php if($shape == "corner_badge"){ echo "checked"; }?>/>
                                                <div class="pbfw_square_data">
                                                    <div class="pbfw_corner_badge">
                                                        <i style="background-color:#adf0d1; border-color:#adf0d1;" class="template-i-before "></i>
                                                        <i class="template-i-after "></i>
                                                    </div>
                                                </div>
                                            </label>
                                        </td>
                                    </tr>
                                </table>  
                            </div> 
                        </div>
                    </div>
                    <div id="tab-image" class="tab-contentt">
                        <div class="postbox">
                            <div class="postbox-header">
                                <h2><?php echo __( 'Image Badge Settings', 'product-badges-for-woocommerce' ); ?></h2>
                            </div>
                            <div class="inside">
                                <table class="pbfw_table_section_main">
                                    <tr>
                                        <th>
                                            <?php echo __( 'Image Badge select', 'product-badges-for-woocommerce' );?>
                                        </th>
                                        <td>
                                            <input type="radio" class="radioBtnClass_badge" name="pbfw_background" value="or_badge_image" <?php if(empty(get_post_meta($post->ID, 'pbfw_background' ,true ))|| get_post_meta( $post->ID , 'pbfw_background',true )=="or_badge_image"){ echo "checked=checked"; } ?>><lable><strong><?php echo __( 'Badge Select', 'product-badges-for-woocommerce' );?></strong></lable>

                                            <input type="radio" class="radioBtnClass_badge" name="pbfw_background" value="or_badge_image_upload" <?php if(get_post_meta( $post->ID,'pbfw_background',true )=="or_badge_image_upload"){ echo "checked=checked"; } ?>><lable><strong><?php echo __( 'Custom Badge Add', 'product-badges-for-woocommerce' );?></strong></lable>
                                        </td>
                                    </tr>
                                    <tr class="pbfw_back_badge">
                                        <th>
                                        </th>
                                        <td>
                                            <input type="radio" name="image_badge" value="badge.png" <?php if(empty(get_post_meta($post->ID, 'image_badge' ,true ))|| get_post_meta( $post->ID , 'image_badge',true )=="badge.png"){ echo "checked=checked"; } ?>>
                                            <label>
                                               <img src="<?php echo PBFW_PLUGIN_DIR; ?>/assets/img/badge.png" class="pbfw_badge">
                                            </label>
                                              <input type="radio" name="image_badge" value="badge1.png"  <?php if(get_post_meta( $post->ID,'image_badge',true )=="badge1.png"){ echo "checked=checked"; } ?>>
                                            <label>
                                               <img src="<?php echo PBFW_PLUGIN_DIR; ?>/assets/img/badge1.png" class="pbfw_badge">
                                            </label>
                                            <input type="radio" name="image_badge" value="badge2.png" <?php if(get_post_meta( $post->ID,'image_badge',true )=="badge2.png"){ echo "checked=checked"; } ?>>
                                            <label>
                                               <img src="<?php echo PBFW_PLUGIN_DIR; ?>/assets/img/badge2.png" class="pbfw_badge">
                                            </label>
                                            <input type="radio" name="image_badge" value="badge3.png" <?php if(get_post_meta( $post->ID,'image_badge',true )=="badge3.png"){ echo "checked=checked"; } ?>>
                                            <label>
                                               <img src="<?php echo PBFW_PLUGIN_DIR; ?>/assets/img/badge3.png" class="pbfw_badge">
                                            </label>
                                        </td>
                                    </tr>
                                    <tr class="pbfw_back_img_class">
                                        <th>
                                        </th>
                                        <td>
                                            <?php  
                                                echo PBFW_image_uploader_field('ocor_bg_img_form',get_post_meta( $post->ID, 'ocor_bg_img_form', true) );
                                            ?>
                                        </td>
                                    </tr>
                                </table>  
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-general" class="tab-content">
                <div class="postbox">
                    <div class="postbox-header">
                        <h2><?php echo __( 'Product Settings', 'product-badges-for-woocommerce' ); ?></h2>
                    </div>
                    <div class="inside">
                        <table class="pbfw_table_section_main">
                            <tr>
                                <th>
                                    <?php echo __( 'Condition', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                    <?php $pro_con = get_post_meta($post->ID,'pbfw_pro_condition',true); ?>
                                    <select class="pbfw_pro_condition regular-text" name="pbfw_pro_condition">
                                        <option value=""><?php echo __( 'Select Option', 'product-badges-for-woocommerce' );?></option>
                                        <option value="all_products" <?php if($pro_con == "all_products") { echo "selected"; } ?>><?php echo __( 'All Products', 'product-badges-for-woocommerce' );?></option>
                                        <option value="selected_products" <?php if($pro_con == "selected_products") { echo "selected"; } ?>><?php echo __( 'Selected Products', 'product-badges-for-woocommerce' );?></option>
                                        <option value="price" <?php if($pro_con == "price") { echo "selected"; } ?>><?php echo __( 'Price', 'product-badges-for-woocommerce' );?></option>
                                        <option value="category" <?php if($pro_con == "category") { echo "selected"; } ?>><?php echo __( 'Category', 'product-badges-for-woocommerce' );?></option>
                                        <option value="tag" <?php if($pro_con == "tag") { echo "selected"; } ?>><?php echo __( 'Tag', 'product-badges-for-woocommerce' );?></option>
                                        <option value="onsale" <?php if($pro_con == "onsale") { echo "selected"; } ?>><?php echo __( 'On Sale', 'product-badges-for-woocommerce' );?></option>
                                    </select>
                                </td>
                            </tr>
                        </table>  
                    </div> 
                </div>
                <div class="postbox pbfw_price_div" style="display: none;">
                    <div class="postbox-header">
                        <h2><?php echo __( 'Price Rule', 'product-badges-for-woocommerce' );?></h2>
                    </div>
                    <div class="inside">
                        <table class="pbfw_table_section_main">
                            <tr>
                                <th>
                                    <?php echo __( 'Price', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                    
                                    <select class="pbfw_price_condition regular-text" name="pbfw_price_condition" disabled>
                                        <option value="between" ><?php echo __( 'Between', 'product-badges-for-woocommerce' );?></option>
                                        <option value="lessthan" ><?php echo __( 'Less than', 'product-badges-for-woocommerce' );?></option>
                                        <option value="greaterthan"><?php echo __( 'Greater than', 'product-badges-for-woocommerce' );?></option>
                                    </select>
                                     <label class="IBFW_pro_link"><?php echo __( 'This Option Available in ', 'product-badges-for-woocommerce' );?><a href="https://www.plugin999.com/plugin/product-badges-for-woocommerce/" target="_blank"><?php echo __( 'Pro Version', 'product-badges-for-woocommerce' );?></a></label>
                                </td>
                            </tr>
                            <tr class="pbfw_price_between_div">
                                <th>
                                    <?php echo __( 'Minimum Price', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                   
                                    <input type="number" class="regular-text" name="pbfw_bet1" value="" disabled>
                                     <label class="IBFW_pro_link"><?php echo __( 'This Option Available in ', 'product-badges-for-woocommerce' );?><a href="https://www.plugin999.com/plugin/product-badges-for-woocommerce/" target="_blank"><?php echo __( 'Pro Version', 'product-badges-for-woocommerce' );?></a></label>
                                </td>
                            </tr>
                            <tr class="pbfw_price_between_div">
                                <th>
                                    <?php echo __( 'Maximum Price', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                   
                                    <input type="number" class="regular-text" name="pbfw_bet2" value="" disabled>
                                     <label class="IBFW_pro_link"><?php echo __( 'This Option Available in ', 'product-badges-for-woocommerce' );?><a href="https://www.plugin999.com/plugin/product-badges-for-woocommerce/" target="_blank"><?php echo __( 'Pro Version', 'product-badges-for-woocommerce' );?></a></label>
                                </td>
                            </tr>
                            <tr class="pbfw_price_single_div">
                                <th>
                                    <?php echo __( 'Conditional Price', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                   
                                    <input type="number" class="regular-text" name="pbfw_price" value="" disabled> <label class="IBFW_pro_link"><?php echo __( 'This Option Available in ', 'product-badges-for-woocommerce' );?><a href="https://www.plugin999.com/plugin/product-badges-for-woocommerce/" target="_blank"><?php echo __( 'Pro Version', 'product-badges-for-woocommerce' );?></a></label>
                                </td>
                            </tr>
                        </table>  
                    </div> 
                </div>
                <div class="postbox pbfw_product_div" style="display: none;">
                    <div class="postbox-header">
                        <h2><?php echo __( 'Product Rule', 'product-badges-for-woocommerce' );?></h2>
                    </div>
                    <div class="inside">
                        <table class="pbfw_table_section_main">
                            <tr>
                                <th>
                                    <?php echo __( 'Products', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                    <select id="pbfw_select_product" name="pbfw_select2[]" multiple="multiple" style="width:100%;">
                                        <?php $productsa = get_post_meta($post->ID,'pbfw_combo',true);
                                        if(!empty($productsa)) {
                                            foreach ($productsa as $value) {
                                                $productc = wc_get_product($value);
                                                if ( $productc && $productc->is_in_stock() && $productc->is_purchasable() ) {
                                                        $title = $productc->get_name();?>
                                                        <option value="<?php echo esc_attr($value); ?>" selected="selected"><?php echo esc_html($title); ?></option>
                                                    <?php
                                                }
                                            }
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                        </table>  
                    </div> 
                </div>
                <div class="postbox pbfw_category_div" style="display: none;">
                    <div class="postbox-header">
                        <h2><?php echo __( 'Category Rule', 'product-badges-for-woocommerce' );?></h2>
                    </div>
                    <div class="inside">
                        <table class="pbfw_table_section_main">
                            <tr>
                                <th>
                                    <?php echo __( 'Categories', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                    <?php
                                        $orderby = 'name';
                                        $order = 'asc';
                                        $hide_empty = false;
                                        $cat_args = array(
                                            'orderby'    => $orderby,
                                            'order'      => $order,
                                            'hide_empty' => $hide_empty,
                                        );
                                        $pbfw_categories = get_terms( 'product_cat', $cat_args );
                                        $category = get_post_meta($post->ID,'pbfw_cat',true);
                                        foreach( $pbfw_categories as $pbfw_category ) {
                                            ?>
                                            <div class="pbfw_catlist">
                                                <input type="checkbox" name="pbfw_cat[]" value="<?php echo esc_attr($pbfw_category->term_id);?>" disabled>
                                                <label><?php echo esc_attr($pbfw_category->name);?></label>
                                        
                                            </div>
                                            <?php 
                                        } 
                                    ?>  
                                    <label class="IBFW_pro_link"><?php echo __( 'This Option Available in ', 'product-badges-for-woocommerce' );?><a href="https://www.plugin999.com/plugin/product-badges-for-woocommerce/" target="_blank"><?php echo __( 'Pro Version', 'product-badges-for-woocommerce' );?></a></label> 
                                </td>
                            </tr>
                        </table>  
                    </div> 
                </div>
                <div class="postbox pbfw_tag_div" style="display: none;">
                    <div class="postbox-header">
                        <h2><?php echo __( 'Tag', 'product-badges-for-woocommerce' );?></h2>
                    </div>
                    <div class="inside">
                        <table class="pbfw_table_section_main">
                            <tr>
                                <th>
                                    <?php echo __( 'Tags', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                    <?php
                                        $pbfw_tags = $terms = get_terms(array('taxonomy' => 'product_tag', 'hide_empty' => false));
                                        $tag = get_post_meta($post->ID,'pbfw_tag',true);
                                        foreach( $pbfw_tags as $pbfw_tag ) {
                                            ?>
                                            <div class="pbfw_catlist">
                                                <input type="checkbox" name="pbfw_tag[]" value="<?php echo esc_attr($pbfw_tag->term_id);?>" <?php if(!empty($tag) && in_array($pbfw_tag->term_id,$tag)){echo "checked";} ?>>
                                                <label>
                                                    <?php echo esc_attr($pbfw_tag->name);?>
                                                </label>
                                            </div>
                                            <?php 
                                        } 
                                    ?>
                                </td>
                            </tr>
                        </table>  
                    </div> 
                </div>
                <div class="postbox pbfw_onsale_div" style="display: none;">
                    <div class="postbox-header">
                        <h2><?php echo __( 'Onsale', 'product-badges-for-woocommerce' );?></h2>
                    </div>
                    <div class="inside">
                        <table class="pbfw_table_section_main">
                            <tr>
                                <th>
                                    <?php echo __( 'Is on Sale', 'product-badges-for-woocommerce' );?>
                                </th>
                                <td>
                                    <?php $on_sale = get_post_meta($post->ID,'pbfw_onsale',true); ?>
                                    <select name="pbfw_onsale" class="pbfw_onsale regular-text">
                                        <option value="no" <?php if($on_sale == "no") { echo "selected"; } ?>><?php echo __( 'No', 'product-badges-for-woocommerce' );?></option>
                                        <option value="yes" <?php if($on_sale == "yes") { echo "selected"; } ?>><?php echo __( 'Yes', 'product-badges-for-woocommerce' );?></option>
                                    </select>
                                </td>
                            </tr>
                        </table>  
                    </div> 
                </div>      
            </div>
        </div>
    </div>
    <?php
}

function  PBFW_image_uploader_field($name, $value = '') {
    $image = ' button">Upload image';
    $image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
    $display = 'none'; // display state ot the "Remove image" button
    return '
    <div>
        <a href="#"  class="misha_upload_image_button image_disbledataa' . $image . '</a>
        
         <label class="IBFW_pro_link">Only available in pro version <a href="https://www.plugin999.com/plugin/product-badges-for-woocommerce/" target="_blank">link</a></label>
        
    </div>';
}

add_action( 'wp_ajax_nopriv_pbfw_product_ajax', 'PBFW_product_ajax' );
add_action( 'wp_ajax_pbfw_product_ajax',  'PBFW_product_ajax' );
function PBFW_product_ajax() {

    $return = array();
    $post_types = array( 'product','product_variation');
    $search_results = new WP_Query( array( 
        's'=> sanitize_text_field($_GET['q']),
        'post_status' => 'publish',
        'post_type' => $post_types,
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_stock_status',
                'value' => 'instock',
                'compare' => '=',
            )
        )
    ));

    if( $search_results->have_posts() ) :
        while( $search_results->have_posts() ) : $search_results->the_post();   
            $productc = wc_get_product( $search_results->post->ID );
            if ( $productc && $productc->is_in_stock() && $productc->is_purchasable() ) {
                $title = $search_results->post->post_title;
                if ( $productc->is_type( "variable" ) ) {
                    foreach ( $productc->get_children( false ) as $child_id ) {
                        $variation = wc_get_product( $child_id ); 
                        if ( ! $variation || ! $variation->exists() ) {
                            continue;
                        }
                        $title = $variation->get_name();
                    }
                } else {
                    $title = $search_results->post->post_title;
                }                       
                $price=$productc->get_price_html();                     
                $return[] = array( $search_results->post->ID, $title , $price);   
            }
        endwhile;
    endif;

    echo json_encode( $return );
    die;
}

add_action( 'edit_post',  'PBFW_meta_save', 10, 2);
function PBFW_meta_save( $post_id, $post ){
    // the following line is needed because we will hook into edit_post hook, so that we can set default value of checkbox.
    if ($post->post_type != 'pbfw_product_badges') {return;}
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post_id )) return;
    // Perform checking for before saving
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['PBFW_meta_save_nounce']) && wp_verify_nonce( $_POST['PBFW_meta_save_nounce'], 'PBFW_meta_save' )? 'true': 'false');

    if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;

    /*=======================Label Setting================================*/

    if(isset($_REQUEST['pbfw_show_label']) && $_REQUEST['pbfw_show_label'] == 'on') {
        $pbfw_show_label = sanitize_text_field( $_REQUEST['pbfw_show_label'] );
    } else {
        $pbfw_show_label = 'off';
    }
    update_post_meta($post_id, 'pbfw_show_label', $pbfw_show_label);


    
    if (!empty($_REQUEST['pbfw_left'])) {
        $pbfw_left   = sanitize_text_field( $_REQUEST['pbfw_left']); 
    }else{
        $pbfw_left   = '';
    }
    update_post_meta($post_id, 'pbfw_left', $pbfw_left);

    if (!empty($_REQUEST['pbfw_right'])) {
        $pbfw_right   = sanitize_text_field( $_REQUEST['pbfw_right']); 
    }else{
        $pbfw_right   = '';
    }
    update_post_meta($post_id, 'pbfw_right', $pbfw_right);

    if (!empty($_REQUEST['pbfw_top'])) {
        $pbfw_top   = sanitize_text_field( $_REQUEST['pbfw_top']); 
    }else{
        $pbfw_top   = '';
    }
    update_post_meta($post_id, 'pbfw_top', $pbfw_top);

    if (!empty($_REQUEST['pbfw_bottom'])) {
        $pbfw_bottom   = sanitize_text_field( $_REQUEST['pbfw_bottom']); 
    }else{
        $pbfw_bottom   = '';
    }
    update_post_meta($post_id, 'pbfw_bottom', $pbfw_bottom);

    $pbfw_allowed_html = array(
      'br' => array()
    );
    if (!empty($_REQUEST['pbfw_discount_text'])) {
        $pbfw_discount_text = wp_kses( $_REQUEST['pbfw_discount_text'], $pbfw_allowed_html );
    }else{
        $pbfw_discount_text   = '';
    }
    update_post_meta($post_id, 'pbfw_discount_text', $pbfw_discount_text);

    if (!empty($_REQUEST['badge_define'])) {
        $badge_define   = sanitize_text_field( $_REQUEST['badge_define']); 
    }else{
        $badge_define   = '';
    }
    update_post_meta($post_id, 'badge_define', $badge_define);
    

    /*====================Design Setting==================================*/
    if (!empty($_REQUEST['pbfw_font_clr'])) {
        $pbfw_font_clr   = sanitize_text_field( $_REQUEST['pbfw_font_clr']); 
    }else{
        $pbfw_font_clr   = '';
    }
    update_post_meta($post_id, 'pbfw_font_clr', $pbfw_font_clr);

    if (!empty($_REQUEST['pbfw_bg_clr'])) {
        $pbfw_bg_clr   = sanitize_text_field( $_REQUEST['pbfw_bg_clr']); 
    }else{
        $pbfw_bg_clr   = '';
    }
    update_post_meta($post_id, 'pbfw_bg_clr', $pbfw_bg_clr);

    if (!empty($_REQUEST['pbfw_ft_size'])) {
        $pbfw_ft_size   = sanitize_text_field( $_REQUEST['pbfw_ft_size']); 
    }else{
        $pbfw_ft_size   = '';
    }
    update_post_meta($post_id, 'pbfw_ft_size', $pbfw_ft_size);

    if (!empty($_REQUEST['ocor_bg_img_form'])) {
        $ocor_bg_img_form   = sanitize_text_field( $_REQUEST['ocor_bg_img_form']); 
    }else{
        $ocor_bg_img_form   = '';
    }
    update_post_meta($post_id, 'ocor_bg_img_form',$ocor_bg_img_form);

    if (!empty($_REQUEST['pbfw_lbl_shape'])) {
        $pbfw_lbl_shape   = sanitize_text_field( $_REQUEST['pbfw_lbl_shape']); 
    }else{
        $pbfw_lbl_shape   = '';
    }
    update_post_meta($post_id, 'pbfw_lbl_shape', $pbfw_lbl_shape);

    /*====================Design Setting==================================*/
    if (!empty($_REQUEST['pbfw_pro_condition'])) {
        $pbfw_pro_condition   = sanitize_text_field( $_REQUEST['pbfw_pro_condition']); 
    }else{
        $pbfw_pro_condition   = '';
    }
    update_post_meta($post_id, 'pbfw_pro_condition', $pbfw_pro_condition);

    if (!empty($_REQUEST['pbfw_image_position'])) {
        $pbfw_image_position   = sanitize_text_field( $_REQUEST['pbfw_image_position']); 
    }else{
        $pbfw_image_position   = '';
    }
    update_post_meta($post_id, 'pbfw_image_position', $pbfw_image_position);
    

    /*---tag---*/
    if (!empty($_REQUEST['pbfw_tag'])) {
        $pbfw_tag   = PBFW_recursive_sanitize_text_field( $_REQUEST['pbfw_tag']); 
    }else{
        $pbfw_tag   = '';
    }
    update_post_meta($post_id, 'pbfw_tag', $pbfw_tag);
    /*---tag---*/

    /*---onsale---*/
    if (!empty($_REQUEST['pbfw_onsale'])) {
        $pbfw_onsale = sanitize_text_field( $_REQUEST['pbfw_onsale'] );
    }else{
        $pbfw_onsale   = '';
    }
    update_post_meta($post_id, 'pbfw_onsale', $pbfw_onsale);
    /*---onsale---*/

    if (!empty($_REQUEST['pbfw_background'])) {
        $pbfw_background = sanitize_text_field( $_REQUEST['pbfw_background'] );
    }else{
        $pbfw_background   = '';
    }
    update_post_meta($post_id,'pbfw_background', $pbfw_background);

    if (!empty($_REQUEST['image_badge'])) {
        $image_badge = sanitize_text_field( $_REQUEST['image_badge'] );
    }else{
        $image_badge   = '';
    }
    update_post_meta($post_id,'image_badge', $image_badge);

    if(!empty($_REQUEST['pbfw_select2'])) {
        $pbfw_combo = PBFW_recursive_sanitize_text_field( $_REQUEST['pbfw_select2'] );
        update_post_meta($post_id,'pbfw_combo', $pbfw_combo);
    } else {
        update_post_meta($post_id,'pbfw_combo', '');
    }
}

function PBFW_recursive_sanitize_text_field($array) {
    foreach ( $array as $key => &$value ) {
        if ( is_array( $value ) ) {
            $value = PBFW_recursive_sanitize_text_field($value);
        }else{
            $value = sanitize_text_field( $value );
        }
    }
    return $array;
}