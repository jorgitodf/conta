<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Conta</title>
    <link rel="stylesheet" href="assets/css/template.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" href="assets/fonts/glyphicons-halflings-regular.ttf" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<main>

    <header class="">
	<?php if (isset($_SESSION['userLogin'])) { ?>
	
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li class="active"><a href="">Link <span class="sr-only">(current)</span></a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>	
        	
	<?php }?>
	

    </header>

    <section class="col-md-10 col-xs-12">
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
        
    </section>

    <footer>
    </footer>

</main>

<script src="assets/js/jquery-3.1.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
