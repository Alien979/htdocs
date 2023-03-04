<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dreamhome";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['search'])) {
    $searchTerm = $_POST['propertyNo'];
    $sql = "SELECT * FROM propertyForRent WHERE propertyNo = '$searchTerm'";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Property Search</title>
</head>

<body>
    <h1>Property Search</h1>
    <form method="post" action="">
        <label for="propertyNo">Property No:</label>
        <input type="text" name="propertyNo">
        <input type="submit" name="search" value="Search">
    </form>
    <?php if (isset($_POST['search'])) { ?>
        <table>
            <tr>
                <th>Property No.</th>
                <th>Street</th>
                <th>City</th>
                <th>Postcode</th>
                <th>Type</th>
                <th>Rooms</th>
                <th>Rent</th>
                <th>Owner No.</th>
                <th>Staff No.</th>
                <th>Branch No.</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?= $row['propertyNo'] ?>
                    </td>
                    <td>
                        <?= $row['street'] ?>
                    </td>
                    <td>
                        <?= $row['city'] ?>
                    </td>
                    <td>
                        <?= $row['postcode'] ?>
                    </td>
                    <td>
                        <?= $row['TYPE'] ?>
                    </td>
                    <td>
                        <?= $row['rooms'] ?>
                    </td>
                    <td>
                        <?= $row['rent'] ?>
                    </td>
                    <td>
                        <?= $row['ownerNo'] ?>
                    </td>
                    <td>
                        <?= $row['staffNo'] ?>
                    </td>
                    <td>
                        <?= $row['branchNo'] ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</body>

</html>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dreamhome";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM propertyForRent";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Property For Rent</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h2>Property For Rent</h2>
    <table>
        <tr>
            <th>Property No.</th>
            <th>Street</th>
            <th>City</th>
            <th>Postcode</th>
            <th>Type</th>
            <th>Rooms</th>
            <th>Rent</th>
            <th>Owner No.</th>
            <th>Staff No.</th>
            <th>Branch No.</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td>
                        <?php echo $row["propertyNo"]; ?>
                    </td>
                    <td>
                        <?php echo $row["street"]; ?>
                    </td>
                    <td>
                        <?php echo $row["city"]; ?>
                    </td>
                    <td>
                        <?php echo $row["postcode"]; ?>
                    </td>
                    <td>
                        <?php echo $row["TYPE"]; ?>
                    </td>
                    <td>
                        <?php echo $row["rooms"]; ?>
                    </td>
                    <td>
                        <?php echo $row["rent"]; ?>
                    </td>
                    <td>
                        <?php echo $row["ownerNo"]; ?>
                    </td>
                    <td>
                        <?php echo $row["staffNo"]; ?>
                    </td>
                    <td>
                        <?php echo $row["branchNo"]; ?>
                    </td>
                    <td>
                        <form method="post" action="edit.php">
                            <input type="hidden" name="propertyNo" value="<?php echo $row["propertyNo"]; ?>">
                            <button type="submit">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="delete" value="<?php echo $row["propertyNo"]; ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="12">No records found.</td>
            </tr>
        <?php } ?>
    </table>
    <?php mysqli_close($conn); ?>

    <?php
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dreamhome";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle delete request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["delete"])) {
            $propertyNo = $_POST["delete"];
            $sql = "DELETE FROM propertyForRent WHERE propertyNo='$propertyNo'";
            $conn->query($sql);
        }
    }

    $conn->close();
    ?>

</body>




















<?php
// establish database connection
$conn = new mysqli("localhost", "root", "", "dreamhome");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get form data
    $data = $_POST;
    $keys = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";

    // insert new record into database
    $sql = "INSERT INTO propertyForRent ($keys) VALUES ($values)";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// get owner numbers for drop-down menu
$owner_result = $conn->query("SELECT ownerNo FROM privateowner");
$owner_options = "";
if ($owner_result->num_rows > 0) {
    while ($owner_row = $owner_result->fetch_assoc()) {
        $owner_options .= "<option value='" . $owner_row["ownerNo"] . "'>" . $owner_row["ownerNo"] . "</option>";
    }
}

// get staff numbers for drop-down menu
$staff_result = $conn->query("SELECT staffNo FROM staff");
$staff_options = "";
if ($staff_result->num_rows > 0) {
    while ($staff_row = $staff_result->fetch_assoc()) {
        $staff_options .= "<option value='" . $staff_row["staffNo"] . "'>" . $staff_row["staffNo"] . "</option>";
    }
}

// get branch numbers for drop-down menu
$branch_result = $conn->query("SELECT branchNo FROM branch");
$branch_options = "";
if ($branch_result->num_rows > 0) {
    while ($branch_row = $branch_result->fetch_assoc()) {
        $branch_options .= "<option value='" . $branch_row["branchNo"] . "'>" . $branch_row["branchNo"] . "</option>";
    }
}

