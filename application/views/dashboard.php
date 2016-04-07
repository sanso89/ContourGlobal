<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                      <h4 class="page-header">
                          <i class="fa fa-navicon "></i> LISTE DES INDUCTIONS DONT L'ECHEANCE EST PROCHE
                      </h4>
                  </div>
              </div>
              <?php //echo $inductions; ?>
              <div class="row">
                <div class="col-lg-6">
                    <ul class="list-group">
                      <?php
                        foreach($inductions as $induction):
                          echo '<li class="list-group-item"><span class="badge">'.$induction->date_expiration.'</span>'.$induction->nom_contractant.' DE  '.$induction->nom_societe.'</li>';
                        endforeach; ?>
                    </ul>
                </div>
              </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
