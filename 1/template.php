<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chief Complaint Selector</title>
    <style>
        .temp{
            display: flex;
        }
        .symptom {
            padding: 10px;
            margin: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            width: fit-content;
        }

        .symptom:hover {
            background-color: #e0eaff;
        }


        #cc-input {
            display: block;
            margin-top: 20px;
            padding: 10px;
            width: 300px;
            font-size: 16px;
        }
        .text{
            padding: 12px;
            font-size : large;
            font-weight:bold;
        }
        .symptom.active {
            background-color: #a8d0ff;
            color: white;
            font-weight: bold;
            border-color: #3399ff;
        }

    </style>
</head>
<body>

    <!-- Symptom selection -->
     <div class="temp"> 
        <div class="text">Templates :  </div>
        <div class="symptom" onclick="setCC('Fever')">Fever</div>
        <div class="symptom" onclick="setCC('Pain and swelling')">Pain & swelling</div>
        <div class="symptom" onclick="setCC('Pericoronitis')">Pericoronitis</div>
     </div>

<script>
function setCC(text) {
    // Set CC input value
    document.getElementById('cc-input').value = text;

    // Remove 'active' from all and add to clicked one
    const symptoms = document.querySelectorAll('.symptom');
    symptoms.forEach(symptom => symptom.classList.remove('active'));
    event.target.classList.add('active');

    // Fill investigation and treatment
    document.getElementById('investigation-extra').value = "xray";
    document.getElementById('treatment-extra').value = "extruction";

    // Simulate click on "Add Medicine" button
    document.getElementById('add-medicine').click();

    // Wait a bit for new medicine fields to appear, then fill them
    setTimeout(() => {
        const medInput = document.querySelector('.medicine-input');
        const morningCheckbox = document.querySelector('.morning');
        const nightCheckbox = document.querySelector('.night');
        const eatWhenPainCheckbox = document.querySelector('.eat-when-pain');
        const daysInput = document.querySelector('.days-input');

        if (medInput) medInput.value = "Amoxicillin 500mg (tablet)";
        if (morningCheckbox) morningCheckbox.checked = true;
        if (nightCheckbox) nightCheckbox.checked = true;
        if (eatWhenPainCheckbox) eatWhenPainCheckbox.checked = true;
        if (daysInput) daysInput.value = "7";
    }, 500); // Adjust delay if needed
}

</script>

</body>
</html>
