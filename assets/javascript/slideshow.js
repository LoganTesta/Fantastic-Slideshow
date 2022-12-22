
window.addEventListener("load", function() {
    
    /* Start of Slideshow */
    let currentSlide;
    let prevSlide;
    let slideshowCounter = 0;
    let paused = false;
    let updateSlideSettings = true;
    let regularSwitchSlide = false;
    let switchText = false;
    let currentSlideNumber = 0;
    const maxSlideNumber = 3;
    let pausePlayButton;
    let slideTitle;
 

    let theSlideButtons = [];
    for(let i = 0; i < maxSlideNumber + 1; i++){
       theSlideButtons.push(document.getElementsByClassName("slideshow__slide-button")[i]);
    }
    
    for(let i = 0; i < maxSlideNumber + 1; i++){
        theSlideButtons[i].addEventListener('click', function () {
           setSlide(i);
        }, false);
    }

    let backIcon = document.getElementsByClassName("slideshow__icon")[0];
    let forwardIcon = document.getElementsByClassName("slideshow__icon")[1];

    let currentSlideImageLink = document.getElementsByClassName("slide__link")[0];

    backIcon.addEventListener('click', function () {
       setSlide(currentSlideNumber - 1);
    }, false);

    forwardIcon.addEventListener('click', function () {
       setSlide(currentSlideNumber + 1);
    }, false);



    function init() {
        prevSlide = document.getElementsByClassName("slide")[maxSlideNumber];
        currentSlide = document.getElementsByClassName("slide")[0];
        slideTitle = document.getElementsByClassName("slide__title")[0];
        pausePlayButton = document.getElementById("pausePlayButton");
        for(let i = 0; i < maxSlideNumber + 1; i++){
            document.getElementsByClassName("slide")[i].style.opacity = 0;
        }
        currentSlide.style.opacity = 0;
        prevSlide.style.opacity = 0;
        currentSlideImageLink.href = "";
        currentSlideImageLink.setAttribute("aria-label", "Slide 0");
        currentSlideImageLink.innerHTML = "";
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
            if (slideshowCounter === 200) {
                switchText = true;
            }
            if (slideshowCounter < 400) {
                currentSlide.style.opacity = parseFloat(currentSlide.style.opacity) + 0.0025;
                prevSlide.style.opacity = parseFloat(prevSlide.style.opacity) - 0.0025;
            }
            if (400 <= slideshowCounter && slideshowCounter < 900) {
                currentSlide.style.opacity = 1;
                prevSlide.style.opacity = 0;
            }

            if (slideshowCounter >= 900) {    
                slideshowCounter = 0;
                updateSlideSettings = true;
                regularSwitchSlide = true;
                currentSlideNumber++;
            }

            if (currentSlideNumber < 0) {
                currentSlideNumber = maxSlideNumber;
            } else if (currentSlideNumber > maxSlideNumber) {
                currentSlideNumber = 0;
            }

            if (updateSlideSettings) {
                updateSlideSettings = false;

                if (currentSlideNumber <= 0) {
                    prevSlide = document.getElementsByClassName("slide")[maxSlideNumber];
                } else {
                    prevSlide = document.getElementsByClassName("slide")[currentSlideNumber - 1];
                }
                currentSlide = document.getElementsByClassName("slide")[currentSlideNumber];
                

                for(let i = 0; i < maxSlideNumber + 1; i++){
                    document.getElementsByClassName("slide")[i].style.opacity = 0;
                }
                
                if (regularSwitchSlide){
                    regularSwitchSlide = false;
                    prevSlide.style.opacity = 1;
                    currentSlide.style.opacity = 0;
                } else {
                    currentSlide.style.opacity = 1;
                }


                for(let i = 0; i < maxSlideNumber + 1; i++) {
                    if (currentSlideNumber === i) {
                        theSlideButtons[i].classList.add('currentSlideButton');                
                    } else {
                        theSlideButtons[i].classList.remove('currentSlideButton');
                    }
                }
            }
            if (switchText){
                switchText = false;
                
                 for(let i = 0; i < maxSlideNumber + 1; i++) {
                    if (currentSlideNumber === i) {
                        currentSlideImageLink = document.getElementsByClassName("slide__link")[i];
                        currentSlideImageLink.href = "";
                        currentSlideImageLink.setAttribute("aria-label", "Slide " + i);
                        currentSlideImageLink.innerHTML = "";
                    }
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
        slideshowCounter = 400;
        currentSlideNumber = slideNumber;
        paused = false;
        pausePlayButton.classList.remove("paused");
        updateSlideSettings = true;
        switchText = true;
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
