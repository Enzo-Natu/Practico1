document.addEventListener("DOMContentLoaded", () => {
    fetch('../../../../api/src/Controllers/AdminController.php')
        .then(response => {
            if (!response.ok) {
                window.location.href = '../login.html?error=acceso_denegado';
                throw new Error('No autorizado');
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('user-info').innerHTML = `
                    <i class="bi bi-person-circle me-1"></i> ${data.usuario.nombre} (${data.usuario.rol})
                `;
                document.getElementById('count-articulos').textContent = data.stats.articulos;
                document.getElementById('count-usuarios').textContent = data.stats.usuarios;
            }
        })
        .catch(error => {
            console.error('Error de autenticación:', error);
        });
});