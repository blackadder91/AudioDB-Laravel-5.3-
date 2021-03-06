function setMinPageHeight()
{
    var viewportHeight = $(window).height();
    var pageWidth = $('#page-main').innerHeight() + $('#page-footer').innerHeight();
    if ( viewportHeight > pageWidth ) {
        $('#page-main').css('min-height', viewportHeight - $('#page-footer').innerHeight() - 80);
    }
}

$(document).ready(function(){
    $('select').select2();
    $('.entities.grid-view .item').matchHeight();
    setMinPageHeight();
    $('.entities-grid .item, .artist-list.grid .col').matchHeight();
})
