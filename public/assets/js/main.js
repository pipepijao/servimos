$(function() {

    // WIZARD Paso a paso
    $("#wizard").steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: false,
        transitionEffectSpeed: 300,
        labels: {
            next: "Siguiente",
            finish: 'Finalizar'
        },
        onStepChanging: function(event, currentIndex, newIndex) {
            if (newIndex >= 1) {
                $('.steps ul li:first-child a img').attr('src', 'public/assets/images/img/paso-1.png');
            } else {
                $('.steps ul li:first-child a img').attr('src', 'public/assets/images/img/paso-1-activo.png');
            }
            if (newIndex === 1) {
                $('.steps ul li:nth-child(2) a img').attr('src', 'public/assets/images/img/paso-2-activo.png');
            } else {
                $('.steps ul li:nth-child(2) a img').attr('src', 'public/assets/images/img/paso-2.png');
            }
            if (newIndex === 2) {
                $('.steps ul li:nth-child(3) a img').attr('src', 'public/assets/images/img/paso-3-activo.png');
            } else {
                $('.steps ul li:nth-child(3) a img').attr('src', 'public/assets/images/img/paso-3.png');
            }
            if (newIndex === 3) {
                $('.steps ul li:nth-child(4) a img').attr('src', 'public/assets/images/img/paso-4-activo.png');
            } else {
                $('.steps ul li:nth-child(4) a img').attr('src', 'public/assets/images/img/paso-4.png');
            }
            if (newIndex === 4) {
                $('.steps ul li:nth-child(5) a img').attr('src', 'public/assets/images/img/paso-5-activo.png');
            } else {
                $('.steps ul li:nth-child(5) a img').attr('src', 'public/assets/images/img/paso-5.png');
            }
            if (newIndex === 5) {
                $('.steps ul li:nth-child(6) a img').attr('src', 'public/assets/images/img/paso-6-activo.png');
            } else {
                $('.steps ul li:nth-child(6) a img').attr('src', 'public/assets/images/img/paso-6.png');
            }
            if (newIndex === 6) {
                $('.steps ul li:nth-child(7) a img').attr('src', 'public/assets/images/img/paso-7-activo.png');
            } else {
                $('.steps ul li:nth-child(7) a img').attr('src', 'public/assets/images/img/paso-7.png');
            }
            if (newIndex === 7) {
                $('.steps ul li:nth-child(8) a img').attr('src', 'public/assets/images/img/paso-8-activo.png');
                $('.actions ul').addClass('step-8');
            } else {
                $('.steps ul li:nth-child(8) a img').attr('src', 'public/assets/images/img/paso-8.png');
                $('.actions ul').removeClass('step-8');
            }


            return true;
        }
    });
    // Custom Button Jquery Steps
    $('.forward').click(function() {
            $("#wizard").steps('next');
        })
        // $('.backward').click(function(){
        //     $("#wizard").steps('previous');
        // })
        // Click to see password 
        // $('.password i').click(function(){
        //     if ( $('.password input').attr('type') === 'password' ) {
        //         $(this).next().attr('type', 'text');
        //     } else {
        //         $('.password input').attr('type', 'password');
        //     }
        // }) 
        // Create Steps Image
    $('.steps ul li:first-child').find('a').append('<img src="public/assets/images/img/paso-1-activo.png" alt=""> ').append('<span class="step-order"></span>');
    $('.steps ul li:nth-child(2)').find('a').append('<img src="public/assets/images/img/paso-2.png" alt="">').append('<span class="step-order"></span>');
    $('.steps ul li:nth-child(3)').find('a').append('<img src="public/assets/images/img/paso-3.png" alt="">').append('<span class="step-order"></span>');
    $('.steps ul li:nth-child(4)').find('a').append('<img src="public/assets/images/img/paso-4.png" alt="">').append('<span class="step-order"></span>');
    $('.steps ul li:nth-child(5)').find('a').append('<img src="public/assets/images/img/paso-5.png" alt="">').append('<span class="step-order"></span>');
    $('.steps ul li:nth-child(6)').find('a').append('<img src="public/assets/images/img/paso-6.png" alt="">').append('<span class="step-order"></span>');
    $('.steps ul li:nth-child(7)').find('a').append('<img src="public/assets/images/img/paso-7.png" alt="">').append('<span class="step-order"></span>');
    $('.steps ul li:last-child a').append('<img src="public/assets/images/img/paso-8.png" alt="">').append('<span class="step-order"></span>');


    // $('.steps ul li:first-child').append('<img src="images/step-arrow.png" alt="" class="step-arrow">').find('a').append('<img src="images/step-1-active.png" alt=""> ').append('<span class="step-order">Step 01</span>');
    // $('.steps ul li:nth-child(2').append('<img src="images/step-arrow.png" alt="" class="step-arrow">').find('a').append('<img src="images/step-2.png" alt="">').append('<span class="step-order">Step 02</span>');
    // $('.steps ul li:nth-child(3)').append('<img src="images/step-arrow.png" alt="" class="step-arrow">').find('a').append('<img src="images/step-3.png" alt="">').append('<span class="step-order">Step 03</span>');
    // $('.steps ul li:last-child a').append('<img src="images/step-4.png" alt="">').append('<span class="step-order">Step 04</span>');

    // Count input 

})