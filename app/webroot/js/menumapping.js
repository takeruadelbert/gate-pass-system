$(document).ready(function () {
    var currentUrl = window.location.href;
    var parsedUrl = $.url(currentUrl);
    var params = parsedUrl.param();
    var paramMID = params["mID"];
    if (typeof (paramMID) == "undefined" && MID != "") {
        console.log("ok");
        params["mID"] = MID;
        var newURL = window.location.href.split('?')[0] + "?" + $.param(params);
        window.history.replaceState({url: newURL}, $(document).find("title").text(), newURL);
    }
})