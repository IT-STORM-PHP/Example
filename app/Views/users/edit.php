<h1>Edit Users</h1>
<form method='POST' action='/users/update/<?php echo $item['id']; ?>'>
<label for='id'>id</label>
<input type='text' name='id' value='<?php echo $item['id']; ?>' id='id'><br>
<label for='name'>name</label>
<input type='text' name='name' value='<?php echo $item['name']; ?>' id='name'><br>
<label for='email'>email</label>
<input type='text' name='email' value='<?php echo $item['email']; ?>' id='email'><br>
<label for='password'>password</label>
<input type='text' name='password' value='<?php echo $item['password']; ?>' id='password'><br>
<label for='created_at'>created_at</label>
<input type='text' name='created_at' value='<?php echo $item['created_at']; ?>' id='created_at'><br>
<label for='updated_at'>updated_at</label>
<input type='text' name='updated_at' value='<?php echo $item['updated_at']; ?>' id='updated_at'><br>
<input type='submit' value='Update Users'>
</form>