let filesToExclude = []
let filesToDelete = []

function removeFile(id) {
  if (filesToDelete.includes(id)) {
    filesToDelete.splice(filesToDelete.indexOf(id), 1)
  } else {
    filesToDelete.push(id)
  }

  document.getElementById('filesToDelete').value = JSON.stringify(filesToDelete)

  if (
    document.getElementById('fileUndelete' + id).classList.contains('is-hidden')
  ) {
    document.getElementById('fileUndelete' + id).classList.remove('is-hidden')
    document.getElementById('fileDelete' + id).classList.add('is-hidden')
    document.getElementById('filetodelete' + id).classList.add('strike')
  } else {
    document.getElementById('fileUndelete' + id).classList.add('is-hidden')
    document.getElementById('fileDelete' + id).classList.remove('is-hidden')
    document.getElementById('filetodelete' + id).classList.remove('strike')
  }
}

function cancelFile(key, fname) {
  document.getElementById(`K${key}`).remove()

  if (filesToExclude.includes(fname)) {
    filesToExclude.splice(filesToExclude.indexOf(fname), 1)
  } else {
    filesToExclude.push(fname)
  }

  if (filesToExclude.length > 0) {
    document.getElementById('filesToExclude').value = filesToExclude.join()
  } else {
    document.getElementById('filesToExclude').value = ''
  }

  document.getElementById('filesToUpload').value =
    document.getElementById('filesToUpload').value - 1

  if (document.getElementById('filesToUpload').value < 1) {
    document.getElementById('files_table').remove()
  }

  if (document.getElementById('filesToUpload').value == 0) {
    document.getElementById('noFile').classList.remove('is-hidden')
  }
}

function getNames() {
  var newFiles = document.getElementById('fupload')

  if (Object.entries(newFiles.files).length < 1) {
    document.getElementById('noFile').classList.remove('is-hidden')
    return true
  }

  document.getElementById('noFile').classList.add('is-hidden')

  let satir = `
    <thead>
    <tr>
        <th>File Name</th>
        <th>Size</th>
        <th>Type</th>
        <th>&nbsp;</th>
    </tr>
    </thead>`

  dosyalar = []

  let table = document.createElement('table')
  table.id = 'files_table'
  table.classList.add('table', 'is-fullwidth')

  for (const [key, dosya] of Object.entries(newFiles.files)) {
    satir =
      satir +
      `
        <tr id="K${key}">
            <td>${dosya.name}</td>
            <td>${dosya.size}</td>
            <td>${dosya.type}</td>
            <td><a class="has-text-danger" onclick="cancelFile('${key}','${dosya.name}')">x</a></td>
        </tr>`

    dosyalar.push({ key: dosya })
  }

  table.innerHTML = satir

  document.getElementById('filesToUpload').value = Object.entries(
    newFiles.files,
  ).length
  document.getElementById('filesToExclude').value = ''
  document.getElementById('filesList').append(table)
}
