function RCADynamicForm(formDetails){
            var $targetCont=formDetails.$targetCont;
            var $formCont=$('<form/>').addClass('rca-df-form');
            var formData=formDetails.formData;
            var formJSON=formDetails.formJSON;
            var startSecIdx = formDetails.startSecIdx||0;
            var ajaxFunction = formDetails.ajaxFunction;
            var colClass= {1:'col-md-12',2:'col-md-6',3:'col-md-4'}[formDetails.columns]||'col-md-12';
            var defaultFieldSize=formDetails.defaultFieldSize||4;
            $targetCont.append($formCont);
            renderSection(startSecIdx);
            
            function renderSection(secIdx) {
                var $sectionCont=$('<div/>').addClass('rca-df-section');
                $formCont.append($sectionCont);
                var section = formJSON.sections[secIdx], 
                    formFields=section.formFields,
                    buttons=section.buttons;
                $sectionCont.data('section-idx',secIdx);
                formFields.forEach(function(field){
                    renderField($sectionCont,field);
                });
                buttons.forEach(function(button){
                    renderButton($sectionCont,button);
                });
            }

            function renderField($sectionCont,field) {
                var $row=$sectionCont.find('.rca-df-question-row').last();
                if ($row.length==0) {
                    $row=$('<div/>').addClass('row rca-df-question-row');
                    $sectionCont.append($row);
                }
                var $field=$('<div/>').addClass(colClass).addClass('form-group rca-df-question-col');
                $field.attr('data-field-name',field.ansFieldName).data('field',field);
                $row.append($field);
                
                if (!checkVisibility(field)) $field.addClass('rca-df-not-visible');

                renderQuestionText($field,field);
                renderQuestionHelpText($field,field);
                renderAnswer($field,field);
                renderFeedback($field,field);
            }
            function renderButton($sectionCont,button){
                var $row=$sectionCont.find('.rca-df-buttons-row').last(), $col=$row.find('.rca-df-buttons-col');
                if ($row.length==0) {
                    $row=$('<div/>').addClass('row rca-df-buttons-row');
                    $sectionCont.append($row);
                    $col=$('<div/>').addClass('col-md-12 rca-df-buttons-col');
                    $row.append($col);
                }
                var $button=$('<button/>').addClass('btn btn-primary').addClass('rca-df-btn');
                $button.attr('data-button-code',button.code).data('button',button).html(button.label);
                $col.append($button);
            }
            function checkVisibility(field) {
                if (!field.enablingFields) return true;
                var parentValues=[];
                field.enablingFields.forEach(function(p){
                    parentValues.push(formData[p]||'~');
                });
                return (field.enablingValues && field.enablingValues.indexOf(parentValues.join('#'))>=0);
            }
            function renderQuestionText($field,field) {
                var $qText=$('<p/>').addClass('rca-df-qtext').text(field.qText);
                $field.append($qText);
            }
            function renderQuestionHelpText($field,field) {
                var $qHelpText=$('<p/>').addClass('rca-df-qhelp-text').text(field.qHelpText);
                $field.append($qHelpText);
            }
            function renderAnswer($field,field) {
                var $ansRow=$('<div/>').addClass('row rca-df-ans-row');
                $field.append($ansRow);
                var fieldColClass='col-md-'+(field.fieldSize||defaultFieldSize);
                var $ansCol=$('<div/>').addClass(fieldColClass).addClass('rca-df-ans-col');
                $ansRow.append($ansCol);
                $ansCol.data('field-name',field.ansFieldName);
                if (field.ansFieldType=='text'||field.ansFieldType=='date') renderInput($ansCol,field);
                if (field.ansFieldType=='dropdown'||field.ansFieldType=='dropdown-multi'||field.ansFieldType=='list'||field.ansFieldType=='long-list') renderDropdown($ansCol,field);
                if (field.ansFieldType=='radio') renderRadio($ansCol,field);
            }
            function renderInput($ansCol,field) {
                var $element=$('<input/>').addClass('form-control rca-df-text-input').attr('name',field.ansFieldName);
                $ansCol.append($element);
                $element.val(getFieldValue($element));
                if (field.ansFieldType=='date') $element.daterangepicker({    
                    singleDatePicker: true,
                    showDropdowns: true
                });
                $element.change(textInputChange);
            }
            function renderRadio($ansCol,field) {
                field.ansFieldValues.forEach(function(value,index){
                    renderRadioButton($ansCol,field,value,index);
                });
            }
            function renderRadioButton($ansCol,field,value,index) {
                var $fc=$('<div/>').addClass('form-check rca-df-radio-btn');
                $ansCol.append($fc);
                var $element=$('<input/>').attr('type','radio').addClass('form-check-input rca-df-radio-input').attr('name',field.ansFieldName).attr('value',value.code).attr('id',field.ansFieldName+'-'+index);
                var $label=$('<label/>').addClass('form-check-label rca-df-radio-label').attr('for',field.ansFieldName+'-'+index).html(value.name);
                $fc.append($element).append($label);
                $element.change(textInputChange);
            }
            function renderDropdown($ansCol,field) {
                var $element=$('<select/>').addClass('form-control rca-df-select').attr('name',field.ansFieldName);
                if(field.ansFieldType=='dropdown-multi') $element.attr('multiple','');
                $ansCol.append($element);
                
                $element.change(selectChange);
                renderDropdownOptions($element,field);
                $element.val(getFieldValue($element));
            }
            function renderDropdownOptions($element,field) {
                field.nature = field.nature || 'independent';
                var values=[];
                if (field.ansFieldType=='dropdown'||field.ansFieldType=='dropdown-multi') {
                    if(field.ansFieldValues && field.nature == 'independent') values=field.ansFieldValues;
                    if(field.ansFieldValues && field.nature == 'multi-dependent')  values=getDependentValues(field);
                    renderOptions($element,values);
                }
                if (field.ansFieldType=='list'||field.ansFieldType=='long-list') {
                    ajaxFunction(
                        {method:field.ansFieldValuesFunction},
                        function(response){
                            //console.log(response);return false;
                            renderOptions($element,response.data.optionValues);
                            if (field.ansFieldType=='long-list') $element.chosen({width: "100%"});
                        }
                    );
                }
            }
            function renderOptions($element,values){
                $element.append('<option value="">Select</option>');
                values.forEach(function(opt){
                    if (Array.isArray(opt)) opt={code:opt[0],name:opt[1]};
                    $element.append('<option value="'+opt.code+'">'+opt.name+'</option>');
                });
            }
            function getDependentValues(field) {
                var parentValues=[];
                field.parents.forEach(function(p){
                    parentValues.push(formData[p]||'~');
                });
                return field.ansFieldValues[parentValues.join('#')]||[]; 
            }
            function renderFeedback($field,field) {
                if (typeof field.feedbackText==='undefined') return;
                var $feedbackText=$('<p/>').addClass('rca-df-qhelp-text').text(field.feedbackText);
                $field.append($feedbackText);
            }
            function textInputChange(){
                var $t=$(this);
                setFieldValue($t);
                resetDependents($t);
                performApplyCalc($t);
            }
            function performApplyCalc($t) {
                var $t=$t.closest('.rca-df-question-col'), field=$t.data('field');
                if (!field.applyCalcAjax) return;
                var fd={
                    method:field.applyCalcAjax
                };
                fd[field.ansFieldName]=getFieldValue($t);
                ajaxFunction(fd,function(response){
                    field.passCalcValue.forEach(function(f){
                        var $f=$formCont.find('.rca-df-question-col[data-field-name="'+f+'"]').find('input,select');
                        $f.val(response.data.result).change();
                    });
                });
            }
            function selectChange(){
                var $t=$(this);
                setFieldValue($t);
                resetDependents($t);
                performApplyCalc($t);
            }
            function resetDependents($t){
                var allFieldsArr=$formCont.find('.rca-df-question-col').toArray();
                var $curField=$t.closest('.rca-df-question-col');
                var startIdx=allFieldsArr.indexOf($curField)+1;
                for(i=startIdx;i<allFieldsArr.length;i++) {
                    checkDependency($(allFieldsArr[i]));
                }
            }
            function checkDependency($t){
                var field=$t.data('field');
                if (!checkVisibility(field)) $t.addClass('rca-df-not-visible');
                else $t.removeClass('rca-df-not-visible');
                if (field.nature == 'multi-dependent') {
                    values=getDependentValues(field);
                    $t.find('select').html('<option value="">Select</option>');
                    values.forEach(function(opt){
                        $t.find('select').append('<option value="'+opt.code+'">'+opt.name+'</option>');
                    });
                }
            }
            function getFieldValue($t){
                var fieldName=$t.closest('.rca-df-question-col').data('field-name');
                return formData[fieldName];
            }
            function setFieldValue($t){
                var fieldName=$t.closest('.rca-df-question-col').data('field-name');
                formData[fieldName]=$t.val();
                console.log(formData);
            }
}