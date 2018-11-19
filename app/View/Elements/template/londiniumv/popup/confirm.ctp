<script type="text/javascript">
    function ajaxErrorConfirm(request, type, errorThrown)
    {
        var message = "There was an error with the AJAX request.\n";
        switch (type) {
            case 'timeout':
                message += "The request timed out.";
                break;
            case 'notmodified':
                message += "The request was not modified but was not retrieved from the cache.";
                break;
            case 'parseerror':
                message += "XML/Json format is bad.";
                break;
            default:
                message += "HTTP Error (" + request.status + " " + request.statusText + ") or maybe you has entered duplicate code.";
        }
        message += "\n";
        notif("warning",message);
    }
    //Handle the 'actual' delete button:
    function deleteMultiple(e) {
        if ($('.checkboxDeleteRow:checked').length == 0) {
            alert('Silahkan pilih salah satu atau lebih data terlebih dahulu');
            $("#multipledelete").modal("toggle");
            return false;
        } else {
            var url = $('#checkboxForm').attr('action');
            var data = $('#checkboxForm').serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: 'json', // <-- notice that this should be dataType, not datattype
                beforeSend: function () {
                    e.button("loading");
                },
                complete: function () {
                    e.button("reset");
                },
                success: function (data, textStatus, jqXHR) {
                    if (data.status == 203) {
//                        $.growl.warning({title: "Error", message: data.message});
                        notif("danger", data.message);
                    } else if (data.status == 204) {
//                        $.growl.notice({title: "Sukses", message: data.message});
                        notif("warning", data.message);
                        //window.location.reload(true);
                        var fields = $('#checkboxForm').serializeArray();
                        //console.log(fields);

                        $.each(fields, function (i, field) {
                            //$("#results").append(field.value + " ");
                            //alert(field.value);
                            $('.removeRow' + field.value).effect("highlight", {}, 3000).remove();
                        });
                        $("#multipledelete").modal("toggle");
                        return false;
                    }
                },
                error: ajaxErrorConfirm
            });
            //cancel the submit button default behaviours
            return false;
        }
    }
</script>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title"><?= __("Konfirmasi Penghapusan Data") ?></h4>

</div>
<div class="modal-body">
    <div class="te">
        <div class="popup-confirmation">
            <span class="alert_big_ico">&nbsp;</span>
            <div class="text-center">
                <b>Apakah Anda yakin akan menghapus data terpilih?</b>
                <div class="clear"></div>
                <smal class="text-danger">Note : Jika Anda memilih Ya, aksi ini tidak dapat di batalkan.</small>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><?= __("Batal") ?></button>
    <button type="button" class="btn btn-primary" onclick="deleteMultiple($(this))"><?= __("Ok") ?></button>
</div>