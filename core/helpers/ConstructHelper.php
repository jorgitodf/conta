<?php

class ConstructHelper {
    
    public static function monta_panel_tabela_extrato_periodo($dataInicial, $datFinal, $extrato = null, $extrato_erro = null) {
        if (!empty($extrato) || $extrato != null) {
            $divPanel = "<div class='panel panel-primary' id='table_extrato'>";
            $divPanel .= "<div class='panel-heading' id=''>";
            $divPanel .= "<h3 class='panel-title'>Extrato período: ".date('d/m/Y', strtotime($dataInicial))." a "
                .date('d/m/Y', strtotime($datFinal))."</h3>";
            $divPanel .= "</div>";
            $divPanel .= "<div class='panel-body'>";
            $divPanel .= "<table class='table table-hover' id='table_extrato_atual'>";
            $divPanel .= "<thead>";
            $divPanel .= "<tr>";
            $divPanel .= "<th class='data_mov_cab' width='22%'>Data de Movimentação</th>";
            $divPanel .= "<th width='35%'>Movimentação</th>";
            $divPanel .= "<th width='25%'>Categoria</th>";
            $divPanel .= "<th class='valor_mov_cab' width='15%'>Valor</th>";
            $divPanel .= "<th class='saldo_mov_cab'>Saldo</th>";
            $divPanel .= "</tr>";
            $divPanel .= "</thead>";
            $divPanel .= "<tbody>";
            foreach ($extrato as $linha) {
                $divPanel .= "<tr>";  
                $divPanel .= "<td class='td_extrato_deb_data'>".date('d/m/Y', strtotime($linha['DatMov']))."</td>";
                if ($linha['Op'] == 'Crédito') {
                    $divPanel .= "<td class='td_extrato_cre'>".ucwords(strtolower(mb_convert_case($linha['Mov'], MB_CASE_TITLE)))."</td>";
                    $divPanel .= "<td class='td_extrato_cre'>".ucwords(strtolower(mb_convert_case($linha['Cat'], MB_CASE_TITLE)))."</td>";
                    $divPanel .= "<td align='center' class='td_extrato_cre'>".number_format($linha['Val'], 2, ',', '.')."</td>";
                    $divPanel .= "<td align='center' class='td_extrato_cre'>".number_format($linha['Sal'], 2, ',', '.')."</td>";
                } else {
                    if ($linha['Dp'] == 'S') {
                        $divPanel .= "<td class='td_extrato_deb_fixa'>".ucwords(strtolower(mb_convert_case($linha['Mov'], MB_CASE_TITLE)))."</td>";
                        $divPanel .= "<td>".ucwords(strtolower(mb_convert_case($linha['Cat'], MB_CASE_TITLE)))."</td>";
                        $divPanel .= "<td align='center' class='td_extrato_deb'>".number_format($linha['Val'], 2, ',', '.')."</td>";
                        $divPanel .= "<td align='center' class='td_extrato_deb_saldo'>".number_format($linha['Sal'], 2, ',', '.')."</td>";
                    } else {
                        $divPanel .= "<td>".ucwords(strtolower(mb_convert_case($linha['Mov'], MB_CASE_TITLE)))."</td>";
                        $divPanel .= "<td>".ucwords(strtolower(mb_convert_case($linha['Cat'], MB_CASE_TITLE)))."</td>";
                        $divPanel .= "<td align='center' class='td_extrato_deb'>".number_format($linha['Val'], 2, ',', '.')."</td>";
                        $divPanel .= "<td align='center' class='td_extrato_deb_saldo'>".number_format($linha['Sal'], 2, ',', '.')."</td>";
                    }
                }
                $divPanel .= "</tr>";
            }
            $divPanel .= "</tbody>";
            $divPanel .= "</table>";
            $divPanel .= "<div>";
            $divPanel .= "<a href='/extrato' class='btn btn-primary'>Voltar</a>";
            $divPanel .= "</div>";
            $divPanel .= "</div>";
            $divPanel .= "</div>";
        }
        return $divPanel;
    }

    public static function geraTabelaComTotal($tabela) {
        $total = "" ;
        $table = "<div class='row col-sm-8 col-md-8 col-lg-8' id='div_row_tabela_consulta_mov_per'>";
        $table .= "<table class='table table-hover table-condensed bordasimples' id='table_cons_mov_periodo' cellspacing=1 cellpadding=1>";
        $table .= "<thead>";
        $table .= "<tr>";
        $table .= "<td>Data</td>";
        $table .= "<td>Dia</td>";
        $table .= "<td>Movimentação</td>";
        $table .= "<td>Valor</td>";
        $table .= "</tr>";
        $table .= "</thead>";
        $table .= "<body>";
        foreach ($tabela as $linha) {
            $table .= "<tr>";
            $table .= "<td class=''>".$linha['data']."</td>";    
            $table .= "<td align='left' class=''>".$linha['dia']."</td>";    
            $table .= "<td class=''>".ucwords(strtolower(mb_convert_case($linha['mov'], MB_CASE_TITLE)))."</td>";   
            $table .= "<td align='left' class=''>R$ ".number_format($linha['val'], 2, ',', '.')."</td>";    
            $table .= "</tr>";
            $total += $linha['val'];
        }
        $table .= "</body>";
        $table .= "<tfoot>";
        $table .= "<tr>";
        $table .= "<td colspan='3' align='center'>Total de Gastos</td>";
        $table .= "<td colspan='1' align='center'>R$ ".number_format($total, 2, ',', '.')."</td>";
        $table .= "</tr>";
        $table .= "<tfoot>";
        $table .= "</table>";
        $table .= "<div><p><a id='btn_voltar_cons_mov_per' class='btn btn-primary' href='/relatorio'>Voltar</a></p></div>";
        $table .= "</div>";
        return $table;
    }
    
