function redirection(data){
    
    if(data === ''){
        alert('Session expirée. Reconnectez vous.');
        window.location.replace("../welcome");
        exit();
    }
}


