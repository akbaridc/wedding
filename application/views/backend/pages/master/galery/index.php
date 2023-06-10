<section class="section">
	<div class="row">
		<div class="col-lg-12">

			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between">
						<h5 class="card-title">Data Galery</h5>
						<button type="button" onclick="handlerTambahModalGalery(event)" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Tambah Galery</button>
					</div>
					<!-- Table with stripped rows -->
					<div class="row mt-4">
						<?php if (!empty($dataGalery)) { ?>
							<?php foreach ($dataGalery as $key => $value) { ?>
								<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-4">
									<div class="delete" onclick="handlerRemove('<?= $key ?>', '<?= $value->id ?>','<?= $value->foto ?>', 'front')">X</div>
									<a href="<?= base_url('assets/backend/img/galery/' . $value->foto) ?>" data-lightbox="image-galery" class="parent-img">
										<div class="img-view" style="background-image: url('<?= base_url('assets/backend/img/galery/' . $value->foto) ?>');"></div>
									</a>
								</div>
							<?php } ?>
						<?php } else { ?>
							<div class="col-12">
								<div class="alert alert-danger text-center">
									<h2>Data Galery Kosong</h2>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>


<div class="modal fade" id="modal-tambah-galery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-tambah-galeryLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="modal-tambah-galeryLabel">Tambah Galery</h1>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="file" name="tambahGalery" id="tambahGalery" class="form-control w-50" onchange="previewFile(this)" accept="image/*" multiple max="3" maxlength="3">
				</div>
				<div class="row mt-4 show-file"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-tutup" onclick="handlerCloseModalTambahGalery(event)">Tutup</button>
				<button type="button" class="btn btn-primary btn-simpan" onclick="handlerSaveGalery(event)">Simpan</button>
			</div>
		</div>
	</div>
</div>