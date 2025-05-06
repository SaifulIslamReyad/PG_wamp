
document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll(".appointment-filters .button");
    const todayBtn = document.getElementById("todayBtn");

  // Set "Today's Appointments" as active by default
  todayBtn.classList.add("active");

  buttons.forEach(button => {
    button.addEventListener("click", function () {
      buttons.forEach(btn => btn.classList.remove("active"));
      this.classList.add("active");
    });
  });


    const appointmentsList = document.getElementById("appointmentsList");
    // const todayBtn = document.getElementById("todayBtn");
    const allBtn = document.getElementById("allBtn");
    const datePicker = document.getElementById("datePicker");

    let allAppointments = [];

    function renderAppointments(data) {
        appointmentsList.innerHTML = "";

        if (data.length === 0) {
            const row = document.createElement("tr");
            const cell = document.createElement("td");
            cell.colSpan = 5;
            cell.textContent = "No appointments available.";
            cell.style.textAlign = "center";
            row.appendChild(cell);
            appointmentsList.appendChild(row);
            return;
        }

        let lastDate = "";

        data.forEach((appointment, index) => {
            const dateObj = new Date(appointment.appointment_date);
            const appointmentDate = `${String(dateObj.getDate()).padStart(2, '0')}-${String(dateObj.getMonth() + 1).padStart(2, '0')}-${dateObj.getFullYear()}`;
            if (lastDate !== appointmentDate) {
                lastDate = appointmentDate;
                const dateRow = document.createElement("tr");
                const dateCell = document.createElement("td");
                dateCell.colSpan = 5;
                dateCell.style.textAlign = "center";
                dateCell.style.fontWeight = "bold";
                dateCell.textContent = `Appointments for ${appointmentDate}`;
                dateRow.appendChild(dateCell);
                appointmentsList.appendChild(dateRow);
            }

            const row = document.createElement("tr");
            row.style.cursor = "pointer";
            row.onclick = function () {
                window.location.href = `prescription.php?appointment_no=${appointment.appointment_no}`;
            };

            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${appointment.patient_name}</td>
                <td>${appointment.patient_phone}</td>
                <td>${appointment.problem}</td>
                <td>${appointment.status}</td>
            `;
            appointmentsList.appendChild(row);
        });
    }

    function filterTodayAppointments() {
        const todayStr = new Date().toLocaleDateString();
        const filtered = allAppointments.filter(a => {
            const date = new Date(a.appointment_date).toLocaleDateString();
            return date === todayStr;
        });
        renderAppointments(filtered);
    }

    function filterByDate(selectedDate) {
        const targetDate = new Date(selectedDate).toLocaleDateString();
        const filtered = allAppointments.filter(a => {
            const date = new Date(a.appointment_date).toLocaleDateString();
            return date === targetDate;
        });
        renderAppointments(filtered);
    }

    // Initial data fetch
    fetch("get_appointments.php")
        .then((response) => response.json())
        .then((data) => {
            allAppointments = data;
            filterTodayAppointments(); // Show today's appointments by default
        })
        .catch((error) => {
            console.error("Error fetching data:", error);
        });

    // Button event listeners
    todayBtn.addEventListener("click", filterTodayAppointments);

    allBtn.addEventListener("click", () => renderAppointments(allAppointments));

    datePicker.addEventListener("change", () => {
        if (datePicker.value) {
            filterByDate(datePicker.value);
        }
    });
});




