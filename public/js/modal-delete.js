function openDeleteModal(id, resource, itemId, itemName) {
  const modal = document.getElementById(`${id}-modal`);
  const message = document.getElementById(`${id}-message`);
  const form = document.getElementById(`${id}-form`);

  // Mensaje dinámico
  message.textContent = `¿Seguro que deseas eliminar ${itemName}?`;

  // Acción dinámica del form
  form.action = `/${resource}/${itemId}`;

  // Mostrar modal
  modal.classList.remove('hidden');
  modal.classList.add('flex');
}

function closeDeleteModal(id) {
  const modal = document.getElementById(`${id}-modal`);
  modal.classList.remove('flex');
  modal.classList.add('hidden');
}

// Cerrar modal clicando fuera del contenido
document.addEventListener('click', function(e) {
  document.querySelectorAll('[id$="-modal"]').forEach(modal => {
    if (!modal.classList.contains('hidden') && e.target === modal) {
      closeDeleteModal(modal.id.replace('-modal', ''));
    }
  });
});
// Cerrar modal al hacer clic fuera del contenido
/* document.addEventListener('click', function(e) {
  const modal = document.getElementById('{{ $id }}-modal');
  if (!modal.classList.contains('hidden') && e.target === modal) {
    closeDeleteModal('delete-user');
  }
}); */