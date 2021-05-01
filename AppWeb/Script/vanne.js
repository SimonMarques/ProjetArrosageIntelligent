
function changeStatut(idVanne,statut) { 
    let newStatut;
    if(statut == 0){
        newStatut = 1;
    } else {
        newStatut = 0;
    }  
    var ajax = new XMLHttpRequest();
    var check;
    var rep;
    ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            check = this.responseText;
            rep = JSON.parse(check);
            if(rep.Check == "false"){
                alert(rep.Text);
            }else{
                // Succès
                window.location = "./vanne.php?idVanne="+idVanne;
            }
        }
    }
    var data = "event=changeStatut&idVanne=" + idVanne +  "&statut=" + newStatut;
    ajax.open("POST", "../Controleur/ctrlVanne.php", true); 
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send(data); 
}
