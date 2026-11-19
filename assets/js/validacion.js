// Validación de formularios: campos vacíos, formato de correo, largo y coincidencia de contraseñas
document.addEventListener('DOMContentLoaded', () => {
  const setError = (input, texto) => {
    const base = input.parentElement.classList.contains('pw') ? input.parentElement : input;
    const msg = base.nextElementSibling;
    if (msg && msg.classList.contains('msg')) msg.textContent = texto;
    input.classList.toggle('invalid', texto !== '');
  };

  const validar = (form) => {
    let valido = true;
    form.querySelectorAll('input[required]').forEach((input) => {
      let error = '';
      if (input.value.trim() === '') error = 'Este campo es obligatorio.';
      else if (input.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value)) error = 'Ingresá un correo válido.';
      setError(input, error);
      if (error) valido = false;
    });

    const pass = form.querySelector('#password');
    const conf = form.querySelector('#confirmar');
    if (conf && pass) {
      if (pass.value && pass.value.length < 8) {
        setError(pass, 'Mínimo 8 caracteres.');
        valido = false;
      }
      if (conf.value && pass.value !== conf.value) {
        setError(conf, 'Las contraseñas no coinciden.');
        valido = false;
      }
    }
    return valido;
  };

  document.querySelectorAll('form').forEach((form) => {
    form.addEventListener('submit', (e) => { if (!validar(form)) e.preventDefault(); });
    form.querySelectorAll('input').forEach((i) => i.addEventListener('input', () => setError(i, '')));
  });

  document.querySelectorAll('.toggle').forEach((btn) => {
    btn.addEventListener('click', () => {
      const campo = document.getElementById(btn.dataset.target);
      const oculto = campo.type === 'password';
      campo.type = oculto ? 'text' : 'password';
      btn.textContent = oculto ? 'Ocultar' : 'Ver';
    });
  });
});
