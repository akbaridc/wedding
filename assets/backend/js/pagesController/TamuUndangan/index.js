const table = $("#tableTamuUndangan").DataTable({
    columnDefs: [{
        sortable: false,
        targets: [0, 1, 2, 3, 4]
    }],
});

$('#example-select-all').on('click', function() {
    // Get all rows with search applied
    let rows = table.rows({
        'search': 'applied'
    }).nodes();

    // Check/uncheck checkboxes for all rows in the table
    $('input[name*="check-item"]', rows).map(function() {
        if (this.checked == false) {
        if (!this.disabled) {
            return this.checked = true;
        }
        } else {
        if (!this.disabled) {
            return this.checked = false;
        }
        }
    });
});

// Handle click on checkbox to set state of "Select all" control
$('#tableTamuUndangan tbody').on('change', 'input[name*="check-item"]', function() {
    // If checkbox is not checked
    if (!this.checked && !this.disabled) {
        let el = $('#example-select-all').get(0);
        // If "Select all" control is checked and has 'indeterminate' property
        if (el && el.checked && ('indeterminate' in el)) {
        // Set visual state of "Select all" control
        // as 'indeterminate'
        el.indeterminate = true;
        }
    }
});

const handlerSendMessageWhatsapp = (event) => {
    let rows = table.rows({
        'search': 'applied'
    }).nodes();

    const dataChecked = $('input[name*="check-item"]', rows).map(function() {
        if (this.checked == true && !this.disabled) {
            return this.value
        }
    }).get()

    if (dataChecked.length == 0) {
        message_topright('error', 'Minimal pilih 1 tamu undangan untuk kirim pesan ke whatsapp');
        return false;
    }

    sendMessageRequest(dataChecked)
}

const sendMessageRequest = (dataChecked) => {
    $.ajax({
        type: 'POST',
        url: `${baseUrl}tamu-undangan/kirim-pesan`,
        dataType: "JSON",
        data: {
            dataChecked,
        },
        beforeSend: function() {
            Swal.fire({
                title: '<span ><i class="fa fa-spinner fa-spin"></i> Loading...</span>',
                showConfirmButton: false,
                allowOutsideClick: false
            });
        },
        success: function(response) {
            console.log(response);
            return false;
            if(response.status){
                message_topright('success', response.message);
                setTimeout(() => location.reload(), 1300)
            } else {
                message_topright('error', response.message);
            }
        },
        error: function(xhr) { // if error occured
            Swal.fire({
                title: '<span ><i class="fa fa-spinner fa-spin"></i> Loading...</span>',
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 10
            });
        },
        complete: function() {
            Swal.fire({
                title: '<span ><i class="fa fa-spinner fa-spin"></i> Loading...</span>',
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 10
            });
        },
    });
}


const handlerAddNewRow = (event) => {
    $("#tableRowTamuUndangan > tbody").append(newRecordTamuUndangan());
}

const newRecordTamuUndangan = () => {

    const countRecordTamuUndangan = $("#tableRowTamuUndangan > tbody tr").length;

    return `
        <tr id="row-${countRecordTamuUndangan + 1}">
            <td>
                <input type="text" class="form-control" id="nama-${countRecordTamuUndangan + 1}" name="nama-${countRecordTamuUndangan + 1}" placeholder="Nama Tamu Undangan">
            </td>
            <td>
                <input type="text" class="form-control" id="telepon-${countRecordTamuUndangan + 1}" name="telepon-${countRecordTamuUndangan + 1}" placeholder="Telepon Tamu Undangan">
            </td>
            <td>
                <input type="text" class="form-control" id="temenDari-${countRecordTamuUndangan + 1}" name="temenDari-${countRecordTamuUndangan + 1}" placeholder="Temen Dari">
            </td>
            <td><button class="btn btn-danger btn-sm" type="button" onclick="handlerRemove(event, '${countRecordTamuUndangan + 1}')"><i class="bi bi-x"></i></button></td>
        </tr>
    `
}

const handlerRemove = (event, counter) => {
    const rowTable = document.getElementById("row-" + counter);
    rowTable.remove();

    $("#tableRowTamuUndangan > tbody tr").each(function(i, v){
        const namaTamuUndangan = $(this).find("td:eq(0) input[type='text']")
        const teleponTamuUndangan = $(this).find("td:eq(1) input[type='text']")
        const temenDariTamuUndangan = $(this).find("td:eq(2) input[type='text']")
        const button = $(this).find("td:eq(3) button")

        namaTamuUndangan.attr('id', `nama-${i + 1}`)
        namaTamuUndangan.attr('name', `nama-${i + 1}`)
        
        teleponTamuUndangan.attr('id', `telepon-${i + 1}`)
        teleponTamuUndangan.attr('name', `telepon-${i + 1}`)

        temenDariTamuUndangan.attr('id', `temenDari-${i + 1}`)
        temenDariTamuUndangan.attr('name', `temenDari-${i + 1}`)

        button.attr('onclick', `handlerRemove(event, '${i + 1}')`)
    })
}

