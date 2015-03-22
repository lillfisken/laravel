$(document).ready(function(){

    //Add if statement if there are anny images...
    if($('.okg li').length) {

        // DOM-manipulation ----------------------------------------------------------------------------------------

        $('.okg li').attr('data-okg-item', function (i) {
            return (i + 1);
        });

        //Add class to image thumb object to center and size-controll all images
        $('.okg img').addClass('center-img');

        //Add an area to show images in large format
        $('.okg').prepend('<div id="okg-img-nav"><a id="okg-full" href="#" target="blank"><div class="img-large"><img src="" class="center-img" /></div></a></div>');

        //Add controls for next/previous image
        $('#okg-img-nav').prepend('<span class="ok-nav ok-prev">&laquo;</span><span class="ok-nav ok-next">&raquo;</span>');

        // Settings --------------------------------------------------------------------------------------------------

        //Resize image areas to squares
        rectangle($('.okg .img-large'));
        square($('.okg li'));

        //Fontsize of navigation
        setFontSize();

        //Change large image to first in thumbnail array
        var firstImage = $('li[data-okg-item]').first().children('img');
        replaceImage($('li[data-okg-item] img').attr('data-large'),
            firstImage.attr('data-full'),
            $('li[data-okg-item] img').parent().attr('data-okg-item'));
        //$('.okg .img-large img').attr('src', $('[data-okg-item]').first().children('img').first().attr('data-large'));

        // Events ----------------------------------------------------------------------------------------------------

        //Resize image areas dynamicaly when window size change
        $(window).resize(function () {
            rectangle($('.okg .img-large'));
            square($('.okg li'));
            //Fontsize of navigation
            setFontSize();
        });

        $('.ok-nav, .img-large').hover(
            function () {
                //If( has next )
                if ($('li[data-okg-item="' + $('li[data-okg-item="' + $('.okg .img-large img').attr('data-okg-item') + '"]').next().attr('data-okg-item') + '"]').attr('data-okg-item')) {
                    $('.ok-next').css('display', 'block');
                }
                //If( has next )
                if ($('li[data-okg-item="' + $('li[data-okg-item="' + $('.okg .img-large img').attr('data-okg-item') + '"]').prev().attr('data-okg-item') + '"]').attr('data-okg-item')) {
                    $('.ok-prev').css('display', 'block');
                }
            },
            function () {
                $('.ok-next, .ok-prev').css('display', 'none');
            }
        );

        //Change large image when thumb is clicked
        $('.okg li img').click(function (element) {
            replaceImage(
                $(this).data('large'),
                $(this).data('full'),
                $(this).parent().data('okg-item'));
        });

        //Move back and forward in images
        $('.ok-prev').click(function () {
            okPrev();
        });
        $('.ok-next').click(function () {
            okNext();
        });

        //Register 'swipe'-events ta change image, using hammer.js
        var hammertime = new Hammer(document.getElementById('okg-img-nav'));
        hammertime.on('swiperight', function () {
            okNext();
        });
        hammertime.on('swipeleft', function () {
            okPrev();
        });

        // Methods --------------------------------------------------------------------------------------------------

        //Set elemement height to same as element width
        function square(element) {
            $(element).css('height', $(element).css('width'));
        }

        function rectangle(element) {

            //$(element).css('height', '500');
            $(element).css('height', Math.floor($(element).width() * 0.7));
        }

        function setFontSize() {
            var h = $('.ok-nav').css('height');
            $('.ok-nav').css('font-size', $('.ok-nav').css('height'));
            //$('.ok-nav').css('line-height', $('.ok-nav').css('height'));
        }

        //Change large image to next
        function okNext() {
            var next = $('li[data-okg-item="' + $('li[data-okg-item="' + $('.okg .img-large img').attr('data-okg-item') + '"]').next().attr('data-okg-item') + '"]').children('img').first();
            var nextImage = next.attr('data-large');
            var nextFull = next.attr('data-full');
            var nextNumber = next.parent().attr('data-okg-item');

            replaceImage(nextImage, nextFull, nextNumber);
        }

        //Change large image to previous
        function okPrev() {
            var next = $('li[data-okg-item="' + $('li[data-okg-item="' + $('.okg .img-large img').attr('data-okg-item') + '"]').prev().attr('data-okg-item') + '"]').children('img').first();
            var nextImage = next.attr('data-large');
            var nextFull = next.attr('data-full');
            var nextNumber = next.parent().attr('data-okg-item');

            replaceImage(nextImage, nextFull, nextNumber);
        }

        function replaceImage(src, srcFull, data) {
            $('.okg .img-large img').attr({'src': src, 'data-okg-item': data});
            $('#okg-full').attr('href', srcFull);
        }
    }
});

//Lightbox with full size
