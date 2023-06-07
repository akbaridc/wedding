<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Data Kehadiran Tamu Undangan</h5>
                    </div>
                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($dataKehadiran)) { ?>
                                    <?php foreach ($dataKehadiran as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value->nama ?></td>
                                            <td><span class="badge bg-<?= $value->is_hadir == 'Hadir' ? 'success' : ($value->is_hadir == 'Tidak Hadir' ? 'danger' : 'warning') ?>"><?= $value->is_hadir ?></span></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>
