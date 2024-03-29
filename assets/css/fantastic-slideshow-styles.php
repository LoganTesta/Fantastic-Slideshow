
<?php

header ( "Content-type: text/css; charset: UTF-8" );

require ( '../../../../../wp-load.php' );
include ( plugin_dir_path(__FILE__) . "/fantastic-slideshow.php" );

$leadingTextPosition = get_option( 'fantastic-slideshow-leading-text-position' );
$imageBorderRadius = get_option( 'fantastic-slideshow-border-radius' );
$slideContentBackgroundOpacity = get_option( 'fantastic-slideshow-slide-content-background-opacity' );
$slideButtonWidth = get_option( 'fantastic-slideshow-slide-button-width' );

$slideImageWidth = (int)( get_option( 'fantastic-slideshow-image-width' ) );
if ( $slideImageWidth <= 0 ) {
    $slideImageWidth = 670;
} elseif ( 0 < $slideImageWidth && $slideImageWidth < 400 ) {
    $slideImageWidth = 400;
} elseif ( $slideImageWidth > 1800 ) {
    $slideImageWidth = 1800;
}

$slideImageHeight = (int)( get_option( 'fantastic-slideshow-image-height' ) );
if ( $slideImageHeight <= 0 ) {
    $slideImageHeight = 400;
} elseif ( 0 < $slideImageHeight && $slideImageHeight < 200 ) {
    $slideImageHeight = 200;
} elseif ( $slideImageHeight > 1200 ) {
    $slideImageHeight = 1200;
}


$zoomInOnHoverPercent = get_option( 'fantastic-slideshow-zoom-in-on-hover-percent' )/100;
if ( $zoomInOnHoverPercent < 0 ) {
    $zoomInOnHoverPercent = 0;
} 
if ( $zoomInOnHoverPercent > 0.4 ) {
    $zoomInOnHoverPercent = 0.4;
} 
$zoomInOnHoverPercent++;

$hoverZoomInTime = get_option( 'fantastic-slideshow-hover-zoom-in-time' );
$hoverZoomTransitionDelay = get_option( 'fantastic-slideshow-hover-zoom-transition-delay' );
if ( $hoverZoomTransitionDelay < 0 ) {
    $hoverZoomTransitionDelay = 0;
}
if ( $hoverZoomTransitionDelay > 2 ) {
    $hoverZoomTransitionDelay = 2;
}
$hoverZoomTransitionEffect = get_option( 'fantastic-slideshow-hover-zoom-transition-effect' );

$showPauseButton = get_option( 'fantastic-slideshow-show-pause-button' );

?>


html { }
.slideshow { width: 100%; max-width: <?php echo $slideImageWidth; ?>px; font-size: 16px; font-weight: normal; }
.slideshow__heading { text-align: <?php echo $leadingTextPosition; ?>; }
.slideshow__inner-wrapper { position: relative; max-width: <?php echo $slideImageWidth; ?>px; height: <?php echo 0.6 * $slideImageHeight; ?>px; }

