<?php
    $text=($this->session->userdata('permission'));
    $tab_permission= explode(',',$text);
    $tab_permission=array_map('trim',$tab_permission);
 ?>
<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">
                    <i class="fa fa-navicon "></i> INDUCTION <small> VERIFICATION</small>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form class="form-inline" role="form" action="<?php echo site_url('induction/verify_induction'); ?>" method="post">
                    <div class="form-group">
                        <label for="type_declaration">COMPANY </label>
                        <select class="form-control" name="code_societe" autofocus size="8" id="liste_society">
                            <?php
                                if(isset($id_societe) && !empty($id_societe)){
                                    echo "<option value=".$id_societe.">".$nom_societe."</option>";
                                }else {
                                    echo '<option value="">Sélectionner </option>';
                                }
                                foreach($societes as $soc):
                                  echo "<option value=".$soc->id_societe.">".$soc->nom_societe."</option>";
                                endforeach;
                             ?>
                        </select>
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary"> Find</button>
                </form>
            </div>
        </div>
        <br/>
        <?php if(isset($message_insertion) && !empty($message_insertion)){  ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success" role="alert"><?php echo $message_insertion; ?></div>
            </div>
        </div>
        <?php } ?>

        <?php if(isset($valide_insert_ok) && !empty($valide_insert_ok)){  ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success" role="alert"><?php echo $valide_insert_ok; ?></div>
            </div>
        </div>
        <?php } ?>

        <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"> List of induction </h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data_table_induction">
                            <thead>
                                <tr>
                                    <th>Contractor</th>
                                    <th>Company</th>
                                    <th>Registration Date</th>
                                    <th>Induction date</th>
                                    <th>Expiration date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Contractor</th>
                                    <th>Company</th>
                                    <th>Registration Date</th>
                                    <th>Induction date</th>
                                    <th>Expiration date</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                foreach($inductions as $induction):
                                    $id=$induction->id;
                            ?>
                                <tr <?php
                                    if(($id)%2==1){
                                        echo 'bgcolor="#EEEEEE"';
                                    }else{
                                        echo 'bgcolor="#FFFFFF"';

                                    }
                                    echo " ";
                                    echo 'id="'.$id.'" ';
                                    ?>
                                    >
                                    <td><?php echo $induction->nom_contractant.' '.$induction->prenom_contractant; ?></td>
                                    <td><?php echo $induction->nom_societe; ?></td>
                                    <td><?php echo convertion_date($induction->date_enreg,"en"); ?></td>
                                    <td><?php echo convertion_date($induction->date_induction,"en"); ?></td>
                                    <td><?php echo convertion_date($induction->date_expiration,"en"); ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="btn-group btn-group-sm">
                                                  <a class="btn btn-info" href="<?php echo site_url('induction/prolonger/'.$id); ?>" ><i class="fa fa-folder-open-o fa-fw"></i></a>
                                                  <a class="btn btn-warning" href="<?php echo site_url('induction/update_induction/'.$id); ?>"><i class="fa fa-pencil  fa-fw"></i></a>
                                                  <a class="btn btn-danger" href="<?php echo site_url('induction/delete_induction/'.$id); ?>" onclick="return confirm('Annuler cette induction?');"><i class="fa fa-trash-o fa-fw"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            </div>
        </div>

        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
