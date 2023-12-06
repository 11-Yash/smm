// Fancy Box
$(document).ready(function () {
    $("[data-fancybox]").fancybox({
        buttons: ["slideShow", "share", "zoom", "fullScreen", "close"],
        wheel: true,
        transitionEffect: "slide",
        hash: true,
        preload: true,
        loop: true,
        keyboard: true,
        toolbar: true,
        animationEffect: true,
        arrows: true,
        clickContent: true,
        thumbs: true,
        thumbs: { autoStart: true, axis: "y" },
    });
});

// Select 2 
$(document).ready(function () {
    $("#platforms").select2({
        dropdownParent: $('#addPost'),
        multiple: true,
        closeOnSelect: false,
        // placeholder: "Placeholder",
        // allowHtml: true,
        allowClear: true,
        tags: true
    });
});
$(document).ready(function () {
    $("#edit-platforms").select2({
        dropdownParent: $('#editUser'),
        multiple: true,
        closeOnSelect: false,
        // placeholder: "Placeholder",
        // allowHtml: true,
        allowClear: true,
        tags: true
    });
});
