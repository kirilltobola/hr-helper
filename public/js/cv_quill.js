
const toolbarOptions = ['bold', 'italic', 'underline', 'strike', 'link', ];

let cv = new Quill('#cv', {
    theme: 'snow',
    modules: {
        toolbar: toolbarOptions
    }
});
cv.on('text-change', function (delta, oldDelta, source) {
    document.getElementById('input-cv').innerText = (document.getElementById('cv').querySelector('.ql-editor').innerHTML);
});

let skills = new Quill('#skills', {
    theme: 'snow',
    modules: {
        toolbar: toolbarOptions
    }
});
skills.on('text-change', function (delta, oldDelta, source) {
    document.getElementById('input-skills').innerText = (document.getElementById('skills').querySelector('.ql-editor').innerHTML);
});

let experience = new Quill('#experience', {
    theme: 'snow',
    modules: {
        toolbar: toolbarOptions
    }
});
experience.on('text-change', function (delta, oldDelta, source) {
    document.getElementById('input-experience').innerText = (document.getElementById('experience').querySelector('.ql-editor').innerHTML);
});
