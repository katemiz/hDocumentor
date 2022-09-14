function confirmDelete(id, tur) {
  let title
  let redirect

  switch (tur) {
    case 'letter':
      title = 'Delete Letter ?'
      redirect = '/letter-delete/' + id
      break

    case 'company':
      title = 'Delete Company ?'
      redirect = '/company-delete/' + id

      break

    case 'aitem':
      title = 'Delete Action Item ?'
      redirect = '/ai-delete/' + id
      break
  }

  Swal.fire({
    title: title,
    text: 'Not possible to revert back. Are you sure?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Delete',
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = redirect
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
