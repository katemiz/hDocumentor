function tableHeadCellHover(thname, inOut) {
  if (inOut == 'in') {
    document.getElementById('th' + thname).classList.remove('is-hidden')
  } else {
    document.getElementById('th' + thname).classList.add('is-hidden')
  }
}
