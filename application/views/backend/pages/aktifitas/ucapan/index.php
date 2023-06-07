<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Data Ucapan Tamu Undangan</h5>
                    </div>
                    <!-- Table with stripped rows -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Ucapan</th>
                                    <th scope="col">Balasan Mempelai</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($dataUcapan)) { ?>
                                    <?php foreach ($dataUcapan as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $value->nama ?></td>
                                            <td>
												<div>
													<small class="fw-bold" style="font-size: 12px;">Waktu : <?= dateIndo($value->created_at) ?></small>
													<p><?= $value->pesan?></p>
												</div>
											</td>
											<td>
												<?php if($value->pesan_balasan != null) { ?>
													<div>
                                                    <small class="fw-bold" style="font-size: 12px;">Waktu : <?= dateIndo($value->tanggal_balasan) ?></small>
														<p><?= $value->pesan_balasan ?></p>
													</div>
												<?php } else { ?>
													-
												<?php }?>
											</td>
											<td>
												<?php if($value->pesan_balasan == null) { ?>
													<button class="btn btn-primary" onclick="handlerOpenModalReplyUcapan('<?= $value->id?>','<?= $value->nama ?>')"><i class="bi bi-reply"></i> Balas</button>
												<?php } else { ?>
													-
												<?php }?>
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


<!-- Modal -->
<div class="modal fade" id="modalReplyUcapan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalReplyUcapanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalReplyUcapanLabel"></h1>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nama" placeholder="Nama" disabled>
                    <label for="nama">Nama Tamu Undangan</label>
                </div>

                <div class="form-floating mb-3">
					<textarea name="reply" id="reply" cols="10" rows="10" style="height: 200px;resize:none" class="form-control" required placeholder="Reply"></textarea>
					<label for="reply">Reply Ucapan</label>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="handlerCloseModal()">Close</button>
                <button type="button" class="btn btn-primary btn-simpan" onclick="handlerSaveData(event)">Simpan</button>
            </div>
        </div>
    </div>
</div>
