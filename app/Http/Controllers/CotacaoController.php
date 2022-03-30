<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CotacaoFrete;
use App\Models\Transportadora;
use Illuminate\Support\Facades\DB;

class CotacaoController extends Controller
{
    public function criarCotacao(Request $request){

        $is_ok      = true;
        $mensagem   = "Erro: ";
        if(empty($request->uf)){
            $mensagem   = 'campo "UF" vázio;';
            $is_ok      = false;
        }
        if(empty($request->percentual_cotacao) || $request->percentual_cotacao == 0){
            $mensagem   = 'campo "Percentual Cotação" vázio;';
            $is_ok      = false;
        }
        if(empty($request->valor_extra)){
            $mensagem   = 'campo "Valor Extra" vázio;';
            $is_ok      = false;                        
        }
        if(empty($request->transportadora_id)){
            $mensagem   = 'campo "Transportadora" vázio;';
            $is_ok      = false;
        }

        $cotacao_frete_verificacao = CotacaoFrete::where('transportadora_id','=', $request->transportadora_id)->where('uf','=', $request->uf)->first();
        if($cotacao_frete_verificacao){
            return response()->json(["mensagem" => "Cotação com a Transportadora ".$request->transportadora_id." e com o UF ".$request->uf." já cadastrado"], 500);
        }

        if($is_ok){
            $cotacao_frete                      = new CotacaoFrete();
            $cotacao_frete->uf                  = $request->uf;
            $cotacao_frete->percentual_cotacao  = $request->percentual_cotacao;
            $cotacao_frete->valor_extra         = $request->valor_extra;
            $cotacao_frete->transportadora_id   = $request->transportadora_id;
            if($cotacao_frete->save()){
                return response()->json([$cotacao_frete], 200);        
            }
            else{
                return response()->json(["mensagem" => "Cotação não criada"], 500);        
            }
        }
        else{
            return response()->json(["mensagem" => $mensagem], 500);
        }
    }

    public function index(){
        $cotacoes_frete     = CotacaoFrete::select('id', 'uf', 'percentual_cotacao', 'valor_extra', 'transportadora_id')->orderBy('id', 'asc')->get();
        $transportadoras    = Transportadora::orderBy('nome', 'asc')->get();
        $UFs                = ['AC','AL','AM','AP','BA','CE','DF','ES','GO','MA','MG','MS','MT','PA','PB','PE','PI','PR','RJ','RN','RO','RR','RS','SC','SE','SP','TO'];
        return view('index', ['cotacoes_frete' => $cotacoes_frete, 'transportadoras' => $transportadoras, 'UFs'=> $UFs]);
    }

    public function solicitarCotacao(Request $request){
        $is_ok      = true;
        $mensagem   = "Erro: ";
        if(empty($request->uf)){
            $mensagem   = 'campo "UF" vázio;';
            $is_ok      = false;
        }
        if(empty($request->valor_pedido)){
            $mensagem   = 'campo "Valor Pedido" vázio;';
            $is_ok      = false;
        }

        if($is_ok){
            $results = DB::select   (" 
                                    select      ((cotacao_frete.percentual_cotacao/100)*".$request->valor_pedido.") as valor_frete,
                                                transportadora.id,
                                                transportadora.nome
                                    from        cotacao_frete
                                                left join transportadora on transportadora.id = cotacao_frete.transportadora_id
                                    where       uf = '".$request->uf."'
                                    order by    valor_frete
                                    limit       3
                                    ");
            if(empty($results)){
                return response()->json(["mensagem" => "Nenhuma cotação encontrada"], 500);        
            }
            else{
                return response()->json($results, 200);
            }
        }
        else{
            return response()->json(["mensagem" => $mensagem], 500);
        }
    }

    public function obterCotacoesFrete(){
        $cotacoes_frete = CotacaoFrete::select('id', 'uf', 'percentual_cotacao', 'valor_extra', 'transportadora_id')->orderBy('id', 'asc')->get();

        return response()->json($cotacoes_frete, 200);
    }
}
