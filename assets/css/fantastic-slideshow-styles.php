
<?php

header ( "Content-type: text/css; charset: UTF-8" );

require ( '../../../../../wp-load.php' );
include ( plugin_dir_path(__FILE__) . "/fantastic-slideshow.php" );

?>


.slideshow { font-size: 16px; font-weight: normal; }
.slideshow__inner-wrapper { position: relative; width: 670px; height: 400px; }

.slide { position: absolute; top: 0; left: 0; }
.slide__title { font-size: 24px; font-weight: bold; text-align: center; }
.slide__image { width: 100%; height: 240px; object-fit: cover; }
.slide__description { font-size: 18px; }
.slide__label { padding-left: 20px; font-size: 18px; }

.slide-button { display: block; float: left; width: 30px; height: 30px; margin-top: 10px; margin-left: 20px; border-radius: 4px; background-color: #333333; }
#slideButton0 { margin-left: 0; }
#pausePlayButton { display: block; float: left; width: 30px; height: 30px; margin-top: 10px; margin-left: 20px; border-radius: 4px; background-color: #333333; }



@media only screen and (min-width: 700px){

}



@media only screen and (min-width: 1200px){ 
   
.slide__image { width: 670px; height: 400px; }

}
