jQuery(document).ready(function ($) {

    $('.rotator__slider').owlCarousel({
        center: false,
        items: 2,
        loop: true,
        margin: 1,
        dots: false,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 3000
    });


    // $(window).bind('hashchange', function () {
    //     var hash = location.hash;
    //     $('a.hash').each(function () {
    //         var ini = $(this);
    //         var gethash = ini.attr('href');
    //         var targethash = $(gethash);
    //         ini[gethash == hash ? 'addClass' : 'removeClass']('active');
    //         targethash[gethash == hash ? 'addClass' : 'removeClass']('active');
    //     });
    // });

    // $(window).trigger('hashchange');

    $("a.hash").click(function (e) {
        e.preventDefault();
        var dis = $(this);
        var disTarget = dis.data('target');
        $("a.hash").removeClass('active');
        dis.addClass('active');
        $(".hidden-cont .animate__animated").removeClass('animate__fadeIn').hide();
        $("#" + disTarget).show().addClass('animate__fadeIn');
    });


    function scrollToTop() {
        window.scrollTo(0, 0);
    }


    /* ------------------------- ANCHOR Password Reveal ------------------------- */
    $('.revealer').click(function (e) {
        var $pwd = $('.pwd');
        var $eye = $(this).find('i.fas');
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
            $eye.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            $pwd.attr('type', 'password');
            $eye.removeClass('fa-eye').addClass('fa-eye-slash');
        }
        e.preventDefault();
    });


    var captchaTotal;
    function getRandom() { return Math.ceil(Math.random() * 20); }
    function createSum(captchaTitle) {
        var randomNum1 = getRandom(),
            randomNum2 = getRandom();
        captchaTotal = randomNum1 + randomNum2;
        $(captchaTitle).text(randomNum1 + " + " + randomNum2);
        return captchaTotal.toString();
    }


    // $("form.with-captcha [type=submit]").attr('disabled', 'disabled');
    // createSum();

    $("form.with-captcha").each(function (e) {
        var submitBtn = $(this).find("[type=submit");
        var title = $(this).find('.captcha-title > span');
        var target = $(this).find('.captcha-code');
        submitBtn.attr('disabled', 'disabled');
        var cek = createSum(title);
        $(target).keyup(function () {
            if (cek === target.val()) {
                submitBtn.prop('disabled', false);
            } else {
                submitBtn.attr('disabled', 'disabled');
            }
        });
    });


    /* --------------------------- ANCHOR General AJAX -------------------------- */
    $("form.form-ajax").submit(function (e) {

        var $form_data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: $form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (r) {
                r = $.parseJSON(r);
                if (r.status == 'succeed') {
                    $('.smodal').addClass('is-visible');
                    $('.smodal-heading > span').html(r.status);
                    $('.smodal-content').html(r.message);
                    scrollToTop();
                } else {
                    $('.smodal').addClass('is-visible');
                    $('.smodal-heading > span').html(r.status);
                    $('.smodal-content').html(r.message);
                    scrollToTop();
                }
            }
        });
        e.preventDefault();
        return false;
    });


    /* ---------------------- ANCHOR Country City Selector ---------------------- */
    $("[name=dt_country]").change(function () {
        $country = $(this).val();
        $country = $country.replace(/\s+/g, '-');
        $country = $country.replace(/\./g, "");
        var option = $('#cities_' + $country).html();
        $("[name=dt_city]").empty().html(option).prop('disabled', false);
    });

    /* --------------------------- ANCHOR Date Picker --------------------------- */
    // $(".datepicker").datepicker();

    /* --------------------------- ANCHOR Simple Modal -------------------------- */
    // Ref: https://codepen.io/1jnole/pen/XKGdPG with fixed!!
    $('.smodal-toggle').on('click', function (e) {
        e.preventDefault();
        $('.smodal').toggleClass('is-visible');
    });


});