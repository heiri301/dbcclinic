dispLoginData();

function dispLoginData() {
    let sideBarShowUsername = document.getElementById("lsidebar-userinfo");
    sideBarShowUsername.innerHTML = Cookies.get("currLoginUsername"); 
}

