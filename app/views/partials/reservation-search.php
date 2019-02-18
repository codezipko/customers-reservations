<?php

if(isset($_GET['search_submit'])) {

	$showDate = str_replace("/", "-", $_GET['search_date']);

	$dateRange = range( strtotime("10:00"),strtotime("20:00"),15*60 );

	if($showDate) {
	?>
	<div class="col-md-9">
	<div class="card">
				<div class="card-header">
					<?php echo $showDate; ?>
				</div>
	<?php
		$limit = date("Y-m-d", strtotime(date("Y-m-d"). " + 14 days"));

		if($showDate > $limit || $showDate < date("Y-m-d")) {
		?>
			<div class="alert alert-warning" role="alert">
			  Registracija į kirpyklą vyksta tik 2 savaičių laikotarpiu.
			</div>
		<?php 
		} else {
		?>
		<div class="card-body">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Laikas</th>
					<th scope="col">Statusas</th>
					<th scope="col">Data</th>
					<th scope="col">Rezervacija</th>
				</tr>
			</thead>
		<tbody>		
<?php 
		$result = [];

		$showDates = str_replace("/", "-", $_GET['search_date']);

		$a = 1;

		foreach($dateRange as $rang) {


		$result = $showDates . ' '. date("H:i", $rang);

		if(in_array($result, $laterDate)) {
		?>
		<tr class="table-danger">
		<td><?php echo $a++; ?></td>
		<td><?php echo date("H:i", $rang); ?></td>
		<td>Užimta</td>
		<td><?php echo $showDate; ?></td>
		<td>
			<button type="button" class="btn btn-sm btn-danger disable text-center">
				Negalima
			</button>
		</td>
		</tr>
		<?php 
		} else {
		?>
		<tr class="table-success">
			<td><?php echo $a++; ?></td>
			<td><?php echo date("H:i",$rang); ?></td>
			<td>Laisvas</td>
			<td><?php echo $showDate; ?></td>
			<td>
				<?php 
				if(isset($_COOKIE['user_reservation'])) {
				?>
				<button type="button" class="btn btn-sm btn-success" disabled>
					Rezervuoti
				</button>
				<?php
				} else {
				?>
				<button type="button" class="btn btn-sm btn-success text-center" data-toggle="modal" data-target="#search-reserv-<?php echo $rang; ?>">
					Rezervuoti
				</button>
				<?php 
				}
				?>
			</td>
			<div class="modal fade" id="search-reserv-<?php echo $rang; ?>" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="reservationModalLabel">
							Pasirinktas laikas: <?php echo date("H:i", $rang); ?>	
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php if(isset($_COOKIE['user_reservation'])) {
					echo '<div class="modal-body">Jūs jau esate užsiregistraves. Norint pakeisti laiką, turite atšaukti savo rezervaciją.</div>';
				} else {
				?>
				<form action="reservations" method="POST">
				<div class="modal-body">
							<div class="input-group flex-nowrap mt-1">
							  	<div class="input-group-prepend">
							    	<span class="input-group-text" id="addon-wrapping">Vardas</span>
							  	</div>
							  	<input type="text" name="firstname" class="form-control" placeholder="Įrašykite savo vardą..." aria-label="Firstname" aria-describedby="addon-wrapping" required>
							</div>
							<div class="input-group flex-nowrap mt-1">
							  	<div class="input-group-prepend">
							    	<span class="input-group-text" id="addon-wrapping">Pavardė ( nebūtina )</span>
							  	</div>
							  	<input type="text" name="lastname" class="form-control" placeholder="Įrašykite savo pavardę..." aria-label="Lastname" aria-describedby="addon-wrapping">
							</div>
							<div class="input-group flex-nowrap mt-1">
							  	<div class="input-group-prepend">
							    	<span class="input-group-text" id="addon-wrapping">Telefono numeris</span>
							  	</div>
							  	<input type="tel" name="phone" class="form-control" placeholder="Įrašykite savo telefono numerį..." aria-label="Phone" aria-describedby="addon-wrapping">
							</div>
							<input type="hidden" name="pickup_at" value="<?php echo $rang; ?>">
							<input type="hidden" name="date_time" value="<?php echo strtotime($showDate); ?>">
				</div>
					<div class="modal-footer">
						<span>Rezervacijos data: <?php echo $showDate . ' ' . date("H:i", $rang); ?></span>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Atšaukti</button>
						<button type="submit" class="btn btn-primary">Registruotis</button>
					</div>
					</form>
					<?php 
					}
					?>
				</div>
			</div>
		</div>
		</tr>
		<?php
			}
	}
		?>
		</tbody>
		</table>
		</div>
		<?php
		}
	?>
	</div>
</div>
<?php
	}
	require("sidebar.php");
}
?>