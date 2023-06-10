const handlerShownMaps = (event) => {
    const value = event.currentTarget.value;
    if (!value.includes("iframe") || value == "") {
        $(".showMaps").empty();
        return false;
    }
    $(".showMaps").empty()
    $(".showMaps").append(value)
}

const handlerSaveData = (event) => {
    const linkMaps = $('#linkMaps').val();
    if (!linkMaps.includes("<iframe") && !linkMaps.includes("</iframe>")) {
        message_topright('error', 'Format link maps salah, gunakan format <iframe>...</iframe>')
        return false
    }
    if (linkMaps == "") {
        message_topright('error', 'Link maps tidak boleh kosong')
        return false;
    }

    messageBoxBeforeRequest('Pastikan data yang di input sudah benar!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
        if (result.value == true) {
            postData(`${baseUrl}maps/save-data`, {linkMaps}, 'POST', function(response){
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