<?php
/**
 * Plugin Name: Fantastic Slideshow
 * Plugin URI: TBD
 * Version: 1.0
 * Author: TBD
 * Description: Create and customize a slideshow for your website.
 * Author URI: TBD
 */

defined( 'ABSPATH' ) or exit( "File protected." );


add_action( 'admin_enqueue_scripts', function(){ 
    wp_enqueue_style( 'fantastic-slideshow-admin-styling', plugin_dir_url(__FILE__) . '/assets/css/fantastic-slideshow-admin-styles.css' ); 
});

add_action( 'wp_enqueue_scripts', function(){ 
  wp_enqueue_style( 'fantastic-slideshow-styling', plugin_dir_url(__FILE__) . '/assets/css/fantastic-slideshow-styles.php' ); 
});


function fs_create_slideshow_post_type() {
    register_post_type( 'fantastic-slideshow',
            array(
                'labels' => array(
                    'name' => __( 'Fantastic Slideshow' ),
                    'singular_name' => __( 'Fantastic Slideshow' )
                ),
                'public' => true,
                'show_in_menu' => true,
                'supports' => array( 'title', 'editor', 'thumbnail', 'custom_fields' ),
                'hierarchical' => false
            )
    );
}
add_action( 'init', 'fs_create_slideshow_post_type' );


/*Set up the settings page*/
function fs_admin_menu(){
    add_submenu_page( 'edit.php?post_type=fantastic-slideshow', 'Settings', 'Settings', 'manage_options', 'fantastic-slideshow', 'fs_generate_settings_page' );
}
add_action( 'admin_menu', 'fs_admin_menu' );


/*Set up the settings page inputs*/
function fs_register_settings() {
    add_option( 'fantastic-slideshow-leading-text', 'Slides' );
    add_option( 'fantastic-slideshow-image-width-height', "120" );
    add_option( 'fantastic-slideshow-border-radius', "15" );
    add_option( 'fantastic-slideshow-float-image-direction', "left" );
    add_option( 'fantastic-slideshow-slides-per-row', "2" );
    add_option( 'fantastic-slideshow-number-to-display', "" );

    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-leading-text', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-image-width-height', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-border-radius', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-float-image-direction', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-slides-per-row', 'fs_validatetextfield' );  
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-number-to-display', 'fs_validatetextfield' );  
}
add_action( 'admin_init', 'fs_register_settings' );


function fs_validatetextfield( $input ) {
    $updatedField = sanitize_text_field( $input );
    return $updatedField;
}


