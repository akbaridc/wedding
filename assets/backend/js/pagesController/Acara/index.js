
const triggerTabList = document.querySelectorAll('#pills-tab-akad button')
triggerTabList.forEach(triggerEl => {
	const tabTrigger = new bootstrap.Tab(triggerEl)

	triggerEl.addEventListener('click', event => {
		event.preventDefault()
		tabTrigger.show()
	})
})

const handlerWaktuAcara = (event, type) => {
	if (event.currentTarget.checked) {
		$(`#waktuSelesai-${type}`).val('');
		$(`#showFormWaktuSelesai-${type}`).hide('slow');
	} else {
		$(`#showFormWaktuSelesai-${type}`).show('slow');
	}
}

const handlerTempatAcara = (event, type) => {
	if (event.currentTarget.value === "other") {
		$(`#showFormTempat-${type}`).show('slow');
	} else {
		$(`#tempatAcaraOther-${type}`).val('');
		$(`#alamatAcaraOther-${type}`).val('');
		$(`#showFormTempat-${type}`).hide('slow');
	}
}

const handlerSaveDataAcara = (event, mode, akad, resepsi) => {

	const tanggalAcaraAkad = $(`#tanggalAcara-${akad}`)
	const waktuMulaiAcaraAkad = $(`#waktuMulai-${akad}`)
	const isFinishedAcaraAkad = $(`#isFinished-${akad}`)
	const waktuSelesaiAcaraAkad = $(`#waktuSelesai-${akad}`)
	const tempatAcaraAkad = $(`#tempatAcara-${akad}`)
	const tempatOtherAcaraAkad = $(`#tempatAcaraOther-${akad}`)
	const alamatOtherAcaraAkad = $(`#alamatAcaraOther-${akad}`)

	const tanggalAcaraResepsi = $(`#tanggalAcara-${resepsi}`)
	const waktuMulaiAcaraResepsi = $(`#waktuMulai-${resepsi}`)
	const isFinishedAcaraResepsi = $(`#isFinished-${resepsi}`)
	const waktuSelesaiAcaraResepsi = $(`#waktuSelesai-${resepsi}`)
	const tempatAcaraResepsi = $(`#tempatAcara-${resepsi}`)
	const tempatOtherAcaraResepsi = $(`#tempatAcaraOther-${resepsi}`)
	const alamatOtherAcaraResepsi = $(`#alamatAcaraOther-${resepsi}`)

	const dataParams = {
		mode,
		akad,
		resepsi,
		tanggalAcaraAkad,
		waktuMulaiAcaraAkad,
		isFinishedAcaraAkad,
		waktuSelesaiAcaraAkad,
		tempatAcaraAkad,
		tempatOtherAcaraAkad,
		alamatOtherAcaraAkad,
		tanggalAcaraResepsi,
		waktuMulaiAcaraResepsi,
		isFinishedAcaraResepsi,
		waktuSelesaiAcaraResepsi,
		tempatAcaraResepsi,
		tempatOtherAcaraResepsi,
		alamatOtherAcaraResepsi,
	}
	  
	validasiData(dataParams);

	let error = false;

	$(".check-error").each(function(){
		const dataError = $(this).attr('data-error');
		if (typeof dataError !== 'undefined') {
			if (dataError == 'true') {
				error += true;
			} else {
				error += false;
			}
		} else {
			error += false;
		}
	})

	if (error) {
		message_topright('error', 'Field masih ada yang kosong, silahkan cek kembali!');
		return false;
	}

	const requestSaveData = () => {
		const dataAcaraPost = [
			{
				type: 'akad',
				tanggalAcara: tanggalAcaraAkad.val(),
				waktuMulaiAcara: waktuMulaiAcaraAkad.val(),
				isFinishedAcara: isFinishedAcaraAkad.is(':checked'),
				waktuSelesaiAcara: waktuSelesaiAcaraAkad.val(),
				tempatAcara: tempatAcaraAkad.children("option").filter(":selected").val(),
				tempatOtherAcara: tempatOtherAcaraAkad.val(),
				alamatOtherAcara: alamatOtherAcaraAkad.val()
			},
			{
				type: 'resepsi',
				tanggalAcara: tanggalAcaraResepsi.val(),
				waktuMulaiAcara: waktuMulaiAcaraResepsi.val(),
				isFinishedAcara: isFinishedAcaraResepsi.is(':checked'),
				waktuSelesaiAcara: waktuSelesaiAcaraResepsi.val(),
				tempatAcara: tempatAcaraResepsi.children("option").filter(":selected").val(),
				tempatOtherAcara: tempatOtherAcaraResepsi.val(),
				alamatOtherAcara: alamatOtherAcaraResepsi.val()
			}
		]

		postData(`${baseUrl}acara/save-data`, {
			mode,
			dataAcaraPost
		}, 'POST', function(response){
			if (response.status) {
				message_topright('success', response.message);
				setTimeout(() => location.href = `${baseUrl}acara`, 1000)
			} else {
				message_topright('error', response.message);
			}
		}, ".btn-saveData")
	}

	messageBoxBeforeRequest('Pastikan data yang anda input benar!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
		if (result.value) requestSaveData();
	});
}

const validasiData = (params) => {

	getAndSetErrorValidation(params.tanggalAcaraAkad);
	getAndSetErrorValidation(params.waktuMulaiAcaraAkad);
	if (params.isFinishedAcaraAkad.is(':checked') == false) {
		getAndSetErrorValidation(params.waktuSelesaiAcaraAkad);
	}
	
	if (params.tempatAcaraAkad.children("option").filter(":selected").val() === "") {
		getAndSetErrorValidation(params.tempatAcaraAkad);
	} else {
		if(params.tempatAcaraAkad.children("option").filter(":selected").val() === "other"){
			getAndSetErrorValidation(params.tempatOtherAcaraAkad);
			getAndSetErrorValidation(params.alamatOtherAcaraAkad);
		} else {
			getAndSetErrorValidation(params.tempatAcaraAkad);
		}
	}

	getAndSetErrorValidation(params.tanggalAcaraResepsi);
	getAndSetErrorValidation(params.waktuMulaiAcaraResepsi);
	if (params.isFinishedAcaraResepsi.is(':checked') == false) {
		getAndSetErrorValidation(params.waktuSelesaiAcaraResepsi);
	}
	
	if (params.tempatAcaraResepsi.children("option").filter(":selected").val() === "") {
		getAndSetErrorValidation(params.tempatAcaraResepsi);
	} else {
		if(params.tempatAcaraResepsi.children("option").filter(":selected").val() === "other"){
			getAndSetErrorValidation(params.tempatOtherAcaraResepsi);
			getAndSetErrorValidation(params.alamatOtherAcaraResepsi);
		} else {
			getAndSetErrorValidation(params.tempatAcaraResepsi);
		}
	}

}

const getAndSetErrorValidation = (element) => {
	if (element.val() == "") {
		element.addClass("is-invalid")
		$(`.invalid-feedback-${element.attr('name')}`).html('Field tidak boleh kosong')
		element.attr('data-error', true)
	} else {
		element.removeClass("is-invalid")
		$(`.invalid-feedback-${element.attr('name')}`).html('')
		element.attr('data-error', false)
	}
}