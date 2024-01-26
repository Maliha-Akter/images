<?php
session_start();
include("job-posting-db.php");

// Check if a user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in";
    exit;
}

// Fetch client_id from the session
$client_id = (int)$_SESSION['user_id'];

// Retrieve job details for the logged-in client
$jobQuery = "SELECT * FROM Job WHERE client_id = $client_id";
$jobResult = mysqli_query($conn, $jobQuery);

if (!$jobResult) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <!-- Add your styles or include external stylesheets here -->
</head>

<body>

    <h2>Your Job Details</h2>

    <?php
    // Display job details
    while ($row = mysqli_fetch_assoc($jobResult)) {
        echo "<p>Job ID: " . $row['JobId'] . "</p>";
        echo "<p>Job Category: " . $row['JobCategory'] . "</p>";
        echo "<p>Required Skills: " . $row['RequiredSkills'] . "</p>";
        echo "<p>Working Hour: " . $row['WorkingHour'] . "</p>";
        echo "<p>Project Size: " . $row['ProjectSize'] . "</p>";
        echo "<p>Budget: " . $row['Budget'] . "</p>";
        echo "<hr>";
    }
    ?>

</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
