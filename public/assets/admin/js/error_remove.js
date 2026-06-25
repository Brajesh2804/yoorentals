// For text, email, number, password, textarea
document.querySelectorAll('input[type="text"], input[type="email"], input[type="number"], input[type="password"], textarea').forEach(input => {
    input.addEventListener('input', function() {
        let errorSpan = this.parentElement.querySelector('.text-danger');
        if (errorSpan) errorSpan.innerHTML = '';
    });
});

// For radio and checkbox
document.querySelectorAll('input[type="radio"], input[type="checkbox"], input[type="file"]').forEach(input => {
    input.addEventListener('change', function() {
        let errorSpan = this.closest('.form-group').querySelector('.text-danger');
        if (errorSpan) errorSpan.innerHTML = '';
    });
});