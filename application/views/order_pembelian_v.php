<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/js-form.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){

	$("#no_opb").focus();

	$('#hapus').click(function(){
		$('#popup_hapus').css('display','block');
		$('#popup_hapus').show();
	});

	$('#close_hapus').click(function(){
		$('#popup_hapus').css('display','none');
		$('#popup_hapus').hide();
	});

	$('#batal_hapus').click(function(){
		$('#popup_hapus').css('display','none');
		$('#popup_hapus').hide();
	});

	$('#batal_ubah').click(function(){
		$('#popup_ubah').css('display','none');
		$('#popup_ubah').hide();
	});

	$("#tambah_order").click(function(){
		$("#tambah_order").fadeOut('slow');
		$("#table_order").fadeOut('slow');
		$(".cui").fadeOut('slow');
		$("#form_order_pembelian").fadeIn('slow');
		$("#tabel_total").fadeIn('slow');
	});

	$("#batal").click(function(){
		$("#tambah_order").fadeIn('slow');
		$("#table_order").fadeIn('slow');
		$("#form_order_pembelian").fadeOut('slow');
		$("#tabel_total").fadeOut('slow');

	});
});

function hapus_order(id)
{
	$('#popup_hapus').css('display','block');
	$('#popup_hapus').show();

		$.ajax({
		url : '<?php echo base_url(); ?>order_pembelian_c/data_order_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_hapus').val(id);
			$('#msg').html('Apakah <b>'+row['no_opb']+'</b> ini ingin dihapus ?');
		}
	});
}

function ubah_data_order(id)
{
	$("#tambah_order").fadeOut('slow');
	$("#table_order").fadeOut('slow');
	$("#form_order_pembelian").fadeIn('slow');
	$("#tabel_total").fadeIn('slow');

	$.ajax({
		url : '<?php echo base_url(); ?>order_pembelian_c/data_order_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(row){
			$('#id_order').val(id);
			$('#no_opb').val(row['no_opb']);
			$('#tanggal').val(row['tanggal']);
			$('#uraian').val(row['uraian']);

			detail_ubah_produk(id);
		}
	});
}

function detail_ubah_produk(id)
{
    $.ajax({
		url : '<?php echo base_url(); ?>order_pembelian_c/data_order_detail_id',
		data : {id:id},
		type : "POST",
		dataType : "json",
		async : false,
		success : function(result){
			var isi = '';
			var no = 0;
			$('#jml_tr').val(result.length)
			$.each(result,function(i,res){
				no++;

				isi += 
				'<tr id="tr_'+no+'">'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="span12">'+
							'<div class="control-group">'+
								'<div classs="controls">'+
									'<div class="input-append" style="width: 100%;">'+
										'<input readonly value="'+res.nama_produk+'" type="text" id="nama_produk_'+no+'" class="form-control"  name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 13px; float: left;">'+
										'<button onclick="show_pop_produk('+no+');" type="button" class="btn" style="width: 30%;">Cari</button>'+
										'<input type="hidden" id="id_produk_'+no+'" value="'+res.id_produk+'" name="produk[]" readonly style="background:#FFF;" value="0">'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</td>'+
					
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input onkeyup="hitung_total('+no+');" style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.kuantitas+'" name="kuantitas[]" id="kuantitas_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.satuan+'" name="satuan[]" id="satuan_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.harga+'" name="harga[]" id="harga_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.total+'" name="total[]" id="total_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.no_spb+'" name="no_spb[]" id="no_spb_'+no+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<button style="width: 100%;" onclick="hapus('+no+');" type="button" class="btn btn-danger"> Hapus </button>'+
						'</div>'+
					'</td>'+
				'</tr>';
				
			
			});
			$('#data_item').html(isi);
			$('#jml_tr').val(result.length);
		}
	});

}

function show_pop_spb(no){
	$('#popup_koang').remove();
	get_popup_spb();
    ajax_spb(no);
}

