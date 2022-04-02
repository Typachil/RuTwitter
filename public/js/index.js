const buttonsComment = document.querySelectorAll('.button-comment');
const buttonsShowComments = document.querySelectorAll('.button-showComments')

buttonsComment.forEach((buttonItem) => buttonItem.addEventListener('click', (e) => {
    e.preventDefault();
    const formComment = e.target.closest('.post').querySelector('.form-comment');
    formComment.style.display = 'flex';
}));

buttonsShowComments.forEach((buttonItem) => buttonItem.addEventListener('click', (e) =>{
    e.preventDefault();
    const listComments = e.target.closest('.post').querySelector('.comments-list')
    listComments.style.display = 'block';
}));

