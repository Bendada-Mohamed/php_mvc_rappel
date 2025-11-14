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
            <small class="text-muted">3 sur 18</small>
            <nav>
              <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><span class="page-link">Préc.</span></li>
                <li class="page-item active"><span class="page-link">1</span></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Suiv.</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </section>