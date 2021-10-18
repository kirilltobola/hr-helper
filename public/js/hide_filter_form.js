let filterForm = $('#filterFrom');
$(window).resize(function (){
    if($(window).width() >= 1200) {
        filterForm.removeClass('position-absolute');
        filterForm.removeClass('w-100');
        filterForm.removeClass('h-auto');
    }else{
        filterForm.addClass('d-none');
    }
    if(filterForm.hasClass('d-none')){
        filterForm.removeClass('position-absolute');
        filterForm.removeClass('w-100');
        filterForm.removeClass('h-auto');
        filterForm.removeClass('top-10');
        filterForm.removeClass('start-0');
    }
})
