// SELECT2 HANDLER
$(".select2").select2({
    theme: 'bootstrap4'
});
$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
});
// SELECT2 HANDLER END

var created_at = "{!! @$filters->category_id !!}";

// DATE PICKER HANDLER
$('#reservation').daterangepicker({
    autoUpdateInput: false,
    locale: {
        cancelLabel: 'Clear'
    }
})

$('#reservation').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
        'DD/MM/YYYY'));
});

$('#reservation').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
});


// DATE PICKER HANDLER END

// DATATABLE HANDLER 
const makeDatatable = (element) => {
    // DATATABLE HANDLER
    $(element).DataTable({
        responsive: true,
        select: {
            style: 'multi'
        },
        searching: false,
        paging: false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                text: 'Print all',
                exportOptions: {
                    columns: ':visible',
                    modifier: {
                        selected: null
                    }
                },
                customize: function(win) {
                    $(win.document.body)
                        .css('font-size', '10pt')

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            },
            {
                extend: 'print',
                text: 'Print selected',
                exportOptions: {
                    columns: ':visible',
                }
            },
            'colvis'
        ],
        autoWidth: true,
    });
}
// DATATABLE HANDLER END