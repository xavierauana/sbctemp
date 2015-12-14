module.exports = ->
  inputs = document.getElementsByTagName('form')[0].elements
  removeDisable = (el)->
    el.removeAttribute 'disabled'

  removeDisable input for input in inputs when input.type == 'test' or input.type == 'select'