<?php
include 'dashboard.php';
?>
<!doctype html>
<html lang="en">
<head>
<script type="text/javascript">
     function preventBack(){window.history.forward()};
     setTimeout("preventBack()",0);
     window.onunload=function(){null;}
    </script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calorie Calculator</title>
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/bmi.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
    <style>
        .bmi-chart {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .bmi-range {
            flex: 1;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            text-align: center;
            opacity: 0.5;
            transition: opacity 0.3s, transform 0.3s;
        }
        .bmi-range.highlight {
            opacity: 1;
            transform: scale(1.05);
        }
        .underweight { background: linear-gradient(to right, #a0d3e8, #e6f9ff); }
        .healthy { background: linear-gradient(to right, #b2ffb2, #e6ffe6); }
        .overweight { background: linear-gradient(to right, #ffea00, #fff); color: black; }
        .obese { background: linear-gradient(to right, #ff7f7f, #ffcccc); }
        .underweight.highlight { background: #007BFF; }
        .healthy.highlight { background: #28A745; }
        .overweight.highlight { background: #FFC107; }
        .obese.highlight { background: #DC3545; }
    </style>
</head>
<body>

<main class="mt-4 pt-3"> 

    <div class="row">
            <div class="col-md-11 mb-3 ms-5">
                <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-calculator"></i> BODY MASS INDEX (BMI)</div>
                <div class="card-body">
                    <div class="row align-items-start">
                    <div class="col">
                        <div class="form-group">
                            <label for="height">Height (cm):</label>
                            <input class="form-control" type="number" id="height" required />
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight (kg):</label>
                            <input class="form-control" type="number" id="weight" required />
                        </div>
                    </div>

                    <div class="col">
                        <div class="row align-items-start">
                            <div class="col">
                                <div class="form-group">
                                    <label for="age">Age (years):</label>
                                    <input class="form-control" type="number" id="age" required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="gender">Sex:</label>
                                    <select id="gender" class="form-control" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="activity">Activity Level:</label>
                                <select id="activity" class="form-control" required>
                                    <option value="" disabled selected>Select</option>
                                    <option value="">Sedentary</option>
                                    <option value="">Lightly Active</option>
                                    <option value="">Moderately Active</option>
                                    <option value="">Very Active</option>
                                    <option value="">Extremely Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button onclick="calculateBMI()" class="btn btn-sm btn-primary"><i class="bi bi-calculator-fill"></i> Calculate</button>
                        <div id="result"></div>
                        </div>
                    </div>
                    
                    <div id="bmiChart" class="bmi-chart" style="display:none;">
                        <div class="bmi-range underweight">Underweight<br>(BMI < 18.5)</div>
                        <div class="bmi-range healthy">Healthy<br>(18.5 ≤ BMI < 24.9)</div>
                        <div class="bmi-range overweight">Overweight<br>(25 ≤ BMI < 29.9)</div>
                        <div class="bmi-range obese">Obese<br>(BMI ≥ 30)</div>
                    </div>

                </div>
            </div>
    </div>
    

    <script>
    function calculateBMI() {
        const height = parseFloat(document.getElementById('height').value);
        const weight = parseFloat(document.getElementById('weight').value);
        const age = parseInt(document.getElementById('age').value);
        const gender = document.getElementById('gender').value;
        const activityLevel = parseFloat(document.getElementById('activity').value);
        let resultText = '';

        // Reset highlight
        const ranges = document.querySelectorAll('.bmi-range');
        ranges.forEach(range => {
            range.classList.remove('highlight');
        });

        if (height > 0 && weight > 0 && age > 0) {
            const bmi = weight / ((height / 100) ** 2);
            let category = '';

            if (bmi < 18.5) {
                category = 'Underweight';
                ranges[0].classList.add('highlight');
            } else if (bmi < 24.9) {
                category = 'Healthy weight';
                ranges[1].classList.add('highlight');
            } else if (bmi < 29.9) {
                category = 'Overweight';
                ranges[2].classList.add('highlight');
            } else {
                category = 'Obese';
                ranges[3].classList.add('highlight');
            }

            resultText = `Your BMI is: ${bmi.toFixed(2)}<br>You are classified as: ${category}`;
            document.getElementById('bmiChart').style.display = 'flex';

            // Calculate BMR based on gender
            let bmr;
            if (gender === 'male') {
                bmr = 10 * weight + 6.25 * height - 5 * age + 5; // BMR for males
            } else if (gender === 'female') {
                bmr = 10 * weight + 6.25 * height - 5 * age - 161; // BMR for females
            } else {
                resultText += '<br>Please select a gender.';
                document.getElementById('result').innerHTML = resultText;
                return;
            }

        
        } else {
            resultText = 'Please enter valid height, weight, and age.';
        }

        document.getElementById('result').innerHTML = resultText;
    }
</script>

    <script src="./script2.js"></script>  
      </body>
</html>