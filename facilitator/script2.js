function calculate() {
    const height = document.getElementById("height").value;
    const weight = document.getElementById("weight").value;
    const age = document.getElementById("age").value;
    const gender = document.getElementById("gender").value;
    const activity = document.getElementById("activity").value;
  
   
    
    // Calculate BMI
    const bmi = weight / ((height / 100) ** 2);
  
    // Calculate calorie intake
    let calories;
    if (gender === "male") {
      calories = 66 + (13.7 * weight) + (5 * height) - (6.8 * age);
    } else {
      calories = 655 + (9.6 * weight) + (1.8 * height) - (4.7 * age);
    }
    calories *= activity;
  
    // Determine BMI category
    var result = '';
    if (bmi < 18.5) {
      result = 'Underweight';
    } else if (18.5 <= bmi && bmi <= 24.9) {
      result = 'Normal';
    } else if (25 <= bmi && bmi <= 29.9) {
      result = 'Overweight';
    } else if (30 <= bmi && bmi <= 34.9) {
      result = 'Obese';
    } else if (35 <= bmi) {
      result = 'Extremely Obese';
    }
  
    // Display results
    const resultArea = document.getElementById("result");
    resultArea.innerHTML = `
      
      <p>BMI: <span id="bmi">${bmi.toFixed(2)}</span></p>
      <p>BMI CATEGORY: <span id="bmi-category">${result}</span></p>
      <p>CALORIE INTAKE: <span id="calories">${calories.toFixed(0)}</span> calories/day</p>
    `;
  } 