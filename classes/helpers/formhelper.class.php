<?php
abstract class Field
{
	public $name;
	public $value;
	public $type;
	public $id;
	public $class;

	public function toHTML()
	{
		$html = "<input type='".$this->type."'";
		if(!empty($this->class))
			$html .= " class='".$this->class."'";
		if(!empty($this->id))
			$html .= " class='".$this->id."'";
		if(!empty($this->name))
			$html .= " name='".$this->name."'";
		if(!empty($this->value))
			$html .= " value='".$this->value."'";
		$html .= "/>";	
		return $html;
	}
}

class Textbox extends Field
{
	public function __construct()
	{
		$this->type = "text";
	}
}

class PasswordField extends Field
{
	public function __construct()
	{
		$this->type = "password";
	}
}

class Checkbox extends Field
{
	public $text = "";
	
	public function __construct()
	{
		$this->type = "checkbox";
	}
	
	public function toHTML()
	{
		$html = "<input type='".$this->type."'";
		if(!empty($this->class))
			$html .= " class='".$this->class."'";
		if(!empty($this->id))
			$html .= " class='".$this->id."'";
		if(!empty($this->name))
			$html .= " name='".$this->name."'";
		if(!empty($this->value))
			$html .= " value='".$this->value."'";
		$html .= "/> " . $this->text . "<br/>";	
		return $html;
	}
}

class RadioButton extends Field
{
	public function __construct()
	{
		$this->type = "radio";
	}
}

class FileBrowser extends Field
{
	public function __construct()
	{
		$this->type ="file";
	}
}

class HiddenField extends Field
{
	public function __construct()
	{
		$this->type = "hidden";
	}
}

class ImageButton extends Field
{
	public $src;
	
	public function __construct()
	{
		$this->type = "image";
	}
	
	public function toHTML()
	{
		$html = "<input type='".$this->type."'";
		if(!empty($this->class))
			$html .= " class='".$this->class."'";
		if(!empty($this->id))
			$html .= " class='".$this->id."'";
		if(!empty($this->name))
			$html .= " name='".$this->name."'";
		if(!empty($this->value))
			$html .= " value='".$this->value."'";
		if(!empty($this->src))
			$html .= " src='".$this->src."'";
		$html .= "/>";	
		return $html;
	}
}

class ResetButton extends Field
{
	public function __construct()
	{
		$this->type = "reset";
	}
}

class SubmitButton extends Field
{
	public function __construct()
	{
		$this->type = "submit";
	}
}

class Textarea extends Field
{
	public $disabled = false;
	public $readonly = false;
	public $columns;
	public $rows;
	public $text;
	
	public function __construct()
	{
	}
	
	public function toHTML()
	{
		$html = "<textarea";
		if($this->disabled)
			$html .= " disabled='disabled'";
		if($this->readonly)
			$html .= " readonly='readonly'";
		if(isset($this->columns))
			$html .= " cols='".$this->columns."'";
		if(isset($this->rows))
			$html .= " rows='".$this->rows."'";
		$html .= ">".$this->text;
		$html .= "</textarea>";
		return $html;
	}
}

class DropdownBox extends Field
{
	public $options = array();
	public $disabled = false;
	public $multiple = false;
	public $size;
	
	public function __construct()
	{
	}
	
	public function toHTML()
	{
		$html = "<select";
		if($this->disabled)
			$html .= " disabled='disabled'";
		if($this->multiple)
			$html .= " multiple='multiple'";
		if(isset($this->size))
			$html .= " size='".$this->size."'";
		if(!empty($this->name))
			$html .= " name='".$this->name."'";
		$html .= ">";
		foreach($this->options as $option => $values)
			$html .= "<option id='".$values['id']."' " . (isset($values["selected"])?"selected='selected'":"") . ">".$values['text']."</option>";
		$html .= "/>";	
		return $html;
	}
}

class Button extends Field
{
	public $onclick;
	public $disabled = false;
	
	public function __construct()
	{
	}
	
	public function toHTML()
	{
		$html = "<button type='".$this->type."'";
		if(!empty($this->class))
			$html .= " class='".$this->class."'";
		if(!empty($this->id))
			$html .= " id='".$this->id."'";
		if(!empty($this->name))
			$html .= " name='".$this->name."'";
		if(!empty($this->value))
			$html .= " value='".$this->value."'";
		if(!empty($this->onclick))
			$html .= " onclick='".$this->onclick."'";
		if($this->disabled)
			$html .= " disabled='disabled'";
		$html .= "/>";	
		return $html;
	}
}

class formHelper
{
	public $elements = array();
	public $labels = array();
	public $errors = array();
	public $title;
	public $action;
	public $method;
	
	public function __construct($title="",$action="",$method="")
	{
		$this->title = $title;
		$this->action = $action;
		$this->method = $method;
	}
	
	public static function field($type)
	{
		return new $type();
	}
	
	public function addLabel($label, $row=NULL)
	{
		$i = isset($row)?$row:count($this->labels);
		$this->labels[$i] = $label;
	}
	
	public function addElement($type, $attributes, $row=NULL)
	{
		$element = new $type();
		foreach( $attributes as $name => $value )
			$element->$name = $value;
		$i = isset($row)?$row:count($this->elements);
		if(!isset($this->elements[$i]))
			$this->elements[$i] = array();
		array_push( $this->elements[$i], $element );
	}
	
	public function render()
	{
		$html = "<table><thead><tr><th colspan='3'><h3>".$this->title."</h3></th></tr></thead><tbody>";
		$html .= "<form class='".$this->title."' method='".$this->method."' action='".$this->action."'>";
		for($i = 0; $i < count($this->elements); $i++)
		{
			$errorsHTML = "";
			$html .= "<tr>";
			$html .= "<td><label>".(isset($this->labels[$i])?$this->labels[$i]:"")."</label></td>";
			$html .= "<td>";
			foreach($this->elements[$i] as $element)
			{
				$html .= $element->toHTML();
				if(isset($this->errors[$element->name]))
					$errorsHTML .= "<span>" . $this->errors[$element->name] . "</span>";
			}
			$html .= "</td>";
			$html .= "<td class='error'>";
			$html .= $errorsHTML;
			$html .= "</td>";
			$html .= "</tr>";
		}
		$html .= "</form>";
		$html .= "<tbody></table>";
		echo($html);
	}
}
?>