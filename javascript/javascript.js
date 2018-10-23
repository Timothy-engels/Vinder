window.onload = function () {
    moreInfo("expertise");
    moreInfo("expectedExpertise");
};

function moreInfo(expertise)
{ //function add or delete input elements
    var exps = document.getElementsByClassName(expertise);
    
    for (var i = 0; i < exps.length; i++ ){
        var id         = exps[i].getAttribute('id');
        var checkbox   = document.getElementById(id);
        var detailsDiv = document.getElementById("details-" + id);
        
        if (checkbox.checked) {
            detailsDiv.style.display = 'block';
        } else {
            detailsDiv.style.display = 'none';
        }
        
        exps[i].addEventListener('click',function (e) {
            var id = this.getAttribute('id');
            var detailsDiv = document.getElementById("details-" + id);
            if (this.checked){
                detailsDiv.style.display = 'block';
            } else {
                detailsDiv.style.display = 'none';
            }
        });
    }
}

function check_url() {
    //Get input value
    var elem = document.getElementById("url_input");
    var input_value = elem.value;
    //Set input value to lower case so HTTP or HtTp become http
    input_value = input_value.toLowerCase();

    //Check if string starts with http:// or https://
    var regExr = /^(http:|https:)\/\/.*$/m;

    //Test expression
    var result = regExr.test(input_value);

    //If http:// or https:// is not present add http:// before user input
    if (!result) {
        var new_value = "http://" + input_value;
        elem.value = new_value;
    }
}

function remove_logo() {
    var logo = document.getElementById("logo");
    var removelogo = document.getElementById("removelogo");
    var company_logo = document.getElementById("company_logo");
    if (removelogo.innerText !== "Herstel logo") {
        logo.style.opacity = 0.2;
        removelogo.innerText = "Herstel logo";
        var hidden = document.createElement("input");
        hidden.setAttribute('id','deletelogo');
        hidden.setAttribute('name','del');
        hidden.style.display = 'none';
        company_logo.appendChild(hidden);
    } else {
        logo.style.opacity = 1;
        removelogo.innerText = "Verwijder logo";
        $('#deletelogo').remove();
    }
}