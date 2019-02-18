<?php 
require('partials/head.php');
?>
<?php
   error_reporting(E_ALL);
   ini_set("display_errors", 1);

if(!isset($_SESSION['user_id'])) {
?>
<div class="container" style="width: 500px;">
	<div class="row">
	<div class="col-md-12 mg-auto">
		<h1 class="text-center">Prisijungimas</h1>
		<div class="card">
			<div class="card-body">
			<form action="users" method="post">
				<div class="form-group">
					<label for="username">Kirpėjos vardas</label>
					<input type="text" name="username" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="name">Slaptažodis</label>
					<input type="password" name="password" class="form-control" required>
				</div>
				<button type="submit" name="login" class="btn btn-primary">Prisijungti</button>
			</form>
			</div>
		</div>
	</div>
</div>
</div>
<div class="container" style="width: 600px;">
<div class="row">
	<div class="col-md-6">
		<h5 class="text-center mt-2">Demo kirpėjos</h5>

		<div class="card mt-2">
		<?php 
		}

		foreach($users as $user) {
		?>
			<div class="card-header">
				<span class="d-inline">Prisijungimo vardas: <?php echo $user->name; ?></span>
				<span class="d-inline">Slaptažodis: <?php echo base64_decode($user->password); ?></span>
			</div>
		<?php
		}
		?>
		</div>
	</div>
<div class="col-md-6">
<form action="/php/index.php/users-create" method="post">
	<div class="form-group">
		<label for="username">Kirpėjos vardas</label>
		<input type="text" class="form-control" name="name" required>
	</div>
	<div class="form-group">
		<label for="username">Kirpėjos slaptažodis</label>
		<input type="password" class="form-control" name="password" required>
	</div>
	<button type="submit" name="login" class="btn btn-sm btn-warning">Registruoti</button>
</form>
</div>
</div>
</div>

<?php require('partials/footer.php'); ?>