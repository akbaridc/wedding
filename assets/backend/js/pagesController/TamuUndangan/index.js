const handlerAddNewRow = (event) => {
    $("#tableRowTamuUndangan > tbody").append(newRecordTamuUndangan());
}

const newRecordTamuUndangan = () => {

    const countRecordTamuUndangan = $("#tableRowTamuUndangan > tbody tr").length;

    return `
        <tr>
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
    event.target.parentElement.parentElement.parentElement.remove();

    $("#tableRowTamuUndangan > tbody tr").each(function(i, v){
        const namaTamuUndangan = $(this).find("td:eq(0) input[type='text']")
        const teleponTamuUndangan = $(this).find("td:eq(1) input[type='text']")
        const temenDariTamuUndangan = $(this).find("td:eq(2) input[type='text']")
        const button = $(this).find("td:eq(3) button")

        if(i > 0){
            namaTamuUndangan.attr({
                id: `nama-${i + 1}`,
                name: `nama-${i + 1}`,
            })
            
            teleponTamuUndangan.attr({
                id: `telepon-${i + 1}`,
                name: `telepon-${i + 1}`,
            })
    
            temenDariTamuUndangan.attr({
                id: `temenDari-${i + 1}`,
                name: `temenDari-${i + 1}`,
            })
    
            button.attr('onclick', `handlerRemove(event, '${i + 1}')`)
        }
        
    })
}

const handlerOpenModal = (id, mode) => {
    $("#modalTamuUndangan").modal('show');
    $("#modalTamuUndangan .modal-title").html(`${mode == 'edit' ? 'Edit' : 'View'} Data Tamu Undangan`);
    mode == 'edit' ? $(".btn-simpan").show() : $(".btn-simpan").hide()

    postData(`${baseUrl}tamu-undangan/getDataTamuUndanganById`, {id}, 'POST', function(response){
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

const handlerGenerateMessage = (message, namaTamuUndangan, urlLink) => {
    $("#modalGenerateMessage").modal('show');

    $("#modalGenerateMessage .modal-title").html(`Generate message untuk <strong>${namaTamuUndangan}</strong>`)
    $("#modalGenerateMessage .modal-body .container").append(`
        <p>Kepada <strong>*${namaTamuUndangan}*</strong></p>
        <p><i>_Assalamu'alaikum Wr.Wb_</i></p>
        <p class="d-block">Bismillahirrahmanirrahim <span class="d-block">Tanpa mengurangi rasa hormat, izinkan kami mengundang Bapak/Ibu/Saudara/i untuk hadir serta memberikan do'a restu pada acara pernikahan kami.</span></p>
        <p class="d-block">Untuk detail acara, lokasi serta ucapan bisa klik tautan dibawah ini: <a class="d-block" href="${urlLink}">${urlLink}</a></p>
        
        <p>Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i berkenan hadir dalam acara pernikahan kami.</p>
        <p>Atas kehadiran dan do'a restu Bapak/Ibu/Saudara/i kami ucapkan terima kasih 🙏</p>
        <p><i>_Wassalamu'alaikum Wr.Wb._</i></p>`)
}

const handlerCopyMessage = (event) => {
	const clipboard = new ClipboardJS(`.copyMessage`);

	clipboard.on("success", function (e) {
		message_topright("success", "Berhasil copy text");
	});

	clipboard.on("error", function (e) {
		message_topright("error", "Gagal copy text");
	});
};

const handlerCloseModal = (type) => {
    if(type === 'proses') {
        $("#modalTamuUndangan").modal('hide');
        $("#idTamuUndangan").val('');
        $("#namaTamuUndangan").val('');
        $("#teleponTamuUndangan").val('');
        $("#temanDariTamuUndangan").val('');
    }

    if(type === 'generate'){
        $("#modalGenerateMessage").modal('hide');
        $("#modalGenerateMessage .modal-body .container").empty();
    }
    
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

            postData(`${baseUrl}tamu-undangan/save-data`, {mode, dataTamuUndangan}, 'POST', function(response){
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
                }, 'POST', function(response){
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
            postData(`${baseUrl}tamu-undangan/destroy`, {id}, 'POST', function(response){
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