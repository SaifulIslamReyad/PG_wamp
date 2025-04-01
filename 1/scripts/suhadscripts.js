document.addEventListener("DOMContentLoaded", () => {
  const addMedicineBtn = document.getElementById("add-medicine-btn");
  const medicineList = document.getElementById("medicine-list");

  const dateInput = document.getElementById("date");
  dateInput.value = new Date().toISOString().split("T")[0];


  addMedicineBtn.addEventListener("click", () => {
    fetch("addmedi.html")
      .then((response) => response.text())
      .then((html) => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, "text/html");
        const medicineEntry = doc.querySelector(".medicine-entry");

        const uniqueId = Date.now();
        medicineEntry
          .querySelectorAll('.radio-group input[type="radio"]')
          .forEach((radio) => {
            radio.name = `time-${uniqueId}`;
          });

        medicineEntry.querySelector("button").addEventListener("click", () => {
          medicineEntry.remove();
        });

        medicineList.appendChild(medicineEntry);
      })
      .catch((error) => console.error("Error loading addmedi.html:", error));
  });
});
