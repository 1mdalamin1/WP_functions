    
function show2ndTdElm(data) {
    let value = jQuery(data).val();
    let tr = jQuery(data).parent().parent().parent().parent();
    if (value == 'Heating') {
        jQuery(tr).find('div.2ndtd').html(heating);
        jQuery(tr).find('div.3rdtd').html("");
    } else if (value == 'Cooling') {
        jQuery(tr).find('div.2ndtd').html(cooling);
        jQuery(tr).find('div.3rdtd').html("");
    } else {
        jQuery(tr).find('div.2ndtd').html("");
        jQuery(tr).find('div.3rdtd').html("");
    }
}

function show3rdTdElm(data) {
    let value = jQuery(data).val();
    let tr = jQuery(data).parent().parent().parent().parent();
    if (value == 'Standard') {
        jQuery(tr).find('div.3rdtd').html(modelStandard + coolingAccessories);
    } else if (value == 'Premium') {
        jQuery(tr).find('div.3rdtd').html(modelPremium + coolingAccessories);
    } else if (value == '3 Star Heater') {
        jQuery(tr).find('div.3rdtd').html(model3 + flueKit3 + heatingThermostat + heatingAcc3);
    } else if (value == '4 Star Heater') {
        jQuery(tr).find('div.3rdtd').html(model4 + flueKit4 + heatingThermostat + heatingAcc45);
    } else if (value == '5 Star Heater') {
        jQuery(tr).find('div.3rdtd').html(model5 + flueKit5 + heatingThermostat + heatingAcc45);
    } else if (value == '6 Star Heater') {
        jQuery(tr).find('div.3rdtd').html(model6 + flueKit6 + heatingThermostat + heatingAcc6);
    } else {
        jQuery(tr).find('div.3rdtd').html("");
    }
}

async function from_submit() {
    let returnValue= await form_validation();// 2 sec
    console.log(returnValue);
    let error = returnValue[0];
    if(!error){
        let data = returnValue[1];
        process_form_data(data);
    }
}

