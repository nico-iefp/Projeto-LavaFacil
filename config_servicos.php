<?php
// config_servicos.php
// Configuração de preços de cada serviço, indexada por cod_tiposervico
// 'unidade' vazia = preço fixo, sem sufixo (ex: planos mensais)

return [
    1  => ['preco' => 3.50,  'unidade' => 'kg'],    // Lavagem
    2  => ['preco' => 1.80,  'unidade' => 'kg'],    // Secagem
    3  => ['preco' => 2.90,  'unidade' => 'peça'],  // Passar a Ferro
    4  => ['preco' => 0.24,  'unidade' => 'km'],    // Recolha
    5  => ['preco' => 0.24,  'unidade' => 'km'],    // Entrega
    6  => ['preco' => 5.00,  'unidade' => 'kg'],    // Pack Lavagem + Secagem
    7  => ['preco' => 8.00,  'unidade' => 'kg'],    // Pack Lavagem + Secagem + Ferro
    8  => ['preco' => 60.00, 'unidade' => ''],      // Mensal Pequeno (<10 Kg/mês)
    9  => ['preco' => 100.00,'unidade' => ''],      // Mensal Médio (10-20 Kg/mês)
    10 => ['preco' => 160.00,'unidade' => ''],      // Mensal Grande (>20 Kg/mês)
];