<?php
use App\Models\ProductsModel;
$productsModel = new ProductsModel();

// Menentukan tipe sorting (default: price)
$type = isset($_GET['type']) ? $_GET['type'] : 'price';

// Menjalankan benchmark sorting
$result = $productsModel->benchmarkSortAlgorithms($type);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sort Comparison</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1 style="text-align: center;">Perbandingan Algoritma Merge Sort dan Quick Sort (<?= ucfirst($type) ?>)</h1>

    <div style="display: flex; justify-content: center; gap: 20px; margin: 20px 0;">

        <!-- Tombol Back -->
        <button onclick="history.back()"
            style="padding: 10px 15px; background-color: #6C757D; color: white; border: none; border-radius: 5px;">
            Back
        </button>

        <!-- Tombol Refresh -->
        <button onclick="location.reload()"
            style="padding: 10px 15px; background-color: #28A745; color: white; border: none; border-radius: 5px;">
            Generate
        </button>
    </div>

    <canvas id="comparisonChart" width="400" height="200"></canvas>

    <script>
    let comparisonHistory = JSON.parse(localStorage.getItem('comparisonHistory')) || [];

    if (comparisonHistory.length >= 10) {
        comparisonHistory = [];
    }

    let now = new Date();
    let timestamp = now.toLocaleString();
    let attemptNumber = comparisonHistory.length + 1;

    comparisonHistory.push({
        label: `Percobaan ${attemptNumber}`,
        mergeSortTime: <?= $result['mergeSortTime'] ?>,
        quickSortTime: <?= $result['quickSortTime'] ?>,
        mergeSortMemory: <?= $result['mergeSortMemory'] ?>,
        quickSortMemory: <?= $result['quickSortMemory'] ?>,
        timestamp: timestamp,
        type: "<?= $type ?>"
    });

    localStorage.setItem('comparisonHistory', JSON.stringify(comparisonHistory));

    const ctx = document.getElementById('comparisonChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: comparisonHistory.map(item => item.label),
            datasets: [{
                    label: `Waktu Merge Sort (<?= ucfirst($type) ?>)`,
                    data: comparisonHistory.map(item => item.mergeSortTime),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    yAxisID: 'y'
                },
                {
                    label: `Waktu Quick Sort (<?= ucfirst($type) ?>)`,
                    data: comparisonHistory.map(item => item.quickSortTime),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    yAxisID: 'y'
                },
                {
                    label: `Memori Merge Sort (KB)`,
                    data: comparisonHistory.map(item => item.mergeSortMemory),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    yAxisID: 'y1'
                },
                {
                    label: `Memori Quick Sort (KB)`,
                    data: comparisonHistory.map(item => item.quickSortMemory),
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Waktu (detik)'
                    }
                },
                y1: {
                    beginAtZero: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Memori (KB)'
                    },
                    grid: {
                        drawOnChartArea: false
                    }
                }
            }
        }
    });

    document.getElementById('history').innerHTML = "<h3>Riwayat Percobaan:</h3>";
    comparisonHistory.forEach(item => {
        document.getElementById('history').innerHTML +=
            `<p>${item.label} - <b>${item.timestamp}</b> (Sort: ${item.type})</p>`;
    });
    </script>

    <div id="history" style="margin-top: 20px; font-family: Arial, sans-serif;"></div>
</body>

</html>