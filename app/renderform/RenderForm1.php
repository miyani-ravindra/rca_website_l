<?php
use Orchestra\Parser\Xml\Facade as XmlParser;
//use SimpleXMLElement;

libxml_disable_entity_loader(false);
class RenderXMLForm {

public function renderFormMethod($method){
	if ($method=='') {
		echo ' method="post"';
	} 
	else {
		echo ' method="'.$method.'"';
	}
}

public function renderFormAction($action){
	if ($action=='') {
		echo ' ';
	}
	else {
		echo ' action="'.$action.'"';
	}
}

public function renderFormText($element) {

//echo "<div>";
//echo "render Form  Text Session var for: ", $element->name, " is: ", $_SESSION[''.$element->name];
//echo "<br>";
//echo "</div>";
	echo '<div class="control-group">'."\n";
	echo '<label class="control-label">'.$element->label;
	
	echo '</label>'."\n";
	echo '<div class="controls" >'."\n";
	echo ' <p>';
	echo '</p>'."\n";
	echo '</div>'."\n";
	echo '</div>'."\n";
}

public function renderText($element) {
//echo "<div>";
//echo "render Text Session var for: ", $element->name, " is: ", $_SESSION[''.$element->name];
//echo "<br>";
//echo "</div>";
	$numericclass = "";
	echo '<div class="input-block">
            <div class="labels">
                    <div class="qs_list"></div>
                    <div class="qs_body">'."\n";
            echo $element->label;
            	if ($element->mandatory=='yes') {
					echo '<span class="strike">*</span>';
				}
				if ($element->onlynumber=='yes') {
					$numericclass = "only_number";
				}
            echo '<div class="qs_sub"></div></div></div>'."\n";
            echo '<div class="input-control">';
            echo '<input type="'.$element->type.'" class="input-'.$element->size." ".$numericclass.'"';
			echo ' id="'.$element->name.'" name="'.$element->name.'"';
			if($element->placeholder == 'DD/MM/YYYY'){
				echo ' data-date-format="dd/mm/yyyy"';
			}
			if ($element->mandatory=='yes'){
				echo 'required="required"';
			}
			if ($element->placeholder!='') {
				echo ' placeholder="'.$element->placeholder.'"';
			}
			if ($element->readonly=='yes') {
				echo ' readonly="readonly"';
			}
			echo '>'."\n";
			if ($element->additional=='') {
				echo "\n";
			} else {
				echo '<br><font size=-1><i>'.$element->additional.'</i></font>'."\n";
			}
		echo '<div class="press_enter"></div>'."\n";	
        echo '</div>'."\n";
    echo '</div>'."\n";
}

public function renderTextArea($element) {

//echo "<div>";
//echo "render Text Area Session var for: ", $element->name, " is: ", $_SESSION[''.$element->name];
//echo "<br>";
//echo "</div>";
	echo '<div class="control-group">'."\n";
	echo '<label class="control-label">'.$element->label;
	
	if ($element->mandatory=='yes') {
		echo '<span class="_astrik">*</span>';
	}
	
	echo '</label>'."\n";
	echo '<div class="controls">'."\n";
	echo '<textarea class="input-'.$element->size.'"';
	echo ' id="'.$element->name.'" name="'.$element->name.'"';

	echo ' rows="'.$element->rows.'" ';

	if ($element->placeholder!='') {
		echo ' placeholder="'.$element->placeholder.'"';
	}
	
	if ($element->readonly=='yes') {
		echo ' readonly="readonly"';
	}
	echo '>';
	//."\n";
	if ($element->additional=='') {
		echo "\n";
	} else {
		echo '<br><font size=-1><i>'.$element->additional.'</i></font>'."\n";
	}
	
	echo '</textarea>'."\n";
	echo '<div class="press_enter"></div>'."\n";
	echo '</div>'."\n";
	echo '</div>'."\n";
}

public function renderTexteMail($element) {

//echo "<div>";
//echo "render Text  email Session var for: ", $element->name, " is: ", $_SESSION[''.$element->name];
//echo "<br>";
//echo "</div>";
	echo '<div class="control-group">'."\n";
	echo '<label class="control-label">'.$element->label;
	
	if ($element->mandatory=='yes') {
		echo '<span class="_astrik">*</span>';
	}
	
	echo '</label>'."\n";
	echo '<div class="controls">'."\n";
	echo '<input type="'.$element->type.'" class="input-'.$element->size.'"';
	echo ' id="'.$element->name.'" name="'.$element->name.'"';
	if ($element->placeholder!='') {
		echo ' placeholder="'.$element->placeholder.'"';
	}
	
	if ($element->readonly=='yes') {
		echo ' readonly="readonly"';
	}
	echo '>'."\n";
	if ($element->addlnlink =='' ) {
		echo "\n";
	} else {
		echo '<a href="'.$element->addlnlink.'">'.$element->addlnlinktext.'</a>'."\n";
	}
	if ($element->additional=='') {
		echo "\n";
	} else {
		echo '<br><font size=-1><i>'.$element->additional.'</i></font>'."\n";
	}
	echo '</div>'."\n";
	echo '</div>'."\n";
}

public function renderTextWithLOV($element) {
//echo "<div>";
//echo "render Text Session var for: ", $element->name, " is: ", $_SESSION[''.$element->name];
//echo "<br>";
//echo "</div>";
//GGG
	echo '<div class="control-group">'."\n";
	echo '<label class="control-label">'.$element->label;
	
	if ($element->mandatory=='yes') {
		echo '<span class="_astrik">*</span>';
	}
	
	echo '</label>'."\n";
	echo '<div class="controls">'."\n";
// here do not use the type, it is custom to get to this function.
// on a field where we will have LOV, it will always be text, right??	
//	echo '<input type="'.$element->type.'" class="input-'.$element->size.'"';
	echo '<input type="text" class="input-'.$element->size.'"';
	echo ' id="'.$element->name.'" name="'.$element->name.'"';
// a quick fix for date format, used the placeholder
// our xml should have date type and we should have a seperate render
	if($element->placeholder == 'DD/MM/YYYY'){
		echo ' data-date-format="dd/mm/yyyy"';
	}
	if ($element->placeholder!='') {
		echo ' placeholder="'.$element->placeholder.'"';
	}
	
	if ($element->readonly=='yes') {
		echo ' readonly="readonly"';
	}
	echo '>'."\n";
// for LOV, we also need a hidden element
	echo '<input type = "hidden" name="'.$element->hidden_name.'" id="'.$element->hidden_name.'"';
	echo ">";
	
	echo '<input type="button" name="choice" onClick="'.$element->lov_onclick.'" value="?">';
/*
	if ($element->addlnlink =='' ) {
		echo "\n";
	} else {
		echo '<a href="'.$element->addlnlink.'">'.$element->addlnlinktext.'</a>'."\n";
	}
*/
	if ($element->additional=='') {
		echo "\n";
	} else {
		echo '<br><font size=-1><i>'.$element->additional.'</i></font>'."\n";
	}
	echo '</div>'."\n";
	echo '</div>'."\n";
}


public function renderCaptcha($element) {
	echo '<div class="control-group">'."\n";
	echo '<label class="control-label" >'.$element->label;
	echo '</label>'."\n";
	echo '<div class="controls" >'."\n";
	echo '<img src="'.$element->src.'" id="'.$element->name.'">';
	echo '</div>'."\n";
	echo '</div>'."\n";
}

public function renderImage($element) {
	echo '<div class="control-group">'."\n";
	echo '<label class="control-label" >'.$element->label;
	echo '</label>'."\n";
	echo '<div class="controls" >'."\n";
//	echo '<img src="'.$_SESSION[''.$element->name].'">';
	//echo '<img src="'.$_SESSION[''.$element->name].'"';
	//$_SESSION[''.$element->name] = '';
	echo '<img src="'.$element->src.'"';
	if ($element->id=='') {
		echo ' ';
	}
	else {
		echo ' id="'.$element->id.'"';
	}
	echo '>';

	echo '</div>'."\n";
	echo '</div>'."\n";
}


public function renderHidden($element) {
//echo "<div>";
//echo "render Hidden  Session var for: ", $element->name, " is: ", $_SESSION[''.$element->name];
//echo "<br>";
//echo "</div>";
	echo '<input type = "hidden" name="'.$element->name.'" id="'.$element->name.'"';
	echo ">";
}

public function renderConstText($element) {
	echo '<div>'."\n";
	echo '<p>&nbsp;'.$element->label.'</p>';
	echo '</div>'."\n";
}

public function renderParaText($element) {
	echo '<div class="control-group">'."\n";
	echo '<label class="control-label">'.$element->label;
	echo '</label>'."\n";
	echo '<div class="controls">'."\n";
	echo '</div>'."\n";
	echo '</div>'."\n";
}


public function renderAhref($element) {
	echo '<div>'."\n";
	echo '<p> <a href="'.$element->target.'">'.$element->label.'</a> </p>';
	echo '</div>'."\n";
}

public function renderPwd($element) {
	echo '<div class="control-group">'."\n";
	echo '<label class="control-label" for="'.$element->name.'">'.$element->label;
	if ($element->mandatory=='yes') {
		echo '<span class="_astrik">*</span>';
	}
	echo '</label>'."\n";
	echo '<div class="controls">'."\n";
	echo '<input type="'.$element->type.'" class="input-'.$element->size.'" id="'.$element->name.'" name="'.$element->name.'">'."\n";
	if ($element->forgetpwdlink =='' ) {
		echo "\n";
	} else {
		echo '<a href="'.$element->forgetpwdlink.'">Forgot Password?</a>'."\n";
	}
	if ($element->additional=='') {
		echo "\n";
	} else {
		echo '<br><font size=-1><i>'.$element->additional.'</i></font>'."\n";
	}
	echo '</div>'."\n";
	echo '</div>'."\n";
}

public function renderSelect($element) {
//echo "<div>";
//echo "render select Session var for: ", $element->name, " is: ", $_SESSION[''.$element->name];
//echo "<br>";
//echo "</div>";
	echo '<div class="input-block">
            <div class="labels">
                    <div class="qs_list"></div>
                    <div class="qs_body">'."\n";
            echo $element->label;
            	if ($element->mandatory=='yes') {
					echo '<span class="strike">*</span>';
				}
            echo '<div class="qs_sub"></div></div></div>'."\n";
            echo '<div class="input-control">';
        echo '<select class="input-'.$element->size.' __select_drop" id="'.$element->name.'" name="'.$element->name.'"';
		if ($element->selectedoption!='') {
				echo ' value="'.$element->selectedoption.'"';
				$curr_option = $element->selectedoption;
			}
		echo '>'."\n";
		foreach($element->option as $option) {
			if(''.$option == $curr_option){
				echo '<option selected>'.$option.' </option>'."\n"; 
			} else {
				echo '<option>'.$option.' </option>'."\n";
			}
		}
		echo '</select>'."\n";
		echo '<div class="press_enter"></div>'."\n";
        echo '</div>'."\n";
        echo '</div>'."\n";
}

public function renderStaticSelectWithValue($element) {
//echo "<div>";
//echo "render select Session var for: ", $element->name, " is: ", $_SESSION[''.$element->name];
//echo "<br>";
//echo "</div>";
	echo '<div class="input-block">
            <div class="labels">
                    <div class="qs_list"></div>
                    <div class="qs_body">'."\n";
            echo $element->label;
            	if ($element->mandatory=='yes') {
					echo '<span class="strike">*</span>';
				}
            echo '<div class="qs_sub"></div></div></div>'."\n";
            echo '<div class="input-control outerInFoc">';
        echo '<input class="__select_drop inputF" id="'.$element->name.'" autocomplete="off" required=""';
		if ($element->selectedoption!='') {
				echo ' value="'.$element->selectedoption.'"';
				$curr_option = $element->selectedoption;
		}else{
			$curr_option = $element->selectedoption;
		}
		echo '>'."\n";
		echo '<ul class="hiddenul">'."\n";
		foreach($element->option as $option) {
			if(''.$option->option_value == $curr_option){
				echo '<li data-value='.$option->option_value.' selected>'.$option->option_text.' </li>'."\n"; 
			} else {
				echo '<li data-val='.$option->option_value.'>'.$option->option_text.' </li>'."\n";
			}
		}
		echo '</ul>'."\n";
		echo '<input type="hidden" name="'.$element->name.'" required="" class="inputH" value="">'."\n";
        echo '<div class="press_enter"></div>'."\n";
        echo '</div>'."\n";
        echo '<div class="outerclick"></div>'."\n";
        echo '</div>'."\n";
}

public function renderDynamicSelectWithValue($element) {
//echo "<div>";
//echo "render select Session var for: ", $element->name, " is: ", $_SESSION[''.$element->name];
//echo "<br>";
//echo "</div>";
	echo '<div class="input-block">
            <div class="labels">
                    <div class="qs_list"></div>
                    <div class="qs_body">'."\n";
            echo $element->label;
            	if ($element->mandatory=='yes') {
					echo '<span class="strike">*</span>';
				}
            echo '<div class="qs_sub"></div></div></div>'."\n";
            echo '<div class="input-control outerInFoc">';
	echo '<input class="__select_drop inputF" autocomplete="off" required=""';
	if ($element->selectedoption!='') {
			echo ' value="'.$element->selectedoption.'"';
			$curr_option = $element->selectedoption;
	}else{
			$curr_option = $element->selectedoption;
	}

	echo '>'."\n";	
	echo '<ul class="hiddenul">'."\n";
	
	$result= DB::select($element->select_stmt);
	if($element->blankoption!=''){
		echo '<li data-val = "">'.$element->blankoption.'</li>';	
	}
			
	foreach($result as $option) {
		if($option->id == $curr_option){
			echo '<li data-val='.$option->id.' selected>'.$option->value.' </li>'."\n"; 
		} else {
			echo '<li data-val='.$option->id.'>'.$option->value.' </li>'."\n";
		}
	}
	echo '</ul>'."\n";
	echo '<input type="hidden" name="'.$element->name.'" required="" class="inputH" value="">'."\n";
    echo '<div class="press_enter"></div>'."\n";
    echo '</div>'."\n";
    echo '<div class="outerclick"></div>'."\n";
    echo '</div>'."\n";
}



public function renderRadio($element) {
	
//echo "<div>";
//echo "render Radio Session var for: ", $element->name, " is: ", $_SESSION[''.$element->name];
//echo "<br>";
//echo "</div>";
	/*
	echo "<div>";
	echo "session variable: ", $_SESSION[''.$element->name];
	echo "</div>";
	*/

	echo '<div class="control-group">'."\n";
	echo '<label class="control-label" for="'.$element->name.'">'.$element->label;
	if ($element->mandatory=='yes') {
		echo '<span class="_astrik">*</span>';
	}
	echo '</label>'."\n";
//	echo '<div class="btn-group" data-toggle-name="'.$element->name.'" data-toggle="buttons-radio">'."\n";

	echo '<div class="btn-group" id="'.$element->name.'" data-toggle-name="'.$element->name.'" data-toggle="buttons-radio">'."\n";

	foreach($element->option as $option) {
		echo '<button type="button" value="'.$option.'" id="'.$option.'"';
		//$opt_str .= $option;
		
	echo '</div>'."\n";
	echo '</div>'."\n";
	/*
	echo "<div>";
	echo "process vars, sess_var: ", $sess_var, " sess matched: ", $sess_var_matched;
	echo "process vars, non_sess_var: ", $non_sess_var, " non sess matched: ", $non_sess_var_matched;
	echo " option str: ".$opt_str;
	echo "selected option: ", $element->selectedoption;
	echo "</div>";
	*/
}
}

public function renderRadio2($element) {
	echo '<div class="control-group">'."\n";
	echo '<label class="control-label" >'.$element->label;
	if ($element->mandatory=='yes') {
		echo '<span class="_astrik">*</span>';
	}
	echo '</label>'."\n";
	echo '<div class="controls" >'."\n";
	foreach($element->option as $option) {
		echo '<input type="radio" style="vertical-align: middle;margin: 0px;" name="'.$element->name.'" id="'.$option.'" value="'.$option.'"';
		//echo ' ><label style="display: inline; padding-left: 5px; text-align:bottom;" for="'.$option.'">'.$option.'</label>'."\n&nbsp;";
		echo '>'.$option."\n&nbsp;";
	}
	echo '</div>'."\n";
	echo '</div>'."\n";
}

public function renderCheckBoxes($element) {
//echo "<div>";
//echo "render check box Session var for: ", $element->name, " is: ", $_SESSION[''.$element->name];
//echo "<br>";
//echo "</div>";
	echo '<div class="control-group">'."\n";
	echo '<label class="control-label" for="'.$element->name.'">'.$element->label.'</label>'."\n";
	echo '<div class="controls">'."\n";
	foreach($element->option as $option) {
		echo '<label class="checkbox"><input type="checkbox" name="'.$option->name.'">'.$option->label.'</label>';
	}
	echo '</div>'."\n";
	echo '</div>'."\n";
}

public function renderDivider($element) {
//form legend
	echo '<div class="control-group">'."\n";
	echo '<legend class="sublegend">&nbsp;'.$element->label.'</small></legend>';
	echo '</div>'."\n";
}

public function renderInputs($formxml) {
	//render each input element
	foreach($formxml->inputelements->children() as $element) {

		// render hidden variable
		if ($element->type=='hidden') $this->renderHidden($element);
		// render line of text
		if ($element->type=='const_text') $this->renderConstText($element);
		if ($element->type=='para_text') $this->renderParaText($element);

		// render hyperlink
		if ($element->type=='ahref') $this->renderAhref($element);
		//render text as input field
		if ($element->type=='form_text') $this->renderFormText($element);
		//render images 
		if ($element->type=='captcha') $this->renderCaptcha($element);
		if ($element->type=='MathCaptcha') $this->renderMathCaptcha($element);
		if ($element->type=='image') $this->renderImage($element);
		//render text as input field
		if ($element->type=='text') $this->renderText($element);

		//text field with a popup list of value	
		if ($element->type=='textwithLOV') $this->renderTextWithLOV($element);

		//render text area as input field
		if ($element->type=='textarea') $this->renderTextArea($element);

		//render email as input field
// still to do
		if ($element->type=='email') $this->renderTexteMail($element);
		
		//render password as input field
		if ($element->type=='password') $this->renderPwd($element);
		
		//render select 
		if ($element->type=='select') $this->renderSelect($element);
		if ($element->type=='static_select_with_value') $this->renderStaticSelectWithValue($element);		
		if ($element->type=='dynamic_select_with_value') $this->renderDynamicSelectWithValue($element);		
		
		//render radio
		if ($element->type=='radio') $this->renderRadio($element);
		
		//render checkboxes
		if ($element->type=='checkbox') $this->renderCheckboxes($element);
		
		//render divider
		if ($element->type=='divider') $this->renderDivider($element);

		//render file field
		if ($element->type=='file') $this->renderFileButton($element);
		
	}
}


public function renderButton($button) {
	
	//start button tag
	echo '<button ';
	
	if ($button->type=='')  echo '';
	else{
		echo 'type="'.$button->type.'"';
	} 
	
	//no action
	if ($button->action=='') {
		echo ' ';
	}
	//action url
	else {
		echo ' formaction="'.$button->action.'"';
	}
	
	if ($button->id=='') {
		echo ' ';
	}
	else {
		echo ' id="'.$button->id.'"';
	}
	
	if ($button->onclick=='') {
		echo ' ';
	}
	else {
		echo ' onclick="'.$button->onclick.'"';
	}

	//button style
	echo ' class="btn '.$button->subtype.'">';
	//button label
	echo $button->label;
	//close button
	echo '</button>'."\n";
	

}

public function renderFileButton($button) {
	
	//start button tag
	echo '<div style="position:relative;">';
	echo '<a class=\'btn btn-primary\' href=\'javascript:;\'>';
	echo $button->label;
	echo '<input type="file"'; 
	echo 'style=\'position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;\' ';
	echo 'name="', $button->name, '" size="40"  onchange=\'$("#', $button->id, '").html($(this).val());\'';
	if ($button->id=='') {
		echo ' ';
	}
	else {
		echo ' id="'.$button->id.'"';
	}
	if ($button->multiple == 'Y') echo ' multiple>';
	else echo '>';
	echo '</a>';
	echo '<span class=\'label label-info\' id="', $button->id, '"></span>';
	echo '</div>';	
}


public function renderActions($formxml){
	//render form actions
	//actions div
	echo '<div class="form-actions">'."\n";
	
	//action buttons
	foreach($formxml->actionbuttons->children() as $button) {
		//render button
		$this->renderButton($button);
	}
	
	//finishing actions div
	echo '</div>'."\n";
}

public function renderform($xmlformdef) {
	//Load the form xml
	//$formxml = new SimpleXMLElement(file_get_contents($xmlformdef));

	$formxml=simplexml_load_file($xmlformdef);

	//render the form fields
	// echo '<fieldset>'."\n";

	//render each input element (text, password, select)
	$this->renderInputs($formxml);
	
	//render actions
	// renderActions($formxml);
	
	//finishing fieldset
	// echo '</fieldset>'."\n";
}

public function renderMathCaptcha($element) {
	echo '<div class="control-group">'."\n";
	echo '<label class="control-label" >'.$element->label;
	echo '</label>'."\n";
	echo '<div class="controls">'."\n";
	echo '<input type="text" class="input-'.$element->size.'"';
	echo ' id="'.$element->name.'" name="'.$element->name.'"';
	echo '>'."\n";
	echo '</div>'."\n";
// null;
}
	
}