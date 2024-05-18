function ajaxCallBack(url, func, method, data = {}) {
    $.ajax({
        url: url,
        method: method,
        dataType: 'JSON',
        data: data,
        success: func,
        error: function (xhr) { console.error(xhr); }
    })
}

//PRETRAGA, FILTRIRANJE I DINAMICKO ISPISIVANJE
let page = 1;
let per_page = 6;


$('#searchA').on('input', function () {
    getBlogs();
})

//    $('#sort_order').change(function () {
//        getBlogss();
//    })

getBlogs();

function getBlogs() {
    var search = $('#searchA').val();

    let sortOrder = $('#sort_order').val();
    let data = {
        search: search,
        sortOrder: sortOrder,
        blogsPerPage: per_page,
        page: page
    }
    ajaxCallBack('models/filteringSorting.php', function (data) {
        showBlogs(data);
    }, 'Get', data)
}

function showBlogs(data) {
    let blogs = data.blogs;
    console.log(blogs);
    let html = '';
    if (blogs.length != 0) {
        blogs.forEach(e => {

            html += `<article class="post">

            <header>
                <div class="title">
                    <h2><a href="">${e.title}</a></h2>
                    <!-- <p>${e.content}</p> -->
                </div>

                <div class="meta">
                    <time class="published">${e.created_at.substr(0, 10)}</time>
                    <a href="#" class="author"><span class="name">
                            ${e.username}
                        </span><img src="assets/images/${e.image}" alt="${e.title}" class="imgP" /></a>
                </div>
            </header>

            <a href="index.php?page=single&post=${e.blog_ID}" class="image featured"><img src="assets/images/${e.images}" alt="${e.title}" /></a>
            <p>${e.content}</p>

            <footer>
                <ul class="actions">
                    <li><a href="index.php?page=single&post=${e.blog_ID}" class="button large">See Post</a></li>
                </ul>
                <ul class="stats" id='footerPost'>
                    <li>
                        <a class=" icon solid fa-heart likes" id="b${e.blog_ID}" ss="${e.blog_ID}">${e.likes.Num}</a>
                     </li>
                    <li>
                           <a href="index.php?page=single&post=${e.blog_ID}" class="icon solid fa-comment">${e.comments[0].Num}</a></li>
                </ul>
            </footer>
        </article>`;
        });
    }
    else {
        html = 'No Blogs with Specified filter';
    }
    $('.post-flex').html(html);

    let likeBtn = document.querySelectorAll(".likes");

    likeBtn.forEach(e => {
        e.addEventListener('click', function () {
            let id = e.getAttribute('ss');
            let aut = document.querySelector("#userID")
            if (aut == null) {
                // obavesti korisnika da mora da se loguje

            }
            else {
                let data = { blog_id: id, author_id: document.querySelector('#userID').value };
                $.ajax({
                    url: 'models/likes.php',
                    method: 'POST',
                    dataType: 'JSON',
                    data: data,
                    success: function (data) {
                        getBlogs();
                    },
                    error: function (data) {
                        getBlogs();
                    }
                });
            }
        })
    })
}


