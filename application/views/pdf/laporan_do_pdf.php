<?PHP  ob_start(); ?>

<style>
.grid th {
    background: #1793d1;
    vertical-align: middle;
    color : #FFF;
    width: 140px;
    text-align: center;
    height: 40px;
}
.grid td {
    background: #FFFFF0;
    vertical-align: middle;
    font: 11px/15px sans-serif;
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 3px;
    padding-bottom: 3px;
}
.grid {
    background: #FAEBD7;
    border: 2px solid #C5C5C5;
    width: 900px;
    border-spacing: 0;
    table-layout: fixed;
}

.judul{
    height: 50px;
}

.kolom_header {
    height        : 40px;
    background    : #dadada ;
    font-weight   : bold; 
    text-align    : center;
    border-style  : solid;
    border-width  : thin;
    font-size     : 12px; 
  }

.title_header {
    font-weight   : bold; 
    text-align    : left;
    font-size     : 14px;
}

.isi_table  {
    font-size     : 11px;
    border-style  : solid;
    border-width  : thin;   
    text-align    : left;
}
</style>

<table align="left">
    <tr>
        <td>
            <img src="<?=base_url();?>files/cargo/logo-pdamtp.png" width="110" height="90" alt="KOP PDAM">
        </td>
    </tr>
</table>

<table align="right" style="margin-top:-100px;">
    <tr>
        <td>Nomor Invoice</td>
        <td>:</td>
        <td><?php echo $data->NOMOR_INVOICE; ?></td>
    </tr>
    <tr>
        <td>Tanggal Invoice</td>
        <td>:</td>
        <td><?php echo $data->TANGGAL_INVOICE; ?></td>
    </tr>
    <tr>
        <td>Nama Pelanggan</td>
        <td>:</td>
        <td><?php echo $data->nama_pelanggan; ?></td>
    </tr>
    <tr>
        <td>Telepon</td>
        <td>:</td>
        <td><?php echo $data->telp;; ?></td>
    </tr>
</table>

<table align="center">
    <tr>
        <td style="text-align:center;">
            <h3 style="font-family:Arial; font-weight:normal; line-height:1.4;">
                LAPORAN DELIVERY ORDER
            </h3>
        </td>
    </tr>
</table>

<table class="grid">
    <tr>
        <th rowspan="2" style="width:30px;">NO</th>
        <th rowspan="2">NOMOR DO</th>
        <th rowspan="2">TUJUAN</th>
        <th rowspan="2">JENIS BARANG</th>
        <th rowspan="2" style="width:90px;">BERAT</th>
        <th rowspan="2" style="width:100px;">HARGA</th>
        <th rowspan="2">JUMLAH</th>
        <th colspan="2">KETERANGAN</th>
    </tr>
    <tr>
        <th>TGL MASUK DO</th>
        <th>TGL PENGIRIMAN</th>
    </tr>

    <tr>
        <td style="text-align: center;">&nbsp;</td>
        <td style="text-align: center;"><?php echo $data->NOMOR_DO; ?></td>
        <td style="text-align: center;"><?php echo $data->tujuan; ?></td>
        <td style="text-align: center;" colspan="4">&nbsp;</td>
        <td style="text-align: center;"><?php echo $data->TGL_DO_MSK; ?></td>
        <td style="text-align: center;"><?php echo $data->TGL_PENGIRIMAN; ?></td>
    </tr>
    <?php
        $id_do = $data->ID;
        $sql = "SELECT
                    a.ID,
                    a.ID_DO,
                    a.ID_BARANG,
                    b.nama_barang,
                    a.BERAT,
                    c.kode_satuan,
                    a.HARGA,
                    a.JUMLAH
                FROM do_detail a
                LEFT JOIN master_barang b ON b.id_barang = a.ID_BARANG
                LEFT JOIN master_satuan c ON c.id_satuan = b.id_satuan
                WHERE a.ID_DO = '$id_do'";
        $qry = $this->db->query($sql);
        $res = $qry->result();
        $no = 0;
        $tot_jumlah = 0;

        foreach ($res as $key => $val) {
            $no++;
            $tot_jumlah += $val->JUMLAH;
    ?>
        <tr>
            <td style="text-align: center;"><?php echo $no; ?></td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;"><?php echo $val->nama_barang; ?></td>
            <td style="text-align: center;"><?php echo number_format($val->BERAT,0,',','.'); ?> <?php echo $val->kode_satuan; ?></td>
            <td style="text-align: right;"><?php echo number_format($val->HARGA,0,',','.'); ?></td>
            <td style="text-align: right;"><?php echo number_format($val->JUMLAH,0,',','.'); ?></td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
        </tr>
    <?php
        }
    ?>
    
    <tr><td colspan="9">&nbsp;</td></tr>

    <?php
        $sj = "
            SELECT
                a.*,
                b.nama_jasa,
                b.biaya
            FROM do_jasa a
            LEFT JOIN master_jasa b ON b.id_jasa = a.ID_JASA
            WHERE a.ID_DO = '$id_do'
        ";
        $qryj = $this->db->query($sj);
        $resj = $qryj->result();
        $no2 = 0;
        $tot_jasa = 0;

        foreach ($resj as $key => $value) {
            $no2++;
            $tot_jasa += $value->biaya;
    ?>
        <tr>
            <td style="text-align: center;"><?php echo $no2; ?></td>
            <td style="text-align: center;"><?php echo $value->nama_jasa; ?></td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: right;"><?php echo number_format($value->biaya,0,',','.'); ?></td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
        </tr>
    <?php
        }

        $grandtotal = $tot_jumlah + $tot_jasa;
    ?>

        <tr>
            <td style="text-align: center; font-weight: bold;" colspan="6">TOTAL</td>
            <td style="text-align: right; font-weight: bold;"><?php echo number_format($grandtotal,0,',','.'); ?></td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
        </tr>
</table>

<?PHP
    $content = ob_get_clean();
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    $html2pdf = new HTML2PDF('L','F4','fr');
    $html2pdf->pdf->SetTitle($title);
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename.'.pdf');
?>