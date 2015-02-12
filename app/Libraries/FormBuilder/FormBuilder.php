<?php namespace App\Libraries\FormBuilder;

use \Illuminate\Html\FormBuilder as IlluminateFormBuilder;

class FormBuilder extends IlluminateFormBuilder {

    protected $data = [];

    public function data($array)
    {
        $this->data = array_merge($this->data, $array);
    }

    public function add($key, $value)
    {
        array_set($this->data, $key, $value);
    }

    public function text($name, $value = null, $options = array())
    {
        $value = $this->value($name, $value);

        $options['data-name'] = $name;

        return $this->input('text', $this->formatName($name), $value, $options);
    }

    public function password($name, $options = array())
    {
        $options['data-name'] = $name;

        return $this->input('password', $this->formatName($name), null, $options);
    }

    public function checkbox($name, $value = 1, $checked = null, $options = array())
    {
        $checked = $this->value($name, $checked);

        $options['data-name'] = $name;

        return $this->checkable('checkbox', $name, $value, $checked, $options);
    }

    public function hidden($name, $value = null, $options = array())
    {
        $value = $this->value($name, $value);

        $options['data-name'] = $name;

        return $this->input('hidden', $this->formatName($name), $value, $options);
    }

    public function html($name, $value = null, $options = array())
    {
        $value = $this->value($name, $value);

        $options['data-name'] = $name;

        return $this->textarea($this->formatName($name), $value, $options);
    }

    public function dropdown($name, $array, $value=false, $attributes=[], $type='btn btn-primary', $label_template="{title}", $dropdown_class="")
    {
        $options = "";

        $display = "Select an option";

        if (!empty($attributes['placeholder']))
        {
            $display = $attributes['placeholder'];
        }

        $value = $this->value($name, $value);

        $attributes['data-name'] = $name;

        $attributes['data-value'] = $value;

        $search = strpos($type, 'search') !== false;

        if ($value === false)
        {
            $keys = array_keys($array);
            $value = array_shift($keys);
        }

        if ($search)
        {
            $options .= "<li class='dropdown-search-input'><input type='text' class='form-control' /></li>";
        }

        $count = 0;

        foreach ($array as $key => $row)
        {
            $count++;

            $closed = ($search && $count <= 10) || !$search ? '' : 'closed';

            if (is_string($row) || is_numeric($row))
            {
                $label = $row;

                $data = [];
            }
            else {

                $label = $label_template;

                foreach ($row as $data_key => $data_item)
                {
                    $label = str_replace("{".$data_key."}", $data_item, $label);
                }

                $data = $row;
            }

            $attr = "";

            foreach ($data as $data_key => $data_item)
            {
                $attr .= "data-$data_key='$data_item' ";
            }

            if ($key == $value)
            {
                $display = $label;

                $options .= "<li class='$closed'><a href='#' data-value='$key' class='' $attr>$label</a></li>";
            }
            else
            {
                $options .= "<li class='$closed'><a href='#' data-value='$key' $attr>$label</a></li>";
            }
        }

        if ($display == $attributes['placeholder'])
        {
            $type .= ' placeholding';
        }

        $attributes = $this->html->attributes($attributes);

        return
            "<button type=\"button\" class=\"$type dropdown-toggle\" data-toggle=\"dropdown\"><span class=\"caret\"></span><span class=\"display-value\">$display </span> </button>" .
            "<input type='hidden' name='" . $this->formatName($name) . "' value='$value' class='dropdown-value' $attributes />" .
            "<ul class=\"dropdown-menu $dropdown_class\" role=\"menu\">" .
                $options .
            "</ul>";
    }

    public function value($name, $value=null)
    {
        if (array_get($this->data, $name))
        {
            $value = array_get($this->data, $name);
        }

        return $this->getValueAttribute($name, $value);
    }

    protected function formatName($name)
    {
        $nameArray = explode('.', $name);
        if (count($nameArray) < 2) return $name;

        $nameFormatted = $nameArray[0];
        for ($n=1; $n < count($nameArray); $n++) {
            $nameFormatted .= '['.$nameArray[$n].']';
        }
        return $nameFormatted;
    }

}