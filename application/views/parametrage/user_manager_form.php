
<div id="page-wrapper">

            <div class="container-fluid">
            <?php //var_dump($profils); ?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header">
                            <small> Users Management</small>
                        </h4>
                    </div>
                </div>
                <?php if(isset($message_suppression) && !empty($message_suppression)){  ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="alert alert-success" role="alert"><?php echo $message_suppression; ?></div>
                    </div>
                </div>
                <?php } ?>
                <?php if(isset($valide_insert_ok) && !empty($valide_insert_ok)){  ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="alert alert-success" role="alert"><?php echo $valide_insert_ok; ?></div>
                    </div>
                </div>
                <?php } ?>
                <div class="row">
                	<div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">USERS REGISTRATION FORM</div>
                                <div class="panel-body">
                            		<form role="form" method="post" action="<?php echo site_url('parametrage/register_user'); ?>" onsubmit="return crtl_user_form('<?php echo site_url('parametrage/verification_login'); ?>');">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="last_name">LASTNAME: </label>
                                                    <input type="text" size="35" name="last_name" class="form-control" id="last_name" placeholder="User Lastname " value="<?php if(isset($last_name) && !empty($last_name)){ echo $last_name;} ?>" required>
                                                    <input type="hidden" size="35" name="id_user" class="form-control" id="id_user"  value="<?php if(isset($id_user) && !empty($id_user)){ echo $id_user;} ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="first_name">FIRSTNAME: </label>
                                                    <input type="text" size="35" name="first_name" class="form-control" id="first_name" placeholder="User Firstname " value="<?php if(isset($first_name) && !empty($first_name)){ echo $first_name;} ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="email">Email: </label>
                                                    <input type="email" size="35" name="email" class="form-control" id="email" placeholder="Email" value="<?php if(isset($email) && !empty($email)){ echo $email;} ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="login">Login: </label>
                                                    <input type="text" size="35" name="login" class="form-control" id="login" placeholder="Login " value="<?php if(isset($login) && !empty($login)){ echo $login;} ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="password">Password: </label>
                                                    <input type="password" size="35" name="password" class="form-control" id="password" placeholder="Password " value="<?php if(isset($password) && !empty($password)){ echo $password;} ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="confirm_password"> Password confirmation: </label>
                                                    <input type="password" size="35" name="confirm_password" class="form-control" id="confirm_password" placeholder="Password confirmation " value="<?php if(isset($confirm_password) && !empty($confirm_password)){ echo $confirm_password;} ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="profil"> Profil:</label>
                                                    <select class="form-control" name="profil" id="profil" required>
                                                        <?php

                                                         if (isset($profil) && !empty($profil)) {
                                                            echo "<option value=".$id_profil.">".$profil."</option>";
                                                        } else {
                                                            echo '<option value="">séléctionner</option>';
                                                        } ?>
                                                        <?php 
                                                            foreach ($profils as $profil) {
                                                                echo ' <option value="'.$profil->ID_ROLE.'"> '.$profil->ROLE_NAME.'</option>';
                                                            }
                                                         ?>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        </div>
            							<input type="hidden" id="uri" name="uri" value="<?php echo site_url('parametrage/verification_login'); ?>" class="form-l">
            							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;ADD / CHANGE</button>
                                        <button type="reset" class="btn btn-primary">&nbsp;Cancel</button>
            						</form>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title"> Users List </h4>
                            </div>
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="data_tables_user">
                                        <thead>
                                            <tr>
                                               
                                                <th>N°</th>
                                                <th>LAST NAME</th>
                                                <th>FIRSTNAME</th>
                                                <th>MAIL</th>
                                                <th>LOGIN</th>
                                                <th>PROFIL</th>
                                                <th>ACTIONS</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $i=0;
                                            foreach($users as $user): 
                                                $id=$user->ID_USER;
                                                $i++;
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

                                                
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $user->LAST_NAME; ?></td>
                                                <td><?php echo $user->FIRST_NAME; ?></td>
                                                <td><?php echo $user->EMAIL; ?></td>
                                                <td><?php echo $user->LOGIN; ?></td>
                                                <td><?php echo $user->ROLE_NAME; ?></td>
                                                <td>
                                                    &nbsp;&nbsp;
                                                    <a href="<?php echo site_url('parametrage/update_user/'.$id); ?>"><i class="fa fa-pencil  fa-fw"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a href="<?php echo site_url('parametrage/delete_user/'.$id); ?>" onclick="return confirm('Annuler cette enregistrement?');"><i class="fa fa-trash-o fa-fw"></i></a>
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