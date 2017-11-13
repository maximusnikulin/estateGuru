import VisualModel from './VisualModel';
import VisualView from './VisualView';
import VisualController from './VisualController';

let model = new VisualModel(window.visualModel);
let view = new VisualView($('.js-visual-container'));
let controller = new VisualController(model, view);

controller.init();