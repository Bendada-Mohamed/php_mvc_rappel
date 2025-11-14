<section id="dashboard">
        <!-- Stats row -->
        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <div class="stat-card d-flex align-items-center justify-content-between">
              <div>
                <div class="text-muted small mb-1">Étudiants</div>
                <div class="stat-value"><?= $nbrEtu[0]['nbr'] ?></div>
              </div>
              <div class="fs-2 text-primary">
                <i class="bi bi-people-fill"></i>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card d-flex align-items-center justify-content-between">
              <div>
                <div class="text-muted small mb-1">Matières</div>
                <div class="stat-value"><?=$nbrMat[0]['nbr'] ?></div>
              </div>
              <div class="fs-2 text-info">
                <i class="bi bi-journal-bookmark-fill"></i>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card d-flex align-items-center justify-content-between">
              <div>
                <div class="text-muted small mb-1">Évaluations</div>
                <div class="stat-value"><?= $nbrEva[0]['nbr'] ?></div>
              </div>
              <div class="fs-2 text-success">
                <i class="bi bi-clipboard2-check-fill"></i>
              </div>
            </div>
          </div>
        </div>
