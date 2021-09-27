$(document).on('.cart_quantity_up','click',function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    alert(id);
})

