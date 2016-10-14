<div id="report" class="index">
	<h1>
		<img class="logo" src="<?php echo base_url('public/images/cat_icon.png'); ?>">
		Reports of seen or abandoned kittens.
	</h1>
	<div class="row">
		<div class="col-xs-12">
			<a href="<?php echo site_url('Report/map'); ?>"
				class="btn btn-primary btn-sm">File a report</a>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<hr />
			<div class="table-responsive">
				<table width="100%"
					class="table data-tables table-condensed table-bordered table-striped">
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
							<td class="text-center">
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
							<td class="text-center">
								<?php
									$c = \Carbon\Carbon::parse($r->datetime_last_seen);
									echo toFriendlyDate($c);
								?>
								</td>
							<td class="text-center"><?php echo $r->status; ?></td>
							<td class="text-center">
								<a href="<?php echo site_url('Report/update/' . $r->id); ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								<a href="<?php echo site_url('Report/delete/' . $r->id); ?>" class="btn-delete"><span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>