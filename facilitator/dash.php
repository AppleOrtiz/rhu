<?php
require ('dashboard.php');
?>
<!DOCTYPE html>
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
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/dashss.css" />
    <link rel="stylesheet" href="css/dashboard.css" />
    <title>ADMINISTRATOR DASHBOARD</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        canvas {
            width: 500px; 
            height: 350px; 
        }
    </style>
</head>
<body>
<main class="mt-0 pt-3">
    <div class="container-sm">
        <div class="row">
            <div class="col-md-12">
                <h4><i class="bi bi-calendar4-range"></i> PATIENT'S AGE RANGE</h4>
            </div>
        </div>

        <?php
        $conn = new mysqli("localhost", "root", "", "isrhh");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $queries = [
            "total_patients" => "SELECT COUNT(*) as count FROM `patient_tbl`",
            "infants" => "SELECT COUNT(*) as count FROM `patient_tbl` WHERE TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 0 AND 12",
            "teenagers" => "SELECT COUNT(*) as count FROM `patient_tbl` WHERE TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 13 AND 19",
            "adults" => "SELECT COUNT(*) as count FROM `patient_tbl` WHERE TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 20 AND 100"
        ];

        $counts = [];
        foreach ($queries as $key => $query) {
            $result = $conn->query($query);
            $fetch = $result->fetch_assoc();
            $counts[$key] = $fetch['count'] ?? 0;
        }

        // Query for Barangay male and female counts
        $barangay_query = $conn->query("
            SELECT 
                barangay, 
                SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as male_count,
                SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as female_count
            FROM `patient_tbl`
            GROUP BY barangay
        ");
        $barangay_data = [];
        while ($row = $barangay_query->fetch_assoc()) {
            $barangay_data[] = $row;
        }

        // Query for Weekly patient data
        $week_query = $conn->query("
            SELECT DAYOFWEEK(time) as day_num, COUNT(*) as count 
            FROM `patient_tbl` 
            WHERE YEAR(time) = YEAR(CURDATE()) 
            AND WEEK(time, 1) = WEEK(CURDATE(), 1)
            GROUP BY DAYOFWEEK(time)
        ");
        $week_days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $patient_counts = array_fill(0, 7, 0);

        while ($row = $week_query->fetch_assoc()) {
            $day_num = $row['day_num'] - 1;
            $patient_counts[$day_num] = $row['count'];
        }

        // Query for Yearly patient data
        $year_query = $conn->query("SELECT YEAR(time) as year, COUNT(*) as count FROM `patient_tbl` GROUP BY YEAR(time)");
        $yearly_data = [];
        while ($row = $year_query->fetch_assoc()) {
            $yearly_data[] = $row;
        }


        $conn->close();
        ?>
        <div class="row">
            <div class="col-xl-3 col-md mb-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body">Total Patients
                        <h1 class="mb-0"><?php echo $counts['total_patients']; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md mb-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Young (0 - 12)
                        <h1 class="mb-0"><?php echo $counts['infants']; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md mb-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Adolescence (13 - 19)
                        <h1 class="mb-0"><?php echo $counts['teenagers']; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md mb-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Adults (20 - 60+)
                        <h1 class="mb-0"><?php echo $counts['adults']; ?></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center">
            <div class="row justify-content-start">
                <div class="col">
                    <label for="year">Year:</label>
                    <select id="year" name="year">
                        <option value="" disabled selected><i class="bi bi-funnel"></i></option>
                        <option value="all">ALL</option>
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                    </select>

                    <label for="barangay">Barangay:</label>
                    <select id="barangay" name="barangay">
                        <option value="" disabled selected><i class="bi bi-funnel"></i></option>
                        <option value="NONE">NONE</option>
                        <option value="BAGONG KARSADA">Bagong Karsada</option>
                        <option value="BALSAHAN">Balsahan</option>
                        <option value="BANCAAN">Bancaan</option>
                        <option value="BUCANA MALAKI">Bucana Malaki</option>
                        <option value="BUCANA SASAHAN">Bucana Sasahan</option>
                        <option value="CALUBCOB">Calubcob</option>
                        <option value="CAPT. C. NAZARENO">Capt. C. Nazareno</option>
                        <option value="GOMEZ-ZAMORA">Gomez - Zamora</option>
                        <option value="HALANG">Halang</option>
                        <option value="HUMBAC">Humbac</option>
                        <option value="IBAYO ESTACION">Ibayo Estacion</option>
                        <option value="IBAYO SILANGAN">Ibayo Silangan</option>
                        <option value="LABAC">Labac</option>
                        <option value="LATORIA">Latoria</option>
                        <option value="MABOLO">Mabolo</option>
                        <option value="MAKINA">Makina</option>
                        <option value="MALAINEN BAGO">Malainen Bago</option>
                        <option value="MALAINEN LUMA">Malainen Luma</option>
                        <option value="MOLINO">Molino</option>
                        <option value="MUNTING MAPINO">Munting Mapino</option>
                        <option value="MUZON">Muzon</option>
                        <option value="PALANGUE 1">Palangue 1</option>
                        <option value="PALANGUE 2 & 3">Palangue 2 & 3</option>
                        <option value="SABANG">Sabang</option>
                        <option value="SAN ROQUE">San Roque</option>
                        <option value="SANTULAN">Santulan</option>
                        <option value="SAPA">Sapa</option>
                        <option value="TIMALAN BALSAHAN">Timalan Balsahan</option>
                        <option value="TIMALAN CONCEPCION">Timalan Concepcion</option>
                    </select>
                </div>
                <div class="col">
                </div>
            

                <div class="row">
                    <div class="col">
                        <div class="container-fluid">
                            <canvas id="monthlyChart" width="500" height="350" style="max-width: 100%;"></canvas>
                        </div>
                    </div>

                    <div class="col">
                        <div class="container-fluid">
                            <canvas id="weeklyChart" width="500" height="350" style="max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <div class="container-fluid">
                            <canvas id="yearlyChart" width="250" height="100" style="max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                    <div class="container-fluid">
                        <canvas id="barangayChart" width="500" height="300" style="max-width: 100%;"></canvas>
                    </div>
                </div>
                
            </div>
    </div>
    <script>
    const barangayData = <?php echo json_encode($barangay_data); ?>;
    const weekDays = <?php echo json_encode($week_days); ?>;
    const patientCounts = <?php echo json_encode($patient_counts); ?>;
    const yearlyData = <?php echo json_encode($yearly_data); ?>;

    const chartColors = {
        weekly: {
            background: 'rgba(33, 150, 243, 0.2)',
            border: 'rgba(33, 150, 243, 1)',
        },
        monthly: {
            background: 'rgba(255, 87, 34, 0.2)',
            border: 'rgba(255, 87, 34, 1)',
        },
        yearly: {
            background: 'rgba(255, 159, 64, 0.2)',
            border: 'rgba(255, 159, 64, 1)',
        }
    };

    let barangayChart, weeklyChart, monthlyChart, yearlyChart;

    function createWeeklyChart() {
    const ctx = document.getElementById('weeklyChart').getContext('2d');
    if (weeklyChart) {
        weeklyChart.destroy();
    }

    weeklyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: weekDays,
            datasets: [{
                label: 'Number of Patients per Day',
                data: patientCounts,
                backgroundColor: chartColors.weekly.background,
                borderColor: chartColors.weekly.border,
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Day of the Week'
                    },
                    ticks: {
                        font: {
                            size: 7  // Smaller font size for x-axis labels
                        }
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Patients'
                    },
                    beginAtZero: true,
                    min: 0,
                    max: 50,
                    stepSize: 5,
                    ticks: {
                        callback: function(value) {
                            return value;
                        }
                    }
                }
            }
        }
    });
}


