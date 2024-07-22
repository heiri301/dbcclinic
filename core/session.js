initSession();

function checkSessionToken() {
    if ((Cookies.get('currLoginSession') == null) || (Cookies.get('currLoginSession') == undefined)){
    redirectPageUsrSessionNotSet()
    }
    else {
        sessionTokenData = {'storedLoginSession':Cookies.get('currLoginSession'),};
        getUserSession(sessionTokenData);
    }
}

async function getUserSession(data) {
    let url = "../core/userSession.set.php";
    try {
    let userLoginRes  = await fetch(url,{
        method: "POST", 
        headers: {"Content-Type": "application/json",},
        body: JSON.stringify(data),
    })
    let sessionData = await userLoginRes.json();
    loginPageLogic(sessionData);
    
    }
    catch (error) {
        console.log(error);
        //alert('There is an error handling your session. Please log in again.');
        //redirectPageUsrSessionDenied()
    }
}

// Handles if user should have access to the server
function loginPageLogic(sessionData) {
    checkVal = sessionData.tokenAuth;
    checkVal != 1 || checkVal == null ? redirectPageUsrSessionDenied() : redirectPageUsrSessionVerified();
}


function redirectPageUsrSessionDenied() {
    alert('Session Expired. Please log in again.')
    document.cookie = "currLoginSession=null; max-age=0";
    document.cookie = "currLoginUsername=null; max-age=0"; 
    document.cookie = "currLoginUserClass=null; max-age=0"; 
    if(window.location.pathname != '/dbcclinic/index.php'){
        location.href = '/dbcclinic/dev/mainpage.php';
    }
}

function redirectPageUsrSessionNotSet() {
    //alert('user session not set!')
    if(window.location.pathname != '/dbcclinic/dev/login.php'){
       location.href = '/dbcclinic/dev/login.php';
    }
}

function redirectPageUsrSessionVerified() {
    if(window.location.pathname == '/dbcclinic/dev/login.php'){
        location.href = '/dbcclinic/dev/mainpage.php';
    }
}

function redirectPageonLogout(){
    //alert('You have been logged out!')
    if(window.location.pathname != '/dbcclinic/dev/login.php'){
        location.href = '/dbcclinic/dev/login.php';
    }
    if(window.location.pathname == '/dbcclinic/index.php'){
        location.href = '/dbcclinic/dev/login.php';
    }
}


