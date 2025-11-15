<div class="table-responsive">
            <table class="table align-middle mb-2">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Étudiant</th>
                  <th>Matière</th>
                  <th>Coeff</th>
                  <th>Note /20</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data as $value): ?>
                <tr>
                  <td><?= htmlspecialchars($value['Date']) ?></td>
                  <td><?= htmlspecialchars($value['NomComplet']) ?></td>
                  <td><?= htmlspecialchars($value['LibelleMat']) ?></td>
                  <td>
                    <span class="badge badge-pill badge-coeff">
                    <?= htmlspecialchars($value['CoeffMat']) ?>
                    </span>
                  </td>
                  <td>
                    <span class="badge badge-pill badge-avg-good">
                      <?= htmlspecialchars($value['Note']) ?>
                    </span>
                  </td>
                  <td class="text-end actions">
                    <button class="btn btn-sm btn-outline-secondary me-1 btn-modifier"
                      data-bs-toggle="modal" 
                      data-bs-target="#modifier-modal" 
                      data-netudiant="<?=htmlspecialchars($value['NEtudiant'])?>"
                      data-codemat="<?=htmlspecialchars($value['CodeMat'])?>"
                      data-date="<?= htmlspecialchars($value['Date']) ?>"
                      data-nomcomplet="<?= htmlspecialchars($value['NomComplet']) ?>"
                      data-matiere="<?= htmlspecialchars($value['LibelleMat']) ?>" 
                      data-coeff="<?= htmlspecialchars($value['CoeffMat']) ?>" 
                      data-note="<?= htmlspecialchars($value['Note']) ?>">
                      <i class="bi bi-pencil"></i>
                    </button>
                  <form 
                    method="post" 
                    action="index.php?action=SupprimerEvaluation" 
                    style="display:inline;">
                    <input type="hidden" name="NEtudiant" value="<?= $value['NEtudiant'] ?>">
                    <input type="hidden" name="CodeMat" value="<?= $value['CodeMat'] ?>">
                    <input type="hidden" name="Date" value="<?= $value['Date'] ?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?')">
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
                <li class="page-item <?= ($pageCourante <= 1) ? 'disabled' : '' ?>">
                  <a class="page-link" href="index.php?action=Evaluation&page=<?= $pageCourante - 1 ?>">
                    Préc.
                </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $pageCourante) ? 'active' : '' ?>">
                  <a class="page-link" href="index.php?action=Evaluation&page=<?= $i ?>">
                    <?= $i ?>
                </a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?= ($pageCourante >= $totalPages) ? 'disabled' : '' ?>">
                  <a class="page-link" href="index.php?action=Evaluation&page=<?= $pageCourante + 1 ?>">
                    Suiv.
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </section>