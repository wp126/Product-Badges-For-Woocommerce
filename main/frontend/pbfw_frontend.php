<?php

if (!defined('ABSPATH')){
  exit;
}


function PBFW_hide_sale_flash(){
    return false;
}

function PBFW_create_label($post_id) {
    $lbl = get_post_meta($post_id, 'pbfw_show_label', true);
    $left = get_post_meta($post_id, 'pbfw_left', true);
    $right = get_post_meta($post_id, 'pbfw_right', true);
    $top = get_post_meta($post_id, 'pbfw_top', true);
    $bottom = get_post_meta($post_id, 'pbfw_bottom', true);
    $pbfw_discount_text = get_post_meta($post_id, 'pbfw_discount_text', true);
    $pbfw_font_clr = get_post_meta($post_id, 'pbfw_font_clr', true);
    $pbfw_bg_clr = get_post_meta($post_id, 'pbfw_bg_clr', true);
    $ft_size = get_post_meta($post_id, 'pbfw_ft_size', true);
    $shape = get_post_meta($post_id, 'pbfw_lbl_shape', true);
    $pbfw_background = get_post_meta($post_id, 'pbfw_background', true);
    $image_badge = get_post_meta($post_id, 'image_badge', true);
    $badge_define=get_post_meta($post_id,'badge_define',true );
    $bagde_position = get_post_meta($post_id,'pbfw_image_position',true);
    $text = '<span style="font-size: '.$ft_size.'px;">'.$pbfw_discount_text.'</span>';

    if($right != 0) { $left = "inherit"; } else { $left = $left."px"; }

    if($bagde_position =="custom_position"){
        if($badge_define == "or_text_badge"){
            $style ="top:".$top."px;right:".$right."px;bottom:".$bottom."px;left:".$left.";background-color:".$pbfw_bg_clr.";color:".$pbfw_font_clr.";";
            $style_corner = "top:".$top."px;right:".$right."px;bottom:".$bottom."px;left:".$left.";";
            $style_corner_text = "color:".$pbfw_font_clr.";";
        }else{
            $style = "top:".$top."px;right:".$right."px;bottom:".$bottom."px;left:".$left.";";
            $style_corner = "top:".$top."px;right:".$right."px;bottom:".$bottom."px;left:".$left.";";
            $style_corner_text = "color:".$pbfw_font_clr.";";
        }
    }else{
        if($badge_define == "or_text_badge"){
            if($bagde_position == "top_left"){
                $style = "top:0px;left:0px;background-color:".$pbfw_bg_clr.";color:".$pbfw_font_clr.";"; 
                $style_corner = "top:0px;left:-10px;transform: rotate(315deg);color: ".$pbfw_font_clr.";"; 
                $style_corner_text = "transform: rotate(0deg);";
            }else if($bagde_position == "top_right"){
                $style = "top:0px;right:0px;background-color:".$pbfw_bg_clr.";color:".$pbfw_font_clr.";"; 
                $style_corner = "top:0px;right:-10px;transform: rotate(45deg);color: ".$pbfw_font_clr.";";
                $style_corner_text = "transform: rotate(0deg);";
            }else if($bagde_position == "bottom_left"){
                $style = "bottom:0px;left:0px;background-color:".$pbfw_bg_clr.";color:".$pbfw_font_clr.";"; 
                $style_corner = "bottom:0px;left:-10px;transform: rotate(225deg);color: ".$pbfw_font_clr.";";
                $style_corner_text = "transform: rotate(180deg);";
            }else{
                $style = "right: 0px;bottom:0px;background-color:".$pbfw_bg_clr.";color:".$pbfw_font_clr.";";
                $style_corner = "bottom:0px;right:-10px;transform: rotate(135deg);color: ".$pbfw_font_clr.";";
                $style_corner_text = "transform: rotate(180deg);"; 
            }
         }else{
            if($bagde_position == "top_left"){
                $style = "top:0px;left:0px;"; 
            }else if($bagde_position == "top_right"){
                $style = "top:0px;right:0px;"; 
            }else if($bagde_position == "bottom_left"){
                $style = "bottom:0px;left:0px;"; 
            }else{
                $style = "right: 0px;bottom:0px;"; 
            }
        }
    }

    if($lbl == "on") {
        if($badge_define == "or_text_badge"){
            if($shape == "square") {
                ?>
                <div class="pbfw_square_data">
                    <div class="pbfw_square" style="<?php echo esc_attr($style); ?>">
                        <b style="font-size: <?php echo esc_attr($ft_size); ?>px"><?php echo esc_attr($pbfw_discount_text); ?></b>                         
                    </div>
                </div>
                <?php
            }else if ($shape == "rectangle") {
                ?>
                <div class="pbfw_square_data">
                    <div class="pbfw_rectangle" style="<?php echo esc_attr($style); ?>">
                        <b style="font-size: <?php echo esc_attr($ft_size); ?>px"><?php echo esc_attr($pbfw_discount_text); ?></b>   
                    </div>
                </div>
                <?php
            }else if ($shape == "rectangle_up") {
                ?>
                <div class="pbfw_square_data">
                    <div class="pbfw_rectangle_up" style="<?php echo esc_attr($style); ?>">
                        <b style="font-size: <?php echo esc_attr($ft_size); ?>px"><?php echo esc_attr($pbfw_discount_text); ?></b>   
                    </div>
                </div>
                <?php
            }else if ($shape == "offers") {
                ?>
                <div class="pbfw_square_data">
                    <div class="pbfw_offers" style="<?php echo esc_attr($style); ?>">
                        <i style="background-color:<?php echo esc_attr($pbfw_bg_clr)?>; border-color:<?php echo esc_attr($pbfw_bg_clr)?>;" class="template-i "></i>            
                        <i style="background-color:<?php echo esc_attr($pbfw_bg_clr)?>; border-color:<?php echo esc_attr($pbfw_bg_clr)?>;" class="template-i-before "></i>
                        <b style="font-size: <?php echo esc_attr($ft_size); ?>px"><?php echo esc_html($pbfw_discount_text); ?></b>   
                    </div>
                </div>
                <?php
            }else if ($shape == "tag") {
                ?>
                <div class="pbfw_square_data">
                    <div class="pbfw_tag" style="<?php echo esc_attr($style); ?>">
                        <i style="background-color:<?php echo esc_attr($pbfw_bg_clr)?>; border-color:<?php echo esc_attr($pbfw_bg_clr)?>;" class="template-span-before "></i>
                        <b style="font-size: <?php echo esc_attr($ft_size); ?>px"><?php echo esc_attr($pbfw_discount_text); ?></b>   
                    </div>
                </div>
                <?php
            }else if ($shape == "collar") {
                ?>
                <div class="pbfw_square_data">
                    <div class="pbfw_collar" style="<?php echo esc_attr($style); ?>">
                        <i style="border-color:<?php echo esc_attr($pbfw_bg_clr)?>;" class="template-span-before "></i>
                        <i style="border-color:<?php echo esc_attr($pbfw_bg_clr)?>;" class="template-i-after "></i>
                        <b style="font-size: <?php echo esc_attr($ft_size); ?>px"><?php echo esc_attr($pbfw_discount_text); ?></b>   
                    </div>
                </div>
                <?php
            }else if ($shape == "rectangle_round") {
                ?>
                <div class="pbfw_square_data">
                    <div class="pbfw_rectangle_round" style="<?php echo esc_attr($style); ?>">
                        <b style="font-size: <?php echo esc_attr($ft_size); ?>px"><?php echo esc_attr($pbfw_discount_text); ?></b>   
                    </div>
                </div>
                <?php
            }else if ($shape == "rectangle_circle") {
                ?>
                <div class="pbfw_square_data">
                    <div class="pbfw_rectangle_circle" style="<?php echo esc_attr($style); ?>">
                        <b style="font-size: <?php echo esc_attr($ft_size); ?>px"><?php echo esc_attr($pbfw_discount_text); ?></b>   
                    </div>
                </div>
                <?php
            }else if ($shape == "circle") {
                ?>
                <div class="pbfw_square_data">
                    <div class="pbfw_circle" style="<?php echo esc_attr($style); ?>">
                        <b style="font-size: <?php echo esc_attr($ft_size); ?>px"><?php echo esc_attr($pbfw_discount_text); ?></b>   
                    </div>
                </div>
                <?php
            }else if ($shape == "corner_badge") {
                ?>
                <div class="pbfw_square_data">
                    <div class="pbfw_corner_badge" style="<?php echo esc_attr($style_corner); ?>"> 
                        <i style="background-color:<?php echo esc_attr($pbfw_bg_clr)?>; border-color:<?php echo esc_attr($pbfw_bg_clr)?>;" class="template-i-before "></i>
                        <i class="template-i-after " style="<?php echo esc_attr($style_corner_text); ?>"><b style="font-size: <?php echo esc_attr($ft_size); ?>px"><?php echo esc_attr($pbfw_discount_text); ?></b>   </i>
                    </div>
                </div>
                <?php
            }
        }else if($badge_define == "or_image_badge"){
            if($pbfw_background == "or_badge_image"){  ?>
                <div class="pbfw_square_data">
                    <div class="pbfw_square" style="<?php echo esc_attr($style); ?>">
                        <img src="<?php echo PBFW_PLUGIN_DIR; ?>/assets/img/<?php echo esc_attr($image_badge); ?>">
                    </div>
                </div>
                <?php
            }
        }
    }
}


