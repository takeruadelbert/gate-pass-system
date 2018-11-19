window.onhashchange = function () {
//    var hashes = location.hash.split("#");
//    var hash = hashes[hashes.length - 1].replace(/#/g, '');
//    if (hash.length > 0) {
//        $.ajax({
//            url: BASE_URL + hash,
//            success: function (data) {
//                $(CONTENT_SELECTOR).html(data);
//            },
//            error: function (jqXHR, textStatus, errorThrown) {
//                switch (jqXHR.status) {
//                    case 404:
//                        alert("Halaman tidak ditemukan");
//                        break;
//                    case 405:
//                        break;
//                    case 500:
//                        alert("Internal error");
//                        break;
//                    case 401:
//                        break;
//                }
//            }
//        });
//    }
}

$(document).ready(function () {
    $(".btn-filter").click(function () {
        doFilter($(this));
    });
    $(".btn-filter-reset").click(function () {
        window.location.href = BASE_URL + URL;
    });
    $(".panel-filter input").keypress(function (e) {
        if (e.which == 13) {
            doFilter($(this));
        }
    });
    $(".angka").number(true, 0, ",", ".");
    $(".date").attr("type", "date");
    $(".city-state").on("change", function () {
        cityList(this, $(this).data("city-state-target"));
    });
    $(".autolist").on("change", function () {
        autolist(this);
    });
    loadckeditor();
})

function doFilter(e) {
    var data = e.closest(".panel-filter").serialize();
    window.location.href = BASE_URL + URL + "?" + data;
}

function formHandler(formE, buttonE) {
    var data = $(formE).serialize();
    var url = $(formE).attr('action');
    $.ajax({
        type: "POST",
        data: data,
        url: url,
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            if (data.status == 101) {
                displayError(data);
            } else if (data.status == 200) {

            }
        }
    });
}

function hapusData(id, e) {
    if (confirm("Anda yakin menghapus data ini?")) {
        $.ajax({
            type: "DELETE",
            url: BASE_URL + PREFIX + "/" + CONTROLLER + "/delete/" + id,
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.status == 204) {
                    var template = $("#tmp-alert-warning").html();
                    Mustache.parse(template);
                    var rendered = Mustache.render(template, {message: data.message});
                    $("#flash-block").html(rendered);
                    $(e).remove();
                } else if (data.status == 400) {

                }
            }
        });
    }
}

function hapusDataUrl(id, url, e) {
    if (confirm("Anda yakin menghapus data ini?")) {
        $.ajax({
            type: "DELETE",
            url: url + id,
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                if (data.status == 204) {
                    var template = $("#tmp-alert-warning").html();
                    Mustache.parse(template);
                    var rendered = Mustache.render(template, {message: data.message});
                    $("#flash-block").html(rendered);
                    if (typeof (e) === "function") {
                        e();
                    } else {
                        $(e).remove();
                    }
                } else {
                    alert(data.message);
                }
            }
        });
    }
}

function getOptions(e, url, label, parent) {
    var id = $(parent + " option:selected").val() || null;
    if (id == null) {
        id = "";
    }
    label = label || "";
    console.log(id);
    $.ajax({
        type: "GET",
        url: url + "/" + id,
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $(e).html("");
            $(e).append("<option >" + label + "</option>")
            $.each(data, function (k, v) {
                $(e).append("<option value='" + k + "'>" + v + "</option>");
            })
            console.log(jqXHR);
        }
    });
}

function windowOpener(windowHeight, windowWidth, windowName, windowUri) {
    var centerWidth = (window.screen.width - windowWidth) / 2;
    var centerHeight = (window.screen.height - windowHeight) / 2;

    newWindow = window.open(windowUri, windowName, 'resizable=1,scrollbars=yes,width=' + windowWidth +
            ',height=' + windowHeight +
            ',left=' + centerWidth +
            ',top=' + centerHeight);

    newWindow.focus();
    return newWindow.name;
}

