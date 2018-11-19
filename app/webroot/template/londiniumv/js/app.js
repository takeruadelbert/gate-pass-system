$(document).ready(function () {
    $(".checkall").click(function () {
        var $checkBoxes = $(this).parents("thead").siblings("tbody").find("input.checkboxDeleteRow");
        if ($(this).is(":checked")) {
            $checkBoxes.attr("checked", "checked");
            $checkBoxes.parent("span").addClass("checked");
        } else {
            $checkBoxes.removeAttr("checked");
            $checkBoxes.parent("span").removeClass("checked");
        }
    });
    $('.opensmallwindow').bind('click', function () {
        //alert($(this).attr('href'));
        $.colorbox({
            href: $(this).data('href'),
            width: '555', //width: 555px; height: 296px; 
            height: '296'
        });
        return false;
    });
    $(".required").siblings("label").addClass("label-required");
    reloadDatePicker();
    reloadStyled();
})

function reloadDatePicker() {
    $.datetimepicker.setDateFormatter({
        parseDate: function (date, format) {
            var d = moment(date, format);
            return d.isValid() ? d.toDate() : false;
        },
        formatDate: function (date, format) {
            return moment(date).format(format);
        }
    });
    $(".datepicker").not(".datepicker-proccesed").each(function (i) {
        $this = $(this);
        if ($this.val() == "") {
            var val = "";
        } else {
            var val = moment($this.val()).format("Do MMM YYYY");
        }
        var realVal = $this.val();
        var name = $(this).attr("name");
        var formattedName = $(this).attr("id");
        if (formattedName === "") {
            formattedName = "datepicker" + new Date().getTime() + i;
        }
        $this.after("<input class='idpck-slave' type='hidden' value='" + realVal + "' id='idpck_" + formattedName + "' name='" + name + "'/>");
        $this.removeAttr("name").addClass("datepicker-proccesed").data("idpck-target", "idpck_" + formattedName).val(val);
    })
    $(".datepicker").datetimepicker({
        timepicker: false,
        format: "Do MMM YYYY",
        formatDate: 'Do MMM YYYY',
        formatTime: "H:mm",
        yearStart: 1900,
        onSelectDate: function (dp, $input) {
            var targetId = $input.data("idpck-target");
            $("#" + targetId).val(moment($input.val(), "Do MMM YYYY").format("YYYY-MM-DD")).trigger("change");
        }
    });
    $(".datetime").not(".datetime-proccesed").each(function (i) {
        $this = $(this);
        if ($this.val() == "") {
            var val = "";
        } else {
            var val = moment($this.val()).format("Do MMM YYYY H:mm:ss");
        }
        var realVal = $this.val();
        var name = $(this).attr("name");
        var formattedName = "n" + new Date().getTime() + i;
        $this.after("<input class='idpck-slave' type='hidden' value='" + realVal + "' id='idpck_" + formattedName + "' name='" + name + "'/>");
        $this.removeAttr("name").addClass("datetime-proccesed").data("idpck-target", "idpck_" + formattedName).val(val);
    });
    $(".datetime").datetimepicker({
        format: "Do MMM YYYY H:mm:ss",
        formatDate: 'Do MMM YYYY',
        formatTime: "H:mm",
        step: 15,
        onSelectDate: function (dp, $input) {
            var targetId = $input.data("idpck-target");
            $("#" + targetId).val(moment($input.val(), "Do MMM YYYY H:mm:ss").format("YYYY-MM-DD HH:mm:ss"));
        },
        onSelectTime: function (dp, $input) {
            var targetId = $input.data("idpck-target");
            $("#" + targetId).val(moment($input.val(), "Do MMMM YYYY H:mm:ss").format("YYYY-MM-DD HH:mm:ss"));
        },
        onChangeDateTime: function (dp, $input) {
            var targetId = $input.data("idpck-target");
            $("#" + targetId).val(moment($input.val(), "Do MMMM YYYY H:mm:ss").format("YYYY-MM-DD HH:mm:ss"));
        }
    });
    $(".timepicker").datetimepicker({
        format: "H:mm",
        formatDate: 'Do MMM YYYY',
        formatTime: "H:mm",
        step: 15,
        datepicker: false,
    });
}

function reloadStyled() {
    $(".styled, .multiselect-container input").uniform({radioClass: 'choice', selectAutoWidth: false});
}

$(document).ready(function () {
    NProgress.start();
})

$(window).load(function () {
    NProgress.done();
})

function notif(type, message) {
    var template = $("#tmp-alert-" + type).html();
    Mustache.parse(template);
    var rendered = Mustache.render(template, {message: message});
    $("#flash-block").append(rendered);
}