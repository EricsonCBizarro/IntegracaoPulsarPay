<?php
/**
 *  User: Ericson Bizarro - Desenvolvedor Analista - Responsavel pelas Integrações da PulsarPay
 *  Company: PulsarPay Pagamentos
 *  Celular Empresarial - 54999368831
 *  Whats Empresarial - 54999368831
 *  E-mail Empresarial - ericson@pulsarpay.com
 *  Skype -  live:ericsonbizarro_1
 *  Telegram -  @ericson_bizarro
 *
 *  Qualquer duvida ou erros falar com o mesmo.
 */

include('HttpPulsarPay.php');

/*
 *   ppToken (obrigatorio)
 *   password (obrigatorio)
 *   bearerToken (opcional)
 */
$Conta1 = new HttpPulsarPay('2KvUQP}-9Mg+1WYh{W7ioPl}wE9<cxK[N6Qj9G>u', '123456');
//$Conta2 = new HttpPulsarPay('6}XYbc+og4QYWh!T_{5[n}Q3had~wWYz7EpN5Exg', '123456');

$Conta1->authApi();
//$Conta2->authApi();

//var_dump($Conta1);
//var_dump($Conta1, $Conta2);

//print_r($Conta1->httpGetBoletos([] , 1));
//print_r($Conta1->httpGetBoletos(['page' => 2], 5));
//print_r($Conta1->httpGetBoletos(['filtrar_boleto_nosso_numero' => '1559910']));

//print_r($Conta1->httpGetClientes([] , 1));
//print_r($Conta1->httpGetClientes(['page' => 2] , 5));
//print_r($Conta1->httpGetClientes(['filtrar_documento' => '04101259038']));

//print_r($Conta1->httpGetProdutos([] , 1));
//print_r($Conta1->httpGetProdutos(['page' => 2] , 5));
//print_r($Conta1->httpGetProdutos(['filtrar_id' => '33104']));

//$postCliente = $Conta1->httpPostClientes(
//    [
//        'cliente' => [
//            'nome' => 'Ericson Bizarro',
//            'documento' => '03253300005', // Validado
//            'data_nascimento' => '1994-02-06'
//        ],
//        'endereco' => [
//            'cep' => '99074020',
//            'bairro' => 'Don Rodolfo',
//            'endereco' => 'Rua General Daltro Filho',
//            'nro' => '66666'
//        ],
//        'ibge_code' => '2702009',
//        'codigo_externo' => '2020'
//    ]
//);

//print_r($postCliente);

//print_r($Conta1->httpGetClientes(['filtrar_documento' => '03253300005']));
//print_r($Conta1->httpGetClientes(['filtrar_nome' => 'Éricson Cristian Bizarro']));


// TODO Exemplo de listagem de array Foreach, codigo invalido apenas para exemplo
//foreach ($getCliente->data as $key => $value) {
//    print_r($value);
//    print_r($value->id);
//    print_r($value->documento);
//    print_r($value->nome);
//    print_r($value->conta_id);
//}

// =================================================================
// =================================================================
// =================================================================

// =================================================================
// ============================PRODUTO==============================
// =================================================================

/*

$dadosProduto[] = [
    'descricao' => 'Aluguel Imovel 5',
    'valor' => '1486.80',
    'codigo_externo' => '1'
];

$dadosProduto[] = [
    'descricao' => 'IPTU Imovel 5 Mes 8/8',
    'valor' => '78.45',
    'codigo_externo' => '2',
    'tipo_credito' => false
];

$dadosProduto[] = [
    'descricao' => 'CORSAN / Agua- Parcela 4 de 12',
    'valor' => '120.00',
    'codigo_externo' => '3',
    'tipo_credito' => false
];

$dadosProduto[] = [
    'descricao' => 'SEGURO INCÊNDIO OBRIGATÓRIO',
    'valor' => '84.26',
    'codigo_externo' => '4',
    'tipo_credito' => false
];

$dadosProduto[] = [
    'descricao' => 'IRRF',
    'valor' => '504.70',
    'codigo_externo' => '5',
    'tipo_credito' => true
];

$dadosProduto[] = [
    'descricao' => 'Taxa Boleto',
    'valor' => '2.50',
    'codigo_externo' => '6',
    'tipo_credito' => false
];

foreach ($dadosProduto as $index => $item) {
    $postProduto[] = $Conta1->httpPostProduto($item);
}

// ====================BOLETO COM PRODUTOS==========================

// MONTANDO ARRAY PRODUTOS
$interate = 0;
foreach ($postProduto as $index => $item) {
    $produto[$interate]['produto_id'] = $item->codigo;
    $produto[$interate]['quantidade'] = 1;
    $interate++;
}

$dadosBoleto = [
    'boleto' => [
        'vencimento' => '2019-12-31'
        'valor_total' => '10.00' // TODO se tiver produto não passar valor_total
        'multa' => '10.00', // EM PORCENTAGEM TODO se não enviar pega da config padrão da conta
        'juros' => '0.033' // EM PORCENTAGEM TODO se não enviar pega da config padrão da conta
//      'cliente_id' => 12006, // TODO Caso o documento e a data_nascimento não for passada utilizar cliente_id, recomendo sempre utilizar o cliente_id na integração devido a validação, pelo cliente_id temos mais flexibilidade em tudo, alem de não demorar para gerar o boleto devido a consulta por segurança
    ],
    'produto' => $produto, // TODO se for informado produto, não enviar o parametro [boleto] => valor_total
    'documento' => '03253300005',
    'data_nascimento' => '1994-06-02',
    'controle_externo' => 11
];

$postBoleto = $Conta1->httpGerarBoleto($dadosBoleto);

*/


