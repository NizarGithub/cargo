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

<table align="center">
    <tr>
        <td align="center" style="font-weight: bold;">
            PT. MAHKOTA TERAJU INDUKJARI<br>
            Tangerang, Banten Indonesia Pergudangan Ritz Gate Blok AF 10<br>
            Gedangan, Sidoarjo
        </td>
    </tr>
</table>
<hr>
<table align="center">
    <tr>
        <td align="center" style="font-weight: bold; font-size: 16px;">Laporan Summary DO</td>
    </tr>
    <tr>
        <td align="center" style="font-weight: bold;">Periode <?php echo $judul; ?></td>
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
        $no = 0;
        foreach ($dt as $key => $value) {
            $no++;
            $id_do = $value->ID;
    ?>
    <tr>
        <td style="text-align: center;"><?php echo $no; ?></td>
        <td><?php echo $value->NOMOR_DO; ?></td>
        <td><?php echo $value->tujuan; ?></td>
        <td colspan="4">&nbsp;</td>
        <td style="text-align: center;"><?php echo $value->TGL_DO_MSK; ?></td>
        <td style="text-align: center;"><?php echo $value->TGL_PENGIRIMAN; ?></td>
    </tr>
    <?php
            $sql = "
                SELECT
                    a.*,
                    b.kode_barang,
                    b.nama_barang,
                    c.kode_satuan
                FROM do_detail a
                LEFT JOIN master_barang b ON b.id_barang = a.ID_BARANG
                LEFT JOIN master_satuan c ON c.id_satuan = b.id_satuan
                WHERE a.ID_DO = '$id_do'
            ";
            $qry = $this->db->query($sql);
            $res = $qry->result();

            foreach ($res as $key => $val) {
    ?>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?php echo $val->nama_barang; ?></td>
            <td><?php echo $val->BERAT." ".$val->kode_satuan; ?></td>
            <td style="text-align: right;"><?php echo number_format($val->HARGA,0,',','.'); ?></td>
            <td style="text-align: right;"><?php echo number_format($val->JUMLAH,0,',','.'); ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    <?php
            }
        }
    ?>
</table>

<?PHP
    $content = ob_get_clean();
    // require_once "localhost/siaga/material/fpdf/html2pdf.class.php";
    $html2pdf = new HTML2PDF('L','F4','fr');
    $html2pdf->pdf->SetTitle($title);
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename.'.pdf');
?>