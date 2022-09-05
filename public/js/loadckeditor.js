function loadEditor(placeholder) {
  ClassicEditor.create(document.querySelector('#editor'), {
    placeholder: placeholder,

    list: {
      properties: {
        styles: true,
        startIndex: false,
        reversed: false,
      },
    },

    // toolbar: [
    //   'bold',
    //   'italic',
    //   'link',
    //   'undo',
    //   'redo',
    //   'numberedList',
    //   'bulletedList',
    // ],

    // toolbar: [
    //   'undo',
    //   'redo',
    //   '|',
    //   'heading',
    //   'fontFamily',
    //   'fontSize',
    //   '|',
    //   'bold',
    //   'italic',
    //   'underline',
    //   'fontColor',
    //   'fontBackgroundColor',
    //   'highlight',
    //   '|',
    //   'link',
    //   'CKFinder',
    //   'imageUpload',
    //   'mediaEmbed',
    //   '|',
    //   'alignment',
    //   'bulletedList',
    //   'numberedList',
    //   '|',
    //   'indent',
    //   'outdent',
    //   '|',
    //   'insertTable',
    //   'blockQuote',
    //   'specialCharacters',
    // ],
  })
    .then((editor) => {
      let icerik = document.getElementById('ckeditor').value

      if (icerik.length > 0) {
        editor.setData(icerik)
      }

      editor.model.document.on('change:data', (evt, data) => {
        document.getElementById('ckeditor').value = editor.getData()
      })
    })
    .catch((error) => {
      console.error(error)
    })
}
