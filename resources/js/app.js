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

 tinymce.init({
    selector: '#myTexterea, #comment, #reply',
    plugins: [
      
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'ai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    menubar:false,
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    uploadcare_public_key: '1021be44188458d00590',
    height: 200,
   
  });

  document.querySelector('form').addEventListener('submit', function(e) {
    tinymce.triggerSave(); // met à jour tous les textarea TinyMCE
});

document.getElementById('dropButtonProfile')?.addEventListener('click', function() {
    const menu = document.getElementById('dropMenuProfile');
    menu.classList.toggle('hidden');
});

document.getElementById('dropButton')?.addEventListener('click', function() {
    const menu = document.getElementById('dropMenu');
    menu.classList.toggle('hidden');
});
