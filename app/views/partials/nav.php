<nav>
	<div class="text-center mt-2">
			<ul style="list-style: none;">
				<li>
					<a class="btn btn-outline-primary" href="index.php/users">Kirpėjoms</a>
				</li>
			<?php if(isset($_SESSION['user_id'])) { ?>
			<form action="logout" method="post">
				<button type="submit" class="btn btn-link">Atsijungti</button>
			</form>
			<?php } ?>
			</ul>
	</div>
</nav>