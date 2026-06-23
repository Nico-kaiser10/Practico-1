const riel = document.getElementById("riel");
const siguiente = document.getElementById("siguiente");
const anterior = document.getElementById("anterior");

const mover = 500;

siguiente.addEventListener("click" , () => {
    riel.scrollBy({ left: mover, behavior: "smooth"});
});

anterior.addEventListener("click", () => {
    riel.scrollBy({left : -mover, behavior: "smooth"});
});

const riel2 = document.getElementById("riel2");
const siguiente2 = document.getElementById("siguiente2");
const anterior2 = document.getElementById("anterior2");

siguiente2.addEventListener("click" , () => {
    riel2.scrollBy({ left: mover, behavior: "smooth"});
});

anterior2.addEventListener("click", () => {
    riel2.scrollBy({left : -mover, behavior: "smooth"});
}); 

const sorpresa = document.getElementById("sorpresa");

sorpresa.addEventListener("click", () => {
    !alert ("¡Cielo de un solo color!");
});