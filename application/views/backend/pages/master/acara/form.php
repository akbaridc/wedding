<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <!-- simpan state error save data -->
            <input type="hidden" name="isError" id="isError" class="form-control" value="false">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-content-center justify-content-between pt-2">
                        <h5 class="card-title"><?= $anchor ?> Data Acara</h5>
                        <div class="d-flex align-items-center">
                            <a href="javascript:history.back()" class="btn btn-warning btn-sm me-3">
                                <i class="bi bi-arrow-left-circle me-1"></i>Kembali
                            </a>
                            <?php if ($mode != 'view') { ?>
                                <button type="button" class="btn btn-success btn-sm btn-saveData" onclick="handlerSaveDataAcara(event, '<?= $mode ?>', 'akad', 'resepsi')">
                                    <i class="bi bi-save me-1"> Simpan</i>
                                </button>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- form -->
                    <div class="mt-5">
                        <ul class="nav nav-pills mb-3" id="pills-tab-akad" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $typeUrl === '' ? 'active' : ($typeUrl == 'akad' ? 'active' : '') ?>" id="pills-akad-tab" data-bs-toggle="pill" data-bs-target="#pills-akad" typeUrl="button" role="tab" aria-controls="pills-akad" aria-selected="true">Akad Nikah</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?= $typeUrl === '' ? '' : ($typeUrl == 'resepsi' ? 'active' : '') ?>" id="pills-resepsi-tab" data-bs-toggle="pill" data-bs-target="#pills-resepsi" type="button" role="tab" aria-controls="pills-resepsi" aria-selected="false">Resepsi</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade <?= $typeUrl === '' ? 'show active' : ($typeUrl == 'akad' ? 'show active' : '') ?>" id="pills-akad" role="tabpanel" aria-labelledby="pills-akad-tab" tabindex="0">
                                <?php $data['type'] = 'akad'; ?>
                                <?php $this->load->view('backend/pages/master/acara/component/section/card-form', $data); ?>
                            </div>
                            <div class="tab-pane fade <?= $typeUrl === '' ? '' : ($typeUrl == 'resepsi' ? 'show active' : '') ?>" id="pills-resepsi" role="tabpanel" aria-labelledby="pills-resepsi-tab" tabindex="0">
                                <?php $data['type'] = 'resepsi'; ?>
                                <?php $this->load->view('backend/pages/master/acara/component/section/card-form', $data); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>