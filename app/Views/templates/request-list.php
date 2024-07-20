<table class="table table-striped table-hover">
	<thead class="table-secondary">
		<tr>
			<th>Status</th>
			<th>Requestor</th>
			<th>Added on</th>
			<th>Project</th>
			<th> </th>
			<th> </th>
		</tr>
	</thead>
	<tbody>

<?php foreach($requests as $request):?>
		<tr>
			<td><?= $request->Status ?></td>
			<td><?= $request->RequestorEmail ?></td>
			<td><?= $request->Modified ?></td>
			<td><?= $request->ProjectId ?></td>
			<td><a href="<?= base_url('requests/' . $request->ID)?>" title="Edit"><i class="fa-solid fa-list h5"></i></a></td>
			<td>
				<a href="" title="Delete" class="link-danger" data-bs-toggle="modal" data-bs-target="#delModal<?= $request->ID ?>"><i class="fa-solid fa-trash h5"></i></a>

				<!-- The Modal -->
				<div class="modal fade" id="delModal<?= $request->ID ?>">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Delete: <?= $request->ID ?></h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
						  The following request will be deleted <?= $request->ID ?>. <br>This will also delete all samples and measurements associated with this request.<br><br>Are you sure?
					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
						  <form method="post" action="<?= base_url('requests') ?>">
							<button name="del" value="<?= $request->ID ?>" type="submit" class="btn btn-danger">Yes</button>
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