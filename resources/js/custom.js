// initializing bootstrap datatoggle
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
// function to validate form from server side without page load
function server_validation({btnId, modalId, route, method, formId, csrfToken}) { 
    let btnText = $(btnId).text();
    // disable button
    $(btnId).prop("disabled", true);
    // add spinner to button
    $(btnId).html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please Wait...`
    );
    let form = $(formId)[0];
    let formData = new FormData(form);

    $.ajax({
        url: route,
        type: method,
        data: formData,
        header: {
            '_token': csrfToken
        },
        contentType: false,
        processData: false,
        success: function(response) {
            // disable button, remove span inside button, and replace text of button
            $(btnId).removeAttr("disabled");
            let spanOfBtnId = "#btnId span"; 
            $(spanOfBtnId).remove();
            $(btnId).text(btnText);
            if ('redirect_url' in response) {
                $(modalId).modal('hide');  
                Swal.fire({
                    text: response.message,
                    showConfirmButton: false
                });
                setTimeout(() => {
                    window.location.href = response['redirect_url'];
                }, 2000);
            }
            else {
                // disable button, remove span inside button, and replace text of button
                $("label").remove(".validation-error");
                $(modalId).modal('hide');   
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    confirmButtonText: "Great",
                    confirmButtonColor: "#5cb85c",
                })
            }
        },
        error: function(errors) {
            console.log(errors);
            // remove validation error label if exists
            $("label").remove(".validation-error");
            let obj = errors.responseJSON;
            let form = document.querySelector(formId);
            let inputs = form.querySelectorAll('[name]');
            for (const key in obj) {
                for (const name in inputs) {
                    if (key == inputs[name].name) {
                        let label = document.createElement("label");
                        label.setAttribute('class', 'mt-1 text-danger validation-error');
                        label.innerHTML = obj[key];
                        (inputs[name]).parentNode.appendChild(label);
                    }
                }
            }
            // disable button, remove span inside button, and replace text of button
            $(btnId).removeAttr("disabled");
            let spanOfBtnId = "#btnId span"; 
            $(spanOfBtnId).remove();
            $(btnId).text(btnText);
        }
    });
}
// toggle comment section on click of comment button
let commentBtns = document.querySelectorAll('.comment-button');
let commentBks = document.querySelectorAll('.comment-block');
Array.from(commentBks).forEach(element => {
    element.style.display = 'none';
});
Array.from(commentBtns).forEach(element => {
    element.addEventListener('click', (e)=> {
        if (element.nextElementSibling.style.display == 'none') {
            element.nextElementSibling.style.display = 'block';
        } else {
            element.nextElementSibling.style.display = 'none';
        }
    });
});
// Change text input box into date type on mouseover with class date
let dateInput = document.querySelectorAll('.date');
Array.from(dateInput).forEach(element => {
    element.addEventListener('mouseover', (e) => {
        e.target.type = 'date';
    });
    element.addEventListener('mouseout', (e) => {
        e.target.type = 'text';
    });
});
// Change text input box into datetime-local type on mouseover with class date
let datetimeInput = document.querySelectorAll('.datetime');
Array.from(datetimeInput).forEach(element => {
    element.addEventListener('mouseover', (e) => {
        e.target.type = 'datetime-local';
    });
    element.addEventListener('mouseout', (e) => {
        e.target.type = 'text';
    });
});
// show time left on deadline: set id="getDate" to activate below code
let date = document.getElementById('getDate').value;
let timer = Math.round(new Date(date).getTime() / 1000) - Math.round(new Date().getTime() / 1000);
let minutes, seconds;
setInterval(function () {
    if (--timer < 0) {
        timer = 0;
    }
    days = parseInt(timer / 60 / 60 / 24, 10);
    hours = parseInt((timer / 60 / 60) % 24, 10);
    minutes = parseInt((timer / 60) % 60, 10);
    seconds = parseInt(timer % 60, 10);

    days = days < 10 ? "0" + days : days;
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    document.getElementById('cd-days').innerHTML = days;
    document.getElementById('cd-hours').innerHTML = hours;
    document.getElementById('cd-minutes').innerHTML = minutes;
    document.getElementById('cd-seconds').innerHTML = seconds;
}, 1000);
// increse or decrease the upvote in both db and frontend without page load
function upvote({element, method, route, csrfToken}) {
    let id = element.target.id;
    let workId = id.substr(9);
    $.ajax({    
        url: route,
        type: method,
        data: {
            'workId': workId,
            '_token': csrfToken
        },
        success: function(response) {
            let upvoteCountSpan = element.target.getElementsByTagName('span')[0];
            let thumbIcon = element.target.getElementsByTagName('i')[0];
            let upvoteCount = parseInt(upvoteCountSpan.innerText);
            upvoteCountSpan.innerText = '';
            if (response.bool == 1) {
                // upvoted successfully
                upvoteCountSpan.innerText = ' ' + (upvoteCount + 1).toString();
                thumbIcon.classList.add('color-blue');
            } else {
                // remove upvote
                upvoteCountSpan.innerText = ' ' + (upvoteCount - 1).toString();
                thumbIcon.classList.remove('color-blue');
            }
        },
        error: function(errors) {
            console.log(errors);
        }
    });
}