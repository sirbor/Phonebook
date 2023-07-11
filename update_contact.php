<!-- update_contact.php -->

<!DOCTYPE html>
<html>
<head>
  <title>Update Contact</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <header>
    <h1>Online Contacts Directory</h1>
  </header>

  <main>
    <h2>Update Contact</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      // Retrieve the contact email from the query parameter
      $email = $_GET["id"];

      // Read the contacts from the file
      $contacts = file_get_contents("contacts.txt");

      // Check if the file exists
      if ($contacts === false) {
        echo "<p>Unable to read contacts. Please try again later.</p>";
      } else {
        // Split the contacts into an array
        $contactsArray = explode("\n", $contacts);

        // Find the contact with the matching email
        $contactData = null;
        foreach ($contactsArray as $contact) {
          // Skip empty lines
          if (trim($contact) === "") {
            continue;
          }

          $contactFields = explode(",", $contact);
          if ($contactFields[2] === $email) {
            $contactData = $contactFields;
            break;
          }
        }

        // Check if the contact was found
        if ($contactData === null) {
          echo "<p>Contact not found.</p>";
        } else {
          // Retrieve the contact details
          $firstName = $contactData[0];
          $lastName = $contactData[1];
          $phone = $contactData[3];
          $address = $contactData[4];
          $city = $contactData[5];
          $state = $contactData[6];
          $zip = $contactData[7];
        }
      }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve the contact email from the form data
      $email = $_POST["email"];

      // Read the contacts from the file
      $contacts = file_get_contents("contacts.txt");

      // Check if the file exists
      if ($contacts === false) {
        echo "<p>Unable to read contacts. Please try again later.</p>";
      } else {
        // Split the contacts into an array
        $contactsArray = explode("\n", $contacts);

        // Find the contact with the matching email
        $contactIndex = -1;
        foreach ($contactsArray as $index => $contact) {
          // Skip empty lines
          if (trim($contact) === "") {
            continue;
          }

          $contactFields = explode(",", $contact);
          if ($contactFields[2] === $email) {
            $contactIndex = $index;
            break;
          }
        }

        // Check if the contact was found
        if ($contactIndex === -1) {
          echo "<p>Contact not found.</p>";
        } else {
          // Retrieve the updated contact details from the form
          $firstName = $_POST["first-name"];
          $lastName = $_POST["last-name"];
          $phone = $_POST["phone"];
          $address = $_POST["address"];
          $city = $_POST["city"];
          $state = $_POST["state"];
          $zip = $_POST["zip"];

          // Prepare the updated contact data
          $updatedContactData = $firstName . "," . $lastName . "," . $email . "," . $phone . "," . $address . "," . $city . "," . $state . "," . $zip;

          // Update the contact in the contacts array
          $contactsArray[$contactIndex] = $updatedContactData;

          // Implode the contacts array to a string
          $updatedContacts = implode("\n", $contactsArray);

          // Write the updated contacts back to the file
          if (file_put_contents("contacts.txt", $updatedContacts) !== false) {
            echo "<p>Contact updated successfully!</p>";
          } else {
            echo "<p>Failed to update contact. Please try again.</p>";
          }
        }
      }
    }
    ?>

    <!-- Display the form with pre-filled contact details -->
    <form action="update_contact.php" method="POST">
      <label for="first-name">First Name:</label>
      <input type="text" id="first-name" name="first-name" value="<?php echo $firstName; ?>" required>

      <label for="last-name">Last Name:</label>
      <input type="text" id="last-name" name="last-name" value="<?php echo $lastName; ?>" required>

      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" value="<?php echo $email; ?>" required readonly>

      <label for="phone">Phone Number:</label>
      <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" required>

      <label for="address">Street Address:</label>
      <input type="text" id="address" name="address" value="<?php echo $address; ?>" required>

      <label for="city">City:</label>
      <input type="text" id="city" name="city" value="<?php echo $city; ?>" required>

      <label for="state">State:</label>
      <select id="state" name="state" required>
        <option value="">Select a state</option>
          <option value="AL" <?php if ($state === "AL") echo "selected"; ?>>Alabama</option>
  <option value="AK" <?php if ($state === "AK") echo "selected"; ?>>Alaska</option>
  <option value="AZ" <?php if ($state === "AZ") echo "selected"; ?>>Arizona</option>
  <option value="AR" <?php if ($state === "AR") echo "selected"; ?>>Arkansas</option>
  <option value="CA" <?php if ($state === "CA") echo "selected"; ?>>California</option>
  <option value="CO" <?php if ($state === "CO") echo "selected"; ?>>Colorado</option>
  <option value="CT" <?php if ($state === "CT") echo "selected"; ?>>Connecticut</option>
  <option value="DE" <?php if ($state === "DE") echo "selected"; ?>>Delaware</option>
  <option value="FL" <?php if ($state === "FL") echo "selected"; ?>>Florida</option>
  <option value="GA" <?php if ($state === "GA") echo "selected"; ?>>Georgia</option>
  <option value="HI" <?php if ($state === "HI") echo "selected"; ?>>Hawaii</option>
  <option value="ID" <?php if ($state === "ID") echo "selected"; ?>>Idaho</option>
  <option value="IL" <?php if ($state === "IL") echo "selected"; ?>>Illinois</option>
  <option value="IN" <?php if ($state === "IN") echo "selected"; ?>>Indiana</option>
  <option value="IA" <?php if ($state === "IA") echo "selected"; ?>>Iowa</option>
  <option value="KS" <?php if ($state === "KS") echo "selected"; ?>>Kansas</option>
  <option value="KY" <?php if ($state === "KY") echo "selected"; ?>>Kentucky</option>
  <option value="LA" <?php if ($state === "LA") echo "selected"; ?>>Louisiana</option>
  <option value="ME" <?php if ($state === "ME") echo "selected"; ?>>Maine</option>
  <option value="MD" <?php if ($state === "MD") echo "selected"; ?>>Maryland</option>
  <option value="MA" <?php if ($state === "MA") echo "selected"; ?>>Massachusetts</option>
  <option value="MI" <?php if ($state === "MI") echo "selected"; ?>>Michigan</option>
  <option value="MN" <?php if ($state === "MN") echo "selected"; ?>>Minnesota</option>
  <option value="MS" <?php if ($state === "MS") echo "selected"; ?>>Mississippi</option>
  <option value="MO" <?php if ($state === "MO") echo "selected"; ?>>Missouri</option>
  <option value="MT" <?php if ($state === "MT") echo "selected"; ?>>Montana</option>
  <option value="NE" <?php if ($state === "NE") echo "selected"; ?>>Nebraska</option>
  <option value="NV" <?php if ($state === "NV") echo "selected"; ?>>Nevada</option>
  <option value="NH" <?php if ($state === "NH") echo "selected"; ?>>New Hampshire</option>
  <option value="NJ" <?php if ($state === "NJ") echo "selected"; ?>>New Jersey</option>
  <option value="NM" <?php if ($state === "NM") echo "selected"; ?>>New Mexico</option>
  <option value="NY" <?php if ($state === "NY") echo "selected"; ?>>New York</option>
  <option value="NC" <?php if ($state === "NC") echo "selected"; ?>>North Carolina</option>
  <option value="ND" <?php if ($state === "ND") echo "selected"; ?>>North Dakota</option>
  <option value="OH" <?php if ($state === "OH") echo "selected"; ?>>Ohio</option>
  <option value="OK" <?php if ($state === "OK") echo "selected"; ?>>Oklahoma</option>
  <option value="OR" <?php if ($state === "OR") echo "selected"; ?>>Oregon</option>
  <option value="PA" <?php if ($state === "PA") echo "selected"; ?>>Pennsylvania</option>
  <option value="RI" <?php if ($state === "RI") echo "selected"; ?>>Rhode Island</option>
  <option value="SC" <?php if ($state === "SC") echo "selected"; ?>>South Carolina</option>
  <option value="SD" <?php if ($state === "SD") echo "selected"; ?>>South Dakota</option>
  <option value="TN" <?php if ($state === "TN") echo "selected"; ?>>Tennessee</option>
  <option value="TX" <?php if ($state === "TX") echo "selected"; ?>>Texas</option>
  <option value="UT" <?php if ($state === "UT") echo "selected"; ?>>Utah</option>
  <option value="VT" <?php if ($state === "VT") echo "selected"; ?>>Vermont</option>
  <option value="VA" <?php if ($state === "VA") echo "selected"; ?>>Virginia</option>
  <option value="WA" <?php if ($state === "WA") echo "selected"; ?>>Washington</option>
  <option value="WV" <?php if ($state === "WV") echo "selected"; ?>>West Virginia</option>
  <option value="WI" <?php if ($state === "WI") echo "selected"; ?>>Wisconsin</option>
  <option value="WY" <?php if ($state === "WY") echo "selected"; ?>>Wyoming</option>
      </select>

      <label for="zip">Zip Code:</label>
      <input type="text" id="zip" name="zip" value="<?php echo $zip; ?>" required>

      <button type="submit">Update Contact</button>
    </form>

    <a href="main.php" class="back-link">Back to Directory</a>

  </main>

  <footer>
    <p>Last Modified: <?php echo date('H:i M j, Y T', getlastmod()); ?></p>
  </footer>
</body>
</html>

