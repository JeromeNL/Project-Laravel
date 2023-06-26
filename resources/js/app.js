import './bootstrap';

import Alpine from 'alpinejs';

import tableSort from 'table-sort-js';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    var titleInput = document.getElementById('title');
    var titleCounter = document.getElementById('title-counter');
    var descriptionInput = document.getElementById('description');
    var descriptionCounter = document.getElementById('description-counter');

    function updateTitleCounter() {
        var maxLength = 45;
        var length = titleInput.value.length;
        var remaining = maxLength - length;
        titleCounter.textContent = remaining;
    }

    function updateDescriptionCounter() {
        var maxLength = 200;
        var length = descriptionInput.value.length;
        var remaining = maxLength - length;
        descriptionCounter.textContent = remaining;
    }

    if (titleInput && titleCounter) {
        titleInput.addEventListener('input', updateTitleCounter);
        updateTitleCounter(); // Update the counter initially
    }

    if (descriptionInput && descriptionCounter) {
        descriptionInput.addEventListener('input', updateDescriptionCounter);
        updateDescriptionCounter(); // Update the counter initially
    }
});

function toggleSubmissionMethods() {
    const fileMethod = document.getElementById('submission-file');
    const urlMethod = document.getElementById('submission-url');
    const fileInput = document.getElementById('submission_image');
    const urlInput = document.getElementById('submission_url');
    const clearFileBtn = document.getElementById('clear-file');
    const error = document.getElementById('submission-method-error');

    if (fileInput.files.length > 0) {
        fileMethod.style.display = 'block';
        urlMethod.style.display = 'none';
        urlInput.value = '';
        error.style.display = 'none';
    } else if (urlInput.value.trim() !== '') {
        fileMethod.style.display = 'none';
        urlMethod.style.display = 'block';
        fileInput.value = '';
        error.style.display = 'none';
    } else {
        fileMethod.style.display = 'block';
        urlMethod.style.display = 'block';
        error.style.display = 'block';
    }
}

document.getElementById('submission_image').addEventListener('change', toggleSubmissionMethods);
document.getElementById('submission_url').addEventListener('input', toggleSubmissionMethods);
document.getElementById('clear-file').addEventListener('click', function() {
    document.getElementById('submission_image').value = '';
    toggleSubmissionMethods();
});

toggleSubmissionMethods();
