<h1>Will List</h1>
<table>
<tr>
<th>id</th>
<th>name</th>
<th>migrations_name</th>
<th>created_at</th>
<th>updated_at</th>
<th>Actions</th>
</tr>
<?php foreach ($items as $item): ?>
<tr>
<td><?php echo $item['id']; ?></td>
<td><?php echo $item['name']; ?></td>
<td><?php echo $item['migrations_name']; ?></td>
<td><?php echo $item['created_at']; ?></td>
<td><?php echo $item['updated_at']; ?></td>
<td><a href='/Will/edit/<?php echo $item['id']; ?>'>Edit</a> | <form action="/Will/delete/<?php echo $item['id'] ;?>" method="post"><button>Delete</button></form>
</tr>
<?php endforeach; ?>
</table>

<input type="submit" value="">