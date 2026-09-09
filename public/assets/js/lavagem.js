function calcularEObterPreco() {
    const kg = parseFloat(document.getElementById("kg")?.value) || 0;
    const tipo = document.getElementById("tipoRoupa")?.value || "";
    const extras = document.getElementById("extras")?.value || "";
    const recolha = document.getElementById("recolha")?.value || "";
    const entrega = document.getElementById("entrega")?.value || "";
    const data = document.getElementById("dataServico")?.value || "";
    const hora = document.getElementById("horaServico")?.value || "";

    let preco = kg * 1.5;

    if (extras.includes("Perfume")) preco += 1;
    if (extras.includes("Dobrar")) preco += 1;
    if (extras.includes("Urgente")) preco += 3;

    if (recolha.includes("Casa")) preco += 2;
    if (entrega.includes("Casa")) preco += 2;

    const precoFormatado = preco.toFixed(2) + "€";

    localStorage.setItem("valorPagamento", precoFormatado);
    sessionStorage.setItem("precoTotal", precoFormatado);

    return { kg, tipo, extras, recolha, entrega, data, hora, precoFormatado };
}

function atualizarPrecoAutomatico() {
    const dados = calcularEObterPreco();
    document.getElementById("precoTotal").innerText = dados.precoFormatado;
}

document.getElementById("kg").addEventListener("input", atualizarPrecoAutomatico);
document.getElementById("extras").addEventListener("change", atualizarPrecoAutomatico);
document.getElementById("recolha").addEventListener("change", atualizarPrecoAutomatico);
document.getElementById("entrega").addEventListener("change", atualizarPrecoAutomatico);
document.getElementById("horaServico").addEventListener("change", atualizarPrecoAutomatico);
document.getElementById("dataServico").addEventListener("change", atualizarPrecoAutomatico);

function mostrarResumo() {
    const dados = calcularEObterPreco();

    document.getElementById("rKg").innerText = dados.kg + " Kg";
    document.getElementById("rTipo").innerText = dados.tipo;
    document.getElementById("rExtras").innerText = dados.extras;
    document.getElementById("rRecolha").innerText = dados.recolha;
    document.getElementById("rEntrega").innerText = dados.entrega;
    document.getElementById("rData").innerText = dados.data;
    document.getElementById("rHora").innerText = dados.hora;
    document.getElementById("rPreco").innerText = dados.precoFormatado;

    document.getElementById("resumo").classList.add("mostrar");
}

function irParaPagamentoLoja() {
    calcularEObterPreco();
    window.location.href = 'confirmacaoloja.html';
}

function irParaPagamentoOnline() {
    calcularEObterPreco();
    window.location.href = 'metodosdepagamento.html';
}

sessionStorage.setItem("kg", kg);
sessionStorage.setItem("tipoRoupa", tipo);
sessionStorage.setItem("extras", extras);
sessionStorage.setItem("recolha", recolha);
sessionStorage.setItem("entrega", entrega);
sessionStorage.setItem("dataServico", data);
sessionStorage.setItem("horaServico", hora);