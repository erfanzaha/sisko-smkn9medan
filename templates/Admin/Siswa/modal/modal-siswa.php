<div class="modal fade" id="modalNewData">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Siswa</h5>
                <button type="button" class="close" onclick="tutup();">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <?= $this->element('Admin/form'); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetail">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle2">Detail Siswa</h5>
                <button type="button" class="close" onclick="tutup();">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <form method="post" id="form-detail-data">
    <div class="modal-body">
        <input type="hidden" id="id2" name="id">
        <input type="hidden" id="id_auth2" name="id_auth">
        <input type="hidden" id="id_siswa_kelas2" name="id_siswa_kelas">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="nisn">NISN</label>
                    <input type="text" class="form-control" id="nisn2" name="nisn" readonly>
                </div>
                <div class="form-group ">
                    <label for="nipd">NIPD</label>
                    <input type="text" class="form-control" id="nipd2" name="nipd" readonly>
                </div>
                <div class="form-group ">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa2" name="nama_siswa" readonly>
                </div>
                <div class="form-group ">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email2" name="email" readonly>
                </div>
                <div class="form-group ">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username2" name="username" readonly>
                </div>
                <div class="form-group ">
                    <label for="gender">Gender</label>
                    <input type="text" name="gender" id="gender2" class="form-control" readonly>
                </div>
                <div class="form-group ">
                    <label for="kewarganegaraan">Kewarganegaraan</label>
                    <input type="text" class="form-control" id="kewarganegaraan2" name="kewarganegaraan" readonly>
                </div>
                <div class="form-group ">
                    <label for="anak_ke">Anak Ke</label>
                    <input type="text" class="form-control" id="anak_ke2" name="anak_ke" readonly>
                </div>
                <div class="form-group ">
                    <label for="anak_yatim_piatu">Anak Yatim/Piatu</label>
                    <input type="text" class="form-control" id="anak_yatim_piatu2" name="anak_yatim_piatu" readonly>
                </div>
                <div class="form-group ">
                    <label for="bahasa_dirumah">Bahasa Dirumah</label>
                    <input type="text" class="form-control" id="bahasa_dirumah2" name="bahasa_dirumah" readonly>
                </div>
                <div class="form-group">
                    <label for="tinggal_dengan">Tinggal Dengan</label>
                    <input type="text" class="form-control" id="tinggal_dengan2" name="tinggal_dengan" readonly>
                </div>
                <div class="form-group">
                    <label for="jrk_tgl_ke_sklh">Jarak tempat tinggal ke sekolah</label>
                    <input type="text" class="form-control" id="jrk_tgl_ke_sklh2" name="jrk_tgl_ke_sklh" readonly>
                </div>
                <div class="form-group">
                    <label for="gol_darah">Golongan Darah</label>
                    <input type="text" class="form-control" id="gol_darah2" name="gol_darah" readonly>
                </div>
                <div class="form-group">
                    <label for="penyakit">Penyakit yang pernah diderita</label>
                    <input type="text" class="form-control" id="penyakit2" name="penyakit" readonly>
                </div>
                <div class="form-group">
                    <label for="kelainan_jasmani">Kelainan Jasmani</label>
                    <input type="text" class="form-control" id="kelainan_jasmani2" name="kelainan_jasmani" readonly>
                </div>
                <div class="form-group">
                    <label for="tinggi_badan">Tinggi Badan</label>
                    <input type="text" class="form-control" id="tinggi_badan2" name="tinggi_badan" readonly>
                </div>
                <div class="form-group">
                    <label for="berat_badan">Berat Badan</label>
                    <input type="text" class="form-control" id="berat_badan2" name="berat_badan" readonly>
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan2" name="jurusan" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat2" name="alamat" readonly>
                </div>
                <div class="form-group ">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir2" name="tempat_lahir" readonly>
                </div>
                <div class="form-group ">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir2" name="tanggal_lahir" readonly>
                </div>
                <div class="form-group ">
                    <label for="agama">Agama</label>
                    <input type="text" name="agama" id="agama2" class="form-control" readonly>
                </div>
                <div class="form-group ">
                    <label for="jlh_saudara_kandung">Jumlah Saudara Kandung</label>
                    <input type="number" class="form-control" id="jlh_saudara_kandung2" name="jlh_saudara_kandung" readonly>
                </div>
                <div class="form-group ">
                    <label for="jlh_saudara_tiri">Jumlah Saudara Tiri</label>
                    <input type="number" class="form-control" id="jlh_saudara_tiri2" name="jlh_saudara_tiri" readonly>
                </div>
                <div class="form-group ">
                    <label for="jlh_saudara_angkat">Jumlah Saudara Angkat</label>
                    <input type="number" class="form-control" id="jlh_saudara_angkat2" name="jlh_saudara_angkat" readonly>
                </div>
                <div class="form-group ">
                    <label for="no_hp">No HP</label>
                    <input type="text" class="form-control" id="no_hp2" name="no_hp2" readonly>
                </div>
                <div class="form-group ">
                    <label for="asal_sekolah">Asal Sekolah</label>
                    <input type="text" class="form-control" id="asal_sekolah2" name="asal_sekolah" readonly>
                </div>
                <div class="form-group ">
                    <label for="tgl_no_sttb">Tanggal, No. STTB</label>
                    <input type="text" class="form-control" id="tgl_no_sttb2" name="tgl_no_sttb" readonly>
                </div>
                <div class="form-group ">
                    <label for="lama_bljr">Lama Belajar</label>
                    <input type="text" class="form-control" id="lama_bljr2" name="lama_bljr" readonly>
                </div>
                <div class="form-group ">
                    <label for="diterima_dikelas">Diterima Dikelas</label>
                    <input type="text" class="form-control" id="diterima_dikelas2" name="diterima_dikelas" readonly>
                </div>
                <div class="form-group ">
                    <label for="diterima_tgl">Diterima Tanggal</label>
                    <input type="date" class="form-control" id="diterima_tgl2" name="diterima_tgl" readonly>
                </div>
                <div class="form-group ">
                    <label for="kesenian">Kesenian</label>
                    <input type="text" class="form-control" id="kesenian2" name="kesenian" readonly>
                </div>
                <div class="form-group ">
                    <label for="olahraga">Olahraga</label>
                    <input type="text" class="form-control" id="olahraga2" name="olahraga" readonly>
                </div>
                <div class="form-group ">
                    <label for="organisasi">Organisasi</label>
                    <input type="text" class="form-control" id="organisasi2" name="organisasi" readonly>
                </div>
                <div class="form-group ">
                    <label for="lain_lain">Lain-lain</label>
                    <input type="text" class="form-control" id="lain_lain2" name="lain_lain" readonly>
                </div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="id_tahun_ajaran">Tahun Ajaran</label>
                            <select name="id_tahun_ajaran" id="id_tahun_ajaran2" class="form-control" readonly>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" id="id_kelas2" class="form-control" readonly>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</form>

        </div>
    </div>
</div>