function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

const reqPost = (url, data) => {

    return new Promise((resolve, reject) => {
        $.ajax({
            url,
            method: 'POST',
            data,
            dataType: 'json',
            success: (data) => {
                resolve(data)
            },
            failure: (err) => {
                reject(err)
            }
        });
    })
}

const numberFormat = (num) => {
    return parseFloat(num).toFixed(2)
}

const currencyFormat = (number) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number)
}

function setCookie(name, value, daysToLive) {
    var cookie = name + "=" + encodeURIComponent(value);
    if(typeof daysToLive === "number") {
        cookie += "; max-age=" + (daysToLive*24*60*60);
        document.cookie = cookie;
    }
}

function getCookie(name) {
    var cookieArr = document.cookie.split(";");
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        if(name == cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}

function checkCookie() {
    var UserName = getCookie("UserName");
    if(UserName != "") {
        alert("Welcome again, " + UserName);
    } else {
        firstName = prompt("Please enter your UserName:");
        if(UserName != "" && UserName != null) {
            setCookie("UserName", UserName, 30);
        }
    }
}

