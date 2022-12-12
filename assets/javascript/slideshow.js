
window.addEventListener("load", function() {

    /*Start of Slideshow */
    let currentSlide;
    let slideshowCounter = 0;
    let paused = false;
    let updateSlideSettings = true;
    let currentSlideNumber = 0;
    const maxSlideNumber = 2;
    let pausePlayButton;
    let slideTitle;

    let slideButton0 = document.getElementById('slideButton0');
    let slideButton1 = document.getElementById('slideButton1');
    let slideButton2 = document.getElementById('slideButton2');

    slideButton0.addEventListener('click', function () {
        setSlide(0);
    }, false);
    slideButton1.addEventListener('click', function () {
        setSlide(1);
    }, false);
    slideButton2.addEventListener('click', function () {
        setSlide(2);
    }, false);


    let backIcon = document.getElementsByClassName("slideshow__icon")[0];
    let forwardIcon = document.getElementsByClassName("slideshow__icon")[1];

    backIcon.addEventListener('click', function () {
       setSlide(currentSlideNumber - 1);
    }, false);

    forwardIcon.addEventListener('click', function () {
       setSlide(currentSlideNumber + 1);
    }, false);



    function init() {
        currentSlide = document.getElementsByClassName("slide__image")[0];
        slideTitle = document.getElementsByClassName("slide__title")[0];
        pausePlayButton = document.getElementById("pausePlayButton");
        currentSlide.style.opacity = 0;
        setInterval(function () {
            runFunctions();
        }, 10);
    }
    window.onload = init();


    function runFunctions() {
        runSlideShow();
    }

    function runSlideShow() {

        if (paused === false) {
            if (slideshowCounter === 0) {
                currentSlide.style.opacity = 0;
            }
            if (slideshowCounter < 200) {
                currentSlide.style.opacity = parseFloat(currentSlide.style.opacity) + 0.005;
            }
            if (200 <= slideshowCounter && slideshowCounter < 700) {
                currentSlide.style.opacity = 1;
            }
            if (slideshowCounter >= 700) {
                currentSlide.style.opacity = parseFloat(currentSlide.style.opacity) - 0.005;
            }
            if (slideshowCounter >= 900) {
                slideshowCounter = 0;
                updateSlideSettings = true;
                currentSlide.style.opacity = 0;
                currentSlideNumber++;
            }

            if (currentSlideNumber < 0) {
                currentSlideNumber = maxSlideNumber;
            } else if (currentSlideNumber > maxSlideNumber) {
                currentSlideNumber = 0;
            }

            if (updateSlideSettings) {
                updateSlideSettings = false;
                if (currentSlideNumber === 0) {
                    slideTitle.innerHTML = "Slide 1";
                    slideButton0.style.opacity = 1.0;
                    slideButton1.style.opacity = 0.40;
                    slideButton2.style.opacity = 0.40;
                } else if (currentSlideNumber === 1) {
                    slideTitle.innerHTML = "Slide 2";
                    slideButton0.style.opacity = 0.40;
                    slideButton1.style.opacity = 1.0;
                    slideButton2.style.opacity = 0.40;
                } else if (currentSlideNumber === 2) {
                    slideTitle.innerHTML = "Slide 3";
                    slideButton0.style.opacity = 0.40;
                    slideButton1.style.opacity = 0.40;
                    slideButton2.style.opacity = 1.0;
                } 
            }
            slideshowCounter++;
        }
    }

    function togglePausePlay() {
        paused = !paused;
        if (paused === false) {
            pausePlayButton.classList.remove("paused");
        } else if (paused) {
            pausePlayButton.classList.add("paused");
        }
    }
    let pausePlay = document.getElementById("pausePlayButton");
    pausePlay.addEventListener("click", togglePausePlay, false);

    function setSlide(slideNumber) {
        slideshowCounter = 50;
        currentSlideNumber = slideNumber;
        paused = false;
        pausePlayButton.classList.remove("paused");
        updateSlideSettings = true;
    }


   // Allow touch events to interact with slideshow.
    let initialTouchX = 0;

    let slideshowImage = document.getElementsByClassName("slide")[0];
    slideshowImage.addEventListener("touchstart", getTouchCoords, false);
    slideshowImage.addEventListener("touchend", getFinalTouchCoords, false);

    function getTouchCoords(event){
        let touchX = event.touches[0].clientX;
        let touchY = event.touches[0].clientY;

        initialTouchX = touchX;  
    }

    function getFinalTouchCoords(event){
        let finalTouchX = event.changedTouches[0].clientX;
        let finalTouchY = event.changedTouches[0].clientY;

        if (finalTouchX - initialTouchX > 80){
            setSlide(currentSlideNumber - 1);
        } else if (initialTouchX - finalTouchX > 80){
            setSlide(currentSlideNumber + 1);
        }
    }
    
    
    // Allow mouse dragging events to interact with slideshow.
    slideshowImage.addEventListener("mousedown", getMouseDownCoords, false);
    slideshowImage.addEventListener("mouseup", getMouseUpsCoords, false);
    let mouseDown = false;
    
    let initialMouseDownX = 0;
    
    function getMouseDownCoords(event){  
        let mouseX = event.offsetX;
        initialMouseDownX = mouseX;
        slideshowImage.style.cursor = "grabbing";
    }
    
    function getMouseUpsCoords(event){  
        let mouseFinalX = event.offsetX;
        slideshowImage.style.cursor = "default";
        if (mouseFinalX - initialMouseDownX > 100){
            setSlide(currentSlideNumber - 1);
        } else if (initialMouseDownX - mouseFinalX > 100){
            setSlide(currentSlideNumber + 1);
        }            
    }

}, "false");
