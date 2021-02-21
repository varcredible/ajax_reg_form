<?php require 'templates/header.php'?>

<div class="row d-flex justify-content-center">
  <form action="save_results.php" method="post">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="firstName">Имя<span class="requred_field">*</span></label>
        <input type="text" class="form-control" id="firstName" placeholder="Ввести имя">
      </div>
      <div class="form-group col-md-6">
        <label for="lastName">Фамилия<span class="requred_field">*</span></label>
        <input type="text" class="form-control" id="lastName" placeholder="Ввести фамилию">
      </div>
    </div>
    <div class="form-group">
      <label for="email">Email<span class="requred_field">*</span></label>
      <input type="input" class="form-control" id="email" placeholder="Ввести почту">
    </div>
    <div class="form-group">
      <label for="password">Пароль<span class="requred_field">*</span></label>
      <input type="password" class="form-control" id="password" placeholder="Ввести пароль">
    </div>
    <div class="form-group">
      <label for="repeatedPassword">Повторите пароль<span class="requred_field">*</span></label>
      <input type="password" class="form-control" id="repeatedPassword" placeholder="Ввести пароль ещё раз">
    </div>
    <div class="d-flex justify-content-center">
      <button id="done" class="btn btn-primary">Зарегистрироваться</button>
    </div>
  </form>
</div>

<?php require 'templates/footer.php'?>