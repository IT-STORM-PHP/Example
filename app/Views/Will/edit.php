<h1>Edit Will</h1>
<form method='POST' action='/Will/update/<?= htmlspecialchars($item['id'])?>'>
<label for='id'>id</label>
<input type='text' name='id' value='<?php echo $item['id']; ?>' id='id'><br>
<label for='name'>name</label>
<input type='text' name='name' value='<?= htmlspecialchars($item['name'])?>' id='name'><br>
<label for='migrations_name'>migrations_name</label>
<input type='text' name='migrations_name' value='<?php echo $item['migrations_name']; ?>' id='migrations_name'><br>
<label for='created_at'>created_at</label>
<input type='text' name='created_at' value='<?php echo $item['created_at']; ?>' id='created_at'><br>
<label for='updated_at'>updated_at</label>
<input type='text' name='updated_at' value='<?php echo $item['updated_at']; ?>' id='updated_at'><br>
<input type='submit' value='Update Will'>
</form>



