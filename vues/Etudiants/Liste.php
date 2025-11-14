
<div class="table-responsive">
            <table class="table align-middle mb-2">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Évaluations</th>
                  <th>Moyenne</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value): ?>
                <tr>
                  <td><?= htmlspecialchars($value['NEtudiant']) ?></td>
                  <td><?= htmlspecialchars($value['Nom']) ?></td>
                  <td><?= htmlspecialchars($value['Prenom']) ?></td>
                  <td><?= htmlspecialchars($value['NombreEvaluation']) ?></td>
                  <td>
                    <span class="badge badge-pill badge-avg-good">
                      <?= number_format(($value['AditionProduit'] / $value['AditionCoef']), 2) ?>
                    </span>
                  </td>
                  <td class="text-end actions">
                    <button class="btn btn-sm btn-outline-secondary me-1">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button 
                    class="btn btn-sm btn-outline-secondary me-1 btn-modifier" data-bs-toggle="modal" 
                    data-bs-target="#modifier-modal" 
                    data-id="<?= htmlspecialchars($value['NEtudiant']) ?>"
                    data-nom="<?= htmlspecialchars($value['Nom']) ?>"
                    data-prenom="<?= htmlspecialchars($value['Prenom']) ?>">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <form method="post" action="index.php?action=SupprimerEtudiant" style="display:inline;">
                    <input type="hidden" name="NEtudiant" value="<?= $value['NEtudiant'] ?>">
                    <button 
                      type="submit" 
                      onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?')" 
                      class="btn btn-sm btn-outline-danger me-1">
                        <i class="bi bi-trash"></i>
                      </button>
                  </form>
                  </td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-2">
            <small class="text-muted">3 sur 10</small>
            <nav>
              <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><span class="page-link">Préc.</span></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active"><span class="page-link">2</span></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Suiv.</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </section>