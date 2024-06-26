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



add_action( 'wp_enqueue_scripts', 'fs_load_slideshow_functions' );

function fs_load_slideshow_functions(){
  wp_enqueue_script( 'slideshow-functions', plugin_dir_url(__FILE__) . '/assets/javascript/slideshow.js' ); 
};



function fs_create_slideshow_post_type() {
    register_post_type( 'fantastic-slideshow',
            array(
                'labels' => array(
                    'name' => __( 'Fantastic Slideshow' ),
                    'singular_name' => __( 'Fantastic Slideshow' )
                ),
                'public' => true,
                'show_in_menu' => true,
                'supports' => array( 'title', 'thumbnail', 'custom_fields' ),
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
    add_option( 'fantastic-slideshow-leading-text-position', 'center' );
    add_option( 'fantastic-slideshow-image-width', "1200" );
    add_option( 'fantastic-slideshow-image-height', "400" );
    add_option( 'fantastic-slideshow-border-radius', "0" );
    add_option( 'fantastic-slideshow-slide-speed', "5" );
    add_option( 'fantastic-slideshow-slide-transition-speed', "4" );
    add_option( 'fantastic-slideshow-is-autoplay', 'yes' );
    add_option( 'fantastic-slideshow-slide-content-background-opacity', "0.8" );
    add_option( 'fantastic-slideshow-slide-button-width', "30" );
    add_option( 'fantastic-slideshow-minimum-touch-drag-distance', "80" );
    add_option( 'fantastic-slideshow-minimum-mouse-drag-distance', "100" );
    add_option( 'fantastic-slideshow-pause-on-hover', 'no' );
    add_option( 'fantastic-slideshow-zoom-in-on-hover-percent', '0' );
    add_option( 'fantastic-slideshow-hover-zoom-in-time', '0.8' );
    add_option( 'fantastic-slideshow-hover-zoom-transition-delay', '0' );
    add_option( 'fantastic-slideshow-hover-zoom-transition-effect', 'ease-in' );
    add_option( 'fantastic-slideshow-show-pause-button', 'yes' );
    add_option( 'fantastic-slideshow-enable-touch-dragging', 'yes' );
    add_option( 'fantastic-slideshow-enable-mouse-dragging', 'yes' );
    add_option( 'fantastic-slideshow-show-arrows', 'yes' );
    add_option( 'fantastic-slideshow-show-arrows-only-on-hover-over', 'no' );
    add_option( 'fantastic-slideshow-show-slide-buttons', 'yes' );
    
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-leading-text', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-leading-text-position', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-image-width', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-image-height', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-border-radius', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-slide-speed', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-slide-transition-speed', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-is-autoplay', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-slide-content-background-opacity', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-slide-button-width', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-minimum-touch-drag-distance', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-minimum-mouse-drag-distance', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-pause-on-hover', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-zoom-in-on-hover-percent', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-hover-zoom-in-time', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-hover-zoom-transition-delay', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-hover-zoom-transition-effect', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-show-pause-button', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-enable-touch-dragging', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-enable-mouse-dragging', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-show-arrows', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-show-arrows-only-on-hover-over', 'fs_validatetextfield' );
    register_setting( 'fantastic-slideshow-settings-group', 'fantastic-slideshow-show-slide-buttons', 'fs_validatetextfield' );
}
add_action( 'admin_init', 'fs_register_settings' );


function fs_validatetextfield( $input ) {
    $updatedField = sanitize_text_field( $input );
    return $updatedField;
}

//Move the featured image to the main left column.
function fs_remove_some_default_fields (){
    remove_meta_box( "postimagediv", "fantastic-slideshow", "side" );
    add_meta_box( "postimagediv", __("Slide Image"), "post_thumbnail_meta_box", "fantastic-slideshow", "normal", "high" );
}
add_action( "do_meta_boxes", "fs_remove_some_default_fields" );


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
                <span class="admin-input-container__label">Slides Leading Text Position</span>
                <label class="admin-input-container__label--right" for="fantasticSlideshowLeadingTextPosition0">Left</label>
                <input id="fantasticSlideshowLeadingTextPosition0" class="admin-input-container__input fantastic-slideshow-leading-text-position" name="fantastic-slideshow-leading-text-position" type="radio" value="left" <?php if ( get_option( 'fantastic-slideshow-leading-text-position' ) === "left" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowLeadingTextPosition1">Center</label>
                <input id="fantasticSlideshowLeadingTextPosition1" class="admin-input-container__input fantastic-slideshow-leading-text-position" name="fantastic-slideshow-leading-text-position" type="radio" value="center" <?php if ( get_option( 'fantastic-slideshow-leading-text-position' ) === "center" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowLeadingTextPosition2">Right</label>
                <input id="fantasticSlideshowLeadingTextPosition2" class="admin-input-container__input fantastic-slideshow-leading-text-position" name="fantastic-slideshow-leading-text-position" type="radio" value="right" <?php if ( get_option( 'fantastic-slideshow-leading-text-position' ) === "right" ) { echo "checked='checked'"; }; ?> />
                <span class="admin-input-container__default-settings-text">Default: center</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-image-width">Image Width (400-1920px)</label>
                <input id="fantasticSlideshowImageWidth" class="admin-input-container__input smaller fantastic-slideshow-image-width" name="fantastic-slideshow-image-width" type="number" value="<?php echo get_option( 'fantastic-slideshow-image-width' ); ?>" min="400" max="1920" />
                <span class="admin-input-container__trailing-text">px</span>
                <span class="admin-input-container__default-settings-text">Default: 1200px</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-image-height">Image Height (200-1200px)</label>
                <input id="fantasticSlideshowImageHeight" class="admin-input-container__input smaller fantastic-slideshow-image-height" name="fantastic-slideshow-image-height" type="number" value="<?php echo get_option( 'fantastic-slideshow-image-height' ); ?>" min="200" max="1200" />
                <span class="admin-input-container__trailing-text">px</span>
                <span class="admin-input-container__default-settings-text">Default: 400px</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-border-radius">Image Border Radius</label>
                <input id="fantasticSlideshowBorderRadius" class="admin-input-container__input fantastic-slideshow-border-radius" name="fantastic-slideshow-border-radius" type="text" value="<?php echo get_option( 'fantastic-slideshow-border-radius' ); ?>" />
                <span class="admin-input-container__trailing-text">px</span>
                <span class="admin-input-container__default-settings-text">Default: 0px</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-slide-speed">Slide Speed</label>
                <input id="fantasticSlideshowSlideSpeed" class="admin-input-container__input fantastic-slideshow-slide-speed" name="fantastic-slideshow-slide-speed" type="text" value="<?php echo get_option( 'fantastic-slideshow-slide-speed' ); ?>" />
                <span class="admin-input-container__trailing-text">s</span>
                <span class="admin-input-container__default-settings-text">Default: 5s</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-slide-transition-speed">Slide Transition Speed</label>
                <input id="fantasticSlideshowSlideSpeed" class="admin-input-container__input fantastic-slideshow-slide-transition-speed" name="fantastic-slideshow-slide-transition-speed" type="text" value="<?php echo get_option( 'fantastic-slideshow-slide-transition-speed' ); ?>" />
                <span class="admin-input-container__trailing-text">s</span>
                <span class="admin-input-container__default-settings-text">Default: 4s</span>
            </div>
            <div class="admin-input-container">
                <span class="admin-input-container__label">Autoplay</span>
                <label class="admin-input-container__label--right" for="fantasticSlideshowIsAutoplay0">No</label>
                <input id="fantasticSlideshowIsAutoplay0" class="admin-input-container__input fantastic-slideshow-is-autoplay" name="fantastic-slideshow-is-autoplay" type="radio" value="no" <?php if ( get_option( 'fantastic-slideshow-is-autoplay' ) === "no" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowIsAutoplay1">Yes</label>
                <input id="fantasticSlideshowIsAutoplay1" class="admin-input-container__input fantastic-slideshow-is-autoplay" name="fantastic-slideshow-is-autoplay" type="radio" value="yes" <?php if ( get_option( 'fantastic-slideshow-is-autoplay' ) === "yes" ) { echo "checked='checked'"; }; ?> />
                <span class="admin-input-container__default-settings-text">Default: Yes, autoplay</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-slide-content-background-opacity">Slide Content Background Opacity</label>
                <input id="fantasticSlideshowSlideContentBackgroundOpacity" class="admin-input-container__input fantastic-slideshow-slide-content-background-opacity" name="fantastic-slideshow-slide-content-background-opacity" type="text" value="<?php echo get_option( 'fantastic-slideshow-slide-content-background-opacity' ); ?>" />
                <span class="admin-input-container__trailing-text">(0 - 1)</span>
                <span class="admin-input-container__default-settings-text">Default: 0.8</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-slide-button-width">Slide Button Width</label>
                <input id="fantasticSlideshowSlideButtonWidth" class="admin-input-container__input fantastic-slideshow-slide-button-width" name="fantastic-slideshow-slide-button-width" type="text" value="<?php echo get_option( 'fantastic-slideshow-slide-button-width' ); ?>" />
                <span class="admin-input-container__trailing-text">px</span>
                <span class="admin-input-container__default-settings-text">Default: 30px</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-minimum-touch-drag-distance">Minimum Touch Drag Distance</label>
                <input id="fantasticSlideshowMinimumTouchDragDistance" class="admin-input-container__input fantastic-slideshow-minimum-touch-drag-distance" name="fantastic-slideshow-minimum-touch-drag-distance" type="text" value="<?php echo get_option( 'fantastic-slideshow-minimum-touch-drag-distance' ); ?>" />
                <span class="admin-input-container__trailing-text">px</span>
                <span class="admin-input-container__default-settings-text">Default: 80px</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-minimum-mouse-drag-distance">Minimum Mouse Drag Distance</label>
                <input id="fantasticSlideshowMinimumMouseDragDistance" class="admin-input-container__input fantastic-slideshow-minimum-mouse-drag-distance" name="fantastic-slideshow-minimum-mouse-drag-distance" type="text" value="<?php echo get_option( 'fantastic-slideshow-minimum-mouse-drag-distance' ); ?>" />
                <span class="admin-input-container__trailing-text">px</span>
                <span class="admin-input-container__default-settings-text">Default: 100px</span>
            </div>
            <div class="admin-input-container">
                <span class="admin-input-container__label">Enable Pause on Hover</span>
                <label class="admin-input-container__label--right" for="fantasticSlideshowPauseOnHover0">No</label>
                <input id="fantasticSlideshowPauseOnHover0" class="admin-input-container__input fantastic-slideshow-pause-on-hover" name="fantastic-slideshow-pause-on-hover" type="radio" value="no" <?php if ( get_option( 'fantastic-slideshow-pause-on-hover' ) === "no" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowPauseOnHover1">Yes</label>
                <input id="fantasticSlideshowPauseOnHover1" class="admin-input-container__input fantastic-slideshow-pause-on-hover" name="fantastic-slideshow-pause-on-hover" type="radio" value="yes" <?php if ( get_option( 'fantastic-slideshow-pause-on-hover' ) === "yes" ) { echo "checked='checked'"; }; ?> />
                <span class="admin-input-container__default-settings-text">Default: No.</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-zoom-in-on-hover-percent">Zoom in on hover % (0-40%)</label>
                <input id="fantasticSlideshowZoomInOnHoverPercent" class="admin-input-container__input fantastic-slideshow-zoom-in-on-hover-percent" name="fantastic-slideshow-zoom-in-on-hover-percent" type="text" value="<?php echo get_option( 'fantastic-slideshow-zoom-in-on-hover-percent' ); ?>" />
                <span class="admin-input-container__trailing-text">%</span>
                <span class="admin-input-container__default-settings-text">Default: none/0%</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-hover-zoom-in-time">Zoom in hover time</label>
                <input id="fantasticSlideshowHoverZoomInTime" class="admin-input-container__input fantastic-slideshow-hover-zoom-in-time" name="fantastic-slideshow-hover-zoom-in-time" type="text" value="<?php echo get_option( 'fantastic-slideshow-hover-zoom-in-time' ); ?>" />
                <span class="admin-input-container__trailing-text">s</span>
                <span class="admin-input-container__default-settings-text">Default: 0.8s</span>
            </div>
            <div class="admin-input-container">
                <label class="admin-input-container__label" for="fantastic-slideshow-hover-zoom-transition-delay">Zoom in hover transition delay time</label>
                <input id="fantasticSlideshowHoverZoomTransitionDelay" class="admin-input-container__input fantastic-slideshow-hover-zoom-transition-delay" name="fantastic-slideshow-hover-zoom-transition-delay" type="number" step="any" min="0" max="2" value="<?php echo get_option( 'fantastic-slideshow-hover-zoom-transition-delay' ); ?>" />
                <span class="admin-input-container__trailing-text">s</span>
                <span class="admin-input-container__default-settings-text">Default: 0s (0 - 2s)</span>
            </div>
            <div class="admin-input-container">
                <span class="admin-input-container__label">Zoom in on hover transition effect</span>
                <label class="admin-input-container__label--right" for="fantasticSlideshowHoverZoomTransitionEffect0">Ease-In</label>
                <input id="fantasticSlideshowHoverZoomTransitionEffect0" class="admin-input-container__input fantastic-slideshow-hover-zoom-transition-effect" name="fantastic-slideshow-hover-zoom-transition-effect" type="radio" value="ease-in" <?php if ( get_option( 'fantastic-slideshow-hover-zoom-transition-effect' ) === "ease-in" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowHoverZoomTransitionEffect1">Linear</label>
                <input id="fantasticSlideshowHoverZoomTransitionEffect1" class="admin-input-container__input fantastic-slideshow-hover-zoom-transition-effect" name="fantastic-slideshow-hover-zoom-transition-effect" type="radio" value="linear" <?php if ( get_option( 'fantastic-slideshow-hover-zoom-transition-effect' ) === "linear" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowHoverZoomTransitionEffect2">Ease-out</label>
                <input id="fantasticSlideshowHoverZoomTransitionEffect2" class="admin-input-container__input fantastic-slideshow-hover-zoom-transition-effect" name="fantastic-slideshow-hover-zoom-transition-effect" type="radio" value="ease-out" <?php if ( get_option( 'fantastic-slideshow-hover-zoom-transition-effect' ) === "ease-out" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowHoverZoomTransitionEffect3">Ease</label>
                <input id="fantasticSlideshowHoverZoomTransitionEffect3" class="admin-input-container__input fantastic-slideshow-hover-zoom-transition-effect" name="fantastic-slideshow-hover-zoom-transition-effect" type="radio" value="ease" <?php if ( get_option( 'fantastic-slideshow-hover-zoom-transition-effect' ) === "ease" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowHoverZoomTransitionEffect4">Ease-in-out</label>
                <input id="fantasticSlideshowHoverZoomTransitionEffect4" class="admin-input-container__input fantastic-slideshow-hover-zoom-transition-effect" name="fantastic-slideshow-hover-zoom-transition-effect" type="radio" value="ease-in-out" <?php if ( get_option( 'fantastic-slideshow-hover-zoom-transition-effect' ) === "ease-in-out" ) { echo "checked='checked'"; }; ?> />
                <span class="admin-input-container__default-settings-text">Default: Ease-in.</span>
            </div>
            <div class="admin-input-container">
                <span class="admin-input-container__label">Show pause button</span>
                <label class="admin-input-container__label--right" for="fantasticSlideshowShowPauseButton0">No</label>
                <input id="fantasticSlideshowShowPauseButton0" class="admin-input-container__input fantastic-slideshow-show-pause-button" name="fantastic-slideshow-show-pause-button" type="radio" value="no" <?php if ( get_option( 'fantastic-slideshow-show-pause-button' ) === "no" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowShowPauseButton1">Yes</label>
                <input id="fantasticSlideshowShowPauseButton1" class="admin-input-container__input fantastic-slideshow-show-pause-button" name="fantastic-slideshow-show-pause-button" type="radio" value="yes" <?php if ( get_option( 'fantastic-slideshow-show-pause-button' ) === "yes" ) { echo "checked='checked'"; }; ?> />
                <span class="admin-input-container__default-settings-text">Default: Yes. Show pause-play button</span>
            </div>
            <div class="admin-input-container">
                <span class="admin-input-container__label">Enable Touch Dragging</span>
                <label class="admin-input-container__label--right" for="fantasticSlideshowEnableTouchDragging0">No</label>
                <input id="fantasticSlideshowEnableTouchDragging0" class="admin-input-container__input fantastic-slideshow-enable-touch-dragging" name="fantastic-slideshow-enable-touch-dragging" type="radio" value="no" <?php if ( get_option( 'fantastic-slideshow-enable-touch-dragging' ) === "no" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowEnableTouchDragging1">Yes</label>
                <input id="fantasticSlideshowEnableTouchDragging1" class="admin-input-container__input fantastic-slideshow-enable-touch-dragging" name="fantastic-slideshow-enable-touch-dragging" type="radio" value="yes" <?php if ( get_option( 'fantastic-slideshow-enable-touch-dragging' ) === "yes" ) { echo "checked='checked'"; }; ?> />
                <span class="admin-input-container__default-settings-text">Default: Yes. Touch dragging enabled</span>
            </div>
            <div class="admin-input-container">
                <span class="admin-input-container__label">Enable Mouse Dragging</span>
                <label class="admin-input-container__label--right" for="fantasticSlideshowEnableMouseDragging0">No</label>
                <input id="fantasticSlideshowEnableMouseDragging0" class="admin-input-container__input fantastic-slideshow-enable-mouse-dragging" name="fantastic-slideshow-enable-mouse-dragging" type="radio" value="no" <?php if ( get_option( 'fantastic-slideshow-enable-mouse-dragging' ) === "no" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowEnableMouseDragging1">Yes</label>
                <input id="fantasticSlideshowEnableMouseDragging1" class="admin-input-container__input fantastic-slideshow-enable-mouse-dragging" name="fantastic-slideshow-enable-mouse-dragging" type="radio" value="yes" <?php if ( get_option( 'fantastic-slideshow-enable-mouse-dragging' ) === "yes" ) { echo "checked='checked'"; }; ?> />
                <span class="admin-input-container__default-settings-text">Default: Yes. Mouse dragging enabled</span>
            </div>
            <div class="admin-input-container">
                <span class="admin-input-container__label">Show Arrows</span>
                <label class="admin-input-container__label--right" for="fantasticSlideshowShowArrows0">No</label>
                <input id="fantasticSlideshowShowArrows0" class="admin-input-container__input fantastic-slideshow-show-arrows" name="fantastic-slideshow-show-arrows" type="radio" value="hide" <?php if ( get_option( 'fantastic-slideshow-show-arrows' ) === "hide" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowShowArrows1">Yes</label>
                <input id="fantasticSlideshowShowArrows1" class="admin-input-container__input fantastic-slideshow-show-arrows" name="fantastic-slideshow-show-arrows" type="radio" value="show" <?php if ( get_option( 'fantastic-slideshow-show-arrows' ) === "show" ) { echo "checked='checked'"; }; ?> />
                <span class="admin-input-container__default-settings-text">Default: Yes, show arrows</span>
            </div>
            <div class="admin-input-container">
                <span class="admin-input-container__label">Show Arrows Only on Hovering Over Image</span>
                <label class="admin-input-container__label--right" for="fantasticSlideshowShowArrowsOnlyOnHoverOver0">No</label>
                <input id="fantasticSlideshowShowArrowsOnlyOnHoverOver0" class="admin-input-container__input fantastic-slideshow-show-arrows-only-on-hover-over" name="fantastic-slideshow-show-arrows-only-on-hover-over" type="radio" value="no" <?php if ( get_option( 'fantastic-slideshow-show-arrows-only-on-hover-over' ) === "no" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowShowArrowsOnlyOnHoverOver1">Yes</label>
                <input id="fantasticSlideshowShowArrowsOnlyOnHoverOver1" class="admin-input-container__input fantastic-slideshow-show-arrows-only-on-hover-over" name="fantastic-slideshow-show-arrows-only-on-hover-over" type="radio" value="yes" <?php if ( get_option( 'fantastic-slideshow-show-arrows-only-on-hover-over' ) === "yes" ) { echo "checked='checked'"; }; ?> />
                <span class="admin-input-container__default-settings-text">Default: No, show arrows at all times</span>
            </div>
            <div class="admin-input-container">
                <span class="admin-input-container__label">Show Slide Buttons</span>
                <label class="admin-input-container__label--right" for="fantasticSlideshowSlideButtons0">No</label>
                <input id="fantasticSlideshowSlideButtons0" class="admin-input-container__input fantastic-slideshow-show-slide-buttons" name="fantastic-slideshow-show-slide-buttons" type="radio" value="hide" <?php if ( get_option( 'fantastic-slideshow-show-slide-buttons' ) === "hide" ) { echo "checked='checked'"; }; ?> />
                <label class="admin-input-container__label--right" for="fantasticSlideshowSlideButtons1">Yes</label>
                <input id="fantasticSlideshowSlideButtons1" class="admin-input-container__input fantastic-slideshow-show-slide-buttons" name="fantastic-slideshow-show-slide-buttons" type="radio" value="show" <?php if ( get_option( 'fantastic-slideshow-show-slide-buttons' ) === "show" ) { echo "checked='checked'"; }; ?> />
                <span class="admin-input-container__default-settings-text">Default: Yes, show slide buttons</span>
            </div>
            <?php submit_button(); ?>
        </form>
    <?php
}


function fs_add_custom_metabox_info() {
    add_meta_box( 'custom-metabox', __( 'Slide Information' ), 'fs_url_custom_metabox', 'fantastic-slideshow', 'normal', 'low' );
}
add_action( 'admin_init', 'fs_add_custom_metabox_info' );


//Admin area HTML and logic 
function fs_url_custom_metabox() {
    global $post;
    
    wp_nonce_field( 'settings_group_nonce_save', 'settings_group_nonce' );
    
    
    /*Gather the input data, sanitize it, and update the database.*/
    $slidedescription = sanitize_text_field( get_post_meta( $post->ID, 'slidedescription', true ) );
    update_post_meta( $post->ID, 'slidedescription', $slidedescription );
    $slidelabel = sanitize_text_field( get_post_meta( $post->ID, 'slidelabel', true ) );
    update_post_meta( $post->ID, 'slidelabel', $slidelabel );
    $slideshowurl = sanitize_text_field( get_post_meta( $post->ID, 'slideshowurl', true ) );
    update_post_meta( $post->ID, 'slideshowurl', $slideshowurl );
    $slideimageislink = sanitize_text_field( get_post_meta( $post->ID, 'slideimageislink', true ) );
    update_post_meta( $post->ID, 'slideimageislink', $slideimageislink );
    $slidetitleislink = sanitize_text_field( get_post_meta( $post->ID, 'slidetitleislink', true ) );
    update_post_meta( $post->ID, 'slidetitleislink', $slidetitleislink );
    $slidetitlelinktab = sanitize_text_field( get_post_meta( $post->ID, 'slidetitlelinktab', true ) );
    update_post_meta( $post->ID, 'slidetitlelinktab', $slidetitlelinktab );
    $slideimagelinktab = sanitize_text_field( get_post_meta( $post->ID, 'slideimagelinktab', true ) );
    update_post_meta( $post->ID, 'slideimagelinktab', $slideimagelinktab );
    $slideshoworder = sanitize_text_field( get_post_meta( $post->ID, 'slideshoworder', true ) );
    if ( isset( $slideshoworder ) === false || $slideshoworder === "" ) {
        $slideshoworder = "n/a";
    }
    update_post_meta( $post->ID, 'slideshoworder', $slideshoworder );


    $errorstitle = "";
    if ( isset( $errorstitle ) ){
        echo $errorstitle;
    }
    
    $errorslabel = "";
    if ( isset( $errorslabel ) ){
        echo $errorslabel;
    }
   
    $errorslink = "";
    if ( !preg_match( "/http(s?):\/\//", $slideshowurl ) && $slideshowurl !== "" ) {
        $errorslink = "This URL is not valid";
        $slideshowurl = "http://";
    }
    
    if ( isset( $errorslink ) ){
        echo $errorslink;
    }
    
    $errorsorder = "";
    if ( isset( $errorsorder ) ){
        echo $errorsorder;
    }
    
    ?>
    <p>
        <label for="slidedescription">Slide Description:<br />
            <textarea id="slidedescription" name="slidedescription" rows="5" cols="25"><?php if ( isset( $slidedescription ) ) { echo $slidedescription; } ?></textarea>
        </label>
    </p>
    <p>
        <label for="slidelabel">Slide Label:<br />
            <input id="slidelabel" name="slidelabel" size="25" value="<?php if ( isset( $slidelabel ) ) { echo $slidelabel; } ?>" />
        </label>
    </p>
    <p>
        <label for="slideshowurl">Related URL:<br />
            <input id="slideshowurl" size="25" name="slideshowurl" value="<?php if ( isset( $slideshowurl ) ) { echo $slideshowurl; } ?>" />
        </label>
    </p>
    <p>Is Slideshow Image a Link?
        <input type="radio" id="slideimageislink0" name="slideimageislink" value="0" <?php if ( $slideimageislink === "0" ) { echo "checked='checked'"; } ?> />
        <label for="slideimageislink0">No</label>
        <input type="radio" id="slideimageislink1" name="slideimageislink" value="1" <?php if ( $slideimageislink === "1" ) { echo "checked='checked'"; } ?> />
        <label for="slideimageislink1">Yes</label>
    </p>
    <p>Is Slideshow Title a Link?
        <input type="radio" id="slidetitleislink0" name="slidetitleislink" value="0" <?php if ( $slidetitleislink === "0" ) { echo "checked='checked'"; } ?> />
        <label for="slidetitleislink0">No</label>
        <input type="radio" id="slidetitleislink1" name="slidetitleislink" value="1" <?php if ( $slidetitleislink === "1" ) { echo "checked='checked'"; } ?> />
        <label for="slidetitleislink1">Yes</label>
    </p>
    <p>Open Slideshow Title Link in New Tab?
        <input type="radio" id="slidetitlelinktab0" name="slidetitlelinktab" value="no" <?php if ( $slidetitlelinktab === "no" ) { echo "checked='checked'"; } ?> />
        <label for="slidetitlelinktab0">No</label>
        <input type="radio" id="slidetitlelinktab1" name="slidetitlelinktab" value="yes" <?php if ( $slidetitlelinktab === "yes" ) { echo "checked='checked'"; } ?> />
        <label for="slidetitlelinktab1">Yes</label>
    </p>
    <p>Open Slideshow Image Link in New Tab?
        <input type="radio" id="slideimagelinktab0" name="slideimagelinktab" value="no" <?php if ( $slideimagelinktab === "no" ) { echo "checked='checked'"; } ?> />
        <label for="slideimagelinktab0">No</label>
        <input type="radio" id="slideimagelinktab1" name="slideimagelinktab" value="yes" <?php if ( $slideimagelinktab === "yes" ) { echo "checked='checked'"; } ?> />
        <label for="slideimagelinktab1">Yes</label>
    </p>
    <p>
        <label for="slideshoworder">Slideshow Order:<br />
            <input id="slideshoworder" size="25" type="number" min="1" name="slideshoworder" value="<?php if ( isset( $slideshoworder ) ) { echo $slideshoworder; } ?>" />
        </label>
    </p>
 <?php 
}




//Save user provided field data.
function fs_save_custom_slidedescription( $post_id ) {
    global $post;
    
    $nonceToVerify = check_admin_referer( 'settings_group_nonce_save', 'settings_group_nonce' );
    
    if ( isset( $_POST['slidedescription'] ) ) {
        if ( $nonceToVerify ) {
            update_post_meta( $post->ID, 'slidedescription', $_POST['slidedescription'] );
        } else {
            wp_die( "Invalid wp nonce provided", array( 'response' => 403, ) );
        }
    } 
}
add_action( 'save_post', 'fs_save_custom_slidedescription' );

function fs_get_slidedescription( $post ) {
    $slidedescription = get_post_meta( $post->ID, 'slidedescription', true );
    return $slidedescription;
}


function fs_save_custom_slidelabel( $post_id ) {
    global $post;
    
    $nonceToVerify = check_admin_referer( 'settings_group_nonce_save', 'settings_group_nonce' );
    
    if ( isset( $_POST['slidelabel'] ) ) {
        if ( $nonceToVerify ) {
            update_post_meta( $post->ID, 'slidelabel', $_POST['slidelabel'] );
        } else {
            wp_die( "Invalid wp nonce provided", array( 'response' => 403, ) );
        }
    }
}
add_action( 'save_post', 'fs_save_custom_slidelabel' );

function fs_get_slidelabel( $post ) {
    $slidelabel = get_post_meta( $post->ID, 'slidelabel', true );
    return $slidelabel;
}


function fs_save_custom_url( $post_id ) {
    global $post;
    
    $nonceToVerify = check_admin_referer( 'settings_group_nonce_save', 'settings_group_nonce' );
    
    if ( isset( $_POST['slideshowurl'] ) ) {
        if ( $nonceToVerify ) {
            update_post_meta( $post->ID, 'slideshowurl', $_POST['slideshowurl'] );
        } else {
            wp_die( "Invalid wp nonce provided", array( 'response' => 403, ) );
        }
    }
}
add_action( 'save_post', 'fs_save_custom_url' );

function fs_get_url( $post ) {
    $slideshowurl = get_post_meta( $post->ID, 'slideshowurl', true );
    return $slideshowurl;
}


function fs_save_custom_slideimageislink( $post_id ) {
    global $post;
    
    $nonceToVerify = check_admin_referer( 'settings_group_nonce_save', 'settings_group_nonce' );
    
    if ( isset( $_POST['slideimageislink'] ) ) {
        if ( $nonceToVerify ) {
            update_post_meta( $post->ID, 'slideimageislink', $_POST['slideimageislink'] );
        } else {
            wp_die( "Invalid wp nonce provided", array( 'response' => 403, ) );
        }
    }
}
add_action( 'save_post', 'fs_save_custom_slideimageislink' );

function fs_get_slideimageislink( $post ) {
    $slideimageislink = get_post_meta( $post->ID, 'slideimageislink', true );
    return $slideimageislink;
}


function fs_save_custom_slidetitleislink( $post_id ) {
    global $post;
    
    $nonceToVerify = check_admin_referer( 'settings_group_nonce_save', 'settings_group_nonce' );
    
    if ( isset( $_POST['slidetitleislink'] ) ) {
        if ( $nonceToVerify ) {
            update_post_meta( $post->ID, 'slidetitleislink', $_POST['slidetitleislink'] );
        } else {
            wp_die( "Invalid wp nonce provided", array( 'response' => 403, ) );
        }
    }
}
add_action( 'save_post', 'fs_save_custom_slidetitleislink' );

function fs_get_slidetitleislink( $post ) {
    $slidetitleislink = get_post_meta( $post->ID, 'slidetitleislink', true );
    return $slidetitleislink;
}


function fs_save_custom_slidetitlelinktab( $post_id ) {
    global $post;
    
    $nonceToVerify = check_admin_referer( 'settings_group_nonce_save', 'settings_group_nonce' );
    
    if ( isset( $_POST['slidetitlelinktab'] ) ) {
        if ( $nonceToVerify ) {
            update_post_meta( $post->ID, 'slidetitlelinktab', $_POST['slidetitlelinktab'] );
        } else {
            wp_die( "Invalid wp nonce provided", array( 'response' => 403, ) );
        }
    }
}
add_action( 'save_post', 'fs_save_custom_slidetitlelinktab' );

function fs_get_slidetitlelinktab( $post ) {
    $slidetitlelinktab = get_post_meta( $post->ID, 'slidetitlelinktab', true );
    return $slidetitlelinktab;
}


function fs_save_custom_slideimagelinktab( $post_id ) {
    global $post;
    
    $nonceToVerify = check_admin_referer( 'settings_group_nonce_save', 'settings_group_nonce' );
    
    if ( isset( $_POST['slideimagelinktab'] ) ) {
        if ( $nonceToVerify ) {
            update_post_meta( $post->ID, 'slideimagelinktab', $_POST['slideimagelinktab'] );
        } else {
            wp_die( "Invalid wp nonce provided", array( 'response' => 403, ) );
        }
    }
}
add_action( 'save_post', 'fs_save_custom_slideimagelinktab' );

function fs_get_slideimagelinktab( $post ) {
    $slideimagelinktab = get_post_meta( $post->ID, 'slideimagelinktab', true );
    return $slideimagelinktab;
}


function fs_save_custom_order( $post_id ) {
    global $post;
    
    $nonceToVerify = check_admin_referer( 'settings_group_nonce_save', 'settings_group_nonce' );
    
    if ( isset( $_POST['slideshoworder'] ) ) {
        if ( $nonceToVerify ) {
            update_post_meta( $post->ID, 'slideshoworder', $_POST['slideshoworder'] );
        } else {
            wp_die( "Invalid wp nonce provided", array( 'response' => 403, ) );
        }
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
                <p class="fantastic-slideshow__instructions__title">Fantastic Slideshow</p>
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
            'slidedescription' => __( 'Slide Description', 'fs' ),
            'slidelabel' => __( 'Slide Label', 'fs' ),
            'order' => __( 'Order' ),
            'date' => __( 'Date' ),
        );   
        return $columns;
    }


    //Add images and other data to posts admin
    add_action( 'manage_posts_custom_column', 'fs_add_data_to_admin_columns', 10, 2 );
    function fs_add_data_to_admin_columns( $column, $post_id ) {
        if ( 'image' === $column ) {
            echo get_the_post_thumbnail( $post_id, array( 100, 100 ) );
        }
        if ( 'slidedescription' === $column ) {
            echo get_post_meta( $post_id, 'slidedescription', true );
        }
        if ( 'slidelabel' === $column ) {
            echo get_post_meta( $post_id, 'slidelabel', true );
        }
        if ( 'order' === $column ) {
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
    
    $hideArrowsExceptOnHover = "";
    if ( get_option( "fantastic-slideshow-show-arrows-only-on-hover-over" ) === "yes" ) {
        $hideArrowsExceptOnHover = "hide-except-on-hover-over";
    } else {
        $hideArrowsExceptOnHover = "show-only-on-hover-over";
    }
    
    $showPauseButton = get_option("fantastic-slideshow-show-pause-button");
    if ( $showPauseButton === "no" ) {
        $showPauseButton = "hide";
    }

    $soomInOnHover = "";
    if ( get_option( "fantastic-slideshow-zoom-in-on-hover-percent" ) > 0 ) {
        $soomInOnHover = "zoom-in-on-hover";
    }
            
    
    //Get all slides.
    $posts = get_posts( $args );
    $pluginContainer .= '<div class="slideshow ' . $hideArrowsExceptOnHover . ' ' . $soomInOnHover . '">';
    $pluginContainer .= '<h3 class="slideshow__heading">' . get_option( 'fantastic-slideshow-leading-text' ) . '</h3>';
    $pluginContainer .= '<div class="slideshow__inner-wrapper">';
    
    $count = 0;
    foreach ( $posts as $post ) {
        $url_image = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'full' );
        $url_altText = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
        $slideDescription = fs_get_slidedescription( $post );
        $slideLabel = fs_get_slidelabel( $post );
        $link = fs_get_url( $post );
        $slideImageIsLink = fs_get_slideimageislink( $post );
        $slideTitleIsLink = fs_get_slidetitleislink( $post );
        $slideTitleLinkTab = "";
        $slideImageLinkTab = "";
        
        if ( empty( $slideDescription ) ) {
            $pluginContainer .= '<div class="slide slide' . $count . '">';
        } else {
            $pluginContainer .= '<div class="slide slide' . $count . ' has-description">';
        }
        
        if ( fs_get_slidetitlelinktab( $post ) === "yes" ){
            $slideTitleLinkTab = "target='_blank'";
        } else {
            $slideTitleLinkTab = "";
        }
        
        if ( fs_get_slideimagelinktab( $post ) === "yes" ){
            $slideImageLinkTab = "target='_blank'";
        } else {
            $slideImageLinkTab = "";
        }
        
        
        if ( !empty( $url_image ) ) {
            $pluginContainer .= '<div class="slide__image" style="background: url(' . $url_image . ') 50% 50%/cover no-repeat;">';
            if ( $url_image !== null && $slideImageIsLink === "1" ) { 
                $pluginContainer .= '<a class="slide__image__link" href="' . $link . '" ' . $slideImageLinkTab . '></a>';        
            }
            $pluginContainer .= '</div>';
        }
        $pluginContainer .= '<div class="slide__content">';
        if ( !empty( $post->post_title ) ) {
            $pluginContainer .= '<div class="slide__title">';
            if ( $slideTitleIsLink === "1" ) {
                $pluginContainer .= '<a class="slide__title-link" href="' . $link . '" ' . $slideTitleLinkTab . '>';
            }
            $pluginContainer .=  $post->post_title;
            $pluginContainer .= '</div>';
            if ( $slideTitleIsLink === "1" ) {
                $pluginContainer .= '</a>';
            }
        }
        if ( !empty( $slideDescription ) ) {
            $pluginContainer .= '<div class="slide__description">' . $slideDescription . '</div>';
        }
        $pluginContainer .= '</div>';
        $pluginContainer .= '<div class="slide__label">' . $slideLabel . '</div>';

        $pluginContainer .= '</div>';
        $count++;
    }
    $pluginContainer .= '<div class="slideshow__icon left ' . get_option( "fantastic-slideshow-show-arrows" ) . ' ' . $hideArrowsExceptOnHover . '">';
    $pluginContainer .= '<div class="slideshow__icon__link">&#10094;</div>';
    $pluginContainer .= '</div>';
    $pluginContainer .= '<div class="slideshow__icon right ' . get_option( "fantastic-slideshow-show-arrows" ) . ' ' . $hideArrowsExceptOnHover . '">';
    $pluginContainer .= '<div class="slideshow__icon__link">&#10095;</div>';
    $pluginContainer .= '</div>';
    $pluginContainer .= '</div>';
    
    $pluginContainer .= '<div class="slideshow__buttons ' . get_option( "fantastic-slideshow-show-slide-buttons" ) . '">';
   
    for( $i = 0; $i < count($posts); $i++){
        $pluginContainer .= '<div id="slideButton' . $i . '" class="slideshow__slide-button">';
        $pluginContainer .= '<div class="slideshow__button-text"></div>';
        $pluginContainer .= '</div>';
    }
    
    $pluginContainer .= '<div id="pausePlayButton" class="' . $showPauseButton . '"></div>'; 
    $pluginContainer .= '</div>';
    $pluginContainer .= '<div class="slideshow__settings">';
    $pluginContainer .= '<div class="slideshow__speed">' . get_option( 'fantastic-slideshow-slide-speed' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__transition-speed">' . get_option( 'fantastic-slideshow-slide-transition-speed' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__autoplay">' . get_option( 'fantastic-slideshow-is-autoplay' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__show-arrows-only-on-hover-over">' . get_option( 'fantastic-slideshow-show-arrows-only-on-hover-over' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__minimum-touch-drag-distance">' . get_option( 'fantastic-slideshow-minimum-touch-drag-distance' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__minimum-mouse-drag-distance">' . get_option( 'fantastic-slideshow-minimum-mouse-drag-distance' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__pause-on-hover">' . get_option( 'fantastic-slideshow-pause-on-hover' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__zoom-in-on-hover-percent">' . get_option( 'fantastic-slideshow-zoom-in-on-hover-percent' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__hover-zoom-in-time">' . get_option( 'fantastic-slideshow-hover-zoom-in-time' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__hover-zoom-transition-delay">' . get_option( 'fantastic-slideshow-hover-zoom-transition-delay' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__hover-zoom-transition-effect">' . get_option( 'fantastic-slideshow-hover-zoom-transition-effect' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__show-pause-button">' . get_option( 'fantastic-slideshow-show-pause-button' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__enable-touch-dragging">' . get_option( 'fantastic-slideshow-enable-touch-dragging' ) . '</div>';
    $pluginContainer .= '<div class="slideshow__enable-mouse-dragging">' . get_option( 'fantastic-slideshow-enable-mouse-dragging' ) . '</div>';
    $pluginContainer .= '</div>';
    $pluginContainer .= '</div>';
    return $pluginContainer;
}
add_shortcode( "fantastic_slideshow", "fs_load_slideshows" );
add_filter( 'widget_text', 'do_shortcode' );

