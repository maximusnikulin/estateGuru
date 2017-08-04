
const autoprefixer = require('autoprefixer');
const inlineSvg = require('postcss-inline-svg');
const flexbugs = require('postcss-flexbugs-fixes');
const assets = require('postcss-assets');

let config = {
  tasks: './tasks',
  preprocessor: "sass",
  isDevelopment: !process.env.NODE_ENV || process.env.NODE_ENV == 'development',
  postcssConfig :[
    autoprefixer({ browsers: ['last 2 versions'] }),
    assets({
      baseUrl:'/',
      loadPaths:['public/svg-icons/','public/images/']
    }),
    inlineSvg(),
    flexbugs()
  ],
  paths: {
    //JS
    entry:{
      'bundle': './js/index.js',
      'svg-maker': './js/svg-maker/index.js',
    },
    js: './js/**/*.{js,jsx}',        
    //SVG
    svg_sprite: './svg-sprite/**/*.svg',
    //DIST
    dist: './public',    
  },
  output: {
    js: 'js',
    css: 'css',
    images: 'images',
    svg:'svg',
    sprite:'sprite'
  }
};
//STYLES
config.paths.styles = config.preprocessor == "sass" ? ['./styles/**/*.scss', './styles/**/*.css'] : ['./styles/**/*.less', './styles/**/*.css'];
config.paths.indexStyle = config.preprocessor == "sass" ? ['./styles/index.scss'] : ['./styles/index.less'];

module.exports = config;