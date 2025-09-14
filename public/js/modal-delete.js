function showDeleteModal(itemId) {
  const modal = document.getElementById(`confirmDeleteModal-${itemId}`);
  if (modal) {
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }
}

function hideDeleteModal(itemId) {
  const modal = document.getElementById(`confirmDeleteModal-${itemId}`);
  if (modal) {
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
  }
}

// Cerrar modal con ESC
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') {
    const openModals = document.querySelectorAll('[id^="confirmDeleteModal-"]:not(.hidden)');
    openModals.forEach(modal => {
      const itemId = modal.id.replace('confirmDeleteModal-', '');
      hideDeleteModal(itemId);
    });
  }
});

// Cerrar al hacer clic fuera
document.addEventListener('click', function (e) {
  if (e.target.matches('[id^="confirmDeleteModal-"]')) {
    const itemId = e.target.id.replace('confirmDeleteModal-', '');
    hideDeleteModal(itemId);
  }
});