.slide { position: absolute; top: 0; left: 0; width: 100%; max-width: <?php echo $slideImageWidth; ?>px; height: <?php echo 0.6 * $slideImageHeight; ?>px; overflow: hidden; }
.slide__content { display: block; position: absolute; bottom: 0; left: 0%; right: 0%; padding-top: 8px; padding-bottom: 8px; background-color: rgba(255, 255, 255, <?php echo $slideContentBackgroundOpacity; ?>); }
.slide__title-link { }
.slide__title { width: 86%; margin-left: auto; margin-right: auto; font-size: 24px; font-weight: bold; text-align: center; }
.slide.has-description .slide__title { }
.slide__description { display: none; }
.slide.has-description .slide__description { display: block; width: 96%; margin-left: auto; margin-right: auto; font-size: 20px; font-weight: bold; text-align: center; }
.slide__image { width: 100%; height: <?php echo 0.6 * $slideImageHeight; ?>px; object-fit: cover; border-radius: <?php echo $imageBorderRadius; ?>px; }
.slide__image__link { display: block; width: auto; height: 100%; }
.slide__label { display: inline-block; position: absolute; top: 20px; right: 15px; padding: 2px 15px; font-size: 18px; color: #000000; background-color: rgba(255, 255, 255, 0.8); }
.slideshow.zoom-in-on-hover .slide__image { transition: <?php echo $hoverZoomInTime; ?>s <?php echo $hoverZoomTransitionEffect; ?>; transition-delay: <?php echo $hoverZoomTransitionDelay; ?>s; }
.slideshow.zoom-in-on-hover .slide__image:hover { margin-bottom: <?php echo $zoomInOnHoverPercent; ?>px; transform: scale(<?php echo $zoomInOnHoverPercent; ?>); transition: <?php echo $hoverZoomInTime; ?>s <?php echo $hoverZoomTransitionEffect; ?>; transition-delay: <?php echo $hoverZoomTransitionDelay; ?>s; }

.slideshow__icon { width: 34px; height: 34px; }
.slideshow__icon.hide { display: none; }
.slideshow__icon__link { border-radius: 4px; font-size: 25px; line-height: 34px; text-align: center; background-color: rgba(255, 255, 255, 0.8); transition: 0.2s ease-in; }
.slideshow__icon__link:hover { background-color: rgba(255, 255, 255, 0.95); transition: 0.2s ease-in; }
.slideshow__icon.left { position: absolute; top: <?php echo 0.5 * ( 0.6 * $slideImageHeight - 34); ?>px; left: 5px; }
.slideshow__icon.right { position: absolute; top: <?php echo 0.5 * ( 0.6 * $slideImageHeight - 34); ?>px; right: 5px; }
.slideshow__icon:hover { cursor: pointer; }
.slideshow.hide-except-on-hover-over .slideshow__icon.hide-except-on-hover-over { opacity: 0; transition: 0.4s ease-in; }
.slideshow.hide-except-on-hover-over .slideshow__icon { opacity: 1; transition: 0.4s ease-in; }

.slideshow__buttons { position: relative; }
.slideshow__buttons.hide { display: none; }
.slideshow__buttons:hover { cursor: pointer; }
.slideshow__slide-button { display: block; float: left; opacity: 0.4; width: <?php echo $slideButtonWidth; ?>px; height: <?php echo $slideButtonWidth; ?>px; margin-top: 10px; margin-left: 20px; border-radius: 4px; background-color: #333333; transition: 0.2s ease-in; }
.slideshow__slide-button:hover { opacity: 0.2; transition: 0.2s ease-in; }
.slideshow__slide-button.currentSlideButton { opacity: 1; transition: 0.2s ease-in; }
.slideshow__slide-button.currentSlideButton:hover { opacity: 0.8; transition: 0.2s ease-in; }
#slideButton0 { margin-left: 0; }
#pausePlayButton { display: block; float: left; width: <?php echo $slideButtonWidth; ?>px; height: <?php echo $slideButtonWidth; ?>px; margin-top: 10px; margin-left: 20px; border-radius: 4px; background: url(../images/pause-button.png) 50% 50%/cover no-repeat; }
#pausePlayButton.hide { display: none; }
#pausePlayButton.paused { background: url(../images/play-button.png) 50% 50%/cover no-repeat; }

.slideshow__settings { display: none; }



@media only screen and (min-width: 700px){

}



@media only screen and (min-width: 1200px){ 
   
    .slideshow { }
    .slideshow__inner-wrapper { width: <?php echo $slideImageWidth; ?>px; height: <?php echo $slideImageHeight; ?>px; }
    
    .slide { width: <?php echo $slideImageWidth; ?>px; height: <?php echo $slideImageHeight; ?>px; }
    .slide__image { height: <?php echo $slideImageHeight; ?>px; }
    
    .slideshow__icon.left { position: absolute; top: <?php echo 0.5 * ($slideImageHeight - 34); ?>px; left: 15px; }
    .slideshow__icon.right { position: absolute; top: <?php echo 0.5 * ($slideImageHeight - 34); ?>px; right: 15px; }

}
