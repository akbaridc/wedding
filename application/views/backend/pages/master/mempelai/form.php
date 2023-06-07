<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <!-- simpan state error save data -->
            <input type="hidden" name="isError" id="isError" class="form-control">
            <input type="hidden" name="isErrorSosial" id="isErrorSosial" class="form-control">
            <input type="hidden" name="mempelaiId" id="mempelaiId" class="form-control" value="<?= $dataMempelai !== "" ? $dataMempelai->id : "" ?>">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-content-center justify-content-between pt-2">
                        <h5 class="card-title"><?= $anchor ?> Data Mempelai</h5>
                        <div class="d-flex align-items-center">
                            <a href="javascript:history.back()" class="btn btn-warning btn-sm me-3">
                                <i class="bi bi-arrow-left-circle me-1"></i>Kembali
                            </a>
                            <?php if ($mode != 'view') { ?>
                                <button type="button" class="btn btn-success btn-sm btn-saveData" onclick="handlerSaveDataMempelai(event, '<?= $mode ?>')">
                                    <i class="bi bi-save me-1"> Simpan</i>
                                </button>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- form -->
                    <div class="row mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: <?= $mode == 'add' ? '' : 'none' ?>">
                            <div class="input-group has-validation mb-3 w-sm-100 w-md-50 w-lg-25 w-xl-25 w-25">
                                <div class="form-floating is-invalid">
                                    <select name="gender" id="gender" class="form-select">
                                        <option value="">--Pilih Mempelai--</option>
                                        <?php foreach ($optionGender as $key => $value) { ?>
                                            <?php if (!in_array($key, $genderInDb)) { ?>
                                                <option value="<?= $key ?>"><?= $value ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <label for="gender">Mempelai</label>
                                </div>
                                <div class="invalid-feedback invalid-feedback-gender"></div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="input-group has-validation mb-3">
                                <div class="form-floating is-invalid">
                                    <input type="text" name="namaLengkap" id="namaLengkap" class="form-control" placeholder="Nama Lengkap" <?= $disable ?> value="<?= $dataMempelai !== "" ? $dataMempelai->nama_lengkap : "" ?>">
                                    <label for="namaLengkap">Nama Lengkap</label>
                                </div>
                                <div class="invalid-feedback invalid-feedback-namaLengkap"></div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="input-group has-validation mb-3">
                                <div class="form-floating is-invalid">
                                    <input type="text" name="namaPanggilan" id="namaPanggilan" class="form-control" placeholder="Nama Panggilan" <?= $disable ?> value="<?= $dataMempelai !== "" ? $dataMempelai->nama_panggilan : "" ?>">
                                    <label for="namaPanggilan">Nama Panggilan</label>
                                </div>
                                <div class="invalid-feedback invalid-feedback-namaPanggilan"></div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="input-group has-validation mb-3">
                                <div class="form-floating is-invalid">
                                    <input type="text" name="namaOrangTua" id="namaOrangTua" class="form-control" placeholder="Nama Bapak & Nama Ibu" <?= $disable ?> value="<?= $dataMempelai !== "" ? $dataMempelai->orang_tua : "" ?>">
                                    <label for="namaOrangTua">Nama Orang Tua</label>
                                </div>
                                <div class="invalid-feedback invalid-feedback-namaOrangTua"></div>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="input-group has-validation mb-3">
                                <div class="form-floating is-invalid">
                                    <textarea name="alamat" id="alamat" class="form-control" cols="3" rows="10" style="resize: none;height: 200px;" <?= $disable ?>><?= $dataMempelai !== "" ? $dataMempelai->alamat : "" ?></textarea>
                                    <label for="alamat">Alamat</label>
                                </div>
                                <div class="invalid-feedback invalid-feedback-alamat"></div>
                            </div>

                            <div>
                                <h4 class="fw-semibold text-center">
                                    Sosial Media <br>
									<?php if($mode != 'view') { ?>
										<label class="text-dark" style="font-size: 11px;">
											Referensi Icon <a href="https://icons.getbootstrap.com/">Bootstrap Icon</a>
										</label>
									<?php }?>
                                    
                                </h4>
                                <div class="row mb-3 mt-2" style="display: <?= $mode != 'view' ? '' : 'none' ?>">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <div class="input-group has-validation">
                                            <div class="form-floating is-invalid">
                                                <input type="text" name="namaSosialMedia" id="namaSosialMedia" class="form-control" placeholder="Nama Sosial Media">
                                                <label for="alamat">Nama Sosial Media</label>
                                            </div>
                                            <div class="invalid-feedback invalid-feedback-namaSosialMedia"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="input-group has-validation">
                                            <div class="form-floating is-invalid">
                                                <input type="text" name="linkSosialMedia" id="linkSosialMedia" class="form-control" placeholder="Link Sosial Media">
                                                <label for="alamat">Link Sosial Media</label>
                                            </div>
                                            <div class="invalid-feedback invalid-feedback-linkSosialMedia"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-2 col-sm-12 col-xs-12">
                                        <div class="input-group has-validation">
                                            <div class="form-floating is-invalid">
                                                <input type="text" name="iconSosialMedia" id="iconSosialMedia" class="form-control" placeholder="Icon Sosial Media">
                                                <label for="alamat">Icon Sosial Media</label>
                                            </div>
                                            <div class="invalid-feedback invalid-feedback-iconSosialMedia"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                        <button class="btn btn-info btn-sm" onclick="handlerAddSosialMedia(event)"><i class="bi bi-plus"></i> Tambah</button>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-responsive" id="initSosialMedia">
                                        <thead>
                                            <tr class="bg-secondary text-white">
                                                <th scope="col">Sosial Media</th>
                                                <th scope="col">Link</th>
                                                <th scope="col">Icon</th>
												<?php if($mode != 'view') { ?>
													<th scope="col">Action</th>
												<?php }?>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php if($dataSosialMediaMempelai !== "") { ?>
												<?php foreach ($dataSosialMediaMempelai as $key => $value) { ?>
													<tr>
														<td><?= $value->nama?></td>
														<td><?= $value->link?></td>
														<td><i class="bi <?= $value->icon?>"></i></td>
														<?php if($mode != 'view') { ?>
															<td>
																<button type="button" class="btn btn-danger btn-sm btndelete"><i class="bi bi-trash"></i></button>
															</td>
														<?php }?>
													</tr>
												<?php }?>
											<?php }?>
										</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <?php if ($mode == 'edit') { ?>
                                <label for="fotoMempelai" class="text-danger" style="font-size: 11px;">*Kosongi jika tidak merubah foto</label>
                            <?php } ?>
                            <?php if ($mode != 'view') { ?>
                                <input type="file" name="fotoMempelai" id="fotoMempelai" class="form-control mb-2" onchange="handlerPreviewFile(event)" accept="image/*">
                            <?php } ?>
                            <div class="invalid-feedback mb-3 invalid-feedback-fotoMempelai"></div>
                            <a href="<?= $dataMempelai !== "" ? base_url('assets/backend/img/foto_mempelai/' . $dataMempelai->foto) : "" ?>" data-lightbox="Image" id="parent-profile-mempelai" style="display: <?= $mode == 'add' ? 'none' : 'block' ?>;">
                                <img src="<?= $dataMempelai !== "" ? base_url('assets/backend/img/foto_mempelai/' . $dataMempelai->foto) : "" ?>" alt="" class="img-responsive rounded mx-auto text-center profile-mempelai" id="profile-mempelai" width="300" height="300">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