    public static function monta_tabela_grupos($mes, $ano, $contas_agendadas = null) {
        $total = "" ;
        if (!empty($contas_agendadas) || $contas_agendadas != null) {
            $table = "<table class='table table-condensed bordasimples' id='table_desp_agendada' cellspacing=1 cellpadding=1>";
                $table .= "<thead>";
                    $table .= "<tr>";
                    $table .= "<td colspan='4' id='cab_table'>Contas Agendadas para {$mes} / {$ano}</td>";
                    $table .= "</tr>";
                    $table .= "<tr id='tr_cab_table'>";
                    $table .= "<td>Movimentação</td>";
                    $table .= "<td>Valor</td>";
                    $table .= "<td>Data Pagamento</td>";
                    $table .= "<td>Pago</td>";
                    $table .= "</tr>";
                $table .= "</thead>";
                $table .= "<body>";
                    foreach ($contas_agendadas as $linha) {
                    $table .= "<tr>";
                    if ($linha['pago'] == 'Não') {
                        $table .= "<td class='td_color_pgto'>".ucwords(strtolower(mb_convert_case($linha['mov'], MB_CASE_TITLE)))."</td>";    
                        $table .= "<td align='left' class='td_color_pgto'>R$ ".number_format($linha['valor'], 2, ',', '.')."</td>";    
                        $table .= "<td class='td_color_pgto'>".date("d/m/Y", strtotime($linha['data']))."</td>";   
                        $table .= "<td class='td_color_pgto'>".ucwords(strtolower(mb_convert_case($linha['pago'], MB_CASE_TITLE)))."</td>";
                    } else {
                        $table .= "<td class='td_color_pgto_sim'>".ucwords(strtolower(mb_convert_case($linha['mov'], MB_CASE_TITLE)))."</td>";    
                        $table .= "<td align='left' class='td_color_pgto_sim'>R$ ".number_format($linha['valor'], 2, ',', '.')."</td>";    
                        $table .= "<td class='td_color_pgto_sim'>".date("d/m/Y", strtotime($linha['data']))."</td>";   
                        $table .= "<td class='td_color_pgto_sim'>".ucwords(strtolower(mb_convert_case($linha['pago'], MB_CASE_TITLE)))."</td>"; 
                    }
                    $table .= "</tr>";
                        $total += $linha['valor'];
                    }
                $table .= "</body>";
                $table .= "<tfoot>";
                    $table .= "<tr>";
                    $table .= "<td colspan='2' align='center'>Total de Contas a Pagar em {$mes}/{$ano}</td>";
                    $table .= "<td colspan='2' align='right'>R$ ".number_format($total, 2, ',', '.')."</td>";
                    $table .= "</tr>";
                $table .= "<tfoot>";
            $table .= "</table>";
        } else {
            $table = "<table class='table table-condensed bordasimples' id='table_desp_agendada' cellspacing=1 cellpadding=1>";
                $table .= "<thead>";
                    $table .= "<tr>";
                    $table .= "<td colspan='4' id='cab_table'>Contas Agendadas para {$mes} / {$ano}></td>";
                    $table .= "</tr>";
                    $table .= "<tr id='tr_cab_table'>";
                    $table .= "<td>Movimentação</td>";
                    $table .= "<td>Valor</td>";
                    $table .= "<td>Data Pagamento</td>";
                    $table .= "<td>Pago</td>";
                    $table .= "</tr>";
                $table .= "</thead>";
                $table .= "<body>";
                $table .= "<tr>";
                $table .= "<td colspan='4' id='td_sem_contas_agendadas'>Sem Pagamento Agendado Até o Momento</td>";
                $table .= "</tr>";
                $table .= "</body>";
                $table .= "<tfoot>";
                    $table .= "<tr>";
                    $table .= "<td colspan='2'></td>";
                    $table .= "<td colspan='2'></td>";
                    $table .= "</tr>";
                $table .= "<tfoot>";
            $table .= "</table>";
        }
        return $table;
    }
    
    public static function transformaAnoMes($data) {
        $ano = substr($data, 0, 5);
        $mes = substr($data, 6, 1);
        $anoMes = $ano.$mes; 
        return $anoMes;
    }
    
}
