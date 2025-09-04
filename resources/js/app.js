import './bootstrap';
import 'summernote/dist/summernote-lite.css';
import 'summernote/dist/summernote-lite.js';
import $ from 'jquery';

document.querySelectorAll('.reponse').forEach( (btn) => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const form = btn.closest('.p-9').querySelector('.form');
        form.classList.toggle('hidden');
    });
});


document.addEventListener('DOMContentLoaded', function () {
    $('#myTexterea, #reply').summernote({
        height: 150,
        
    });
 });


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