
window.addEventListener("load", function() {
    
    /* Start of Slideshow */
    let numberOfSlideshowsOnPage = document.getElementsByClassName("slideshow").length;
 
    if (numberOfSlideshowsOnPage > 0){
        let currentSlide;
        let prevSlide;
        let slideshowCounter = 0;
        let paused = false;
        let updateSlideSettings = true;
        let regularSwitchSlide = false;
        let switchText = false;
        let currentSlideNumber = 0;
        const maxSlideNumber = document.getElementsByClassName("slide").length - 1;
        let pausePlayButton;
        let slideTitle;

        let slideTime = 100 * document.getElementsByClassName("slideshow__speed")[0].innerHTML;
        let slideTransitionTime = 100 * document.getElementsByClassName("slideshow__transition-speed")[0].innerHTML;
        let autoPlay = document.getElementsByClassName("slideshow__autoplay")[0].innerHTML;
        let pauseOnHover = document.getElementsByClassName("slideshow__pause-on-hover")[0].innerHTML;
        let minimumTouchDragDistance = document.getElementsByClassName("slideshow__minimum-touch-drag-distance")[0].innerHTML;
        let minimumMouseDragDistance = document.getElementsByClassName("slideshow__minimum-mouse-drag-distance")[0].innerHTML;
        let enableTouchDragging = document.getElementsByClassName("slideshow__enable-touch-dragging")[0].innerHTML;
        let enableMouseDragging = document.getElementsByClassName("slideshow__enable-mouse-dragging")[0].innerHTML;

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
            
            if ( autoPlay === "no" ) {
                paused = true;
                pausePlayButton.classList.add("paused");
                currentSlide.style.opacity = 1;
                setSlideButtons();
            }
            
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
                if (slideshowCounter === 0.5 * slideTransitionTime ) {
                    switchText = true;
                }

                if (slideshowCounter < slideTransitionTime) {
                    currentSlide.style.opacity = parseFloat(currentSlide.style.opacity) + 1/slideTransitionTime;
                    prevSlide.style.opacity = parseFloat(prevSlide.style.opacity) - 1/slideTransitionTime;
                }
                if (slideTransitionTime <= slideshowCounter && slideshowCounter < slideTime) {
                    currentSlide.style.opacity = 1;
                    prevSlide.style.opacity = 0;
                }

                if (slideshowCounter >= slideTransitionTime + slideTime) {    
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

                    setSlideButtons();
                }
                if (switchText){
                    switchText = false;
                }

                for(let i = 0; i < maxSlideNumber + 1; i++){
                    if (document.getElementsByClassName("slide")[i].style.opacity <= 0 ){
                        document.getElementsByClassName("slide")[i].style.display = "none";
                    } else {
                        document.getElementsByClassName("slide")[i].style.display = "block";
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

        let pausePlay = document.getElementById("pausePlayButton").addEventListener("click", togglePausePlay, false);
        
        if ( pauseOnHover === "yes" ) {
            document.getElementsByClassName("slideshow__inner-wrapper")[0].addEventListener("mouseover", togglePausePlay, false);
            document.getElementsByClassName("slideshow__inner-wrapper")[0].addEventListener("mouseout", togglePausePlay, false);
        }

        function setSlide(slideNumber) {
            slideshowCounter = slideTransitionTime;
            currentSlideNumber = slideNumber;
            paused = false;
            pausePlayButton.classList.remove("paused");
            updateSlideSettings = true;
            switchText = true;
        }
        
        
        function setSlideButtons() {
            for(let i = 0; i < maxSlideNumber + 1; i++) {
                if (currentSlideNumber === i) {
                    theSlideButtons[i].classList.add('currentSlideButton');  
                    document.getElementsByClassName("slide")[i].getElementsByClassName("slide__content")[0].classList.add('show');
                } else {
                    theSlideButtons[i].classList.remove('currentSlideButton');
                    document.getElementsByClassName("slide")[i].getElementsByClassName("slide__content")[0].classList.remove('show');
                }
            }
        }


        for(let i = 0; i < maxSlideNumber + 1; i++){   
            let slideshowImage = document.getElementsByClassName("slide")[i];

            // Allow touch events to interact with slideshow.
            if ( enableTouchDragging === "yes" ){
                let initialTouchX = 0;

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

                    if (finalTouchX - initialTouchX >= minimumTouchDragDistance){
                        setSlide(currentSlideNumber - 1);
                    } else if (initialTouchX - finalTouchX >= minimumTouchDragDistance){
                        setSlide(currentSlideNumber + 1);
                    }
                }
            }


            // Allow mouse dragging events to interact with slideshow.
            if ( enableMouseDragging === "yes" ) {
                let initialMouseDownX = 0;

                slideshowImage.addEventListener("mousedown", getMouseDownCoords, false);
                slideshowImage.addEventListener("mouseup", getMouseUpsCoords, false);
                let mouseDown = false;

                function getMouseDownCoords(event){  
                    let mouseX = event.offsetX;
                    initialMouseDownX = mouseX;
                    slideshowImage.style.cursor = "grabbing";
                }

                function getMouseUpsCoords(event){  
                    let mouseFinalX = event.offsetX;
                    slideshowImage.style.cursor = "default";
                    if (mouseFinalX - initialMouseDownX >= minimumMouseDragDistance){
                        setSlide(currentSlideNumber - 1);
                    } else if (initialMouseDownX - mouseFinalX >= minimumMouseDragDistance){
                        setSlide(currentSlideNumber + 1);
                    }            
                }
            }

        }
    }
    
}, "false");