function get_popup_spb(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang_pro" id="search_koang_pro" class="form-control" value="" placeholder="Cari ...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th> Tanggal </th>'+
                '                        <th style="white-space:nowrap;"> No. SPB </th>'+
                '                        <th style="white-space:nowrap;"> Uraian </th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_spb(id_form){
    var keyword = $('#search_koang_pro').val();
    $.ajax({
        url : '<?php echo base_url(); ?>order_pembelian_c/get_spb_popup',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;

                isine += '<tr onclick="get_spb_detail(\'' +res.id_permintaan+ '\',\'' +id_form+ '\');" style="cursor:pointer;">'+
                            '<td text-align="center">'+res.tanggal+'</td>'+
                            '<td text-align="left">'+res.no_spb+'</td>'+
                            '<td text-align="left">'+res.uraian+'</td>'+
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='3' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang_pro').off('keyup').keyup(function(){
                ajax_spb(id_form);
            });
        }
    });
}

function get_spb_detail(id)
{
    $.ajax({
		url : '<?php echo base_url(); ?>order_pembelian_c/get_spb_detail',
		data : {id:id},
		type : "POST",
		dataType : "json",
		success : function(result){
			var isi_1 = "";
			var i = 0;
			$.each(result,function(ii,res){
				i++;
			 isi_1 +=
				'<tr id="tr_'+i+'">'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="span12">'+
							'<div class="control-group">'+
								'<div classs="controls">'+
									'<div class="input-append" style="width: 100%;">'+
										'<input readonly value="'+res.nama_produk+'" type="text" id="nama_produk_'+i+'" class="form-control"  name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 13px; float: left;">'+
										'<button onclick="show_pop_produk('+i+');" type="button" class="btn" style="width: 30%;">Cari</button>'+
										'<input type="hidden" id="id_produk_'+i+'" value="'+res.id_produk+'" name="produk[]" readonly style="background:#FFF;" value="0">'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.keterangan+'" name="keterangan[]" id="keterangan_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input onkeyup="hitung_total('+i+');" style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.kuantitas+'" name="kuantitas[]" id="kuantitas_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.satuan+'" name="satuan[]" id="satuan_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.harga+'" name="harga[]" id="harga'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.jumlah+'" name="total[]" id="total'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="'+res.no_spb+'" name="no_spb[]" id="no_spb_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<button style="width: 100%;" onclick="hapus('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
						'</div>'+
					'</td>'+
				'</tr>';

			});

			$('#data_item').html(isi_1);
			$('#jml_tr').val(i);
			
			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide()
		}
	});
	hitung_total_semua();
}

function show_pop_produk(no){
	$('#popup_koang').remove();
	get_popup_produk();
    ajax_produk(no);
}

function get_popup_produk(){
    var base_url = '<?php echo base_url(); ?>';
    var $isi = '<div id="popup_koang">'+
                '<div class="window_koang">'+
                '    <a href="javascript:void(0);"><img src="'+base_url+'ico/cancel.gif" id="pojok_koang"></a>'+
                '    <div class="panel-body">'+
                '    <input style="width: 95%;" type="text" name="search_koang_pro" id="search_koang_pro" class="form-control" value="" placeholder="Cari Produk...">'+
                '    <div class="table-responsive">'+
                '            <table class="table table-hover2" id="tes5">'+
                '                <thead>'+
                '                    <tr>'+
                '                        <th>No</th>'+
                '                        <th style="white-space:nowrap;"> Nama Produk </th>'+
                '                        <th style="white-space:nowrap;"> Harga </th>'+
                '                    </tr>'+
                '                </thead>'+
                '                <tbody>'+
            
                '                </tbody>'+
                '            </table>'+
                '        </div>'+
                '    </div>'+
                '</div>'+
            '</div>';
    $('body').append($isi);

    $('#pojok_koang').click(function(){
        $('#popup_koang').css('display','none');
        $('#popup_koang').hide();
    });

    $('#popup_koang').css('display','block');
    $('#popup_koang').show();
}

