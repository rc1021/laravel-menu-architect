$(function () {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // jQuery Dropdown Show/Hide div
    $(document.body).on('change', '[data-rel="ddsh"]', function (event) {
       let opt = $(this).data();
       $('[data-rel^="' + opt.value + '"]').hide();
       $('[data-rel="' + opt.value + '-' + this.value + '"]').show();
    });
    $('[data-rel="ddsh"]').trigger('change');
    
});
