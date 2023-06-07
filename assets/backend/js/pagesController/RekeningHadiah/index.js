const handlerSaveDataRekening = (event, mode) => {

    const rekeningHadiahId = document.getElementById('rekeningHadiahId')
    const rekeningId = document.getElementById('rekeningId')
    const atasNama = document.getElementById('atasNama')
    const nomorRekening = document.getElementById('nomorRekening')

    const isError = document.getElementById('isError')
    
    validasiData(rekeningId, atasNama, nomorRekening, isError);

    if(isError.value == 'true') return false;

    const requestSaveData = () => {

        event.srcElement.disabled = true;
        $(".btn-saveData").html(`
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
        `);

        postData(`${baseUrl}rekening-hadiah/save-data`, {
            rekeningHadiahId: rekeningHadiahId.value, 
            rekeningId: rekeningId.value, 
            atasNama: atasNama.value, 
            nomorRekening: nomorRekening.value,
            mode
        }, 'POST').then((response) => {
            event.srcElement.disabled = false;
            $(".btn-saveData").html(`<i class="bi bi-save me-1"> Simpan</i>`);
            if(response.status){
                message_topright('success', response.message);
                setTimeout(() => location.href = `${baseUrl}rekening-hadiah`, 1000)
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

const validasiData = (rekeningId, atasNama, nomorRekening, isError) => {
    getAndSetErrorValidation(rekeningId, isError);
    getAndSetErrorValidation(atasNama, isError);
    getAndSetErrorValidation(nomorRekening, isError);
}

const getAndSetErrorValidation = (element, isError) => {
    if (element.value == "") {
        element.classList.add("is-invalid")
        $(`.invalid-feedback-${element.getAttribute('name')}`).html('Field tidak boleh kosong')
        isError.value = true;
    } else {
        element.classList.remove("is-invalid")
        $(`.invalid-feedback-${element.getAttribute('name')}`).html('')
        isError.value = false;
    }
}

const handlerDeleteRekening = (id) => {
    messageBoxBeforeRequest('Untuk delete data ini!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
        if (result.value == true) {
            postData(`${baseUrl}rekening-hadiah/destroy`, {id}, 'POST').then((response) => {
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