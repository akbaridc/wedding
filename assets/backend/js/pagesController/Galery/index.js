let arrFileFoto = [];

const handlerTambahModalGalery = (event) => {
	$("#modal-tambah-galery").modal('show')
}

const handlerCloseModalTambahGalery = (event) => {
	$("#tambahGalery").val("")
	$('.show-file').empty();
	$("#modal-tambah-galery").modal('hide')
}

function previewFile(e) {

	imagesPreview(e, 'div.show-file');
	$("#tambahGalery").val("")
}

const imagesPreview = function (input, placeToInsertImagePreview) {

	if (input.files) {
		const filesAmount = input.files.length;

		if ($('.img-view-add').length > 8 || filesAmount > 8) {
			message_topright('error', 'Max Upload Galery 8');
			return false;
		}

		for (let i = 0; i < filesAmount; i++) {
			const reader = new FileReader();
			reader.fileName = input.files[i]
			reader.addEventListener("load", function (event) {
				// let result = reader.result;
				const idx = $('.img-view-add').length;
				if ((idx + 1) > 8) {
					message_topright('error', 'Max Upload Galery 8');
					return false;
				}

				arrFileFoto.push({
					idx,
					files: event.target.fileName
				})

				$('.show-file').append(`
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 counterDiv mt-3" id="counterDiv_${idx}">
							<div class="delete" onclick="handlerRemove('${idx}', null, null, null)">X</div>
							<a href="${event.target.result}" data-lightbox="image-galery" class="parent-img">
									<div class="img-view-add" style="background-image: url('${event.target.result}');"></div>
							</a>
						</div>
				`);
			}, false);

			reader.readAsDataURL(input.files[i]);
		}

	}

};

function handlerRemove(counter, galeryId, fileFoto, type) {

	if (type == 'front') {

		messageBoxBeforeRequest('Data yang didelete tidak dapat kembali!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
			if (result.value == true) {
				postData(`${baseUrl}galery/destroy`, { galeryId, fileFoto }, 'POST').then((response) => {
					if (response.status) {
						message_topright('success', response.message);
						setTimeout(() => location.reload(), 1000)
					} else {
						message_topright('error', response.message);
					}
				})
			}
		});

	} else {
		const filterData = arrFileFoto.filter((item) => item.idx !== counter);

		arrFileFoto.length = 0;
		filterData.forEach((item, index) => {
			arrFileFoto.push({
				idx: index,
				files: item.files
			})
		})

		const rowDiv = document.getElementById("counterDiv_" + counter);
		rowDiv.remove();
		$("#tambahGalery").val("")

		$(".counterDiv").each(function (i, v) {
			let divDelete = $(this).closest('div').children('div');

			$(this).attr('id', `counterDiv_${i}`);
			divDelete.attr('onclick', `handlerRemove('${i}', null, null, null)`)
		})
	}
}

const handlerSaveGalery = (event) => {

	if (arrFileFoto.length == 0) {
		message_topright('success', 'Galery masih kosong, silahkan upload minimal 1 gambar');
		return false;
	}

	let formData = new FormData();
	$.each(arrFileFoto, function (i, v) {
		formData.append('files[]', v.files);
	})

	const requestSaveData = () => {

		event.srcElement.disabled = true;
		$(".btn-tutup").prop('disabled', true);
		$(".btn-simpan").html(`
				<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
				Loading...
		`);

		$(".showLoadingImage").show();

		$.ajax({
			type: "POST",
			url: `${baseUrl}galery/save-data`,
			data: formData,
			contentType: false,
			processData: false,
			dataType: "json",
			beforeSend: () => {
				event.srcElement.disabled = true;
				$(".btn-tutup").prop('disabled', true);
				$(".btn-simpan").html(`
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						Loading...
					`);
				$(".showLoadingImage").show();
			},
			success: function (response) {
				if (response.status) {
					message_topright('success', response.message);
					setTimeout(() => {
						handlerCloseModalTambahGalery()
						location.reload();
					}, 1000)
				} else {
					message_topright('error', response.message);
				}
			},
			complete: () => {
				event.srcElement.disabled = false;
				$(".btn-tutup").prop('disabled', false);
				$(".btn-simpan").html(`<i class="bi bi-save me-1"> Simpan</i>`);
				$(".showLoadingImage").hide();
			},
		});
	}

	messageBoxBeforeRequest('Pastikan data yang anda input benar!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
		if (result.value == true) {
			requestSaveData();
		}
	});
}
