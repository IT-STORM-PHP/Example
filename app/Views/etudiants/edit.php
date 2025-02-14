<h1>Edit Etudiants</h1>
<form method='POST' action='/etudiants/update/<?php echo $item['id']; ?>'>
<label for='id'>id</label>
<input type='text' name='id' value='<?php echo $item['id']; ?>' id='id'><br>
<label for='name'>name</label>
<input type='text' name='name' value='<?php echo $item['name']; ?>' id='name'><br>
<label for='prenoms'>prenoms</label>
<input type='text' name='prenoms' value='<?php echo $item['prenoms']; ?>' id='prenoms'><br>
<label for='email'>email</label>
<input type='text' name='email' value='<?php echo $item['email']; ?>' id='email'><br>
<label for='password'>password</label>
<input type='text' name='password' value='<?php echo $item['password']; ?>' id='password'><br>
<label for='telephone'>telephone</label>
<input type='text' name='telephone' value='<?php echo $item['telephone']; ?>' id='telephone'><br>
<label for='adresse'>adresse</label>
<input type='text' name='adresse' value='<?php echo $item['adresse']; ?>' id='adresse'><br>
<label for='ville'>ville</label>
<input type='text' name='ville' value='<?php echo $item['ville']; ?>' id='ville'><br>
<label for='pays'>pays</label>
<input type='text' name='pays' value='<?php echo $item['pays']; ?>' id='pays'><br>
<label for='code_postal'>code_postal</label>
<input type='text' name='code_postal' value='<?php echo $item['code_postal']; ?>' id='code_postal'><br>
<label for='sexe'>sexe</label>
<input type='text' name='sexe' value='<?php echo $item['sexe']; ?>' id='sexe'><br>
<label for='date_naissance'>date_naissance</label>
<input type='text' name='date_naissance' value='<?php echo $item['date_naissance']; ?>' id='date_naissance'><br>
<label for='created_at'>created_at</label>
<input type='text' name='created_at' value='<?php echo $item['created_at']; ?>' id='created_at'><br>
<label for='updated_at'>updated_at</label>
<input type='text' name='updated_at' value='<?php echo $item['updated_at']; ?>' id='updated_at'><br>
<input type='submit' value='Update Etudiants'>
</form>