!function(n){function t(s){if(e[s])return e[s].exports;var i=e[s]={exports:{},id:s,loaded:!1};return n[s].call(i.exports,i,i.exports,t),i.loaded=!0,i.exports}var e={};return t.m=n,t.c=e,t.p="/public/",t(0)}([function(module,exports){eval('import Vue from \'vue\';\n\nvar FILL_PATH = "rgba(98, 187, 70, 0.5)";\nvar COLOR_LINE = "rgb(165, 70, 134)";\nvar RADIUS_CIRCLE = "5";\nvar COLOR_CIRCLE = "red";\nvar COLOR_STROKE = "violet";\n\nif (document.getElementById(\'vue-svg-maker\')) {\n    new Vue({\n        el: \'#vue-svg-maker\',           \n        data: {\n                points:[],\n                widthMaker:null,\n                currentPos:[],\n                fill: "transparent",\n                closePath:false,\n                constants: {\n                    RADIUS_CIRCLE:RADIUS_CIRCLE,\n                    COLOR_STROKE:COLOR_STROKE,\n                    COLOR_LINE:COLOR_LINE,\n                    COLOR_CIRCLE:COLOR_CIRCLE   \n                },\n                result:\'\'\n        },\n        mounted: function () {\n\n            this.$refs[\'image\'].addEventListener(\'load\', function(){\n                this.widthMaker = this.$refs[\'svg-maker\'].offsetWidth;    \n                this.heightMaker = this.$refs[\'svg-maker\'].offsetHeight;\n            }.bind(this));\n            window.addEventListener(\'keypress\', function(e){\n                if(e.charCode == 32) {       \n                    if (this.closePath) {\n                           this.points.pop()\n                           this.closePath = false;\n                    }         \n                    else {\n                        if(this.points.length > 0) {\n                            this.points.pop();\n                        }\n                    }    \n                    \n                }\n            }.bind(this));\n            this.checkOnInitValues()\n        },\n        updated: function(){\n            if (!this.closePath & this.points.length > 1) {\n                this.closePath = Math.abs(this.points[0][0] - this.points[this.points.length - 1][0]) < RADIUS_CIRCLE * 2 && Math.abs(this.points[0][1] - this.points[this.points.length - 1][1]) < RADIUS_CIRCLE * 2;           \n                this.fill = "transparent";\n                this.result = ""\n            }\n            if (this.closePath) {                \n                this.points[this.points.length - 1] = this.points[0];\n                this.fill = FILL_PATH;\n                this.result = this.pathPoints;\n            }            \n            \n        },\n        \n        methods: {\n            parsePath:function(path){\n                path = path.slice(1,-1)\n                path = path.split(" ").join("");\n                path = path.split("L").map(e => e.split(\',\'));\n                console.log(path);\n                return path;\n            },\n            checkOnInitValues:function(){\n                var initValue = this.$refs[\'svg-input\'].getAttribute(\'initValue\'); \n                if (initValue) {\n                    this.closePath = true;\n                    this.result = initValue;\n                    this.points = this.parsePath(initValue);\n                }               \n\n            },\n            getCoords:function([x,y]){\n                var resY = y - this.$refs[\'svg-maker\'].getBoundingClientRect().top - window.pageYOffset;\n                var resX = x - this.$refs[\'svg-maker\'].getBoundingClientRect().left - window.pageXOffset\n                // return [resX / this.widthMaker * 100, resY / this.heightMaker * 100]\n                return [resX , resY ]\n            },\n            mouseMove:function(e){\n                if(this.closePath) return []\n                this.currentPos = this.getCoords([e.pageX,e.pageY]);            \n            },\n            mouseDown:function(e) {\n                if(this.closePath) {\n                    return\n                }            \n                this.points.push(this.currentPos);\n            },\n            removePoint: function(){\n                console.log(\'remove\')\n            },\n               \n        },\n        computed: {\n            \n            pathPoints:function(){\n                // return this.points.map((el) => el.join(" ")).join(",")\n                var d = ""\n                this.points.forEach((p,i) => {\n                    if (i ==0) {\n                        d += "M " + p[0] + "," + p[1]\n                    }\n                    else {\n                        d += "L " + p[0] + "," + p[1]\n                    }\n                })\n                if (this.closePath) {\n                    d += " Z"\n                }\n                return d\n            },\n            lineNext:function(){\n                if (!this.closePath && this.points.length > 0) {\n                    return [this.points[this.points.length - 1], this.currentPos]\n                }\n                else {\n                    return [[0,0],[0,0]]\n                }\n            },\n            pointNext:function(){\n                return this.currentPos.map((el) => el)\n            }\n        }\n        \n    })\n}\n \n\n//////////////////\n// WEBPACK FOOTER\n// ./src/js/svg-maker/index.js\n// module id = 0\n// module chunks = 0\n//# sourceURL=webpack:///./src/js/svg-maker/index.js?')}]);