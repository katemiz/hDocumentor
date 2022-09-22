// let chapters = {!! json_encode($chapters) !!}

// Add visibility and new_parent_id
// chapters.forEach( (chapter,key,array) => {
//     chapters[key].visibility = 'show'
//     chapters[key].new_parent_id = chapter.parent_id
// })

let tree = []

let root = document.querySelector('[tree-root]')

let action // to identify move action: before, after or child
let height // height of target element onto which dragged element is droped

root.querySelectorAll('[tree-branch]').forEach((el) => {
  // Render all branch icons [open, closed or node]
  checkIcon(el)

  el.addEventListener('dragstart', (e) => {
    let draggedEl = getDivElement(e.target)

    draggedEl.setAttribute('suruklenen', true)
    draggedEl.classList.add('has-background-light')
  })

  el.addEventListener('drop', (e) => {
    e.target.classList.remove('box', 'withborder', 'topborder', 'bottomborder')

    let targetElId = e.target.getAttribute('tree-branch')

    let suruklenenEl = root.querySelector('[suruklenen]')
    suruklenenEl.classList.remove('has-background-light')

    // console.log("chapters",chapters)

    let targetEl = getDivElement(e.target)

    if (action == 'before') {
      targetEl.before(suruklenenEl)
    }

    if (action == 'after') {
      targetEl.after(suruklenenEl)
    }

    if (action == 'before' || action == 'after') {
      // chapters.forEach ( (chapter,key) => {
      //     if (chapter.id == suruklenenEl.getAttribute('tree-branch')) {

      //         console.log("AAAAAA",targetEl.getAttribute('parent'))
      //         chapters[key].new_parent_id = parseInt(targetEl.getAttribute('parent'))

      //         console.log("BBBB",targetEl.getAttribute('parent'))

      //     }
      // })

      suruklenenEl.setAttribute('parent', targetEl.getAttribute('parent'))
    }

    if (action == 'child') {
      targetEl.append(suruklenenEl)

      // chapters.forEach ( (chapter,key) => {

      //     if (chapter.id == suruklenenEl.getAttribute('tree-branch')) {
      //         chapters[key].new_parent_id = parseInt(targetElId)
      //     }
      // })

      suruklenenEl.setAttribute('parent', targetElId)
    }

    // Refresh livewire component
    let component = Livewire.find(
      e.target.closest('[wire\\:id]').getAttribute('wire:id'),
    )

    let orderIds = Array.from(root.querySelectorAll('[tree-branch]')).map(
      (itemEl) => {
        return {
          id: itemEl.getAttribute('tree-branch'),
          parent_id: itemEl.getAttribute('parent'),
        }
      },
    )

    component.call('treeOrder', getTreeStructure(root))

    root.querySelectorAll('[tree-branch]').forEach((el) => {
      checkIcon(el)
    })
  })

  el.addEventListener('dragenter', (e) => {
    e.preventDefault()
  })

  el.addEventListener('dragover', (e) => {
    e.preventDefault()
    e.target.classList.remove('box', 'withborder', 'topborder', 'bottomborder')

    height = e.target.getBoundingClientRect().height

    const rect = e.target.getBoundingClientRect()

    if (rect.top < e.clientY && e.clientY < rect.top + height / 4) {
      e.target.classList.add('topborder')
      action = 'before'
    }

    if (
      e.clientY > rect.top + height / 4 &&
      e.clientY < rect.top + (height * 3) / 4
    ) {
      e.target.classList.add('withborder')
      action = 'child'
    }

    if (e.clientY > rect.top + (height * 3) / 4 && e.clientY < rect.bottom) {
      e.target.classList.add('bottomborder')
      action = 'after'
    }
  })

  el.addEventListener('dragleave', (e) => {
    e.target.classList.remove('box', 'withborder', 'topborder', 'bottomborder')
  })

  el.addEventListener('dragend', (e) => {
    getDivElement(e.target).removeAttribute('suruklenen')
  })
})

function getTreeStructure(element, dizin = []) {
  element.querySelectorAll(':scope > [tree-branch]').forEach((el) => {
    let childNodes = el.querySelectorAll(':scope > [tree-branch]')

    let node = {
      id: el.getAttribute('tree-branch'),
      parent_id: el.getAttribute('parent'),
    }

    if (childNodes.length > 0) {
      node.children = getTreeStructure(el)
    } else {
      node.children = false
    }

    dizin.push(node)
  })

  return dizin
}

function getDivElement(el) {
  if (el.hasAttribute('tree-branch')) {
    return el
  } else {
    getDivElement(el.parentElement)
  }
}

function toggleBranch(parentNo) {
  root.querySelectorAll('[parent]').forEach((el) => {
    if (parentNo == el.getAttribute('parent')) {
      if (el.classList.contains('is-hidden')) {
        el.classList.remove('is-hidden')
      } else {
        el.classList.add('is-hidden')
      }
    }
  })
}

function checkIcon(el) {
  let nodeId = el.getAttribute('tree-branch')
  let children = Array.from(el.querySelectorAll('[tree-branch]'))
  let iconsEl = document.getElementById('Icons' + nodeId)

  let has_children = document.getElementById('A' + nodeId)
  let no_children = document.getElementById('B' + nodeId)
  let lone_node = document.getElementById('C' + nodeId)

  if (children.length > 0) {
    has_children.classList.remove('is-hidden')
    no_children.classList.add('is-hidden')
    lone_node.classList.add('is-hidden')
  } else {
    has_children.classList.add('is-hidden')
    no_children.classList.add('is-hidden')
    lone_node.classList.remove('is-hidden')
  }
}
