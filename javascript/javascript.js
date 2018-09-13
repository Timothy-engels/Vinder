window.onload = function () {
    console.log(expertises);

    moreInfo("expertise");
    moreInfo("expectedExpertise");


};

function moreInfo(expertise) {
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
                inputExtra.setAttribute("class","row");

                inputLabel.setAttribute("id","inputlabel"+id);
                inputLabel.innerHTML = "More info: ";
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