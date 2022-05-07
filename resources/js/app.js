require('./bootstrap');

const buttonsComment = document.querySelectorAll('.button-comment');
const buttonsShowComments = document.querySelectorAll('.button-showComments');
const buttonsShowSettingsEdit = document.querySelectorAll('.change_button');

const buttonsLikePost = document.querySelectorAll('.social-button .social-like button');
const buttonsRepostPost = document.querySelectorAll('.social-button .social-repost button');
const buttonsSubUser = document.querySelectorAll('.card-header .subscribe-button');

// const formMessage = document.querySelector('.form-message');

buttonsComment.forEach((buttonItem) => buttonItem.addEventListener('click', (e) => {
    e.preventDefault();
    const formComment = e.target.closest('.post').querySelector('.form-comment');
    formComment.style.display = 'flex';
}));

buttonsShowComments.forEach((buttonItem) => buttonItem.addEventListener('click', (e) => {
    e.preventDefault();
    const listComments = e.target.closest('.post').querySelector('.comments-list')
    listComments.style.display = 'block';
}));

buttonsShowSettingsEdit.forEach((buttonItem) => buttonItem.addEventListener('click', (e) => {
    e.preventDefault();
    const currentBlock = e.target.closest('.block');
    const formEdit = currentBlock.querySelector('.form-edit');
    const blockChange = currentBlock.querySelector('.block-change');
    formEdit.style.display = 'flex';
    blockChange.style.display = 'none';
}));

buttonsLikePost.forEach((buttonItem) => buttonItem.addEventListener('click', async (e) => {
    e.preventDefault();
    if (buttonItem.dataset.userid) {
        const valueLikesSpan = e.target.closest('.social-like').querySelector('span')
        let data = {
            "userid": buttonItem.dataset.userid
        }
        let reponse = await fetch(`/message/${buttonItem.dataset.postid}/like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            },
            body: JSON.stringify(data)
        })
        let result = await reponse.json();
        valueLikesSpan.innerText = result.likes_value;
        if (result) {
            e.target.classList.toggle("button-like_color");
        }
    }
}));

buttonsRepostPost.forEach((buttonItem) => buttonItem.addEventListener('click', async (e) => {
    e.preventDefault();
    if (buttonItem.dataset.userid) {
        const valueRepostSpan = e.target.closest('.social-repost').querySelector('span');
        let data = {
            "userid": buttonItem.dataset.userid
        }
        let reponse = await fetch(`/message/${buttonItem.dataset.postid}/repost`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            },
            body: JSON.stringify(data)
        })
        let result = await reponse.json();
        valueRepostSpan.innerText = result.repost_value;
    }
}));

buttonsSubUser.forEach((buttonItem) => buttonItem.addEventListener('click', async (e) => {
    e.preventDefault();
    let userId = buttonItem.dataset.userid;
    let userSubId = buttonItem.dataset.usersubid;
    if (userId) {
        const buttonSub = e.target;
        let data = {
            "usersubid": userSubId
        }
        let reponse = await fetch(`/subscribe_user/${userId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            },
            body: JSON.stringify(data)
        })
        let result = await reponse.json();
        console.log(result)
        if (result.subResult) {
            buttonSub.classList.toggle("btn-outline-primary");
            buttonSub.classList.toggle("btn-primary");
        }
    }
}));

// formMessage.onsubmit = async (e) => {
//     e.preventDefault();
//     const form = e.target;
//     let formData = new FormData();
//     formData.append('theme', form.elements.theme.value);
//     formData.append('message', form.elements.message.value);
//     formData.append('files', form.elements.file.files)

//     let reponse = await fetch('/message', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'multipart/form-data',
//             'Accept': 'application/json',
//             "X-CSRF-Token": document.querySelector('input[name=_token]').value
//         },
//         body: formData
//     })

//     console.log(reponse);
// }


// formPasswordChange.onsubmit = async(e) => {
//     e.preventDefault();

//     let data = {
//         'password': formPasswordChange.elements.password.value,
//         'newPassword' : formPasswordChange.elements.newPassword.value,
//         'newPasswordRepeat' : formPasswordChange.elements.newPasswordRepeat.value
//     }
//     let reponse = await fetch('/settings/password', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'Accept': 'application/json',
//             "X-CSRF-Token": formPasswordChange.querySelector('input[name=_token]').value
//         },
//         body : JSON.stringify(data)
//     })

//     let result = await reponse.json();
//     console.log(result);
// }