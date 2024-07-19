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
			<td><a href="<?= base_url('request/edit/' . $request->ID)?>" title="Szerkesztés"><i class="fa-solid fa-list h5"></i></a></td>
			<td>
				<a href="" title="Eltávolítás" class="link-danger" data-bs-toggle="modal" data-bs-target="#delModal<?= $request->ID ?>"><i class="fa-solid fa-trash h5"></i></a>

				<!-- The Modal -->
				<div class="modal fade" id="delModal<?= $request->ID ?>">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Törlés: <?= $request->ProjectId ?></h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
						  A következő eltávolításra fog kerülni: <?= $request->ID ?>. <br>Jóváhagyást követően a projekthez tartozó összes adat véglegesen törlésre kerül (a hozzátartozó feladatok is).<br><br>Biztosan törli?
					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
						  <form method="post" action="<?= base_url('request') ?>">
							<button name="del" value="<?= $request->ID ?>" type="submit" class="btn btn-danger">Igen, törlöm</button>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
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