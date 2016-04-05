<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header"><i class="fa fa-navicon "></i> INDUCTION <small> &nbsp;&nbsp;REGISTRATION<?php echo validation_errors(); ?></small></h4>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <?php
                                    if(isset($num_induction) && !empty($num_induction)){
                                        $titre="UPDATE INDUCTION: ".$num_induction;
                                    }else{
                                        $titre="REGISTER NEW INDUCTION";
                                    }
                                    echo $titre;
                                 ?>
                                </div>
                                <div class="panel-body">
                                    <form role="form" action="<?php echo site_url('induction/register_induction'); ?>" method="post" onsubmit="check_sortie_form();">
                                        <h4>General Information</h4>
                                         <hr/>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="from-group">
                                                    <label for="date_enreg">Date Registration</label>
                                                    <input class="form-control" type="text" id="date_enreg" name="date_enreg" required value="<?php if(isset($date_enreg) && !empty($date_enreg)){ echo $date_enreg;}else {echo date('d/m/Y');} ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                              <div class="form-group">
                                                  <label for="type_declaration">Company </label>
                                                  <div class="row">
                                                    <div class="col-lg-9">
                                                  <select class="form-control" name="code_societe" autofocus size="8" id="liste_society" required>
                                                      <?php
                                                          if(isset($id_societe) && !empty($id_societe)){
                                                              echo '<option value="'.$id_societe.'">'.$societe.'</option>';
                                                          }else {
                                                              echo '<option value="">Sélectionner </option>';
                                                          }
                                                          foreach($societes as $soc):
                                                            echo "<option value=".$soc->id_societe.">".$soc->nom_societe."</option>";
                                                          endforeach;
                                                       ?>
                                                  </select>
                                                    <input type="hidden" id="nom_societe" name="nom_societe" value="<?php if(isset($nom_societe) && !empty($nom_societe)){ echo $nom_societe;} ?>" class="form-l">
                                                    </div>
                                                    <div class="col-lg-3">
                                                      <button type="button" class="btn btn-primary btn-primary btn-sm" onclick="ajouter_societe();">Add Company</button>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <h4>Contracting</h4><hr/>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="from-group">
                                                    <label for="nom_contractant">Lastname</label>
                                                    <input class="form-control" type="text" id="nom_contractant" name="nom_contractant" required placeholder="Contractor Lastname" value="<?php if(isset($nom_contractant) && !empty($nom_contractant)){ echo $nom_contractant;} ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="from-group">
                                                    <label for="prenom_contractant">Firstname </label>
                                                    <input class="form-control" type="text" id="prenom_contractant" name="prenom_contractant" required placeholder="Contractor Firstname" value="<?php if(isset($prenom_contractant) && !empty($prenom_contractant)){ echo $prenom_contractant;} ?>" >
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="from-group">
                                                    <label for="nom">Birth date</label>
                                                    <input class="form-control" type="text" id="date_naissance" name="date_naissance"   value="<?php if(isset($date_naissance) && !empty($date_naissance)){ echo $date_naissance;} ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="from-group">
                                                    <label for="date_induction">Induction Date</label>
                                                    <input class="form-control" type="text" id="date_induction" name="date_induction" required  value="<?php if(isset($date_induction) && !empty($date_induction)){ echo $date_induction;} else {echo date('d/m/Y');} ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="from-group">
                                                    <label for="date_expiration">Expiration Date</label>
                                                    <input class="form-control" type="text" id="date_expiration" name="date_expiration"  required  value="<?php if(isset($date_expiration) && !empty($date_expiration)){ echo $date_expiration;} else {echo date('d/m/Y',mktime(0, 0, 0, date("m")+3 ,date("d"), date("Y")));;} ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="from-group">
                                                    <input type="hidden" id="id_induction" name="id_induction" value="<?php if(isset($id_induction) && !empty($id_induction)){ echo $id_induction;} ?>" class="form-l">
                                                    <input type="hidden" id="base_url" name="base_url" value="<?php echo site_url("induction/"); ?>" class="form-l">
                                                    <button class="btn btn-primary btn-primary" type="submit">Valider</button>
                                                    <button class="btn btn-primary btn-primary" type="reset">Annuler</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
