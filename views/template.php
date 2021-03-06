<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Conta</title>
        <link rel="stylesheet" href="/assets/css/template.css" />
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css" media="all" />
        <link rel="stylesheet" href="/assets/fonts/glyphicons-halflings-regular.ttf" media="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <main>
            <header id="cabecalho">
                <?php if (isset($_SESSION['userLogin'])) { ?>
                    <nav class="navbar navbar-default navbar-fixed-top" id="barra_nav">
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
                                <ul class="nav navbar-nav navbar-left" id="navbar-nav">
                                    <li class="dropdown">
                                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Minha Conta<span class="caret"></span></a>
                                        <ul class="dropdown-menu" id="dropdown-menu">
                                            <li><a href="/home">Página Inicial</a></li>
                                            <li><a href="/conta/extrato/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Extrato</a></li>
                                            <li><a href="/extrato">Extrato por Período</a></li>
                                            <li><a href="/conta/debitar/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Transação Debitar</a></li>
                                            <li><a href="/conta/creditar/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Transação Creditar</a></li>
                                            <li><a href="/agendamento/agendar/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Agendar Pagamento</a></li>
                                            <li><a href="/conta/trocar/">Trocar Conta</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav navbar-form" id="navbar_saldo">
                                    <?php if (isset($dados) && !empty($dados)): ?>
                                    <li>Conta: <span class="info_saldo"><?php echo $dados['conta']; ?></span></li><br/>
                                    <li>Banco: <span class="info_saldo"><?php echo $dados['banco']; ?></span></li><br/>
                                    <li>Saldo: <span class="info_saldo"><?php echo number_format($dados['saldo'], 2, ',', '.'); ?></span></li><br/>
                                    <?php else: ?>
                                    <li><?php echo $erro; ?></li><br/>
                                    <?php endif; ?>
                                </ul>            
                                <ul class="nav navbar-nav navbar-right" id="navbar_deslogar">
                                    <li class="dropdown">
                                        <a href="/login/logout">Deslogar</a>
                                    </li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>	
                <?php } ?>
            </header>

            <section class="col-md-12 col-xs-12 col-sm-12" id="section_load_template">
                <?php $this->loadViewInTemplate($viewName, $viewData); ?>        
            </section>

            <footer>
            </footer>
            
        </main>

        <script src="/assets/js/jquery-3.1.0.min.js"></script>
        <script src="/assets/js/jquery.maskMoney.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/scripts.js"></script>
        <script src="/assets/js/jquery.maskedinput.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#valor").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                $("#valor_pgto").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                $("#valor_compra_fatura").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                $("#encargos").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                $("#iof").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                $("#anuidade").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                $("#protecao_prem").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                $("#valor_pagar").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                $("#juros_fat").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                $("#restante").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                $("#valor_total").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
                $("#valor_cre").maskMoney({showSymbol: true, symbol: "R$ ", decimal: ",", thousands: "."});
            });
            jQuery(function($){
               $("#num_cartao").mask("9999.9999.9999.9999");
               $("#data_validade").mask("99/9999");
            });
        </script>

    </body>
</html>
