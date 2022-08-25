const update = document.getElementById('update')
const edit = document.getElementById('id')
const posts = document.getElementById('posts')

function onKeyUpName() {
    const value_name = document.getElementById('name').value
    const error_name = document.getElementById('error_name')

    // Check value name
    if (value_name.length == 0) {
        error_name.innerHTML = 'Tên bắt buộc'
        error_name.style.color = 'red'
        update.style.display = 'none'
    } else {
        error_name.innerHTML = 'Bạn có thể sử dụng tên này'
        error_name.style.color = 'green'
        update.style.display = 'block'
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
        update.style.display = 'none'
    } else if (!pattern.test(value_email)) {
        error_email.innerHTML = 'Email phải có định dạng @ yahoo.com, gmail.com...'
        error_email.style.color = 'red'
        update.style.display = 'none'
    } else {
        error_email.innerHTML = 'Địa chỉ email hợp lệ'
        error_email.style.color = 'green'
        update.style.display = 'block'
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
        update.style.display = 'none'
    } else if (!pattern.test(value_pass)) {
        error_pass.innerHTML = 'Ít nhất 8 ký tự, bao gồm 2 số và ít nhất 1 dấu chấm'
        error_pass.style.color = 'red'
        update.style.display = 'none'
    } else {
        error_pass.innerHTML = 'Bạn có thể sử dụng mật khẩu này'
        error_pass.style.color = 'green'
        update.style.display = 'block'
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
        posts.style.display = 'none'
    } else {
        error.innerHTML = 'Bạn có thể sử dụng tên này'
        error.style.color = 'green'
        posts.style.display = 'block'
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


