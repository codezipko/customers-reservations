<?php
require('partials/head.php'); 
?>

<div class="container">
	<h1 class="text-center">Vyrų kirpykla</h1>
	<div class="row">
<?php 
require("partials/reservation-search.php");

if(!isset($_GET['search_submit'])) {
	require('partials/reservation-table.php');
}
?>
</div>

<?php require('partials/footer.php'); ?>