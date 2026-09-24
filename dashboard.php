<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

// 1. Inclui o teu ficheiro de ligação à Base de Dados nativo da LavaFácil
require_once 'conexao.php'; 

// 2. Chama o Controlador do calendário com o nome exato da tua estrutura MVC
require_once 'app/controllers/calendario.controller.php';

// 3. Instancia o controlador usando a ligação da tua base de dados ($pdo)
$controller = new calendarioController($pdo);

// 4. Vai buscar o array de meses processado e agrupado pelo teu Model/Controller
$calendario_anual = $controller->carregarDashboard();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LavaFácil – Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
 <?php include __DIR__ . '/layoutfrancisco/sidebar.php'; ?>


    <main class="content">

        <header class="topbar">
            <div>
                <h2>Bem-vindo, administrador! 👋</h2>
                <p>Aqui está o resumo geral do desempenho da LavaFácil.</p>
                <small class="text-muted" id="dataAtual"></small>
            </div>
            <button class="btn btn-light">
                <i class="fa fa-bell"></i>
            </button>
        </header>

        <!-- Cartões de Estado Financeiro -->
        <section class="row g-4">
            <div class="col-xl-4 col-md-6">
                <div class="stat-card stat-card--disponivel">
                    <div><h5>Disponível</h5></div>
                    <div class="icon blue"><i class="fa fa-chart-line"></i></div>
                    <div class="tooltip-detalhe">
                        <p>Caixa: <strong>1.401,50 €</strong></p>
                        <p>Banco: <strong>1.897,88 €</strong></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="stat-card stat-card--disponivel">
                    <div><h5>Contas a receber</h5></div>
                    <div class="icon blue"><i class="fa fa-chart-line"></i></div>
                    <div class="tooltip-detalhe">
                        <p>Clientes: <strong>0 €</strong></p>
                        <p>Outros: <strong>0 €</strong></p>
                        <p>IVA: <strong>0 €</strong></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="stat-card stat-card--disponivel">
                    <div><h5>Contas a pagar</h5></div>
                    <div class="icon blue"><i class="fa fa-chart-line"></i></div>
                    <div class="tooltip-detalhe">
                        <p>Fornecedores: <strong>8.465,45 €</strong></p>
                        <p>Empréstimos Obtidos: <strong>7.700,00 €</strong></p>
                        <p>Outros: <strong>0 €</strong></p>
                        <p>IVA: <strong>344,15 €</strong></p>
                        <p>SS: <strong>914,84 €</strong></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Secção de Gráficos Superiores -->
        <section class="row g-4 mt-2">
            <div class="col-lg-8">
                <div class="chart-box">
                    <h5><i class="fa fa-chart-column text-primary"></i> Faturação vs Gastos (Mês)</h5>
                    <div class="chart-wrapper"><canvas id="financeChart"></canvas></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="chart-box">
                    <h5><i class="fa fa-chart-pie text-success"></i> Distribuição de Serviços</h5>
                    <div class="chart-wrapper"><canvas id="serviceChart"></canvas></div>
                    <h6 class="text-muted d-block mt-2">Total: 1 245 serviços</h6>
                </div>
            </div>
        </section>

      

   <!-- Calendário Fiscal Otimizado por Trimestres -->
<div class="dashboard-card-fiscal mt-4">
    <div class="fiscal-header mb-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
        <div class="fiscal-header-title d-flex align-items-center gap-2">
          
            <div>
                <h2 class="m-0 h6 fw-bold text-dark">Calendário de Obrigações Fiscais 2026</h2>
                <p class="m-0 text-muted" style="font-size: 0.75rem;">Filtre por trimestre para uma gestão mais focada</p>
            </div>
        </div>

     <!-- 🎛️ BOTÕES DE FILTRO (Com chamadas diretas de função) -->
<div class="btn-group shadow-sm" role="group" aria-label="Filtro Trimestral">
    <button type="button" class="btn btn-sm btn-outline-primary btn-trimestre" onclick="filtrarTrimestre('t1', this)">1º Trim</button>
    <button type="button" class="btn btn-sm btn-outline-primary btn-trimestre" onclick="filtrarTrimestre('t2', this)">2º Trim</button>
    <button type="button" class="btn btn-sm btn-outline-primary btn-trimestre" onclick="filtrarTrimestre('t3', this)">3º Trim</button>
    <button type="button" class="btn btn-sm btn-outline-primary btn-trimestre" onclick="filtrarTrimestre('t4', this)">4º Trim</button>
    <button type="button" class="btn btn-sm btn-outline-primary btn-trimestre active" onclick="filtrarTrimestre('todos', this)">Todos</button>
