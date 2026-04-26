function buscarProducto() {
    let texto = document.getElementById("buscar").value;

    fetch("/techhub_store/publico/buscar.php?texto=" + encodeURIComponent(texto))
        .then(response => response.text())
        .then(data => {
            document.getElementById("resultados").innerHTML = data;
        });
}