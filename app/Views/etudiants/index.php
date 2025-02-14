<h1>Etudiants List</h1>
<a href='/etudiants/create'>Create Etudiants</a>
<table>
<tr>
<th>id</th>
<th>name</th>
<th>prenoms</th>
<th>email</th>
<th>password</th>
<th>telephone</th>
<th>adresse</th>
<th>ville</th>
<th>pays</th>
<th>code_postal</th>
<th>sexe</th>
<th>date_naissance</th>
<th>created_at</th>
<th>updated_at</th>
<th>Actions</th>
</tr>
<?php foreach ($items as $item): ?>
<tr>
<td><?php echo $item['id']; ?></td>
<td><?php echo $item['name']; ?></td>
<td><?php echo $item['prenoms']; ?></td>
<td><?php echo $item['email']; ?></td>
<td><?php echo $item['password']; ?></td>
<td><?php echo $item['telephone']; ?></td>
<td><?php echo $item['adresse']; ?></td>
<td><?php echo $item['ville']; ?></td>
<td><?php echo $item['pays']; ?></td>
<td><?php echo $item['code_postal']; ?></td>
<td><?php echo $item['sexe']; ?></td>
<td><?php echo $item['date_naissance']; ?></td>
<td><?php echo $item['created_at']; ?></td>
<td><?php echo $item['updated_at']; ?></td>
<td><a href='/etudiants/edit/<?php echo $item['id']; ?>'>Edit</a> | <form action ='/etudiants/delete/<?php echo $item['id']; ?>' method='POST'><input type="submit" value="Delete"></form></td>
</tr>
<?php endforeach; ?>
</table>