function logOutUserCheck () {
    //Event Listeners for every button that logs out the user.
    let sideBarLogOut = document.getElementById('sidebarLogoutBtn');
    let userInfoLogOut = document.getElementById('userInfoLogoutBtn');
    let modalLogOutBtn = document.getElementById('modalLogOutBtn');

    if(sideBarLogOut != null || sideBarLogOut != undefined) {
        sideBarLogOut.addEventListener("click", e => {
            e.preventDefault();
            new bootstrap.Modal(document.querySelector("#staticBackdrop")).show();
        });
    }

    if(userInfoLogOut != null || userInfoLogOut != undefined) { 
        userInfoLogOut.addEventListener("click", e => {
            e.preventDefault();
            new bootstrap.Modal(document.querySelector("#staticBackdrop")).show();
        });
    }

     if(modalLogOutBtn != null || modalLogOutBtn != undefined) { 
        modalLogOutBtn.addEventListener("click", e => {
            console.log('Logged out!')
            console.log(`⠀⠀
        ⣠⠤⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣀⠀⠀
    ⠀⠀⡜⠁⠀⠈⢢⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣴⠋⠷⠶⠱⡄
    ⠀⢸⣸⣿⠀⠀⠀⠙⢦⡀⠀⠀⠀⠀⠀⠀⠀⢀⡴⠫⢀⣖⡃⢀⣸⢹
    ⠀⡇⣿⣿⣶⣤⡀⠀⠀⠙⢆⠀⠀⠀⠀⠀⣠⡪⢀⣤⣾⣿⣿⣿⣿⣸
    ⠀⡇⠛⠛⠛⢿⣿⣷⣦⣀⠀⣳⣄⠀⢠⣾⠇⣠⣾⣿⣿⣿⣿⣿⣿⣽
    ⠀⠯⣠⣠⣤⣤⣤⣭⣭⡽⠿⠾⠞⠛⠷⠧⣾⣿⣿⣯⣿⡛⣽⣿⡿⡼
    ⠀⡇⣿⣿⣿⣿⠟⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠈⠙⠻⣿⣿⣮⡛⢿⠃
    ⠀⣧⣛⣭⡾⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⢿⣿⣷⣎⡇
    ⠀⡸⣿⡟⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠘⢿⣷⣟⡇
    ⣜⣿⣿⡧⠀⠀⠀⠀⠀⡀⠀⠀⠀⠀⠀⠀⣄⠀⠀⠀⠀⠀⣸⣿⡜⡄
    ⠉⠉⢹⡇⠀⠀⠀⢀⣞⠡⠀⠀⠀⠀⠀⠀⡝⣦⠀⠀⠀⠀⢿⣿⣿⣹
    ⠀⠀⢸⠁⠀⠀⢠⣏⣨⣉⡃⠀⠀⠀⢀⣜⡉⢉⣇⠀⠀⠀⢹⡄⠀⠀
    ⠀⠀⡾⠄⠀⠀⢸⣾⢏⡍⡏⠑⠆⠀⢿⣻⣿⣿⣿⠀⠀⢰⠈⡇⠀⠀
    ⠀⢰⢇⢀⣆⠀⢸⠙⠾⠽⠃⠀⠀⠀⠘⠿⡿⠟⢹⠀⢀⡎⠀⡇⠀⠀
    ⠀⠘⢺⣻⡺⣦⣫⡀⠀⠀⠀⣄⣀⣀⠀⠀⠀⠀⢜⣠⣾⡙⣆⡇⠀⠀
    ⠀⠀⠀⠙⢿⡿⡝⠿⢧⡢⣠⣤⣍⣀⣤⡄⢀⣞⣿⡿⣻⣿⠞⠀⠀⠀
    ⠀⠀⠀⢠⠏⠄⠐⠀⣼⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠳⢤⣉⢳⠀⠀⠀
    ⢀⡠⠖⠉⠀⠀⣠⠇⣿⡿⣿⡿⢹⣿⣿⣿⣿⣧⣠⡀⠀⠈⠉⢢⡀⠀
    ⢿⠀⠀⣠⠴⣋⡤⠚⠛⠛⠛⠛⠛⠛⠛⠛⠙⠛⠛⢿⣦⣄⠀⢈⡇⠀
    ⠈⢓⣤⣵⣾⠁⣀⣀⠤⣤⣀⠀⠀⠀⠀⢀⡤⠶⠤⢌⡹⠿⠷⠻⢤⡀
    ⢰⠋⠈⠉⠘⠋⠁⠀⠀⠈⠙⠳⢄⣀⡴⠉⠀⠀⠀⠀⠙⠂⠀⠀⢀⡇
    ⢸⡠⡀⠀⠒⠂⠐⠢⠀⣀⠀⠀⠀⠀⠀⢀⠤⠚⠀⠀⢸⣔⢄⠀⢾⠀
    ⠀⠑⠸⢿⠀⠀⠀⠀⢈⡗⠭⣖⡒⠒⢊⣱⠀⠀⠀⠀⢨⠟⠂⠚⠋⠀
    ⠀⠀⠀⠘⠦⣄⣀⣠⠞⠀⠀⠀⠈⠉⠉⠀⠳⠤⠤⡤⠞⠀⠀⠀⠀⠀`); 
            logOut();
        });
    }
}

function logOut() {
    // Clear all login related data
    document.cookie = "currLoginSession=null; max-age=0";
    document.cookie = "currLoginUsername=null; max-age=0"; 
    document.cookie = "currLoginUserClass=null; max-age=0"; 
    location.href = '/dbcclinic/dev/login.php';
}


function initSession () {
    logOutUserCheck();
    checkSessionToken();
}