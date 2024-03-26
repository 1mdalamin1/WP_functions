
    $(".Click-here").on('click', function() {
        $(".popup-model-main").addClass('model-open');
      }); 
      $(".close-btn, .bg-overlay").click(function(){
        $(".popup-model-main").removeClass('model-open');
      });
  
      const heating = `
      <div class="input-fild">
          <label class="flabel">Choose Heater <span class="field_required">*</span></label>
  
          <select name="input_3" onchange="show3rdTdElm(this)">
              <option value="" selected="selected" class="placeholder">Choose One</option>
              <option value="3 Star Heater">3 Star Heater</option>
              <option value="4 Star Heater">4 Star Heater</option>
              <option value="5 Star Heater">5 Star Heater</option>
              <option value="6 Star Heater">6 Star Heater</option>
          </select>
      </div>
      `;
  
      const cooling = `
      <div class="input-fild">
          <label class="flabel">Choose Class<span class="field_required">*</span></label>
  
          <select name="input_2" onchange="show3rdTdElm(this)">
              <option value="" selected="selected" class="placeholder">Choose One</option>
              <option value="Standard">Standard (CA)</option>
              <option value="Premium">Premium (CX)</option>
          </select>
      </div>
      `;
  
      const modelStandard = `
      <div class="input-fild model coolingModel">
          <label class="flabel">Model, Color & Qty<span class="field_required">*</span></label>
  
          <div class="modelCooling">
              <select name="cooling_model" class="standardPremium">
                  <option value="" selected="selected" class="placeholder">Choose Model</option>
                  <option value="CA08 – Small">CA08 – Small</option>
                  <option value="CA10 – Medium">CA10 – Medium</option>
                  <option value="CA14 – X-Large">CA14 – X-Large</option>
              </select>
              <select name="cooling_color" class="color">
                  <option value="" selected="selected" class="placeholder">Choose Color</option>
                  <option value="Grey">Grey</option>
                  <option value="Terracotta">Terracotta</option>
                  <option value="Beige">Beige</option>
              </select>
              <label class="flabel">
                  <input name="cooling_qty" type="text" value="" placeholder="Qty" class="qty data-input-element">
              </label>
          </div>
  
      </div>`;
  
      const modelPremium = `
      <div class="input-fild model coolingModel">
          <label class="flabel">Model, Color & Qty<span class="field_required">*</span></label>
  
          <div class="modelCooling">
              <select name="cooling_model" class="standardPremium">
                  <option value="" selected="selected" class="placeholder">Choose Model</option>
                  <option value="CX12 – Premium Large">CX12 – Premium Large</option>
                  <option value="CX14 – Premium X-Large">CX14 – Premium X-Large</option>
              </select>
              <select name="cooling_color" class="color">
                  <option value="" selected="selected" class="placeholder">Choose Color</option>
                  <option value="Grey">Grey</option>
                  <option value="Terracotta">Terracotta</option>
                  <option value="Beige">Beige</option>
              </select>
              <label class="flabel">
                  <input name="cooling_qty" type="text" value="" placeholder="Qty" class="qty data-input-element">
              </label>
          </div>
  
      </div> `;
  
      const model3 = `
      <div class="input-fild model">
          <label class="flabel">Model<span
                  class="field_required">*</span></label>
  
          <div class="inactive">
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="1" type="checkbox" value="C314-272030" name="m_7" class="data-input-element">
                  C314</label>
                  <label class="flabel">
                      <input data-id="1" name="mq_7" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="2" type="checkbox" value="C318-272047" name="m_8" class="data-input-element">
                  C318</label>
                  <label class="flabel">
                      <input data-id="2" name="mq_8" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="3" type="checkbox" value="323-272054" name="m_9" class="data-input-element">
                  C323</label>
                  <label class="flabel">
                      <input data-id="3" name="mq_9" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="4" type="checkbox" value="C328-272061" name="m_10" class="data-input-element">
                  C328</label>
                  <label class="flabel">
                      <input data-id="5" name="mq_10" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="5" type="checkbox" value="CD318-272078" name="m_11" class="data-input-element">
                  CD318</label>
                  <label class="flabel">
                      <input data-id="5" name="mq_11" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="6" type="checkbox" value="CD328-272085" name="m_12" class="data-input-element">
                  CD328</label>
                  <label class="flabel">
                      <input data-id="6" name="mq_12" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
          </div>
  
      </div>`;
  
      const model4 = ` 
      <div class="input-fild model">
          <label class="flabel">Model<span
                  class="field_required">*</span></label>
  
          <div class="inactive">
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="7" type="checkbox" value="C414 – 272092" name="m_13" class="data-input-element">
                      C414</label>
                  <label class="flabel">
                      <input data-id="7" name="mq_13" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="8" type="checkbox" value="C418 – 272108" name="m_14" class="data-input-element">
                      C418</label>
                  <label class="flabel">
                      <input data-id="8" name="mq_14" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="9" type="checkbox" value="C423 – 272115" name="m_15" class="data-input-element">
                      C423</label>
                  <label class="flabel">
                      <input data-id="9" name="mq_15" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="10" type="checkbox" value="C428- 272122" name="m_16" class="data-input-element">
                      C428</label>
                  <label class="flabel">
                      <input data-id="10" name="mq_16" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              
          </div>
  
      </div>`;
  
      const model5 = `
      <div class="input-fild model">
          <label class="flabel">Model<span
                  class="field_required">*</span></label>
  
          <div class="inactive">
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="11" type="checkbox" value="C516 – 272139" name="m_17" class="data-input-element">
                      C516</label>
                  <label class="flabel">
                      <input data-id="11" name="mq_17" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="12" type="checkbox" value="C520 – 272146" name="m_18" class="data-input-element">
                      C520</label>
                  <label class="flabel">
                      <input data-id="12" name="mq_18" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="13" type="checkbox" value="C528 – 272153" name="m_19" class="data-input-element">
                      C528</label>
                  <label class="flabel">
                      <input data-id="13" name="mq_19" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="14" type="checkbox" value="CX528 – 272160" name="m_20" class="data-input-element">
                      CX528</label>
                  <label class="flabel">
                      <input data-id="14" name="mq_20" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              
          </div>
  
      </div>`;
  
      const model6 = `
      <div class="input-fild model">
          <label class="flabel">Model<span
                  class="field_required">*</span></label>
  
          <div class="inactive">
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="15" type="checkbox" value="C618 – 272177" name="m_21" class="data-input-element">
                      C618</label>
                  <label class="flabel">
                      <input data-id="15" name="mq_21" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="16" type="checkbox" value="C623 – 272184" name="m_22" class="data-input-element">
                      C623</label>
                  <label class="flabel">
                      <input data-id="16" name="mq_22" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="17" type="checkbox" value="C631 – 272191" name="m_23" class="data-input-element">
                      C631</label>
                  <label class="flabel">
                      <input data-id="17" name="mq_23" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              <div class="c-option">
                  <label class="clabel">
                  <input data-id="18" type="checkbox" value="CX631 – 272207" name="m_24" class="data-input-element">
                      CX631</label>
                  <label class="flabel">
                      <input data-id="18" name="mq_24" type="text" value="" placeholder="Qty" class="qty data-input-element">
                  </label>
              </div>
              
          </div>
  
      </div>`;
  
      const coolingAccessories = ` 
      <div class="input-fild accessories coolingAccessories">
          <label class="flabel">Evaporative Cooler Accessories</label>
  
          <div class="c-option">
              <label class="clabel">
                  <input data-id="18" type="checkbox" value="Auto Drain Kit (not required for CX) – 098470" name="a_1" class="data-input-element">
              Auto Drain Kit (not required for CX)</label>
              <label class="flabel"><input data-id="18" placeholder="Qty" class="data-input-element qty" name="aq_1" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="19" type="checkbox" value="Bushfire Protection Kit Medium – 114392" name="a_2" class="data-input-element">
              Bushfire Protection Kit Medium</label>
              <label class="flabel"><input data-id="19" placeholder="Qty" class="data-input-element qty" name="aq_2" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="20" type="checkbox" value="Bushfire Protection Kit Large – 114408" name="a_3" class="data-input-element">
              Bushfire Protection Kit Large</label>
              <label class="flabel"><input data-id="20" placeholder="Qty" class="data-input-element qty" name="aq_3" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="21" type="checkbox" value="Convair Standard Digital Control - 118499FG" name="a_4" class="data-input-element">
              Convair Standard Digital Control</label>
              <label class="flabel"><input data-id="21" placeholder="Qty" class="data-input-element qty" name="aq_4" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="22" type="checkbox" value="Convair Smart Thermostat - 094267" name="a_5" class="data-input-element">
              Convair Smart Thermostat</label>
              <label class="flabel"><input data-id="22" placeholder="Qty" class="data-input-element qty" name="aq_5" type="text" value=""></label>
          </div>
  
      </div>`;
  
      const heatingAcc3 = `
      <div class="input-fild accessories">
          <label class="flabel">Select Accessory (Flashing Kit, Zone Board)</label>
  
          <div class="c-option">
              <label class="clabel">
              <input data-id="23" type="checkbox" value="Kit Flashing Sml (Rebuff) – 680026" name="a_6" class="data-input-element">
              Kit Flashing Sml (Rebuff)</label>
              <label class="flabel"><input data-id="23" placeholder="Qty" class="data-input-element qty" name="aq_6" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="24" type="checkbox" value="Kit Flashing Lrg (Rebuff) – 680033" name="a_7" class="data-input-element">
              Kit Flashing Lrg (Rebuff)</label>
              <label class="flabel"><input data-id="24" placeholder="Qty" class="data-input-element qty" name="aq_7" type="text" value=""></label>
          </div>
  
      </div>`;
  
      const heatingAcc45 = `
      <div class="input-fild accessories">
          <label class="flabel">Select Accessory (Flashing Kit, Zone Board)</label>
  
          <div class="c-option">
              <label class="clabel">
              <input data-id="25" type="checkbox" value="Kit Flashing 150mm (14-23Kw) – 076331" name="a_8" class="data-input-element">
              Kit Flashing 150mm (14-23Kw)</label>
              <label class="flabel"><input data-id="25" placeholder="Qty" class="data-input-element qty" name="aq_8" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="26" type="checkbox" value="Kit Flashing 300mm (15-25Kw) – 076348" name="a_9" class="data-input-element">
              Kit Flashing 300mm (15-25Kw)</label>
              <label class="flabel"><input data-id="26" placeholder="Qty" class="data-input-element qty" name="aq_9" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="27" type="checkbox" value="Kit Flashing 150mm (30-35Kw) – 076362" name="a_10" class="data-input-element">
              Kit Flashing 150mm (30-35Kw)</label>
              <label class="flabel"><input data-id="27" placeholder="Qty" class="data-input-element qty" name="aq_10" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="28" type="checkbox" value="Kit Flashing 300mm (30-35Kw) – 076386" name="a_11" class="data-input-element">
              Kit Flashing 300mm (30-35Kw)</label>
              <label class="flabel"><input data-id="28" placeholder="Qty" class="data-input-element qty" name="aq_11" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="29" type="checkbox" value="Kit Flashing Sml (Rebuff) – 680026" name="a_12" class="data-input-element">
              Kit Flashing Sml (Rebuff)</label>
              <label class="flabel"><input data-id="29" placeholder="Qty" class="data-input-element qty" name="aq_12" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="30" type="checkbox" value="Kit Flashing Lrg (Rebuff) – 680033" name="a_13" class="data-input-element">
              Kit Flashing Lrg (Rebuff)</label>
              <label class="flabel"><input data-id="30" placeholder="Qty" class="data-input-element qty" name="aq_13" type="text" value=""></label>
          </div>
  
      </div>`;
  
      const heatingAcc6 = `
      <div class="input-fild accessories">
          <label class="flabel">Select Accessory (Flashing Kit, Zone Board)</label>
  
          <div class="c-option">
              <label class="clabel">
              <input data-id="31" type="checkbox" value="Kit Flashing 150mm (16-23Kw) – 075990" name="a_14" class="data-input-element">
              Kit Flashing 150mm (16-23Kw)</label>
              <label class="flabel"><input data-id="31" placeholder="Qty" class="data-input-element qty" name="aq_14" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="32" type="checkbox" value="Kit Flashing 150mm (32Kw) – 077260" name="a_15" class="data-input-element">
              Kit Flashing 150mm (32Kw)</label>
              <label class="flabel"><input data-id="32" placeholder="Qty" class="data-input-element qty" name="aq_15" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="33" type="checkbox" value="Kit Flashing 300mm (16-23Kw) – 076034" name="a_16" class="data-input-element">
              Kit Flashing 300mm (16-23Kw)</label>
              <label class="flabel"><input data-id="33" placeholder="Qty" class="data-input-element qty" name="aq_16" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
              <input data-id="34" type="checkbox" value="Kit Flashing 300mm (32Kw) – 077277" name="a_17" class="data-input-element">
              Kit Flashing 300mm (32Kw)</label>
              <label class="flabel"><input data-id="34" placeholder="Qty" class="data-input-element qty" name="aq_17" type="text" value=""></label>
          </div>
  
      </div>`;
  
      const heatingThermostat = `
      <div class="input-fild thermostat">
          <label class="flabel" >Select Thermostat</label>
  
          <div class="c-option">
              <label class="clabel">
              <input data-id="35" type="checkbox" value="Manual T/Stat – 639666" name="t_1" class="data-input-element">
              Manual T/Stat</label>
              <label class="flabel"><input data-id="35" placeholder="Qty" class="data-input-element qty" name="tq_1" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
                  <input data-id="36" type="checkbox" value="Smart Thermostat – 094267" name="t_2" class="data-input-element">
                  Smart Thermostat
              </label>
              <label class="clabel"><input data-id="36" placeholder="Qty" class="data-input-element qty" name="tq_2" type="text" value=""></label>
          </div>
  
      </div>`;
  
      const flueKit3 = `
      <div class="input-fild flue-kit">
          <label class="flabel" >Flue Kit (determine internal/External Heater)</label>
  
          <div class="c-option">
              <label class="clabel">
              <input data-id="37" type="checkbox" value="External kit inc Man T/Stat – 078083" name="f_1" class="data-input-element">
              External kit inc Man T/Stat</label>
              <label class="flabel"><input data-id="37" placeholder="Qty" class="data-input-element qty" name="fq_1" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
                  <input data-id="38" type="checkbox" value="Internal kit inc Man T/Stat – 078076" name="f_2" class="data-input-element">
                  Internal kit inc Man T/Stat
              </label>
              <label class="clabel"><input data-id="38" placeholder="Qty" class="data-input-element qty" name="fq_2" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
                  <input data-id="39" type="checkbox" value="U/Floor kit inc Man T/Stat – 078090" name="f_3" class="data-input-element">
                  U/Floor kit inc Man T/Stat
              </label>
              <label class="clabel"><input data-id="39" placeholder="Qty" class="data-input-element qty" name="fq_3" type="text" value=""></label>
          </div>
  
      </div>`;
  
      const flueKit4 = `
      <div class="input-fild flue-kit">
          <label class="flabel" >Flue Kit (determine internal/External Heater)</label>
  
          <div class="c-option">
              <label class="clabel">
              <input data-id="40" type="checkbox" value="External kit for 3,4 star – 075365" name="f_4" class="data-input-element">
              External kit for 3,4 star</label>
              <label class="clabel"><input data-id="40" placeholder="Qty" class="data-input-element qty" name="fq_4" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
                  <input data-id="41" type="checkbox" value="Internal kit for 3,4, 5 star – 075297" name="f_5" class="data-input-element">
                  Internal kit for 3,4, 5 star
              </label>
              <label class="clabel"><input data-id="41" placeholder="Qty" class="data-input-element qty" name="fq_5" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
                  <input data-id="42" type="checkbox" value="U/Floor Kit for 3,4 Star – 075334" name="f_6" class="data-input-element">
                  U/Floor Kit for 3,4 Star
              </label>
              <label class="clabel"><input data-id="42" placeholder="Qty" class="data-input-element qty" name="fq_6" type="text" value=""></label>
          </div>
  
      </div>`;
  
      const flueKit5 = `
      <div class="input-fild flue-kit">
          <label class="flabel" >Flue Kit (determine internal/External Heater)</label>
  
          <div class="c-option">
              <label class="clabel">
              <input data-id="43" type="checkbox" value="External or U/Floor kit for 5 star – 075389" name="f_7" class="data-input-element">
              External or U/Floor kit for 5 star</label>
              <label class="clabel"><input data-id="43" placeholder="Qty" class="data-input-element qty" name="fq_7" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
                  <input data-id="44" type="checkbox" value="Internal kit for 3,4, 5 star – 075297" name="f_8" class="data-input-element">
                  Internal kit for 3,4, 5 star
              </label>
              <label class="clabel"><input data-id="44" placeholder="Qty" class="data-input-element qty" name="fq_8" type="text" value=""></label>
          </div>
  
      </div>`;
  
      const flueKit6 = `
      <div class="input-fild flue-kit">
          <label class="flabel" >Flue Kit (determine internal/External Heater)</label>
  
          <div class="c-option">
              <label class="clabel">
              <input data-id="45" type="checkbox" value="External Kit for 6 star – 075396" name="f_9" class="data-input-element">
              External Kit for 6 star</label>
              <label class="clabel"><input data-id="45" placeholder="Qty" class="data-input-element qty" name="fq_9" type="text" value=""></label>
          </div>
          <div class="c-option">
              <label class="clabel">
                  <input data-id="46" type="checkbox" value="Internal kit or U/Floor for 6 star – 075358" name="f_10" class="data-input-element">
                  Internal kit or U/Floor for 6 star
              </label>
              <label class="clabel"><input data-id="46" placeholder="Qty" class="data-input-element qty" name="fq_"10 type="text" value=""></label>
          </div>
  
      </div>`;
  
      function cloneTr() {
          let tr = jQuery("#first_tr").clone();
          jQuery(tr).find("select").val("");
          jQuery(tr).find("input").val("");
          jQuery(tr).find('div.2ndtd').html("");
          jQuery(tr).find('div.3rdtd').html("");
          jQuery(tr).attr("id", "");
          jQuery("#tr_container").append(tr);
      }
  
      function removeTr(data) {
          let tr = jQuery(data).parent().parent().parent().parent();
          let id = jQuery(tr).attr("id");
          if (id != 'first_tr') jQuery(tr).remove();
      }
  
      // jQuery(document).ready(function () {
  
      //     $("#input_2").change(function () {
      //         let input_2 = this.value;
      //         // alert(status);
      //         if (input_2 == "Standard") {
      //             jQuery(".inactive.active").removeClass("active");
      //             jQuery("#modelStandard").addClass("active");
      //         }
      //         if (input_2 == "Premium") {
      //             jQuery(".inactive.active").removeClass("active");
      //             jQuery("#modelPremium").addClass("active");
      //         }
      //     });
  
  
      // });