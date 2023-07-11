<!-- add_contact.php -->

<!DOCTYPE html>
<html>
<head>
  <title>Add Contact</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <h1>Online Contacts Directory</h1>
  </header>

  <main>
    <h2>Add New Contact<h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the form data
  $firstName = $_POST["first-name"];
  $lastName = $_POST["last-name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $address = $_POST["address"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zip = $_POST["zip"];

  // Prepare the contact data
  $contactData = $firstName . "," . $lastName . "," . $email . "," . $phone . "," . $address . "," . $city . "," . $state . "," . $zip . "\n";

  // Open the contacts file in append mode with file locking
  $file = fopen("contacts.txt", "a");
  if ($file) {
    // Acquire an exclusive lock on the file
    if (flock($file, LOCK_EX)) {
      // Write the contact data to the file
      if (fwrite($file, $contactData) !== false) {
        echo "<p>Contact added successfully!</p>";

        // Clear the form fields after successful submission
        $firstName = $lastName = $email = $phone = $address = $city = $state = $zip = "";
      } else {
        echo "<p>Failed to write contact data. Please try again.</p>";
      }

      // Release the lock
      flock($file, LOCK_UN);
    } else {
      echo "<p>Failed to acquire lock on the contacts file. Please try again later.</p>";
    }

    // Close the file
    fclose($file);
  } else {
    echo "<p>Failed to open the contacts file. Please try again later.</p>";
  }
}
?>

    <form action="add_contact.php" method="POST">
      <label for="first-name">First Name:</label>
      <input type="text" id="first-name" name="first-name" placeholder="Enter first name" value="<?php echo $firstName; ?>" required>

      <label for="last-name">Last Name:</label>
      <input type="text" id="last-name" name="last-name" placeholder="Enter last name" value="<?php echo $lastName; ?>" required>

      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" placeholder="Enter email address" value="<?php echo $email; ?>" required>

      <label for="phone">Phone Number:</label>
      <input type="tel" id="phone" name="phone" placeholder="Enter phone number" value="<?php echo $phone; ?>" required>

      <label for="address">Street Address:</label>
      <input type="text" id="address" name="address" placeholder="Enter street address" value="<?php echo $address; ?>" required>

      <label for="city">City:</label>
      <input type="text" id="city" name="city" placeholder="Enter city" value="<?php echo $city; ?>" required>

      <label for="state">State:</label>
      <select id="state" name="state">
        <option value="">Select a state</option>
        <option value="AL">Alabama</option>
        <option value="AK">Alaska</option>
        <option value="AZ">Arizona</option>
        <option value="AR">Arkansas</option>
        <option value="CA">California</option>
        <option value="CO">Colorado</option>
        <option value="CT">Connecticut</option>
        <option value="DE">Delaware</option>
        <option value="FL">Florida</option>
        <option value="GA">Georgia</option>
        <option value="HI">Hawaii</option>
        <option value="ID">Idaho</option>
        <option value="IL">Illinois</option>
        <option value="IN">Indiana</option>
        <option value="IA">Iowa</option>
        <option value="KS">Kansas</option>
        <option value="KY">Kentucky</option>
        <option value="LA">Louisiana</option>
        <option value="ME">Maine</option>
        <option value="MD">Maryland</option>
        <option value="MA">Massachusetts</option>
        <option value="MI">Michigan</option>
        <option value="MN">Minnesota</option>
        <option value="MS">Mississippi</option>
        <option value="MO">Missouri</option>
        <option value="MT">Montana</option>
        <option value="NE">Nebraska</option>
        <option value="NV">Nevada</option>
        <option value="NH">New Hampshire</option>
        <option value="NJ">New Jersey</option>
        <option value="NM">New Mexico</option>
        <option value="NY">New York</option>
        <option value="NC">North Carolina</option>
        <option value="ND">North Dakota</option>
        <option value="OH">Ohio</option>
        <option value="OK">Oklahoma</option>
        <option value="OR">Oregon</option>
        <option value="PA">Pennsylvania</option>
        <option value="RI">Rhode Island</option>
        <option value="SC">South Carolina</option>
        <option value="SD">South Dakota</option>
        <option value="TN">Tennessee</option>
        <option value="TX">Texas</option>
        <option value="UT">Utah</option>
        <option value="VT">Vermont</option>
        <option value="VA">Virginia</option>
        <option value="WA">Washington</option>
        <option value="WV">West Virginia</option>
        <option value="WI">Wisconsin</option>
        <option value="WY">Wyoming</option>
      </select>

      <label for="zip">Zip Code:</label>
      <input type="text" id="zip" name="zip" placeholder="Enter zip code" value="<?php echo $zip; ?>" required>

      <button type="submit">Save Contact</button>
    </form>

    <a href="main.php" class="back-link">Back to Directory</a>

  </main>

  <footer>
    <p>Last Modified: <?php echo date('H:i M j, Y T', getlastmod()); ?></p>
  </footer>
</body>
</html>

