<section class="s1 displayAwal" id="hadiah" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
	<div class="content-contai">
		<h1 class="mt-3 text-center text-white fw-600">Gift</h1>
		<div class="text-center rounded mt-3 p-3" style="background: #fff;max-width: fit-content;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
			<p>Doa Restu Bapak/Ibu/Saudara/i merupakan karunia yang sangat berarti bagi kami. Dan jika memberi adalah ungkapan tanda kasih Bapak/Ibu/Saudara/i, Bapak/Ibu/Saudara/i dapat memberi kado secara cashless dibawah ini.</p>
		</div>
		<div class="d-flex flex-wrap align-items-center justify-content-center mt-4 gap-3">

			<?php if (!empty($dataRekening)) { ?>
				<?php foreach ($dataRekening as $key => $value) { ?>
					<div class="card" data-aos="fade-up" data-aos-delay="200" data-aos-duration="<?= ($key + 1) * 200 ?>">
						<div class="card-body">
							<div class="d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bold" style="color: <?= $value->color ?>;"><?= $value->rekening ?></h3>
									<p class="fw-semibold text-truncate" style="line-height: normal;max-width:95%"><?= $value->atas_nama ?></p>
									<div>
										<p class="me-3 d-inline" id="idCard<?= $value->nomor_rekening ?>"><?= $value->nomor_rekening ?></p>
										<i class="bi bi-clipboard d-inline copy-text<?= $value->nomor_rekening ?>" style="cursor: pointer" onclick="handlerCopyText(event, '<?= $value->nomor_rekening ?>')" data-clipboard-target="#idCard<?= $value->nomor_rekening ?>"></i>
									</div>
								</div>
								<div>
									<img src="<?= base_url('assets/backend/img/rekening/' . $value->logo) ?>" alt="" class="img-fluid img-responsive" width="80" />
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } else { ?>
				<div class="alert alert-danger text-center">
					<h2>Give Card Kosong</h2>
				</div>
			<?php } ?>
		</div>
	</div>
</section>