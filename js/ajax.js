$('#done').bind("click", function (e) {
    
    const email = $('#email').val(),
          password = $('#password').val(),
          repeatedPassword =  $('#repeatedPassword').val();
    
    $.ajax({
        url: 'save_results.php',
        type: 'POST',
        data: {
            email: email,
            password: password,
            repeatedPassword: repeatedPassword
        }
    }).done(function (res) {

        const result_msg = document.getElementById('result-msg');
        const form_div = document.getElementById('form_div');
        const result = getResult(res);

        if (typeof result_msg.innerText !== 'undefined') {
            result_msg.innerText = result; // IE8-
            $('#result-msg').css('color', '#FF0000');
        } else {
            result_msg.textContent = result; // Остальные браузеры
            $('#result-msg').css('color', '#FF0000');
        }

        if (result === 'Пользователь успешно зарегестрирован!') {
            $('#result-msg').css('color', '#008000');
            form_div.remove();
        }

    }).fail(function (res) {
        alert('Произошла ошибка выполнения запроса.\nОбновите страницу и попробуйте снова.');
        console.log('Произошла ошибка выполнения запроса');
    });

    function getResult(res) {

        if (document.getElementById('firstName').value === '' ||
            document.getElementById('lastName').value === '' ||
            document.getElementById('email').value === '' ||
            document.getElementById('password').value === '' ||
            document.getElementById('repeatedPassword').value === '') {

            const result = 'Необходимо заполнить все поля!';
            return result;
        } else if (res === 'true') {
            const result = 'Пользователь успешно зарегестрирован!';
            return result;
        } else if (res === 'email is not valid') {
            const result = 'Некорректный e-mail!';
            return result;
        } else if (res === 'email already exists') {
            const result = 'Такой email уже зарегистрирован!';
            return result;
        } else if (res === 'passwords are not equal') {
            const result = 'Пароли не совпадают!';
            return result;
        } else if (res === 'false') {
            const result = 'Почта уже существует и пароли не совпадают!';
            return result;
        } else {
            alert('Произошла ошибка со стороны сервера.\nОбновите страницу и попробуйте снова.');
            console.log('Произошла ошибка со стороны сервера');
        }
    }

    e.preventDefault();
});