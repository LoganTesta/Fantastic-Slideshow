
<?php

header ( "Content-type: text/css; charset: UTF-8" );

require ( '../../../../../wp-load.php' );
include ( plugin_dir_path(__FILE__) . "/fantastic-slideshow.php" );

?>


.slideshow { font-size: 16px; font-weight: normal; }

.slide { }
.slide__title { font-size: 24px; font-weight: bold; text-align: center; }
.slide__image { width: 100%; height: 400px; object-fit: cover; }
.slide__description { font-size: 18px; }
.slide__label { padding-left: 20px; font-size: 18px; }

.slide-button { display: inline-block; width: 30px; height: 30px; margin-left: 20px; border-radius: 4px; background-color: #333333; }
#slideButton0 { margin-left: 0; }
#pausePlayButton { display: inline-block; width: 40px; height: 30px; border-radius: 4px; background-color: #333333; }



@media only screen and (min-width: 700px){

}



@media only screen and (min-width: 1200px){ 
    
}