function PBFW_frontdesign() {
    global $product;
    $is_setup = false;
    $product_id = $product->get_id();
    $price = $product->get_price();
    $categories = $product->get_category_ids();
    $tags = $product->get_tag_ids();
    $args = array(
        'post_type' => 'pbfw_product_badges',
        'post_status' => 'publish'
    );
    $query = get_posts( $args );
    foreach ( $query as $post ) {
        $pro_con = get_post_meta($post->ID, 'pbfw_pro_condition', true);
        PBFW_label_comman($is_setup,$pro_con,$post,$price);
    }
}

function PBFW_label_comman($is_setup,$pro_con,$post,$price){
  global $product;
    if( $is_setup != true ) {
        if ($pro_con == "all_products") {
            PBFW_create_label($post->ID);
        } elseif ($pro_con == "selected_products") {
            global $product;
            $productsa = get_post_meta($post->ID,'pbfw_combo',true);
            $product_id = $product->get_id();
            if(!empty($productsa)) {
                if(in_array($product_id, $productsa)) {
                    PBFW_create_label($post->ID);
                }  
            }
        } elseif ($pro_con == "tag") {
            global $product;
            $tag = get_post_meta($post->ID, 'pbfw_tag', true);
            $tags = $product->get_tag_ids();
            if(!empty($tag)) {
                if(array_intersect($tags, $tag)) {
                    PBFW_create_label($post->ID);
                }
            }
        } elseif ($pro_con == "onsale") {
            $on_sale = get_post_meta($post->ID, 'pbfw_onsale', true);
            if( $on_sale == "no") {
                if(empty($product->is_on_sale())) {
                    PBFW_create_label($post->ID);
                }
            } else {
                if($product->is_on_sale() == 1) {
                    PBFW_create_label($post->ID);
                }
            }                       
        }
    }
}

function pbfw_woocommerce_template_loop_product_thumbnaila(){
    echo "<div class='pbfw_square_data_main'>";
}

function pbfw_woocommerce_template_loop_product_thumbnailb(){
    echo "</div>";
}

add_action('init','pbfw_product_badges_init');
function pbfw_product_badges_init() {
    $args = array( 'post_type' => 'pbfw_product_badges', 'post_status' => 'publish' );
    $query = new WP_Query( $args );
    $count_posts = $query->post_count;
    if ($count_posts > 0) {
        add_filter('woocommerce_sale_flash', 'PBFW_hide_sale_flash');
    }
    add_action( 'woocommerce_before_shop_loop_item_title',  'PBFW_frontdesign', 10,5 );
    add_action( 'woocommerce_before_shop_loop_item_title', 'pbfw_woocommerce_template_loop_product_thumbnaila', 9 );
    add_action( 'woocommerce_before_shop_loop_item_title', 'pbfw_woocommerce_template_loop_product_thumbnailb', 11 );
}
