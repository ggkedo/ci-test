<table class="table table-striped table-hover mt-2">
	<thead class="table-secondary">
		<tr>
			<th>ID</th>
			<th>MethodId</th> <!--TODO: query method name-->
			<th>Result</th>
			<th>MeasurementDate</th>
			<th> </th>
			<th> </th>
		</tr>
	</thead>
	<tbody>

<?php foreach($measurements as $measurement):?>
		<tr>
			<td><?= $measurement->ID ?></td>
			<td><?= $measurement->MethodId //TODO: query method name?></td> 
			<td><?= $measurement->Result ?></td>
			<td><?= \App\Models\API::GetDateAsString($measurement->MeasurementDate) ?></td>
			<td><a href="<?= base_url('measurements/' . $measurement->ID)?>" title="Edit"><i class="fa-solid fa-list h5"></i></a></td>
			<td>
				<a href="" title="Delete" class="link-danger" data-bs-toggle="modal" data-bs-target="#delModal<?= $measurement->ID ?>"><i class="fa-solid fa-trash h5"></i></a>

				<!-- The Modal -->
				<div class="modal fade" id="delModal<?= $measurement->ID ?>">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Delete: <?= $measurement->ID ?></h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
						  The following measurement will be deleted: #<?= $measurement->ID ?>. <br>Are you sure?
					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
						  <form method="post" action="<?= base_url('samples/' . $id) ?>">
							<button name="del" value="<?= $measurement->ID ?>" type="submit" class="btn btn-danger">Yes</button>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						  </form>
					  </div>

					</div>
				  </div>
				</div>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>