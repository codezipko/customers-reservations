<div class="col-md-9">
	<div class="card">
		<div class="card-header">
			<span class="pull-left">Pasirinkite jums patogų laiką iš esamo sąrašo.</span>
			<span class="pull-right">Data: <?php echo date("Y.m.d H:i"); ?></span>
		</div>
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
	$emptyPlaces = [];
	$a = 1;
	foreach($range as $time){

	if(time("Y.m.d H:i") >= $time) {
	?>
		<tr class="table-danger">
		<td><?php echo $a++; ?></td>
		<td><?php echo date("H:i",$time); ?></td>
		<td>Registracijos laikas baigėsi</td>
		<td><?php echo date("Y.m.d"); ?></td>
		<td>
			<button type="button" class="btn btn-sm btn-danger disable text-center" disabled>
				Negalima
			</button>
		</td>
		</tr>
<?php
	} else {
	if(in_array($time, $arg)) {
?>
	<tr class="table-danger">
		<td><?php echo $a++; ?></td>
		<td><?php echo date("H:i",$time); ?></td>
		<td>Užimta</td>
		<td><?php echo date("Y.m.d"); ?></td>
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
		<td><?php echo date("H:i",$time); ?></td>
		<td>Laisvas</td>
		<td><?php echo date("Y.m.d"); ?></td>
		<td>
				<input type="hidden" value="<?php echo date("H:i",$time); ?>" name="get_date">
				<?php 
				if(isset($_COOKIE['user_reservation'])) {
				?>
				<button type="button" class="btn btn-sm btn-success" disabled>
					Rezervuoti
				</button>
				<?php
				} else {
				?>
				<button type="button" class="btn btn-sm btn-success text-center" data-toggle="modal" data-target="#reservation-<?php echo $time; ?>">
					Rezervuoti
				</button>
				<?php
				}
				?>
		</td>
		<div class="modal fade" id="reservation-<?php echo $time; ?>" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="reservationModalLabel">
							Pasirinktas laikas: <?php echo date("H:i", $time); ?>	
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
							<input type="hidden" name="pickup_at" value="<?php echo $time; ?>">
							<input type="hidden" name="date_time" value="" disabled>
				</div>
					<div class="modal-footer">
						<span>Rezervacijos data: <?php echo date("Y.m.d"); ?></span>
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
	if(!in_array($time, $arg) && time("Y.m.d H:i") < $time) {
		$emptyPlaces[] = $time;
	}
}
?>
	</tbody>
</table>
</div>
</div>
</div>
<?php 

require("sidebar.php");

?>