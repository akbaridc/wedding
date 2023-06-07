<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <!-- simpan state error save data -->
            <input type="hidden" name="isError" id="isError" class="form-control">
            <input type="hidden" name="rekeningId" id="rekeningId" class="form-control" value="<?= $dataRekening !== "" ? $dataRekening->id : "" ?>">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-content-center justify-content-between pt-2">
                        <h5 class="card-title"><?= $anchor ?> Data Rekening</h5>
                        <div class="d-flex align-items-center">
                            <a href="javascript:history.back()" class="btn btn-warning btn-sm me-3">
                                <i class="bi bi-arrow-left-circle me-1"></i>Kembali
                            </a>
                            <?php if ($mode != 'view') { ?>
                                <button type="button" class="btn btn-success btn-sm btn-saveData" onclick="handlerSaveDataRekening(event, '<?= $mode ?>')">
                                    <i class="bi bi-save me-1"> Simpan</i>
                                </button>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- form -->
                    <div class="row mt-5">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="input-group has-validation mb-3">
                                <div class="form-floating is-invalid">
                                    <input type="text" class="form-control" name="rekening" id="rekening" placeholder="Nama Rekening" <?= $disable ?> value="<?= $dataRekening !== "" ? $dataRekening->rekening : "" ?>">
                                    <label for="rekening">Rekening</label>
                                </div>
                                <div class="invalid-feedback invalid-feedback-rekening"></div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <?php if ($mode == 'edit') { ?>
                                <label for="logoRekening" class="text-danger" style="font-size: 11px;">*Kosongi jika tidak merubah log</label>
                            <?php } ?>
                            <?php if ($mode != 'view') { ?>
                                <input type="file" name="logoRekening" id="logoRekening" class="form-control mb-2" onchange="handlerPreviewFile(event)" accept="image/*">
                            <?php } ?>
                            <div class="invalid-feedback mb-3 invalid-feedback-logoRekening"></div>
                            <a href="<?= $dataRekening !== "" ? base_url('assets/backend/img/rekening/' . $dataRekening->logo) : "" ?>" data-lightbox="Image" id="parent-logo-rekening" style="display: <?= $mode == 'add' ? 'none' : 'block' ?>;">
                                <img src="<?= $dataRekening !== "" ? base_url('assets/backend/img/rekening/' . $dataRekening->logo) : "" ?>" alt="" class="img-responsive rounded mx-auto text-center logo-rekening w-75" id="logo-rekening" height="100">
                            </a>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="input-group has-validation mb-3">
                                <div class="form-floating is-invalid">
                                    <input type="color" class="form-control" name="color" id="color" <?= $disable ?> value="<?= $dataRekening !== "" ? $dataRekening->color : "" ?>">
                                    <label for="color">Warna</label>
                                </div>
                                <div class="invalid-feedback invalid-feedback-color"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>