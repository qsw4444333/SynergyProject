var active_create_block = 1;

var mxQuestionnaires = 6
var mxQuestionnaire = 3;

function close_c_block(){
    let c_block = document.querySelector(`#create-block-${active_create_block}`);
    c_block.classList.remove('modal-create-block-not-hover');
    document.querySelector(`#create-block-${active_create_block}`).querySelector('.modal-create-block-hide').style.setProperty('display', 'block');
    document.querySelector(`#create-block-${active_create_block}`).querySelector('.modal-create-block-show').style.setProperty('display', 'none'); 
};

function err_mx_que_block(){
    document.querySelector('.modal-create-nav-block-e > span').innerText = 'Вы создали 6/6 полей!';
    document.querySelector('.modal-create-nav-block-e').style.setProperty('opacity', '1');
};

function createQuestionnaire(q_name){
    let body = document.createElement('div');
    body.classList.add('main-left-block');
    if (document.querySelectorAll('.main-left-block').length == 0){
        body.id = `questionnaire-1`;
    }
    else{
        body.id = `questionnaire-${Number(document.querySelectorAll('.main-left-block')[document.querySelectorAll('.main-left-block').length - 1].id.split('-')[1]) + 1}`;
    }
    let b_name = document.createElement('p');
    b_name.innerText = q_name;
    let ind = document.createElement('div');
    ind.classList.add('main-left-block-indicator');
    ind.classList.add('not-passed');
    body.appendChild(b_name);
    body.appendChild(ind);
    document.querySelector('.main-left-block-create').before(body);
    $(body).click(function(){
        let modal = document.querySelector('.edit-que-modal');
        modal.querySelector('.modal-name').querySelector('h4').innerText = $(this)[0].querySelector('p').innerText;
        let black_block = document.querySelector('.black-block');
        black_block.style.setProperty('display', 'block');
        modal.style.setProperty('display', 'block');
        setTimeout(function(){
            black_block.style.setProperty('z-index', '100');
            black_block.style.setProperty('opacity', '1');
        }, 75);
        setTimeout(function(){
            modal.style.setProperty('z-index', '101');
            modal.style.setProperty('opacity', '1');
        }, 200);
        let ans = {'ques': [], 'amounts': 0};
        active_que = $(this)[0].querySelector('p').innerText;
        $.ajax({
            url: `/forms/${active_que}`,
            type: 'get',
            success: function(data){
                for (let i = 0; i < 6; i++){
                    if (JSON.parse(data)[`question${i + 1}`] != ''){
                        ans['ques'].push(JSON.parse(data)[`question${i + 1}`]);
                        ans['amounts'] += 1
                    }
                }
                let que = '';
                let blocks = document.querySelectorAll('.pass-que-block');
                for (let j = 0; j < blocks.length; j++){
                    blocks[j].remove();
                }
                for (let i = 0; i < ans['amounts']; i++){
                    que = ans['ques'][i]
                    let block = document.createElement('div');
                    block.classList.add('pass-que-block');
                    let label = document.createElement('label');
                    label.innerText = que;
                    block.appendChild(label);
                    let input = document.createElement('input');
                    input.name = `answer-${i}`;
                    input.id = `answer-${i}`;
                    input.type = 'text';
                    block.appendChild(input);
                    document.querySelector('#pass-subm').before(block);
                }
            }
        });  
        
    });
};

function update_amount_que(){
    document.querySelector('.amount-tests > span').innerText = `Вы прошли ${document.querySelectorAll('.passed').length} из ${document.querySelectorAll('.main-left-block').length} анкет`;
};

function to_default_config(){
    document.querySelector('#questionnaire-name').value = '';
    for(let i = 0; i < document.querySelectorAll('.modal-create-block').length; i++){
        
    }
};

var active_que = '';

