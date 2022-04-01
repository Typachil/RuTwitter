const buttonsComment = document.querySelectorAll('.button-comment');

buttonsComment.forEach((buttonItem) => buttonItem.addEventListener('click', (e) => {
    e.preventDefault()
    const formComment = e.target.closest('.post').querySelector('.form-comment')
    formComment.style.display = 'flex';
}));