function fs_generate_settings_page() {
    ?>
    <h1 class="fantastic-slideshow__plugin-title">Fantastic Slideshow Settings</h1>
    <form class="slideshow-settings-form" method="post" action="options.php">
        <?php settings_fields( 'fantastic-slideshow-settings-group' ); ?>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-leading-text">Slides Leading Text</label>
                <input id="fantasticSlideshowLeadingText" class="admin-input-container__input fantastic-slideshow-leading-text" name="fantastic-slideshow-leading-text" type="text" value="<?php echo get_option( 'fantastic-slideshow-leading-text' ); ?>" />
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-image-width-height">Image Width, Height (Max, 60-150px)</label>
                <input id="fantasticSlideshowNumberToDisplay" class="admin-input-container__input smaller fantastic-slideshow-image-width-height" name="fantastic-slideshow-image-width-height" type="number" value="<?php echo get_option( 'fantastic-slideshow-image-width-height' ); ?>" min="60" max="150" />
                <span class="admin-input-container__trailing-text">px</span>
                <span class="admin-input-container__default-settings-text">Default: 120px</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-border-radius">Image Border Radius</label>
                <input id="fantasticSlideshowImageWidthHeight" class="admin-input-container__input fantastic-slideshow-border-radius" name="fantastic-slideshow-border-radius" type="text" value="<?php echo get_option( 'fantastic-slideshow-border-radius' ); ?>" />
                <span class="admin-input-container__trailing-text">px</span>
                <span class="admin-input-container__default-settings-text">Default: 15px</span>
            </div>
            <div class="admin-input-container">
                <span class="admin-input-container__label">Float Image Direction</span>         
                <input id="fantasticSlideshowFloatImageDirection0" class="fantastic-slideshow-float-image-direction" name="fantastic-slideshow-float-image-direction" type="radio" value="left" <?php if( get_option( 'fantastic-slideshow-float-image-direction' ) === "left" ) { echo 'checked="checked"'; } ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowFloatImageDirection0">Left</label>
                <input id="fantasticSlideshowFloatImageDirection1" class="fantastic-slideshow-float-image-direction" name="fantastic-slideshow-float-image-direction" type="radio" value="right" <?php if( get_option( 'fantastic-slideshow-float-image-direction' ) === "right" ) { echo 'checked="checked"'; } ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowFloatImageDirection1">Right</label>
            </div>
            <div class="admin-input-container">
                <span class="admin-input-container__label">Number of Slides Per Row (Max)</span>         
                <input id="fantasticSlideshowSlidesPerRow0" class="fantastic-slideshow-slides-per-row" name="fantastic-slideshow-slides-per-row" type="radio" value="1" <?php if( get_option( 'fantastic-slideshow-slides-per-row' ) === "1" ) { echo 'checked="checked"'; } ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowSlidesPerRow0">1</label>
                <input id="fantasticSlideshowSlidesPerRow1" class="fantastic-slideshow-slides-per-row" name="fantastic-slideshow-slides-per-row" type="radio" value="2" <?php if( get_option( 'fantastic-slideshow-slides-per-row' ) === "2" ) { echo 'checked="checked"'; } ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowSlidesPerRow1">2</label>
                <input id="fantasticSlideshowSlidesPerRow2" class="fantastic-slideshow-slides-per-row" name="fantastic-slideshow-slides-per-row" type="radio" value="3" <?php if( get_option( 'fantastic-slideshow-slides-per-row' ) === "3" ) { echo 'checked="checked"'; } ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowSlidesPerRow2">3</label>
                                <input id="fantasticSlideshowSlidesPerRow3" class="fantastic-slideshow-slides-per-row" name="fantastic-slideshow-slides-per-row" type="radio" value="4" <?php if( get_option( 'fantastic-slideshow-slides-per-row' ) === "4" ) { echo 'checked="checked"'; } ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowSlidesPerRow3">4</label>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-number-to-display">Slides to Display (Empty: display all)</label>
                <input id="fantasticSlideshowNumberToDisplay" class="admin-input-container__input smaller fantastic-slideshow-number-to-display" name="fantastic-slideshow-number-to-display" type="number" value="<?php echo get_option( 'fantastic-slideshow-number-to-display' ); ?>" />
            </div>
            <?php submit_button(); ?>
        </form>
    <?php
}


function fs_add_custom_metabox_info() {
    add_meta_box( 'custom-metabox', __( 'Slide Information' ), 'fs_url_custom_metabox', 'fantastic-slideshow', 'side', 'low' );
}
add_action( 'admin_init', 'fs_add_custom_metabox_info' );


//Admin area HTML and logic 
function fs_url_custom_metabox() {
    global $post;
    
    /*Gather the input data, sanitize it, and update the database.*/
    $slidelabel = sanitize_text_field( get_post_meta( $post->ID, 'slidelabel', true ) );
    update_post_meta( $post->ID, 'slidelabel', $slidelabel );
    $slidedescription = sanitize_text_field( get_post_meta( $post->ID, 'slidedescription', true ) );
    update_post_meta( $post->ID, 'slidedescription', $slidedescription );
    $slideshowlurl = sanitize_text_field( get_post_meta( $post->ID, 'slideshowlurl', true ) );
    update_post_meta( $post->ID, 'slideshowlurl', $slideshowlurl );
    $slideshoworder = sanitize_text_field( get_post_meta( $post->ID, 'slideshoworder', true ) );
    if( isset( $slideshoworder ) === false || $slideshoworder === "" ) {
        $slideshoworder = "n/a";
    }
    update_post_meta( $post->ID, 'slideshoworder', $slideshoworder );


    $errorstitle = "";
    if( isset( $errorstitle ) ){
        echo $errorstitle;
    }
    
    $errorslabel = "";
    if( isset( $errorslabel ) ){
        echo $errorslabel;
    }
   
    $errorslink = "";
    if ( !preg_match( "/http(s?):\/\//", $slideshowlurl ) && $slideshowlurl !== "" ) {
        $errorslink = "This URL is not valid";
        $slideshowlurl = "http://";
    }
    
    if( isset( $errorslink ) ){
        echo $errorslink;
    }
    
    $errorsorder = "";
    if( isset( $errorsorder ) ){
        echo $errorsorder;
    }
    
    ?>
    <p>
        <label for="slidelabel">Slide Label:<br />
            <input id="slidelabel" name="slidelabel" size="37" value="<?php if( isset( $slidelabel ) ) { echo $slidelabel; } ?>" />
        </label>
    </p>
    <p>
        <label for="slidedescription">Slide Description:<br />
            <input id="slidedescription" name="slidedescription" size="37" value="<?php if( isset( $slidedescription ) ) { echo $slidedescription; } ?>" />
        </label>
    </p>
    <p>
        <label for="slideshowlurl">Related URL:<br />
            <input id="slideshowlurl" size="37" name="slideshowlurl" value="<?php if( isset( $slideshowlurl ) ) { echo $slideshowlurl; } ?>" />
        </label>
    </p>
        <p>
        <label for="slideshoworder">Slideshow Order:<br />
            <input id="slideshoworder" size="37" type="number" min="1" name="slideshoworder" value="<?php if( isset( $slideshoworder ) ) { echo $slideshoworder; } ?>" />
        </label>
    </p>
 <?php 
}