// close database connection
$conn->close();
?>





<?php
// establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dreamhome";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get form data
    $propertyNo = $_POST["propertyNo"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $postcode = $_POST["postcode"];
    $type = $_POST["type"];
    $rooms = $_POST["rooms"];
    $rent = $_POST["rent"];
    $ownerNo = $_POST["ownerNo"];
    $staffNo = $_POST["staffNo"];
    $branchNo = $_POST["branchNo"];

    // insert new record into database
    $sql = "INSERT INTO propertyForRent (propertyNo, street, city, postcode, type, rooms, rent, ownerNo, staffNo, branchNo)
  VALUES ('$propertyNo', '$street', '$city', '$postcode', '$type', $rooms, $rent, '$ownerNo', '$staffNo', '$branchNo')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// close database connection
$conn->close();
?>







<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dreamhome";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get form data
    $propertyNo = $_POST["propertyNo"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $postcode = $_POST["postcode"];
    $type = $_POST["type"];
    $rooms = $_POST["rooms"];
    $rent = $_POST["rent"];
    $ownerNo = $_POST["ownerNo"];
    $staffNo = $_POST["staffNo"];
    $branchNo = $_POST["branchNo"];


    // insert new record into database
    $sql = "INSERT INTO propertyForRent (propertyNo, street, city, postcode, type, rooms, rent, ownerNo, staffNo, branchNo)



VALUES ('$propertyNo', '$street', '$city', '$postcode', '$type', $rooms, $rent, '$ownerNo', '$staffNo', '$branchNo')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// get owner numbers for drop-down menu
$owner_sql = "SELECT ownerNo FROM privateowner";
$owner_result = mysqli_query($conn, $owner_sql);
$owner_options = "";
if (mysqli_num_rows($owner_result) > 0) {
    while ($owner_row = mysqli_fetch_assoc($owner_result)) {
        $owner_options .= "<option value='" . $owner_row["ownerNo"] . "'>" . $owner_row["ownerNo"] . "</option>";
    }
}

// get staff numbers for drop-down menu
$staff_sql = "SELECT staffNo FROM staff";
$staff_result = mysqli_query($conn, $staff_sql);
$staff_options = "";
if (mysqli_num_rows($staff_result) > 0) {
    while ($staff_row = mysqli_fetch_assoc($staff_result)) {
        $staff_options .= "<option value='" . $staff_row["staffNo"] . "'>" . $staff_row["staffNo"] . "</option>";
    }
}

// get branch numbers for drop-down menu
$branch_sql = "SELECT branchNo FROM branch";
$branch_result = mysqli_query($conn, $branch_sql);
$branch_options = "";
if (mysqli_num_rows($branch_result) > 0) {
    while ($branch_row = mysqli_fetch_assoc($branch_result)) {
        $branch_options .= "<option value='" . $branch_row["branchNo"] . "'>" . $branch_row["branchNo"] . "</option>";
    }
}

// close database connection
mysqli_close($conn);
?>







<html>

<head>
    <title>Add Property For Rent</title>
</head>

<body>
    <h1>Add Property For Rent</h1>
    <form method="POST" action="">

        <table>
            <tr>
                <td><label for="propertyNo">Property No:</label></td>
                <td><input type="text" id="propertyNo" name="propertyNo"></td>
            </tr>
            <tr>
                <td><label for="street">Street:</label></td>
                <td><input type="text" id="street" name="street"></td>
            </tr>
            <tr>
                <td><label for="city">City:</label></td>
                <td><input type="text" id="city" name="city"></td>
            </tr>
            <tr>
                <td><label for="postcode">Postcode:</label></td>
                <td><input type="text" id="postcode" name="postcode"></td>
            </tr>
            <tr>
                <td><label for="type">Type:</label></td>
                <td>
                    <select id="type" name="type">
                        <option value="Flat">Flat</option>
                        <option value="House">House</option>
                        <option value="Studio">Studio</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="rooms">Number of Rooms:</label></td>
                <td><input type="number" id="rooms" name="rooms"></td>
            </tr>
            <tr>
                <td><label for="rent">Rent:</label></td>
                <td><input type="number" id="rent" name="rent"></td>
            </tr>
            <tr>
                <td><label for="ownerNo">Owner Number:</label></td>
                <td>
                    <select id="ownerNo" name="ownerNo">
                        <?php echo $owner_options; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="staffNo">Staff Number:</label></td>
                <td>
                    <select id="staffNo" name="staffNo">
                        <?php echo $staff_options; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="branchNo">Branch Number:</label></td>
                <td>
                    <select id="branchNo" name="branchNo">
                        <?php echo $branch_options; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Submit"></td>
            </tr>
        </table>

    </form>
</body>
