<table>
    <tr>
        <td colspan="3">
            <center><img alt="" src="../../logo-smk9-2.png"></center>
        </td>
    </tr>
    <tr>
        <td style="border-top:dashed 1px;">
            <h4><strong>
                    <center><?= date('d/m/Y') ?></h4>
            </center></strong>
        </td>
        <td style="border-top:dashed 1px;">
            <h4><strong>
                    <center><?= date('H:i:s') ?></h4>
            </center></strong>
        </td>
        <td style="border-top:dashed 1px;">
            <h4><strong>
                    <center>Bukti Pembayaran</h4>
            </center></strong>
        </td>
    <tr>
    <tr>
        <td style="border-top:dashed 1px;" colspan="3">
            <h4>
                <center><strong>SMK Negeri 9 Medan </strong></center>
            </h4>
        </td>
    </tr>

    <tr>
        <td style="border-top:dashed 1px;">
            No. Record
        </td>
        <td style="border-top:dashed 1px;width:20px;">
            :
        </td>
        <td style="border-top:dashed 1px;">
            <?= $detailPembayaran['no_record'] ?>
        </td>
    <tr>
    <tr>
        <td style="border-top:dashed 1px;">
            Nama Siswa
        </td>
        <td style="border-top:dashed 1px;width:20px;">
            :
        </td>
        <td style="border-top:dashed 1px;">
            <?= $detailPembayaran['nama_siswa'] ?>
        </td>
    <tr>
    <tr>
        <td style="border-top:dashed 1px;">
            Keterangan
        </td>
        <td style="border-top:dashed 1px;width:20px;">
            :
        </td>
        <td style="border-top:dashed 1px;">
            <?= $detailPembayaran['keterangan'] ?>
        </td>
    <tr>
    <tr>
        <td style="border-top:dashed 1px;">
            Jumlah Tagihan
        </td>
        <td style="border-top:dashed 1px;width:20px;">
            :
        </td>
        <td style="border-top:dashed 1px;">
            Rp. <?= number_format($detailPembayaran['jumlah_tagihan'],0,',','.') ?>
        </td>
    <tr>
    <tr>
        <td style="border-top:dashed 1px;">
            Jumlah Pembayaran
        </td>
        <td style="border-top:dashed 1px;width:20px;">
            :
        </td>
        <td style="border-top:dashed 1px;">
            Rp. <?= number_format($detailPembayaran['jumlah_pembayaran'],0,',','.') ?>
        </td>
    <tr>
    <tr>
        <td style="border-top:dashed 1px;">
            Tanggal Pembayaran 
        </td>
        <td style="border-top:dashed 1px;width:20px;">
            :
        </td>
        <td style="border-top:dashed 1px;">
            <?= $detailPembayaran['tanggal'] ?>
        </td>
    <tr>
    <tr>
        <td style="border-top:dashed 1px; font-size:12px;padding-top:5px" colspan="3">
            
                <center><strong>SIMPAN TANDA TERIMA INI </strong></center>
            
        </td>
    </tr>
    <tr>
        <td style="font-size:12px;padding-bottom:5px;" colspan="3">
            
                <center><strong>SEBAGAI BUKTI PEMBAYARAN YANG SAH </strong></center>
            
        </td>
    </tr>
</table>