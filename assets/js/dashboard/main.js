jQuery(document).ready(function ($) {



    $(".trigger").on('click', function (e) {
        var target = $(this).data('target');
        $(target).toggleClass('active');
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


    /* ---------------------------- ANCHOR DatePicker --------------------------- */
    $(".datepicker").datepicker({
        format: 'yyyy/mm/dd'
    });



});