const libro = document.getElementById('libro');

document.getElementById('tapa').addEventListener('click', () => {
  if (!libro.classList.contains('abierto')) {
    libro.classList.add('abierto');
     setTimeout(() => document.getElementById('email').focus(), 1200);
  }
});

document.getElementById('cerrar').addEventListener('click', (e) => {
  e.stopPropagation();
  libro.classList.remove('abierto');
});

document.getElementById('formLogin').addEventListener('submit', async (e) => {
  e.preventDefault();
  const email = document.getElementById('email').value;
  const contrasenia = document.getElementById('contrasenia').value;

  const { ok, datos } = await llamarApi('/auth/login', {
    method: 'POST',
    body: JSON.stringify({ email, contrasenia })
  });

  if (ok) {
    window.location.href = datos.redirect;
  } else {
    const caja = document.getElementById('error');
    caja.textContent = datos.error;
    caja.classList.remove('d-none');
  }
});