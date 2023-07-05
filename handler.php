<?php
require_once (__DIR__.'/crest.php');



$data = $_POST['key'];


for($i = 1; $i <= 10; $i++) {
    CRest::call(
        'crm.deal.add',
        [
         'fields' => [
             'TITLE' => "$data $i",
             ]
        ]
    );
};





for($i = 0; $i < 50; $i += 50) {
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
echo $data;
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


