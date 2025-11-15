<div class="table-responsive">
            <table class="table align-middle mb-2">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Libellé</th>
                  <th>Coeff</th>
                  <th>Moyenne</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value): ?>
                <tr>
                  <td><?= htmlspecialchars($value['CodeMat']) ?></td>
                  <td><?= htmlspecialchars($value['LibelleMat']) ?></td>
                  <td>
                    <span class="badge badge-pill badge-coeff">
                      <?= htmlspecialchars($value['CoeffMat']) ?>
                    </span>
                  </td>
                  <td>
                    <span class="badge badge-pill badge-avg-medium">
                    <?= number_format(htmlspecialchars($value['Moyenne']), 2) ?>
                  </span>
                </td>
                  <td class="text-end actions">
                    <button class="btn btn-sm btn-outline-secondary me-1">
                      <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary me-1 btn-modifier" 
                      data-bs-toggle="modal"
                      data-bs-target="#modifier-modal" 
                      data-codemat="<?= htmlspecialchars($value['CodeMat']) ?>"
                      data-libelle="<?=htmlspecialchars($value['LibelleMat']) ?>"
                      data-coeff="<?= htmlspecialchars($value['CoeffMat']) ?>"
                      data-moyenne="<?= number_format(htmlspecialchars($value['Moyenne']), 2) ?>">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <form method="post" action="index.php?action=SupprimerMatiere" style="display:inline;">
                      <input type="hidden" name="CodeMat" value="<?= $value['CodeMat'] ?>">
                      <button 
                      type="submit" class="btn btn-sm btn-outline-danger" 
                      onclick="return confirm('Toute les enregistrement d\'evaluer qui contient <?php echo htmlspecialchars($value['LibelleMat']) ?> vont etre supprimer aussi !! Voulez-vous vraiment supprimer cette Matiere ?')">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              <?php endforeach;?>
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-2">
            <small class="text-muted">
              <?=$pageCourante ?> sur <?=$totalPages?>
            </small>
            <nav>
              <ul class="pagination pagination-sm mb-0">
                <li class="page-item 
                <?= ($pageCourante <= 1) ? 'disabled' : '' ?>">
                  <a class="page-link" href="index.php?action=Matieres&page=<?= $pageCourante - 1 ?>">
                    Préc.
                </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $pageCourante) ? 'active' : '' ?>">
                  <a class="page-link" href="index.php?action=Matieres&page=<?= $i ?>">
                    <?= $i ?>
                </a>
                </li>
                <?php endfor;?>
                <li class="page-item <?= ($pageCourante >= $totalPages) ? 'disabled' : '' ?>">
                  <a class="page-link" href="index.php?action=Matieres&page=<?= $pageCourante + 1 ?>">
                    Suiv.
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </section>