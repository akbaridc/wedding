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

		event.srcElement.disabled = true;
		$(".btn-save").html(`
				<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
				Loading...
		`);

		$.ajax({
			url: `${baseUrl}audio/save-data`,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			beforeSend: () => {
				event.srcElement.disabled = true;
				$(".btn-save").html(`
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						Loading...
					`);
			},
			success: function (response) {
				if (response.status) {
					message_topright('success', response.message);
					setTimeout(() => location.reload(), 1000)
				} else {
					message_topright('error', response.message);
				}
			},
			complete: () => {
				event.srcElement.disabled = false;
				$(".btn-save").html(`<i class="bi bi-save me-1"> Simpan</i>`);
			},
		});
	}

	messageBoxBeforeRequest('Pastikan data yang anda input benar!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
		if (result.value == true) {
			requestSaveData();
		}
	});
}
