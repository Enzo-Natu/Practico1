document.addEventListener("DOMContentLoaded", () => {
    fetch('../../../../api/src/Controllers/UserController.php')
        .then(response => {
            if (!response.ok) {
                window.location.href = '../login.html?error=acceso_denegado';
                throw new Error('No autorizado');
            }
            return response.json();
        })
        .then(data => {
            if (data.redirect) {
                window.location.href = data.redirect;
                return;
            }
            if (data.status === 'success') {
                document.getElementById('user-name').textContent = `Hola, ${data.usuario.nombre}`;
            }
        })
        .catch(error => {
            console.error('Error de autenticación:', error);
        });
});