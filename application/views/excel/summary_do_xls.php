<?PHP 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename.xls");
?>

<style>
.grid th {
    vertical-align: middle;
    color : #000;
    width: 100px;
    text-align: center;
    height: 40px;
}
.grid td {
    vertical-align: middle;
    font: 11px/15px sans-serif;
    height: 30px;
    padding-left: 5px;
    padding-right: 5px;
    border: 1px solid black;
}
.grid {
    border: 1px solid #000;
    width: 800px;
    border-spacing: 0;
}

.judul{
    height: 50px;
}

.kolom_header {
    height        : 40px;
    font-weight   : bold; 
    text-align    : center;
    border-style  : 1px solid black;
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
}
</style>

<table align="center">
    <tr>
        <td align="center" style="font-weight: bold;" colspan="9">
            PT. MAHKOTA TERAJU INDUKJARI<br>
            Tangerang, Banten Indonesia Pergudangan Ritz Gate Blok AF 10<br>
            Gedangan, Sidoarjo
        </td>
    </tr>
</table>
<hr>
<table align="center">
    <tr>
        <td colspan="9" align="center" style="font-weight: bold; font-size: 16px;">Laporan Summary DO</td>
    </tr>
    <tr>
        <td colspan="9" align="center" style="font-weight: bold;">Periode <?php echo $judul; ?></td>
    </tr>
</table>

<br><br>

<table align="center" class="grid">
    <thead>
        <tr>
            <th class="kolom_header" rowspan="2" style="width:30px;">NO</th>
            <th class="kolom_header" rowspan="2" style="width: 120px;">NOMOR DO</th>
            <th class="kolom_header" rowspan="2">TUJUAN</th>
            <th class="kolom_header" rowspan="2" style="width: 150px;">DESKRIPSI</th>
            <th class="kolom_header" rowspan="2" style="width:90px;">BERAT</th>
            <th class="kolom_header" rowspan="2" style="width:120px;">HARGA</th>
            <th class="kolom_header" rowspan="2" style="width: 120px;">JUMLAH</th>
            <th class="kolom_header" colspan="2">KETERANGAN</th>
        </tr>
        <tr>
            <th class="kolom_header" style="border-left: none;">TGL MSK DO</th>
            <th class="kolom_header">TGL KIRIM</th>
        </tr>
    </thead>  
    <tbody>
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
    </tbody> 
</table>

<?PHP
exit();
?>