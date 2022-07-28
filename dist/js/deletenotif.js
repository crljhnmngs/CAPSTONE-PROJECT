const form3 = document.querySelector(".deletenotifs"),
deletebtn = form3.querySelector(".clearnotif"),
test2 = document.querySelector(".test2");


form3.onsubmit = (e)=>{
    e.preventDefault();
}


deletebtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../pages/notifs/deletenotifs.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form3);
    xhr.send(formData);
}




