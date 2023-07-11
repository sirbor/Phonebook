<!-- main.php -->

<!DOCTYPE html>
<html>
<head>
  <title>Contacts Directory</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <h1>Online Contacts Directory</h1>
  </header>

  <main>
    <h2>Search for Contact</h2>

    <form action="main.php" method="GET">
      <label for="first-name">First Name:</label>
      <input type="text" id="first-name" name="first-name" placeholder="Enter first name">

      <label for="last-name">Last Name:</label>
      <input type="text" id="last-name" name="last-name" placeholder="Enter last name">

      <button type="submit">Search</button>
    </form>

    <!-- Display search results here -->
    <?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  // Check if search query is submitted
  if (isset($_GET["first-name"]) && isset($_GET["last-name"])) {
    // Retrieve the search query parameters
    $firstName = $_GET["first-name"];
    $lastName = $_GET["last-name"];

    // Open the contacts file in read-only mode with file locking
    $file = fopen("contacts.txt", "r");
    if ($file) {
      // Acquire a shared lock on the file
      flock($file, LOCK_SH);

      // Read the contacts from the file
      $contacts = fread($file, filesize("contacts.txt"));

      // Release the lock and close the file
      flock($file, LOCK_UN);
      fclose($file);

      // Check if the file was read successfully
      if ($contacts === false) {
        echo "<p>Unable to read contacts. Please try again later.</p>";
      } else {
        // Split the contacts into an array
        $contactsArray = explode("\n", $contacts);

        // Filter the contacts based on the search criteria
        $filteredContacts = [];
        foreach ($contactsArray as $contact) {
          // Skip empty lines
          if (trim($contact) === "") {
            continue;
          }

          $contactData = explode(",", $contact);
          if (strcasecmp($contactData[0], $firstName) == 0 || strcasecmp($contactData[1], $lastName) == 0) {
            $filteredContacts[] = $contactData;
          }
        }

        // Display the search results
        if (!empty($filteredContacts)) {
          echo "<ul class=\"search-results\">";
          echo "<ul>";
          foreach ($filteredContacts as $contact) {
            echo "<li>";
            echo "<strong>Name:</strong> " . $contact[0] . " " . $contact[1] . "<br>";
            echo "<strong>Email:</strong> " . $contact[2] . "<br>";
            echo "<strong>Phone:</strong> " . $contact[3] . "<br>";
            echo "<strong>Address:</strong> " . $contact[4] . "<br>";
            echo "<strong>City:</strong> " . $contact[5] . "<br>";
            echo "<strong>State:</strong> " . $contact[6] . "<br>";
            echo "<strong>Zip:</strong> " . $contact[7] . "<br>";

            // Add the Edit button with a link to update_contact.php
		echo "<a href=\"update_contact.php?id=" . urlencode($contact[2]) . "\" class=\"edit-button\">Edit</a>";
            echo "</li>";
          }
          echo "</ul>";
        } else {
          echo "<p>No results found.</p>";
        }
      }
    } else {
      echo "<p>Failed to open the contacts file. Please try again later.</p>";
    }
  }
}
?>

        <a href="add_contact.php" class="button">Add Contact</a>

  </main>

  <footer>
    <p>Last Modified: <?php echo date('H:i M j, Y T', getlastmod()); ?></p>
  </footer>
</body>
</html>

