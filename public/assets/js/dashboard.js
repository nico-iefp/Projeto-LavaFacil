// =============================
// Faturação vs Gastos (Mês)
// =============================
new Chart(document.getElementById('financeChart'), {
    type: 'bar',
    data: {
        labels: ['Trimestre'],
        datasets: [
            {
                label: 'Faturação (€)',
                data: [15963.30],
                backgroundColor: '#0d6efd',
                borderRadius: 8,
                barPercentage: 0.5,
                categoryPercentage: 0.4
            },
            {
                label: 'Gastos (€)',
                data: [11141.66],
                backgroundColor: '#22c55e',
                borderRadius: 8,
                barPercentage: 0.5,
                categoryPercentage: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: { ticks: { font: { size: 18 } } },
            y: { ticks: { font: { size: 14 } } }
        },
        plugins: {
            legend: {
                position: 'bottom',
                labels: { font: { size: 15 } }
            }
        }
    }
});

// =============================
// Distribuição de Serviços
// =============================
new Chart(document.getElementById('serviceChart'), {
    type: 'doughnut',
    data: {
        labels: ['Lavagem','Secagem','Engomadoria','Entrega em casa','Recolha em casa','Outros (Packs)'],
        datasets: [{
            data: [980,1110,907,767,543,507],
            backgroundColor: ['#0d6efd','#22c55e','#f59e0b','#7c3aed','#ef4444','#a79999']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom' } }
    }
});

// =============================
// Gastos por Categoria
// =============================
new Chart(document.getElementById('expenseChart'), {
    type: 'pie',
    data: {
        labels: ['Salários','Produtos','Serviços Externos','Utilidades','Outros'],
        datasets: [{
            data: [35.4,28.1,15.8,10.5,10.2],
            backgroundColor: ['#0d6efd','#22c55e','#f59e0b','#7c3aed','#ef4444']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom' } }
    }
});

// =============================
// Projeções de Faturação
// =============================
new Chart(document.getElementById('projectionChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Fev','Mar','Abr','Mai','Jun'],
        datasets: [
            {
                label: 'Real (€)',
                data: [266980, 607830, 721520, 25000, 27000, 29000],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,.15)',
                tension: .4,
                fill: true,
                pointRadius: 4
            },
            {
                label: 'Projeção (€)',
                data: [19000, 22000, 24500, 27000, 29500, 32000],
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34,197,94,.2)',
                tension: .4,
                fill: true,
                pointRadius: 4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom' } }
    }
});

// =============================
// Toggle User Menu
// =============================
const toggle = document.getElementById("userToggle");
const menu = document.getElementById("userDropdown");

toggle.addEventListener("click", () => {
    menu.classList.toggle("show");
});

document.addEventListener("click", (e) => {
    if (!toggle.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.remove("show");
    }
});
