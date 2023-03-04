<html>

<head>
    <title>Edit Property for Rent</title>
</head>

<body>
    <h2>Edit Property for Rent</h2>
    <form action="edit_property.php" method="POST">
        <table>
            <tr>
                <td>Property No:</td>
                <td>
                    <select name="propertyNo">
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
                        // retrieve foreign key values from owner table
                        $sql = "SELECT propertyNo FROM propertyforrent";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["propertyNo"] . "'>" . $row["propertyNo"] . "</option>";
                            }
                        } else {
                            echo "0 results";
                        }
                        // close database connection
                        $conn->close();
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Street:</td>
                <td><input type="text" id="street" name="street"></td>
            </tr>
            <tr>
                <td>City:</td>
                <td><input type="text" id="city" name="city"></td>
            </tr>
            <tr>
                <td>Postcode:</td>
                <td><input type="text" id="postcode" name="postcode"></td>
            </tr>
            <tr>
                <td>Type:</td>
                <td><input type="text" id="type" name="type"></td>
            </tr>
            <tr>
                <td>Rooms:</td>
                <td><input type="number" id="rooms" name="rooms"></td>
            </tr>
            <tr>
                <td>Rent:</td>
                <td><input type="number" id="rent" name="rent"></td>
            </tr>


            <tr>
                <td>Owner No:</td>
                <td>
                    <select name="ownerNo">
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
                        // retrieve foreign key values from owner table
                        $sql = "SELECT ownerNo FROM privateowner";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["ownerNo"] . "'>" . $row["ownerNo"] . "</option>";
                            }
                        } else {
                            echo "0 results";
                        }
                        // close database connection
                        $conn->close();
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Staff No:</td>
                <td>
                    <select name="staffNo">
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
                        // retrieve foreign key values from staff table
                        $sql = "SELECT staffNo FROM staff";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["staffNo"] . "'>" . $row["staffNo"] . "</option>";
                            }
                        } else {
                            echo "0 results";
                        }
                        // close database connection
                        $conn->close();
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Branch No:</td>
                <td>
                    <select name="branchNo">
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
                        // generate options for dropdown menu
                        $sql = "SELECT branchNo FROM branch";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["branchNo"] . "'>" . $row["branchNo"] . "</option>";
                            }
                        }

                        // close database connection
                        $conn->close();
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Update"></td>
            </tr>
        </table>
    </form>
</body>

</html>
