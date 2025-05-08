<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/styles.css" />
    <style>
        nav.admin-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            background-color: #2980b9;
            border-radius: 0 0 8px 8px;
        }
        nav.admin-nav ul li {
            margin: 0 15px;
        }
        nav.admin-nav ul li a {
            color: #ecf0f1;
            text-decoration: none;
            font-weight: 600;
            padding: 12px 18px;
            display: inline-block;
            transition: background-color 0.3s ease;
            border-radius: 4px;
        }
        nav.admin-nav ul li a:hover,
        nav.admin-nav ul li a:focus {
            background-color: #3498db;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <nav class="admin-nav">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="manage_students.php">Manage Students</a></li>
                <li><a href="send_notifications.php">Send Notifications</a></li>
                <li><a href="audit_logs.php">Audit Logs</a></li>
                <li><a href="../auth/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
<!--</?php include("../includes/footer.php");-->