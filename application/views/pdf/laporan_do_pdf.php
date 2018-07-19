<?PHP  
ob_start(); 
?>

<style>
.grid th {
    background: #FFF;
    vertical-align: middle;
    color : #000;
    width: 140px;
    text-align: center;
    height: 40px;
    border: solid;
    font-size: 12px;
}
.grid td {
    background: #FFF;
    border :1px solid #000;
    vertical-align: middle;
    font: 11px/15px sans-serif;
    height: 20px;
    padding-left: 4px;
    padding-right: 4px;
    padding-top: 3px;
    padding-bottom: 3px;
    border-collapse: separate;
}
.grid {
    background: #FFF;
    border: 1px solid #000;
    width: 900px;
    table-layout: fixed;
    border-collapse: collapse;
}

.judul{
    height: 50px;
}

.kolom_header {
    height        : 40px;
    background    : #FFF ;
    font-weight   : bold; 
    text-align    : center;
    border  : 1px solid #000;
    font-size     : 12px; 
  }

.title_header {
    font-weight   : bold; 
    text-align    : left;
    font-size     : 14px;
}

.isi_table  {
    font-size     : 11px;
    border  : 1px solid #000;  
    text-align    : left;
}

.footer{
    position:absolute;
    left:0;
    bottom:0;
}

.ttd{
    border-collapse: collapse;
    border: 1px solid black;
}
.ttd td{
    background: #fff;
    height: 30px;
    font-size: 14px;
    border: 1px solid black;
}
</style>

<div style="margin-left: 0px;">
<table align="left">
    <tr>
        <td>
            <h5>PT. MAHKOTA TERAJU INDUKJARI</h5>
            Tangerang, Banten, Indonesia<br>
            Pergudangan Ritz Gate Blok AF 10<br>Gedangan, Sidoarjo
        </td>
    </tr>
</table>

<table align="center" style="margin-top:-80px; margin-left: -50px;">
    <tr>
        <td style="text-align:center;">
            <h2 style="font-family:Arial; font-weight:bold; line-height:1.4;">
                INVOICE
            </h2>
        </td>
    </tr>
</table>

<table align="right" style="margin-top:-70px; margin-left:-80px;">
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
        <td>No. DO</td>
        <td>:</td>
        <td><?php echo $data->NOMOR_DO;; ?></td>
    </tr>
    <tr>
        <td>Nama Pelanggan</td>
        <td>:</td>
        <td><?php echo $data->nama_pelanggan; ?></td>
    </tr>
</table>
<br><br>
<table class="grid">
    <tr>
        <th rowspan="2" style="width:30px;">NO</th>
        <th rowspan="2" style="width: 120px;">NOMOR DO</th>
        <th rowspan="2">TUJUAN</th>
        <th rowspan="2" style="width: 150px;">DESKRIPSI</th>
        <th rowspan="2" style="width:90px;">BERAT</th>
        <th rowspan="2" style="width:120px;">HARGA</th>
        <th rowspan="2" style="width: 120px;">JUMLAH</th>
        <th colspan="2">KETERANGAN</th>
    </tr>
    <tr>
        <th style="border-left: none;">TGL MSK DO</th>
        <th>TGL KIRIM</th>
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
        $no_do = "";
        $tujuan = "";
        $tgl_do = "";
        foreach ($res as $key => $val) {
            $no++;
            $tot_jumlah += $val->JUMLAH;
            if($key == 0){
                $no_do = $data->NOMOR_DO;
                $tujuan = $data->tujuan;
                $tgl_do = $data->TGL_DO_MSK;
                $tgl_kirim = $data->TGL_PENGIRIMAN;
            } else {
                $no_do = "";
                $tujuan = "";
                $tgl_do = "";
                $tgl_kirim = "";
            }
    ?>
        <tr>
            <td style="text-align: center;"><?php echo $no; ?></td>
            <td style="text-align: center;"><?php echo $no_do; ?></td>
            <td style="text-align: center;"><?php echo $tujuan; ?></td>
            <td style="text-align: left;"><?php echo $val->nama_barang; ?></td>
            <td style="text-align: center;"><?php echo number_format($val->BERAT,0,',','.'); ?> <?php echo $val->kode_satuan; ?></td>
            <td style="text-align: right;">Rp <?php echo number_format($val->HARGA,0,',','.'); ?></td>
            <td style="text-align: right;">Rp <?php echo number_format($val->JUMLAH,0,',','.'); ?></td>
            <td style="text-align: center;"><?=$tgl_do;?></td>
            <td style="text-align: center;"><?=$tgl_kirim;?></td>
        </tr>
    <?php
        }
    ?>

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
            <td style="text-align: right;">Rp <?php echo number_format($value->biaya,0,',','.'); ?></td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
        </tr>
    <?php
        }

        $grandtotal = $tot_jumlah + $tot_jasa;
    ?>

        <tr>
            <td style="text-align: center; font-weight: bold;" colspan="6">TOTAL</td>
            <td style="text-align: right; font-weight: bold;">Rp <?php echo number_format($grandtotal,0,',','.'); ?></td>
            <td style="text-align: center;">&nbsp;</td>
            <td style="text-align: center;">&nbsp;</td>
        </tr>
</table>
</div>
<?PHP
    $content = ob_get_clean();
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    $html2pdf = new HTML2PDF('L','F4','fr');
    $html2pdf->pdf->SetTitle($title);
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename.'.pdf');
?>