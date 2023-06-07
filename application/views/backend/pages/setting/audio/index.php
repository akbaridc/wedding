<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Data Sound Audio</h5>

                    </div>
                    <!-- Table with stripped rows -->
                    <div class="row mt-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="d-flex align-items-center justify-content-between my-3">
                                <h3 class="fw-semibold text-start">Sound Audio</h3>
                                <button type="button" class="btn btn-primary btn-sm btn-save" onclick="handlerSaveData(event)"><i class="bi bi-save me-1"></i> Simpan</button>
                            </div>
							<div class="row">
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<input type="file" name="soundAudio" id="soundAudio" onchange="previewFileAudio(event)" class="form-control" accept="audio/*">
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
									<div class="showAudio">
										<?php if ($dataAudio) { ?>
											<audio controls src="<?= base_url('assets/backend/audio/'. $dataAudio[0]->source)?>"></audio>
										<?php }?>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
