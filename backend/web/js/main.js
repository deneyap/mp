$(document).ready(function () {

    d = $(document);

    var cookiePrefix = 'bgbnty-bcknd-';

    $('.inputmask-phone').inputmask({"mask": "0 (999) 999 99 99"});
    $('.inputmask-iban').inputmask("a{1,2}99 9999 9999 9999 9999 9999 99");

    d.on('click', '.layout-sidenav-toggle', function(e) {
        e.preventDefault();
        if($('html').hasClass('layout-collapsed')) { 
            $('html').removeClass('layout-collapsed');
            $('.layout-sidenav').removeClass('sidenav-collapsed');
            setCookie('sidenav', 'false');
        } else { 
            $('html').addClass('layout-collapsed');
            $('.layout-sidenav').addClass('sidenav-collapsed');
            setCookie('sidenav', 'true');
        }
    });

    d.on('click', '.sidenav-toggle', function(e) {
        e.preventDefault();
        if(false === $(this).parent().hasClass('open')) {
            $('.sidenav-item').removeClass('open');
            $(this).parent().addClass('open');
        } else {
            $('.sidenav-item').removeClass('open');
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    d.on('change', '.account-settings-fileinput', function(e) {
        readURL(this);
    });

    jQuery('.datepicker').datepicker({
        orientation: 'bottom right',
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true
    });

    function setCookie(key, value) {
        document.cookie = cookiePrefix +""+ key + "=" + value + ";expires=;path=/";
    }

    function getCookie(key) {
        var name = cookiePrefix +""+ key + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
        }
        return "";
    }

    function removeCookie(key) { 
        document.cookie = cookiePrefix +""+ key + "=;expires=Wed; 01 Jan 1970;path=/";
    }

});