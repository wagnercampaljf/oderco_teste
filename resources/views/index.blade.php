<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Oderço</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#salvar_button").click(function () {

                    var transportadora      = $("#transportadoraSelect");
                    var uf                  = $("#UFSelect");
                    var percentual_cotacao  = $("#percentual_cotacao");
                    var valor_extra         = $("#valor_extra");
                    
                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8000/api/cotacao",
                        dataType: "JSON",
                        data:   {
                                uf                  : uf.val(), 
                                percentual_cotacao  : percentual_cotacao.val(), 
                                valor_extra         : valor_extra.val(), 
                                transportadora_id   : transportadora.val()
                                },
                        complete: function (c) {
                            //alert(1);
                            //console.log(c);
                        },
                        success: function (c) {
                            //alert(2);
                            console.log(c);

                            var resposta = $("#resultado_cotacao_frete").val();

                            $.each(c, function (a, b) {
                                console.log(a);
                                console.log(b);
                                            
                                resposta = resposta + '<tr><th scope="row">'+b.id+'</th><td>'+b.uf+'</td><td>'+b.percentual_cotacao+'</td><td>'+b.valor_extra+'</td><td>'+b.transportadora_id+'</td></tr>';

                            });

                            $("#resultado_cotacao_frete").append(resposta);
                        },
                        error: function (c) {
                            //alert(c);
                            //console.log(c);
                        },
                        beforeSend: function (c) {
                            //alert(4);
                            //console.log(c);
                        }
                    });
                });

                $("#cotar_button").click(function () {

                    var uf            = $("#UFSelectCotar");
                    var valor_pedido  = $("#valor_pedido");

                    $.ajax({
                        type: "PUT",
                        url: "http://localhost:8000/api/cotacao",
                        dataType: "JSON",
                        data:   {
                                uf              : uf.val(), 
                                valor_pedido    : valor_pedido.val(), 
                                },
                        complete: function (c) {
                            //alert(1);
                            //console.log(c);
                        },
                        success: function (c) {
                            //alert(2);
                            console.log(c.mensagem);

                            var resposta = '<div class="row  mx-lg-n5"><div class="col-12"><b><h5>Melhores Resultados</h5></b><table class="table"><thead class="thead-light"><tr><th scope="col">Rank</th><th scope="col">Transportadora</th><th scope="col">Valor Cotação</th></tr></thead><tbody>';

                            $.each(c, function (a, b) {
                                console.log(a);
                                console.log(b);
                                            
                                resposta = resposta+'<tr><th scope="row">'+a+'</th><td>'+b.nome+'</td><td>'+b.valor_frete+'</td></tr></div></div>';

                            });

                            resposta = resposta+'</tbody></table>';
                            $("#resultado").html(resposta);
                        },
                        error: function (c) {
                            //alert(3);
                            console.log(c);
                        },
                        beforeSend: function (c) {
                            //alert(4);
                            //console.log(c);
                        }
                    });
                });
            });
            
        </script>

    </head>    
    <body>
        <br><div class="container">
            <div class="row">
                <div class="col-5 border border-5 border-primary">
                    <div class="container">
                        <div class="row  mx-lg-n5">
                            <div class="col-12">
                                <h1>Cadastro cotação de frete</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="12">
                                <form>
                                    <div class="form-group">
                                        <label for="transportadoraSelect">Transportadora</label>
                                        <select class="form-control" id="transportadoraSelect">
                                            @foreach ($transportadoras as $transportadora)
                                                    <option value={{$transportadora->id}}>{{$transportadora->nome}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="UFSelect">UF</label>
                                        <select class="form-control" id="UFSelect">
                                            @foreach($UFs as $UF)
                                                <option>{{$UF}}</option>
                                            @endforeach
                                        </select>                                    </div>
                                    <div class="form-group">
                                        <label for="percentual_cotacao">Percentual Cotação (%)</label>
                                        <input class="form-control" id="percentual_cotacao">
                                    </div>
                                    <div class="form-group">
                                        <label for="percentual_cotacao">Valor Extra (R$)</label>
                                        <input class="form-control" id="valor_extra">
                                    </div>
                                    <div class="form-group mx-auto">
                                        <br><button id="salvar_button" type="button" class="btn btn-primary mb-2">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
                <div class="col-5 border border-5 border-primary">
                    <div class="container">
                        <div class="row  mx-lg-n5">
                            <div class="col-12">
                                <h1>Cadastro cotação de frete</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="12">
                                <form>
                                    <div class="form-group">
                                        <label for="UFSelect">UF</label>
                                        <select class="form-control" id="UFSelectCotar">
                                            @foreach($UFs as $UF)
                                                <option>{{$UF}}</option>
                                            @endforeach
                                        </select>                                    </div>
                                    <div class="form-group">
                                        <label for="valor_pedido">Valor Pedido</label>
                                        <input class="form-control" id="valor_pedido">
                                    </div>
                                    <div class="form-group mx-auto">
                                        <br><button id="cotar_button" type="button" class="btn btn-primary mb-2">Cotar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="resultado"></div>
                        
                    </div>
                </div>
            </div><br><br>
            @php
                //echo "<pre>"; print_r($cotacoes_frete); echo "</pre>";
            @endphp
            <div class="row">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">id</th>
                        <th scope="col">UF</th>
                        <th scope="col">Percentual Frete (%)</th>
                        <th scope="col">Valor Extra</th>
                        <th scope="col">Transportadora</th>
                        </tr>
                    </thead>
                    <tbody id="resultado_cotacao_frete">
                        @foreach($cotacoes_frete as $cotacao_frete)
                            <tr>
                                <th scope="row">{{$cotacao_frete->id}}</th>
                                <td>{{$cotacao_frete->uf}}</td>
                                <td>{{$cotacao_frete->percentual_cotacao}}</td>
                                <td>{{$cotacao_frete->valor_extra}}</td>
                                <td>{{$cotacao_frete->transportadora_id}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </body>
</html>
