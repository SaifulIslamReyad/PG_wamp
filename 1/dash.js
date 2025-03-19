document.addEventListener("DOMContentLoaded", function() {
    // Fetch appointments data from the PHP file
    fetch('get_appointments.php')
        .then(response => response.json())
        .then(data => {
            const appointmentsList = document.getElementById('appointmentsList');
            
            // If there are appointments
            if (data.length > 0) {
                let lastDate = '';
                
                data.forEach((appointment, index) => {
                    const appointmentDate = new Date(appointment.appointment_date).toLocaleDateString();
                    
                    // Check if the date has changed to group appointments by date
                    if (lastDate !== appointmentDate) {
                        lastDate = appointmentDate;
                        
                        // Create a new row for the date
                        const dateRow = document.createElement('tr');
                        const dateCell = document.createElement('td');
                        dateCell.colSpan = 5;
                        dateCell.style.textAlign = 'center';
                        dateCell.style.fontWeight = 'bold';
                        dateCell.textContent = `Appointments for ${appointmentDate}`;
                        dateRow.appendChild(dateCell);
                        appointmentsList.appendChild(dateRow);
                    }

                    // Create a clickable row for the appointment
                    const row = document.createElement('tr');
                    row.style.cursor = 'pointer';
                    row.onclick = function() {
                        // Redirect to the appointment details page with appointment_no
                        window.location.href = `appointment_details.php?appointment_no=${appointment.appointment_no}`;
                    };

                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${appointment.patient_name}</td>
                        <td>${appointment.phone}</td>
                        <td>${appointment.problem}</td>
                        <td>${appointment.status}</td>
                    `;
                    appointmentsList.appendChild(row);
                });
            } else {
                // No appointments message
                const row = document.createElement('tr');
                const cell = document.createElement('td');
                cell.colSpan = 5;
                cell.textContent = "No appointments available.";
                cell.style.textAlign = 'center';
                row.appendChild(cell);
                appointmentsList.appendChild(row);
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});
