var postId;
var postBodyElement = null;
$('.post').find('.interaction').find('.edit').on('click', function (event) {
    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
});
$('#edit-modal').on('show.bs.modal', function(e) {// on modal open
    postId          = $(e.relatedTarget).data('post-id');
    var post_body   = $(e.relatedTarget).data('post-body');

    $('#post-body').val(post_body);

});

$('#modal-save').on('click', function () {

    console.log(url);
   $.ajax({
       method: 'POST',
       url:url,
       data: { body: $('#post-body').val(), postId: postId, _token: token}

   })
       .done(function (mgs) {
           $(postBodyElement).text(mgs['new_body']);
           $('#edit-modal').modal('hide');
       })
});