try {
    let btn = document.querySelector("#btn");
    let validationMsg = [];
    function checkValidation() {
        console.log(validationMsg);
        if (validationMsg.length == 2) {
            btn.removeAttribute('disabled');
        } else {
            btn.setAttribute('disabled', '');
        }



        let provera = document.querySelector("#emailM");
        provera.addEventListener("blur", proveri);
        console.log(provera)


        function proveri() {

            //RegEx Email
            let regEmail = /^[a-z][\d\w\.]*\@[a-z]{3,}(\.[a-z]{2,4}){1,3}$/;

            if (regEmail.test(this.value)) {

                this.nextElementSibling.classList.add("correct");
                this.nextElementSibling.innerHTML = "Valid entry";
                if (validationMsg.indexOf("email") == -1) {
                    validationMsg.push("email");
                }

                checkValidation();
            } else {
                this.nextElementSibling.classList.remove("correct");
                this.nextElementSibling.classList.add("mistake");
                this.nextElementSibling.innerHTML = `Format:</br>example.example@example.eg`;

                if (validationMsg.indexOf("email") != -1) {
                    const index = validationMsg.indexOf('email');
                    const x = validationMsg.splice(index, 1);
                }
                checkValidation();
            }
        }
    }

    let content = document.querySelector("#content");
    validationMsg = [];
    content.addEventListener("blur", count);

    function count() {

        //RegEx Email
        console.log(this.value.length);


        if (this.value.length > 10) {
            this.nextElementSibling.classList.add("correct");
            this.nextElementSibling.innerHTML = "Valid entry";
            if (validationMsg.indexOf("msg") == -1) {
                validationMsg.push("msg");
            }
            checkValidation();
        } else {
            this.nextElementSibling.classList.remove("correct");
            this.nextElementSibling.classList.add("mistake");
            this.nextElementSibling.innerHTML = `Messages must have more then 10 caracters`;
            if (validationMsg.indexOf("msg") != -1) {
                const index = validationMsg.indexOf('msg');
                const x = validationMsg.splice(index, 1);
            }
            checkValidation();
        }
    }
}
catch { }

let likes = document.querySelectorAll('.likesx');

likes.forEach(l => {

    l.addEventListener('click', function () {
        //console.log(this.getAttribute('id'));
        let data = {
            'blog_id': this.getAttribute('ss'),
            'author_id': document.querySelector('#like').value
        }
        ajaxCallBack('models/likes.php', function (data) {
            let id = '#b' + data.id;
            console.log(id);
            let element = document.querySelector(id);
            console.log(element.innerHTML);
            if (data.msg == 'delete') {
                element.innerHTML = parseInt(element.innerHTML) - 1;
            }
            else {
                element.innerHTML = parseInt(element.innerHTML) + 1;
            }
        }, 'Post', data)
    });


})


try {
    let button = document.querySelector('#register');
    let email = document.querySelector('#Remail');
    let username = document.querySelector('#Rusername');
    let pass = document.querySelector('#Rpass');
    let passc = document.querySelector('#Rpassc');
    email.addEventListener('blur', check);
    username.addEventListener('blur', check);
    pass.addEventListener('blur', check);
    passc.addEventListener('blur', check);

    let arr = [];
    function chcValidation2() {
        if (arr.length == 4) {
            button.removeAttribute('disabled');
        } else {
            button.setAttribute('disabled', '');
        }

    }
    function check() {
        let regEmail = /^[a-z][\d\w\.]*\@[a-z]{3,}(\.[a-z]{2,4}){1,3}$/;
        let regUname = /^[A-Za-z](\d?\.?\w?)*?/;
        let passReg = /^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/;

        if (regEmail.test(email.value)) {

            email.nextElementSibling.classList.add("correct");
            email.nextElementSibling.innerHTML = "Valid entry";
            if (arr.indexOf("email") == -1) {
                arr.push("email");
            }

            chcValidation2();
        } else {
            email.nextElementSibling.classList.remove("correct");
            email.nextElementSibling.classList.add("mistake");
            email.nextElementSibling.innerHTML = `Format:</br>example.example@example.eg`;

            if (arr.indexOf("email") != -1) {
                const index = arr.indexOf('email');
                const x = arr.splice(index, 1);
            }
            chcValidation2();
        }
        if (regUname.test(username.value)) {

            username.nextElementSibling.classList.add("correct");
            username.nextElementSibling.innerHTML = "Valid entry";
            if (arr.indexOf("uname") == -1) {
                arr.push("uname");
            }

            chcValidation2();
        } else {
            username.nextElementSibling.classList.remove("correct");
            username.nextElementSibling.classList.add("mistake");
            username.nextElementSibling.innerHTML = `Format:Can have uppercase, lowercase and digit`;

            if (arr.indexOf("uname") != -1) {
                const index = arr.indexOf('uname');
                const x = arr.splice(index, 1);
            }
            chcValidation2();
        }
        if (passReg.test(pass.value)) {

            pass.nextElementSibling.classList.add("correct");
            pass.nextElementSibling.innerHTML = "Valid entry";
            if (arr.indexOf("pass") == -1) {
                arr.push("pass");
            }

            chcValidation2();
        } else {
            pass.nextElementSibling.classList.remove("correct");
            pass.nextElementSibling.classList.add("mistake");
            pass.nextElementSibling.innerHTML = `Format:Must have one uppercase, lowercase, nubmer and special caracter: Example123!`;

            if (arr.indexOf("pass") != -1) {
                const index = arr.indexOf('pass');
                const x = arr.splice(index, 1);
            }
            chcValidation2();
        }
        if (passc.value == pass.value) {

            passc.nextElementSibling.classList.add("correct");
            passc.nextElementSibling.innerHTML = "Valid entry";
            if (arr.indexOf("passc") == -1) {
                arr.push("passc");
            }

            chcValidation2();
        } else {
            passc.nextElementSibling.classList.remove("correct");
            passc.nextElementSibling.classList.add("mistake");
            passc.nextElementSibling.innerHTML = `Password doesn't match`;

            if (arr.indexOf("passc") != -1) {
                const index = arr.indexOf('passc');
                const x = arr.splice(index, 1);
            }
            chcValidation2();
        }

    }
}
catch { }

