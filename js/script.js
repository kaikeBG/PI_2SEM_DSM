
// Carregar o conteúdo do arquivo "header.html" dentro do div com id="header"
fetch('components/header.html')
    .then(response => response.text())
    .then(data => {
        document.getElementById('header').innerHTML = data;  // Insere o conteúdo no elemento
    })
    .catch(error => {
        console.error('Erro ao carregar o arquivo:', error);
    });



// Carregar o conteúdo do arquivo "header.html" dentro do div com id="header"
fetch('components/footer.html')
    .then(response => response.text())
    .then(data => {
        document.getElementById('footer').innerHTML = data;  // Insere o conteúdo no elemento
    })
    .catch(error => {
        console.error('Erro ao carregar o arquivo:', error);
    });
