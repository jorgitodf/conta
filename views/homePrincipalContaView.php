
<aside class="body_home_conta col-md-12 col-lg-12 col-sm-12 col-xs-12">
    <div class="panel_home_conta">
        <section class="sec_btn_group">
            <div class="row-fluid">
                <div class="btn-group">
                    <button type="button" class="btn btn-success" id="btn_extrato"><a class="href_btn_home" href="/home">Extratos</a></button>
                    <button type="button" class="btn btn-success dropdown-toggle" id="btn_extrato_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/conta/extrato/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Extrato Mês Atual</a></li>
                        <li><a href="/extrato">Extrato Por Período</a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-success" id="btn_extrato"><a class="href_btn_home" href="/home">Transações</a></button>
                    <button type="button" class="btn btn-success dropdown-toggle" id="btn_extrato_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/conta/debitar/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Debitar</a></li>
                        <li><a href="/conta/creditar/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Creditar</a></li>
                    </ul>
                </div>	
                <div class="btn-group">
                    <button type="button" class="btn btn-success" id="btn_extrato"><a class="href_btn_home" href="/home">Pagamentos</a></button>
                    <button type="button" class="btn btn-success dropdown-toggle" id="btn_extrato_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/conta/pagar/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Pagamento Agendado</a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-success" id="btn_extrato"><a class="href_btn_home" href="/home">Relatórios</a></button>
                    <button type="button" class="btn btn-success dropdown-toggle" id="btn_extrato_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/relatorio">Movimentação e Período</a></li>
                        <li><a href="/relatorio/geral">Relatório Geral</a></li>
                    </ul>
                </div>
            </div>
            <br/>
            <div class="row-fluid">
                <div class="btn-group">
                    <button type="button" class="btn btn-success" id="btn_agendamento"><a class="href_btn_home" href="/home">Agendamentos</a></button>
                    <button type="button" class="btn btn-success dropdown-toggle" id="btn_agendamento_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/agendamento">Listagem Pagamentos</a></li>
                        <li><a href="/agendamento/agendar/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Agendar Pagamento</a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-success" id="btn_agendamento"><a class="href_btn_home" href="/home">Cartão Crédito</a></button>
                    <button type="button" class="btn btn-success dropdown-toggle" id="btn_agendamento_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="/cartao">Cadastrar</a></li>
                        <li><a href="/cartao/fatura">Lançar Fatura</a></li>
                        <li><a href="/cartao/debitarfatura">Debitar Fatura</a></li>
                        <li><a href="/cartao/fecharfatura">Fechar Fatura</a></li>
                        <li><a href="/cartao/consultarfatura">Consultar Fatura</a></li>
                    </ul>
                </div>
                <input type="hidden" id="idConta" value="<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>" />
                <input type="hidden" id="action" value="/conta/pagar" />
                <input type="hidden" id="actionsecond" value="/conta/trazerTabela" />
            </div>
            <div class="div_msg_alert_pgto_agendado col-md-12 col-sm-12">
                <div class="retorno"></div>
            </div>
        </section>
        <section class="sec_desp_agendada">
            <div class="table table-responsive" id="tabela_pgto_agendado">
            </div>  
        </section>
    </div>
</aside>