try {
    let btnLog = document.querySelector('#logIn');
    let logEmail = document.querySelector('#uName2');
    let logPass = document.querySelector('#Password2');
    logEmail.addEventListener('blur', logCheck);
    logPass.addEventListener('blur', logCheck);

    let arr2 = [];
    function log() {
        if (arr2.length == 2) {
            btnLog.removeAttribute('disabled');
        } else {
            btnLog.setAttribute('disabled', '');
        }

    }
    function logCheck() {
        let regEmail2 = /^[a-z][\d\w\.]*\@[a-z]{3,}(\.[a-z]{2,4}){1,3}$/;
        let passReg = /^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/;

        if (regEmail2.test(logEmail.value)) {

            logEmail.nextElementSibling.classList.add("correct");
            logEmail.nextElementSibling.innerHTML = "Valid entry";
            if (arr2.indexOf("emailL") == -1) {
                arr2.push("emailL");
            }

            log();
        } else {
            logEmail.nextElementSibling.classList.remove("correct");
            logEmail.nextElementSibling.classList.add("mistake");
            logEmail.nextElementSibling.innerHTML = `Format:</br>example.example@example.eg`;

            if (arr2.indexOf("emailL") != -1) {
                const index = arr2.indexOf('emailL');
                const x = arr2.splice(index, 1);
            }
            log();
        }
        if (passReg.test(logPass.value)) {

            logPass.nextElementSibling.classList.add("correct");
            logPass.nextElementSibling.innerHTML = "Valid entry";
            if (arr2.indexOf("logPass") == -1) {
                arr2.push("logPass");
            }

            log();
        } else {
            logPass.nextElementSibling.classList.remove("correct");
            logPass.nextElementSibling.classList.add("mistake");
            logPass.nextElementSibling.innerHTML = `Format:Must have one uppercase, lowercase, nubmer and special caracter: Example123!`;

            if (arr2.indexOf("logPass") != -1) {
                const index = arr2.indexOf('logPass');
                const x = arr2.splice(index, 1);
            }
            log();
        }
    }
    btnLog.addEventListener('click', function () {
        let data = {
            email: logEmail.value,
            password: logPass.value
        }
        $.ajax({
            url: 'models/login.php',
            method: 'POST',
            dataType: 'JSON',
            data: data,
            success: function (data) {
                let err = document.querySelector('.errors');
                err.innerHTML = data.msg;
                console.log(data.msg);
                if (data.msg == 'Log In success') {
                    let timer = setTimeout(function () {
                        location.reload();
                    }, 1000);

                }
            },
            error: function (data) {
                let err = document.querySelector('.errors');
                err.innerHTML = data.msg;
                console.log(data.msg);
                if (data.msg == 'Log In success') {
                    let timer = setTimeout(function () {
                        location.reload();
                    }, 1000);

                }
            }

        })
    });

} catch { }
// const collapseElementList = document.querySelectorAll('.collapse')
// const collapseList = [...collapseElementList].map(collapseEl => new bootstrap.Collapse(collapseEl))