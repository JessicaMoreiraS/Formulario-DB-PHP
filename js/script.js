function descricaoEvento(evento){
    console.log(`eventos.${evento}`)
    if(evento == 'none'){
        document.getElementById("descricaoDoEvento").innerHTML = "textinho Aleatorio"
        document.getElementById("imgDoEvento").innerHTML = `<img src="imagens/logo.png">` 
    }
    fetch(`eventos.${evento}`,{ //nao ta achando o fech
        method: 'GET'
    })
    .then(response => response.json())
    .then(dados => {
        document.getElementById("descricaoDoEvento").innerHTML = dados.descricao
        document.getElementById("imgDoEvento").innerHTML = `<img src="${dados.img1}">` 
    })
}

var currentUrl = window.location.href;
if (currentUrl.includes("homeUser")) {
    if(document.getElementById('eventoEscolhido').value == 'none'){
        document.getElementById('descricaoDoEvento').innerHTML = "";
    }
}


