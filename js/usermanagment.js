initializer();

function getUserData () {
    let userSettingsShowUsername = getElementById("get_usr_settings_UserName");
    let userSettingsShowType = getElementById("get_usr_settings_UserClass");
    
    userSettingsShowUsername.innerHTML = Cookies.get("currLoginUsername");
    userSettingsShowType.innerHTML = Cookies.get("currLoginUserClass") ; 
}

function modifyUserData () {
    
}

function initializer (){
    getUserData()
}