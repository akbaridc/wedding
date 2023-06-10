const previewFileAudio = (event) => {
	const source = event.target.files[0];
	const mime = source.type;

	let $player;
	if (/^audio/.test(mime)) { // audio
		$player = $('<audio controls />');
	} else if (/^video/.test(mime)) { // video
		message_topright('File hanya diperbolehkan .mp3')
		return;
	} else {
		message_topright('File hanya diperbolehkan .mp3')
		return;
	}

	$('.showAudio').empty().append($player);
	$player[0].src = URL.createObjectURL(source);
}

const handlerSaveData = (event) => {
	const file = $(`#soundAudio`)

	if (file.val() === "") {
		message_topright('error', `File Audio tidak boleh kosong`);
		return false
	}

	const source = file[0].files[0];
	const mime = source.type;

	if (/^video/.test(mime)) {
		message_topright('File hanya diperbolehkan .mp3')
		return;
	}

	let formData = new FormData();
	formData.append('files', source);

	const requestSaveData = () => {
		postData(`${baseUrl}audio/save-data`, {
			formData: formData
		}, 'POST', function(response){
			if (response.status) {
				message_topright('success', response.message);
				setTimeout(() => location.reload(), 1000)
			} else {
				message_topright('error', response.message);
			}
		}, ".btn-save", "multipart-formdata")
	}

	messageBoxBeforeRequest('Pastikan data yang anda input benar!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
		if (result.value == true) requestSaveData();
	});
}
