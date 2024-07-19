<table class="table table-striped table-hover">
	<thead class="table-secondary">
		<tr>
			<th>ID</th>
			<th>Sample name</th>
			<th>Location</th>
			<th>Created</th>
			<th><a href="<?= base_url('samples/new/')?>" title="Add"><i class="fa-solid fa-plus h5"></i></a></td> </th>
			<th> </th>
		</tr>
	</thead>
	<tbody>

<?php foreach($samples as $sample):?>
		<tr>
			<td><?= $sample->ID ?></td>
			<td><?= $sample->SampleName ?></td>
			<td><?= $sample->SampleLocation ?></td>
			<td><?= $sample->Created ?></td>
			<td><a href="<?= base_url('samples/edit/' . $sample->ID)?>" title="Edit"><i class="fa-solid fa-list h5"></i></a></td>
			<td>
				<a href="" title="Delete" class="link-danger" data-bs-toggle="modal" data-bs-target="#delModal<?= $sample->ID ?>"><i class="fa-solid fa-trash h5"></i></a>

				<!-- The Modal -->
				<div class="modal fade" id="delModal<?= $sample->ID ?>">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Delete: <?= $sample->ProjectId ?></h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
						  The following sample will be deleted: <?= $sample->ID ?>. <br>This will also delete any assigned measurements.<br><br>Are you sure?
					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
						  <form method="post" action="<?= base_url('request') ?>">
							<button name="del" value="<?= $sample->ID ?>" type="submit" class="btn btn-danger">Yes</button>
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