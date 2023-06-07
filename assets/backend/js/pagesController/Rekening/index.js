const handlerPreviewFile = (event) => {
    let parentOutput = document.getElementById('parent-logo-rekening');
    let output = document.getElementById('logo-rekening');
    parentOutput.style.display = 'block';
    parentOutput.href = URL.createObjectURL(event.target.files[0]);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};

const handlerSaveDataRekening = (event, mode) => {

    const rekeningId = document.getElementById('rekeningId')
    const rekening = document.getElementById('rekening')
    const color = document.getElementById('color')
    const logoRekening = $('#logoRekening')

    const isError = document.getElementById('isError')
    
    validasiData(mode, rekening, color, isError);

    let formData = new FormData();
    formData.append('rekeningId', rekeningId.value);
    formData.append('rekening', rekening.value);
    formData.append('color', color.value);
    if(mode == 'add') {
        formData.append('files', logoRekening[0].files[0]);
    } else {
        if(logoRekening.val() == ""){
            formData.append('files', null);
        } else {
            formData.append('files', logoRekening[0].files[0]);
        }
    }
    formData.append('mode', mode);

    if(isError.value == 'true') return false;

    const requestSaveData = () => {

        event.srcElement.disabled = true;
        $(".btn-saveData").html(`
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
        `);

        $.ajax({
            url: `${baseUrl}rekening/save-data`,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            beforeSend: () => {
              event.srcElement.disabled = true;
              $(".btn-saveData").html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
              `);
            },
            success: function(response) {
              if(response.status){
                message_topright('success', response.message);
                setTimeout(() => location.href = `${baseUrl}rekening`, 1000)
              } else {
                message_topright('error', response.message);
              }
            },
            complete: () => {
              event.srcElement.disabled = false;
              $(".btn-saveData").html(`<i class="bi bi-save me-1"> Simpan</i>`);
            },
          });
    }

    messageBoxBeforeRequest('Pastikan data yang anda input benar!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
        if (result.value == true) {
            requestSaveData();
        }
    });
}

const validasiData = (mode, rekening, color, isError) => {
    
    const logoRekening = document.getElementById('logoRekening')

    if (mode == 'add') {
        getAndSetErrorValidation(logoRekening, isError);
    }

    getAndSetErrorValidation(rekening, isError);
    getAndSetErrorValidation(color, isError);
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

const handlerDeleteRekening = (id, foto) => {
    messageBoxBeforeRequest('Untuk delete data ini!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
        if (result.value == true) {
            postData(`${baseUrl}rekening/destroy`, {id, foto}, 'POST').then((response) => {
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