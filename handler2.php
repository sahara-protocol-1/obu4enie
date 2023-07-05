<?php
require_once (__DIR__.'/crest.php');



for($i = 0; $i < 150; $i += 50) {
    $result[] = CRest::call(
        'crm.deal.list',
        [
            'order' => ['ID' => 'DESC'],
            'select' => ['ID', 'TITLE'],
            'start' => $i
        ]
        );
}

function separate($data) {
    $count = count($data);

    for($i = 0; $i < $count; $i++) {
        $some_array[] = $data[$i]['result'];
    }

    $some_array = array_reduce($some_array, 'array_merge', []);

    return $some_array;
}

$test = separate($result);

echo "<pre>";
echo "done";
// print_r($test);
echo "</pre>";

?>
<style>
  table {
    border-collapse: collapse;
  }
  table td, table th {
    border: 1px solid green;
    padding: 8px;
  }
</style>
<html>

<table>
<tr>
        <th>ID</th>
        <th>TITLE</th>

<?php foreach($test as $value): ?>
    
    <tr>
        <td><?php echo $value['ID']?></td>
        <td><?php echo $value['TITLE']?></td>
    </tr>

<?php endforeach; ?>

</table>

</html>