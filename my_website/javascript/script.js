
//This is a button for people to vote to expand IE
function getOnline(){
    document.getElementById("message").innerHTML = "Thank you";
    console.log("hi");
  } //This works

  //This for people to join our newsletter!
  function messageOutput(){
    const name = document.getElementById('userName').value;
    document.getElementById("message").textContent = "Welcome to the newsletter, " + name;
    
  }//This works




  //this is an array for the countries we are currently operating in.
  
  const Countries = ['Nigeria','Congo', 'Rwanda', 'Myanmar', 'Kenya'];

  //function to display countries on the webpage

  function displayCountries() {
    const countryList = document.getElementById('country-list');


    Countries.forEach(country =>{

      const listItem = document.createElement('li');

      listItem.textContent = country;

      countryList.appendChild(listItem);
    });
  }

  displayCountries();

  const Country = {
    name: 'Ireland',
    company: 'International Education',
    branches: '21',

  };
  
  // Function to display county information on the webpage
  function displayCountryInfo() {
  //Select the div with id county-info
    const countryInfoContainer = document.getElementById('country-info');
    // Display the county object properties on the webpage
    countryInfoContainer.innerHTML = `
      <p>Name: ${Country.name}</p>
      <p>Company: ${Country.company}</p>
      <p>Branches: ${Country.branches}</p>
    `;
  }
  
  // Call the function to display county information
  displayCountryInfo();

  
  

/* This is for the contact us page it ensures that they cant enter in a false email or no inquiry */
const email = document.getElementById("email");
const inquiry = document.getElementById("inquiry"); 
const form = document.getElementById("form");
const msg = document.getElementById("msg");


// Function to validate the email
const validateEmail = (inputEmail)=> inputEmail.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);

// Function to validate password
const validateInquiry = (inputInquiry) => inputInquiry.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);



// Function used to display errors
const generateError = (errorName, errorMsg) =>{
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("inquiryError");
    if(errorName == "email"){
        emailError.innerText = errorMsg;    
    }else if(errorName == "inquiry"){
        nameError.innerText = errorMsg;
    }
}

const formValidate = (inputEmail, inputPassword) =>{
    if(!validateEmail(inputEmail)){
        emailError = "please enter a valid email address";
        generateError("email",emailError);
        return;
    }
    if(!validateName(inputInquiry)){
        inquiryError = "please enter an inquiry";
        generateError(generateError("inquiry",inquiryError));
        return;
    }
  
}

//triggers when user submits the form
form.addEventListener("submit",(e) => {
    e.preventDefault();
    formValidate(email, inquiry);
});

// Focusout event listener. Triggers when the user clicks anywhere else besides the input
email.addEventListener("focusout", (e)=>{
    if(!validateEmail(email)){
        email.style.borderColor = "red";
        generateError("email", "Please enter a valid email");
        email.parentElement.classList.add("error");
    }
});

// Focusout event listener triggers when the user clicks anywhere else besides the input
password.addEventListener("focusout", (e)=>{
    if(!validateInquiry(inquiry)){
        inquiry.style.borderColor = "red";
        generateError("inquiry", "Please enter an inquiry");
        inquiry.parentElement.classList.add("error");
    }
});