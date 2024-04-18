
<div class="container">
<h2>Opdater Password</h2>
  <form action="" method="post">
    <div class="form-group">
      <label for="current_password">Nuværende Password:</label>
      <input type="password" class="form-control" id="current_password" placeholder="Indtast nuværende password" name="current_password">
    </div>
    <div class="form-group">
      <label for="new_password">Nyt Password:</label>
      <input type="password" class="form-control" id="new_password" placeholder="Indtast nyt password" name="new_password">
    </div>
    <div class="form-group">
      <label for="confirm_new_password">Bekræft Password :</label>
      <input type="password" class="form-control" id="confirm_new_password" placeholder="Bekræft dit nye password" name="confirm_new_password">
    </div>
    <input type="hidden" name="csrf_token" value="<?php echo Token::generate('update_account_form'); ?>">
    <input class="btn btn-primary" type="submit" value="Opdater Profil">
    <button type="button" class="btn btn-secondary" onclick="window.location.href='/profile'">Annuler</button>
  </form>
</div>
