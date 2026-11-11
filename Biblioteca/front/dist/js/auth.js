const API = '/api';

async function llamarApi(ruta, opciones = {}) {
  const resp = await fetch(API + ruta, {
    headers: { 'Content-Type': 'application/json' },
    ...opciones
  });
  const datos = await resp.json();
  return { ok: resp.ok, datos };
}

async function cerrarSesion() {
  await llamarApi('/auth/logout', { method: 'POST' });
  window.location.href = '/front/dist/paginas/login.html';
}

async function protegerPagina(rolRequerido) {
  const { ok, datos } = await llamarApi('/auth/me');
  if (!ok) {
    window.location.href = '/front/dist/paginas/login.html';
    return null;
  }
  if (rolRequerido && datos.rol !== rolRequerido) {
    window.location.href = '/front/dist/paginas/usuario/inicio.html';
    return null;
  }
  document.body.style.display = '';
  return datos;
}