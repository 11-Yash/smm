$(document).ready(function () {
    // refrest after 5 seconds
    setTimeout(function () {
        // window.location.reload(1);
    }, 1000);

    var currentPageUrl = window.location.href;
    var navLinks = document.querySelectorAll("ul.nav li a");
    var count = 0;

    navLinks.forEach(function (link) {
        count++;
        if ((currentPageUrl.indexOf(link.getAttribute("href")) > -1 && count > 1) || ((currentPageUrl.endsWith("/") || currentPageUrl.endsWith("/index.php")) && count == 1)) {
            link.classList.add("active");
            link.setAttribute("aria-current", "page");
            var span = document.createElement("span");
            span.classList.add("visually-hidden");
            span.textContent = "(current)";
            link.appendChild(span);
        }
    });
});

let table = new DataTable('#dataTable');
const options = {};
const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

$('#deleteDataModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var title = button.data('title')
    var id = button.data('id')
    var modal = $(this)
    modal.find('.modal-body #title').text(title)
    modal.find('.modal-body input[name=deleteId]').val(id)
})

// FancyBox
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