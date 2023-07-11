<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<!-- Head and link to CSS file -->
<head>

  <link rel="stylesheet" type="text/css" href="CSS.css">

</head>

<!-- Body and where the box will be created -->
<body>

<!--#include virtual="header.php"--><?phpinclude('header.php');?><!--#include virtual="menu.inc"--><?phpinclude('menu.inc');?>

<!-- commented out phpinfo() -->
<!-- <?php
	phpinfo();
?> -->


<!-- #1 box -->
<div class="outer_container">

  <!-- Left container -->
  <div class="left_inner_container">
    <a href="?Home=1"> Home </a>
    <h3 class="H31"> Lab Assignments </h3>

    <ul>
      <!-- The <a> </a> is for the hyperlink. -->
      <!-- For example <a href="https://www.google.com"> Assignment 2 </a> will hyperlink the "Assignment 2" to google -->
      <li> <a href="?Assignment1=1"> Assignment 1 </a> </li>
      <li> <a href="?Assignment2=1"> Assignment 2 </a> </li>
      <li> <a href="main.php"> Assignment 3 </a> </li>
      <li> <a href="#"> Assignment 4 </a> </li>
    </ul>

    <h3 class="H32"> Lab Practica </h3>

    <ul>
      <li> <a href="#"> Practicum 1 </a> </li>
      <li> <a href="#"> Practicum 2 </a> </li>
    </ul>

  </div>

  <!-- Right outer container (Largest right container with 3 columns) -->
  <div class="right_outer_container">

    <!-- Right inner Container 3 (parent) -->
    <div class="right_inner_container3_parent">

      <div class="right_inner_container3_child1">
        <h3> IT-207, B03, Summer </h3>
        <p> Professor Erhan M Uyar </p>
        <p> George Mason University </p>
      </div>

      <!-- href="Email@yahoo.com" -->
      <div class="right_inner_container3_child2">
        <h3> Hamzah Ramadhan </h3>
        <p> <a href="mailto:hramadha@gmu.edu">hramadha@gmu.edu </a> </p>
      <?php  // Get the last modified timestamp of the file  $lastModified = getlastmod();  // Format the timestamp in the desired format  $lastModifiedFormatted = date('H:i M d, Y T', getlastmod());  ?>    <!-- Display the Last Modified information in the specified format --> </head><body>  <header>    <!-- Your header content goes here, such as logo, navigation, etc. -->  </header>    <!-- Display the Last Modified information in the specified format -->  <p class="last-modified">Last Modified: <?php echo $lastModifiedFormatted; ?></p>  
      </div>

    </div>

    <!-- Right inner container (Second column of the outer container) -->
    <div class="right_inner_container1">

      <!-- (Nested container divided into 2 rows) -->
      <div class="right_inner_container1_child1">

        <?php
        if (isset($_GET['Assignment1']) && $_GET['Assignment1'] === '1') {
          echo '<object data="Assignment1/index.htm" type="text/html" width="100%" height="100%"></object>';		  		} elseif ((isset($_GET['Assignment2']) && $_GET['Assignment2'] === '1')){		  		  echo '<object data="Assignment2/Index.php" type="text/html" width="100%" height="100%"></object>';
        } else {
        ?>

        <?php
        $setTrue = 1;
        if ((isset($_GET['Home']) && $_GET['Home'] === '1') || $setTrue == 1) 
        {
        ?>

        <!-- (Nested container first row, also this nested container have 2 columns)-->
        <div class="right_inner_container1_child1_child1">

          <!-- (Nested container first column) Self Photograph -->
          <div class="right_inner_container1_child1_child1_Child1">
            <img src="PersonalPicture.png" alt="Photograph">
          </div>

          <!-- (Nest container second column) Summary -->
          <div class="right_inner_container1_child1_child1_Child2">
            <ul>
              <h3>Summary</h3>
              <li> Personal </li>
              <p>  I am a senior at George Mason University</p>
              <li> Academic </li>
              <p> Information Technology Concentration in Cyber Security</p>
            </ul>
          </div>
        </div>

        <!-- (Nested container second row) Professional & Personal Details -->
        <div class="right_inner_container1_child1_child2">
          <h3> Professional & Personal Details </h3>
          <p> My name is Hamzah Ramadhan, I went to a two years college and NOVA and currently I'm a Senior major in Information Technology, seeking Cyber Security / IT field internship opportunity. </p>
        </div>
        <?php          
          }
        ?>
      <?php          
        }
      ?>

      </div>

    </div>
    <!-- Right inner Container 2 -->
    <div class="right_inner_container2">
      <p> Copyright Content </p>
    </div>

  </div>

</div>
<!--#include virtual="footer.inc"-->
<?php
require('footer.inc');
?>

</body>

</html>
