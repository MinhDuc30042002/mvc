const btn_action = document.querySelector('button[type=submit]')


function onKeyUpName() {
    const value_name = document.getElementById('name').value
    const error_name = document.getElementById('error_name')

    // Check value name
    if (value_name.length == 0) {
        error_name.innerHTML = 'Tên bắt buộc'
        error_name.style.color = 'red'
        btn_action.style.display = 'none'
    } else {
        error_name.innerHTML = 'Bạn có thể sử dụng tên này'
        error_name.style.color = 'green'
        btn_action.style.display = 'block'
    }

}

function onKeyUpEmail() {
    const value_email = document.getElementById('email').value
    const error_email = document.getElementById('error_email')

    const pattern = /^[^\s]+@[^\s]+\.[^\s]+$/

    // Check value email
    if (value_email.length == 0) {
        error_email.innerHTML = 'Email bắt buộc'
        error_email.style.color = 'red'
        btn_action.style.display = 'none'
    } else if (!pattern.test(value_email)) {
        error_email.innerHTML = 'Email phải có định dạng @ yahoo.com, gmail.com...'
        error_email.style.color = 'red'
        btn_action.style.display = 'none'
    } else {
        error_email.innerHTML = 'Địa chỉ email hợp lệ'
        error_email.style.color = 'green'
        btn_action.style.display = 'block'
    }

}

function onKeyUpPassword() {

    const value_pass = document.getElementById('pass').value
    const error_pass = document.getElementById('error_pass')

    let pattern = /^(?=.*[.]{1,})(?=.*[0-9]{2}).{8,}/

    // Check value password
    if (value_pass.length == 0) {
        error_pass.innerHTML = 'Mật khẩu bắt buộc'
        error_pass.style.color = 'red'
        btn_action.style.display = 'none'
    } else if (!pattern.test(value_pass)) {
        error_pass.innerHTML = 'Ít nhất 8 ký tự, bao gồm 2 số và ít nhất 1 dấu chấm'
        error_pass.style.color = 'red'
        btn_action.style.display = 'none'
    } else {
        error_pass.innerHTML = 'Bạn có thể sử dụng mật khẩu này'
        error_pass.style.color = 'green'
        btn_action.style.display = 'block'
    }

}

// function loadFile(event) {
//     const reader = new FileReader()

//     reader.onload = function () {
//         let image = document.getElementById('image')
//         image.src = reader.result
//     }
//     reader.readAsDataURL(event.target.files[0]);
// }

function mimeType() {
    let control = document.getElementById('file_image')
    control.addEventListener('change', (event) => {
        let file = control.files[0].type
        console.log(file)
    })
}


function onKeyUpTitle() {
    const title = document.getElementById('title').value
    const error = document.getElementById('title_error')

    if (title.length == 0) {
        error.innerHTML = 'Nhập tiêu đề'
        error.style.color = 'red'
        btn_action.style.display = 'none'
    } else {
        error.innerHTML = 'Bạn có thể sử dụng tên này'
        error.style.color = 'green'
        btn_action.style.display = 'block'
    }
}


function commentPosts() {
    const btn_comment = document.getElementById('btn_comment')
    let comment = document.getElementById('comment')

    if (comment.value.length == 0) {
        btn_comment.style.display = 'none'
    } else {
        btn_comment.style.display = 'block'
    }
}


function previewFiles() {
    var preview = document.querySelector('#preview');
    var files = document.querySelector('input[type=file]').files;
    let old_image = document.querySelectorAll('img')


    function readAndPreview(file) {
        var reader = new FileReader();


        let allow_type = ['image/png', 'image/jpeg', 'image/jpg']
        let type = allow_type.find(t => t == file.type)
        if (type) {
            reader.addEventListener("load", function () {
                old_image.forEach(e => {
                    e.src = ''
                });
                // khi gọi đối tượng Image này mặc định constructor sẽ tạo 1 thẻ image
                let image = new Image();
                image.src = reader.result;
                image.setAttribute('class', 'image')
                preview.appendChild(image);
            }, false);

            reader.readAsDataURL(file);
        }
    }


    if (files) {
        [].forEach.call(files, readAndPreview);
    }
}


function removeImage() {
    let f = document.querySelector('input[type=file]')

    f.addEventListener("click", function () {
        let img = document.querySelectorAll('img')
        img.forEach(element => element.remove())
    })
}

