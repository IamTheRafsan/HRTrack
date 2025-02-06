function validateEmployeeForm() {
    const name = document.forms["employeeForm"]["name"].value;
    const email = document.forms["employeeForm"]["email"].value;
    const password = document.forms["employeeForm"]["password"].value;
    const phone = document.forms["employeeForm"]["phone"].value;
    const designation = document.forms["employeeForm"]["designation"].value;
    const salary = document.forms["employeeForm"]["salary"].value;
    const hr = document.forms["employeeForm"]["hr"].value;
    const id = document.forms["employeeForm"]["id"].value;

    if (name == "" || email == "" || password == "" || phone == "" || designation == "" || salary == "" || hr == "" || id == "") {
        alert("All fields are required!");
        return false;
    }

    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!email.match(emailPattern)) {
        alert("Please enter a valid email address.");
        return false;
    }

    var phonePattern = /^[0-9]{1,11}$/;
    if (!phone.match(phonePattern)) {
        alert("Phone number should contain only numbers.");
        return false;
    }

    if (isNaN(salary)) {
        alert("Salary should be a valid number.");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
    }
    return true;
}
