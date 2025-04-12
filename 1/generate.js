function getDosageValue(entry) {
  const dosageCheckboxes = entry.querySelectorAll(
    ".checkbox-group input[name='time']"
  );
  const values = Array.from(dosageCheckboxes).map((checkbox) =>
    checkbox.checked ? "1" : "0"
  );
  return values.join("+");
}

function convertToBengaliNumerals(number) {
  const bengaliNumerals = "০১২৩৪৫৬৭৮৯";
  return number
    .toString()
    .split("")
    .map((digit) => bengaliNumerals[digit] || digit)
    .join("");
}

function generatePrescription() {
  const appointmentNo = new URLSearchParams(window.location.search).get("appointment_no");

  const name = document.getElementById("name").value;
  const age = document.getElementById("age").value;
  const sex = document.getElementById("sex").value;
  const date = document.getElementById("date").value;
  const cc = document.getElementById("cc-input").value;

  const medicineEntries = document.getElementsByClassName("medicine-entry");

  const medicines = Array.from(medicineEntries).map((entry, index) => {
    const medicineName = entry.querySelector("input[name='medicine']").value;
    const dosage = getDosageValue(entry);
    const beforeEating = entry.querySelector("input[name='before-eating']").checked
      ? "---খাওয়ার আগে---"
      : "";
    const afterEating = entry.querySelector("input[name='after-eating']").checked
      ? "---খাওয়ার পরে---"
      : "";
    const eatingTime = beforeEating ? beforeEating : afterEating;
    const days = convertToBengaliNumerals(entry.querySelector("input[name='days']").value);
    const eatWhenPain = entry.querySelector("input[name='eat-when-pain']").checked
      ? "\nব্যাথা হলে খাবেন"
      : "";

    return `${
      index + 1
    }. ${medicineName}\n${dosage} ${eatingTime} ${days} দিন${eatWhenPain}`;
  });

  // Gather extra investigation and treatment details
  const investigationExtra = document.getElementById("investigation-extra").value;
  const treatmentExtra = document.getElementById("treatment-extra").value;

  // Gather investigation details
  const investigationInputs = document.querySelectorAll(".investigation-box input");
  const investigationData = Array.from(investigationInputs)
    .map((input) => input.value)
    .join(" | ");

  // Gather treatment details
  const treatmentInputs = document.querySelectorAll(".treatment-box input");
  const treatmentData = Array.from(treatmentInputs)
    .map((input) => input.value)
    .join(" | ");

  // Open a new window for printing
  const printWindow = window.open("print.html", "", "width=800,height=600");
  printWindow.onload = () => {
    printWindow.document.querySelector(".name").textContent = name;
    printWindow.document.querySelector(".age").textContent = age;
    printWindow.document.querySelector(".sex").textContent = sex;
    printWindow.document.querySelector(".date").textContent = new Date(date).toLocaleDateString("en-GB");
    printWindow.document.querySelector(".cc").textContent = cc;
    printWindow.document.querySelector(".medicines").innerHTML = medicines
      .map((med) => `<div style="white-space: pre-line;">${med}</div>`)
      .join("");

    // Add extra investigation and treatment data to the print window
    printWindow.document.querySelector(".investigation-extra").textContent = investigationExtra;
    printWindow.document.querySelector(".treatment-extra").textContent = treatmentExtra;

    // Fill investigation quadrants
    const investigationQuadrants = printWindow.document.querySelectorAll(".investigation .quadrant");
    investigationQuadrants[0].textContent = investigationInputs[0].value || "";
    investigationQuadrants[1].textContent = investigationInputs[1].value || "";
    investigationQuadrants[2].textContent = investigationInputs[2].value || "";
    investigationQuadrants[3].textContent = investigationInputs[3].value || "";

    // Fill treatment quadrants
    const treatmentQuadrants = printWindow.document.querySelectorAll(".treatment .quadrant");
    treatmentQuadrants[0].textContent = treatmentInputs[0].value || "";
    treatmentQuadrants[1].textContent = treatmentInputs[1].value || "";
    treatmentQuadrants[2].textContent = treatmentInputs[2].value || "";
    treatmentQuadrants[3].textContent = treatmentInputs[3].value || "";

    printWindow.print();
  };

  // Prepare data for sending to PHP
  const today = new Date().toISOString().split("T")[0];

  const medicineData = Array.from(medicineEntries).map((medicineEntry) => {
    const name = medicineEntry.querySelector("input[name='medicine']").value;
    const duration = medicineEntry.querySelector("input[name='days']").value;
    const before = medicineEntry.querySelector("input[name='before-eating']").checked;
    const after = medicineEntry.querySelector("input[name='after-eating']").checked;

    let beforeAfter = "After Meal"; // Default value
    if (before && !after) {
      beforeAfter = "Before Meal";
    } else if (!before && after) {
      beforeAfter = "After Meal";
    } else if (before && after) {
      beforeAfter = "Before & After Meal";
    }

    return {
      name,
      dosage: getDosageValue(medicineEntry),
      before_after: beforeAfter,
      duration,
    };
  });

  const dataToSend = {
    appointment_no: appointmentNo,
    issued_date: today, // Use today's date
    medicines: medicineData,
    cc : cc 
  };

  fetch("save_prescription.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(dataToSend),
  })
  .then((response) => response.text())
  .then((result) => {
    // console.log(result);
    if (result.trim() === "success") {
      alert("Successfully saved prescription");
      window.location.assign("./dashboard.html");
    } else {
      alert("Something went wrong");
    }
  })
  .catch((error) => {
    console.error("Error:", error);
    alert("An error occurred while saving the prescription.");
  });
}
