// Mostrar valor do pagamento
document.getElementById("valorPagar").innerText =
    sessionStorage.getItem("precoTotal") + "€";

// Mostrar formulário MBWay
function mostrarMBWay() {
    document.getElementById("formMBWay").classList.remove("oculto");
    document.getElementById("formCartao").classList.add("oculto");
}

// Mostrar formulário Cartão
function mostrarCartao() {
    document.getElementById("formCartao").classList.remove("oculto");
    document.getElementById("formMBWay").classList.add("oculto");
}

// Simulação MBWay
function pagarMBWay() {
    const numero = document.getElementById("mbwayNumero").value;
    const status = document.getElementById("mbwayStatus");

    if (numero.length !== 9) {
        status.style.color = "red";
        status.innerText = "Número inválido.";
        return;
    }

    status.style.color = "#2980b9";
    status.innerText = "A enviar pedido MBWay...";

    setTimeout(() => {
        status.style.color = "#27ae60";
        status.innerText = "Pagamento MBWay concluído!";
        setTimeout(() => {
            window.location.href = "sucessopagamento.html";
        }, 1500);
    }, 2000);
}

// Simulação Cartão
function pagarCartao() {
    const numero = document.getElementById("cartaoNumero").value;
    const validade = document.getElementById("cartaoValidade").value;
    const cvv = document.getElementById("cartaoCVV").value;
    const status = document.getElementById("cartaoStatus");

    if (numero.length < 16 || cvv.length !== 3 || validade.length < 4) {
        status.style.color = "red";
        status.innerText = "Dados do cartão inválidos.";
        return;
    }

    status.style.color = "#2980b9";
    status.innerText = "A processar pagamento...";

    setTimeout(() => {
        status.style.color = "#27ae60";
        status.innerText = "Pagamento com cartão concluído!";
        setTimeout(() => {
            window.location.href = "sucessopagamento.html";
        }, 1500);
    }, 2000);
}

document.addEventListener("DOMContentLoaded", function() {
    // Tenta ler do localStorage ou do sessionStorage
    const valor = localStorage.getItem("valorPagamento") || sessionStorage.getItem("precoTotal") || "0.00€";
    
    const elemValor = document.getElementById("valorPagar");
    if (elemValor) {
        elemValor.innerText = valor;
    }
});