<?php 
require('partials/head.php');
?>

<?
   error_reporting(E_ALL);
   ini_set("display_errors", 1);
?>

<div class="container" style="width: 600px;">
	<div class="row">
		<div class="col-md-12">
			<a href="/php/index.php/dashboard" class="btn btn-sm btn-warning mb-2">Grįžti Atgal</a>
			<div class="card">
				<div class="card-body">
					<h5 class="text-center">Sukurti rezervaciją</h5>			
					<form action="" method="POST">
						<div id="error_msg" class="text-center mb-2 text-danger"></div>
						<div class="form-group">
							<label for="firstname">Kliento Vardas</label>
							<input type="text" class="form-control" name="username" id="username" placeholder="Kliento vardas..." required>
								<span class="pt-2 text-info"></span>
						</div>
						<div class="form-group">
							<label for="firstname">Telefono numeris</label>
							<input type="tel" class="form-control" name="phone" id="phone" placeholder="Kliento telefono numeris...">
						</div>
						<div class="form-group">
							<label for="firstname">Data</label>
							<input type="text" name="pick_date" class="form-control" id="pick_date" readonly="readonly" required>
						</div>
						<div class="form-group">
							<label for="choose_time">Laikas</label>
							<select class="form-control" name="choose_time" id="choose_time" required>
								<option>Pasirinkite laiką</option>
								<?php 
								foreach($range as $row) {
								?>
									<option value="<?= date("H:i", $row); ?>"><?= date("H:i", $row); ?></option>
								<?php
								}
								?>
							</select>
							<span></span>
						</div>
						<button type="button" class="btn btn-warning" name="create_reservation" id="create_reservation">Sukurti</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
require('partials/footer-dashboard.php');
?>