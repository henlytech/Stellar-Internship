<?php include 'config.php'; ?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registered Students</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tableexport/5.2.0/js/tableexport.min.js"></script>
</head>
<style>
  :root {
    --primary-color: #590696;
    --secondary-color: #8c52ff;
    --gradient-bg: radial-gradient(circle, rgba(89,6,150,1) 21%, rgba(140,82,255,1) 76%);
  }
</style>
<body>
<div class="container mt-5 pt-5">
  <h1 class="text-center">Registered Students</h1>
  <p class="text-center">With Filter, Export and Search Features</p>

  <div id="toolbar">
    <select class="form-control">
      <option value="">Export Basic</option>
      <option value="all">Export All</option>
      <option value="selected">Export Selected</option>
    </select>
  </div>

  <table id="table"
         data-toggle="table"
         data-search="true"
         data-filter-control="true"
         data-show-export="true"
         data-click-to-select="true"
         data-toolbar="#toolbar"
         class="table table-bordered">
    <thead>
    <tr>
      <th data-field="state" data-checkbox="true"></th>
      <th data-field="id" data-filter-control="input" data-sortable="true">ID</th> 
      <th data-field="name" data-filter-control="input" data-sortable="true">Name</th>
      <th data-field="gender" data-filter-control="select" data-sortable="true">Gender</th>
      <th data-field="email" data-filter-control="input">Email</th>
      <th data-field="phone" data-filter-control="input" data-sortable="true">Phone</th>
      <th data-field="track" data-filter-control="select" data-sortable="true">Track</th>
      <th data-field="college" data-filter-control="input" data-sortable="true">College</th>
      <th data-field="qualification" data-filter-control="select" data-sortable="true">Qualification</th>
      <th data-field="referral" data-filter-control="select" data-sortable="true">Referral</th>
      <th data-field="batch" data-filter-control="select" data-sortable="true">Batch</th>
      <th data-field="start_date" data-filter-control="input" data-sortable="true">Start Date</th>
      <th data-field="end_date" data-filter-control="input" data-sortable="true">End Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $tables = [
      ['name' => 'wd', 'track' => 'WD'],
      ['name' => 'ml', 'track' => 'ML'],
      ['name' => 'dl', 'track' => 'DL']
    ];

    foreach ($tables as $table) {
      $sql = "SELECT * FROM {$table['name']}";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td></td>";
          echo "<td>" . htmlspecialchars($row['id']) . "</td>";
          echo "<td>" . htmlspecialchars($row['name']) . "</td>";
          echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
          echo "<td>" . htmlspecialchars($row['email']) . "</td>";
          echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
          echo "<td>" . $table['track'] . "</td>";
          echo "<td>" . htmlspecialchars($row['college']) . "</td>";
          echo "<td>" . htmlspecialchars($row['qualification']) . "</td>";
          echo "<td>" . htmlspecialchars($row['referral']) . "</td>";
          echo "<td>" . (!empty($row['batch']) ? htmlspecialchars($row['batch']) : 'NA') . "</td>";
          echo "<td>" . (!empty($row['start_date']) ? htmlspecialchars($row['start_date']) : 'NA') . "</td>";
          echo "<td>" . (!empty($row['end_date']) ? htmlspecialchars($row['end_date']) : 'NA') . "</td>";
          echo "</tr>";
        }
      }
    }
    ?>
    </tbody>
  </table>
</div>

<script>
  var $table = $('#table');
  $(function () {
    $('#toolbar').find('select').change(function () {
      $table.bootstrapTable('refreshOptions', {
        exportDataType: $(this).val()
      });
    });
  });

  $('table').on("click", "tr", function () {
    $(this).toggleClass("bold-blue");
  });
</script>

<style>
  .bold-blue {
    font-weight: bold;
    color: #007bff;
  }
</style>
</body>
</html>
