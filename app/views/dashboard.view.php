<?php 
require('partials/head.php');
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<div class="container" style="width: 800px;">
	<div class="row">
		<div class="col-md-12">
			<div class="mb-2">
				<form method="get" class="pull-left">
					<div class="form-group row mb-2" style="margin: 0;">
						<div class="mr-2">
							<input type="text" name="search_name" class="form-control" id="search_name" placeholder="Kliento vardas...">
						</div>
						<div>
							<button type="submit" id="saerch_customer" value="search" class="btn btn-info">Ieškoti kliento</button>
						</div>
					</div>
				</form>
				<a href="dashboard/addReservation" class="btn btn-sm btn-warning pull-right mt-1">Užregistruoti klientą</a>
			</div>
			<div class="clearfix"></div>
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							Rušiuoti pagal: 
							<a href="dashboard" class="btn btn-sm btn-outline-dark">Šiandien</a>
							<a href="?search=tommorow" class="btn btn-sm btn-outline-dark ml-1">Rytoj</a>
						</div>
						<div class="col-md-6">
							<form method="get">
								<div class="form-group row" style="margin: 0;">
									<div class="col-md-2">
										<label for="datepicker" class="col-form-label" data-provide="datepicker">Data:</label>
									</div>
									<div class="col-md-7">
										<input type="text" name="search_date" class="form-control" id="datepicker" readonly="readonly">
									</div>
									<div class="col-md-3">
										<button type="submit" name="search_submit" value="search" class="btn btn-info">Ieškoti</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 mt-2">
			<div class="card">
				<div class="card-header">
				<span class="pull-left">Rezervuotų narių valdymas</span>
				<span class="pull-right">Kirpėja: <?= $loginUser; ?></span>
				</div>
				<div class="card-body">
					<div class="card-body">
					<?php 
					if($pagination->searchNotMatch()) {

						echo 'Nėra rezervacijų.';

					} else if (isset($_GET['search_name'])) {

						if(!$customer) {

							echo "Tokio vardo mūsų sistemoje nėra.";

						} else {
					?>
						<div>
							Klientas: <?= strtoupper($customer['firstname']); ?>
							-
							Paskutinė rezervacija: <strong><?= $customer['created_at']; ?></strong>
							- 
							<?php 
							if($customer['visited'] >= 5) {
								echo '<strong class="text-success">Reikia suteikti 10% nuolaida!</strong> - ';
							}
							?>
							Skambinti: <a href="tel:<?= $customer['phone']; ?>" class="btn btn-sm btn-link"><?= $customer['phone']; ?></a>
							<?php
								if( date("Y-m-d H:i") < $customer['created_at'] ) {
							?>
							<form action="delete" method="get">
						      	<button type="submit" name="delete" class="btn btn-sm btn-danger" value="<?= $customer['id']; ?>">Atšaukti</button>
						    </form>
							<?php } ?>
						</div>
					<?php
						}
					} else {
					?>
						<table class="table table-hover table-dark">
							<thead>
								<tr>
									<th scope="col">Kartas</th>
									<th scope="col">Vardas</th>
									<th scope="col">Laikas</th>
									<th scope="col">Telefonas</th>
									<th scope="col">Atšaukti</th>
								</tr>
							</thead>
						<tbody>
						<tbody>
						  	<?php foreach($paginate as $row) {
						  	if ($row->visited == 5) {
						  	?>
						  	<tr class="bg-success">
						  		<th scope="row"><?= $row->visited; ?></th>
						      	<td>
						      		<?= $row->firstname; ?> 10% nuolaida!
						      	</td>
						    <?php
						  	} else {
						  	?>
						    <tr>
						    	<th scope="row"><?= $row->visited; ?></th>
						      	<td>
						      		<?= $row->firstname; ?>
						      	</td>
						    <?php } ?>
						      	<td>
						      		<?= $row->created_at; ?>
						      	</td>
						      	<td>
						      		<a href="tel:<?= $row->phone; ?>" class="bnt btn-sm btn-info">Skambinti <?= $row->phone; ?></a>
						      	</td>
						      	<td>
						      		<form action="delete" method="get">
						      		<button type="submit" name="delete" class="btn btn-sm btn-danger" value="<?= $row->id; ?>">Atšaukti</button>
						      		</form>
						      	</td>
						    </tr>
						    <?php 
							}
						    ?>
						  </tbody>
						</table>
						<?php 
						}
						?>
				</div>
			</div>
		</div>
	</div>
</div>
<nav class="mt-2 text-center" aria-label="Page navigation paginator">
  <ul class="pagination">
<?php
	if( ! $pagination->hideOnSearch() ) {

		$pagination->showPaginate();

	}
?>
</ul>
</nav>

<?php 
require('partials/footer.php');
?>