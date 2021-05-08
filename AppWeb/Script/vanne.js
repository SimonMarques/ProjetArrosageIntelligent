
function changeStatutVanne(idVanne,statut) { 
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

function programmeDateVanne(idVanne) { 
    var date = document.getElementById("date").value;
    var heureD = document.getElementById("heureD").value;
    var heureF = document.getElementById("heureF").value;

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
                alert("Programmation d'arrosage réaliser avec succès!")
                setTimeout(function(){ 
                    window.location = "./vanne.php?idVanne="+idVanne;; 
                }, 2000);
            }
        }
    }
    
    var data = "event=programmeDate&idVanne=" + idVanne +  "&date=" + date + "&heureD="+ heureD + "&heureF="+ heureF;
    ajax.open("POST", "../Controleur/ctrlVanne.php", true); 
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send(data); 

}

function deleteDateVanne(idVanne, date){

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
                alert("Suppression de la programmation avec succès!")
                setTimeout(function(){ 
                    window.location = "./vanne.php?idVanne="+idVanne;; 
                }, 2000);
            }
        }
    }
    
    var data = "event=deleteDateProg&idVanne=" + idVanne +  "&date=" + date ;
    ajax.open("POST", "../Controleur/ctrlVanne.php", true); 
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send(data);
}
