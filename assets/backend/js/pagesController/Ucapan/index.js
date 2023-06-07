const handlerOpenModalReplyUcapan = (id, nama) => {
	$("#modalReplyUcapan").modal('show');
	$("#modalReplyUcapan .modal-title").html(`Reply Ucapan dari <strong>${nama}</strong>`);

	$("#id").val(id);
	$("#nama").val(nama);
}

const handlerCloseModal = () => {
	$("#modalReplyUcapan").modal('hide');
	$("#id").val('');
	$("#nama").val('');
}


const handlerSaveData = (event) => {

	const id = $("#id").val();
	const reply = $("#reply").val();

	if (reply == "") {
		message_topright('error', 'Reply Ucapan tidak boleh kosong');
		return false;
	}

	messageBoxBeforeRequest('Pastikan data yang anda input benar!', 'Iya, Yakin', 'Tidak, Tutup').then((result) => {
		if (result.value == true) {
			postData(`${baseUrl}ucapan/reply-ucapan`, {
				id,
				reply
			}, 'POST').then((response) => {
				if (response.status) {
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

