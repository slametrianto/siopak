
<style type="text/css">
	.card{

		position: relative;
		display: -ms-flexbox;
		display: flex;
		-ms-flex-direction: column;
		flex-direction: column;
		min-width: 0;
		word-wrap: break-word;
		background-color: #fff;
		background-clip: border-box;
		border: 0 solid rgba(0,0,0,.125);
		box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
		margin-bottom: 1rem;
		border-top: 3px solid rgb(231, 114, 108);
		border-radius: .25rem;
		padding: 1.25rem;

	}

</style>

<?php echo $this->session->flashdata('message') ?>
<div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            
            <div class="card">

              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-rensponsive"
                       src="<?php echo base_url('assets/img/images.png') ?>"
                       alt="User profile picture" style="width: 60%; height: 60%;">
                </div>

                <br>
                
                <p class="text-muted text-center" style="font-size: 15px;"><strong><?php echo $data->nama_lengkap ?></strong></p>

                <p class="text-muted text-center"><?php echo $data->tipe_fungsional ?></p>
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal"><b>Ganti Foto Profil</b></button>
              </div>
              <!-- /.card-body -->
            </div>
           
            <!-- /.card -->
          </div> <!-- col-md-3 -->


          <div class="col-md-9">
              <div class="card-body table-responsive">
              	<table class="table">
			<tr>
				<th colspan="3" style="border-top: 0px; font-size: 20px;">Biodata</th>
			</tr>
			<tr>
				<td>NIP</td><td>:</td><td><?php echo $data->nip ?></td>
			</tr>
			<tr>
				<td>NIK</td><td>:</td><td><?php echo $data->nik ?></td>
			</tr>
			<tr>
				<td>Nama</td><td>:</td><td><?php echo $data->nama_lengkap ?></td>
			</tr>
			<tr>
				<td>Tempat lahir</td><td>:</td><td><?php echo $data->tempat_lahir ?></td>
			</tr>
			<tr>
				<td>Tanggal lahir</td><td>:</td><td><?php echo $data->tanggal_lahir ?></td>
			</tr>
			<tr>
				<td>Alamat</td><td>:</td><td><?php echo $data->alamat ?></td>
			</tr>
			<tr>
				<td>Email</td><td>:</td><td><?php echo $data->email ?></td>
			</tr>
			<tr>
				<td>No telepon</td><td>:</td><td><?php echo $data->no_telp ?></td>
			</tr>
			<tr>
				<td>Fungsional</td><td>:</td><td><?php echo $data->tipe_fungsional ?></td>
			</tr>
			<tr>
				<td>Golongan</td><td>:</td><td><?php echo $data->golongan?></td>
			</tr>
			
		</table>


              </div>
           </div>

               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="close">&times;</button>
    			<h5 class="modal-title" id="exampleModalLabel">Ganti Foto Profil</h5>
    				
    			</div>

    			<div class="modal-body">
    			<?php echo form_open_multipart('myprofil/update') ?>

    			<?php foreach ($user as $row) {
    			
    			} ?>
                    <div class="form-group">
                        <label>Upload Foto</label>
                        <br>
                        <input type="text" value="<?php echo $user->nip ?>" name="nip" style="color: #CCCC">
                        <input type="file" name="photo">
                    </div>


    				<button type="reset" class="btn btn-danger" data-dismiss="modal">
    					Reset
    				</button>
    				<button type="submit" class="btn btn-primary">
    					Simpan
    				</button>
    				
    		  <?php echo form_close(); ?>
    			</div>

    			
    			</div>


    		</div>
    	</div>

  </div>

