const form2 = document.querySelector(".readnotifs"),
viewbtn = form2.querySelector(".nav-link"),
test = document.querySelector(".test");


form2.onsubmit = (e)=>{
    e.preventDefault();
}


viewbtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../pages/notifs/viewnotifs.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              
          }
      }
    }
    let formData = new FormData(form2);
    xhr.send(formData);
}




