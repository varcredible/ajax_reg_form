$('#done').on('click', function (e) {  
  e.preventDefault();  
  
  const email = $('#email').val(),
        password = $('#password').val(),
        repeatedPassword = $('#repeatedPassword').val();

  $.ajax({
    url: 'save_results.php',
    type: 'POST',
    data: {
      email: email,
      password: password,
      repeatedPassword: repeatedPassword,
    },
  })
    .done(function (res) {
      const result_msg = document.querySelector('#result-msg');
      const form_div = document.querySelector('#form_div');
      const result = getResult(res);
      
      result_msg.textContent = result;
      $('#result-msg').css('color', '#FF0000');

      if (result === 'Пользователь успешно зарегестрирован!') {
        $('#result-msg').css('color', '#008000');
        form_div.remove();
      }
    })
    .fail(function (res) {
      alert(
        'Произошла ошибка выполнения запроса.\nОбновите страницу и попробуйте снова.'
      );
      console.log('Произошла ошибка выполнения запроса');
    });    
});

function getResult(res) {
  
  let result;
  
  if (
    document.querySelector('#firstName').value === '' ||
    document.querySelector('#lastName').value === '' ||
    document.querySelector('#email').value === '' ||
    document.querySelector('#password').value === '' ||
    document.querySelector('#repeatedPassword').value === ''
  ) {
    result = 'Необходимо заполнить все поля!';
  } else if (res === 'true') {
    result = 'Пользователь успешно зарегестрирован!';
  } else if (res === 'email is not valid') {
    result = 'Некорректный e-mail!';
  } else if (res === 'email already exists') {
    result = 'Такой email уже зарегистрирован!';
  } else if (res === 'passwords are not equal') {
    result = 'Пароли не совпадают!';
  } else if (res === 'false') {
    result = 'Почта уже существует и пароли не совпадают!';
  } else {
    alert(
      'Произошла ошибка со стороны сервера.\nОбновите страницу и попробуйте снова.'
    );
  }

  return result;
}