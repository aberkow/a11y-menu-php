const nav = document.querySelector('#am-navigation')
const menu = document.querySelector('#am-php-menu')

const navigation = new Navigation({
  click: true,
  menuId: 'am-php-menu'
})

document.addEventListener('DOMContentLoaded', () => {
  navigation.init()
})