function changeStatus(id, status, url, e) {
    $.ajax({
        type: "PUT",
        url: url,
        data: {id: id, status: status},
        dataType: "JSON",
        success: function (data) {
            $(e).html(data.data.status_label);
            alert(data.message);
        },
        error: function () {

        }
    })
}

function fixckeditor() {
    $(".ckeditor-fix").each(function () {
        var instanceId = $(this).attr('id');
        $("#" + instanceId).val(CKEDITOR.instances[instanceId].getData());
    })
}

function loadckeditor() {
    $(".ckeditor-fix").each(function () {
        var instanceId = $(this).attr('id');
        CKEDITOR.config.extraPlugins = 'lineheight';
        CKEDITOR.replace(instanceId);
    })
}

function cityList(e, targetE) {
    var id = $(e).val();
    $.ajax({
        url: BASE_URL + "admin/cities/list/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            var $target = $(targetE);
            $target.html("<option value=''>- Pilih Kota -</option>");
            $.each(data.data, function (k, v) {
                $target.append("<option value='" + k + "'>" + v + "</option>");
            })
        },
        error: function () {

        }
    })
}

function ajaxError() {
    $.growl.warning({title: "Error", message: "Tidak terhubung dengan server."});
}

function ajaxSuccessDefault(response, callback) {
    switch (response.status) {
        case 207:
        case 206:
            $.growl.notice({title: "Sukses", message: response.message});
            break;
        default:
            $.growl.warning({title: "Error", message: response.message});
    }
    if (typeof callback === "function") {
        callback();
    }
}
var hari = [
    "Minggu",
    "Senin",
    "Selasa",
    "Rabu",
    "Kamis",
    "Jumat",
    "Sabtu",
];

var bulan = [
    "Januari",
    "Febuari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember"
];

function cvtHariTanggal(date) {
    var d = new Date(date);
    return hari[d.getUTCDay()] + ", " + d.getUTCDate() + " " + bulan[d.getUTCMonth()] + " " + d.getUTCFullYear();
}

function cvtTanggal(date) {
    var d = new Date(date);
    return d.getUTCDate() + " " + bulan[d.getUTCMonth()] + " " + d.getUTCFullYear();
}

