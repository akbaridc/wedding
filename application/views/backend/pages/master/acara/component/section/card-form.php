<div class="row mb-5">
	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
		<div class="input-group has-validation">
			<div class="form-floating is-invalid">
				<input type="date" name="tanggalAcara-<?= $type ?>" id="tanggalAcara-<?= $type ?>" class="form-control check-error" <?= $disable ?> value="<?= ($dataAcaraAkad !== "" || $dataAcaraResepsi !== "") ? ($dataAcaraAkad->type_ === $type ? $dataAcaraAkad->tanggal : $dataAcaraResepsi->tanggal) : '' ?>">
				<label for="tanggalAcara-<?= $type ?>">Tanggal Acara</label>
			</div>
			<div class="invalid-feedback invalid-feedback-tanggalAcara-<?= $type ?>"></div>
		</div>
	</div>

	<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-5">
				<div class="input-group has-validation">
					<div class="form-floating is-invalid">
						<input type="time" name="waktuMulai-<?= $type ?>" id="waktuMulai-<?= $type ?>" class="form-control check-error" <?= $disable ?> value="<?= ($dataAcaraAkad !== "" || $dataAcaraResepsi !== "") ? ($dataAcaraAkad->type_ === $type ? $dataAcaraAkad->waktu_mulai : $dataAcaraResepsi->waktu_mulai) : '' ?>">
						<label for="waktuMulai-<?= $type ?>">Waktu Mulai</label>
					</div>
					<div class="invalid-feedback invalid-feedback-waktuMulai-<?= $type ?>"></div>
				</div>
			</div>

			<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-xs-2 align-items-center justify-content-center align-self-center text-center">
				<div class="form-check">
					<?php
					if ($dataAcaraAkad !== "" || $dataAcaraResepsi !== "") {
						if ($dataAcaraAkad->type_ === $type) {
							if ($dataAcaraAkad->is_finished == 1) {
								$chkWaktuAcara = "checked";
							} else {
								$chkWaktuAcara = "";
							}
						} else {
							if ($dataAcaraResepsi->is_finished == 1) {
								$chkWaktuAcara = "checked";
							} else {
								$chkWaktuAcara = "";
							}
						}
					} else {
						$chkWaktuAcara = "";
					}
					?>
					<input class="form-check-input" type="checkbox" <?= $chkWaktuAcara ?> <?= $disable ?> id="isFinished-<?= $type ?>" onchange="handlerWaktuAcara(event, '<?= $type ?>')">
					<label class="form-check-label" for="isFinished-<?= $type ?>">
						Selesai
					</label>
				</div>
				<h4>-</h4>
			</div>

			<?php
			if ($dataAcaraAkad !== "" || $dataAcaraResepsi !== "") {
				if ($dataAcaraAkad->type_ === $type) {
					if ($dataAcaraAkad->is_finished == 1) {
						$showWaktuAcara = "none";
					} else {
						$showWaktuAcara = "block";
					}
				} else {
					if ($dataAcaraResepsi->is_finished == 1) {
						$showWaktuAcara = "none";
					} else {
						$showWaktuAcara = "block";
					}
				}
			} else {
				$showWaktuAcara = "block";
			}
			?>
			<div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-5" style="display: <?= $showWaktuAcara ?>" id="showFormWaktuSelesai-<?= $type ?>">
				<div class="input-group has-validation">
					<div class="form-floating is-invalid">
						<?php
						if ($dataAcaraAkad !== "" || $dataAcaraResepsi !== "") {
							if ($dataAcaraAkad->waktu_selesai != null || $dataAcaraResepsi->waktu_selesai != null) {
								if ($dataAcaraAkad->type_ === $type) {
									$waktuSelesai = $dataAcaraAkad->waktu_selesai;
								} else {
									$waktuSelesai = $dataAcaraResepsi->waktu_selesai;
								}
							} else {
								$waktuSelesai = "";
							}
						} else {
							$waktuSelesai = "";
						}
						?>
						<input type="time" name="waktuSelesai-<?= $type ?>" id="waktuSelesai-<?= $type ?>" class="form-control check-error" <?= $disable ?> value="<?= $waktuSelesai ?>">
						<label for="waktuSelesai-<?= $type ?>">Waktu Selesai</label>
					</div>
					<div class="invalid-feedback invalid-feedback-waktuSelesai-<?= $type ?>"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12">
				<div class="input-group has-validation mb-3">
					<div class="form-floating is-invalid">
						<select name="tempatAcara-<?= $type ?>" id="tempatAcara-<?= $type ?>" class="form-select check-error" <?= $disable ?> onchange="handlerTempatAcara(event, '<?= $type ?>')">
							<option value="">--Pilih Tempat--</option>
							<?php if (!empty($dataMempelai)) { ?>
								<?php foreach ($dataMempelai as $key => $value) { ?>
									<?php if ($dataAcaraAkad !== '' || $dataAcaraResepsi !== '') { ?>
										<?php if ($dataAcaraAkad->id_mempelai != null || $dataAcaraResepsi->id_mempelai != null) { ?>
											<?php if ($dataAcaraAkad->type_ === $type) { ?>
												<?php if ($dataAcaraAkad->id_mempelai == $value->id) { ?>
													<option value="<?= $value->id ?>" selected>Rumah Mempelai <?= $value->is_gender == "1" ? 'Pria' : 'Wanita' ?></option>
												<?php } else { ?>
													<option value="<?= $value->id ?>">Rumah Mempelai <?= $value->is_gender == "1" ? 'Pria' : 'Wanita' ?></option>
												<?php } ?>
											<?php } else { ?>
												<?php if ($dataAcaraResepsi->id_mempelai == $value->id) { ?>
													<option value="<?= $value->id ?>" selected>Rumah Mempelai <?= $value->is_gender == "1" ? 'Pria' : 'Wanita' ?></option>
												<?php } else { ?>
													<option value="<?= $value->id ?>">Rumah Mempelai <?= $value->is_gender == "1" ? 'Pria' : 'Wanita' ?></option>
												<?php } ?>
											<?php } ?>
										<?php } else { ?>
											<option value="<?= $value->id ?>">Rumah Mempelai <?= $value->is_gender == "1" ? 'Pria' : 'Wanita' ?></option>
										<?php } ?>
									<?php } else { ?>
										<option value="<?= $value->id ?>">Rumah Mempelai <?= $value->is_gender == "1" ? 'Pria' : 'Wanita' ?></option>
									<?php } ?>
								<?php } ?>
							<?php } ?>

							<?php
							if ($dataAcaraAkad !== "" || $dataAcaraResepsi !== "") {
								if ($dataAcaraAkad->type_ === $type) {
									if ($dataAcaraAkad->id_mempelai != null) {
										$slcOptionTempat = "";
									} else {
										$slcOptionTempat = "selected";
									}
								} else {
									if ($dataAcaraResepsi->id_mempelai != null) {
										$slcOptionTempat = "";
									} else {
										$slcOptionTempat = "selected";
									}
								}
							} else {
								$slcOptionTempat = "";
							}
							?>
							<option <?= $slcOptionTempat ?> value="other">Tempat Lainnya</option>
						</select>
						<label for="tempatAcara-<?= $type ?>">Tempat Acara</label>
					</div>
					<div class="invalid-feedback invalid-feedback-tempatAcara-<?= $type ?>"></div>
				</div>
			</div>


			<?php
			if ($dataAcaraAkad !== "" || $dataAcaraResepsi !== "") {
				if ($dataAcaraAkad->type_ === $type) {
					if ($dataAcaraAkad->id_mempelai != null) {
						$showTempatAcara = "none";
					} else {
						$showTempatAcara = "block";
					}
				} else {
					if ($dataAcaraResepsi->id_mempelai != null) {
						$showTempatAcara = "none";
					} else {
						$showTempatAcara = "block";
					}
				}
			} else {
				$showTempatAcara = "block";
			}
			?>
			<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12 align-items-center justify-content-center align-self-center text-center" id="showFormTempat-<?= $type ?>" style="display: <?= $showTempatAcara ?>;">
				<div class="input-group has-validation mb-3">
					<div class="form-floating is-invalid">
						<?php
						if ($dataAcaraAkad !== "" || $dataAcaraResepsi !== "") {
							if ($dataAcaraAkad->tempat_other != null || $dataAcaraResepsi->tempat_other != null) {
								if ($dataAcaraAkad->type_ === $type) {
									$tempatOtherAcara = $dataAcaraAkad->tempat_other;
								} else {
									$tempatOtherAcara = $dataAcaraResepsi->tempat_other;
								}
							} else {
								$tempatOtherAcara = "";
							}
						} else {
							$tempatOtherAcara = "";
						}
						?>
						<textarea name="tempatAcaraOther-<?= $type ?>" id="tempatAcaraOther-<?= $type ?>" class="form-control check-error" cols="3" rows="10" style="resize: none;height: 70px;" <?= $disable ?>><?= $tempatOtherAcara ?></textarea>
						<label for="tempatAcaraOther-<?= $type ?>">Tempat Other</label>
					</div>
					<div class="invalid-feedback invalid-feedback-tempatAcaraOther-<?= $type ?>"></div>
				</div>

				<div class="input-group has-validation mb-3">
					<div class="form-floating is-invalid">
						<?php
						if ($dataAcaraAkad !== "" || $dataAcaraResepsi !== "") {
							if ($dataAcaraAkad->alamat_other != null || $dataAcaraResepsi->alamat_other != null) {
								if ($dataAcaraAkad->type_ === $type) {
									$alamatOtherAcara = $dataAcaraAkad->alamat_other;
								} else {
									$alamatOtherAcara = $dataAcaraResepsi->alamat_other;
								}
							} else {
								$alamatOtherAcara = "";
							}
						} else {
							$alamatOtherAcara = "";
						}
						?>
						<textarea name="alamatAcaraOther-<?= $type ?>" id="alamatAcaraOther-<?= $type ?>" class="form-control check-error" cols="3" rows="10" style="resize: none;height: 130px;" <?= $disable ?>><?= $alamatOtherAcara ?></textarea>
						<label for="alamatAcaraOther-<?= $type ?>">Alamat Tempat Other</label>
					</div>
					<div class="invalid-feedback invalid-feedback-alamatAcaraOther-<?= $type ?>"></div>
				</div>
			</div>
		</div>
	</div>
</div>