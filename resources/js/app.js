import './bootstrap';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.querySelectorAll('.reponse').forEach( (btn) => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const form = btn.closest('.p-9').querySelector('.form');
        form.classList.toggle('hidden');
    });
});


document.getElementById('myTexterea') && ClassicEditor
    .create( document.querySelector( '#myTexterea' ))
    .catch( error => {
        console.error( error );
    } );

document.getElementById('reply') && ClassicEditor
    .create( document.querySelector( '#reply' ) )
    .catch( error => {
        console.error( error );
    } );

document.getElementById('dropButtonProfile')?.addEventListener('click', function() {
    const menu = document.getElementById('dropMenuProfile');
    menu.classList.toggle('hidden');
});

document.getElementById('dropButton')?.addEventListener('click', function() {
    const menu = document.getElementById('dropMenu');
    menu.classList.toggle('hidden');
});

document.getElementById('modifierButton')?.addEventListener('click', function() {
    const menu = document.getElementById('buttonProfile');
    menu.classList.toggle('hidden');

    const profile = document.getElementsByClassName('profile');

    Array.from(profile).forEach(input => {
        input.disabled = false;
    })
    
});