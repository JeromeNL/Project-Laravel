// Character count for competition description
const textarea = document.getElementById('description');
const charCount = document.getElementById('charCount');

function updateCharCount() {
    const maxLength = textarea.getAttribute('maxlength');
    const currentLength = textarea.value.length;

    charCount.innerHTML = `${currentLength}/${maxLength} karakters`;
}

// Add event listener for input event on the textarea
textarea.addEventListener('input', updateCharCount);

// Initial character count update
updateCharCount();