function sprintf() {
    // http://kevin.vanzonneveld.net
    // +   original by: Ash Searle (http://hexmen.com/blog/)
    // + namespaced by: Michael White (http://getsprink.com)
    // +    tweaked by: Jack
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Paulo Freitas
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Dj
    // +   improved by: Allidylls
    // *     example 1: sprintf("%01.2f", 123.1);
    // *     returns 1: 123.10
    // *     example 2: sprintf("[%10s]", 'monkey');
    // *     returns 2: '[    monkey]'
    // *     example 3: sprintf("[%'#10s]", 'monkey');
    // *     returns 3: '[####monkey]'
    // *     example 4: sprintf("%d", 123456789012345);
    // *     returns 4: '123456789012345'
    var regex = /%%|%(\d+\$)?([-+\'#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuideEfFgG])/g;
    var a = arguments,
            i = 0,
            format = a[i++];

    // pad()
    var pad = function (str, len, chr, leftJustify) {
        if (!chr) {
            chr = ' ';
        }
        var padding = (str.length >= len) ? '' : Array(1 + len - str.length >>> 0).join(chr);
        return leftJustify ? str + padding : padding + str;
    };

    // justify()
    var justify = function (value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
        var diff = minWidth - value.length;
        if (diff > 0) {
            if (leftJustify || !zeroPad) {
                value = pad(value, minWidth, customPadChar, leftJustify);
            } else {
                value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
            }
        }
        return value;
    };

    // formatBaseX()
    var formatBaseX = function (value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
        // Note: casts negative numbers to positive ones
        var number = value >>> 0;
        prefix = prefix && number && {
            '2': '0b',
            '8': '0',
            '16': '0x'
        }[base] || '';
        value = prefix + pad(number.toString(base), precision || 0, '0', false);
        return justify(value, prefix, leftJustify, minWidth, zeroPad);
    };

    // formatString()
    var formatString = function (value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
        if (precision != null) {
            value = value.slice(0, precision);
        }
        return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
    };

    // doFormat()
    var doFormat = function (substring, valueIndex, flags, minWidth, _, precision, type) {
        var number;
        var prefix;
        var method;
        var textTransform;
        var value;

        if (substring == '%%') {
            return '%';
        }

        // parse flags
        var leftJustify = false,
                positivePrefix = '',
                zeroPad = false,
                prefixBaseX = false,
                customPadChar = ' ';
        var flagsl = flags.length;
        for (var j = 0; flags && j < flagsl; j++) {
            switch (flags.charAt(j)) {
                case ' ':
                    positivePrefix = ' ';
                    break;
                case '+':
                    positivePrefix = '+';
                    break;
                case '-':
                    leftJustify = true;
                    break;
                case "'":
                    customPadChar = flags.charAt(j + 1);
                    break;
                case '0':
                    zeroPad = true;
                    break;
                case '#':
                    prefixBaseX = true;
                    break;
            }
        }

        // parameters may be null, undefined, empty-string or real valued
        // we want to ignore null, undefined and empty-string values
        if (!minWidth) {
            minWidth = 0;
        } else if (minWidth == '*') {
            minWidth = +a[i++];
        } else if (minWidth.charAt(0) == '*') {
            minWidth = +a[minWidth.slice(1, -1)];
        } else {
            minWidth = +minWidth;
        }

        // Note: undocumented perl feature:
        if (minWidth < 0) {
            minWidth = -minWidth;
            leftJustify = true;
        }

        if (!isFinite(minWidth)) {
            throw new Error('sprintf: (minimum-)width must be finite');
        }

        if (!precision) {
            precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type == 'd') ? 0 : undefined;
        } else if (precision == '*') {
            precision = +a[i++];
        } else if (precision.charAt(0) == '*') {
            precision = +a[precision.slice(1, -1)];
        } else {
            precision = +precision;
        }

        // grab value using valueIndex if required?
        value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];

        switch (type) {
            case 's':
                return formatString(String(value), leftJustify, minWidth, precision, zeroPad, customPadChar);
            case 'c':
                return formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
            case 'b':
                return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'o':
                return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'x':
                return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'X':
                return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad).toUpperCase();
            case 'u':
                return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
            case 'i':
            case 'd':
                number = +value || 0;
                number = Math.round(number - number % 1); // Plain Math.round doesn't just truncate
                prefix = number < 0 ? '-' : positivePrefix;
                value = prefix + pad(String(Math.abs(number)), precision, '0', false);
                return justify(value, prefix, leftJustify, minWidth, zeroPad);
            case 'e':
            case 'E':
            case 'f': // Should handle locales (as per setlocale)
            case 'F':
            case 'g':
            case 'G':
                number = +value;
                prefix = number < 0 ? '-' : positivePrefix;
                method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
                textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
                value = prefix + Math.abs(number)[method](precision);
                return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
            default:
                return substring;
        }
    };

    return format.replace(regex, doFormat);
}

function autolist(e) {
    var id = $(e).val();
    console.log(id);
    var targetE = $(e).data("autolist-target");
    var url = $(e).data("autolist-url");
    var emptyLabel = $(e).data("autolist-emptylabel");
    $.ajax({
        url: url + id,
        type: "GET",
        dataType: "JSON",
        success: function (response) {
            var $target = $(targetE);
            $target.html("<option value=''>" + emptyLabel + "</option>");
            $.each(response.data, function (k, v) {
                $target.append("<option value='" + k + "'>" + v + "</option>");
            })
        },
        error: function () {

        }
    })
}