const deleteButtonInit = (csrf_token) => {
    const deleteButtons = document.querySelectorAll('#deleteButton');
    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        let modelId = e.target.dataset.modelId;
                        let deleteUrl = `${location.origin + location.pathname}/${modelId}`;

                        $.ajax({
                            type: 'post',
                            url: deleteUrl,
                            data: {
                                '_method': 'DELETE'
                            },
                            headers: {
                                'X-CSRF-TOKEN': csrf_token
                            },
                            success: () => {
                                $('#datatable').dataTable().api().draw()
                                swal({
                                    title: "Deleted",
                                    icon: "success",
                                    text: null
                                })
                            },
                            error: (e) => {
                                swal({
                                    title: e.statusText ?? "Error!",
                                    icon: "error",
                                    text: e.responseJSON ?? null
                                })
                            }
                        })
                    } else {
                        // swal("Your data is safe!");
                    }
                });
        })
    });
}
