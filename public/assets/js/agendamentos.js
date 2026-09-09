document.addEventListener("DOMContentLoaded", () => {

    // =========================
    // ELEMENTOS DO HTML
    // =========================

    const calendar = document.getElementById("calendar");
    const monthYear = document.getElementById("monthYear");
    const miniCalendar = document.getElementById("miniCalendar");
    const miniMonth = document.getElementById("miniMonth");
    const listContainer = document.getElementById("listContainer");

    // =========================
    // DADOS
    // =========================

    let currentDate = new Date(2026, 7, 1);
    let selectedAppointment = null;

    const appointments = [
        {
            id: 1,
            date: "2026-08-19",
            time: "09:00",
            client: "João Silva",
            service: "Lavagem",
            worker: "João",
            weight: 5,
            price: 10,
            status: "agendado"
        },
        {
            id: 2,
            date: "2026-08-19",
            time: "11:00",
            client: "Maria Costa",
            service: "Lavagem + Secagem",
            worker: "Maria",
            weight: 8,
            price: 18,
            status: "preparacao"
        },
        {
            id: 3,
            date: "2026-08-21",
            time: "15:00",
            client: "Ana Pereira",
            service: "Engomadoria",
            worker: "João",
            weight: 4,
            price: 13,
            status: "concluido"
        },
        {
            id: 4,
            date: "2026-08-25",
            time: "10:30",
            client: "Pedro Santos",
            service: "Recolha",
            worker: "Maria",
            weight: 3,
            price: 8,
            status: "cancelado"
        },
        {
            id: 5,
            date: "2026-08-27",
            time: "09:30",
            client: "Rita Alves",
            service: "Lavagem",
            worker: "João",
            weight: 6,
            price: 12,
            status: "agendado"
        }
    ];


    // =========================
    // DATA
    // =========================

    function getDate(year, month, day) {
        return `${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;
    }


    function getMonthName() {
        return currentDate.toLocaleDateString("pt-PT", {
            month: "long",
            year: "numeric"
        });
    }


    // =========================
    // FILTROS
    // =========================

    function getAppointments() {

        const service = document.getElementById("serviceFilter").value;
        const status = document.getElementById("statusFilter").value;
        const worker = document.getElementById("workerFilter").value;

        return appointments.filter(a => {

            if (service && a.service !== service) return false;
            if (status && a.status !== status) return false;
            if (worker && a.worker !== worker) return false;

            return true;
        });
    }


    // =========================
    // COR DO AGENDAMENTO
    // =========================

    function getEventColor(status) {

        if (status === "agendado") return "orange";
        if (status === "preparacao") return "blue";
        if (status === "concluido") return "green";
        if (status === "cancelado") return "red";

        return "";
    }


    // =========================
    // CALENDÁRIO
    // =========================

    function renderCalendar() {

        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        const firstDay =
            (new Date(year, month, 1).getDay() + 6) % 7;

        const daysInMonth =
            new Date(year, month + 1, 0).getDate();

        // Nome do mês
        monthYear.textContent =
            getMonthName().replace(/^./, x => x.toUpperCase());

        // Limpar calendário
        calendar.innerHTML = "";


        // Espaços antes do dia 1
        for (let i = 0; i < firstDay; i++) {
            calendar.innerHTML += `<div class="day empty"></div>`;
        }


        // Criar dias
        for (let day = 1; day <= daysInMonth; day++) {

            const date = getDate(year, month, day);

            const dayBox = document.createElement("div");

            dayBox.className = "day";

            dayBox.innerHTML =
                `<div class="day-number">${day}</div>`;


            // Procurar marcações desse dia
            const dayAppointments =
                getAppointments().filter(a => a.date === date);


            // Mostrar marcações
            dayAppointments.forEach(a => {

                const event = document.createElement("div");

                event.className =
                    `event ${getEventColor(a.status)}`;

                event.innerHTML =
                    `<strong>${a.time}</strong> ${a.service}`;

                event.onclick = (e) => {

                    e.stopPropagation();

                    showDetails(a);
                };

                dayBox.appendChild(event);
            });


            // Clicar no dia
            dayBox.onclick = () => {
                openNewAppointment(date);
            };


            calendar.appendChild(dayBox);
        }


        // Atualizar outras partes
        renderMiniCalendar();
        updateSummary();
        renderList();
    }


    // =========================
    // MINI CALENDÁRIO
    // =========================

    function renderMiniCalendar() {

        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        const firstDay =
            (new Date(year, month, 1).getDay() + 6) % 7;

        const days =
            new Date(year, month + 1, 0).getDate();

        miniMonth.textContent =
            getMonthName().replace(/^./, x => x.toUpperCase());

        miniCalendar.innerHTML = "";


        // Espaços
        for (let i = 0; i < firstDay; i++) {
            miniCalendar.innerHTML += `<span></span>`;
        }


        // Dias
        for (let day = 1; day <= days; day++) {

            const date = getDate(year, month, day);

            const button = document.createElement("span");

            button.textContent = day;


            // Dia selecionado
            if (selectedAppointment?.date === date) {
                button.classList.add("sel");
            }


            button.onclick = () => {

                openNewAppointment(date);
            };


            miniCalendar.appendChild(button);
        }
    }


    // =========================
    // RESUMO
    // =========================

    function updateSummary() {

        const data = getAppointments();

        document.getElementById("totalCount").textContent =
            data.length;

        document.getElementById("doneCount").textContent =
            data.filter(a => a.status === "concluido").length;

        document.getElementById("prepCount").textContent =
            data.filter(a => a.status === "preparacao").length;

        document.getElementById("cancelCount").textContent =
            data.filter(a => a.status === "cancelado").length;


        const total = data
            .filter(a => a.status !== "cancelado")
            .reduce((sum, a) => sum + Number(a.price), 0);


        document.getElementById("totalValue").textContent =
            total.toLocaleString("pt-PT", {
                minimumFractionDigits: 2
            }) + " €";
    }


    // =========================
    // DETALHES
    // =========================

    function showDetails(appointment) {

        selectedAppointment = appointment;

        const details = document.getElementById("details");

        if (!details) {
            alert(
                `${appointment.client}\n` +
                `${appointment.service}\n` +
                `${appointment.date} às ${appointment.time}\n` +
                `${appointment.price} €`
            );

            return;
        }


        details.innerHTML = `
            <p><strong>Cliente:</strong> ${appointment.client}</p>
            <p><strong>Data:</strong> ${appointment.date}</p>
            <p><strong>Hora:</strong> ${appointment.time}</p>
            <p><strong>Serviço:</strong> ${appointment.service}</p>
            <p><strong>Colaborador:</strong> ${appointment.worker}</p>
            <p><strong>Peso:</strong> ${appointment.weight} kg</p>
            <p><strong>Preço:</strong> ${appointment.price.toFixed(2)} €</p>
            <p><strong>Estado:</strong> ${appointment.status}</p>
        `;


        new bootstrap.Modal(
            document.getElementById("detailsModal")
        ).show();
    }


    // =========================
    // NOVO AGENDAMENTO
    // =========================

    function openNewAppointment(date) {

        const dateInput = document.getElementById("date");

        if (dateInput) {
            dateInput.value = date;
        }


        const modal =
            document.getElementById("appointmentModal");

        if (modal) {
            new bootstrap.Modal(modal).show();
        }
    }


    // =========================
    // MUDAR MÊS
    // =========================

    function changeMonth(value) {

        currentDate.setMonth(
            currentDate.getMonth() + value
        );

        renderCalendar();
    }


    document.getElementById("prevMonth").onclick =
        () => changeMonth(-1);

    document.getElementById("nextMonth").onclick =
        () => changeMonth(1);

    document.getElementById("miniPrev").onclick =
        () => changeMonth(-1);

    document.getElementById("miniNext").onclick =
        () => changeMonth(1);


    // =========================
    // BOTÃO HOJE
    // =========================

    document.getElementById("todayBtn").onclick = () => {

        currentDate = new Date();

        renderCalendar();
    };


    // =========================
    // FILTROS
    // =========================

    document.getElementById("serviceFilter").onchange =
    document.getElementById("statusFilter").onchange =
    document.getElementById("workerFilter").onchange =
        renderCalendar;


    // =========================
    // VISTA CALENDÁRIO
    // =========================

    document.getElementById("calendarView").onclick = () => {

        calendar.classList.remove("hidden");

        document
            .querySelector(".weekdays")
            .classList.remove("hidden");

        listContainer.classList.add("hidden");

        document
            .getElementById("calendarView")
            .classList.add("active");

        document
            .getElementById("listView")
            .classList.remove("active");
    };


    // =========================
    // VISTA LISTA
    // =========================

    document.getElementById("listView").onclick = () => {

        calendar.classList.add("hidden");

        document
            .querySelector(".weekdays")
            .classList.add("hidden");

        listContainer.classList.remove("hidden");

        document
            .getElementById("listView")
            .classList.add("active");

        document
            .getElementById("calendarView")
            .classList.remove("active");

        renderList();
    };


    // =========================
    // CRIAR LISTA
    // =========================

    function renderList() {

        const data = getAppointments();

        listContainer.innerHTML = data.map(a => `

            <div class="list-row">

                <strong>${a.date}</strong>

                <div>
                    <strong>${a.client}</strong>
                    <small>${a.service}</small>
                </div>

                <span>${a.time}</span>

                <span class="status">
                    ${a.status}
                </span>

                <strong>${a.price.toFixed(2)} €</strong>

            </div>

        `).join("");
    }


    // =========================
    // NOVO AGENDAMENTO
    // =========================

    document.getElementById("newBtn").onclick = () => {

        const date = getDate(
            currentDate.getFullYear(),
            currentDate.getMonth(),
            1
        );

        openNewAppointment(date);
    };


    // =========================
    // AJUSTAR PESO
    // =========================

    document.getElementById("weightBtn").onclick = () => {

        if (!selectedAppointment) {
            alert("Selecione primeiro um agendamento.");
            return;
        }

        const weight = prompt(
            "Peso real (kg):",
            selectedAppointment.weight
        );

        if (weight !== null) {
            selectedAppointment.weight = Number(weight);
            renderCalendar();
        }
    };


    // =========================
    // AJUSTAR PREÇO
    // =========================

    document.getElementById("priceBtn").onclick = () => {

        if (!selectedAppointment) {
            alert("Selecione primeiro um agendamento.");
            return;
        }

        const price = prompt(
            "Preço final (€):",
            selectedAppointment.price
        );

        if (price !== null) {
            selectedAppointment.price = Number(price);
            renderCalendar();
        }
    };


    // =========================
    // COMEÇAR
    // =========================

    renderCalendar();

});