async function form_validation(){
    jQuery("#message_area").html("");

    let rows = jQuery("#tr_container tr.table-row");

    let data = {'action':'form_process','rows':{}};
    let error = false;
    jQuery(rows).each(function (index, row) {

        let rowData = {};

        let prouct_type = jQuery(row).find("select[name='prouct_type']").val();
        if (!prouct_type) {
            jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Product type must need to select.</p>`);
            jQuery(row).find("select[name='prouct_type']").addClass("warning");
            error=true;
            return [error,false];
        }

        rowData.type=prouct_type;

        // check heating or cooling
        if (prouct_type == 'Heating') {

            let star = jQuery(row).find("select[name='input_3']").val();
            if (!star) {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Heater must need to select.</p>`);
                jQuery(row).find("select[name='prouct_type']").removeClass("warning");
                jQuery(row).find("select[name='input_3']").addClass("warning");
                error=true;
                return [error,false];
            } else {
                jQuery(row).find("select[name='prouct_type']").removeClass("warning");
                jQuery(row).find("select[name='input_3']").removeClass("warning");
            }

            rowData.heater = star;

            // model
            let modelLength = jQuery(row).find(".model").find("input[type=checkbox]:checked").length;
            if (modelLength < 1) {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Model must need to select.</p>`);
                jQuery(row).find("select[name='input_3']").removeClass("warning");
                jQuery(row).find(".model").find(".clabel").addClass("error");
                error=true;
            return [error,false];
            } else {
                jQuery(row).find(".model").find(".clabel").removeClass("error");
            }

            // model qty 
            let models = jQuery(row).find(".model").find("input[type=checkbox]:checked");
            rowData.models = {};
            jQuery(models).each(function (i, model) {
                let qty = jQuery(model).parent().parent().find("input.qty").val().trim();
                if (qty) {
                    qty = parseInt(qty);
                    if (qty < 1) {
                        jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Model's quantity required.</p>`);
                        jQuery(row).find(".model").find(".clabel").removeClass("error");
                        jQuery(model).parent().parent().find("input.qty").addClass("warning");
                        error=true;
            return [error,false];
                    } else {
                        jQuery(row).find(".model").find(".clabel").removeClass("error");
                        jQuery(model).parent().parent().find("input.qty").removeClass("warning");

                        let rowModelData = {model:jQuery(model).val(),qty:qty};
                        //rowData.models.push(rowModelData);
                        rowData.models[i]=rowModelData;
                    }
                } else {
                    jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Model's quantity required.</p>`);
                    jQuery(row).find(".model").find(".clabel").removeClass("error");
                    jQuery(model).parent().parent().find("input.qty").addClass("warning");
                    error=true;
            return [error,false];
                }
            }); // model qty end

            // fule kit
            let fuleKitLength = jQuery(row).find(".flue-kit").find("input[type=checkbox]:checked").length;
            if (fuleKitLength > 0) {
                let fuleKits = jQuery(row).find(".flue-kit").find("input[type=checkbox]:checked");
                rowData.fule_kits = {};
                jQuery(fuleKits).each(function (i, kit) {
                    let qty = jQuery(kit).parent().parent().find("input.qty").val().trim();
                    if (qty) {
                        qty = parseInt(qty);
                        if (qty < 1) {
                            jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Fule kit quantity required.</p>`);
                            jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").addClass("warning");
                            error=true;
                            return [error,false];
                        } else {
                            jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").removeClass("warning");

                            let rowFuleData = {kit:jQuery(kit).val(),qty:qty};
                            rowData.fule_kits[i]=rowFuleData;
                        }
                    } else {
                        jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Fule kit quantity required.</p>`);
                        jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                        jQuery(kit).parent().parent().find("input.qty").addClass("warning");
                        error=true;
                        return [error,false];
                    }
                });
            } // fule kit end

            // Thermostat
            let thermostatLength = jQuery(row).find(".thermostat").find("input[type=checkbox]:checked").length;
            if (thermostatLength > 0) {
                let thermostats = jQuery(row).find(".thermostat").find("input[type=checkbox]:checked");
                rowData.thermostats = {};
                jQuery(thermostats).each(function (i, kit) {
                    let qty = jQuery(kit).parent().parent().find("input.qty").val().trim();
                    if (qty) {
                        qty = parseInt(qty);
                        if (qty < 1) {
                            jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Thermostat Qty required.</p>`);
                            jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").addClass("warning");
                            error=true;
            return [error,false];
                        } else {
                            jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").removeClass("warning");

                            let rowThermData = {thermostat:jQuery(kit).val(),qty:qty};
                            rowData.thermostats[i]=rowThermData;
                            //rowData.thermostats.push(rowThermData);
                        }
                    } else {
                        jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Thermostat Qty required.</p>`);
                        jQuery(row).find(".flue-kit").find(".clabel").removeClass("error");
                        jQuery(kit).parent().parent().find("input.qty").addClass("warning");

                        error=true;
                        return [error,false];
                    }
                });
            } // Thermostat end


            // Heater accessories
            let accessoriesLength = jQuery(row).find(".accessories").find("input[type=checkbox]:checked").length;
            if (accessoriesLength > 0) {
                let accessoriess = jQuery(row).find(".accessories").find("input[type=checkbox]:checked");
                rowData.heater_accessories = {};
                jQuery(accessoriess).each(function (i, kit) {
                    let qty = jQuery(kit).parent().parent().find("input.qty").val().trim();
                    if (qty) {
                        qty = parseInt(qty);
                        if (qty < 1) {
                            jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Heater Accessories Qty required.</p>`);
                            jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").addClass("warning");
                            error=true;
                            return [error,false];
                        } else {
                            jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                            jQuery(kit).parent().parent().find("input.qty").removeClass("warning");

                            let rowFuleData = {accessories:jQuery(kit).val(),qty:qty};
                            rowData.heater_accessories[i]=rowFuleData;
                        }
                    } else {
                        jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Heater Accessories Qty required.</p>`);
                        jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                        jQuery(kit).parent().parent().find("input.qty").addClass("warning");
                        error=true;
                        return [error,false];
                    }
                });
            } // Heater accessories end

        } // end heating

        if (prouct_type == 'Cooling') {
            let standardPremium = jQuery(row).find("select[name='input_2']").val();
            if (!standardPremium) {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Cooling must need to select.</p>`);
                jQuery(row).find("select[name='prouct_type']").removeClass("warning");
                jQuery(row).find("select[name='input_2']").addClass("warning");
                
                error=true;
                return [error,false];
            } else {
                jQuery(row).find("select[name='prouct_type']").removeClass("warning");
                jQuery(row).find("select[name='input_2']").removeClass("warning");
            }

            // rowData['class'] = standardPremium;
            rowData.class = standardPremium;

            // Model, Color & Qty
            let modelSelect = jQuery(row).find(".modelCooling").find("select.standardPremium").val();
            if (!modelSelect) {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Model must need to select.</p>`);
                jQuery(row).find("select[name='input_2']").removeClass("warning");
                jQuery(row).find(".modelCooling").find("select.standardPremium").addClass("warning");
                
                error=true;
                return [error,false];
            } else {
                jQuery(row).find(".modelCooling").find("select.standardPremium").removeClass("warning");
            }
            // rowData['model'] = modelSelect;
            rowData.model = modelSelect;

            let modelColor = jQuery(row).find(".modelCooling").find("select.color").val();
            if (!modelColor) {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Model Color need to select.</p>`);
                jQuery(row).find(".modelCooling").find("select.standardPremium").removeClass("warning");
                jQuery(row).find(".modelCooling").find("select.color").addClass("warning");
                
                error=true;
                return [error,false];
            } else {
                jQuery(row).find(".modelCooling").find("select.color").removeClass("warning");
            }
            // rowData['color'] = modelColor;
            rowData.color = modelColor;

            let modelQty = jQuery(row).find(".modelCooling").find("input[type='text']").val().trim();

            if (modelQty) {
                let mSQty = parseInt(modelQty);
                if (mSQty < 1) {
                    jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Please add Qty.</p>`);
                    jQuery(row).find(".modelCooling").find("select.color").removeClass("warning");
                    jQuery(row).find(".modelCooling").find("input.qty").addClass("warning");
                        
                    error=true;
                    return [error,false];
                } else {
                    jQuery(row).find(".modelCooling").find("select.color").removeClass("warning");
                    jQuery(row).find(".modelCooling").find("input.qty").removeClass("warning");
                }
                // rowData['qty'] = mSQty;
                rowData.qty = mSQty;
            } else {
                jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Please add Qty.</p>`);
                jQuery(row).find(".modelCooling").find("select.color").removeClass("warning");
                jQuery(row).find(".modelCooling").find("input.qty").addClass("warning");
                
                error=true;
                return [error,false];
            }

            // Model, Color & Qty end


            // Cooler accessories
            let accessoriesLength = jQuery(row).find(".accessories").find("input[type=checkbox]:checked").length;
            if (accessoriesLength > 0) {
                let accessoriess = jQuery(row).find(".accessories").find("input[type=checkbox]:checked");
                rowData.cooler_accessories = {};
                
                jQuery(accessoriess).each(function (i, coolerAcc) {
                    let qty = jQuery(coolerAcc).parent().parent().find("input.qty").val().trim();
                    if (qty) {
                        qty = parseInt(qty);
                        if (qty < 1) {
                            jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Cooler Accessories Qty required.</p>`);
                            jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                            jQuery(coolerAcc).parent().parent().find("input.qty").addClass("warning");
                            error=true;
                            return [error,false];
                        } else {
                            jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                            jQuery(coolerAcc).parent().parent().find("input.qty").removeClass("warning");

                            let rowAccData = {accessories:jQuery(coolerAcc).val(),qty:qty};
                            rowData.cooler_accessories[i]=rowAccData;
                        }
                    } else {
                        jQuery("#message_area").html(`<p>There is an error in row <strong>${index+1}</strong>, Cooler Accessories Qty required.</p>`);
                        jQuery(row).find(".accessories").find(".clabel").removeClass("error");
                        jQuery(coolerAcc).parent().parent().find("input.qty").addClass("warning");
                        error=true;
                        return [error,false];
                    }
                });
            } // Cooler accessories end



        } // end cooling

        data.rows[index]=rowData;
    });
    
    // Delivery Or Pick up 
    let tfoot = jQuery("tfoot .pickup-delivery");
    let delivery = jQuery(tfoot).find("input[type=radio]:checked").length;
    // console.log(delivery);
    if (!delivery) {
        jQuery("#message_area").html(`<p>Product received way... need to select.</p>`);
        jQuery(tfoot).find(".flabel").addClass("error");
        error=true;
        return [error,false];
    } else {
        jQuery(tfoot).find(".flabel").removeClass("error");

        data.delivery=delivery;
    }
    // End Form validation

   return [error,data];
}


function process_form_data(data){
    
    jQuery("#message_area").html(`<p class="info">Please wait! we are processing...</p>`);
    jQuery.post( "<?php admin_url( 'admin-ajax.php' ) ?>",data,function(result){
       if(result == 'ok') {
        window.location.href='https://www.convair.net.au/userprofile/';
       }else {
        jQuery("#message_area").html(result);
       }
    });
}


function details(id) {
    $.ajax({
            type : "POST",
            url : "<?php echo admin_url('admin-ajax.php'); ?>",
            data : {action: "get_data", id: id},
            success: function(response) {
                jQuery("#order_details").html(response);
            }
        });
}