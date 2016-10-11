<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
            <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">WEB2SMS APP</a>
                    <ul class="user-menu">
                            <li class="dropdown pull-right">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-2x"></i> Bienvenu <?php echo strtoupper($nom).' '.$prenom.'!'; ?><span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                            <li><a href="#"><i class="fa fa-user"></i>Profil</a></li>
                                            <li><a href="#"><i class="fa fa-edit"></i> Editer le profil</a></li>
                                            <li><a href="<?php echo base_url() ?>Utilisateurs/deconnexion"><i class="fa fa-sign-out"></i> Se déconnecter</a></li>
                                    </ul>
                            </li>
                    </ul>
            </div>

    </div><!-- /.container-fluid -->

</nav>