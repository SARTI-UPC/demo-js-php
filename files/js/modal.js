
const modal = document.getElementById('confirmModal');
const btnCerrarModal = document.getElementsByClassName('close')[0];
const btnConfirmar = document.getElementById('confirmarBtn');
const btnCancel = document.getElementById('cancelarBtn');

let currentFolder = "";
let currentFile = "";

btnCerrarModal.onclick = function() {
  modal.style.display = 'none';
};

btnCancel.onclick = function() {
  modal.style.display = 'none';
};

// Confirmar l'esborrat al fer click al botó "Confirmar"
btnConfirmar.onclick = function() {
  console.log('Archivo borrado');

 window.location.href="listDir-3.php?folder="+currentFolder+"&op=delete&file="+currentFile;

  modal.style.display = 'none';
};

// Tancar el modal si es fa click fora d'ell
window.onclick = function(event) {
  if (event.target === modal) {
    modal.style.display = 'none';
  }
};

function showModal(theFolder, theFile)  {

    const modal = document.getElementById('confirmModal');
    modal.style.display = 'block';

    currentFile = theFile;
    currentFolder = theFolder;
    //alert("yep");

}