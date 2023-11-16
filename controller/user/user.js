document.querySelector('#registerForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var username = document.querySelector('#username').value;
    var password = document.querySelector('#password').value;

    if(username === '' || password === '') {
        alert('All fields are required');
        return;
    }

    // Add more validation as needed

    // If all fields are valid, submit the form
    this.submit();
});