const handlerPreviewFile = (event) => {
	let parentOutput = document.getElementById('parent-profile-mempelai');
	let output = document.getElementById('profile-mempelai');
	parentOutput.style.display = 'block';
	parentOutput.href = URL.createObjectURL(event.target.files[0]);
	output.src = URL.createObjectURL(event.target.files[0]);
	output.onload = function () {
		URL.revokeObjectURL(output.src) // free memory
	}
};

const handlerAddSosialMedia = () => {
	const namaSosialMedia = document.getElementById('namaSosialMedia')
	const linkSosialMedia = document.getElementById('linkSosialMedia')
	const iconSosialMedia = document.getElementById('iconSosialMedia')
	const isErrorSosial = document.getElementById('isErrorSosial')

	validasiData(null, namaSosialMedia, linkSosialMedia, iconSosialMedia, null, null, isErrorSosial, 'sosmed');
	if (isErrorSosial.value == 'true') return false;

	$("#initSosialMedia > tbody").append(`
        <tr>
            <td>${namaSosialMedia.value}</td>
            <td>${linkSosialMedia.value}</td>
            <td><i class="bi ${iconSosialMedia.value}"></i></td>
            <td>
                <button type="button" class="btn btn-danger btn-sm btndelete"><i class="bi bi-trash"></i></button>
            </td>
        </tr>
    `)

	namaSosialMedia.value = ""
	linkSosialMedia.value = ""
	iconSosialMedia.value = ""
}

$(document).on('click', '.btndelete', function () {
	$(this).parent().parent().remove();
});

const handlerSaveDataMempelai = (event, mode) => {

	const mempelaiId = document.getElementById('mempelaiId')
	const gender = document.getElementById('gender')
	const namaLengkap = document.getElementById('namaLengkap')
	const namaPanggilan = document.getElementById('namaPanggilan')
	const namaOrangTua = document.getElementById('namaOrangTua')
	const alamat = document.getElementById('alamat')
	const fotoMempelai = $('#fotoMempelai')

	const isError = document.getElementById('isError')
	let arrSosialMedia = []

	validasiData(mode, gender, namaLengkap, namaPanggilan, namaOrangTua, alamat, isError, '');

	if (isError.value == 'true') return false;

	$("#initSosialMedia > tbody tr").each(function (i, v) {
		const namaSosialMedia = $(this).find("td:eq(0)").html();
		const linkSosialMedia = $(this).find("td:eq(1)").html();
		const iconSosialMedia = $(this).find("td:eq(2) i");

		arrSosialMedia.push({
			namaSosialMedia,
			linkSosialMedia,
			iconSosialMedia: iconSosialMedia.attr('class').split(' ')[1]
		})

	});

	let formData = new FormData();
	formData.append('mempelaiId', mempelaiId.value);
	if (mode == 'add') {
		formData.append('gender', gender.value);
	}
	formData.append('namaLengkap', namaLengkap.value);
	formData.append('namaPanggilan', namaPanggilan.value);
	formData.append('namaOrangTua', namaOrangTua.value);
	formData.append('alamat', alamat.value);
	if (mode == 'add') {
		formData.append('files', fotoMempelai[0].files[0]);
	} else {
		if (fotoMempelai.val() == "") {
			formData.append('files', null);
		} else {
			formData.append('files', fotoMempelai[0].files[0]);
		}
	}
	formData.append('mode', mode);
	if (arrSosialMedia.length > 0) {
		$.each(arrSosialMedia, function (i, v) {
			formData.append('sosialMedia[]', `${v.namaSosialMedia}|${v.linkSosialMedia}|${v.iconSosialMedia}`);
		})
	} else {
		formData.append('sosialMedia[]', []);
	}


	const requestSaveData = () => {

		postData(`${baseUrl}mempelai/save-data`, {
			formData: formData
		}, 'POST', function(response){
			if (response.status) {
				message_topright('success', response.message);
				setTimeout(() => location.href = `${baseUrl}mempelai`, 1000)
			} else {
				message_topright('error', response.message);
			}
		}, ".btn-saveData", "multipart-formdata")
	}

	messageBoxBeforeRequest('Pastikan data yang anda input benar!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
		if (result.value == true) {
			requestSaveData();
		}
	});
}

const validasiData = (mode, gender, namaLengkap, namaPanggilan, namaOrangTua, alamat, isError, type) => {

	if (type == "") {
		const fotoMempelai = document.getElementById('fotoMempelai')
		if (mode == 'add') {
			getAndSetErrorValidation(gender, isError);
			getAndSetErrorValidation(fotoMempelai, isError);
		}

		// getAndSetErrorValidation(gender, isError);
		getAndSetErrorValidation(namaLengkap, isError);
		getAndSetErrorValidation(namaPanggilan, isError);
		getAndSetErrorValidation(namaOrangTua, isError);
		getAndSetErrorValidation(alamat, isError);
	} else {
		getAndSetErrorValidation(gender, isError);
		getAndSetErrorValidation(namaLengkap, isError);
		getAndSetErrorValidation(namaPanggilan, isError);
	}
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

const handlerDeleteMempelai = (id, foto) => {
	messageBoxBeforeRequest('Untuk delete data ini!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
		if (result.value == true) {
			postData(`${baseUrl}mempelai/destroy`, { id, foto }, 'POST').then((response) => {
				if (response.status) {
					message_topright('success', response.message);
					setTimeout(() => location.reload(), 1000)
				} else {
					message_topright('error', response.message);
				}
			})
		}
	});
}
