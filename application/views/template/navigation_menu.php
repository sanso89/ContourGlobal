        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo $titre; ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" >
                    <?php
                        //if(isset($this->session->userdata('first_name'))){
                            echo $this->session->userdata('last_name').' '.$this->session->userdata('first_name');
                       // }
                    ?>

                        <i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Profil</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('connexion/deconnexion') ?>"><i class="fa fa-sign-out fa-fw"></i> Log Out</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation" id="barre_laterale">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard fa-fw"></i> MAIN MENU</a>
                        </li>

                        <?php
                            $text=($this->session->userdata('permission'));
                            $tab_permission= explode(',',$text);
                            $tab_permission=array_map('trim',$tab_permission);
                            if(in_array('_induction',$tab_permission)){

                         ?>
						<li>
                            <a href="<?php echo site_url('induction/new_induction'); ?>"><i class="fa fa-plus-square-o fa-fw"></i> New induction</a>
                        </li>
						<li>
                            <a href="<?php echo site_url('induction/verify_induction'); ?>"><i class="fa  fa-check-square-o fa-fw"></i> Check induction</a>
                        </li>
						<li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Reports</a>
                        </li>
                        <?php
                         }
                         if(in_array('_parametre', $tab_permission)){
                         ?>
                        <li>
                            <a href="#"><i class="fa fa-gear fa-fw"></i> Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('parametrage/user_manager'); ?>"><i class="fa fa-file-o fa-fw"></i> Users</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-file-o fa-fw"></i> Save Database</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php
                          }
                         ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
