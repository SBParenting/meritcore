<?php

	\Form::macro('dropdown', function($name, $array, $value=false, $attributes=[], $type='btn btn-primary', $label_template="{title}", $dropdown_class="") {

        $options = "";

        $display = "Select an option";

        if (!empty($attributes['placeholder']))
        {
            $display = $attributes['placeholder'];
        }

        $value = $this->getValueAttribute($name, $value);

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

        $attributes = $this->html->attributes($attributes);

        return
            "<button type=\"button\" class=\"$type dropdown-toggle\" data-toggle=\"dropdown\"><span class=\"caret\"></span><span class=\"display-value\">$display </span> </button>" .
            "<input type='hidden' name='$name' value='$value' class='dropdown-value' $attributes />" .
            "<ul class=\"dropdown-menu $dropdown_class\" role=\"menu\">" .
                $options .
            "</ul>";
	});