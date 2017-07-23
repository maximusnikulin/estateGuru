
# <div align="center"><img src="http://testadnapi.a-dn.ru/logo.svg" height="100px" alt="Banner" /><br/><br/><center>Сборка длля мультистраничных сайтов</center><br/></div>

Данная сборка предназначена для создания мультистраничных приложений.

Для сборки стилей и ресурсов спользован [Gulp.js](http://gulpjs.com/) 


Для сборки JS используется webpack [Webpack.js](https://webpack.github.io/) 

> Данная версия не являтся конечной и будет улучшаться в соответствии с современными приемами и подходами к верстке😉 

## Особенности

Сборка включает следующие инструменты:

* PostCSS
* Webpack
* Babel
* Stylelint
* Eslint
* LESS
* SASS
* и другие


## Требования

* [node](https://nodejs.org/en/) >= 6.0
* [npm](https://www.npmjs.com/) >= 3.0


## Бстрый запуск

**1. Для запуска в режиме разработчика выполните команду:**

```
npm run start
``` 
Перейдите по адресу [http://localhost:3000/](http://localhost:3000/) 

**2. Для запуска в режиме деплой сборки выполните команду:**

```bash
npm run start:production    # Building bundle and running production server
```
Минифицированные файлы будут лежать в папке ***/public/***.

## Изменение препроцессора
Откройте файл ***tasks/configs/main.config.js*** и выберите значение свойства "preprocessor" (доступны less и sass):

```javascript
  let config = {
  tasks: './tasks',
  preprocessor: "less",

  //...

```
После изменения вы сможете использовать функции и синтакис выбранного препроцессора.

> При использовании любого из препроцессоров вы также сможете импортировать css файлы, однако компилироваться будет только один препроцессор. 

## Добавление синтаксиса для JS

Откройте файл ***tasks/configs/webpack.config.js*** и добавьте нужный лоадер для webpack.
В примере ниже добавим компиляцию синтаксиса [Typescript](https://www.typescriptlang.org/):


```javascript
  //...
   module: {
          loaders: [{
              test: /\.jsx?$/,
              loaders: ['babel'],
              include: path.join(__dirname, '../../js'),
              exclude: /node_modules/
          },
          {
              test: /\.tsx?$/, 
              loader: 'ts-loader', 
              include: path.join(__dirname, '../../js'),
              exclude: /node_modules/
          }]
      }
  //...
```

> Для полной работы необходимо сделать дополнительные операции подробнее в документации [ts-loader](https://github.com/TypeStrong/ts-loader)


## Работа с svg

Для работы с svg предусмотрено два сопособа:

1. Через PostCSS:

```scss
  .mySvgLogo {
      background:inline(nameOfLogo.svg);
      height:height(nameOfLogo.svg);
      width:width(nameOfLogo.svg);
  }
  //...

```
После чего svg иконка вставится в виде 64-битовой маски, размера соответствующего оригинальному изображению.

> Этот способ отлично сокращается с миксином для sass (имеется в сборке) и less

2. Через Sprite

Просто закиньте нужные вам иконки в папку ***/svg-sprite/*** после чего присвойте соответствующие миксины

****LESS****
```less
  .mySvgLogo {
      .svg-nameOfLogo;
      .svg-nameOfLogo-dims;
  }
  //...
```

****SASS****
```less
  .mySvgLogo {
      @include svg-nameOfLogo;
      @include svg-nameOfLogo-dims;
  }
  //...
```