<?php
// ==========================================================================
// ROTA ASSÍNCRONA PARA ATUALIZAÇÃO DO ESTADO FISCAL (LAVAFÁCIL)
// ==========================================================================

// 1. Inclui a ligação nativa à Base de Dados ($pdo)
require_once 'conexao.php'; 

// 2. Inclui o controlador profissional do calendário
require_once 'app/controllers/calendario.controller.php';

// 3. Instancia o controlador passando a ligação PDO ativa
$controller = new CalendarioController($pdo);

// 4. Executa o método assíncrono que já está programado e responde em JSON
$controller->processarAtualizacao();
