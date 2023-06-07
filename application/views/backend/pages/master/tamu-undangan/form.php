<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <!-- simpan state error save data -->
            <input type="hidden" name="isError" id="isError" class="form-control">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-content-center justify-content-between pt-2">
                        <h5 class="card-title">Tambah Data Tamu Undangan</h5>
                        <div class="d-flex align-items-center">
                            <a href="javascript:history.back()" class="btn btn-warning btn-sm me-3">
                                <i class="bi bi-arrow-left-circle me-1"></i>Kembali
                            </a>
                            <button type="button" class="btn btn-success btn-sm btn-saveData" onclick="handlerSaveData(event, 'add')">
                                <i class="bi bi-save me-1"> Simpan</i>
                            </button>
                        </div>
                    </div>

                    <!-- form -->
                    <div class="table-responsive mt-4">
                        <table class="table" width="100%" id="tableRowTamuUndangan">
                            <thead>
                                <tr>
                                    <td width="30%"><strong>Nama</strong></td>
                                    <td width="20%"><strong>Telepon</strong></td>
                                    <td width="30%"><strong>Temen Dari</strong></td>
                                    <td width="10%"><strong>Action</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" id="nama-1" name="nama-1" placeholder="Nama Tamu Undangan">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control numeric" id="telepon-1" name="telepon-1" placeholder="Telepon Tamu Undangan">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="temenDari-1" name="temenDari-1" placeholder="Temen Dari">
                                    </td>
                                    <td><button class="btn btn-primary btn-sm" type="button" onclick="handlerAddNewRow(event)"><i class="bi bi-plus"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
