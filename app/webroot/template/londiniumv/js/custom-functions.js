$(document).ready(function () {
    $(".navigation").find(".active").parentsUntil($(".navigation")).siblings(".level-closed").trigger("click");
    $(".paginate_button").on("click", function () {
        if ($(this).find("a").length > 0) {
            window.location = $(this).find("a").attr("href");
        }
    });
    
})

function filterReload() {
    $(".toggle-bar").click(function () {
        var target = $(this).data("toggle-target");
        $(".toggle-target").not("*[data-toggle-id='" + target + "']").hide();
        $("*[data-toggle-id='" + target + "']").slideToggle();
    })
}

function displayError(data) {

}

function modalChangepp(){
    $("#modalgantipp").modal("show");
}

function exp(type, link) {
    switch (type) {
        case "print":
            window.open(link);
            break;
        case "excel":
            window.open(link);
            break;
        case "pdf":
            window.open(link);
            break;
    }
}