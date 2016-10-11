<div id="report" class="index">
	<h1>Seen Kittens</h1>
	<a href="<?php echo site_url('Report/map'); ?>" class="btn btn-danger">Report Seen Kitten</a>
	<table class="table data-tables table-condensed table-bordered table-striped">
		<thead>
			<th>Photo</th>
			<th>Coordinates / Location</th>
			<th>Description</th>
			<th>Date / Time Last Seen</th>
		</thead>
		<tbody>
			<?php foreach($reports as $r){ ?>
			<tr>
				<a href="#">
					<td><img src="<?php echo $r->photo; ?>" /></td>
					<td>
						<?php 
							//Reverse geocoding to get addr.
							//https://developers.google.com/maps/documentation/geocoding/intro
							//https://developers.google.com/maps/documentation/javascript/examples/geocoding-reverse
							echo $r->lat . ', ' . $r->lng; 
						?>
						</td>
					<td><?php echo $r->description; ?></td>
					<td><?php echo $r->datetime_last_seen; ?></td>
				</a>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>