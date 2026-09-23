<?php
// servicos.php

// Fica a inclusão do ficheiro que faz a ligação à base de dados (cria a variável $pdo)
require_once 'conexao.php';

// Carrega o ficheiro que tem a configuração de preços de cada serviço (array $config)
$config = require 'config_servicos.php';

// Bloco try/catch: tenta ir buscar os serviços à base de dados
// Se der erro na query, o catch apanha a exceção e para a execução
try {
    // Query que vai buscar o código e a descrição de todos os tipos de serviço, ordenados por código
    $stmt = $pdo->query("SELECT cod_tiposervico, descricao FROM tipos_servicos ORDER BY cod_tiposervico");

    // fetchAll() devolve todas as linhas do resultado da query, como um array associativo
    $tipos = $stmt->fetchAll();
} catch (PDOException $e) {
    // Se houver erro na base de dados, mostra a mensagem e termina o script
    die("Erro ao carregar os serviços: " . htmlspecialchars($e->getMessage()));
}

// Vamos criar 4 arrays vazios, um para cada categoria de serviços
// Cada array vai ser preenchido no foreach seguinte
$grupo_servicos  = array(); // Serviços "normais" (lavagem, secagem, engomadoria)
$grupo_domicilio = array(); // Serviços de recolha e entrega
$grupo_packs     = array(); // Packs de serviços
$grupo_mensal    = array(); // Planos mensais

// Percorre todos os serviços que vieram da base de dados, um a um
foreach ($tipos as $tipo) {

    // Guarda o id do serviço atual numa variável, só para facilitar a leitura
    $id = $tipo['cod_tiposervico'];

    // Consoante o id do serviço, definimos qual o ícone (emoji) e a categoria dele
    // Isto substitui a tabela de "metadados" — aqui está tudo escrito à mão, caso a caso
    switch ($id) {
        case 1:
            $icone = '🧺';        // Ícone da lavagem
            $categoria = 'servicos';
            break;
        case 2:
            $icone = '🌬️';        // Ícone da secagem
            $categoria = 'servicos';
            break;
        case 3:
            $icone = '👔';        // Ícone da engomadoria
            $categoria = 'servicos';
            break;
        case 4:
            $icone = '🚚';        // Ícone da recolha
            $categoria = 'domicilio';
            break;
        case 5:
            $icone = '📦';        // Ícone da entrega
            $categoria = 'domicilio';
            break;
        case 6:
            $icone = '🔄';        // Ícone de um pack
            $categoria = 'packs';
            break;
        case 7:
            $icone = '⭐';        // Ícone de outro pack
            $categoria = 'packs';
            break;
        // Os ids 8, 9 e 10 são todos planos mensais, por isso partilham o mesmo código
        case 8:
        case 9:
        case 10:
            $icone = '📅';
            $categoria = 'mensal';
            break;
        // Se aparecer um id que não está previsto, usamos valores por omissão
        default:
            $icone = '🧺';
            $categoria = 'servicos';
            break;
    }

    // Acrescentamos o ícone dentro do próprio array do serviço
    // Assim, mais à frente no HTML, já temos o ícone disponível em $tipo['icone']
    $tipo['icone'] = $icone;

    // Consoante a categoria calculada acima, metemos o serviço no array certo
    if ($categoria == 'servicos') {
        $grupo_servicos[] = $tipo;      // Acrescenta $tipo ao fim do array $grupo_servicos
    } elseif ($categoria == 'domicilio') {
        $grupo_domicilio[] = $tipo;
    } elseif ($categoria == 'packs') {
        $grupo_packs[] = $tipo;
    } elseif ($categoria == 'mensal') {
        $grupo_mensal[] = $tipo;
    }
}

