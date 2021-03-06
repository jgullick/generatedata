<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
  body { margin: 10px; }
  table, th, td { font-family: arial; font-size: 8pt; }
  table { background-color: #efefef; border: 2px solid #dddddd; width: 100%; }
  th { background-color: #efefef; }
  td { background-color: #ffffff; }
  </style>
</head>
<body>

<table cellpadding="1" cellspacing="1">
<tr>
  <?php
  // TODO
  $sorted_cols = gd_sort_by_col_order($g_template);
  foreach ($sorted_cols as $col)
  {
    echo "<th>{$col["title"]}</th>";
  }
  ?>
</tr>
<?php

ksort($g_template, SORT_NUMERIC); // TODO

for ($row=1; $row<=$g_numResults; $row++) {

	// TODO. With new design, this chunk of code will be handled PRIOR to the Export Type's generate() method
  $row_data = array();
  while (list($order, $data_types) = each($g_template))
  {
    foreach ($data_types as $data_type)
    {
      $order = $data_type["column_num"];
      $data_type_folder = $data_type["data_type_folder"];
      $data_type_func = "{$data_type_folder}_generate_item";
      $data_type["random_data"] = $data_type_func($row, $data_type["options"], $row_data);
      $row_data["$order"] = $data_type;
    }
  }
  reset($g_template);
  ksort($row_data, SORT_NUMERIC);

  // ---------------------

  echo "<tr>";
  foreach ($row_data as $data)
  {
    $val = (is_array($data["random_data"])) ? $data["random_data"]["display"] : $data["random_data"];
    echo "<td>$val</td>";
  }
  echo "</tr>";
}
?>
</table>

</body>
</html>