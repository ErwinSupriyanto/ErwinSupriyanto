<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<!-- BS JavaScript -->
	<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</head>
<body>

<div id="container">
	<h1>Daftar Anggota</h1>

	<div id="body">
		<div class="table-responsive">
			<table id="table_anggota" class="table table-striped">
				<thead>
					<tr>
						<th>Nama</th>
						<th>Tanggal Lahir</th>
						<th>Alamat</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="list_anggota">
				</tbody>
			</table>
		</div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<form>
	<div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Nama Anggota</label>
					<div class="col-md-10">
					  <input type="text" name="nama_anggota" id="nama_anggota" class="form-control" placeholder="Nama Anggota">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Tanggal Lahir</label>
					<div class="col-md-10">
					  <input type="date" name="tgl_lhr" id="tgl_lhr" class="form-control" placeholder="Tanggal Lahir">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Alamat</label>
					<div class="col-md-10">
					  <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat">
					</div>
				</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
		  </div>
		</div>
	  </div>
	</div>
</form>

<form>
	<div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Nama Anggota</label>
					<div class="col-md-10">
					  <input type="hidden" name="idx_anggota_edit" id="idx_anggota_edit" class="form-control" readonly>
					  <input type="text" name="nama_anggota_edit" id="nama_anggota_edit" class="form-control" placeholder="Nama Anggota">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Tanggal Lahir</label>
					<div class="col-md-10">
					  <input type="date" name="tgl_lhr_edit" id="tgl_lhr_edit" class="form-control" placeholder="Tanggal Lahir">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Alamat</label>
					<div class="col-md-10">
					  <input type="text" name="alamat_edit" id="alamat_edit" class="form-control" placeholder="Alamat">
					</div>
				</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
		  </div>
		</div>
	  </div>
	</div>
</form>

<form>
	<div class="modal fade" id="Modal_Show_History" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">History Anggota</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div class="table-responsive">
				<table id="table_history_personal" class="table table-striped">
					<thead>
						<tr>
							<th>Tanggal Setor</th>
							<th>Tanggal Pinjam</th>
							<th>Jumlah Setor</th>
							<th>Jumlah Pinjam</th>
						</tr>
					</thead>
					<tbody id="list_history_personal">
					</tbody>
					<tr><td rowspan="4" id="personaltotal"></td></tr>
				</table>
			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
</form>

<form>
	<div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Delete Anggota</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			   <strong>Are you sure to delete this record?</strong>
		  </div>
		  <div class="modal-footer">
			<input type="hidden" name="anggota_idx_delete" id="anggota_idx_delete" class="form-control">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			<button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
		  </div>
		</div>
	  </div>
	</div>
</form>

