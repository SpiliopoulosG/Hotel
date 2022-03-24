

  // =======Gets Elements by Id for Precision======

document.addEventListener("DOMContentLoaded", () => {
  const $form = document.getElementById("form");
  const $emailError = document.getElementById("email_error");
  const $passError = document.getElementById("pass_error");


  // =======Validates Both Email and Password======

  const getValidations = ({email, password}) => {
    let emailIsValid = false;
    let passIsValid = false;

    if (email != "" && 
    /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) 
    { 
      emailIsValid = true;
    };

    if (password != "" && password.length >= 8){
      passIsValid = true;
    };

    return {
      emailIsValid,
      passIsValid,
    };
  };

  // =======Gets Values of Both Email and Password======

  $form.addEventListener("submit" , (e) => {
    e.preventDefault(); // Prevents the form from being sent!
    const {email, password} = e.target.elements;
    const values = {
      email: email.value, 
      password: password.value,
    };

    const validations = getValidations(values);

    if (!validations.emailIsValid) {
      $emailError.classList.remove("d-none")
    } else {
      $emailError.classList.add("d-none")
    };

    if (!validations.passIsValid) {
      $passError.classList.remove("d-none")
    } else {
      $passError.classList.add("d-none")
    };

    // =======Post when Everything OK======
    if ( validations.emailIsValid && validations.passIsValid) {
      $form.submit();
    };

  });


  $emailError.classList.add("d-none");
  $passError.classList.add("d-none");
});
  