$(document).ready(function(){
    update_amount_que();

    $('.close-create-questionnaire').click(function(){
        document.querySelector('.modal-create-nav-block-e').style.setProperty('opacity', '0');
        document.querySelector('.modal-create-nav-block-e > span').innerText = '';
        let modal = document.querySelector('.create-questionnaire-modal');
        let black_block = document.querySelector('.black-block');
        modal.style.setProperty('opacity', '0');
        setTimeout(function(){
            modal.style.setProperty('z-index', '-1');
        }, 500);
        setTimeout(function(){
            black_block.style.setProperty('opacity', '0');
        }, 150);
        setTimeout(function(){
            black_block.style.setProperty('z-index', '-1');
        }, 500);
        setTimeout(function(){
            black_block.style.setProperty('display', 'none');
            modal.style.setProperty('display', 'none');
            document.querySelector('#questionnaire-name').style.setProperty('border', '1px solid #3e3e3e');
            document.querySelector('#questionnaire-error-name').innerText = '';
            close_c_block();
        }, 500);
    });

    $('.modal-block-save').click(function(){
        let sec_name = document.querySelector('#sec-name').value;
        if (sec_name.length <= 0){
            document.querySelector('#sec-name').style.setProperty('border-color', '#f00');
            return;
        }
        else if (sec_name.length > 20){
            document.querySelector('#sec-name').style.setProperty('border-color', '#f00');
            return;
        }
        else{
            document.querySelector('#sec-name').style.setProperty('border-color', '#3e3e3e');
        }

        let name = document.querySelector('#name').value;
        if (name.length <= 0){
            document.querySelector('#name').style.setProperty('border-color', '#f00');
            return;
        }
        else if (name.length > 20){
            document.querySelector('#name').style.setProperty('border-color', '#f00');
            return;
        }
        else{
            document.querySelector('#name').style.setProperty('border-color', '#3e3e3e');
        }

        let surname = document.querySelector('#surname').value;
        if (surname.length <= 0){
            document.querySelector('#surname').style.setProperty('border-color', '#f00');
            return;
        }
        else if (surname.length > 20){
            document.querySelector('#surname').style.setProperty('border-color', '#f00');
            return;
        }
        else{
            document.querySelector('#surname').style.setProperty('border-color', '#3e3e3e');
        }

        let ser_p = document.querySelector('#ser-p').value;
        if (ser_p.length != 4){
            document.querySelector('#ser-p').style.setProperty('border-color', '#f00');
            return;
        }
        else{
            document.querySelector('#ser-p').style.setProperty('border-color', '#3e3e3e');
        }

        let num_p = document.querySelector('#num-p').value;
        if (num_p.length != 6){
            document.querySelector('#num-p').style.setProperty('border-color', '#f00');
            return;
        }
        else{
            document.querySelector('#num-p').style.setProperty('border-color', '#3e3e3e');
        }

        let email = document.querySelector('#email').value;
        if (email.length <= 0){
            document.querySelector('#email').style.setProperty('border-color', '#f00');
            return;
        }
        else if (email.length > 30){
            document.querySelector('#email').style.setProperty('border-color', '#f00');
            return;
        }
        else if (email.split('@').length - 1 != 1 || email.split('.').length - 1 < 1){
            document.querySelector('#email').style.setProperty('border-color', '#f00');
            return;
        }
        else{
            document.querySelector('#email').style.setProperty('border-color', '#3e3e3e');
        }

        let pass = document.querySelector('#pass').value;
        if (pass.length < 8){
            document.querySelector('#pass').style.setProperty('border-color', '#f00');
            return;
        }
        else{
            document.querySelector('#pass').style.setProperty('border-color', '#3e3e3e');
        }

        let data_to_send = {'name': name,
                            'secname': sec_name,
                            'surname': surname,
                            'pas_number': num_p,
                            'pas_series': ser_p,
                            'email': email,
                            'password': pass};

        $.ajax({
            url: '/',
            type: 'POST',
            data: JSON.stringify(data_to_send),
            dataType: 'json',
            processData: false,
            success: function(data){
                let modal = document.querySelector('.edit-profile-modal');
                let black_block = document.querySelector('.black-block');
                modal.style.setProperty('opacity', '0');
                setTimeout(function(){
                    modal.style.setProperty('z-index', '-1');
                }, 500);
                setTimeout(function(){
                    black_block.style.setProperty('opacity', '0');
                }, 150);
                setTimeout(function(){
                    black_block.style.setProperty('z-index', '-1');
                }, 500);
                setTimeout(function(){
                    black_block.style.setProperty('display', 'none');
                    modal.style.setProperty('display', 'none');
                    close_c_block();
                }, 500);
            }
        });

        for (let i = 0; i < document.querySelectorAll('.contact-block').length; i++){
            switch(document.querySelectorAll('.contact-block')[i].querySelector('span').innerText){
                case 'Фамилия:':
                    document.querySelectorAll('.contact-block')[i].querySelector('p').innerText = sec_name;
                    break;
                case 'Имя:':
                    document.querySelectorAll('.contact-block')[i].querySelector('p').innerText = name;
                    break;
                case 'Отчество:':
                    document.querySelectorAll('.contact-block')[i].querySelector('p').innerText = surname;
                    break;
                case 'Серия паспорта:':
                    document.querySelectorAll('.contact-block')[i].querySelector('p').innerText = ser_p;
                    break;
                case 'Номер паспорта:':
                    document.querySelectorAll('.contact-block')[i].querySelector('p').innerText = num_p;
                    break;
            }
        }
        document.querySelectorAll('.main-right-inner-right-block')[0].querySelector('p').innerText = email;
        document.querySelector('.pass > span').innerText = pass;

    });

    $('#e-que-btn-d').click(function(){
        let b_name = document.querySelector('.edit-que-modal').querySelector('.modal-name > h4').innerText;
        let data_to_send = {'name': b_name};
        $.ajax({
            url: '/forms/d',
            type: 'POST',
            data: JSON.stringify(data_to_send),
            dataType: 'json',
            processData: false,
            success: function(data){
                for (let i = 0; i < document.querySelectorAll('.main-left-block').length; i++){
                    if (document.querySelectorAll('.main-left-block')[i].querySelector('p').innerText == b_name){
                        document.querySelectorAll('.main-left-block')[i].remove();
                        let modal = document.querySelector('.edit-que-modal');
                        let black_block = document.querySelector('.black-block');
                        modal.style.setProperty('opacity', '0');
                        update_amount_que();
                        setTimeout(function(){
                            modal.style.setProperty('z-index', '-1');
                        }, 500);
                        setTimeout(function(){
                            black_block.style.setProperty('opacity', '0');
                        }, 100);
                        setTimeout(function(){
                            black_block.style.setProperty('z-index', '-1');
                        }, 500);
                        setTimeout(function(){
                            black_block.style.setProperty('display', 'none');
                            modal.style.setProperty('display', 'none');
                        }, 210);
                    }
                }
            }
        })
    });

    $('.edit-profile-close').click(function(){
        let modal = document.querySelector('.edit-profile-modal');
        let black_block = document.querySelector('.black-block');
        modal.style.setProperty('opacity', '0');
        setTimeout(function(){
            modal.style.setProperty('z-index', '-1');
        }, 500);
        setTimeout(function(){
            black_block.style.setProperty('opacity', '0');
        }, 150);
        setTimeout(function(){
            black_block.style.setProperty('z-index', '-1');
        }, 500);
        setTimeout(function(){
            black_block.style.setProperty('display', 'none');
            modal.style.setProperty('display', 'none');
            close_c_block();
        }, 500);
    });

    $('.ctontact-block-edit').click(function(){
        let modal = document.querySelector('.edit-profile-modal');
        let black_block = document.querySelector('.black-block');
        black_block.style.setProperty('display', 'block');
        modal.style.setProperty('display', 'block');
        setTimeout(function(){
            black_block.style.setProperty('z-index', '100');
            black_block.style.setProperty('opacity', '1');
        }, 75);
        setTimeout(function(){
            modal.style.setProperty('z-index', '101');
            modal.style.setProperty('opacity', '1');
        }, 200);
    });

    $('.main-left-block-create').click(function(){
        let modal = document.querySelector('.create-questionnaire-modal');
        let black_block = document.querySelector('.black-block');
        black_block.style.setProperty('display', 'block');
        modal.style.setProperty('display', 'block');
        setTimeout(function(){
            black_block.style.setProperty('z-index', '100');
            black_block.style.setProperty('opacity', '1');
        }, 75);
        setTimeout(function(){
            modal.style.setProperty('z-index', '101');
            modal.style.setProperty('opacity', '1');
        }, 200);
    });

    $('#show_pass').click(function(){
        let modal = document.querySelector('.pass-modal-show');
        let black_block = document.querySelector('.black-block');
        black_block.style.setProperty('display', 'block');
        modal.style.setProperty('display', 'block');
        setTimeout(function(){
            black_block.style.setProperty('z-index', '100');
            black_block.style.setProperty('opacity', '1');
        }, 75);
        setTimeout(function(){
            modal.style.setProperty('z-index', '101');
            modal.style.setProperty('opacity', '1');
        }, 200);
    });

    $('.close-pass-modal').click(function(){
        let modal = document.querySelector('.pass-modal-show');
        let black_block = document.querySelector('.black-block');
        modal.style.setProperty('opacity', '0');
        setTimeout(function(){
            modal.style.setProperty('z-index', '-1');
        }, 500);
        setTimeout(function(){
            black_block.style.setProperty('opacity', '0');
        }, 100);
        setTimeout(function(){
            black_block.style.setProperty('z-index', '-1');
        }, 500);
        setTimeout(function(){
            black_block.style.setProperty('display', 'none');
            modal.style.setProperty('display', 'none');
        }, 500);
    });

    $('.main-left-block').click(function(){
        let answers = {};
        let main_block = $(this)[0].querySelector('.passed');
        if (main_block){
            console.log('Passed')
            document.querySelector('#e-que-btn-g > span').innerText = 'Посмотреть ответы';
            document.querySelector('#pass-subm').style.setProperty('display', 'none');
            $.ajax({
                url: `/answers/${$(this)[0].querySelector('p').innerText}`,
                type: 'get',
                success: function(data){
                    data = JSON.parse(data);
                    for (let i = 0; i < 6; i++){
                        if (data[`answer${i + 1}`]){
                            answers[`answer${i + 1}`] = data[`answer${i + 1}`];
                        }
                    }
                }
            });
        }
        else{
            console.log('N-Passed')
            document.querySelector('#e-que-btn-g > span').innerText = 'Пройти';
            document.querySelector('#pass-subm').style.setProperty('display', 'block');
        }

        let modal = document.querySelector('.edit-que-modal');
        modal.querySelector('.modal-name').querySelector('h4').innerText = $(this)[0].querySelector('p').innerText;
        active_que = $(this)[0].querySelector('p').innerText;
        let black_block = document.querySelector('.black-block');
        let ans = {'ques': [],
                   'amounts': 0};

        $.ajax({
            url: `/forms/${active_que}`,
            type: 'get',
            success: function(data){
                for (let i = 0; i < 6; i++){
                    if (JSON.parse(data)[`question${i + 1}`] != ''){
                        ans['ques'].push(JSON.parse(data)[`question${i + 1}`]);
                        ans['amounts'] += 1
                    }
                }
                let que = '';
                let blocks = document.querySelectorAll('.pass-que-block');
                for (let j = 0; j < blocks.length; j++){
                    blocks[j].remove();
                }
                if (main_block){
                    for (let i = 0; i < ans['amounts']; i++){
                        que = ans['ques'][i]
                        let block = document.createElement('div');
                        block.classList.add('pass-que-block');
                        let label = document.createElement('label');
                        label.innerText = que;
                        block.appendChild(label);
                        let input = document.createElement('input');
                        input.readOnly = true;
                        input.id = `answer-${i}`;
                        input.type = 'text';
                        input.value = answers[`answer${i + 1}`]
                        block.appendChild(input);
                        document.querySelector('#pass-subm').before(block);
                    }
                }
                else{
                    for (let i = 0; i < ans['amounts']; i++){
                        que = ans['ques'][i]
                        let block = document.createElement('div');
                        block.classList.add('pass-que-block');
                        let label = document.createElement('label');
                        label.innerText = que;
                        block.appendChild(label);
                        let input = document.createElement('input');
                        input.name = `answer-${i}`;
                        input.id = `answer-${i}`;
                        input.type = 'text';
                        block.appendChild(input);
                        document.querySelector('#pass-subm').before(block);
                    }
                }
            }
        });  

        black_block.style.setProperty('display', 'block');
        modal.style.setProperty('display', 'block');
        setTimeout(function(){
            black_block.style.setProperty('z-index', '100');
            black_block.style.setProperty('opacity', '1');
        }, 75);
        setTimeout(function(){
            modal.style.setProperty('z-index', '101');
            modal.style.setProperty('opacity', '1');
        }, 200);
    });

    $('.edit-que-close').click(function(){
        let modal = document.querySelector('.edit-que-modal');
        let black_block = document.querySelector('.black-block');
        modal.style.setProperty('opacity', '0');
        setTimeout(function(){
            modal.style.setProperty('z-index', '-1');
        }, 500);
        setTimeout(function(){
            black_block.style.setProperty('opacity', '0');
        }, 100);
        setTimeout(function(){
            black_block.style.setProperty('z-index', '-1');
        }, 500);
        setTimeout(function(){
            black_block.style.setProperty('display', 'none');
            modal.style.setProperty('display', 'none');
        }, 500);
    });

    $('.modal-create-save').click(function(){
        let questionnaire_name = document.querySelector('#questionnaire-name').value;
        $.ajax({
            url: `/forms/c`,
            type: 'POST',
            data: JSON.stringify({'name': document.querySelector('#questionnaire-name').value}),
            dataType: 'json',
            processData: false,
            success: function(data){
                if (data['is']){
                    document.querySelector('#questionnaire-name').style.setProperty('border', '1px solid #f00');
                    document.querySelector('#questionnaire-error-name').innerText = 'Это название уже используется!';
                    return;
                }
            }
        });  
        if (questionnaire_name == ''){
            document.querySelector('#questionnaire-name').style.setProperty('border', '1px solid #f00');
            document.querySelector('#questionnaire-error-name').innerText = 'Недопустимое значение!';
            return;
        }
        else if(questionnaire_name.length > 10){
            document.querySelector('#questionnaire-name').style.setProperty('border', '1px solid #f00');
            document.querySelector('#questionnaire-error-name').innerText = 'Макс. длина 10 символов';
            return;
        }
        else{
            for (let i = 0; i < document.querySelectorAll('.main-left-block').length; i++){
                if (document.querySelector('#questionnaire-name').value == document.querySelectorAll('.main-left-block')[i].querySelector('p').innerText){
                    document.querySelector('#questionnaire-name').style.setProperty('border', '1px solid #f00');
                    document.querySelector('#questionnaire-error-name').innerText = 'Это название уже используется!';
                    return;
                }
            }

            let data_to_send = {'name': questionnaire_name,
                                'author': '###'};

            for (let i = 0; i < 6; i++){
                let block = document.querySelector(`#create-block-${i + 1}`);
                if (block !== null && block !== undefined){
                    data_to_send[`question${i + 1}`] = block.querySelector('.modal-create-block-hide > span').innerText;
                }
                else{
                    data_to_send[`question${i + 1}`] = '';
                }
            }

            $.ajax({
                url: '/forms',
                type: 'POST',
                data: JSON.stringify(data_to_send),
                contentType: 'json',
                processData: false,
                success: function(data){
                    createQuestionnaire(document.querySelector('#questionnaire-name').value);
                    update_amount_que();
                }
            });

            document.querySelector('.modal-create-nav-block-e').style.setProperty('opacity', '0');
            document.querySelector('.modal-create-nav-block-e > span').innerText = '';
            let modal = document.querySelector('.create-questionnaire-modal');
            let black_block = document.querySelector('.black-block');
            modal.style.setProperty('opacity', '0');
            setTimeout(function(){
                modal.style.setProperty('z-index', '-1');
            }, 500);
            setTimeout(function(){
                black_block.style.setProperty('opacity', '0');
            }, 150);
            setTimeout(function(){
                black_block.style.setProperty('z-index', '-1');
            }, 500);
            setTimeout(function(){
                black_block.style.setProperty('display', 'none');
                modal.style.setProperty('display', 'none');
                document.querySelector('#questionnaire-name').style.setProperty('border', '1px solid #3e3e3e');
                document.querySelector('#questionnaire-error-name').innerText = '';
                close_c_block();
            }, 210);
        }
    });

    $('#questionnaire-name').on('input', function () {
        document.querySelector('#questionnaire-name').style.setProperty('border', '1px solid #3e3e3e');
        document.querySelector('#questionnaire-error-name').innerText = '';
        $.ajax({
            url: `/forms/c`,
            type: 'POST',
            data: JSON.stringify({'name': document.querySelector('#questionnaire-name').value}),
            dataType: 'json',
            processData: false,
            success: function(data){
                if (data['is']){
                    document.querySelector('#questionnaire-name').style.setProperty('border', '1px solid #f00');
                    document.querySelector('#questionnaire-error-name').innerText = 'Это название уже используется!';
                }
            }
        });  
      });

    $('.modal-create-block').click(function(event){
        let c_block = document.querySelector(`#${$(this).attr('id')}`);
        let c_block_name = c_block.querySelector('.modal-create-block-hide > span').innerText;
        active_create_block = $(this).attr('id').split('-')[2];
        c_block.classList.add('modal-create-block-not-hover');
        c_block.querySelector('.modal-create-block-hide').style.setProperty('display', 'none');
        c_block.querySelector('.modal-create-block-show').style.setProperty('display', 'block');
        c_block.querySelector('.modal-create-block-show > .create-block-save-body > input').value = c_block_name;
    });
    
    $('.create-block-close').click(function(event){
        event.stopPropagation();
        close_c_block();
    });

    $('.create-block-save').click(function(event){
        event.stopPropagation();
        close_c_block();
        let c_block = document.querySelector(`#create-block-${active_create_block}`);
        let new_name = c_block.querySelector('.modal-create-block-show > .create-block-save-body > input').value;
        if (new_name != ''){
            c_block.querySelector('.modal-create-block-hide > span').innerText = new_name;
        }
    });

    $('.modal-create-questionnaire').click(function(){
        if(document.querySelectorAll('.modal-create-block').length >= mxQuestionnaires){
            err_mx_que_block();
            return;
        }
        let new_div = document.createElement('div');
        let div_num = document.querySelectorAll('.modal-create-block').length + 1;
        if (div_num >= 10){
            return;
        }
        new_div.classList.add('modal-create-block');
        new_div.setAttribute('id', `create-block-${div_num}`)
        let new_div_hide_inner = document.createElement('div');
        new_div_hide_inner.classList.add('modal-create-block-hide');

        let new_div_hide_inner_span = document.createElement('span');
        new_div_hide_inner_span.innerText = `Вопрос ${div_num}`;
        
        let new_div_hide_inner_input = document.createElement('div');
        new_div_hide_inner_input.classList.add('input');
        
        let new_div_hide_inner_block_num = document.createElement('div');
        new_div_hide_inner_block_num.classList.add('block-num');
        new_div_hide_inner_block_num.innerText = div_num;

        new_div_hide_inner.appendChild(new_div_hide_inner_span);
        new_div_hide_inner.appendChild(new_div_hide_inner_input);
        new_div_hide_inner.appendChild(new_div_hide_inner_block_num);

        let new_div_show_inner = document.createElement('div');
        new_div_show_inner.classList.add('modal-create-block-show');

        let new_div_show_inner_close = document.createElement('div');
        new_div_show_inner_close.classList.add('create-block-close');
        new_div_show_inner_close.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>';
        
        $(new_div_show_inner_close).click(function(event){
            event.stopPropagation();
            close_c_block();
        });

        let new_div_show_inner_save = document.createElement('div');
        new_div_show_inner_save.classList.add('create-block-save');
        new_div_show_inner_save.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" fill="#fff" class="bi bi-check-lg" viewBox="0 0 16 16"><path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/></svg>'
        
        $(new_div_show_inner_save).click(function(event){
            event.stopPropagation();
            close_c_block();
            let c_block = document.querySelector(`#create-block-${active_create_block}`);
            let new_name = c_block.querySelector('.modal-create-block-show > .create-block-save-body > input').value;
            if (new_name != '' && new_name.length < 8){
                c_block.querySelector('.modal-create-block-hide > span').innerText = new_name;
            }
        });

        let new_div_show_inner_save_body = document.createElement('div');
        new_div_show_inner_save_body.classList.add('create-block-save-body');
        new_div_show_inner_save_body.innerHTML = '<input type="text" placeholder="Название поля">';

        new_div_show_inner.appendChild(new_div_show_inner_close);
        new_div_show_inner.appendChild(new_div_show_inner_save);
        new_div_show_inner.appendChild(new_div_show_inner_save_body);

        new_div.appendChild(new_div_hide_inner);
        new_div.appendChild(new_div_show_inner);
        document.querySelector('.modal-create-blocks').appendChild(new_div);
        $(new_div).click(function(event){
            let c_block = document.querySelector(`#${$(this).attr('id')}`);
            let c_block_name = c_block.querySelector('.modal-create-block-hide > span').innerText;
            active_create_block = $(this).attr('id').split('-')[2];
            c_block.classList.add('modal-create-block-not-hover');
            c_block.querySelector('.modal-create-block-hide').style.setProperty('display', 'none');
            c_block.querySelector('.modal-create-block-show').style.setProperty('display', 'block');
            c_block.querySelector('.modal-create-block-show > .create-block-save-body > input').placeholder = c_block_name;
        });
    });

    $('#e-que-btn-g').click(function(){
        let modal = document.querySelector('.edit-que-modal');
        let black_block = document.querySelector('.black-block');
        modal.style.setProperty('opacity', '0');
        modal.style.setProperty('z-index', '-1');
        black_block.style.setProperty('z-index', '-1');
        black_block.style.setProperty('display', 'none');
        modal.style.setProperty('display', 'none');
        let modal2 = document.querySelector('.pass-que-modal');
        modal2.querySelector('.modal-name > h4').innerText = active_que;
        let black_block2 = document.querySelector('.black-block');
        black_block2.style.setProperty('display', 'block');
        modal2.style.setProperty('display', 'block');
        setTimeout(function(){
            black_block2.style.setProperty('z-index', '100');
            black_block2.style.setProperty('opacity', '1');
        }, 75);
        setTimeout(function(){
            modal2.style.setProperty('z-index', '101');
            modal2.style.setProperty('opacity', '1');
        }, 200); 
    });

    $('.pass-que-close').click(function(){
        let modal = document.querySelector('.pass-que-modal');
        let black_block = document.querySelector('.black-block');
        modal.style.setProperty('opacity', '0');
        setTimeout(function(){
            modal.style.setProperty('z-index', '-1');
        }, 500);
        setTimeout(function(){
            black_block.style.setProperty('opacity', '0');
        }, 100);
        setTimeout(function(){
            black_block.style.setProperty('z-index', '-1');
        }, 500);
        setTimeout(function(){
            black_block.style.setProperty('display', 'none');
            modal.style.setProperty('display', 'none');
        }, 500);
    });

    $('#pass-subm').click(function(){
        let data_to_send = {'form_name': document.querySelector('.pass-que-modal').querySelector('.modal-name > h4').innerText};
        for (let i = 0; i < 6; i++){
            let inp = document.querySelector(`#answer-${i}`);
            if (inp == null || inp == undefined){
                data_to_send[`answer${i + 1}`] = '';
                continue;
            }
            if (inp.value.length == 0){
                inp.style.setProperty('border-color', '#f00');
                return;
            }
            else{
                inp.style.setProperty('border-color', '#333');
            }
            data_to_send[`answer${i + 1}`] = inp.value;
        }
        $.ajax({
            url: '/answers',
            type: 'POST',
            data: JSON.stringify(data_to_send),
            dataType: 'json',
            processData: false,
            success: function(data){
                let modal = document.querySelector('.pass-que-modal');
                let black_block = document.querySelector('.black-block');
                modal.style.setProperty('opacity', '0');
                setTimeout(function(){
                    modal.style.setProperty('z-index', '-1');
                }, 500);
                setTimeout(function(){
                    black_block.style.setProperty('opacity', '0');
                }, 100);
                setTimeout(function(){
                    black_block.style.setProperty('z-index', '-1');
                }, 500);
                setTimeout(function(){
                    black_block.style.setProperty('display', 'none');
                    modal.style.setProperty('display', 'none');
                }, 500);
                let blocks = document.querySelectorAll('.main-left-block');
                for (let i = 0; i < blocks.length; i++){
                    if (blocks[i].querySelector('p').innerText == data_to_send['form_name']){
                        blocks[i].querySelector('.main-left-block-indicator').classList.remove('not-passed');
                        blocks[i].querySelector('.main-left-block-indicator').classList.add('passed');
                    }
                }
                update_amount_que();
            }
        })
    });

});