</div>

    </div>

    <!-- Grelha de Conteúdo dos Meses -->
    <div class="row g-3">
        <?php foreach ($calendario_anual as $nomeMes => $tarefas): ?>
            <?php 
                // Define matematicamente a qual trimestre pertence cada mês do Excel
                $mesLimpo = trim($nomeMes);
                if (in_array($mesLimpo, ['Janeiro', 'Fevereiro', 'Março'])) $tGroup = 't1';
                elseif (in_array($mesLimpo, ['Abril', 'Maio', 'Junho'])) $tGroup = 't2';
                elseif (in_array($mesLimpo, ['Julho', 'Agosto', 'Setembro'])) $tGroup = 't3';
                else $tGroup = 't4';
            ?>
            
            <!-- col-md-4 garante que os 3 meses selecionados ficam perfeitamente lado a lado -->
            <div class="col-xl-4 col-md-6 col-12 fiscal-mes-bloco" data-grupo-trimestre="<?php echo $tGroup; ?>">
                <div class="fiscal-mes-card h-100">
                    <h4 class="fiscal-mes-titulo text-capitalize fw-bold mb-3"><?php echo htmlspecialchars($nomeMes); ?></h4>
                    
                    <div class="fiscal-lista-obrigacoes">
                        <?php foreach ($tarefas as $tarefa): ?>
                            <?php 
                                $isConcluido = (trim($tarefa['estado']) === 'Concluído');
                                $classeStatus = $isConcluido ? 'status-concluido' : 'status-por-cumprir';
                                $iconeStatus = $isConcluido 
                                    ? '<i class="fa-solid fa-circle-check icone-verde"></i>' 
                                    : '<i class="fa-solid fa-circle-exclamation icone-vermelho"></i>';
                            ?>
                            <div class="fiscal-item-linha" 
                                 data-id="<?php echo $tarefa['id']; ?>" 
                                 data-estado="<?php echo $tarefa['estado']; ?>">
                                
                                <div class="d-flex align-items-center overflow-hidden me-2">
                                    <span class="fiscal-dia-badge <?php echo $classeStatus; ?>">
                                        <?php echo sprintf("%02d", $tarefa['dia']); ?>
                                    </span>
                                    <span class="fiscal-texto-tarefa text-truncate">
                                        <?php echo htmlspecialchars($tarefa['obrigacao']); ?>
                                    </span>
                                </div>
                                
                                <span class="fiscal-icone-estado">
                                    <?php echo $iconeStatus; ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Legenda Minimalista -->
    <div class="fiscal-legenda-container mt-4 py-2 px-3 d-flex gap-3 justify-content-center" style="font-size: 0.75rem; background-color: #f8fafc; border-radius: 8px;">
        <div class="legenda-item"><i class="fa-solid fa-circle-check icone-verde"></i> Concluído</div>
        <div class="legenda-item"><i class="fa-solid fa-circle-exclamation icone-vermelho"></i> Por cumprir</div>
    </div>
</div>



    </main>

    <script src="public/assets/js/dashboard.js"></script>

    <!-- ⚡ Script de clique que liga a View ao teu Router/Ficheiro de atualização -->
    <script>
    function alternarEstadoFiscal(elemento) {
        const id = elemento.getAttribute('data-id');
        const estadoAtual = elemento.getAttribute('data-estado');
        const novoEstado = (estadoAtual === 'Concluído') ? 'Por cumprir' : 'Concluído';

        const dados = new URLSearchParams();
        dados.append('id', id);
        dados.append('estado', novoEstado);

        // Dispara o pedido assíncrono para o ficheiro ponte que chama o teu Controller
        fetch('atualizar_calendario.php', {
            method: 'POST',
            body: dados
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // O teu controller validou e atualizou no Model! Mudamos a cor dinamicamente na página
                elemento.setAttribute('data-estado', novoEstado);
                const badge = elemento.querySelector('.fiscal-dia-badge');
                
                if(novoEstado === 'Concluído') {
                    badge.classList.remove('status-por-cumprir');
                    badge.classList.add('status-concluido');
                } else {
                    badge.classList.remove('status-concluido');
                    badge.classList.add('status-por-cumprir');
                }
            } else {
                alert('Erro na validação do controlador.');
            }
        })
        .catch(error => console.error('Erro na requisição Fetch:', error));
    }
    </script>
</body>
</html>
