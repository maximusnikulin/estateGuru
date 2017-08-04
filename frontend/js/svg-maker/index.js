import Vue from 'vue';

var FILL_PATH = "rgba(98, 187, 70, 0.34)";
var COLOR_PATH = "rgba(98, 187, 70, 0.34)";
var COLOR_LINE = "rgb(165, 70, 134)";
var RADIUS_CIRCLE = "10";


if (document.getElementById('vue-svg-maker')) {
    new Vue({
        el: '#vue-svg-maker',           
        data: {
                points:[],
                widthMaker:null,
                currentPos:[],
                fill: "transparent",
                closePath:false,
                constants: {
                    RADIUS_CIRCLE:RADIUS_CIRCLE,
                    COLOR_STROKE:COLOR_STROKE   
                }
                

        },
        mounted: function () {
            this.$refs['image'].addEventListener('load', function(){
                this.widthMaker = this.$refs['svg-maker'].offsetWidth;    
                this.heightMaker = this.$refs['svg-maker'].offsetHeight;
            }.bind(this))
            window.addEventListener('keypress', function(e){
                if(e.charCode == 32) {       
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
            }.bind(this))
            
        },
        updated: function(){
            if (!this.closePath & this.points.length > 1) {
                this.closePath = Math.abs(this.points[0][0] - this.points[this.points.length - 1][0]) < RADIUS_CIRCLE * 2 && Math.abs(this.points[0][1] - this.points[this.points.length - 1][1]) < RADIUS_CIRCLE * 2;           
                this.fill = "transparent"
            }
            if (this.closePath) {
                this.points[this.points.length - 1] = this.points[0];
                this.fill = FILL_PATH
            }            
            
        },
        methods: {
            getCoords:function([x,y]){
                var resY = y - this.$refs['svg-maker'].getBoundingClientRect().top - window.pageYOffset;
                var resX = x - this.$refs['svg-maker'].getBoundingClientRect().left - window.pageXOffset
                // return [resX / this.widthMaker * 100, resY / this.heightMaker * 100]
                return [resX , resY ]
            },
            mouseMove:function(e){
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
            }       
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
 