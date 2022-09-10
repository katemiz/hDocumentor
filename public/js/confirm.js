function confirmDelete(id, tur) {
  let title

  switch (tur) {
    case 'letter':
      title = 'Delete Letter ?'
      break

    case 'company':
      title = 'Delete Company ?'
      break
  }

  Swal.fire({
    title: title,
    text: 'Not possible to revert back. Are you sure?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.isConfirmed) {
      //window.livewire.emit('delete', id)
      window.location.href = '/letter-delete/' + id
    } else {
      return false
    }
  })
}

function signConfirm(id) {
  Swal.fire({
    title: 'Sign and Approve Letter ?',
    text: 'Not possible to revert back. Are you sure?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Approve and Sign',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = '/letter-sign/' + id
    } else {
      return false
    }
  })
}