const handlerOpenModal = (id, mode) => {
    $("#modalTamuUndangan").modal('show');
    $("#modalTamuUndangan .modal-title").html(`${mode == 'edit' ? 'Edit' : 'View'} Data Tamu Undangan`);
    mode == 'edit' ? $(".btn-simpan").show() : $(".btn-simpan").hide()

    postData(`${baseUrl}tamu-undangan/getDataTamuUndanganById`, {
        id
    }, 'POST').then((response) => {
        if (response) {

            $("#namaTamuUndangan").prop('disabled', mode == 'edit' ? false : true);
            $("#teleponTamuUndangan").prop('disabled', mode == 'edit' ? false : true);
            $("#temanDariTamuUndangan").prop('disabled', mode == 'edit' ? false : true);

            $("#idTamuUndangan").val(response.id);
            $("#namaTamuUndangan").val(response.nama);
            $("#teleponTamuUndangan").val(response.telepon);
            $("#temanDariTamuUndangan").val(response.teman_dari);
        }
    })
}

const handlerCloseModal = () => {
    $("#modalTamuUndangan").modal('hide');
    $("#idTamuUndangan").val('');
    $("#namaTamuUndangan").val('');
    $("#teleponTamuUndangan").val('');
    $("#temanDariTamuUndangan").val('');
}


const handlerSaveData = (event, mode) => {

    if(mode == 'add'){
        let dataTamuUndangan = []
        const isError = document.getElementById('isError')

        $("#tableRowTamuUndangan > tbody tr").each(function(i, v){
            const namaTamuUndangan = $(this).find("td:eq(0) input[type='text']")
            const teleponTamuUndangan = $(this).find("td:eq(1) input[type='text']")
            const temenDariTamuUndangan = $(this).find("td:eq(2) input[type='text']")
            
            if (namaTamuUndangan.val() == "") {
                message_topright('error', 'Nama Tamu Undangan masih ada yang kosong');
                isError.value = true;
                return false;
            } else if (teleponTamuUndangan.val() == ""){
                message_topright('error', 'Telepon Tamu Undangan masih ada yang kosong');
                isError.value = true;
                return false;
            } else if (temenDariTamuUndangan.val() == ""){
                message_topright('error', 'Temen Dari masih ada yang kosong');
                isError.value = true;
                return false;
            } else {
                isError.value = false;
                dataTamuUndangan.push({
                    nama: namaTamuUndangan.val(),
                    telepon: teleponTamuUndangan.val(),
                    temanDari: temenDariTamuUndangan.val(),
                })
            }

        })

        if(isError.value == 'true') return false;

        const requestSaveData = () => {

            event.srcElement.disabled = true;
            $(".btn-saveData").html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            `);

            postData(`${baseUrl}tamu-undangan/save-data`, {
                mode,
                dataTamuUndangan
            }, 'POST').then((response) => {
                event.srcElement.disabled = false;
                $(".btn-saveData").html(`<i class="bi bi-save me-1"> Simpan</i>`);
                
                if(response.status){
                    message_topright('success', response.message);
                    setTimeout(() => location.href = `${baseUrl}tamu-undangan`, 1000)
                } else {
                    message_topright('error', response.message);
                }
            })
        }

        messageBoxBeforeRequest('Pastikan data yang anda input benar!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
            if (result.value == true) {
                requestSaveData();
            }
        });
    }

    if (mode == 'edit') {
        const idTamuUndangan = $("#idTamuUndangan").val();
        const namaTamuUndangan = $("#namaTamuUndangan").val();
        const teleponTamuUndangan = $("#teleponTamuUndangan").val();
        const temanDariTamuUndangan = $("#temanDariTamuUndangan").val();

        if (namaTamuUndangan == "" || teleponTamuUndangan == "" || temanDariTamuUndangan == "") {
            message_topright('error', 'Field masih ada yang kosong');
            return false;
        }

        messageBoxBeforeRequest('Pastikan data yang anda input benar!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
            if (result.value == true) {
                postData(`${baseUrl}tamu-undangan/save-data`, {
                    mode,
                    id:idTamuUndangan,
                    nama:namaTamuUndangan,
                    telepon:teleponTamuUndangan,
                    temanDari:temanDariTamuUndangan
                }, 'POST').then((response) => {
                    if(response.status){
                        message_topright('success', response.message);
                        handlerCloseModal();
                        setTimeout(() => location.reload(), 1000)
                    } else {
                        message_topright('error', response.message);
                    }
                })
            }
        });
    }

    
}

const handlerDeleteTamuUndangan = (id) => {
    messageBoxBeforeRequest('Untuk delete data ini!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
        if (result.value == true) {
            postData(`${baseUrl}tamu-undangan/destroy`, {id}, 'POST').then((response) => {
                if(response.status){
                    message_topright('success', response.message);
                    setTimeout(() => location.reload(), 1000)
                  } else {
                    message_topright('error', response.message);
                  }
            })
        }
    });
}