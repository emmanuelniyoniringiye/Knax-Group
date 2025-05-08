<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['role']) || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = mysqli_real_escape_string($conn, $_SESSION['role']);
$user_id = (int) $_SESSION['user_id'];
?>

<h3>📢 Notifications</h3>
<?php
$notifications = mysqli_query($conn, "
    SELECT * FROM notifications 
    WHERE target_role = '" . $role . "' OR target_role = 'all' 
    ORDER BY id DESC
");

if ($notifications && mysqli_num_rows($notifications) > 0) {
    while ($note = mysqli_fetch_assoc($notifications)) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";
        echo "<strong>" . htmlspecialchars($note['title']) . "</strong><br>";
        echo nl2br(htmlspecialchars($note['message'])) . "<br>";
        echo "<em>Sent on: " . htmlspecialchars($note['created_by']) . "</em>";
        echo "</div>";
    }
} else {
    echo "<p>No notifications found.</p>";
}
?>

<h3>⬇️ Export Options</h3>
<ul>
    <li><a href="export/export_students.php">Export Students to Excel</a></li>
    <li><a href="export/export_performance_pdf.php">Download Performance Report PDF</a></li>
</ul>

<h3>📊 Performance & Club Activity Graphs</h3>
<canvas id="chartTopPerformers"></canvas>
<canvas id="chartClubActivity"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
fetch('dashboard/top_performers_data.php')
    .then(res => res.json())
    .then(data => {
        new Chart(document.getElementById('chartTopPerformers'), {
            type: 'bar',
            data: {
                labels: data.names,
                datasets: [{
                    label: 'Average Score',
                    data: data.scores,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                }]
            },
            options: {
                responsive: true
            }
        });
    });

fetch('dashboard/active_clubs_data.php')
    .then(res => res.json())
    .then(data => {
        new Chart(document.getElementById('chartClubActivity'), {
            type: 'pie',
            data: {
                labels: data.clubs,
                datasets: [{
                    label: 'Club Participation',
                    data: data.counts,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });
    });
</script>