//Save user provided field data.
function fs_save_custom_slidelabel( $post_id ) {
    global $post;
    
    if( isset( $_POST['slidelabel'] ) ) {
        update_post_meta( $post->ID, 'slidelabel', $_POST['slidelabel'] );
    }
}
add_action( 'save_post', 'fs_save_custom_slidelabel' );

function fs_get_slidelabel( $post ) {
    $slidelabel = get_post_meta( $post->ID, 'slidelabel', true );
    return $slidelabel;
}


function fs_save_custom_slidedescription( $post_id ) {
    global $post;
    
    if( isset( $_POST['slidedescription'] ) ) {
        update_post_meta( $post->ID, 'slidedescription', $_POST['slidedescription'] );
    }
}
add_action( 'save_post', 'fs_save_custom_slidedescription' );

function fs_get_slidedescription( $post ) {
    $slidedescription = get_post_meta( $post->ID, 'slidedescription', true );
    return $slidedescription;
}


function fs_save_custom_url( $post_id ) {
    global $post;
    
    if( isset( $_POST['slideshowurl'] ) ) {
        update_post_meta( $post->ID, 'slideshowurl', $_POST['slideshowurl'] );
    }
}
add_action( 'save_post', 'fs_save_custom_url' );

function fs_get_url( $post ) {
    $slideshowurl = get_post_meta( $post->ID, 'slideshowurl', true );
    return $slideshowurl;
}


function fs_save_custom_order( $post_id ) {
    global $post;
    
    if ( isset( $_POST['slideshoworder'] ) ) {
        update_post_meta( $post->ID, 'slideshoworder', $_POST['slideshoworder'] );
    }
}
add_action( 'save_post', 'fs_save_custom_order' );

function fs_get_order( $post ) {
    $slideshoworder = get_post_meta( $post->ID, 'slideshoworder', true );
    return $slideshoworder;
}



