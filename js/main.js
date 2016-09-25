$(function () {
    "use strict";
    //handlebars
    var viewModule = (function () {
        return {

            setContent: function (arr) {
                var json = JSON.stringify(arr);
                json = JSON.parse(json);
                $("#content").empty();
                var template = Handlebars.compile($('#contentItemTemplate').html());
                $('#content').append(template(json));
            }
        }
    })();


    //вход в меню при нажатии (вход | регистрация)
    var selectionModule = (function () {
        var content = $('.wrapper-content');
        return {

            entry: function () {
                $(content).click(function (e) {
                    e.preventDefault();
                    var targ = $(e.target).attr('class'),
                        formEnter = $('.wrapper-singIn'),
                        formRgist = $('.Registration'),
                        content = $('#content'),
                        formEdit = $('#editForm');
                    if (targ === 'menuEnter') {
                        if (formEnter.hasClass('hidden') && content.hasClass('hidden')) {
                            if (!formRgist.hasClass('hidden')) {
                                formRgist.addClass('hidden');
                                content.removeClass('hidden');
                                formEnter.removeClass('hidden');
                            } else {
                                content.removeClass('hidden');
                                formEnter.removeClass('hidden');
                            }
                        }
                        else {
                            content.addClass('hidden');
                            formEnter.addClass('hidden');
                        }
                    }
                    if (targ === 'menuReg') {
                        if (formRgist.hasClass('hidden')) {
                            if (!formEnter.hasClass('hidden') && !content.hasClass('hidden')) {
                                content.addClass('hidden');
                                formEnter.addClass('hidden');
                                formEdit.addClass('hidden');
                                formRgist.removeClass('hidden');
                            } else {
                                formRgist.removeClass('hidden');
                            }
                        }
                        else {
                            formRgist.addClass('hidden');
                            /*content.removeClass('hidden');
                            formEnter.removeClass('hidden');*/
                        }
                    }

                });
            },
        }

    })();
    selectionModule.entry();


    //страница пользователя
    var userModule = (function () {
        var singIn = $('.wrapper-singIn, #editForm'),
            editForm = $('#editForm');
        return {

            check: function () {
                var locStor = localStorage.getItem('user'),
                    main = $('.content'),
                    aside = $('.wrapper-singIn');

                if(locStor !== null ){
                    var edit = '<button id="edit" class="logButton " type="button">Edit</button>',
                        exit = '<button id="exit" class="logButton " type="button">Exit account</button>',
                        jsonParse = JSON.parse(locStor);

                    main.empty();
                    aside.empty();
                    viewModule.setContent(jsonParse);
                    aside.append(edit, exit);
                }else {
                    $(singIn).click(function (e) {
                        e.preventDefault();
                        var targ = $(e.target).attr('id');
                        if (targ === 'logButton') {
                            var logVal = $('.log').val(),
                                passVal = $('.pass').val();

                            $.ajax('/login.php', {
                                dataType: 'json',
                                type: 'POST',
                                data: {
                                    email: logVal,
                                    password: passVal
                                },
                                success: function (response) {
                                    var status = response.status;
                                    var user = response.user,
                                        json = JSON.stringify(user);
                                    window.user = user;
                                    var crateSession = localStorage.setItem('user', json);
                                    if (status === 'success') {
                                        var edit = '<button id="edit" class="logButton " type="button">Edit</button>',
                                            exit = '<button id="exit" class="logButton " type="button">Exit account</button>';
                                        main.empty();
                                        aside.empty();
                                        viewModule.setContent(user);
                                        aside.append(edit, exit);
                                    } else {
                                        alert('Wrong email or password');
                                    }
                                }
                            });
                        }
                    })
                }
            },

            edit: function () {
                $(singIn).click(function (e) {
                    e.preventDefault();
                    var targ = $(e.target).attr('id'),
                        form = $('#editForm');
                    if (targ === 'edit') {
                        if (form.hasClass('hidden')) {
                            form.removeClass('hidden');
                        } else {
                            form.addClass('hidden');
                        }
                    }
                });
            },

            exitAccount: function () {
                $(singIn).click(function (e) {
                    e.preventDefault();
                    var targ = $(e.target).attr('id');
                    if (targ === 'exit') {
                        window.user = 0;
                        localStorage.removeItem('user');
                        location.reload();
                    }
                });
            },

            getInputData: function () {
                $(singIn).click(function (e) {
                    e.preventDefault();
                    var targ = $(e.target).attr('id');

                    if (targ === "change") {
                        var img = $('#imgs').val(),
                            name = $('#name').val(),
                            surname = $('#surname').val(),
                            age = $('#age').val(),
                            country = $('#country').val(),
                            job = $('#job').val(),
                            userObj = {
                                'id': user.id,
                                'img': img,
                                'name': name,
                                'surname': surname,
                                'age': age,
                                'country': country,
                                'job': job
                            },
                            json = JSON.stringify(userObj),
                            reason = '';

                        if(img === ''){
                            reason += 'Img - empty line  ';
                        }
                        if(name === ''){
                            reason += 'Name - empty line  ';
                        }
                        if(surname === ''){
                            reason += 'Surname - empty line  ';
                        }
                        if(age === '' ){
                            reason += 'Age - empty line  ';
                        }
                        if(country === ''){
                            reason += 'Country - empty line  ';
                        }
                        if(job === ''){
                            reason += 'Job - empty line  ';
                        }
                        if(reason === ''){
                            localStorage.removeItem('user');
                            var crateSession = localStorage.setItem('user', json);
                            $.ajax('/user-info.php', {
                                dataType: 'json',
                                type: 'POST',
                                data: userObj,
                                success: function (response) {
                                    var status = response.status;
                                    if (status == true) {
                                        viewModule.setContent(userObj);
                                    } else {
                                        alert('Something wrong')
                                    }
                                    console.log(response);
                                }
                            });
                        }else {
                            alert(reason);
                            //myForm.trigger( 'reset' );
                            return false;
                        }



                    }
                });
            }

        }
    })();
    userModule.check();
    userModule.edit();
    userModule.exitAccount();
    userModule.getInputData();

    //регистрация
    var registrationModule = (function () {

        return {
            validate: function () {
                var submitRgist = $('#submit-regist'),
                    wrapper = $('.Registration');
                $(submitRgist).click(function (e) {
                    e.preventDefault();
                    var targ = $(e.target).attr('id');
                    if(targ === 'submit-regist'){
                        var reason = "",
                            emailValue = $('.email').val(),
                            passwordValue = $('.password').val(),
                            myForm = $('#form-registration'),
                            pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

                        if (emailValue === "" || !pattern.test(emailValue)) {
                            reason += "Error email!  ";
                        }
                        if (passwordValue === "" || (/[^0-9]/).test(passwordValue)) {
                            reason += "Error password, it is not the numbers! ";
                        }
                        if (reason === "") {
                            $.ajax('/registration.php', {
                                dataType: 'json',
                                type: 'POST',
                                data: {
                                    email: emailValue,
                                    password: passwordValue
                                },
                                success: function (response) {
                                    window.user = response.user;
                                    console.log(response.user);
                                }
                            })
                            //myForm.trigger( 'reset' );
                        }
                        else {
                            alert(reason);
                            //myForm.trigger( 'reset' );
                            return false;
                        }
                    }
                });
            }
        }

    })();
    registrationModule.validate();


});