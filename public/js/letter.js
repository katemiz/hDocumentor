function confirmDelete(id) {
  Swal.fire({
    title: 'Delete Letter ?',
    text: 'Not possible to revert back. Are you sure?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.isConfirmed) {
      //window.livewire.emit('delete', id)
    } else {
      return false
    }
  })
}

function tableHeadCellHover(thname, inOut) {
  if (inOut == 'in') {
    document.getElementById('th' + thname).classList.remove('is-hidden')
  } else {
    document.getElementById('th' + thname).classList.add('is-hidden')
  }
}