/*Adjust admin columns for Slideshows*/
if ( isset( $_GET['post_type'] ) && $_GET['post_type'] === "fantastic-slideshow" ){

    add_filter('admin_bar_menu', 'fs_setup_instructions');
    function fs_setup_instructions() {
        if ( get_admin_page_title() === 'Fantastic Slideshow' ) {
            echo '<div class="fantastic-slideshow__instructions">
                <p class="fantastic-slideshow__instructions__intro">Add slideshows to your site, with layout and styling customizations.</p>
                <p><strong>Shortcode:</strong> [fantastic_slideshow].</p>
                <p><strong>PHP code:</strong> <code>&lt?php echo do_shortcode( "[fantastic_slideshow]" ); ?></code> 
                </div>';
        }
    }
    

    add_filter( 'manage_posts_columns', 'fs_setup_adjust_admin_columns' );
    function fs_setup_adjust_admin_columns( $columns ) {
        $columns = array(
            'cb' => $columns['cb'],
            'title' => __( 'Title' ),
            'image' => __( 'Image' ), 
            'content' => __( 'Slideshow Text' ),
            'slidelabel' => __( 'Slide Label', 'fs' ),
            'order' => __( 'Order' ),
            'date' => __( 'Date' ),
        );   
        return $columns;
    }


    //Add images and other data to posts admin
    add_action( 'manage_posts_custom_column', 'fs_add_data_to_admin_columns', 10, 2 );
    function fs_add_data_to_admin_columns( $column, $post_id ) {
        if( 'image' === $column ) {
            echo get_the_post_thumbnail( $post_id, array( 100, 100 ) );
        }
        if ( 'slidelabel' === $column ) {
            echo get_post_meta( $post_id, 'slidelabel', true );
        }
        if( 'content' === $column ) {
            echo get_post_field( 'post_content', $post_id );
        }
        if( 'order' === $column ) {
            echo get_post_meta( $post_id, 'slideshoworder', true );
        }
    }


    //Determine order of slides shown in admin*/
    add_action( 'pre_get_posts', 'fs_custom_post_order_sort' );
    function fs_custom_post_order_sort( $query ) { 
        if ( $query->is_main_query() && $_GET['post_type'] === "fantastic_slideshow" ){
            $query->set( 'orderby', 'meta_value' );
            $query->set( 'meta_key', 'slideshoworder' );
            $query->set( 'order', 'ASC' );
        }
    }
}



//Register the shortcode so we can show slideshows.
function fs_load_slideshows( $a ) {
    $pluginContainer = "";
    $args = array(
        "post_type" => "fantastic-slideshow"
    );

    if ( isset( $a['rand'] ) && $a['rand'] == true ) {
        $args['orderby'] = 'rand';
    } else {
        $args['orderby'] = 'meta_value';
        $args['meta_key'] = 'slideshoworder';
        $args['order'] = 'ASC';
    }

    if ( isset( $a['max'] ) ) {
        $args['posts_per_page'] = (int) $a['max'];
    }

    //Get all slides.
    $posts = get_posts( $args );
    $pluginContainer .= '<div class="slideshows-container">';
    $pluginContainer .= '<h3 class="slideshows-container__heading">' . get_option( 'fantastic-slideshow-leading-text' ) . '</h3>';
    $pluginContainer .= '<div class="slideshows-container__inner-wrapper">';
    
    $numberToDisplay = get_option( 'fantastic-slideshow-number-to-display' );
    if( $numberToDisplay === "" ) {
        $numberToDisplay = -1;
    }
    $numberToDisplay = (int) $numberToDisplay;
    $count = 0;
    foreach ( $posts as $post ) {
        if( $count < $numberToDisplay || $numberToDisplay === -1 ){
            $url_thumb = wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) );
            $url_altText = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
            $slideLabel = fs_get_slidelabel( $post );
            $slideDescription = fs_get_slidedescription( $post );
            $link = fs_get_url( $post );
            $pluginContainer .= '<div class="slideshow">';
            if ( !empty( $url_thumb ) ) {
                $pluginContainer .= '<img class="slideshow__image" src="' . $url_thumb . '" alt="' . $url_altText . '" />';
            }
            $pluginContainer .= '<h4 class="slideshow__title">' . $post->post_title . '</h4>';
            if ( !empty( $post->post_content ) ) {
                $pluginContainer .= '<p class="slideshow__content">' . $post->post_content . '</p>';
            }
            if ( !empty( $slideLabel ) ) {
                if ( !empty( $link ) ) {
                    $pluginContainer .= '<span class="slideshow__label"><a class="slideshow__link" href="' . $link . '" target="__blank">' . $slideLabel . '</a></span>';
                } else {
                    $pluginContainer .= '<span class="slideshow__label">' . $slideLabel . '</span>';
                }
            }
            if ( !empty( $slideDescription ) ) {
                if ( !empty( $slideLabel ) ) {
                    $pluginContainer .= '<span class="slideshow__comma">,</span><span class="slideshow__description"> ' . $slideDescription . '</span>';
                } else {
                    $pluginContainer .= '<span class="slideshow__description">' . $slideDescription . '</span>';
                }
            }
            $pluginContainer .= '</div>';
        }
        $count++;
    }
    $pluginContainer .= '</div>';
    $pluginContainer .= '</div>';
    return $pluginContainer;
}
add_shortcode( "fantastic_slideshow", "fs_load_slideshows" );
add_filter( 'widget_text', 'do_shortcode' );

