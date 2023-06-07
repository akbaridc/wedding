<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <!-- simpan state error save data -->
            <input type="hidden" name="isError" id="isError" class="form-control">
            <input type="hidden" name="rekeningHadiahId" id="rekeningHadiahId" class="form-control" value="<?= $dataRekeningHadiah !== "" ? $dataRekeningHadiah->id : "" ?>">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-content-center justify-content-between pt-2">
                        <h5 class="card-title"><?= $anchor ?> Data Rekening Hadiah</h5>
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
                                    <select name="rekeningId" id="rekeningId" class="form-select" <?= $disable ?>>
                                        <option value="">--Pilih Rekening--</option>
                                        <?php foreach ($dataRekening as $key => $value) { ?>
                                            <?php if ($dataRekeningHadiah !== "") { ?>
                                                <?php if ($value->id == $dataRekeningHadiah->id_rekening) { ?>
                                                    <option value="<?= $value->id ?>" selected><?= $value->rekening ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $value->id ?>"><?= $value->rekening ?></option>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <option value="<?= $value->id ?>"><?= $value->rekening ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <label for="rekeningId">Rekening</label>
                                </div>
                                <div class="invalid-feedback invalid-feedback-rekeningId"></div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="input-group has-validation mb-3">
                                <div class="form-floating is-invalid">
                                    <input type="text" class="form-control" name="atasNama" id="atasNama" placeholder="Atas Nama Rekening" <?= $disable ?> value="<?= $dataRekeningHadiah !== "" ? $dataRekeningHadiah->atas_nama : "" ?>">
                                    <label for="atasNama">Atas Nama</label>
                                </div>
                                <div class="invalid-feedback invalid-feedback-atasNama"></div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="input-group has-validation mb-3">
                                <div class="form-floating is-invalid">
                                    <input type="text" class="form-control" name="nomorRekening" id="nomorRekening" placeholder="Nomor Rekening" <?= $disable ?> value="<?= $dataRekeningHadiah !== "" ? $dataRekeningHadiah->nomor_rekening : "" ?>">
                                    <label for="nomorRekening">Nomor Rekening</label>
                                </div>
                                <div class="invalid-feedback invalid-feedback-nomorRekening"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>