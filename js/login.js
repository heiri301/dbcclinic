getLoginData();

function getLoginData() {
    var loginFormSubmit = document.querySelector("#sign_in");
    loginFormSubmit.addEventListener("submit", (evt) => {
        evt.preventDefault();
        const loginFormData = new FormData(document.querySelector("#sign_in"))  
        const objloginFormData = Object.fromEntries(loginFormData);
            let url = "../query/login.qry.php";
            reqUserLoginData(url,objloginFormData);
    });
}

function handleLoginData(loginData) {
    ('displayLoginAlertDivType' in loginData) ? showLoginAlert(loginData.displayLoginAlertDivType) : null;
    localStorage.setItem('login_slctUsername',loginData.username);
    localStorage.setItem('login_slctUserClass',loginData.userClass);
    loginData.loginSuccessful != 0 ? setUserSession() : null;
}

async function reqUserLoginData(url,data) {
    try {
        let userLoginRes  = await fetch(url,{
            method: "POST", 
            headers: {"Content-Type": "application/json",},
            body: JSON.stringify(data),
        })
        let loginData = await userLoginRes.json();
        handleLoginData(loginData);
    }
    catch (error) {
        console.log(error);
        let successValueData = 4;
        showLoginAlert(successValueData);
    }
   
}

async function setUserSession () {
    let url = "../query/setsession.qry.php";
    try {
    let userLoginRes  = await fetch(url,{ method: "POST", })
    let sessionData = await userLoginRes.json();
    if (sessionData.userToken !== null) { 
        setSessionCookie(sessionData);
        setTimeout(location.href = '/dbcclinic/dev/mainpage.php' ,2000);
    }

    }
    catch (error) {
        console.log(error);
        let successValueData = 4;
        showLoginAlert(successValueData);
    }
}


// Sets token to document.cookie
// If HTTPS is enabled in the future, set the 'Secure;' attribute
// When the user is logged out these cookies are deleted (max-age=0)
function setSessionCookie(sessionData) { 
    document.cookie = 'currLoginSession='+sessionData.userToken+'; SameSite=Strict; max-age=604800'; // 1 week
    document.cookie = 'currLoginUsername='+localStorage.login_slctUsername+'; SameSite=Strict; max-age=604800;'; // 1 week
    document.cookie = 'currLoginUserClass='+localStorage.login_slctUserClass+'; SameSite=Strict; max-age=604800'; // 1 week
    localStorage.removeItem('login_slctUserClass');
    localStorage.removeItem('login_slctUsername');
}

function logOutUser(){
    localStorage.setItem('login_userLogout','1');
}

function showLoginAlert (successValueData) { 
    //console.log(successValueData);
    if(successValueData == 1){
        loginformAlert.removeAttribute("hidden");
        if(loginformAlert.classList.contains('alert-success')) {
            loginformAlert.classList.remove("alert-success");
            loginformAlert.classList.add("alert-danger");
        }

        loginformAlert.innerHTML = "<strong>Login Unsuccessful.</strong><br>Please enter correct login information.";
    }
    if(successValueData == 2){
        loginformAlert.removeAttribute("hidden");
        if(loginformAlert.classList.contains('alert-danger')) {
            loginformAlert.classList.remove("alert-danger");
            loginformAlert.classList.add("alert-success");
        }
        loginformAlert.innerHTML = "<strong>Login Success</strong><br>You will be redirected to the main page...";
    }
    if(successValueData == 3){                    
        loginformAlert.removeAttribute("hidden");
        if(loginformAlert.classList.contains('alert-success')) {
            loginformAlert.classList.remove("alert-success");
            loginformAlert.classList.add("alert-danger");
        }
        loginformAlert.innerHTML  = "<strong>Too many login attempts.</strong><br>Please try again after a while";
    }
    if(successValueData == 4){
        loginformAlert.removeAttribute("hidden");
        if(loginformAlert.classList.contains('alert-success')) {
            loginformAlert.classList.remove("alert-success");
            loginformAlert.classList.add("alert-danger");
        }

        loginformAlert.innerHTML = "<strong>Server Error</strong><br> There is an error while connecting to the server";
    }
}