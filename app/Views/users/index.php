<h1>Users List</h1>
<a href='/users/create'>Create Users</a>
<table>
<tr>
<th>id</th>
<th>name</th>
<th>email</th>
<th>password</th>
<th>created_at</th>
<th>updated_at</th>
<th>Actions</th>
</tr>
<?php foreach ($items as $item): ?>
<tr>
<td><?php echo $item['id']; ?></td>
<td><?php echo $item['name']; ?></td>
<td><?php echo $item['email']; ?></td>
<td><?php echo $item['password']; ?></td>
<td><?php echo $item['created_at']; ?></td>
<td><?php echo $item['updated_at']; ?></td>
<td><a href='/users/edit/<?php echo $item['id']; ?>'>Edit</a> | <form action ='/users/delete/<?php echo $item['id']; ?>' method='POST'><input type="submit" value="Delete"></form></td>
</tr>
<?php endforeach; ?>
</table>