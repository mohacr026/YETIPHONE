function sessionStart(user) {
    sessionStorage.setItem('user', JSON.stringify(user));
}

function sessionClose() {
    sessionStorage.clear;
}

function addCartToLocalStorage(){
    
}