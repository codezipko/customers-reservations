<div class="col-md-3">
<?php 
if(isset($_COOKIE['user_reservation'])) {
?>
<div class="card mb-2">
	<div class="card-body">
		Jūs turite aktyvia rezervaciją.

		<?= $_COOKIE['user_reservation']; ?>
		<span class="d-block">
			Laikas: <strong><?= $readyToCook['created_at']; ?></strong>
		</span>
		<div class="text-center">
			<form action="cancel-reservation" method="get">
				<button type="submit" name="cancel-reservation" class="btn btn-sm btn-danger" value="<?= $readyToCook['id']; ?>">Atšaukti rezervacija</button>
			</form>
		</div>
	</div>
</div>
<?php 
}
?>
			<div class="card">
				<div class="card-body">
					<?php
					$dayPlus = date("Y-m-d", strtotime(date("Y-m-d"). " + 1 days"));
					if(isset($_GET['search_submit'])) {

					} else {
						if(count($emptyPlaces) == 0) {
							echo '<span class="text-danger">Dėja bet šiandien vietų jau nebeturime.</span>';
						} else {
							echo 'Nori apsikirpti? Šiandien dar gali užsiregistruoti! <strong>Turime laisvų vietų '.count($emptyPlaces).'</strong>';
						}
					}
						?>
				<span class="text-center mt-1 d-block">Kita dieną</span>
					<form action="?search=" method="GET">
						<div class="form-group" data-provide="datepicker">
							<input type="text" name="search_date" class="form-control" placeholder="Pasirinkti dieną" id="datepicker" readonly="readonly" required>
						</div>
						<button type="submit" name="search_submit" value="search" class="bnt btn-sm btn-primary">Ieškoti</button>
					</form>
				<div class="text-center">
					<a href="reservations" class="btn btn-sm btn-outline-info mt-1">Šiandien</a>
					<a href="?search_date=<?php echo $dayPlus; ?>&search_submit=search" class="btn btn-sm btn-outline-warning mt-1">Rytoj</a>
				</div>
				</div>
			</div>
		</div>
	</div>