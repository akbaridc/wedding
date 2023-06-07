<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Data Maps Acara</h5>

                    </div>
                    <!-- Table with stripped rows -->
                    <div class="row mt-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="my-3 fw-semibold text-start">Link Maps</h3>
                                <button type="button" class="btn btn-primary btn-sm primary" onclick="handlerSaveData(event)"><i class="bi bi-save me-1"></i> Simpan</button>
                            </div>
                            <textarea name="linkMaps" id="linkMaps" cols="3" onkeyup="handlerShownMaps(event)" rows="10" class="form-control" style="height: 250px;resize:none"><?= $dataMaps ? $dataMaps->alamat : '' ?></textarea>
                            <div class="mt-3 text-center mx-auto showMaps maps w-75">
                                <?= $dataMaps ? $dataMaps->alamat : '' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>