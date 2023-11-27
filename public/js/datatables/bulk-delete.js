const startBulkDelete = (csrf_token, bulkDeleteUrl) => {
    // const deleteSelectedForm = document.querySelector('#deleteSelectedForm');
    // const ids = document.querySelector('#deleteSelectedForm input#ids');
    let selectedRowsArr = []
    let selectedRows = document.querySelectorAll('tr.selected');
    selectedRows.forEach(row => {
        selectedRowsArr.push(row.dataset.modelId);
    });

    if (selectedRowsArr.length == 0) {
        swal({
            title: "0 Data selected",
            text: "Please select minimal 1 data!",
            icon: "error",
        });

    } else {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover your datas!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'post',
                    url: bulkDeleteUrl,
                    data: {
                        '_method': 'DELETE',
                        'ids': selectedRowsArr.toString()
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    success: () => {
                        swal({
                            title: "Deleted",
                            icon: "success",
                            text: null
                        })
                        $('#datatable').dataTable().api().draw()
                    },
                    error: (e) => {
                        console.log(e);
                        swal({
                            title: e.statusText ?? "Error!",
                            icon: "error",
                            text: e.responseJSON ?? null
                        })
                    }
                })
            } else {
                //
            }
        })
    }
}
