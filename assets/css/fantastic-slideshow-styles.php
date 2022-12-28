
<?php

header ( "Content-type: text/css; charset: UTF-8" );

require ( '../../../../../wp-load.php' );
include ( plugin_dir_path(__FILE__) . "/fantastic-slideshow.php" );

$imageBorderRadius = get_option( 'fantastic-slideshow-border-radius' );

$slideImageWidth = (int)( get_option( 'fantastic-slideshow-image-width' ) );
if ( $slideImageWidth <= 0 ) {
    $slideImageWidth = 670;
} elseif ( 0 < $slideImageWidth && $slideImageWidth < 400 ) {
    $slideImageWidth = 400;
} elseif ( $slideImageWidth > 800 ) {
    $slideImageWidth = 800;
}

?>


.slideshow { width: 100%; font-size: 16px; font-weight: normal; }
.slideshow__inner-wrapper { position: relative; max-width: <?php echo $slideImageWidth; ?>px; height: 400px; }

.slide { position: absolute; top: 0; left: 0; width: 100%; max-width: <?php echo $slideImageWidth; ?>px; }
.slide__title { position: relative; top: -50px; width: 90%; margin-left: auto; margin-right: auto; font-size: 24px; font-weight: bold; text-align: center; background-color: rgba(255, 255, 255, 0.8); }
.slide__image { width: 100%; height: 240px; object-fit: cover; border-radius: <?php echo $imageBorderRadius; ?>px; }
.slide__label { padding-left: 20px; font-size: 18px; }

.slideshow__icon__link { padding: 10px; border: 2px solid rgba(0, 0, 0, 0.8); border-radius: 4px; background-color: rgba(255, 255, 255, 0.8); }
.slideshow__icon.left { position: absolute; top: 180px; left: 5px; }
.slideshow__icon.right { position: absolute; top: 180px; right: 5px; }
.slideshow__icon:hover { cursor: pointer; }

.slideshow__buttons { position: relative; }
.slideshow__buttons:hover { cursor: pointer; }
.slideshow__slide-button { display: block; float: left; width: 30px; height: 30px; margin-top: 10px; margin-left: 20px; border-radius: 4px; background-color: #333333; }
#slideButton0 { margin-left: 0; }
#pausePlayButton { display: block; float: left; width: 30px; height: 30px; margin-top: 10px; margin-left: 20px; border-radius: 4px; background: url(../images/pause-button.png) 50% 50%/cover no-repeat; }
#pausePlayButton.paused { background: url(../images/play-button.png) 50% 50%/cover no-repeat; }



@media only screen and (min-width: 700px){

    .slideshow__icon.left { position: absolute; top: 180px; left: 15px; }
    .slideshow__icon.right { position: absolute; top: 180px; right: 15px; }

}



@media only screen and (min-width: 1200px){ 
   
    .slideshow { width: <?php echo $slideImageWidth; ?>px; }
    .slideshow__inner-wrapper { width: <?php echo $slideImageWidth; ?>px; }
    
    .slide { width: <?php echo $slideImageWidth; ?>px; }
    .slide__image { height: 400px; }

}
