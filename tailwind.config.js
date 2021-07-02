module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
    	backgroundImage: theme => ({
         'nav-background': "url('https://digidev.zlbib.uni-augsburg.de/laravel/img/nav-background.jpg')",
         'footer-texture': "url('/img/footer-texture.png')",
        })
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
