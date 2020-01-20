/* ============================================================
 * DataTables
 * Generate advanced tables with sorting, export options using
 * jQuery DataTables plugin
 * For DEMO purposes only. Extract what you need.
 * ============================================================ */
(function($) {

    'use strict';

    var responsiveHelper = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };


    // Initialize datatable with ability to add rows dynamically
    var initTableWithDynamicRows = function() {
        var table = $('#tableWithDynamicRows');

        var settings = {
            "sDom": "<'table-responsive't>",
            "sPaginationType": "bootstrap",
            "destroy": true,
            "scrollCollapse": true,
            "oLanguage": {
            },
        };


        table.dataTable(settings);

        $('#show-modal').click(function() {
            $('#addNewAppModal').modal('show');
        });

        $('#add-app').click(function() {
            table.dataTable().fnAddData([
                $("#appName").val(),
                $("#appDescription").val(),
                $("#appPrice").val(),
                $("#appNotes").val()
            ]);
            $('#addNewAppModal').modal('hide');

        });
        $(".table-responsive").after($("#footer-pagination").html());
        $("#footer-pagination").remove();
    }


    initTableWithDynamicRows();

})(window.jQuery);