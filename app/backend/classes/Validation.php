<?php

class Validation
{
    private $_passed = false,
            $_optional = false,
            $_errors = array(),
            $_db     = null;

    public function __construct()
    {
        $this->_db = Database::getInstance();
        $this->_user = new User;
    }

    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules)
        {
            foreach ($rules as $rule => $rule_value)
            {
                if (is_array($source[$item]))
                {
                    $source[$item] = implode(',', $source[$item]);
                }
                if (is_array($source[$item]) && !in_array($rule, ['required', 'optional'])) {
                    continue;
                }
    
                // If source is an array and it's required, add an error
                if (is_array($source[$item]) && $rule === 'required' && empty($source[$item]['name'])) {
                    $this->addError("{$item} is required.");
                }
    
                // If the source is an array, skip further processing
                if (is_array($source[$item])) {
                    continue;
                }
    
                $value = trim($source[$item]);
                $item = escape($item);


                if ($rule === 'optional' && ! empty($value))
                {
                   $this->_optional = true;
                }

                if ($rule === 'required' && empty($value))
                {
                    $this->addError("{$item} is required.");
                }

                if ($rule === 'bind' && empty($value) && ! empty($source[$rule_value]))
                {
                    $this->addError("{$item} is required.");
                }

                else if (!empty($value))
                {
                    switch ($rule)
                    {
                        case 'min':

                            if (strlen($value) < $rule_value)
                            {
                                $this->addError("{$item} must be minimum of {$rule_value} character.");
                            }
                            break;

                        case 'max':

                            if (strlen($value) > $rule_value)
                            {
                                $this->addError("{$item} must be maximum of {$rule_value} character.");
                            }
                            break;

                        case 'match':

                            if ($value != $source[$rule_value])
                            {
                                $this->addError("{$rule_value} must match {$item}.");
                            }
                            break;

                        case 'email':

                            if (filter_var($value,FILTER_VALIDATE_EMAIL) !==  $rule_value)
                            {
                                $this->addError("{$item} must valid email format.");
                            }
                            break;

                        case 'alnum':

                            if (ctype_alnum($value) !==  $rule_value)
                            {
                                $this->addError("{$item} must alphanumeric.");
                            }
                            break;

                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));

                            if ($check->count())
                            {
                                $this->addError("{$item} already exists.");
                            }
                            break;

                        case 'verify':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));

                            if (! Password::check($value, $this->_user->data()->password))
                            {
                                $this->addError("Wrong Current Password!.");
                            }
                            break;
                    }
                }
            }
        }

        if (empty($this->_errors))
        {
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function error()
    {
        return $this->_errors[0];
    }

    public function passed()
    {
        return $this->_passed;
    }

    public function optional()
    {
        return $this->_optional;
    }
}
