<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Data Rekening Hadiah</h5>
                        <a href="<?= base_url('rekening-hadiah/form?mode=add') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Tambah Rekening Hadiah</a>
                    </div>
                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Rekening</th>
                                    <th scope="col">Atas Nama</th>
                                    <th scope="col">Nomor Rekening</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($dataRekening)) { ?>
                                    <?php foreach ($dataRekening as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value->rekening ?></td>
                                            <td><?= $value->atas_nama ?></td>
                                            <td><?= $value->nomor_rekening ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('rekening-hadiah/form?id=' . $value->id . '&mode=view') ?>" class="btn btn-sm btn-primary mb-1"><i class="bi bi-eye"></i></a>
                                                <a href="<?= base_url('rekening-hadiah/form?id=' . $value->id . '&mode=edit') ?>" class="btn btn-sm btn-warning mb-1"><i class="bi bi-pencil"></i></a>
                                                <button class="btn btn-sm btn-danger mb-1" onclick="handlerDeleteRekening('<?= $value->id ?>')"><i class="bi bi-trash"></i></button>
                                            </td>
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