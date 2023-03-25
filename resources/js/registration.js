const firstForm = document.getElementById("first-form");
const secondForm = document.getElementById("second-form");
const nextbtn = document.getElementById("nextbtn");
const previousbtn = document.getElementById("previousbtn");
const submitbtn = document.getElementById("submitbtn");

window.next = function next()
{
    //First form input values
    const username = document.forms['firstForm']['username'].value;
    const email = document.forms['firstForm']['email'].value;
    const password = document.forms['firstForm']['password'].value;
    const password_confirmation = document.forms['firstForm']['password_confirmation'].value;

    //Check if all of thee input fields have value
    if (username != '' && email != '' && password != '' && password_confirmation != '')
    {
        //Hide first form (username, password and email)
        firstForm.style.display = 'none';

        //Hide next button, show submit button and show previous button
        nextbtn.style.display = 'none'; //Hide next button
        submitbtn.style.display = null; //Display submit button
        previousbtn.style.display = null; //Display previous button

        //Show Second form (tags)
        secondForm.style.display = null;
    }
}

window.previous = function previous()
{
    //Show first form (username, password and email)
    firstForm.style.display = null;

    //Show next button, hide submit button and hide previous button
    nextbtn.style.display = null; //Show next button
    submitbtn.style.display = 'none'; //Hide submit button
    previousbtn.style.display = 'none'; //Hide previous button

    //Hide Second form (tags)
    secondForm.style.display = 'none';
}
