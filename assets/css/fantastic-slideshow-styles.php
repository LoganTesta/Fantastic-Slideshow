
<?php

header ( "Content-type: text/css; charset: UTF-8" );

require ( '../../../../../wp-load.php' );
include ( plugin_dir_path(__FILE__) . "/fantastic-slideshow.php" );

$leadingTextPosition = get_option( 'fantastic-slideshow-leading-text-position' );
$imageBorderRadius = get_option( 'fantastic-slideshow-border-radius' );
$slideButtonWidth = get_option( 'fantastic-slideshow-slide-button-width' );

$slideImageWidth = (int)( get_option( 'fantastic-slideshow-image-width' ) );
if ( $slideImageWidth <= 0 ) {
    $slideImageWidth = 670;
} elseif ( 0 < $slideImageWidth && $slideImageWidth < 400 ) {
    $slideImageWidth = 400;
} elseif ( $slideImageWidth > 800 ) {
    $slideImageWidth = 800;
}

$slideImageHeight = (int)( get_option( 'fantastic-slideshow-image-height' ) );
if ( $slideImageHeight <= 0 ) {
    $slideImageHeight = 400;
} elseif ( 0 < $slideImageHeight && $slideImageHeight < 200 ) {
    $slideImageHeight = 200;
} elseif ( $slideImageHeight > 600 ) {
    $slideImageHeight = 600;
}

?>


.slideshow { width: 100%; font-size: 16px; font-weight: normal; }
.slideshow__heading { text-align: <?php echo $leadingTextPosition; ?>; }
.slideshow__inner-wrapper { position: relative; max-width: <?php echo $slideImageWidth; ?>px; height: <?php echo 0.6 * $slideImageHeight; ?>px; }

.slide { position: absolute; top: 0; left: 0; width: 100%; max-width: <?php echo $slideImageWidth; ?>px; height: <?php echo 0.6 * $slideImageHeight; ?>px; }
.slide__content { position: absolute; bottom: 0; left: 0%; right: 0%; background-color: rgba(255, 255, 255, 0.8); }
.slide__title-link { }
.slide__title { width: 86%; padding-top: 5px; padding-bottom: 0; margin-left: auto; margin-right: auto; font-size: 24px; font-weight: bold; text-align: center; }
.slide.has-description .slide__title { }
.slide__description { display: none; }
.slide.has-description .slide__description { display: block; width: 96%; padding-top: 0; padding-bottom: 5px; margin-left: auto; margin-right: auto; font-size: 20px; font-weight: bold; text-align: center; }
.slide__image { width: 100%; height: <?php echo 0.6 * $slideImageHeight; ?>px; object-fit: cover; border-radius: <?php echo $imageBorderRadius; ?>px; }
.slide__label { display: inline-block; position: absolute; top: 20px; right: 15px; padding: 2px 15px; font-size: 18px; color: #000000; background-color: rgba(255, 255, 255, 0.8); }

.slideshow__icon { width: 34px; height: 34px; }
.slideshow__icon__link { border-radius: 4px; font-size: 25px; line-height: 34px; text-align: center; background-color: rgba(255, 255, 255, 0.8); transition: 0.2s ease-in; }
.slideshow__icon__link:hover { background-color: rgba(255, 255, 255, 0.95); transition: 0.2s ease-in; }
.slideshow__icon.left { position: absolute; top: <?php echo 0.5 * ( 0.6 * $slideImageHeight - 34); ?>px; left: 5px; }
.slideshow__icon.right { position: absolute; top: <?php echo 0.5 * ( 0.6 * $slideImageHeight - 34); ?>px; right: 5px; }
.slideshow__icon:hover { cursor: pointer; }

.slideshow__buttons { position: relative; }
.slideshow__buttons:hover { cursor: pointer; }
.slideshow__slide-button { display: block; float: left; opacity: 0.3; width: <?php echo $slideButtonWidth; ?>px; height: <?php echo $slideButtonWidth; ?>px; margin-top: 10px; margin-left: 20px; border-radius: 4px; background-color: #333333; transition: 0.2s ease-in; }
.slideshow__slide-button:hover { opacity: 0.8; transition: 0.2s ease-in; }
.slideshow__slide-button.currentSlideButton { opacity: 1; transition: 0.2s ease-in; }
.slideshow__slide-button.currentSlideButton:hover { opacity: 1; transition: 0.2s ease-in; }
#slideButton0 { margin-left: 0; }
#pausePlayButton { display: block; float: left; width: <?php echo $slideButtonWidth; ?>px; height: <?php echo $slideButtonWidth; ?>px; margin-top: 10px; margin-left: 20px; border-radius: 4px; background: url(../images/pause-button.png) 50% 50%/cover no-repeat; }
#pausePlayButton.paused { background: url(../images/play-button.png) 50% 50%/cover no-repeat; }

.slideshow__settings { display: none; }



@media only screen and (min-width: 700px){

}



@media only screen and (min-width: 1200px){ 
   
    .slideshow { width: <?php echo $slideImageWidth; ?>px; }
    .slideshow__inner-wrapper { width: <?php echo $slideImageWidth; ?>px; height: <?php echo $slideImageHeight; ?>px; }
    
    .slide { width: <?php echo $slideImageWidth; ?>px; height: <?php echo $slideImageHeight; ?>px; }
    .slide__image { height: <?php echo $slideImageHeight; ?>px; }
    
    .slideshow__icon.left { position: absolute; top: <?php echo 0.5 * ($slideImageHeight - 34); ?>px; left: 15px; }
    .slideshow__icon.right { position: absolute; top: <?php echo 0.5 * ($slideImageHeight - 34); ?>px; right: 15px; }

}
