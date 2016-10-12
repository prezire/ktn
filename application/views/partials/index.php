<div id="report" class="index">
	<h1>Reported / Seen Kittens</h1>
	<a href="<?php echo site_url('Report/map'); ?>" class="btn btn-warning btn-xs">Report Seen Kitten</a>
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table width="100%" class="table data-tables table-condensed table-bordered table-striped">
					<thead>
						<th>Photo</th>
						<th>Address</th>
						<th>Description</th>
						<th>Date / Time Last Seen</th>
						<th>Status</th>
						<th>Option</th>
					</thead>
					<tbody>
						<?php foreach($reports as $r){ ?>
						<tr>
							<td>
								<?php
									$photo = $r->photo;
									if(empty($photo))
									{
										echo 'No photo';
									}
									else
									{
										$photo = base_url($photo);
										echo "<img src=\"{$photo}\" class=\"photo\" />";
									}
								?>
							</td>
							<td><?php echo $r->address; ?></td>
							<td><?php echo $r->description; ?></td>
							<td><?php echo $r->datetime_last_seen; ?></td>
							<td><?php echo $r->status; ?></td>
							<td>
								<a href="<?php echo site_url('Report/update/' . $r->id); ?>">Edit</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>