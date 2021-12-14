let paso=1;const pasoInicial=1,pasoFinal=3,apartado={id:"",nombre:"",fecha:"",hora:"",componentes:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen(),buscarComponente()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");const t="#paso-"+paso;document.querySelector(t).classList.add("mostrar");const o=document.querySelector(".actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){e.preventDefault(),paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))})}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):3===paso?(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()):(e.classList.remove("ocultar"),t.classList.remove("ocultar")),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,botonesPaginador())}))}async function consultarAPI(){try{const e="http://localhost:3000/api/componentes",t=await fetch(e);filtrarDisponibles(await t.json())}catch(e){console.log(e)}}function filtrarDisponibles(e){mostrarComponentes(e.filter(e=>"0"===e.estado))}function mostrarComponentes(e){e.forEach(e=>{const{id:t,categoria:o,nombre:n}=e,a=document.createElement("P");a.classList.add("nombre-componente"),a.textContent=n;const r=document.createElement("P");r.classList.add("categoria-componente"),r.textContent=o;const c=document.createElement("DIV");c.classList.add("componente"),c.dataset.idComponente=t,c.onclick=function(){seleccionarComponente(e)},c.appendChild(a),c.appendChild(r),document.querySelector("#componentes").appendChild(c)}),buscarComponente()}function seleccionarComponente(e){const{id:t}=e,{componentes:o}=apartado,n=document.querySelector(`[data-id-componente="${t}"]`);o.some(e=>e.id===t)?(apartado.componentes=o.filter(e=>e.id!==t),n.classList.remove("seleccionado")):(apartado.componentes=[...o,e],n.classList.add("seleccionado"))}function idCliente(){apartado.id=document.querySelector("#id").value}function nombreCliente(){apartado.nombre=document.querySelector("#nombre").value}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("Fines de semana no permitidos","error",".formulario")):apartado.fecha=e.target.value}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":")[0];t<7||t>20?(e.target.value="",mostrarAlerta("Hora No Válida","error",".formulario")):apartado.hora=e.target.value}))}function seleccionarCantidad(){}function mostrarAlerta(e,t,o,n=!0){const a=document.querySelector(".alerta");a&&a.remove();const r=document.createElement("DIV");r.textContent=e,r.classList.add("alerta"),r.classList.add(t);document.querySelector(o).appendChild(r),n&&setTimeout(()=>{r.remove()},3e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(apartado).includes("")||0===apartado.componentes.length)return void mostrarAlerta("Faltan datos de Componentes, Fecha u Hora","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:n,componentes:a}=apartado,r=document.createElement("H3");r.textContent="Resumen de Componentes",e.appendChild(r),a.forEach(t=>{const{id:o,cantidad:n,nombre:a}=t,r=document.createElement("DIV");r.classList.add("contenedor-componente");const c=document.createElement("P");c.textContent=a;const s=document.createElement("P");s.textContent="Folio: "+o,r.appendChild(c),r.appendChild(s),e.appendChild(r)});const c=document.createElement("H3");c.textContent="Resumen de Apartado",e.appendChild(c);const s=document.createElement("P");s.innerHTML="<span>Nombre:</span> "+t;const i=new Date(o),d=i.getMonth(),l=i.getDate()+2,u=i.getFullYear(),m=new Date(Date.UTC(u,d,l)).toLocaleDateString("es-MX",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),p=document.createElement("P");p.innerHTML="<span>Fecha:</span> "+m;const f=document.createElement("P");f.innerHTML=`<span>Hora a recoger:</span> ${n} Horas`;const h=document.createElement("BUTTON");h.classList.add("boton"),h.textContent="Reservar Apartado",h.onclick=reservarApartado,e.appendChild(s),e.appendChild(p),e.appendChild(f),e.appendChild(h)}async function reservarApartado(){const{nombre:e,fecha:t,hora:o,componentes:n,id:a}=apartado,r=n.map(e=>e.id),c=new FormData;c.append("fecha",t),c.append("hora",o),c.append("apartado_usuarioId",a),c.append("componentes",r);try{const e=await fetch("http://localhost:3000/api/apartados",{method:"POST",body:c});(await e.json()).resultado&&Swal.fire({icon:"success",title:"Apartado Correcto",text:"Apartaste tus componentes correctamente",button:"Ok"}).then(()=>{window.location.reload()})}catch(e){Swal.fire({icon:"error",title:"Ocurrió un error",text:"Veremos que sucede intenta más tarde...",button:"Ok"}).then(()=>{window.location.reload()})}}function buscarComponente(){const e=document.querySelector("#filtroInput");e.addEventListener("keyup",(function(){const t=e.value.toLowerCase();document.querySelectorAll(".componente").forEach(e=>{e.textContent.toLowerCase().includes(t.toLowerCase())?e.style.display="":e.style.display="none"})}))}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));