<template>
    <div class="svg-maker" ref = "svg-maker">
        <div class="svg-maker__image">
            <img src="/images/svg-layout.png" alt="" width="100%" ref = "image">
        </div>
        <div class="svg-maker__svg" v-on="{ mousemove: mouseMove, mousedown:mouseDown}"> 
            <svg width = "100%" height = "100%" >                
                 <path v-bind:d = "pathPoints" v-bind:fill = "fill" stroke = "green" stroke-width = "1"/>
                 <line v-bind:x1 = "lineNext[0][0]" v-bind:y1 = "lineNext[0][1]" v-bind:x2 = "lineNext[1][0]" v-bind:y2 = "lineNext[1][1]" stroke = "violet" stroke-width = "1"></line>            
                 <circle v-for = "point in points" v-bind:cx = "point[0]" v-bind:cy = "point[1]" r = "10" fill = "red"></circle>
                 <circle  v-bind:cx = "pointNext[0]" v-bind:cy = "pointNext[1]" r = "10" fill = "red" opacity = ".7"></circle>                 
            </svg>
        </div>
    </div>
</template>

<script>  



export default {
    name:'svg-maker',
    data:function(){
        return {
            points:[],
            widthMaker:null,
            currentPos:[],
            fill:"transparent",
            closePath:false
        }
    },
    mounted: function () {
        this.$refs['image'].addEventListener('load', function(){
            this.widthMaker = this.$refs['svg-maker'].offsetWidth;    
            this.heightMaker = this.$refs['svg-maker'].offsetHeight;
        }.bind(this))
        window.addEventListener('keypress', function(e){
            if(e.charCode == 32) {                
                if(this.points.length > 0 && !this.closePath) {
                    this.points.pop()
                }
            }
        }.bind(this))
        
    },
    updated: function(){
        if (!this.closePath & this.points.length > 1) {
            this.closePath = Math.abs(this.points[0][0] - this.points[this.points.length - 1][0]) < 20 && Math.abs(this.points[0][1] - this.points[this.points.length - 1][1]) < 20;           
            
        }
        if (this.closePath) {
            this.points[this.points.length - 1] = this.points[0];
            this.fill = "blue"
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
}

</script>
<style>
  .svg-maker  {
    width:840px;
    margin:100px auto 100px;
    border:1px solid red;
    position: relative;
  }
  .svg-maker__image img{
    max-width:100%;
  }
  .svg-maker{
     
  }
  .svg-maker__svg {
    position: absolute;
    width:100%;
    height:100%;
    top:0;
  }
</style> 