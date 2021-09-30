<?php

  require "shared/header.php";
  require "shared/navbar2.php";

  require "shared/sidebar_begin.php";
?>
<br />

<h2>Reports</h2>

<a href="report.php?ID=Q12">
<div class="card border-primary mb-3" style="max-width: 18rem;">
  <div class="card-header">Report 1</div>
  <div class="card-body text-primary">
    <h5 class="card-title">Question 12</h5>
    <p class="card-text">Get details of all the people who got vaccinated only one dose and are of
      group ages 1 to 3 (first-name, last-name, date of birth, email, phone, city, date of
      vaccination, vaccination type, been infected by COVID-19 before or not).</p>
  </div>
</div>
</a>

<a href="report.php?ID=Q13">
<div class="card border-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header">Report 2</div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Question 13</h5>
    <p class="card-text">Get details of all the people who live in the city of Montréal and who got
      vaccinated at least two doses of different types of vaccines. (First-name, lastname, date of birth, email, phone, city, date of vaccination, vaccination type, been
      infected by COVID-19 before or not).</p>
  </div>
</div>
</a>

<a href="report.php?ID=Q14">
<div class="card border-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header">Report 3</div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Question 14</h5>
    <p class="card-text">Get details of all the people who got vaccinated and have been infected with at
      least two different variants of Covid-19 (first-name, last-name, date of birth,
      email, phone, city, date of vaccination, vaccination type, number of times being
      infected by COVID-19 variants)</p>
  </div>
</div>
</a>

<a href="report.php?ID=Q15">
<div class="card border-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header">Report 4</div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Question 15</h5>
    <p class="card-text">Give a report of the inventory of vaccines in each province. The report should
      include for each province and for each type of vaccine, the total number of
      vaccines available in the province. The report should be displayed in ascending
      order by province then by descending order of number of vaccines in the
      inventory.</p>
  </div>
</div>
</a>

<a href="report.php?ID=Q16">
<div class="card border-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header">Report 5</div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Question 16</h5>
    <p class="card-text">Give a report of the population’s vaccination by province between January 1st
2021 and July 22nd 2021. The report should include for each province and for
each type of vaccine, the total number of people using the type of vaccine. If a
person have been vaccinated with Pfizer twice then the person will be counted
only once for Pfizer. But if a person have been vaccinated one dose for Pfizer and
one dose for Moderna then the person is counted once for each type.</p>
  </div>
</div>
</a>

<a href="report.php?ID=Q17">
<div class="card border-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header">Report 6</div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Question 17</h5>
    <p class="card-text">Give a report by city in Québec the total number of vaccines received in each
city between January 1st 2021 and July 22nd 2021.</p>
  </div>
</div>
</a>

<a href="report.php?ID=Q18">
<div class="card border-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header">Report 7</div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Question 18</h5>
    <p class="card-text">Give a detailed report of all the facilities in the city of Montréal. The report
should include the name, address, type and phone number of the facility, the total
number of public health workers working in the facility, the total number of
shipments of vaccines received by the facility, the total number of doses received
by the facility, the total number of transfer of vaccines from the facility and
transfer to the facility, the total number of doses transferred from the facility, the
total number of doses transferred to the facility, the total number of vaccines of
each type in the facility, the number of people vaccinated in the facility, and the
number of doses people have received in the facility. </p>
  </div>
</div>
</a>

<a href="report.php?ID=Q19">
<div class="card border-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header">Report 8</div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Question 19</h5>
    <p class="card-text">Give a list of all public health workers in a specific facility (EmployeeID,
Social Security Number (SSN), first-name, last-name, date of birth, medicare card
number, telephone-number, address, city, province, postal-code, citizenship, email
address, and history of employment).</p>
  </div>
</div>
</a>

<a href="report.php?ID=Q20">
<div class="card border-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header">Report 9</div>
  <div class="card-body text-secondary">
    <h5 class="card-title">Question 20</h5>
    <p class="card-text">Give a list of all public health workers in Québec who never been vaccinated
or who have been vaccinated only one dose for Covid-19 (EmployeeID, firstname, last-name, date of birth, telephone-number, city, email address, locations
name where the employee work).</p>
  </div>
</div>
</a>
<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter = [];

  require 'shared/footer.php';
?>