function ajax_produk(id_form){
    var keyword = $('#search_koang_pro').val();
    $.ajax({
        url : '<?php echo base_url(); ?>order_pembelian_c/get_produk_popup',
        type : "POST",
        dataType : "json",
        data : {
            keyword : keyword,
        },
        success : function(result){
            var isine = '';
            var no = 0;
            var tipe_data = "";
            $.each(result,function(i,res){
                no++;

                isine += '<tr onclick="get_produk_detail(\'' +res.id+ '\',\'' +id_form+ '\');" style="cursor:pointer;">'+
                            '<td text-align="center">'+no+'</td>'+
                            '<td text-align="left">'+res.nama_produk+'</td>'+
                            '<td text-align="left">'+res.harga+'</td>'+
                            
                        '</tr>';
            });

            if(result.length == 0){
            	isine = "<tr><td colspan='3' style='text-align:center'><b style='font-size: 15px;'> Data tidak tersedia </b></td></tr>";
            }

            $('#tes5 tbody').html(isine); 
            $('#search_koang_pro').off('keyup').keyup(function(){
                ajax_produk(id_form);
            });
        }
    });
}

function get_produk_detail(id, no_form){
	var id_produk = id;
    $.ajax({
		url : '<?php echo base_url(); ?>order_pembelian_c/get_produk_detail',
		data : {id_induk:id},
		type : "GET",
		dataType : "json",
		success : function(result){
			$('#kuantitas_'+no_form).val('');
			$('#id_produk_'+no_form).val(result.id_induk);
			$('#nama_produk_'+no_form).val(result.nama_produk);
			$('#keterangan_'+no_form).val(result.keterangan);
			$('#kuantitas_'+no_form).focus();
			$('#satuan_'+no_form).val(result.satuan);
			$('#harga_'+no_form).val(NumberToMoney(result.harga).split('.00').join(''));
			$('#total_'+no_form).val(NumberToMoney(result.harga*1).split('.00').join(''));
			$('#no_spb_'+no_form).val(result.no_spb);

			$('#search_koang_pro').val("");
		    $('#popup_koang').css('display','none');
		    $('#popup_koang').hide()
		}
	});
}

function tambah_data(){
	var jml_tr = $('#jml_tr').val();
	var i = parseFloat(jml_tr) + 1;

	var isi = 	'<tr id="tr_'+i+'">'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="span12">'+
							'<div class="control-group">'+
								'<div class="controls">'+
									'<div class="input-append" style="width: 100%;">'+
										'<input readonly type="text" id="nama_produk_'+i+'" class="form-control"  name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 13px; float: left;">'+
										'<button onclick="show_pop_produk('+i+');" type="button" class="btn" style="width: 30%;">Cari</button>'+
										'<input type="hidden" id="id_produk_'+i+'" name="produk[]" readonly style="background:#FFF;" value="0">'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</td>'+
					
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input onkeyup="hitung_total('+i+');" style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="kuantitas[]" id="kuantitas_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="satuan[]" id="satuan_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="harga[]" id="harga'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="total[]" id="total'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:left;" type="text" class="form-control" value="" name="no_spb[]" id="no_spb_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<button style="width: 100%;" onclick="hapus('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
						'</div>'+
					'</td>'+
				'</tr>';

	$('#data_item').append(isi);
	$('#jml_tr').val(i);

}

