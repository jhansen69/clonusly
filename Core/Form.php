<?php

namespace Core;

class Form
{
    protected $formData;
    protected $method;
    protected $postRouteURL;
    protected $fields = [];
    protected $errors;

    public function __construct($formData = [], $method = 'POST', $postRouteURL = '', $errors = [])
    {
        $this->formData = $formData;
        $this->method = strtoupper($method);
        $this->postRouteURL = $postRouteURL;
        $this->errors = $errors;
    }

    public function hidden($name)
    {
        $value = $this->getValue($name);
        $this->fields[] = "<input type='hidden' name='{$name}' value='{$value}'>";
    }

    public function text($name, $options = [])
    {
        $this->fields[] = $this->generateInputField('text', $name, $options);
    }
    

    public function date($name, $options = [])
    {
        $this->fields[] = $this->generateInputField('date', $name, $options);
    }

    public function file($name, $options = [])
    {
        $this->fields[] = $this->generateFileUploadField($name, $options);
    }

    public function textarea($name, $options = [])
    {
        $value = htmlspecialchars($this->getValue($name));
        $label = $this->generateLabel($name, $options);
        $attributes = $this->generateAttributes($options);
        $errorClass = isset($this->errors[$name]) ? ' is-invalid' : '';
        $textarea = "<textarea class='form-control{$errorClass}' name='{$name}' id='{$name}' {$attributes}>{$value}</textarea>";
        $errorMsg = isset($this->errors[$name]) ? "<div class='invalid-feedback'>{$this->errors[$name]}</div>" : '';

        $this->fields[] = "<div class='mb-3'>{$label}{$textarea}{$errorMsg}</div>";
    }

    public function number($name, $options = [])
    {
        $options['step'] = isset($options['decimals']) && $options['decimals'] === 0 ? '1' : 'any';
        $this->fields[] = $this->generateInputField('number', $name, $options);
    }

    protected function generateInputField($type, $name, $options)
    {
        $value = htmlspecialchars($this->getValue($name));
        $label = $this->generateLabel($name, $options);
        $attributes = $this->generateAttributes($options);
        $errorClass = isset($this->errors[$name]) ? ' is-invalid' : '';
        $input = "<input type='{$type}' class='form-control{$errorClass}' name='{$name}' id='{$name}' value='{$value}' {$attributes}>";
        $errorMsg = isset($this->errors[$name]) ? "<div class='invalid-feedback'>{$this->errors[$name]}</div>" : '';

        return "<div class='mb-3'>{$label}{$input}{$errorMsg}</div>";
    }

    protected function generateFileUploadField($type, $name, $options)
    {
        $value = htmlspecialchars($this->getValue($name));
        $label = $this->generateLabel($name, $options);
        $attributes = $this->generateAttributes($options);
        $errorClass = isset($this->errors[$name]) ? ' is-invalid' : '';
        $input = "<input type='hidden' name='{$name}' id='{$name}' value='{$value}'>";
        $input.="<div class='dropzone' id='dropzone'></div>";
        $input.="<script>document.addEventListener('DOMContentLoaded',function(){const dropzone=new Dropzone('dropzone','/api/files/upload');})</script>";

        return "<div class='mb-3'>{$label}{$input}{$errorMsg}</div>";
    }

    protected function generateLabel($name, $options)
    {
        if (isset($options['label'])) {
            return "<label for='{$name}' class='form-label'>{$options['label']}</label>";
        }
        return "<label for='{$name}' class='form-label'>" . ucfirst($name) . "</label>";
    }

    protected function generateAttributes($options)
    {
        $attributes = '';
        foreach ($options as $key => $value) {
            if (in_array($key, ['label', 'decimals'])) {
                continue;
            }
            $attributes .= is_bool($value) ? ($value ? " {$key}" : '') : " {$key}='{$value}'";
        }
        return $attributes;
    }

    protected function getValue($name)
    {
        return old($name) ?? ($this->formData[$name] ?? '');
    }

    public function render()
    {
        $csrfToken = $this->generateCsrfToken();
        $methodField = $this->generateMethodField();

        echo "<form action='{$this->postRouteURL}' method='post'>";
        echo $csrfToken;
        echo $methodField;
        if (!empty($this->errors)) {
            echo "<div class='alert alert-danger'>Please fix the following errors:</div>";
        }
        foreach ($this->fields as $field) {
            echo $field;
        }
        echo "<button type='submit' class='btn btn-primary'>Submit</button>";
        echo "</form>";
    }

    protected function generateCsrfToken()
    {
        return "<input type='hidden' name='csrf_token' value='" . htmlspecialchars(csrf_token()) . "'>";
    }

    protected function generateMethodField()
    {
        if (in_array($this->method, ['PUT', 'PATCH', 'DELETE'])) {
            return "<input type='hidden' name='_method' value='{$this->method}'>";
        }
        return '';
    }
}