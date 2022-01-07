<?php
  require_once("config.php");
?>
<form method="post" class="form form_main">
<div class="field">
  <label class="label">Code du livre</label>
  <div class="control">
    <input class="input" name="code" type="number" placeholder="Code">
  </div>
</div>
    <button class="button is-primary">Confirmer</button>
</form>

<ul class="list-books">

</ul>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script src="./script/home.js"></script>