function add_row(id_peminjaman_detail,kode_barang,nama_produk,satuan,no_spb,limitis){
	var jml_tr = $('#jml_tr').val();
	var i = parseFloat(jml_tr) + 1;

	var isi = 	'<tr id="tr_'+i+'">'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="span12">'+
							'<div class="control-group">'+
								'<div class="controls">'+
									'<div class="input-append" style="width: 100%;">'+
										'<input readonly type="text" id="nama_produk_'+i+'" class="form-control"  name="nama_produk[]" required style="background:#FFF; width: 60%; font-size: 13px; float: left;" value="'+nama_produk+'">'+
										'<input type="hidden" id="id_produk_'+i+'" value="'+kode_barang+'" name="produk[]" readonly style="background:#FFF;" value="0">'+
										'<input type="hidden" id="id_produk_'+i+'" value="'+id_peminjaman_detail+'" name="id_peminjaman_detail[]" readonly style="background:#FFF;" value="0">'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</td>'+
					
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input onkeyup="limit_kuantitas('+i+');" style="font-size: 10px; text-align:center;" type="text" class="form-control" value="" name="kuantitas[]" id="kuantitas_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:center;" type="text" class="form-control" value="'+satuan+'" name="satuan[]" id="satuan_'+i+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<input style="font-size: 10px; text-align:right;" type="text" class="form-control" value="'+no_spb+'" name="reff_no[]" id="ref_no_'+i+'">'+
							'<input type="hidden" class="form-control" id="limit_'+i+'" value="'+limitis+'">'+
						'</div>'+
					'</td>'+
					'<td align="center" style="vertical-align:middle;">'+
						'<div class="controls">'+
							'<button style="width: 100%;" onclick="hapus('+i+');" type="button" class="btn btn-danger"> Hapus </button>'+
						'</div>'+
					'</td>'+
				'</tr>';

	$('#data_item').append(isi);
	$('#jml_tr').val(i);

}

function limit_kuantitas(id) {
	var kuantitas = $('#kuantitas_'+id).val();
	var limitasi = $('#limit_'+id).val();


	if(kuantitas > limitasi){
		alert('Kuantitas anda melebihi dari jumlah pinjaman');
		$('#kuantitas_'+id).val(limitasi);
	}
}

function hapus(i){
	$('#tr_'+i).remove();
}

function hitung_total(id){

	var kuantitas = $('#kuantitas_'+id).val();
	kuantitas = kuantitas.split(',').join('');

	if(kuantitas == ""){
		kuantitas = 0;
	}

	var harga = $('#harga_'+id).val();
	harga = harga.split(',').join('');

	if(harga == "" || harga== null){
		harga = 0;
	}

	var total = parseFloat(kuantitas) * parseFloat(harga);

	var pajak = 0;

	total = total + pajak;

	$('#total_'+id).val(acc_format(total, "").split('.00').join('') );

	hitung_total_semua();
}

function hitung_total_semua(){
	var sum = 0;
	var pajak_prosen = 0
	$("input[name='total[]']").each(function(idx, elm) {
		var tot = elm.value.split(',').join('');
		if(tot > 0){
    		sum += parseFloat(tot);
		}
    });

    $('#subtotal_txt').html('Rp. '+acc_format(sum, ""));
}

function acc_format(n, currency) {
	return currency + " " + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}

function simpan_add_produk(){
	var nama_produk = $('#nama_produk').val();
	var keterangan 	= $('#keterangan').val();
	var kuantitas   = $('#kuantitas').val();
	var satuan      = $('#satuan').val();
	var no_spb      = $('#no_spb').val();

	if(nama_produk == ""){
		alert("Nama Produk Harus di isi.");
	} else if(keterangan == ""){
		alert("Nama Produk Harus di isi.");
	} else if(kuantitas == ""){
		alert("Satuan Produk Harus di isi.");
	} else if(satuan == ""){
		alert("Harga Produk Harus di isi.");
	}else if(no_spb == ""){
		alert("no_spb Produk Harus di isi.");
	} else {
		$.ajax({
			url : '<?php echo base_url(); ?>order_pembelian_c/simpan',
			data : {
				nama_produk:nama_produk,
				keterangan:keterangan,
				kuantitas:kuantitas,
				satuan:satuan,
				no_spb:no_spb,
			},
			type : "POST",
			dataType : "json",
		});
	}

}

