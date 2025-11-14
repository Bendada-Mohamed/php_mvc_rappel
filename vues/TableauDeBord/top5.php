<div class="row g-3">
          <div class="col-lg-6">
            <div class="page-card h-100">
              <h6 class="mb-3">Top 5 Étudiants par moyenne</h6>
              <div class="table-responsive">
                <table class="table table-sm align-middle mb-0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Étudiant</th>
                      <th>Nb. matières</th>
                      <th>Moyenne</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($topEtu as $value): ?>
                    <tr>
                      <td><?=$value['NEtudiant']?></td>
                      <td><?=$value['Etudiant']?></td>
                      <td><?=$value['Nb. matiere']?></td>
                      <td>
                        <span class="badge badge-pill badge-avg-good">
                          <?= number_format($value['Moyenne'], 2) ?>
                        </span>
                      </td>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <p class="text-muted small mt-2 mb-0">
                Moyennes pondérées par CoeffMat.
              </p>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="page-card h-100">
              <h6 class="mb-3">Top 5 Matières par moyenne</h6>
              <div class="table-responsive">
                <table class="table table-sm align-middle mb-0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Matière</th>
                      <th>Coeff</th>
                      <th>Moyenne</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($topMat as $value): ?>
                    <tr>
                      <td><?=$value['CodeMat']?></td>
                      <td><?=$value['LibelleMat']?></td>
                      <td>
                        <span class="badge badge-pill badge-coeff">
                          <?=$value['CoeffMat']?>
                        </span>
                      </td>
                      <td>
                        <span class="badge badge-pill badge-avg-good">
                          <?=number_format($value['Moyenne'], 2)?>
                        </span>
                      </td>
                    </tr>
                   <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <p class="text-muted small mt-2 mb-0">
                Moyenne simple des notes par matière.
              </p>
            </div>
          </div>
        </div>
      </section>