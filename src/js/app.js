document.addEventListener('DOMContentLoaded',()=>eventListeners());


function eventListeners(){
    const mobilMenu = document.querySelector('.mobile-menu');
    mobilMenu.addEventListener('click',navegacionResponse);

    // Muestra Campos Condifionales

    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click',mostrarMetodosCotnacto));
}

const navegacionResponse = ()=>{
    const navegacion = document.querySelector('.navegacion');
    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }
}

/*
window.matchMedia('(prefers-color-scheme: dark)')
*/


function mostrarMetodosCotnacto(e) {
    const contactoDiv = document.querySelector('#contacto');
    if (e.target.value==='telefono'){
        contactoDiv.innerHTML = `
        <label for="telefono">Numero de Telefono</label>
        <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">
        <p>Elija la fecha y hora para llamada</p>
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="contacto[fecha]">
        <label for="hora">Hora</label>
        <input type="time" id="hora" min="09:00" max="16:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu E-mail" id="email" name="contacto[email]" required>
        `;
    }
}