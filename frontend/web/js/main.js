$(document).ready(function () {

    var options = {};
    options.ui = {
        container: ".pwd-container",
        showVerdictsInsideProgressBar: true,
        viewports: {
            progress: ".pwstrength_viewport_progress"
        }
    };
    $(":password").pwstrength(options);
    $('.inputmask-phone').inputmask({"mask": "0 (999) 999 99 99"});
    $('.inputmask-iban').inputmask("a{1,2}99 9999 9999 9999 9999 9999 99");

    d = $(document);
    var scrollHeight = $(window).scrollTop();
    navbar(scrollHeight);

    $(window).scroll(function() {
        var scrollHeight = $(window).scrollTop();
        navbar(scrollHeight);
    });

    function navbar(scrollHeight) {
        // @TO-DO - hasClass control
        if(scrollHeight < 20) { 
            // $('#header').removeClass().addClass('landing-navbar navbar navbar-expand-lg fixed-top navbar-dark pt-lg-4');
            $('#header').removeClass().addClass('landing-navbar navbar navbar-expand-lg fixed-top navbar-dark');
        } else { 
            $('#header').removeClass().addClass('landing-navbar navbar navbar-expand-lg fixed-top landing-navbar-alt bg-dark pb-2');
        }
    }

    d.on('click', '.jsShowDetailReport', function(e) {
        e.preventDefault();
        $('.report-detail').attr("style", "display:none");
        $('#report-'+ $(this).data('id')).attr("style", "display:block");
    });

    $('.datepicker').datepicker({
        orientation: 'bottom right',
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true
    });

});