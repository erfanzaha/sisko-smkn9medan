<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="orang-tuaa-tab" data-toggle="tab" href="#orang-tua" role="tab"
                            aria-controls="orang-tua" aria-selected="true">Orang Tua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="data-siswa-tab" data-toggle="tab" href="#data-siswa" role="tab"
                            aria-controls="data-siswa" aria-selected="false">Data Siswa</a>
                    </li>
                </ul>
                <div class="tab-content m-t-15" id="myTabContent">
                    <div class="tab-pane fade" id="orang-tua" role="tabpanel" aria-labelledby="orang-tua-tab">
                        <table class="table">
                            <tr>
                                <td width="200">Nama Ayah</td>
                                <td>:</td>
                                <td><?= $orangTua->nama_ayah ?></td>
                            </tr>
                            <tr>
                                <td>Email Ayah</td>
                                <td width="20">:</td>
                                <td><?= $orangTua->email_ayah ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir Ayah</td>
                                <td>:</td>
                                <td><?= $orangTua->tanggal_lahir_ayah ?></td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td><?= $orangTua->agama_ayah ?></td>
                            </tr>
                            <tr>
                                <td>Pekerjaan Ayah</td>
                                <td>:</td>
                                <td><?= $orangTua->pekerjaan_ayah ?></td>
                            </tr>
                            <tr>
                                <td>No Hp Ayah</td>
                                <td>:</td>
                                <td><?= $orangTua->no_hp_ayah ?></td>
                            </tr>
                            <tr>
                                <td>Nama Ibu</td>
                                <td>:</td>
                                <td><?= $orangTua->nama_ibu ?></td>
                            </tr>
                            <tr>
                                <td>Email Ibu</td>
                                <td>:</td>
                                <td><?= $orangTua->email_ibu ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir Ibu</td>
                                <td>:</td>
                                <td><?= $orangTua->tanggal_lahir_ibu ?></td>
                            </tr>
                            <tr>
                                <td>Agama Ibu</td>
                                <td>:</td>
                                <td><?= $orangTua->agama_ibu ?></td>
                            </tr>
                            <tr>
                                <td>Pekerjaan Ibu</td>
                                <td>:</td>
                                <td><?= $orangTua->pekerjaan_ibu ?></td>
                            </tr>
                            <tr>
                                <td>No Hp Ibu</td>
                                <td>:</td>
                                <td><?= $orangTua->no_hp_ibu ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $orangTua->alamat ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane fade show active" id="data-siswa" role="tabpanel"
                        aria-labelledby="data-siswa-tab">
                        <table class="table">
                            <tr>
                                <td width="200">NISN</td>
                                <td width="20">:</td>
                                <td><?= $siswa->nisn ?></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><?= $siswa->nama_siswa ?></td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td><?= $kelas->kelas ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?= $siswa->email ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><?= $siswa->gender ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td><?= $siswa->tanggal_lahir ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Saudara</td>
                                <td>:</td>
                                <td><?= $siswa->jumlah_saudara ?></td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td><?= $siswa->agama ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $siswa->alamat ?></td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td>:</td>
                                <td><?= $siswa->no_hp ?></td>
                            </tr>
                        </table>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>