
$(function () {

    var $body=$(document.body);

    $('form').attr('novalidate','novalidate');
    $body.on('change','input[type="file"]',function (e) {
        $(e.currentTarget)
            .closest('.custom-file')
            .children('.custom-file-label')
            .text(e.target.files[0].name);

    })


});