// Função que recebe a configuração de um serviço (preços) e devolve o texto do preço já formatado
function preco_teaser($cfg) {
    // Se o serviço for cobrado ao kg, mostramos o preço por Kg
    if ($cfg['mostrar_kg'] == true) {
       
        return number_format($cfg['preco_kg'], 2, ',', '.') . ' € /Kg';
    } else {
        // Caso contrário, mostramos o preço fixo
        return number_format($cfg['preco_fixo'], 2, ',', '.') . ' €';
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços - LavaFácil</title>
    <!-- Ficheiro CSS com os estilos desta página -->
    <link rel="stylesheet" href="css/servicos.css">
</head>
<body>

<!-- Cabeçalho / hero da página, com o nome da marca e o título -->
<header class="hero">
    <p class="hero-marca">LavaFácil</p>
    <h1>Os nossos Serviços</h1>
    <p class="hero-subtitulo">Escolhe o serviço que queres agendar — a preços claros, sem surpresas.</p>
</header>

<main class="wrapper">

    <!-- ===================== CATEGORIA: SERVIÇOS ===================== -->
    <?php if (count($grupo_servicos) > 0) { ?>
    <!-- Só mostra esta secção se houver pelo menos um serviço nesta categoria -->
    <section class="secao-categoria">
        <h2>Serviços</h2>
        <div class="grelha-servicos">
            <?php foreach ($grupo_servicos as $tipo) { ?>
                <!-- Cada serviço é um "cartão" clicável que leva à página de agendamento -->
                <a class="cartao-servico" href="agendar.php?id=<?php echo (int) $tipo['cod_tiposervico']; ?>">
                    <span class="icone-servico"><?php echo $tipo['icone']; ?></span>
                    <!-- htmlspecialchars protege contra código HTML/JS malicioso vindo da base de dados -->
                    <span class="nome-servico"><?php echo htmlspecialchars($tipo['descricao']); ?></span>

                    <!-- Só mostramos o preço se existir configuração de preço para este serviço -->
                    <?php if (isset($config[$tipo['cod_tiposervico']])) { ?>
                        <span class="preco-servico">desde <?php echo preco_teaser($config[$tipo['cod_tiposervico']]); ?></span>
                    <?php } ?>

                    <span class="seta-servico">Agendar &rarr;</span>
                </a>
            <?php } ?>
        </div>
    </section>
    <?php } ?>

    <!-- ===================== CATEGORIA: RECOLHA & ENTREGA ===================== -->
    <?php if (count($grupo_domicilio) > 0) { ?>
    <section class="secao-categoria">
        <h2>Recolha & Entrega</h2>
        <div class="grelha-servicos">
            <?php foreach ($grupo_domicilio as $tipo) { ?>
                <a class="cartao-servico" href="agendar.php?id=<?php echo (int) $tipo['cod_tiposervico']; ?>">
                    <span class="icone-servico"><?php echo $tipo['icone']; ?></span>
                    <span class="nome-servico"><?php echo htmlspecialchars($tipo['descricao']); ?></span>
                    <?php if (isset($config[$tipo['cod_tiposervico']])) { ?>
                        <span class="preco-servico">desde <?php echo preco_teaser($config[$tipo['cod_tiposervico']]); ?></span>
                    <?php } ?>
                    <span class="seta-servico">Agendar &rarr;</span>
                </a>
            <?php } ?>
        </div>
    </section>
    <?php } ?>

    <!-- ===================== CATEGORIA: PACKS ===================== -->
    <?php if (count($grupo_packs) > 0) { ?>
    <section class="secao-categoria">
        <h2>Packs</h2>
        <div class="grelha-servicos">
            <?php foreach ($grupo_packs as $tipo) { ?>
                <a class="cartao-servico" href="agendar.php?id=<?php echo (int) $tipo['cod_tiposervico']; ?>">
                    <span class="icone-servico"><?php echo $tipo['icone']; ?></span>
                    <span class="nome-servico"><?php echo htmlspecialchars($tipo['descricao']); ?></span>
                    <?php if (isset($config[$tipo['cod_tiposervico']])) { ?>
                        <span class="preco-servico">desde <?php echo preco_teaser($config[$tipo['cod_tiposervico']]); ?></span>
                    <?php } ?>
                    <span class="seta-servico">Agendar &rarr;</span>
                </a>
            <?php } ?>
        </div>
    </section>
    <?php } ?>

    <!-- ===================== CATEGORIA: PLANOS MENSAIS ===================== -->
    <?php if (count($grupo_mensal) > 0) { ?>
    <section class="secao-categoria">
        <h2>Planos mensais</h2>
        <div class="grelha-servicos">
            <?php foreach ($grupo_mensal as $tipo) { ?>
                <a class="cartao-servico" href="agendar.php?id=<?php echo (int) $tipo['cod_tiposervico']; ?>">
                    <span class="icone-servico"><?php echo $tipo['icone']; ?></span>
                    <span class="nome-servico"><?php echo htmlspecialchars($tipo['descricao']); ?></span>
                    <?php if (isset($config[$tipo['cod_tiposervico']])) { ?>
                        <span class="preco-servico">desde <?php echo preco_teaser($config[$tipo['cod_tiposervico']]); ?></span>
                    <?php } ?>
                    <span class="seta-servico">Agendar &rarr;</span>
                </a>
            <?php } ?>
        </div>
    </section>
    <?php } ?>

</main>

</body>
</html>