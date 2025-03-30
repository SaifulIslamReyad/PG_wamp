<?php
include('../db_connect.php');

$sql = "SELECT specialization_id, specialization_name FROM specializations";
$result = $conn->query($sql);

$specializations = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $specializations[] = $row;
    }
}

echo json_encode($specializations);
$conn->close();







// 1. $conn->query($sql)
// $conn: This is the database connection object (created earlier, likely in db_connect.php).

// ->query($sql):

// The query() method sends the SQL command ($sql) to the database for execution.

// If the query is successful, it returns a result set (for SELECT, SHOW, DESCRIBE, etc.) or TRUE (for INSERT, UPDATE, DELETE).

// If the query fails, it returns FALSE.

//  $result = ...
// The returned result (either a MySQLi result object or FALSE) is stored in $result.

// For a SELECT query (like in this code), $result will be a result set object containing the retrieved rows.
// If no rows are found, the code inside the if block is skipped.

// 2. while ($row = $result->fetch_assoc())
// Purpose: Loops through each row of the result set.

// Explanation:

// $result->fetch_assoc() fetches the next row from the result set as an associative array (where column names are the keys).

// Example of a fetched row:

// php
// Copy
// [
//     'specialization_id' => 1,
//     'specialization_name' => 'Cardiology'
// ]
// The while loop continues as long as fetch_assoc() returns a new row. When there are no more rows, it returns NULL, and the loop stops.

// 3. $specializations[] = $row;
// Purpose: Appends each row to the $specializations array.

// Explanation:

// [] = is the array append operator in PHP. It adds the new row to the end of the array.

// After processing all rows, $specializations becomes an array of associative arrays, like this:

// php
// Copy
// [
//     ['specialization_id' => 1, 'specialization_name' => 'Cardiology'],
//     ['specialization_id' => 2, 'specialization_name' => 'Neurology'],
//     // ... more rows
// ]
// 4. echo json_encode($specializations);
// Purpose: Converts the PHP array to JSON and sends it as the response.

// Explanation:

// json_encode() converts the PHP array into a JSON-formatted string.

// Example output:

// json
// Copy
// [
//     {"specialization_id": 1, "specialization_name": "Cardiology"},
//     {"specialization_id": 2, "specialization_name": "Neurology"}
// ]
// The echo statement sends this JSON string back to the client (e.g., a web browser or an API caller).








?>






