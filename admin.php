<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="auth_read.php">Transactions</a></li>
            <li><a href="#">Users</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </div>

    <!-- Page content -->
    <div class="content">
        <h1>Transaction Overview</h1>
        <div class="transaction-summary">
            <div class="summary-item">
                <h2>Total Transactions</h2>
                <p>500</p>
            </div>
            <div class="summary-item">
                <h2>Pending Transactions</h2>
                <p>50</p>
            </div>
            <div class="summary-item">
                <h2>Completed Transactions</h2>
                <p>450</p>
            </div>
        </div>

        <h1>User Overview</h1>
        <div class="user-summary">
            <div class="summary-item">
                <h2>Total Users</h2>
                <p>1000</p>
            </div>
            <div class="summary-item">
                <h2>Active Users</h2>
                <p>800</p>
            </div>
            <div class="summary-item">
                <h2>Inactive Users</h2>
                <p>200</p>
            </div>
        </div>
    </div>
</body>
</html>
<!-- Add this JavaScript section to your HTML -->
<script>
    // Function to fetch data from the server
    function fetchData() {
        fetch('trylogin.php')
            .then(response => response.json())
            .then(data => {
                // Handle the data here and populate your dashboard elements
                console.log(data); // For testing, you can see the data in the browser's console
                // Example: Populate a div with the fetched data
                document.getElementById('data-container').innerHTML = JSON.stringify(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Call the fetchData function when the page loads
    window.onload = fetchData;
</script>

<!-- Modify your HTML structure to display the fetched data -->
<body>
    <!-- ... Rest of your HTML ... -->
    <div id="data-container"></div>
</body>


<style>
/* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f3f3f3;
    margin: 0;
    padding: 0;
}

/* Sidebar styles */
.sidebar {
    width: 250px;
    height: 100%;
    background-color: #333;
    color: white;
    padding: 20px;
    position: fixed;
}

.sidebar h2 {
    margin-bottom: 20px;
    font-size: 24px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    color: lightseagreen;
    text-decoration: none;
    display: block;
    padding: 5px 0;
}

.sidebar ul li a:hover {
    background-color: lightgreen;
    border-radius: 5px;
}

/* Content styles */
.content {
    margin-left: 250px;
    padding: 20px;
}

.content h1 {
    font-size: 28px;
    margin-bottom: 20px;
    color: green;
}

.transaction-summary,
.user-summary {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.summary-item {
    flex: 1;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
}

.summary-item h2 {
    font-size: 18px;
    margin-bottom: 10px;
    color: green;
}

.summary-item p {
    font-size: 24px;
    font-weight: bold;
    color: lightseagreen;
}
</style>
