<?php
  require_once("config.php");
?>
<form method="post" class="form form_main">
<div class="field">
  <label class="label">Code du livre</label>
  <div class="control">
    <input class="input_isbn" name="code" type="number" placeholder="Code">
  </div>
</div>
    <button class="button is-primary">Confirmer</button>
</form>

<div class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Modal title</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <!-- Content ... -->
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success">Save changes</button>
      <button class="button">Cancel</button>
    </footer>
  </div>
</div>

<ul class="list-books">

</ul>