function createMonthlyChart(barangay = "NONE", year = new Date().getFullYear()) {
    const url = barangay !== "NONE" 
        ? `barangay.php?barangay=${barangay}&year=${year}` 
        : `barangay.php?year=${year}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const monthlyCounts = months.map((month, index) => {
                const dataItem = data.monthly_data.find(item => item.month === index + 1);
                return dataItem ? dataItem.count : 0;
            });

            const ctx = document.getElementById('monthlyChart').getContext('2d');
            if (monthlyChart) {
                monthlyChart.destroy();
            }

            monthlyChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: `Monthly Patient Count ${barangay !== "NONE" ? `for ${barangay}` : ''} in ${year}`,
                        data: monthlyCounts,
                        backgroundColor: chartColors.monthly.background,
                        borderColor: chartColors.monthly.border,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Months'
                            },
                            ticks: {
                                font: {
                                    size: 7  // Smaller font size for x-axis labels
                                }
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Number of Patients'
                            },
                            beginAtZero: true,
                            min: 0,
                            max: 50,
                            stepSize: 5,
                            ticks: {
                                callback: function(value) {
                                    return value;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching monthly data:', error));
}

function createYearlyChart() {
    const years = yearlyData.map(data => data.year);
    const yearlyCounts = yearlyData.map(data => data.count);

    const ctx = document.getElementById('yearlyChart').getContext('2d');
    if (yearlyChart) {
        yearlyChart.destroy();
    }

    yearlyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: years,
            datasets: [{
                label: 'Yearly Patient Count',
                data: yearlyCounts,
                backgroundColor: chartColors.yearly.background,
                borderColor: chartColors.yearly.border,
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Year'
                    },
                    ticks: {
                        font: {
                            size: 7  // Smaller font size for x-axis labels
                        }
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Patients'
                    },
                    beginAtZero: true,
                    min: 0,
                    max: 50,
                    stepSize: 5,
                    ticks: {
                        callback: function(value) {
                            return value;
                        }
                    }
                }
            }
        }
    });
}

function createBarangayChart() {
    const barangays = barangayData.map(data => data.barangay);
    const maleCounts = barangayData.map(data => data.male_count);
    const femaleCounts = barangayData.map(data => data.female_count);

    const ctx = document.getElementById('barangayChart').getContext('2d');

    if (barangayChart) {
        barangayChart.destroy();
    }

    barangayChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: barangays,
            datasets: [
                {
                    label: 'Male Patients',
                    data: maleCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Female Patients',
                    data: femaleCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Number of Patients'
                    },
                    beginAtZero: true,
                    min: 0,
                    max: 50,
                    stepSize: 5,
                    ticks: {
                        callback: function(value) {
                            return value;  // You can format or modify the tick labels if needed
                        }
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 45,  // Change this to rotate labels slightly
                        minRotation: 45,  // Apply the same rotation for consistency
                        font: {
                            size: 10 // Adjust font size if needed
                        }
                    },
                    title: {
                        display: true,
                        text: 'Barangays'
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        title: function(tooltipItem) {
                            return 'Barangay: ' + tooltipItem[0].label;
                        },
                        label: function(tooltipItem) {
                            const datasetLabel = tooltipItem.dataset.label;
                            const count = tooltipItem.raw;
                            return datasetLabel + ': ' + count;
                        }
                    }
                }
            }
        }
    });
}



    // Initialize all charts
    function initializeCharts() {
        createBarangayChart();
        createWeeklyChart();
        createMonthlyChart();
        createYearlyChart();
    }

    // Event listeners for Year and Barangay dropdowns
    document.getElementById('year').addEventListener('change', (e) => {
        const selectedYear = e.target.value;
        const selectedBarangay = document.getElementById('barangay').value;
        createMonthlyChart(selectedBarangay, selectedYear);
    });

    document.getElementById('barangay').addEventListener('change', (e) => {
        const selectedBarangay = e.target.value;
        const selectedYear = document.getElementById('year').value;
        createMonthlyChart(selectedBarangay, selectedYear);
    });

    // Initialize the charts on page load
    window.onload = initializeCharts;
</script>


    <script src="script3.js"></script>
</main>
</body>
</html>