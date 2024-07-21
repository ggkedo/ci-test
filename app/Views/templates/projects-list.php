<table class="table table-striped table-hover">
	<thead class="table-secondary">
		<tr>
			<th>Name</th>
			<th>Company</th>
			<th>Manager</th>
			<th>Group email</th>
			<th>Send emails</th>
			<th> </th>
			<th> </th>
		</tr>
	</thead>
	<tbody>

<?php foreach($projects as $project):?>
		<tr>
			<td><?= $project->Name ?></td>
			<td><?= $project->Company ?></td>
			<td><?= $project->ManagerEmail ?></td>
			<td><?= $project->GroupEmail ?></td>
			<td><?= $project->SendEmailByDefault ?></td>
			<td><a href="<?= base_url('projects/' . $project->ID)?>" title="Edit"><i class="fa-solid fa-list h5"></i></a></td>
			<td>
				<a href="" title="Delete" class="link-danger" data-bs-toggle="modal" data-bs-target="#delModal<?= $project->ID ?>"><i class="fa-solid fa-trash h5"></i></a>

				<!-- The Modal -->
				<div class="modal fade" id="delModal<?= $project->ID ?>">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Delete: <?= $project->Name ?></h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
						  The following project will be deleted: <?= $project->Name ?>.<br>Are you sure?
					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
						  <form method="post" action="<?= base_url('projects') ?>">
							<button name="del" value="<?= $project->ID ?>" type="submit" class="btn btn-danger">Yes</button>
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