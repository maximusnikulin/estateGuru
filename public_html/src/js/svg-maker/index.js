import Vue from 'vue';

var FILL_PATH = "rgba(98, 187, 70, 0.5)";
var COLOR_LINE = "rgb(165, 70, 134)";
var RADIUS_CIRCLE = "5";
var COLOR_CIRCLE = "red";
var COLOR_STROKE = "violet";

if (document.getElementById('vue-svg-maker')) {
    new Vue({
        el: '#vue-svg-maker',           
        data: {
                points:[],
                mouseIsOver:false,
                widthMaker:null,
                currentPos:[],
                fill: "transparent",
                closePath:false,
                constants: {
                    RADIUS_CIRCLE:RADIUS_CIRCLE,
                    COLOR_STROKE:COLOR_STROKE,
                    COLOR_LINE:COLOR_LINE,
                    COLOR_CIRCLE:COLOR_CIRCLE   
                },
                result:''
        },
        mounted: function () {   
            
            this.$refs['image'].addEventListener('load', function(){
                this.widthMaker = this.$refs['svg-maker'].offsetWidth;    
                this.heightMaker = this.$refs['svg-maker'].offsetHeight;
            }.bind(this));
            let container = document.getElementById("vue-svg-maker")
            container.addEventListener('mouseenter', () => {
                console.log('enter');
                this.mouseIsOver = true;
            })
            container.addEventListener('mouseleave', () => {
                console.log('leave')
                this.mouseIsOver = false;
            })
            window.addEventListener('keypress', (e) => { 
                console.log(this.mouseIsOver)
                if (!this.mouseIsOver) return;

                if(e.keyCode == 32) {       
                    e.preventDefault();
                    if (this.closePath) {
                           this.points.pop()
                           this.closePath = false;
                    }         
                    else {
                        if(this.points.length > 0) {
                            this.points.pop();
                        }
                    }    
                    
                }
            });
            this.checkOnInitValues();
            
            $(window).trigger('INIT_SVG_MAKER');
        },
        updated: function(){
            if (!this.closePath & this.points.length > 1) {
                this.closePath = Math.abs(this.points[0][0] - this.points[this.points.length - 1][0]) < RADIUS_CIRCLE * 2 && Math.abs(this.points[0][1] - this.points[this.points.length - 1][1]) < RADIUS_CIRCLE * 2;           
                this.fill = "transparent";
                this.result = ""
            }
            if (this.closePath) {                
                this.points[this.points.length - 1] = this.points[0];
                this.fill = FILL_PATH;
                this.result = this.pathPoints;
            }            
            
        },
        
        methods: {
            parsePath:function(path){
                path = path.slice(1,-1)
                path = path.split(" ").join("");
                path = path.split("L").map(e => e.split(','));
                console.log(path);
                return path;
            },
            checkOnInitValues:function(){
                var initValue = this.$refs['svg-input'].getAttribute('initValue'); 
                if (initValue) {
                    this.closePath = true;
                    this.result = initValue;
                    this.points = this.parsePath(initValue);
                }               
            },
            getCoords:function([x,y]){
                var resY = y - this.$refs['svg-maker'].getBoundingClientRect().top - window.pageYOffset;
                var resX = x - this.$refs['svg-maker'].getBoundingClientRect().left - window.pageXOffset
                // return [resX / this.widthMaker * 100, resY / this.heightMaker * 100]
                return [resX , resY ]
            },
            mouseMove:function(e){
                if(this.closePath) return []
                this.currentPos = this.getCoords([e.pageX,e.pageY]);            
            },
            mouseDown:function(e) {
                if(this.closePath) {
                    return
                }            
                this.points.push(this.currentPos);
            },
            removePoint: function(){
                console.log('remove')
            },
               
        },
        computed: {
            
            pathPoints:function(){
                // return this.points.map((el) => el.join(" ")).join(",")
                var d = ""
                this.points.forEach((p,i) => {
                    if (i ==0) {
                        d += "M " + p[0] + "," + p[1]
                    }
                    else {
                        d += "L " + p[0] + "," + p[1]
                    }
                })
                if (this.closePath) {
                    d += " Z"
                }
                return d
            },
            lineNext:function(){
                if (!this.closePath && this.points.length > 0) {
                    return [this.points[this.points.length - 1], this.currentPos]
                }
                else {
                    return [[0,0],[0,0]]
                }
            },
            pointNext:function(){
                return this.currentPos.map((el) => el)
            }
        }
        
    })
}
 