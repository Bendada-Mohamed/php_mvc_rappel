    <!-- Top 5 Étudiants et Matières -->
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header fw-bold">Top 5 Étudiants par moyenne</div>
          <div class="card-body p-0">
            <table class="table mb-0 align-middle text-center">
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
                    <span class="badge <?php 
                    if ($value['Moyenne'] >= 16) {
                      echo 'bg-success';
                    }elseif($value['Moyenne'] < 16 && $value['Moyenne'] >= 14){
                      echo 'bg-primary';
                    }elseif($value['Moyenne'] < 14){
                      echo 'bg-secondary';
                    }?>">
                      <?= number_format($value['Moyenne'], 2) ?>
                    </span>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer small text-muted">Moyennes pondérées par CoeffMat.</div>
        </div>
      </div>


      <div class="col-md-6">
        <div class="card">
          <div class="card-header fw-bold">Top 5 Matières par moyenne</div>
          <div class="card-body p-0">
            <table class="table mb-0 align-middle text-center">
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
                  <td><?=$value['CoeffMat']?></td>
                  <td>
                    <span class="badge 
                    <?php 
                    if ($value['Moyenne'] >= 16) {
                      echo 'bg-success';
                    }elseif($value['Moyenne'] < 16 && $value['Moyenne'] >= 14){
                      echo 'bg-primary';
                    }elseif($value['Moyenne'] < 14){
                      echo 'bg-secondary';
                    }?>">
                      <?=number_format($value['Moyenne'], 2)?>
                    </span>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer small text-muted">Moyenne simple des notes par matière.</div>
        </div>
      </div>
    </div>
  </div>
