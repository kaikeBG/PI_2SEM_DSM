
<select class="form-select-secondary" id="opcoes" name="opcoes" style="width: 200px;">
    <option selected>Selecione a Fatec</option>
</select>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const selectElement = document.getElementById('opcoes');
    const valorSalvo = localStorage.getItem('fatecSelecionada'); // ou algum valor do PHP

    fetch('../controller/listarFatecs.php')  // Caminho ao PHP que renderiza as <option>
        .then(response => response.text())
        .then(htmlOptions => {
            document.getElementById('opcoes').insertAdjacentHTML('beforeend', htmlOptions);
            if (valorSalvo) {
                selectElement.value = valorSalvo;
            }
        })
        .catch(error => console.error('Erro ao carregar Fatecs:', error));

     // Salvar valor ao mudar
    selectElement.addEventListener('change', function () {
        localStorage.setItem('fatecSelecionada', selectElement.value);
    });
});
</script>