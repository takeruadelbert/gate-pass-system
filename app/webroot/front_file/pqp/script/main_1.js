var curIdx = 0;
var timeOffset = 0;
var currentCounter = "none";

function onLoginClick() {
    $("#login-show").click(function(){
        $("#login-box").fadeIn(300,function(){
            $("#login-show").unbind("click");
            $("#login-exit").click(function(){
                $("#login-box").fadeOut(300,function(){
                    onLoginClick();
                });
            });
        });
    });
}

$(document).ready(function(){
    $(function(){
        $("#slides").slidesjs({
            width: 1170,
            height: 480,
            play: {
                active: true,
                auto: true,
                interval: 4000,
                swap: true,
                pauseOnHover: true,
                restartDelay: 2500
            },
            effect: {
                slide: {
                    speed: 1000
                }
            }
        });
    });
    
    $(function(){
        $(".datepicker").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
    
    onLoginClick();
    
    $(".product-image-thumbnail-container > .img").click(function(){
        $(this).parent().parent().parent().parent().parent().parent().children(".product-image").children(".img").css("background-image",$(this).css("background-image"));
    });
    
    $(".product-image > .img").mouseenter(function(event){
        var bounds = 92;
        var x = event.pageX-this.offsetLeft-($(this).outerWidth()-$(this).width())/2;
        if (x<bounds) {
            x = bounds;
        } else if (x>$(this).width()-bounds) {
            x = $(this).width()-bounds;
        }
        var y = event.pageY-this.offsetTop-($(this).outerHeight()-$(this).height())/2;
        if (y<bounds) {
            y = bounds;
        } else if (y>$(this).width()-bounds) {
            y = $(this).width()-bounds;
        }
        $(this).data("x",x);
        $(this).data("y",y);
        
        var productInfo = $(this).parent().parent().parent().children(".product-info");
        
        var width = productInfo.outerWidth();
        var height = productInfo.outerWidth();
        
        $("#image-zoom").css("width",width+"px").css("height",height+"px").css("box-shadow","0px 0px 20px #AAA").css("position","absolute").css("top",productInfo[0].offsetTop+"px").css("left",productInfo[0].offsetLeft+"px").css("display","block").children(".img").css("width",(width*2)+"px").css("height",(height*2)+"px").css("background-image",$(this).css("background-image"));
        
        $("#viewfinder").css("display","block").css("width",(bounds*2)+"px").css("height",(bounds*2)+"px").css("position","absolute").css("left",(x-bounds+this.offsetLeft+(($(this).outerWidth()-$(this).width())/2))+"px").css("top",(y-bounds+this.offsetTop+(($(this).outerHeight()-$(this).height())/2))+"px");
    });
    
    $(".product-image > .img").mouseout(function(){
        $("#image-zoom").css("display","none");
        $("#viewfinder").css("display","none");
    });
    
    $(".product-image > .img").mousemove(function(event){
        var bounds = 92;
        var x = event.pageX-this.offsetLeft-($(this).outerWidth()-$(this).width())/2;
        if (x<bounds) {
            x = bounds;
        } else if (x>$(this).width()-bounds) {
            x = $(this).width()-bounds;
        }
        var y = event.pageY-this.offsetTop-($(this).outerHeight()-$(this).height())/2;
        if (y<bounds) {
            y = bounds;
        } else if (y>$(this).width()-bounds) {
            y = $(this).width()-bounds;
        }
        $(this).data("x",x);
        $(this).data("y",y);
        
        var zoomWidth = $(this).parent().parent().parent().children(".product-info").outerWidth();
        var normalWidth = $(this).width()-(bounds*2);
        
        iX = -((x-bounds)*zoomWidth/normalWidth);
        iY = -((y-bounds)*zoomWidth/normalWidth);
        
        $("#image-zoom .img").css("position","relative").css("left", iX+"px").css("top",iY+"px");
        
        $("#viewfinder").css("left",(x-bounds+this.offsetLeft+(($(this).outerWidth()-$(this).width())/2))+"px").css("top",(y-bounds+this.offsetTop+(($(this).outerHeight()-$(this).height())/2))+"px");
    });
    
    $(".product").has(".is-promo").mouseover(function(event){
        currentCounter = $(this).attr("data-id");
        startCounter($(this));
        $("#hover").css("position","absolute").css("z-index","1000").css("top",(event.pageY+30)+"px").css("left",(event.pageX-$(this).width()/2)+"px").css("display","block");
    });
    $(".product").has(".is-promo").mouseout(function(event){
        currentCounter = "none";
        $("#hover").css("display","none");
    });
    $(".product").has(".is-promo").mousemove(function(event){
        $("#hover").css("position","absolute").css("z-index","1000").css("top",(event.pageY+30)+"px").css("left",(event.pageX-$(this).width()/2)+"px").css("display","block");
    });
    
    $("#next-image").click(function(){
        var container = $(this).parent().parent().children("td:eq(1)").children(".product-image-thumbnail-container");
        var imageElements = $(this).parent().parent().children("td:eq(1)").children(".product-image-thumbnail-container").children(".img");
        var mostLeft = 0;
        if (!isNaN(parseInt(container.attr("data-most-left")))) {
            mostLeft = parseInt(container.attr("data-most-left"));
        } else {
            imageElements.css("position","relative").css("left","0px");
            container.attr("data-most-left","0");
        }
        if (-mostLeft<(container.children(".img:eq(0)").outerWidth(true)+(container.children(".img:eq(0)").outerWidth(true)-container.children(".img:eq(0)").outerWidth()))*(imageElements.length-4)) {
            imageElements.css("transition","0.3s").css("left",(mostLeft-(container.children(".img:eq(0)").outerWidth(true)+(container.children(".img:eq(0)").outerWidth(true)-container.children(".img:eq(0)").outerWidth())))+"px");
            container.attr("data-most-left",(mostLeft-(container.children(".img:eq(0)").outerWidth(true)+(container.children(".img:eq(0)").outerWidth(true)-container.children(".img:eq(0)").outerWidth())))+"");
        }
    });
    
    $("#prev-image").click(function(){
        var container = $(this).parent().parent().children("td:eq(1)").children(".product-image-thumbnail-container");
        var imageElements = $(this).parent().parent().children("td:eq(1)").children(".product-image-thumbnail-container").children(".img");
        var mostLeft = 0;
        if (!isNaN(parseInt(container.attr("data-most-left")))) {
            mostLeft = parseInt(container.attr("data-most-left"));
        } else {
            imageElements.css("position","relative").css("left","0px");
            container.attr("data-most-left","0");
        }
        if (-mostLeft>0) {
            imageElements.css("transition","0.3s").css("left",(mostLeft+(container.children(".img:eq(0)").outerWidth(true)+(container.children(".img:eq(0)").outerWidth(true)-container.children(".img:eq(0)").outerWidth())))+"px");
            container.attr("data-most-left",(mostLeft+(container.children(".img:eq(0)").outerWidth(true)+(container.children(".img:eq(0)").outerWidth(true)-container.children(".img:eq(0)").outerWidth())))+"");
        }
    });
    
    $(".promos .next").click(function(){
        var i = 0;
        var current = 0;
        $(".promos > .promo").each(function(){
            if ($(this).is(".promo.current")) {
                $(this).removeClass("current").css("display","none");
                current = i;
            }
            i++;
        });
        current = (current+1)%i;
        $(".promos > .promo").eq(current).addClass("current").css("display","block");
    });
    $(".promos .prev").click(function(){
        var i = 0;
        var current = 0;
        $(".promos > .promo").each(function(){
            if ($(this).is(".promo.current")) {
                $(this).removeClass("current").css("display","none");
                current = i;
            }
            i++;
        });
        current = current-1;
        if (current==-1) {
            current = i-1;
        }
        $(".promos > .promo").eq(current).addClass("current").css("display","block");
    });
    
    $("#cart").mouseover(function(event){
        $('#cart-content').css('opacity','0').css('transition','0.3s').css('display','inline-block').css('opacity','1').children('#cart-items').perfectScrollbar();
    });
    $("#cart").mouseout(function(event){
        $('#cart-content').css('display','none').children('#cart-items').perfectScrollbar('destroy');
    });
    
    initializeTimeOffset();
    startDedicatedCounter();
});

function openSlider(num) {
    $(".slider-button").attr("class", "slider-button");
    $(".slider-button:eq("+(num-1)+")").attr("class", "slider-button slider-button-current");
    $(".slider-image:eq("+(curIdx)+")").slideUp(1000);
    curIdx = num-1;
    $(".slider-image:eq("+(num-1)+")").slideDown(1000);
}

function displayTab(idx, tabEl) {
    tabEl.parent().children(".tab-selector").not(":eq("+idx+")").attr("class", "tab-selector");
    tabEl.attr("class", "tab-selector current");
    tabEl.parent().parent().children(".tab-contents").children(".tab-content").not(":eq("+idx+")").css("display","none");
    tabEl.parent().parent().children(".tab-contents").children(".tab-content:eq("+idx+")").css("display","block");
}

function expandMenu(el) {
    el.attr("onclick","void();");
    el.parent().children("ul").slideDown(300, function(){
        el.attr("onclick","hideMenu($(this));");
        el.addClass("rotated");
    });
}

function hideMenu(el) {
    el.attr("onclick","void();");
    el.parent().children("ul").slideUp(300, function(){
        el.attr("onclick","expandMenu($(this));");
        el.removeClass("rotated");
    });
}

function initializeTimeOffset() {
    var serverURL = "./"; // WARNING: Jangan cross domain, bisa jadi NaN hasilnya
    
    var clientTime = parseInt((new Date()).getTime()/1000);
    var serverTime = {"timestamp":"empty"};
    var startRequest = (new Date()).getTime();
    $.ajax({
        url: serverURL,
        success: function(data) {
            var endRequest = (new Date()).getTime();
            serverTime.timestamp = parseInt((new Date()).getTime()/1000); //JUMLAH s, BUKAN ms
            //diganti jadi:
            //serverTime.timestamp = parseInt(data);
            //atau
            //serverTime.timestamp = parseInt(data.timestamp);
            //you get the point.
            serverTime = serverTime.timestamp;
            var networkLatency = parseInt(((endRequest - startRequest)/2)/1000);
            serverTime = serverTime - networkLatency;
            var offset = serverTime - clientTime;
            timeOffset = offset;
        }
    });
}

function startCounter(el) {
    if (el.data("id")==currentCounter) {
        currentTime = parseInt((new Date()).getTime()/1000)+timeOffset;
        var endTime = parseInt(el.data("endtime"));
        timeElapsed = endTime - currentTime;
        //$("#hover.counter").children(".day").children(".number").html(timeElapsed);
        var day = parseInt(timeElapsed/3600/24);
        var hour = parseInt((timeElapsed-day*3600*24)/3600);
        var minute = parseInt((timeElapsed-day*3600*24-hour*3600)/60);
        var second = parseInt((timeElapsed-day*3600*24-hour*3600-minute*60));
        $("#hover > .counter").children(".day").children(".number").html(day);
        $("#hover > .counter").children(".hour").children(".number").html(hour);
        $("#hover > .counter").children(".minute").children(".number").html(minute);
        $("#hover > .counter").children(".second").children(".number").html(second);
        setTimeout(function(){
            startCounter(el);
        },200);
    }
}

function startDedicatedCounter() {
    currentTime = parseInt((new Date()).getTime()/1000)+timeOffset;
    var endTime = parseInt($(".dedicated-counter").data("endtime"));
    timeElapsed = endTime - currentTime;
    //$("#hover.counter").children(".day").children(".number").html(timeElapsed);
    var day = parseInt(timeElapsed/3600/24);
    var hour = parseInt((timeElapsed-day*3600*24)/3600);
    var minute = parseInt((timeElapsed-day*3600*24-hour*3600)/60);
    var second = parseInt((timeElapsed-day*3600*24-hour*3600-minute*60));
    $(".dedicated-counter").children(".day").children(".number").html(day);
    $(".dedicated-counter").children(".hour").children(".number").html(hour);
    $(".dedicated-counter").children(".minute").children(".number").html(minute);
    $(".dedicated-counter").children(".second").children(".number").html(second);
    setTimeout(function(){
        startDedicatedCounter();
    },200);
}

function buttonSpin(el) {
    $(el).css("transition","0s").val("").addClass("spinner");
    
    //SET TIMEOUT INI DIGANTI AJA PAKE AJAX
    setTimeout(function(){
        buttonUnspin(el);
    },3000);
}

function buttonUnspin(el) { //BUAT KALAU BUTTON SPIN UDAH BERES
    $(el).css("transition","0.3s").val("LOGIN").removeClass("spinner");
}