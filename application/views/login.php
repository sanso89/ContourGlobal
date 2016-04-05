<!DOCTYPE html>
<html lang="en">
<?php include_once 'template/header.php'; ?>
<style type="text/css">
    body
    {
        background-color: #FFFFFF; /* Le fond de la page sera noir */
       /* background-image: url("<?php echo base_url(); ?>/assets/images/logo1.png ?>") ;*/
        background-repeat: no-repeat;
        background-position: center;
        /*opacity: 0.8;*/
    }
    /* Sticky footer styles
    -------------------------------------------------- */
    html {
      position: relative;
      min-height: 100%;
    }
    body {
      /* Margin bottom by footer height */
      margin-bottom: 60px;
    }
    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      /* Set the fixed height of the footer here */
      height: 60px;
      background-color: #f5f5f5;
    }


    /* Custom page CSS
    -------------------------------------------------- */
    /* Not required for template or sticky footer method. */

    body > .container {
      padding: 60px 15px 0;
    }
    .container .text-muted {
      margin: 20px 0;
    }

    .footer > .container {
      padding-right: 15px;
      padding-left: 15px;
    }

    code {
      font-size: 80%;
    }

</style>
<body>

            <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 30">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo $titre; ?></a>
            </div>
        </nav>


    <div class="container">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <?php

                    if((validation_errors()!="")){
                        echo'<div class="alert alert-danger" role="alert">';
                        echo'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ';
                        echo' <span class="sr-only">Error:</span>';
                        echo validation_errors();
                        echo'</div>';
                    }
                    if(isset($error_authentification) && !empty($error_authentification)){
                        echo'<div class="alert alert-danger" role="alert">';
                        echo'<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ';
                        echo' <span class="sr-only">Error:</span>';
                        echo $error_authentification;
                        echo'</div>';
                    }

                 ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <b><h3 class="panel-title">CONNEXION </h3></b>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo site_url('connexion/login'); ?>" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                        <input class="form-control" placeholder="Login" name="login" type="text" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                                        <input class="form-control" placeholder="Password" name="password" type="password" required value="">
                                     </div>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Connect</button>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <footer class="footer">
      <div class="container">
        <p class="text-muted">2016 Copyrigth ContourGlobal</p>
      </div>
    </footer>
    <?php include_once 'template/footer.php'; ?>

</body>
</html>
