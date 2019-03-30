$('#searchable-table').DataTable({
    "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
    ],
    "scrollY": 310,
    "iDisplayLength": 10,
    "bLengthChange": false,
    "language": {
        search: "<i class='fa fa-search'></i>"
    }
});
$('#searchable-table').each(function () {
    var datatable = $(this);
    // SEARCH - Add the placeholder for Search and Turn this into in-line form control
    var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
    search_input.attr('placeholder', 'Rechercher');
    // search_input.removeClass('form-control-sm');
});
$('form.docDelete').submit(
    function (event) {
        event.preventDefault();
        event.stopPropagation();
        const swalWithBootstrapButtons = Swal.mixin({
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-success',
            buttonsStyling: false,
        })

        swalWithBootstrapButtons.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous ne pourrez pas revenir en arrière!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmer!',
            cancelButtonText: 'Annuler',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                this.submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Annuler',
                    'Votre fichier est en sécurité :)',
                    'error'
                )
            }
        })
    }
);
$('form.membreDelete').submit(
    function (event) {
        event.preventDefault();
        event.stopPropagation();
        const swalWithBootstrapButtons = Swal.mixin({
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-success',
            buttonsStyling: false,
        })

        swalWithBootstrapButtons.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous ne pourrez pas revenir en arrière!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmer!',
            cancelButtonText: 'Annuler',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                this.submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Annuler',
                    'Votre fichier est en sécurité :)',
                    'error'
                )
            }
        })
    }
);