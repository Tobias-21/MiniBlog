import './bootstrap';

document.querySelectorAll('.reponse').forEach( (btn) => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const form = btn.closest('.p-9').querySelector('.form');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });
});