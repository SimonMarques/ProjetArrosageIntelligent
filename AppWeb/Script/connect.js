// Gestion de l'affichage dynamique de la page
let tabs = document.querySelectorAll(".tab-link:not(.desactive)");

tabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    unSelectAll();
    tab.classList.add("active");
    let ref = tab.getAttribute("data-ref");
    document.getElementById("login").value = '';
    document.getElementById("password").value = '';
    document.getElementById("loginCreate").value = '';
    document.getElementById("passwordCreate").value = '';
    document.getElementById("passwordConfirmCreate").value = '';
    document
      .querySelector(`.tab-body[data-id="${ref}"]`)
      .classList.add("active");
  });
});

function unSelectAll() {
  tabs.forEach((tab) => {
    tab.classList.remove("active");
  });
  let tabbodies = document.querySelectorAll(".tab-body");
  tabbodies.forEach((tab) => {//permet de gerer actif ou inactif
    tab.classList.remove("active");
  });
}

document.querySelector(".tab-link.active").click();

// Fonction permettant de faire la connexion et l'inscription
function connection() {

    var idLogin = document.getElementById("login");
    var idMpd = document.getElementById("password");
    var login = idLogin.value;
    var mdp = idMpd.value;
    if(login === "" || mdp === ""){
        alert("Un des deux champs est vide !");
        idLogin.value = "";
        idMpd.value = "";
        return;
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
                idLogin.value = "";
                idMpd.value = "";
            }else{
                // Succès
                window.location = "../Vue/accueilConnect.php";
            }
        }
    }
    var data = "event=log&login=" + login +  "&mdp=" + mdp;
    ajax.open("POST", "../Controleur/ctrlUtilisateur.php", true); 
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send(data); 
}

function create(){
    var idLogin = document.getElementById("loginCreate");
    var idMpd = document.getElementById("passwordCreate");
    var idMpdConfirm = document.getElementById("passwordConfirmCreate");
    var login = idLogin.value;
    var mdp = idMpd.value;
    var mdpConfirm = idMpdConfirm.value;
    if(mdp != mdpConfirm){
        alert("Les 2 mots de passe sont différents!");
        idLogin.value = "";
        idMpd.value = "";
        idMpdConfirm.value = "";
        return;
    }
    if(login === "" || mdp === ""){
        alert("Un des deux champs est vide !");
        idLogin.value = "";
        idMpd.value = "";
        idMpdConfirm.value = "";
        return;
    }
    var ajax = new XMLHttpRequest();
    var check;
    ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            check = this.responseText;
            rep = JSON.parse(check);
            if(rep.Check == "false"){
                alert(rep.Text);
                idLogin.value = "";
                idMpd.value = "";
            }else{
                // Succès
                window.location="../Vue/accueilConnect.php";
            }
        }
    }
    var data = "event=create&login=" + login +  "&mdp=" + mdp;
    ajax.open("POST", "../Controleur/ctrlUtilisateur.php", true); 
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send(data); 
    }
    
    // function suppressionAdmin(login){
    //     if(login === ""){
    //         alert("Erreur impossible de savoir de quel utilisateur il s'agit pour la suppression!");
    //     }
    //     var ajax = new XMLHttpRequest();
    //     var check;
    //     ajax.onreadystatechange = function(){
    //         if(this.readyState == 4 && this.status == 200){
    //             check = this.responseText;
    //             console.log(check);
    //             rep = JSON.parse(check);
    //             if(rep.Check == "false"){
    //                 alert(rep.Text);
    //             }else{
    //                // Succès
    //                 window.alert("Connected");
    //             }
    //         }
    //     }
    //     var data = "event=delete&login=" + login;
    //     ajax.open("POST", "../Controller/ctrlUtilisateur.php", true); 
    //     ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //     ajax.send(data); 
    // }
