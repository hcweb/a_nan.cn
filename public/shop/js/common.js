/**
 * Created by xtn on 2018-5-6.
 */
$(function () {
    setFixed();
    addFixedClass();

    $(window).resize(function () {
        setFixed();
        addFixedClass();
    });

    if ($('.dropdown-menu a').hasClass('active')){
        $('.dropdown-menu a').parent().parent('.nav-item').addClass('active');
    }
});


function setFixed() {
    $(window).scroll(function () {
        addFixedClass();
    });
}

function addFixedClass() {
    if ($(window).scrollTop() >= 295 && $(window).width() > 768) {
        $('.app-right-box,.app-left-box').addClass('position-fixed').css({
            'top': $('#navbarCollapse').height() + 30 + 'px',
            'width': $('.app-aside').width() + 'px'
        });
    } else {
        $('.app-right-box,.app-left-box').removeClass('position-fixed').css({
            'top': 'auto',
            'width': 'auto'
        });
    }
}

