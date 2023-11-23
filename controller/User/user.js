
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');
    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });
    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var firstName = document.getElementById('First_Name').value;
    var lastName = document.getElementById('Last_Name').value;
    var email = document.getElementById('Email').value;
    var phoneNumber = document.getElementById('Phone_number').value;
    var password = document.getElementById('Password').value;
    var birthdate = document.getElementById('Birthdate').value; 
    var country = document.getElementById('Country').value;
    var role = document.getElementById('Role').value;
    if (!firstName || !lastName || !email || !phoneNumber || !password || !birthdate || !country || !role) {
        alert('Please fill out all required fields.');
    }
    var emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
    }
    if (password.length < 8) {
        alert('Password must be at least 8 characters long.');
    }
    
    if (isNaN(phoneNumber)) {
        alert('Please enter a valid phone number.');
    }
    this.submit();
});
