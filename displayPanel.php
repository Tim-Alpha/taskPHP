<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Data Panel</title>
</head>
<body>
    <div class="admin-table">
        <table>
            <thead>
                <tr>
                    <th>Admin ID</th>
                    <th>Admin Name</th>
                    <th>Assigned Users</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'fetch_data.php'; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
