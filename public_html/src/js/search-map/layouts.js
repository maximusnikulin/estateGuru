export const PM_ICON_LT = `<div class = "placemark__icon">{{properties.clusterCaption}} &#8381;</div>`;

export const PM_BALOON_LT = `<div class="placemark__balloon" >
                                <a href="{{properties.url}}" target = "_blank" class = "card-map">
                                <div class="card-map__head">
                                  <div class="photo" style="background-image:url({{properties.image}})"></div>
                                  <div class="price">
                                    <span class="price__title">Цена</span>
                                    <span class="price__val">{{properties.clusterCaption}} &#8381;</span>
                                  </div>                  
                                </div>
                                <div class="card-map__name">
                                  <h2 class="address">{{properties.adres}}</h2>                                  
                                </div> 
                                <div class="card-map__more">
                                  <div class="row">
                                    <div class="row__name">Тип</div>
                                    <div class="row__val">{{properties.type}}</div>
                                  </div>
                                  <div class="row">
                                    <div class="row__name">Район</div>
                                    <div class="row__val">{{properties.rayon}}</div>
                                  </div>                                                     
                                </div> 
                                
                                <div class="card-map__info">
                                {% if properties.floor %}
                                    <div class="cell">
                                      <p class="cell__title">Этажность</p>
                                      <p class="cell__val">{{properties.floor}}</p>
                                    </div>  
                                {% endif %}
                                {% if properties.squareGa %}
                                  <div class="cell">
                                    <p class="cell__title">Площадь</p>
                                    <p class="cell__val">{{properties.squareGa}} Га</p>
                                  </div>  
                                {% endif %}
                                {% if properties.generalSquare %}
                                  <div class="cell">
                                    <p class="cell__title">Общая площадь</p>
                                    <p class="cell__val">{{properties.generalSquare}} м²</p>
                                  </div>  
                                {% endif %}
                                {% if properties.usefullSquare %}
                                  <div class="cell">
                                    <p class="cell__title">Полезная площадь</p>
                                    <p class="cell__val">{{properties.usefullSquare}} м²</p>
                                  </div>  
                                {% endif %}
                                {% if properties.size || properties.square %}
                                  <div class="cell">
                                    <p class="cell__title">Площадь</p>
                                    <p class="cell__val">{{properties.size}} {{properties.square}} м²</p>
                                  </div>  
                                {% endif %}               
                                {% if properties.rooms %}                    
                                  <div class="cell">
                                    <p class="cell__title">Комнат</p>
                                    <p class="cell__val">{{properties.rooms}}</p>
                                  </div>
                                {% endif %}        
                                </div>
                              </div>
                            </a>
                           </div>`;

export const CR_ICON_LT = `<div class = "cluster__icon">от {{properties.minCost}} &#8381;</div>`
export const CR_BALOON_LT = `<div class = "cluster__baloon">
                               ${PM_BALOON_LT}
                           </div>`;