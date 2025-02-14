<h1>Vue List</h1>
<a href='/vue/create'>Create Vue</a>
<table>
<tr>
<th>id</th>
<th>name</th>
<th>programing_language</th>
<th>framework</th>
<th>database</th>
<th>front_end</th>
<th>back_end</th>
<th>full_stack</th>
<th>mobile</th>
<th>desktop</th>
<th>cloud</th>
<th>devops</th>
<th>testing</th>
<th>security</th>
<th>data_science</th>
<th>machine_learning</th>
<th>artificial_intelligence</th>
<th>blockchain</th>
<th>iot</th>
<th>robotics</th>
<th>quantum_computing</th>
<th>cyber_security</th>
<th>cloud_computing</th>
<th>big_data</th>
<th>data_analytics</th>
<th>created_at</th>
<th>updated_at</th>
<th>Actions</th>
</tr>
<?php foreach ($items as $item): ?>
<tr>
<td><?php echo $item['id']; ?></td>
<td><?php echo $item['name']; ?></td>
<td><?php echo $item['programing_language']; ?></td>
<td><?php echo $item['framework']; ?></td>
<td><?php echo $item['database']; ?></td>
<td><?php echo $item['front_end']; ?></td>
<td><?php echo $item['back_end']; ?></td>
<td><?php echo $item['full_stack']; ?></td>
<td><?php echo $item['mobile']; ?></td>
<td><?php echo $item['desktop']; ?></td>
<td><?php echo $item['cloud']; ?></td>
<td><?php echo $item['devops']; ?></td>
<td><?php echo $item['testing']; ?></td>
<td><?php echo $item['security']; ?></td>
<td><?php echo $item['data_science']; ?></td>
<td><?php echo $item['machine_learning']; ?></td>
<td><?php echo $item['artificial_intelligence']; ?></td>
<td><?php echo $item['blockchain']; ?></td>
<td><?php echo $item['iot']; ?></td>
<td><?php echo $item['robotics']; ?></td>
<td><?php echo $item['quantum_computing']; ?></td>
<td><?php echo $item['cyber_security']; ?></td>
<td><?php echo $item['cloud_computing']; ?></td>
<td><?php echo $item['big_data']; ?></td>
<td><?php echo $item['data_analytics']; ?></td>
<td><?php echo $item['created_at']; ?></td>
<td><?php echo $item['updated_at']; ?></td>
<td><a href='/vue/edit/<?php echo $item['id']; ?>'>Edit</a> | <form action ='/vue/delete/<?php echo $item['id']; ?>' method='POST'><input type="submit" value="Delete"></form></td>
</tr>
<?php endforeach; ?>
</table>