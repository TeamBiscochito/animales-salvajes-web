<!-- SCRIPTS -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/SmoothScroll.min.js"></script>
<!-- js for banner -->
<script src='js/classie.js'></script>
<script src='js/TweenMax.min.js'></script>
<script src="js/banner.js"></script>
<!-- /js for banner -->
<!-- js for top of work section -->
<script src="js/index.js"></script>
<!-- /js for top of work section -->
<!-- js for works section -->
<script src="js/modernizr-1.5.min.js"></script>
<script src="js/jquery.mousewheel.js"></script>
<script src="js/work.js"></script>
<!-- /js for works section -->
<!-- js for footer pics -->
<script type="text/javascript" src="js/photoGallery.js"></script>
<script type="text/javascript">
    $(function () {
        var photoGallery = new PhotoGallery();
    });
</script>
<!-- js for footer pics -->
<!-- js for gallery -->
<script type="text/javascript" src="js/dreamslider.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('.container').dreamSlider({
            rowCount: 6
            , easeEffect: 'bounce'
            //,easeEffect: 'standOut'
        });
    });
</script>
<!-- js for gallery -->
<!-- js for smooth navigation -->
<script>
    $(document).ready(function () {
        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, section.footer a").on('click', function (event) {

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 900, function () {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        });
    })
</script>
<script>
    $(window).scroll(function () {
        $(".slideanim").each(function () {
            var pos = $(this).offset().top;

            var winTop = $(window).scrollTop();
            if (pos < winTop + 600) {
                $(this).addClass("slide");
            }
        });
    });
</script>
<!-- /js for smooth navigation -->
<!-- js for pricing table -->
<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });
    });
</script>
<!-- /js for pricing table -->
</html>