function hapus_row_pertama()
{
	$('#nama_produk_1').val('');
	$('#id_produk_1').val('');
	$('#kuantitas_1').val('');
	$('#satuan_1').val('');
	$('#no_spb_1').val('');

	hitung_total_semua();
}

function berhasil(){
	toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "5000",
      "hideDuration": "5000",
      "timeOut": "5000",
      "extendedTimeOut": "5000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success("Data Berhasil Disimpan!", "Berhasil");
}

function loading(){
	$('#popup_load').css('display','block');
	$('#popup_load').show();
}

function hapus_toas(){
	toastr.options = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "showDuration": "5000",
      "hideDuration": "5000",
      "timeOut": "5000",
      "extendedTimeOut": "5000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr.success("Data Berhasil Dihapus!", "Terhapus");
}

function get_transaction(tahun) {
	var id = $('#dept_ser').val();
        
        $.ajax({
            url : '<?php echo base_url(); ?>order_pembelian_c/get_transaction_info',
            data : {id:id,tahun:tahun},
            type : "POST",
            dataType : "json",
            success : function(result){   
                var isine = "";
                if(result.length > 0){
                    $.each(result,function(i,res){

                        isine += '<tr>'+
                                    '<td style="text-align:center;">'+res.kode_barang+'</td>'+
                                    '<td style="text-align:center;">'+res.nama_barang+'</td>'+
                                    '<td style="text-align:center;">'+res.sisa_jumlah+'</td>'+
                                    '<td style="text-align:center;">'+res.satuan+'</td>'+
                                    '<td style="text-align:center;">'+res.no_spb+'</td>'+
                                    '<td>'+
                                    	'<button style="width: 100%;" onclick="add_row(&quot;'+res.id_peminjaman_detail+'&quot;,&quot;'+res.id_barang+'&quot;,&quot;'+res.nama_barang+'&quot;,&quot;'+res.satuan+'&quot;,&quot;'+res.no_spb+'&quot;,&quot;'+res.sisa_jumlah+'&quot;);" type="button" class="btn btn-success"> Tambah </button>'+
                                    '</td>'+
                                '</tr>';
                    });
                } else {
                    isine = "<tr><td colspan='6' style='text-align:center;'> There are no transaction for this data </td></tr>";
                }

                $('#data_transaction').html(isine);
            }
        });
    }

    function hapus(i){
	$('#tr_'+i).remove();
}

</script>

<style type="text/css">
	#data_item tr td input{
		font-size: 15px !important;
	}
</style>

<form role="form" action="<?php echo $url_simpan; ?>" method="post">
<input type="hidden" id="jml_tr" value="1">
<input type="hidden" id="id_order" name="id_order">

