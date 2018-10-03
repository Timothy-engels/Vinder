window.onload = function () {

    moreInfo("expertise");
    moreInfo("expectedExpertise");




};

function moreInfo(expertise) { //function add or delete input elements
    var exps = document.getElementsByClassName(expertise);
    for (var i = 0; i < exps.length; i++ ){
        exps[i].addEventListener('click',function (e) {
            var id = this.getAttribute('id');
            if(this.checked){
                var inputExtra = document.createElement("input");
                var inputLabel = document.createElement("label");

                inputExtra.setAttribute("id","input"+id);
                inputExtra.setAttribute("name","input"+id);
                inputExtra.setAttribute("type","text");
                inputExtra.setAttribute("class","form-control");

                inputExtra.style.marginLeft= '12px';
                inputLabel.style.marginLeft = '12px';

                inputLabel.setAttribute("id","inputlabel"+id);
                inputLabel.innerHTML = "Meer info: ";
                inputLabel.setAttribute("class","row");


                this.parentNode.insertBefore(inputExtra, this.nextSibling.nextSibling.nextSibling);
                this.parentNode.insertBefore(inputLabel, this.nextSibling.nextSibling.nextSibling);
            }else{
                $('#input'+id).remove();
                $('#inputlabel'+id).remove();
            }

        })
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
    if (removelogo.innerText !== "Terug") {
        logo.style.opacity = 0.2;
        removelogo.innerText = "Terug";
    } else {
        logo.style.opacity = 1;
        removelogo.innerText = "Verwidert logo";
    }
}