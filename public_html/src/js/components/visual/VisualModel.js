class VisualModel {
    constructor(model) {
        this.origin = model;
        this.model = this._prepareModel(model);
        this.state = null;
        //?????        
        this._createStateByModel(this.model);
    }
    _prepareModel(model) {
        let { blocks, locations, apartments } = model;
        let result = {};
        for (var bl in blocks) {            
            let nameBS = blocks[bl];                        
            locations
                .filter(loc => loc.idBlockSection == bl)
                .forEach(loc => {
                    if (typeof result[nameBS] !== 'object') {
                        result[nameBS] = {}
                    }
                    result[nameBS][loc.name] = {
                        image:loc.image,
                        apartments:apartments.filter(apart => apart.idLocation == loc.id)
                    }
                })            
        }                
        return result
    }
    _createStateByModel(model) {
        let blockSection = this.getBlocksKeys()[0];        
        this.state = {
            blockSection            
        }
    }
    setBlockSection(val, ...fns) {          
        this.state.blockSection = val;
        this.state.locations = this.getLocations(val);          
        fns.forEach(fn => fn(this.state))
    }
    
    getState() {
        return this.state;
    }
    getModel() {
        return this.model;
    }
    getLocation(nameBlockSection, nameLocation) {        
            return this.model[nameBlockSection][nameLocation];        
    }
    getLocations() {                
        return this.model;
    }
    getBlocksKeys() {
        return Object.keys(this.model);
    }
    getLocationsKeys(nameBlockSection) {        
        return Object.keys(this.model[nameBlockSection]);
    }
}

export default VisualModel;