<div class="row" id="form_order_pembelian" style="display:none; ">
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-bar-chart font-green-sharp hide"></i>
					<span class="caption-subject font-green-sharp bold uppercase">Form Order Pembelian Barang</span>
				</div>
				<div class="actions">
					<div class="btn-group btn-group-devided" data-toggle="buttons">
					</div>
				</div>
			</div>

			<div class="portlet-body">	
				<div class="row" style="padding-top: 15px; padding-bottom: 15px;">
					<div class="col-md-12">
						<div class="col-md-3">
							<label class="control-label"><b style="font-size:14px;">Departemen</b></label>
							<div class="input-group" style="width: 100%; ">
								<select name="dept" class="form-control" id="dept_ser">
									<option>Pilih Departemen ......</option>
									<?php 
										foreach ($dt_dept as $key => $dt_value) {
											?>
											<option value="<?=$dt_value->id_divisi;?>"><?=$dt_value->nama_divisi;?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<label class="control-label"><b style="font-size:14px;">Tahun</b></label>
							<div class="input-group" style="width: 100%; ">
								<select name="tahuni" class="form-control" id="tahuni" onchange="get_transaction(this.value);">
									<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									<option value="2018">2018</option>
								</select>
							</div>
						</div>


						<div class="col-md-3">
							<label class="control-label"><b style="font-size:14px;">Tanggal</b></label>
							<div class="input-group" style="width: 100%;">
								<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?=date('d-m-Y');?>" readonly required>
								<span class="input-group-btn"><button class="btn default" type="button"><i class="fa fa-calendar"></i></button></span>
							</div>
						</div>

						<div class="col-md-3">
							<label class="control-label"><b style="font-size:14px;">Uraian</b></label>
							<div class="input-group" style="width: 100%; ">
								<input type="text" rows="1" id="uraian" name="uraian" class="form-control" required></textarea>
							</div>
						</div>
						<div class="col-md-3" style="margin-top: 15px;">
								<label class="control-label"><strong style="font-size:14px;">Tanggal Kedatangan</strong></label>
								<div class="input-group" style="width: 100%; ">
									<input type="text" rows="1" id="uraian" name="uraian" class="form-control" required></textarea>
								</div>
							</div>
					</div>	

					<!-- <div class="row" style="padding-top: 15px; padding-bottom: 15px;">
						<div class="col-md-12">
							<div class="col-md-3">
								<label class="control-label"><strong style="font-size:14px;">Tanggal Kedatangan</strong></label>
								<div class="input-group" style="width: 100%; ">
									<input type="text" rows="1" id="uraian" name="uraian" class="form-control" required></textarea>
								</div>
							</div>
						</div>
					</div> -->
				</div>

				<div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-left:18px; margin-right:18px;overflow-y: 300px;">
					<div class="portlet-body flip-scroll">
						<table class="table table-bordered table-striped table-condensed flip-content" >
							<thead class="flip-content">
								<tr>
									<th style="text-align: center;  width: 10%;">Kode Barang</th>
									<th style="text-align: center;  width: 30%;">Nama Barang</th>
									<th style="text-align: center; ">Kuantitas</th>
									<th style="text-align: center; ">Satuan</th>
									<th style="text-align: center; width: 30%; ">No Reff</th>
									<th style="text-align: center; ">Aksi</th>
								</tr>
							</thead>
							<tbody id="data_transaction">
								<tr>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
									<td align="center" style="vertical-align:middle;">
										
									</td>
								</tr>
							</tbody>
						</table>

						
					</div>
				</div>

				<div class="row" style="padding-top: 15px; padding-bottom: 15px; margin-left:18px; margin-right:18px;" id="tabel_produk">
					<div class="portlet-body flip-scroll">
						<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
								<tr>
									<th style="text-align: center;  width: 20%;">Produk / Item</th>
									<th style="text-align: center; ">Kuantitas</th>
									<th style="text-align: center; ">Satuan</th>
									<th style="text-align: center; ">Reff No</th>
									<th style="text-align: center; ">Aksi</th>
								</tr>
							</thead>
							<tbody id="data_item">
								<tr id="tr_1">
									
								</tr>
							</tbody>
						</table>

						<!-- <button style="margin-bottom: 15px; background: #26a69a;" onclick="tambah_data();" type="button" class="btn btn-info"><i class="icon-plus"></i> Tambah Baris Data </button>
						<button style="margin-bottom: 15px; background: #f47a42;" onclick="show_pop_spb(1);" type="button" class="btn btn-info"><i class="icon-plus"></i> Include SPB </button> -->

					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>

<div class="row" id="tabel_total" style="display:none; ">
	<div class="col-md-12 col-sm-6">
		<!-- BEGIN PORTLET-->
		<div class="portlet light ">
			<div class="portlet-body">
				<div class="row" style="padding-top: 15px;">
					<div class="col-md-12">
						
					</div>
				</div>

				<div class="row" style="padding-top: 35px; padding-bottom: 15px;">
					<div class="col-md-12">
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn blue">Simpan</button>
							<button type="button" id="batal" class="btn red" onclick="window.location = '<?php echo base_url(); ?>order_pembelian_c'">Batal Dan Kembali</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
</div>
</form>

<div class="row">
	
	<div class="col-md-3 cui" >
		<select class="form-control">
			<option value="01">Januari</option>
			<option value="02">Februari</option>
			<option value="03">Maret</option>
			<option value="04">April</option>
			<option value="05">Mei</option>
			<option value="06">Juni</option>
			<option value="07">Juli</option>
			<option value="08">Agustus</option>
			<option value="09">September</option>
			<option value="10">Oktober</option>
			<option value="11">November</option>
			<option value="12">Desember</option>
		</select>
	</div>
	<div class="col-md-3 cui" >
		<select class="form-control">
			<option value="2016">2016</option>
			<option value="2017">2017</option>
			<option value="2018">2018</option>
		</select>
	</div>
	<div class="col-md-4 cui" >
		<a href=""><button id="tambah_permintaan_barang" class="btn green">
			Cari <i class="fa fa-search"></i>
			</button>
		</a>
	</div>

	<div class="col-md-2">
		<button id="tambah_order" class="btn green" style="float: right;">
		Tambah Data Order Pembelian <i class="fa fa-plus"></i>
		</button>
	</div>
</div>


</br>
</br>

<div class="row" id="table_order" style="display:block; ">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-edit"></i>Table Order Pembelian
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>		
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
				<thead>
				<tr>
					<th style="text-align:center;"> No</th>
					<th style="text-align:center;"> No OPB</th>
					<th style="text-align:center;"> Uraian</th>
					<th style="text-align:center;"> Aksi </th>
				</tr>
				</thead>
				<tbody>
					<?php 
					$no = 0 ;
					foreach ($lihat_data as $value) {
						$no++;
					if($value->status == '1'){
				?>
				<tr style="background-color: #cccbce;">
				<?php	
				}else{
				?>
				<tr>
					<?php  } ?>
					<td style="text-align:center; vertical-align:"><?php echo $no; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->no_opb; ?></td>
					<td style="text-align:center; vertical-align:"><?php echo $value->uraian; ?></td>
					<td style="text-align:center; vertical-align: middle;">
						<!-- <a class="btn default btn-xs purple" id="ubah" href="<?=base_url();?>order_pembelian_c/ubah_data/<?=$value->id_order;?>"><i class="fa fa-edit"></i> Ubah </a> -->
						<a class="btn default btn-xs red" id="hapus" onclick="hapus_order(<?php echo $value->id_order?>);"><i class="fa fa-trash-o"></i> Batal </a>
						<a target="_blank" class="btn default btn-xs green" id="hapus" href="<?=base_url();?>order_pembelian_c/cetak/<?=$value->id_order;?>" ><i class="fa fa-print"></i> Cetak </a>
					</td>
				</tr>
					<?php 
						}
					?>
				</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>

<div id="popup_hapus">
	<div class="window_hapus">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<button class="bootbox-close-button close" type="button" id="close_hapus">×</button>
					<div class="bootbox-body" id="msg"></div>
				</div>
				<div class="modal-footer">
					<form action="<?php echo $url_hapus; ?>" method="post">
						<input type="hidden" name="id_hapus" id="id_hapus" value="">
						<input type="button" class="btn btn-default" data-bb-handler="cancel" value="Batal" id="batal_hapus">
						<input type="submit" class="btn btn-primary" data-bb-handler="confirm" value="Hapus" id="hapus" onclick="loading();">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	<?php
		if($this->session->flashdata('sukses')){
	?>
		berhasil();
	<?php 
		}elseif($this->session->flashdata('hapus')){
	?>
		hapus_toas();
	<?php
		}
	?>
});
</script>