</body>
</html>
<script>
$(document).ready(function(){
	showList();
	
	function showList(){
		$.ajax({
			type  : 'ajax',
			url   : 'http://localhost/ci-rest/index.php/anggota',
			async : true,
			dataType : 'json',
			success : function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					html += '<tr>'+
							'<td>'+data[i].nama_anggota+'</td>'+
							'<td>'+data[i].tgl_lahir_anggota+'</td>'+
							'<td>'+data[i].alamat_anggota+'</td>'+
							'<td style="text-align:right;">'+
								'<a href="javascript:void(0);" id="item_edit" class="btn btn-info btn-sm item_edit" data-anggota_idx="'+data[i].idx+'" data-name="'+data[i].nama_anggota+'" data-tgl="'+data[i].tgl_lahir_anggota+'" data-alamat="'+data[i].alamat_anggota+'">Edit</a>'+' '+
								'<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-anggota_idx="'+data[i].idx+'">Delete</a>'+' '+
							'<a href="javascript:void(0);" class="btn btn-warning btn-sm item_history" data-anggota_idx="'+data[i].idx+'">History</a></td>'+
							'</tr>';
				}
				$('#list_anggota').html(html);
			}
		});	
	}
	
	$('#list_anggota').on('click','.item_edit',function(){
		var anggota_idx = $(this).data('anggota_idx');
		var name 		= $(this).data('name');
		var alamat      = $(this).data('alamat');
		var tgl  	    = $(this).data('tgl');
		 
		$('#Modal_Edit').modal('show');
		$('[name="idx_anggota_edit"]').val(anggota_idx);
		$('[name="nama_anggota_edit"]').val(name);
		$('[name="tgl_lhr_edit"]').val(tgl);
		$('[name="alamat_edit"]').val(alamat);
	});
	
	 $('#btn_update').on('click',function(){
		var idx_anggota = $('#idx_anggota_edit').val();
		var namaanggota = $('#nama_anggota_edit').val();
		var tgllhr        = $('#tgl_lhr_edit').val();
		var alamat        = $('#alamat_edit').val();
		
		if(namaanggota.length < 3){
			alert('nama minimal 3 huruf');
			return false;
		}else{
			$.ajax({
				type : "PUT",
				url  : "http://localhost/ci-rest/index.php/anggota",
				dataType : "JSON",
				data : {idx:idx_anggota , nama_anggota:namaanggota, tgl_lahir_anggota:tgllhr, alamat_anggota:alamat},
				success: function(data){
					$('[name="idx_anggota_edit"]').val("");
					$('[name="nama_anggota_edit"]').val("");
					$('[name="tgl_lhr_edit"]').val("");
					$('[name="alamat_edit"]').val("");
					$('#Modal_Edit').modal('hide');
					showList();
				}
			});
			return false;			
		}
	});
		
	$('#list_anggota').on('click','.item_delete',function(){
		var product_code = $(this).data('product_code');
		 
		$('#Modal_Delete').modal('show');
		$('[name="product_code_delete"]').val(product_code);
	});
 
	//delete record to database
	 $('#btn_delete').on('click',function(){
		var product_code = $('#product_code_delete').val();
		$.ajax({
			type : "POST",
			url  : "http://localhost/ci-rest/index.php/anggota",
			dataType : "JSON",
			data : {product_code:product_code},
			success: function(data){
				$('[name="product_code_delete"]').val("");
				$('#Modal_Delete').modal('hide');
				showList();
			}
		});
		return false;
	});
	
	$('#list_anggota').on('click','.item_history',function(){
		var anggota_idx = $(this).data('anggota_idx');
		 
		$('#Modal_Show_History').modal('show');
		var totalst = "";
		var totalpi = "";
		$.ajax({
			type  : 'GET',
			url   : 'http://localhost/ci-rest/index.php/transaction',
			async : true,
			dataType : 'json',
			data : {idx_anggota:anggota_idx},
			success : function(data){
				var html = '';
				var i;
				for(i=0; i<data.length; i++){
					const tglpinjam = data[i].tgl_pinjam;
					const tglsetor = data[i].tgl_setor;
					const jmls = data[i].jml_setor
					const jmlp = data[i].jml_pinjam

					if(tglpinjam == null){
						tglp = '';
					}else{
						tglp = tglpinjam;
					}
					
					if(tglsetor == null){
						tgls = '';
					}else{
						tgls = tglsetor;
					}
					
					if(jmls == null){
						jmlst = '';
					}else{
						jmlst = jmls;
					}
					
					if(jmlp == null){
						jmlpi = '';
					}else{
						jmlpi = jmlp;
					}
					html += '<tr>'+
							'<td>'+tgls+'</td>'+
							'<td>'+tglp+'</td>'+
							'<td>'+jmlst+'</td>'+
							'<td>'+jmlpi+'</td>'+
							'</tr>';
							
					totalst += jmlst
					totalpi += jmlpi
				}
				
				$('#list_history_personal').html(html);
				$('#personaltotal').html(totalpi-totalst);
			}
		});
	});
});
</script>
