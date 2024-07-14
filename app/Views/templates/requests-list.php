<table class="table table-striped table-hover">
	<thead class="table-secondary">
		<tr>
			<th>Megnevezés</th>
			<th>Kapcsolattartó</th>
			<th>Határidő</th>
			<th>Hátralévő napok</th>
			<th>Állapot</th>
			<th> </th>
			<th> </th>
		</tr>
	</thead>
	<tbody>

<?php foreach($requests as $request):?>
		<tr>
			<td><?= $request->RequestedByEmail ?></td>
			<td><?= $request->ProjectId ?></td>
			<td><?= $request->Modified ?></td>
			<td><a href="<?= base_url('request/edit/' . $request->id)?>" title="Szerkesztés"><i class="fa-solid fa-pen h5"></i></a></td>
			<td>
				<a href="" title="Eltávolítás" class="link-danger" data-bs-toggle="modal" data-bs-target="#delModal<?= $request->id ?>"><i class="fa-solid fa-trash h5"></i></a>

				<!-- The Modal -->
				<div class="modal fade" id="delModal<?= $project->id ?>">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Törlés: <?= $request->name ?></h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
						  A következő eltávolításra fog kerülni: <?= $request->id ?>. <br>Jóváhagyást követően a projekthez tartozó összes adat véglegesen törlésre kerül (a hozzátartozó feladatok is).<br><br>Biztosan törli?
					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
						  <form method="post" action="<?= base_url('request') ?>">
							<button name="del" value="<?= $project->id ?>" type="submit" class="btn btn-danger">Igen, törlöm</button>
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