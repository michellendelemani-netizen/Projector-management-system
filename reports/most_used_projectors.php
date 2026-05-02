<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once("connection.php");

    // Correct query
    $sql = "SELECT 
                p.projector_id,
                p.model,
                COUNT(*) AS usage_per_day
            FROM transactions t
            JOIN projectors p 
                ON t.projector_id = p.projector_id
            GROUP BY p.projector_id, p.model
            ORDER BY usage_per_day DESC";

    $result = mysqli_query($conn, $sql);

    // Arrays for displaying a chart
    $models = [];
    $counts = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $models[] = $row['model'];
        $counts[] = $row['usage_per_day'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Most Used Projectors</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <h2 style="text-align:center;">Most Used Projectors</h2>

    <div style="width: 60%; height: 400px; margin: 40px auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($models); ?>,
                datasets: [{
                    label: 'Usage Count',
                    data: <?php echo json_encode($counts); ?>,
                    borderWidth: 1,
                    backgroundColor: 'rgba(9, 21, 49, 0.8)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    title: {
                        display: true,
                        text: 'Most Used Projectors (Usage per Month)',
                        color: '#000',
                        font: {
                            size: 18,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        labels: {
                            color: '#000'
                        }
                    }
                },

                scales: {

                //display x-axis data
                    x: {
                        title: {
                            display: true,
                            text: 'Projector Name',
                            color: '#000',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            color: '#000'
                        },
                        grid: {
                            color: '#ccc'
                        }
                    },

                    //display y-axis data
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Borrowed Times per Day',
                            color: '#000', 
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        },
                        ticks: {
                            color: '#000',
                            precision: 0
                        },
                        grid: {
                            color: '#ccc'
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>